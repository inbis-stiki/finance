<?php

class Dashboard extends CI_Controller{
    public function __construct(){
        parent::__construct();
		if($this->session->userdata('isManagement') != '1'){
			redirect('/');
		}
		$this->load->library('table');
        $this->load->model('M_dashboard');
		$this->load->model('MKendaraan');
		$this->load->model('MJenisBiaya');
		$this->load->model('MReport');
		$this->load->model('MPengeluaran');
		$this->load->model('MDropdown');
    }
    public function index(){
		$dataSaldo	= $this->db->get('balance')->row();
		$jmlKendaraan = count($this->MKendaraan->get(['disabled_date' => null, 'is_active' => '1']));
		
		$peminjaman = count($this->db->get_where('transaksi_peminjaman', ['DATE(created_date)' => date('Y-m-d')])->result());
		$transaksi  = count($this->MJenisBiaya->get(['DATE(created_date)' => date('Y-m-d')]));

		$masterArea		= $this->MDropdown->get(['dropdown_menu' => 'Wilayah', 'deleted_date' => NULL]);
		$masterPT		= $this->MDropdown->get(['dropdown_menu' => 'PT', 'deleted_date' => NULL]);
		$globalCost 	= $this->MReport->globalCostTahun(date('Y'));
		$costPerArea 	= $this->MReport->globalCostTahunArea($masterArea[0]->dropdown_list, date('Y'));
		$costSparepart	= $this->MReport->jenisBiayaSparepart(date('n'), date('Y'));
		$jenisPengeluaran= $this->MPengeluaran->jenisPengeluaran(date('n'), date('Y'));
		$transaksiPT	= $this->MReport->transaksiPT($masterPT[0]->dropdown_list, date('Y'));
		$kendaraan		= $this->MReport->reportKendaraan();

		$masterBulan = [];
		for ($i=1; $i <= 12 ; $i++) { 
			$month = $this->getFullMonth($i);
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
			'JenisPengeluaran' => $jenisPengeluaran,
			'TransaksiPT' => $transaksiPT,
			'Kendaraan' => $kendaraan,
			'masterArea' =>  $masterArea,
			'masterBulan' => $masterBulan,
			'masterPT' => $masterPT
		];

		// print_r($transaksiPT);
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
	public function ajxUpdateJenisPengeluaran(){
		$costJenisPengeluaran = $this->MPengeluaran->jenisPengeluaran($_POST['month'], $_POST['year']);

		echo json_encode($costJenisPengeluaran);
	}
	public function ajxUpdateCostPT(){
		$costPerPT = $this->MReport->transaksiPT($_POST['pt'], $_POST['year']);

		echo json_encode($costPerPT);
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
	public function getFullMonth($param){
        switch ($param) {
            case 1:
                return 'Januari';
                break;
            case 2:
                return 'Februari';
                break;
            case 3:
                return 'Maret';
                break;
            case 4:
                return 'April';
                break;
            case 5:
                return 'Mei';
                break;
            case 6:
                return 'Juni';
                break;
            case 7:
                return 'Juli';
                break;
            case 8:
                return 'Agustus';
                break;
            case 9:
                return 'September';
                break;
            case 10:
                return 'Oktober';
                break;
            case 11:
                return 'November';
                break;
            case 12:
                return 'Desember';
                break;
            default:
                break;
        }
    }
}