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
<<<<<<< Updated upstream
            "sparepart_nama"    => $_POST['jenis'],
            "sparepart_km"       => $_POST['ideal'],
            "sparepart_bulan"    => $_POST['ideal']
=======
            "sparepart_nama"     => $_POST['jenis'],
            "sparepart_km"       => $_POST['km-txt'],
            "sparepart_bulan"    => $_POST['bulan-txt']
>>>>>>> Stashed changes
        ];

        $this->db->insert('master_sparepart', $data);
        $this->session->set_flashdata('sukses', "Data Berhasil Disimpan");

        //$this->M_Sparepart->insert($sparepart_nama, $sparepart_km, $sparepart_bulan);
        redirect('admin/Admin/master_sparepart');
    }
<<<<<<< Updated upstream
=======

    function aksiEditPart()
    {
        $data = [
            "sparepart_id"       => $this->input->post('sparepart_id'),
            "sparepart_nama"     => $this->input->post('jenis2'),
            "sparepart_km"       => $this->input->post('km-txt2'),
            "sparepart_bulan"    => $this->input->post('bulan-txt2')
        ];

        $this->M_Sparepart->editPart($data);

        redirect('admin/Admin/master_sparepart');
    }
>>>>>>> Stashed changes
}
