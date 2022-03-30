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
		$globalCost 		 = $this->MReport->globalCostArea();
		$daftarKendaraan	 = $this->MKendaraan->get(['disabled_date' => null, 'is_active' => 1]);

		$data = [
			'title' => "admin",
			'GlobalCost' => $globalCost,
			'DaftarKendaraan' => $daftarKendaraan,
			'DaftarWilayah' => $wilayah,
			'reportUpdated' => $this->db->get('report_update')->row()
		];

		$this->template->index('admin/dashboard', $data);
		$this->load->view('_components/sideNavigation', $data);
    }
	public function updateReport(){
        $this->load->model('MReport');
        $this->db->empty_table('report_transaksi');
        $vReportTrans = $this->db->get('v_report_temp')->result_array();
        $this->db->insert_batch('report_transaksi', $vReportTrans);
		$this->db->update('report_update', ['updated_at' => date('Y-m-d H:i:s')]);
		redirect('admin');
	}
}
