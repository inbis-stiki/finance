<?php

class Dashboard extends CI_Controller{
    public function __construct(){
        parent::__construct();
		if($this->session->userdata('isManagement') != '1'){
			redirect('/');
		}
		$this->load->library('table');
		$this->load->library('dateformat');
        $this->load->model('M_dashboard');
		$this->load->model('MKendaraan');
		$this->load->model('MJenisBiaya');
		$this->load->model('MReport');
		$this->load->model('MDropdown');
    }
    public function index(){
		$dataSaldo	= $this->db->get('balance')->row();
		$jmlKendaraan = count($this->MKendaraan->get(['disabled_date' => null, 'is_active' => '1']));
		
		$peminjaman = count($this->db->get_where('transaksi_peminjaman', ['DATE(created_date)' => date('Y-m-d')])->result());
		$transaksi  = count($this->MJenisBiaya->get(['DATE(created_date)' => date('Y-m-d')]));

		$masterArea		= $this->MDropdown->get(['dropdown_menu' => 'Wilayah', 'deleted_date' => NULL]);
		$globalCost 	= $this->MReport->globalCostTahun(date('Y'));
		$costPerArea 	= $this->MReport->globalCostTahunArea($masterArea[0]->dropdown_list, date('Y'));
		$costSparepart	= $this->MReport->jenisBiayaSparepart(date('n'), date('Y'));
		$kendaraan		= $this->MReport->reportKendaraan();

		$masterBulan = [];
		for ($i=1; $i <= 12 ; $i++) { 
			$month = $this->dateformat->getFullMonth($i);
			array_push($masterBulan, $month);
		}

		$data = [
			'title' => "admin",
			'JmlKendaraan' => $jmlKendaraan,
			'JmlPengajuan' => ((int)$peminjaman + (int)$transaksi),
			'saldo'	=> $dataSaldo,
			'GlobalCost' => $globalCost,
			'CostPerArea' => $costPerArea,
			'CostSparepart' => $costSparepart,
			'Kendaraan' => $kendaraan,
			'masterArea' =>  $masterArea,
			'masterBulan' => $masterBulan
		];

		$this->template->index('admin/dashboard_management', $data);
		$this->load->view('_components/sideNavigation', $data);
    }
	public function setSaldo(){
		$this->db->update('balance', ['balance' => str_replace(',', '', $_POST['balance'])]);
		redirect('management');
	}
	public function costKendaraan($noRangka, $noSTNK){
		$noRangka 	= str_replace('_', ' ', $noRangka);
		$noSTNK 	= str_replace('_', ' ', $noSTNK);

		$administrasi 	= $this->MReport->costAdministrasi($noRangka, $noSTNK);
		$maintenance 	= $this->MReport->costMaintenance($noRangka, $noSTNK);
		$bbm 			= $this->MReport->costBBM($noRangka, $noSTNK);
		$driver 		= $this->MReport->costDriver($noRangka, $noSTNK);
		$lain 			= $this->MReport->costLain($noRangka, $noSTNK);

		$data = [
			'title' => "admin",
			'noSTNK' => $noSTNK,
			'administrasi' => $administrasi,
			'maintenance' => $maintenance,
			'bbm' => $bbm,
			'driver' => $driver,
			'lain' => $lain,
		];

		$this->template->index('admin/cost_kendaraan', $data);
		$this->load->view('_components/sideNavigation', $data);
	}
	public function ajxUpdateGlobalCost(){
		$globalCost	= $this->MReport->globalCostTahun($_POST['year']);

		echo json_encode($globalCost);
	}
	public function ajxUpdateCostArea(){
		$costPerArea = $this->MReport->globalCostTahunArea($_POST['area'], $_POST['year']);

		echo json_encode($costPerArea);
	}
	public function ajxUpdateJenisBiayaSparepart(){
		$costJenisBiayaSparepart = $this->MReport->jenisBiayaSparepart($_POST['month'], $_POST['year']);

		echo json_encode($costJenisBiayaSparepart);
	}
	public function ajxUpdateSparepart(){
		$draw   = $_POST['draw'];
        $offset = $_POST['start'];
        $limit  = $_POST['length']; // Rows display per page
        $search = $_POST['search']['value'];
        
        $report = $this->MReport->reportSparepart(['year' => $_POST['year'], 'month' => $_POST['month'], 'offset' => $offset, 'limit' => $limit]);
        $datas = array();
        foreach ($report['records'] as $item) {
            $datas[] = array( 
				'detail' => $item->sparepart_nama,
                'jumlah' => number_format((int)$item->sparepart_total)
            );
        }

        $response = array(
            "draw" => intval($draw),
            "recordsTotal" => $report['totalRecords'],
            "recordsFiltered" => ($search != "" ? $report['totalDisplayRecords'] : $report['totalRecords']),
            "aaData" => $datas
        );

        echo json_encode($response);
	}
}