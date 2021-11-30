<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Instansi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('user_role'))) {
            redirect('/');
        }

        $this->load->library('form_validation');
        $this->load->model('M_Instansi');
    }

    public function aksiTambahInstansi()
    {
        $jenis = $this->input->post('jenis');

        if ($jenis == 'bumn') {
            $data = [

                "instansi_nama"     => $_POST['nama'],
                "instansi_jenis"    => 'BUMN'
            ];
        } else {
            $data = [

                "instansi_nama"     => $_POST['nama'],
                "instansi_jenis"    => 'Non BUMN'
            ];
        }

        $this->db->insert('master_instansi', $data);
        $this->session->set_flashdata('sukses', "Data Berhasil Disimpan");

        //$this->M_Sparepart->insert($sparepart_nama, $sparepart_km, $sparepart_bulan);
        redirect('admin/master_instansi');
    }

    function aksiEditInstansi()
    {
        $data = [
            "instansi_id"       => $this->input->post('instansi_id'),
            "instansi_nama"     => $this->input->post('instansi'),
            "instansi_jenis"    => $this->input->post('jenis')
        ];

        $this->M_Instansi->editInstansi($data);

        redirect('admin/master_instansi');
    }

    public function aksiHapus()
    {
        $data = [
            "instansi_id"       => $this->input->post('instansi_id'),
            "deleted_date"  => date('Y-m-d H:i:s')
        ];

        $this->M_Instansi->editInstansi($data);

        redirect('admin/master_instansi');
    }
}
