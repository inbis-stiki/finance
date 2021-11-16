<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('table');
		$this->load->model('m_region');
	}

	public function index()
	{
		$data['title']  = 'admin'; // PLACEHOLDER VARIABLE DATA

		$this->template->index('admin/dashboard', $data);
	}

	public function master_sparepart()
	{
		$this->load->model('M_Sparepart');
		$dataPart = $this->M_Sparepart->getSparepart();

		$data = [
			'title' => "admin",
			'Sparepart' => $dataPart,
		]; // PLACEHOLDER VARIABLE DATA

		$this->template->index('admin/master_sparepart', $data);
	}

	public function master_region()
	{
		$this->load->model('M_region');
		$dataRegion = $this->M_region->getRegion();

		$data = [
			'title' => "admin",
			'Region' => $dataRegion,
		];

		$this->template->index('admin/master_region', $data);
	}

	public function form_pengajuan()
	{
		$data['title']  = 'admin'; // PLACEHOLDER VARIABLE DATA

		$this->template->index('admin/form_pengajuan', $data);
	}

	public function unit_kendaraan()
	{
		$this->load->model('M_kendaraan');

		$data['title']  = 'admin'; // PLACEHOLDER VARIABLE DATA

		$datakota = $this->M_kendaraan->getData();
        $data['datakota'] = $datakota;
		$this->template->index('admin/pencatatan/unit_kendaraan', $data);
		
	}

	public function jenis_biaya()
	{
		$data['title']  = 'admin'; // PLACEHOLDER VARIABLE DATA

		$this->template->index('admin/pencatatan/jenis_biaya', $data);
	}
}
