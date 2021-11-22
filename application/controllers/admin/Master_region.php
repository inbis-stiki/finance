<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master_region extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('user_role'))) {
            redirect('/');
        }

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->model('M_region');
    }

    public function aksiTambahRegion()
    {
        $data = [
            "region_kota"    => $_POST['kota']
        ];

        $this->db->insert('master_region', $data);
        $this->session->set_flashdata('sukses', "Data Berhasil Disimpan");

        //$this->M_Sparepart->insert($sparepart_nama, $sparepart_km, $sparepart_bulan);
        redirect('admin/Admin/master_region');
    }

    function editRegion()
    {
        $id = $this->input->post('region_id');
        $kota = $this->input->post('region_kota');
        $this->M_region->editRegion($kota, $id);
        redirect('admin/Admin/master_region');
    }
}
