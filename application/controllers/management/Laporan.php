<?php

class Laporan extends CI_Controller{
    public function __construct(){
        parent::__construct();
		if($this->session->userdata('isManagement') != '1'){
			redirect('/');
		}
		$this->load->library('table');
    }

    public function laporanHarian(){

		$data = [
			'title' => "Laporan Harian"
		];

		$this->template->index('admin/laporan_harian', $data);
		$this->load->view('_components/sideNavigation', $data);
    }
    public function laporanBulanan(){

		$data = [
			'title' => "Laporan Bulanan"
		];

		$this->template->index('admin/laporan_bulanan', $data);
		$this->load->view('_components/sideNavigation', $data);
    }
    public function laporanTahunan(){

		$data = [
			'title' => "Laporan Tahunan"
		];

		$this->template->index('admin/laporan_tahunan', $data);
		$this->load->view('_components/sideNavigation', $data);
    }
}