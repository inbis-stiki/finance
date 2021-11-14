<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

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
