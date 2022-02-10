<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct(){
        parent::__construct();
		if($this->session->userdata('isAdmin') != '1'){
			redirect('/');
		}
		$this->load->library('table');
        $this->load->model('M_dashboard');
		$this->load->model('MDropdown');
		$this->load->model('MReport');
		$this->load->model('MKendaraan');
    }

    public function index(){
		$wilayah 			 = $this->MDropdown->get(['dropdown_menu' => 'Wilayah', 'deleted_date' => null]);
		$globalCost 		 = $this->MReport->globalCost();
		$daftarKendaraan	 = $this->MKendaraan->get(['disabled_date' => null, 'is_active' => 1]);

		$data = [
			'title' => "admin",
			'GlobalCost' => $globalCost,
			'DaftarKendaraan' => $daftarKendaraan,
			'DaftarWilayah' => $wilayah
		];

		$this->template->index('admin/dashboard', $data);
		$this->load->view('_components/sideNavigation', $data);
    }
}
