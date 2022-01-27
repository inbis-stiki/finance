<?php

class Dashboard extends CI_Controller{
    public function __construct(){
        parent::__construct();
		if($this->session->userdata('isManagement') != '1'){
			redirect('/');
		}
		$this->load->library('table');
        $this->load->model('M_dashboard');
    }
    public function index(){
        $dataDaftarKendaraan = $this->M_dashboard->getDaftarKendaraan();
		$dataGlobalCost = $this->M_dashboard->getGlobalCost();

		$data = [
			'title' => "admin",
			'GlobalCost' => $dataGlobalCost,
			'DaftarKendaraan' => $dataDaftarKendaraan
		];

		$this->template->index('admin/dashboard_management', $data);
		$this->load->view('_components/sideNavigation', $data);
    }
}