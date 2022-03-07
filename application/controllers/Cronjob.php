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
    }
}