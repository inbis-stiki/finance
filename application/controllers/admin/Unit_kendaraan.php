<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Unit_kendaraan extends CI_Controller{
    public function index(){
        $this->load->view('admin/pencatatan/unit_kendaraan');
    }

    public function add_kendaraan(){
        $this->load->model(['M_kendaraan', 'model', 'M_region']);
        $this->model->tambah();
        $instansi = $this->input->post('instansi');
        $jenis_instansi = $this->input->post('jenis_instansi');
        $stnk = $this->input->post('stnk');
        $rangka = $this->input->post('rangka');
        $merk = $this->input->post('merk');

        $kota = $this->M_region->get();

        $data['groups'] = $this->M_kendaraan->getAllGroups();
        // var_dump($instansi);
        // var_dump($rangka);
        $data = array(
            'kota' => $kota
        );
        }
    }
}
?>