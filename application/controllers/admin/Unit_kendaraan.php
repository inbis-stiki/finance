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
            "kendaraan_no_rangka"       => $valueRangka,
            "kendaraan_stnk"            => $valueStnk,
            "client_id"                 => $_POST['instansi'],
            "transaksi_peminjaman_start"=> $_POST['tanggal_start'],
            "transaksi_peminjaman_end"  => $_POST['tanggal_end']
        ];
        $this->db->insert('transaksi_peminjaman', $data);

        $this->session->set_flashdata('sukses', "Data Berhasil Disimpan");
        
        redirect('admin/form_pengajuan/unit_kendaraan');
        
    }
}
