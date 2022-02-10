<?php

class Dashboard extends CI_Controller{
    public function __construct(){
        parent::__construct();
		if($this->session->userdata('isManagement') != '1'){
			redirect('/');
		}
		$this->load->library('table');
        $this->load->model('M_dashboard');
		$this->load->model('MKendaraan');
		$this->load->model('MJenisBiaya');
		$this->load->model('MReport');
    }
    public function index(){
        $dataDaftarKendaraan = $this->M_dashboard->getDaftarKendaraan();
		$dataGlobalCost = $this->M_dashboard->getGlobalCost();
		$dataSaldo	= $this->db->get('balance')->row();
		$jmlKendaraan = count($this->MKendaraan->get(['disabled_date' => null, 'is_active' => '1']));
		
		$peminjaman = count($this->db->get_where('transaksi_peminjaman', ['DATE(created_date)' => date('Y-m-d')])->result());
		$transaksi  = count($this->MJenisBiaya->get(['DATE(created_date)' => date('Y-m-d')]));

		$globalCost 	= $this->MReport->globalCostTahun("2022");
		$costPerArea 	= $this->MReport->globalCostTahunArea("Jombang");

		$data = [
			'title' => "admin",
			'GlobalCost' => $dataGlobalCost,
			'DaftarKendaraan' => $dataDaftarKendaraan,
			'JmlKendaraan' => $jmlKendaraan,
			'JmlPengajuan' => ((int)$peminjaman + (int)$transaksi),
			'saldo'	=> $dataSaldo,
			'GlobalCost' => $globalCost,
			'CostPerArea' => $costPerArea
		];

		$this->template->index('admin/dashboard_management', $data);
		$this->load->view('_components/sideNavigation', $data);
    }
	public function setSaldo(){
		$this->db->update('balance', ['balance' => str_replace(',', '', $_POST['balance'])]);
		redirect('management');
	}
}