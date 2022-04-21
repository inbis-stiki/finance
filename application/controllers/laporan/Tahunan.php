<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tahunan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('isManagement') != '1'){
			redirect('/');
		}
		$this->load->library('table');
    }
    public function index(){

		$data = [
			'title' => "Laporan"
		];

		$this->template->index('admin/laporan_tahunan', $data);
		$this->load->view('_components/sideNavigation', $data);
    }
}