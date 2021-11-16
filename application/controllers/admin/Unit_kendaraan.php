<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Unit_kendaraan extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('M_kendaraan', 'model');
    }

    public function index(){
        $data=array();
        $this->load->view('admin/pencatatan/unit_kendaraan', $data);
    }

    public function add_kendaraan(){
        


        // $this->load->model('M_kendaraan', 'model');
        $this->model->tambah();
        // $instansi = $this->input->post('instansi');
        // $jenis_instansi = $this->input->post('jenis_instansi');
        // $stnk = $this->input->post('stnk');
        // $rangka = $this->input->post('rangka');
        // $merk = $this->input->post('merk');
        // $tanggal = $this->input->post('tanggal');
        // $kota = $this->input->post('kota');

        
        redirect('admin/form_pengajuan/unit_kendaraan');
        
    }
}

?>