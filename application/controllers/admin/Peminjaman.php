<?php

class Peminjaman extends CI_Controller{
    public function __construct(){
        parent::__construct();
        if($this->session->userdata('isAdmin') != '1'){
			redirect('/');
		}
        $this->load->model('MKendaraan');
        $this->load->model('MKlien');
    }
    public function index(){
        $this->load->model('M_User');
		$this->load->model('MKendaraan');
		$this->load->model('MKlien');

		$datakendaraan          = $this->MKendaraan->get(['disabled_date' => NULL, 'is_active' => '1']);
        $kendaraanPeminjaman    = $this->getKendaraanPinjam(date('Y-m-d'), date('Y-m-d'));
		$datainstansi           = $this->MKlien->get(['deleted_date' => NULL, 'orderBy' => 'client_nama ASC']);

        $kendaraanAfterFilter = [];        
        foreach ($datakendaraan as $item) {
            $status = false;
            $object = new stdClass();
            $object->kendaraan_no_rangka = $item->kendaraan_no_rangka;
            $object->kendaraan_stnk = $item->kendaraan_stnk;
            foreach ($kendaraanPeminjaman as $item2) {

                if($item2->kendaraan_no_rangka == $item->kendaraan_no_rangka && $item2->kendaraan_stnk == $item->kendaraan_stnk){
                    $status = true;
                    break;
                }
            }

            if($status == false) array_push($kendaraanAfterFilter, $object);
        }

		$data = [
			'title' => "admin",
			'datakendaraan' => $kendaraanAfterFilter,
			'datainstansi' => $datainstansi
		];

		$this->template->index('admin/pencatatan/unit_kendaraan', $data);
		$this->load->view('_components/sideNavigation', $data);
    }
    public function store(){
        $selectedValue = explode('|', $_POST['kendaraan']);
        $tglTrans = explode(' - ', $_POST['tglTrans']);
        $valueRangka = $selectedValue[0];
        $valueStnk = $selectedValue[1];
        $data = [
            "kendaraan_no_rangka"       => $valueRangka,
            "kendaraan_stnk"            => $valueStnk,
            "client_id"                 => $_POST['instansi'],
            "transaksi_peminjaman_start"=> $tglTrans[0],
            "transaksi_peminjaman_end"  => $tglTrans[1]
        ];
        $this->db->insert('transaksi_peminjaman', $data);

        $this->session->set_flashdata('succ_modal', "Data Berhasil Disimpan");
        redirect('admin/peminjaman');
        
    }
    public function ajxGetKendaraanPeminjaman(){
        $tglTrans = explode(' - ', $_POST['tglTrans']);
        $datakendaraan          = $this->MKendaraan->get(['disabled_date' => NULL, 'is_active' => '1']);
        $kendaraanPeminjaman    = $this->getKendaraanPinjam($tglTrans[0], $tglTrans[1]);

        $kendaraanAfterFilter = [];        
        foreach ($datakendaraan as $item) {
            $status = false;
            $object = new stdClass();
            $object->kendaraan_no_rangka = $item->kendaraan_no_rangka;
            $object->kendaraan_stnk = $item->kendaraan_stnk;
            foreach ($kendaraanPeminjaman as $item2) {

                if($item2->kendaraan_no_rangka == $item->kendaraan_no_rangka && $item2->kendaraan_stnk == $item->kendaraan_stnk){
                    $status = true;
                    break;
                }
            }

            if($status == false) array_push($kendaraanAfterFilter, $object);
        }
        echo json_encode($kendaraanAfterFilter);
    }
    public function getKendaraanPinjam($tglStart, $tglEnd){
        return $this->db->query('
            SELECT tp.kendaraan_no_rangka , tp.kendaraan_stnk 
            FROM transaksi_peminjaman tp 
            WHERE 
                ("'.$tglStart.'" >= tp.transaksi_peminjaman_start
                AND "'.$tglStart.'" <= transaksi_peminjaman_end )
                OR
                ("'.$tglEnd.'" >= tp.transaksi_peminjaman_start
                AND "'.$tglEnd.'" <= transaksi_peminjaman_end)
        ')->result();
    }
}