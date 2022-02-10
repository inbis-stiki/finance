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
    }
    public function index(){
        $data['auth']           = $this->db->get_where('master_user', ['username' => $this->session->userdata('username')])->row_array();
        $data['kendaraans']     = $this->MKendaraan->get(['disabled_date' => NULL, 'is_active' => '1']);
        $data['pengAdmin']      = $this->MPengeluaran->get(['pengeluaran_group' => 'Administrasi', 'deleted_date' => NULL]);
        $data['pengMaint']      = $this->MPengeluaran->get(['pengeluaran_group' => 'Maintenance', 'deleted_date' => NULL]);
        $data['pengExp']        = $this->MPengeluaran->get(['pengeluaran_group' => 'Expense', 'deleted_date' => NULL]);
        $data['sparepart']      = $this->MSparepart->get(['deleted_date' => NULL]);
        $data['saldo']          = $this->db->get('balance')->row();

        $this->template->index('admin/pencatatan/jenis_biaya', $data);
		$this->load->view('_components/sideNavigation', $data);
    }
    public function ajxGetNoSeri(){
        $noSeri = $this->MJenisBiaya->get(['transaksi_no_seri' => $_POST['noSeri']]);
        if($noSeri != null){
            echo json_encode(true);
        }else{
            echo json_encode(false);
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

        $klien = $this->MJenisBiaya->getWilayah(['noRangka' => $dataStore['no_rangka'], 'stnk' => $dataStore['kendaraan_stnk']]);
        $dataStore['transaksi_wilayah'] = $klien->client_region;
        $dataStore['transaksi_klien']   = $klien->client_nama;

        $index = 0;
        foreach ($_POST['jenPeng'] as $item) {
            $dataStore['id_pengeluaran']    = $item;
            $dataStore['transaksi_total']   = str_replace(',', '', $_POST['total'][$index]);
            
            $this->MJenisBiaya->insert($dataStore);
            $index++;
        }

        $this->session->set_flashdata('succ_modal', true);
        redirect('admin/transaksi');
    }
    public function storeMaintenance(){
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

        $dataStore['transaksi_tanggal']         = $_POST['tglService'];
        $dataStore['no_rangka']                 = explode('|', $_POST['kendaraan'])[0];
        $dataStore['kendaraan_stnk']            = explode('|', $_POST['kendaraan'])[1];
        $dataStore['transaksi_detail']          = $_POST['toko'];
        
        $klien = $this->MJenisBiaya->getWilayah(['noRangka' => $dataStore['no_rangka'], 'stnk' => $dataStore['kendaraan_stnk']]);
        $dataStore['transaksi_wilayah'] = $klien->client_region;
        $dataStore['transaksi_klien']   = $klien->client_nama;
        
        $index = 0;
        foreach ($_POST['jenPeng'] as $item) {
            $dataStore['id_pengeluaran']            = $item;
            $dataStore['transaksi_no_seri']         = $_POST['noSeri'][$index];
            $dataStore['id_sparepart']              = explode('|', $_POST['sparepart'][$index])[0];
            $dataStore['transaksi_jarak_tempuh']    = str_replace(',', '', $_POST['jarak'][$index]);
            $dataStore['transaksi_jumlah']          = str_replace(',', '', $_POST['kuantitas'][$index]);
            $dataStore['transaksi_total']           = str_replace(',', '', $_POST['total'][$index]);
            $dataStore['transaksi_keterangan']      = $_POST['merek'][$index];
            $this->MJenisBiaya->insert($dataStore);
            $index++;
        }
        $this->session->set_flashdata('succ_modal', true);
        redirect('admin/transaksi');
    }
    public function storeExpense(){
        // check saldo
        $saldo = $this->db->get('balance')->row()->balance;
        $totalTrans = array_sum(str_replace(',', '', $_POST['bbm']['total'])) + array_sum(str_replace(',', '', $_POST['driver']['total'])) + array_sum(str_replace(',', '', $_POST['lain']['total']));
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
        
        $klien = $this->MJenisBiaya->getWilayah(['noRangka' => $dataStore['no_rangka'], 'stnk' => $dataStore['kendaraan_stnk']]);
        $dataStore['transaksi_wilayah'] = $klien->client_region;
        $dataStore['transaksi_klien']   = $klien->client_nama;

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
}
