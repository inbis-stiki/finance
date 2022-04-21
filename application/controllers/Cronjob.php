<?php

class Cronjob extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('MReport');
    }
    public function JobReport(){
        $this->db->empty_table('report_transaksi');
        $vReportTrans = $this->db->get('v_report_temp')->result_array();
        $this->db->insert_batch('report_transaksi', $vReportTrans);
		$this->db->update('report_update', ['updated_at' => date('Y-m-d H:i:s')]);
    }
    public function JobNotif(){
        $nextWeekDate = date('Y-m-d', strtotime('+7 days'));
        $this->db->set('kendaraan_isnotifstnk', 1);
        $this->db->where(['is_active' => 1, 'disabled_date' => NULL, 'kendaraan_isnotifstnk' => 0, 'kendaraan_deadlinestnk <= ' => $nextWeekDate]);
        
        $this->db->update('master_kendaraan');

        $this->db->set('kendaraan_isnotifkir', 1);
        $this->db->where(['is_active' => 1, 'disabled_date' => NULL, 'kendaraan_isnotifkir' => 0, 'kendaraan_deadlinekir <= ' => $nextWeekDate]);
        $this->db->update('master_kendaraan');
    }
}