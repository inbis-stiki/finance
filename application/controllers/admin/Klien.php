<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Klien extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('user_role'))) {
            redirect('/');
        }

        $this->load->library('form_validation');
        $this->load->model('M_Klien');
    }

    public function aksiTambahKlien()
    {
        $jenis = $this->input->post('jenis');

        if ($jenis == 'bumn') {
            $data = [
                "client_nama"        => $_POST['nama'],
                "client_jenis"       => 'BUMN',
                "client_alamat"      => $_POST['alamat'],
                "client_contact"     => $_POST['kontak'],
                "client_npwp"        => $_POST['npwp'],
                "client_norek"       => $_POST['norek'],
                "dropdown_id"          => $_POST['group']
            ];
        } else {
            $data = [

                "client_nama"        => $_POST['nama'],
                "client_jenis"       => 'Non BUMN',
                "client_alamat"      => $_POST['alamat'],
                "client_contact"     => $_POST['kontak'],
                "client_npwp"        => $_POST['npwp'],
                "client_norek"       => $_POST['norek'],
                "dropdown_id"          => $_POST['group']
            ];
        }

        $this->db->insert('master_client', $data);
        $this->session->set_flashdata('sukses', "Data Berhasil Disimpan");

        //$this->M_Sparepart->insert($sparepart_nama, $sparepart_km, $sparepart_bulan);
        redirect('admin/master_klien');
    }

    function aksiEditKlien()
    {
        $data = [
            "client_nama"       => $this->input->post('nama'),
            "client_jenis"      => $this->input->post('jenis'),
            "client_alamat"     => $this->input->post('alamat'),
            "client_contact"    => $this->input->post('kontak'),
            "client_npwp"       => $this->input->post('npwp'),
            "client_norek"      => $this->input->post('norek'),
            "dropdown_id"         => $this->input->post('group')
        ];

        $this->M_Klien->editKlien($data);

        redirect('admin/master_klien');
    }

    public function aksiHapus()
    {
        $data = [
            "client_nama"   => $this->input->post('nama'),
            "deleted_date"  => date('Y-m-d H:i:s')
        ];

        $this->M_Klien->editKlien($data);

        redirect('admin/master_klien');
    }
}
