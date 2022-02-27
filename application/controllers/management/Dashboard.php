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
		$dataSaldo	= $this->db->get('balance')->row();
		$jmlKendaraan = count($this->MKendaraan->get(['disabled_date' => null, 'is_active' => '1']));
		
		$peminjaman = count($this->db->get_where('transaksi_peminjaman', ['DATE(created_date)' => date('Y-m-d')])->result());
		$transaksi  = count($this->MJenisBiaya->get(['DATE(created_date)' => date('Y-m-d')]));

		$globalCost 	= $this->MReport->globalCostTahun("2022");
		$costPerArea 	= $this->MReport->globalCostTahunArea("Surabaya");
		$sparepart		= $this->MReport->reportSparepart();
		$kendaraan		= $this->MReport->reportKendaraan();

		$data = [
			'title' => "admin",
			'JmlKendaraan' => $jmlKendaraan,
			'JmlPengajuan' => ((int)$peminjaman + (int)$transaksi),
			'saldo'	=> $dataSaldo,
			'GlobalCost' => $globalCost,
			'CostPerArea' => $costPerArea,
			'Sparepart' => $sparepart,
			'Kendaraan' => $kendaraan
		];

		$this->template->index('admin/dashboard_management', $data);
		$this->load->view('_components/sideNavigation', $data);
    }
	public function setSaldo(){
		$this->db->update('balance', ['balance' => str_replace(',', '', $_POST['balance'])]);
		redirect('management');
	}
	public function costKendaraan($noRangka, $noSTNK){
		$noRangka 	= str_replace('_', ' ', $noRangka);
		$noSTNK 	= str_replace('_', ' ', $noSTNK);

		$administrasi 	= $this->MReport->costAdministrasi($noRangka, $noSTNK);
		$maintenance 	= $this->MReport->costMaintenance($noRangka, $noSTNK);
		$bbm 			= $this->MReport->costBBM($noRangka, $noSTNK);
		$driver 		= $this->MReport->costDriver($noRangka, $noSTNK);
		$lain 			= $this->MReport->costLain($noRangka, $noSTNK);

		$data = [
			'title' => "admin",
			'noSTNK' => $noSTNK,
			'administrasi' => $administrasi,
			'maintenance' => $maintenance,
			'bbm' => $bbm,
			'driver' => $driver,
			'lain' => $lain,
		];

		$this->template->index('admin/cost_kendaraan', $data);
		$this->load->view('_components/sideNavigation', $data);
	}
}