<?php

class Peminjaman extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('MKendaraan');
        $this->load->model('MKlien');
    }
    public function index(){
        $this->load->model('M_User');
		$this->load->model('MKendaraan');
		$this->load->model('MKlien');

		$datakendaraan = $this->MKendaraan->get(['disabled_date' => NULL, 'is_active' => '1']);
		$datainstansi = $this->MKlien->get(['deleted_date' => NULL, 'orderBy' => 'client_nama ASC']);

		$data = [
			'title' => "admin",
			'datakendaraan' => $datakendaraan,
			'datainstansi' => $datainstansi
		];

		$this->template->index('admin/pencatatan/unit_kendaraan', $data);
		$this->load->view('_components/sideNavigation', $data);
    }
    public function store(){
        $selectedValue = explode('|', $_POST['kendaraan']);
        $valueRangka = $selectedValue[0];
        $valueStnk = $selectedValue[1];
        $data = [
            "kendaraan_no_rangka"       => $valueRangka,
            "kendaraan_stnk"            => $valueStnk,
            "client_id"                 => $_POST['instansi'],
            "transaksi_peminjaman_start"=> $_POST['tanggal_start'],
            "transaksi_peminjaman_end"  => $_POST['tanggal_end']
        ];
        $this->db->insert('transaksi_peminjaman', $data);

        $this->session->set_flashdata('succ_modal', "Data Berhasil Disimpan");
        redirect('admin/peminjaman');
        
    }
}