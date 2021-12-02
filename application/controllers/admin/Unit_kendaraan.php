<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Unit_kendaraan extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('user_role'))) {
			redirect('/');
		}

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->model('M_kendaraan', 'model');
    }

    public function index(){
        $data=array();
        $this->load->view('admin/pencatatan/unit_kendaraan', $data);
    }

    public function add_kendaraan(){
        $selectedValue = explode('|', $_POST['kendaraan']);
        $valueRangka = $selectedValue[0];
        $valueStnk = $selectedValue[1];
        $data = [
            "no_rangka_kendaraan"    => $valueRangka,
            "stnk_kendaraan"         => $valueStnk,
            "id_region"              => $_POST['kota'],
            "id_instansi"            => $_POST['instansi'],
            "tr_kendaraan_start"     => $_POST['tanggal_start'],
            "tr_kendaraan_end"       => $_POST['tanggal_end']
        ];

        $this->db->insert('transaksi_kendaraan', $data);

        $this->session->set_flashdata('sukses', "Data Berhasil Disimpan");
        
        redirect('admin/form_pengajuan/unit_kendaraan');
        
    }
}
