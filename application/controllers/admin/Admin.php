<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (empty($this->session->userdata('user_role'))) {
			redirect('/');
		}

		$this->load->library('table');
		$this->load->model('m_region');
	}

	public function index()
	{
		$this->load->model('M_User');
		$datauser = $this->M_User->getUser();

		$data = [
			'title' => "admin",
			'auth' => $this->db->get_where('master_user', ['username' => $this->session->userdata('username')])->row_array()
		];

		$this->template->index('admin/dashboard', $data);
		$this->load->view('_components/sideNavigation', $data);
	}

	public function master_sparepart()
	{
		$this->load->model('M_User');
		$this->load->model('M_Sparepart');
		$dataPart = $this->M_Sparepart->getSparepart();

		$data = [
			'title' => "admin",
			'Sparepart' => $dataPart,
			'auth' => $this->db->get_where('master_user', ['username' => $this->session->userdata('username')])->row_array()
		]; // PLACEHOLDER VARIABLE DATA

		$this->template->index('admin/master_sparepart', $data);
		$this->load->view('_components/sideNavigation', $data);
	}

	public function master_region()
	{
		$this->load->model('M_User');
		$this->load->model('M_region');
		$dataRegion = $this->M_region->getRegion();

		$data = [
			'title' => "admin",
			'Region' => $dataRegion,
			'auth' => $this->db->get_where('master_user', ['username' => $this->session->userdata('username')])->row_array()
		];

		$this->template->index('admin/master_region', $data);
		$this->load->view('_components/sideNavigation', $data);
	}

	public function master_kendaraan()
	{
		$this->load->model('M_User');
		$this->load->model('M_kendaraan_master');
		$dataKendaraan = $this->M_kendaraan_master->getKendaraan();

		$data = [
			'title' => "admin",
			'Kendaraan' => $dataKendaraan,
			'auth' => $this->db->get_where('master_user', ['username' => $this->session->userdata('username')])->row_array()
		];

		$this->template->index('admin/master_kendaraan', $data);
		$this->load->view('_components/sideNavigation', $data);
	}

	public function tambah_kendaraan()
	{
		$this->load->model('M_User');
		$this->load->model('M_add_kendaraan');

		$datakota = $this->M_add_kendaraan->getData();
		$datakendaraan = $this->M_add_kendaraan->getKendaraan();
		$datainstansi = $this->M_add_kendaraan->getInstansi();

		$data = [
			'title' => "admin",
			'auth' => $this->db->get_where('master_user', ['username' => $this->session->userdata('username')])->row_array(),
			'datakota' => $datakota,
			'datakendaraan' => $datakendaraan,
			'datainstansi' => $datainstansi
		];

		$this->template->index('admin/add_kendaraan', $data);
		$this->load->view('_components/sideNavigation', $data);	}

	public function form_pengajuan()
	{
		$this->load->model('M_User');

		$data = [
			'title' => "admin",
			'auth' => $this->db->get_where('master_user', ['username' => $this->session->userdata('username')])->row_array()
		];

		$this->template->index('admin/form_pengajuan', $data);
		$this->load->view('_components/sideNavigation', $data);
	}

	public function unit_kendaraan()
	{
		$this->load->model('M_User');
		$this->load->model('M_kendaraan');

		$datakota = $this->M_kendaraan->getData();
		$datakendaraan = $this->M_kendaraan->getKendaraan();
		$datainstansi = $this->M_kendaraan->getInstansi();

		$data = [
			'title' => "admin",
			'auth' => $this->db->get_where('master_user', ['username' => $this->session->userdata('username')])->row_array(),
			'datakota' => $datakota,
			'datakendaraan' => $datakendaraan,
			'datainstansi' => $datainstansi
		];

		$this->template->index('admin/pencatatan/unit_kendaraan', $data);
		$this->load->view('_components/sideNavigation', $data);
	}

	public function jenis_biaya()
	{
		$this->load->model('M_User');

		$data = [
			'title' => "admin",
			'auth' => $this->db->get_where('master_user', ['username' => $this->session->userdata('username')])->row_array()
		];

		$this->template->index('admin/pencatatan/jenis_biaya', $data);
		$this->load->view('_components/sideNavigation', $data);
	}

	public function master_instansi()
	{
		$this->load->model('M_User');
		$this->load->model('M_Instansi');
		$dataInstansi = $this->M_Instansi->getInstansi();

		$data = [
			'title' => "admin",
			'Instansi' => $dataInstansi,
			'auth' => $this->db->get_where('master_user', ['username' => $this->session->userdata('username')])->row_array()
		];

		$this->template->index('admin/master_instansi', $data);
		$this->load->view('_components/sideNavigation', $data);
	}

	public function master_pengeluaran()
	{
		$this->load->model('M_User');
		$this->load->model('M_Pengeluaran');
		$dataPengeluaran = $this->M_Pengeluaran->getPengeluaran();

		$data = [
			'title' => "admin",
			'Pengeluaran' => $dataPengeluaran,
			'auth' => $this->db->get_where('master_user', ['username' => $this->session->userdata('username')])->row_array()
		];

		$this->template->index('admin/master_pengeluaran', $data);
		$this->load->view('_components/sideNavigation', $data);
	}
}
