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
		$this->load->model('M_Driver');
	}

	public function index()
	{
		$this->load->model('M_User');
		$this->load->model('M_dashboard');
		$datauser = $this->M_User->getUser();
		$dataDaftarKendaraan = $this->M_dashboard->getDaftarKendaraan();
		$dataGlobalCost = $this->M_dashboard->getGlobalCost();

		$data = [
			'title' => "admin",
			'GlobalCost' => $dataGlobalCost,
			'DaftarKendaraan' => $dataDaftarKendaraan,
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
		$this->load->view('_components/sideNavigation', $data);
	}

	public function ubah_kendaraan($id)
	{
		$this->load->model('M_User');
		$this->load->model('M_kendaraan_master');
		$dataEdit = $this->M_kendaraan_master->getById($id);



		$data = [
			'title' => "admin",
			'auth' => $this->db->get_where('master_user', ['username' => $this->session->userdata('username')])->row_array(),
			'kendaraan' => $dataEdit
		];


		$this->template->index('admin/edit_kendaraan', $data);
		$this->load->view('_components/sideNavigation', $data);
	}


	public function ubah_stnk($id)
	{
		$this->load->model('M_User');
		$this->load->model('M_kendaraan_master');
		$dataEdit = $this->M_kendaraan_master->getById($id);



		$data = [
			'title' => "admin",
			'auth' => $this->db->get_where('master_user', ['username' => $this->session->userdata('username')])->row_array(),
			'kendaraan' => $dataEdit
		];


		$this->template->index('admin/edit_stnk', $data);
		$this->load->view('_components/sideNavigation', $data);
	}


	public function tambah_driver()
	{

		$dataSIM = $this->M_Driver->getsims();

		$data['title'] = 'admin';
		$data['Sim'] = $dataSIM;
		$data['auth'] = $this->db->get_where('master_user', ['username' => $this->session->userdata('username')])->row_array();

		$this->template->index('admin/add_driver', $data);
		$this->load->view('_components/sideNavigation', $data);
	}

	public function ubah_driver($id)
	{
		$dataSIM = $this->M_Driver->getSIM($id);

		$data['title'] = 'admin';
		$data['Sim'] = $dataSIM;
		$data['auth'] = $this->db->get_where('master_user', ['username' => $this->session->userdata('username')])->row_array();
		$data['driver'] = $this->M_Driver->getById($id);

		$this->template->index('admin/edit_driver', $data);
		$this->load->view('_components/sideNavigation', $data);
	}

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

	public function master_klien()
	{
		$this->load->model('M_User');
		$this->load->model('M_Klien');
		$dataKlien = $this->M_Klien->getKlien();
		$dataWilayah = $this->M_Klien->getWilayah();

		$data = [
			'title' => "admin",
			'Klien' => $dataKlien,
			'Wilayah' => $dataWilayah,
			'auth' => $this->db->get_where('master_user', ['username' => $this->session->userdata('username')])->row_array()
		];

		$this->template->index('admin/master_klien', $data);
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

	public function master_driver()
	{
		$this->load->model('M_User');
		$this->load->model('M_Driver');
		$dataDriver = $this->M_Driver->getDriver();

		$data = [
			'title' => "admin",
			'Driver' => $dataDriver,
			'auth' => $this->db->get_where('master_user', ['username' => $this->session->userdata('username')])->row_array()
		];

		$this->template->index('admin/driver/master_driver', $data);
		$this->load->view('_components/sideNavigation', $data);
	}

	public function master_dropdown()
	{
		$this->load->model('M_User');
		$this->load->model('M_Dropdown');
		$dataDropdownWil = $this->M_Dropdown->getDropdownWilayah();
		$dataDropdownSIM = $this->M_Dropdown->getDropdownSIM();
		$dataDropdownPT = $this->M_Dropdown->getDropdownPT();

		$data = [
			'title' => "admin",
			'Dropdown' => $dataDropdownWil,
			'SIM' => $dataDropdownSIM,
			'PT' => $dataDropdownPT,
			'auth' => $this->db->get_where('master_user', ['username' => $this->session->userdata('username')])->row_array()
		];

		$this->template->index('admin/master_dropdown', $data);
		$this->load->view('_components/sideNavigation', $data);
	}
}
