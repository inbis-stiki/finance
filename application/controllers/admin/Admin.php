<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

	function __construct(){
        parent::__construct();
        $this->load->model('m_region');
    }

	public function index()
	{
		$data['title']  = 'admin'; // PLACEHOLDER VARIABLE DATA

		$this->template->index('admin/dashboard', $data);
	}

	public function master_sparepart()
	{
		$data['title']  = 'admin'; // PLACEHOLDER VARIABLE DATA

		$this->template->index('admin/master_sparepart', $data);
	}

	public function master_region()
	{
		$data['title']  = 'admin'; // PLACEHOLDER VARIABLE DATA

		$this->data['region']=$this->m_region->get_region('master_region');

		$this->template->index('admin/master_region', $this->data);
	}

	public function form_pengajuan()
	{
		$data['title']  = 'admin'; // PLACEHOLDER VARIABLE DATA

		$this->template->index('admin/form_pengajuan', $data);
	}

	public function unit_kendaraan()
	{
		$data['title']  = 'admin'; // PLACEHOLDER VARIABLE DATA

		$this->template->index('admin/pencatatan/unit_kendaraan', $data);
	}

	public function jenis_biaya()
	{
		$data['title']  = 'admin'; // PLACEHOLDER VARIABLE DATA

		$this->template->index('admin/pencatatan/jenis_biaya', $data);
	}
}
