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
	public function getDataAdm($param){
        $filter = "";
        if($param['filter'] == '1'){ // getByMonth
            $filter = '
                YEAR(t.transaksi_tanggal) = "'.$param['year'].'"
                AND MONTH(t.transaksi_tanggal) = "'.$param['month'].'"
            ';
        }else if($param['filter'] == "2"){
            $filter = '
                t.transaksi_tanggal >= "'.$param['start'].'"
                AND t.transaksi_tanggal <= "'.$param['end'].'"
            ';
        }else if($param['filter'] == "3"){
            $filter = '
                t.transaksi_tanggal = "'.$param['date'].'"
            ';
        }

        return $this->db->query('
            SELECT
                t.*,
                mjp.pengeluaran_group as jenis_pengeluaran,
                mjp.pengeluaran_jenis as pengeluaran,
                SUM(t.transaksi_jumlah) as jumlah,
                SUM(t.transaksi_total) as total_biaya
            FROM transaksi t , master_jenis_pengeluaran mjp 
            WHERE
                '.$filter.'
                AND t.id_pengeluaran = mjp.pengeluaran_id
                AND mjp.pengeluaran_group = "Administrasi"
            GROUP BY 
                t.no_rangka,
                t.kendaraan_stnk,
                mjp.pengeluaran_jenis,
                t.transaksi_tanggal
            ORDER BY t.transaksi_tanggal DESC
        ')->result();
    }
}