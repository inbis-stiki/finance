<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sparepart extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('M_Sparepart');
    }

    public function aksiTambahPart()
    {
        $data = [
            "sparepart_nama"    => $_POST['jenis'],
            "sparepart_km"       => $_POST['ideal'],
            "sparepart_bulan"    => $_POST['ideal']
        ];

        $this->db->insert('master_sparepart', $data);
        $this->session->set_flashdata('sukses', "Data Berhasil Disimpan");

        //$this->M_Sparepart->insert($sparepart_nama, $sparepart_km, $sparepart_bulan);
        redirect('admin/Admin/master_sparepart');
    }
}
