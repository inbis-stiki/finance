<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        if($this->session->userdata('isAdmin') != '1'){
			redirect('/');
		}
        $this->load->model('MJenisBiaya');
        $this->load->model('MKendaraan');
        $this->load->model('MPengeluaran');
        $this->load->model('MSparepart');
        $this->load->model('MDropdown');
    }
    public function index(){
        $data['auth']           = $this->db->get_where('master_user', ['username' => $this->session->userdata('username')])->row_array();
        $data['kendaraans']     = $this->MKendaraan->get(['disabled_date' => NULL, 'is_active' => '1']);
        $data['pengAdmin']      = $this->MPengeluaran->get(['pengeluaran_group' => 'Administrasi', 'deleted_date' => NULL]);
        $data['pengMaint']      = $this->MPengeluaran->get(['pengeluaran_group' => 'Maintenance', 'deleted_date' => NULL]);
        $data['pengExp']        = $this->MPengeluaran->get(['pengeluaran_group' => 'Expense', 'deleted_date' => NULL]);
        $data['jenSparepart']   = $this->MDropdown->get(['dropdown_menu' => 'Jenis Sparepart', 'deleted_date' => NULL]);
        $data['saldo']          = $this->db->get('balance')->row();
        $data['sparepartData']  = $this->MSparepart->getAll();

        $this->template->index('admin/pencatatan/jenis_biaya', $data);
		$this->load->view('_components/sideNavigation', $data);
    }
    public function ajxKdBarang(){
        $kdBarang = $this->MSparepart->get(['sparepart_kode' => $_POST['kdBarang'], 'deleted_date' => NULL]);
        if($kdBarang != null){
            echo json_encode(['status' => true, 'data' => $kdBarang]);
        }else{
            echo json_encode(['status' => false]);
        }
    }
    public function storeAdministrasi(){
        // check saldo
        $saldo = $this->db->get('balance')->row()->balance;
        $totalTrans = array_sum(str_replace(',', '', $_POST['total']));
        if($saldo < $totalTrans){
            $this->session->set_flashdata('err_msg', 'Saldo tidak mencukupi untuk melakukan transaksi');
            redirect('admin/transaksi');
        }
        $saldo -= $totalTrans;
        $this->db->update('balance', ['balance' => $saldo]);
        // end check

        $dataStore['transaksi_tanggal'] = $_POST['tglTransaksi'];
        $dataStore['no_rangka']         = explode('|', $_POST['kendaraan'])[0];
        $dataStore['kendaraan_stnk']    = explode('|', $_POST['kendaraan'])[1];

        $kendaraan = $this->MKendaraan->getById($dataStore['no_rangka'], $dataStore['kendaraan_stnk']);
        $dataStore['transaksi_wilayah'] = $kendaraan->kendaraan_wilayah;
        $dataStore['transaksi_pt']   = !empty($kendaraan->kendaraan_jenis != "Pribadi") ? $kendaraan->kendaraan_pt : "Pribadi";

        $index = 0;
        foreach ($_POST['jenPeng'] as $item) {
            $jenPeng = $this->db->get_where('master_jenis_pengeluaran', ['pengeluaran_id' => $item])->row();
            if($jenPeng->pengeluaran_jenis == "KIR"){
                $kendaraan = $this->MKendaraan->getById($dataStore['no_rangka'], $dataStore['kendaraan_stnk']);
                $this->MKendaraan->update([
                    'kendaraan_no_rangka'       => $dataStore['no_rangka'],
                    'kendaraan_stnk'            => $dataStore['kendaraan_stnk'],
                    'kendaraan_deadlinekir'     => date('Y-m-d', strtotime("+6 months", strtotime($kendaraan->kendaraan_deadlinekir))),
                    'kendaraan_isnotifkir'      => '0'
                ]);
            }else if($jenPeng->pengeluaran_jenis == "STNK"){
                $kendaraan = $this->MKendaraan->getById($dataStore['no_rangka'], $dataStore['kendaraan_stnk']);
                $this->MKendaraan->update([
                    'kendaraan_no_rangka'       => $dataStore['no_rangka'],
                    'kendaraan_stnk'            => $dataStore['kendaraan_stnk'],
                    'kendaraan_deadlinestnk'    => date('Y-m-d', strtotime("+12 months", strtotime($kendaraan->kendaraan_deadlinestnk))),
                    'kendaraan_isnotifstnk'     => '0'
                ]);
            }

            $dataStore['id_pengeluaran']    = $item;
            $dataStore['transaksi_total']   = str_replace(',', '', $_POST['total'][$index]);
            
            $this->MJenisBiaya->insert($dataStore);
            $index++;
        }


        $this->session->set_flashdata('succ_modal', true);
        redirect('admin/transaksi');
    }
    public function storeMaintenance(){
        print_r($_POST);
        foreach ($_POST['jenSparepart'] as $item) {
            if($item == null || $item == ''){
                $this->session->set_flashdata('err_msg', 'Jenis sparepart tidak boleh kosong!');
                redirect('admin/transaksi');
                break;
            }
        }
        foreach ($_POST['barang'] as $item) {
            if($item == null || $item == ''){
                $this->session->set_flashdata('err_msg', 'Nama barang tidak boleh kosong!');
                redirect('admin/transaksi');
                break;
            }
        }
        
        // check saldo
        $saldo = $this->db->get('balance')->row()->balance;
        $totalTrans = array_sum(str_replace(',', '', $_POST['total']));
        if($saldo < $totalTrans){
            $this->session->set_flashdata('err_msg', 'Saldo tidak mencukupi untuk melakukan transaksi');
            redirect('admin/transaksi');
        }
        $saldo -= $totalTrans;
        $this->db->update('balance', ['balance' => $saldo]);
        // end check

        // check sparepart is exist
        $index = 0;
        foreach ($_POST['kdBarang'] as $item) {
            $sparepart = $this->MSparepart->get(['sparepart_kode' => $item, 'deleted_date' => NULL]);
            if($sparepart == null){
                $this->MSparepart->insert([
                    'sparepart_kode'  => $item, 
                    'sparepart_jenis' => $_POST['jenSparepart'][$index],
                    'sparepart_nama'  => $_POST['barang'][$index]
                ]);
            }
            $index++;
        }
        // end check

        $dataStore['transaksi_tanggal']         = $_POST['tglService'];
        $dataStore['no_rangka']                 = explode('|', $_POST['kendaraan'])[0];
        $dataStore['kendaraan_stnk']            = explode('|', $_POST['kendaraan'])[1];
        $dataStore['transaksi_detail']          = $_POST['toko'];
        
        $kendaraan = $this->MKendaraan->getById($dataStore['no_rangka'], $dataStore['kendaraan_stnk']);
        $dataStore['transaksi_wilayah'] = $kendaraan->kendaraan_wilayah;
        $dataStore['transaksi_pt']   = !empty($kendaraan->kendaraan_jenis != "Pribadi") ? $kendaraan->kendaraan_pt : "Pribadi";
        
        $index = 0;
        foreach ($_POST['jenPeng'] as $item) {
            $dataStore['id_pengeluaran']            = $item;
            $dataStore['id_sparepart']              = $this->MSparepart->get(['sparepart_kode' => $_POST['kdBarang'][$index], 'deleted_date' => NULL])[0]->sparepart_id;
            $dataStore['transaksi_jumlah']          = str_replace(',', '', $_POST['kuantitas'][$index]);
            $dataStore['transaksi_total']           = str_replace(',', '', $_POST['total'][$index]);
            $dataStore['transaksi_keterangan']      = $_POST['keterangan'][$index];
            $this->MJenisBiaya->insert($dataStore);
            $index++;
        }
        $this->session->set_flashdata('succ_modal', true);
        redirect('admin/transaksi');
    }
    public function storeExpense(){
        // check saldo
        $totalTrans = 0;
        if(!empty($_POST['bbm']['total'])){
            $totalTrans += array_sum(str_replace(',', '', $_POST['bbm']['total']));
        }
        if(!empty($_POST['driver']['total'])){
            $totalTrans += array_sum(str_replace(',', '', $_POST['driver']['total']));
        }
        if(!empty($_POST['lain']['total'])){
            $totalTrans += array_sum(str_replace(',', '', $_POST['lain']['total']));
        }

        $saldo = $this->db->get('balance')->row()->balance;
        if($saldo < $totalTrans){
            $this->session->set_flashdata('err_msg', 'Saldo tidak mencukupi untuk melakukan transaksi');
            redirect('admin/transaksi');
        }
        $saldo -= $totalTrans;
        $this->db->update('balance', ['balance' => $saldo]);
        // end check

        $dataStore['transaksi_tanggal']         = $_POST['tglService'];
        $dataStore['no_rangka']                 = explode('|', $_POST['kendaraan'])[0];
        $dataStore['kendaraan_stnk']            = explode('|', $_POST['kendaraan'])[1];
        
        $kendaraan = $this->MKendaraan->getById($dataStore['no_rangka'], $dataStore['kendaraan_stnk']);
        $dataStore['transaksi_wilayah'] = $kendaraan->kendaraan_wilayah;
        $dataStore['transaksi_pt']   = !empty($kendaraan->kendaraan_jenis != "Pribadi") ? $kendaraan->kendaraan_pt : "Pribadi";

        $index = 0;
        foreach ($_POST['bbm']['jenPeng'] as $item) {
            $temp = $dataStore;
            $temp['id_pengeluaran']            = $item;
            $temp['transaksi_total']           = str_replace(',', '', $_POST['bbm']['total'][$index]);
            $temp['transaksi_keterangan']      = $_POST['bbm']['keterangan'][$index];
            $this->MJenisBiaya->insert($temp);
            $index++;
        }

        $index = 0;
        foreach ($_POST['driver']['jenPeng'] as $item) {
            $temp = $dataStore;
            $temp['id_pengeluaran']         = $item;
            $temp['transaksi_jumlah']       = str_replace(',', '', $_POST['driver']['kuantitas'][$index]);
            $temp['transaksi_total']        = str_replace(',', '', $_POST['driver']['total'][$index]);
            $this->MJenisBiaya->insert($temp);
            $index++;
        }
        
        $index = 0;
        foreach ($_POST['lain']['jenPeng'] as $item) {
            $temp = $dataStore;
            $temp['id_pengeluaran']         = $item;
            $temp['transaksi_jumlah']       = str_replace(',', '', $_POST['lain']['kuantitas'][$index]);
            $temp['transaksi_total']        = str_replace(',', '', $_POST['lain']['total'][$index]);
            $temp['transaksi_detail']       = $_POST['lain']['detail'][$index];
            $this->MJenisBiaya->insert($temp);
            $index++;
        }
        $this->session->set_flashdata('succ_modal', true);
        redirect('admin/transaksi');
    }
    public function ajxGetKendaraan(){
        $this->load->model('MKendaraan');
        $id = explode('|', $_POST['id']);
        $kendaraan = $this->MKendaraan->getById($id[0], $id[1]);
        $kendaraan->kendaraan_foto = json_decode($kendaraan->kendaraan_foto);

        $umur = date_diff(date_create($kendaraan->kendaraan_tanggal_beli), date_create(date('Y-m-d')));
        $kendaraan->umur = $umur->format("%m") . " Bulan " . $umur->format('%y') . "Tahun";
        echo json_encode($kendaraan);
    }
}
