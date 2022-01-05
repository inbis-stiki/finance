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
        $this->load->model('MKlien');
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
                "client_region"      => $_POST['group']
            ];
        } else {
            $data = [

                "client_nama"        => $_POST['nama'],
                "client_jenis"       => 'Non BUMN',
                "client_alamat"      => $_POST['alamat'],
                "client_contact"     => $_POST['kontak'],
                "client_npwp"        => $_POST['npwp'],
                "client_norek"       => $_POST['norek'],
                "client_region"      => $_POST['group']
            ];
        }

        $this->MKlien->insert($data);
        $this->session->set_flashdata('sukses', "Data Berhasil Disimpan");
        redirect('admin/master_klien');
    }


    public function ajxGetKlien(){
        // $id = explode('|', $_POST['id']);
        $kendaraan = $this->MKlien->getById($_POST['id']);
        echo json_encode($kendaraan);
    }

    function aksiEditKlien()
    {
        $data = [
            "client_id"         => $this->input->post('id'),
            "client_nama"       => $this->input->post('nama'),
            "client_jenis"      => $this->input->post('jenis'),
            "client_alamat"     => $this->input->post('alamat'),
            "client_contact"    => $this->input->post('kontak'),
            "client_npwp"       => $this->input->post('npwp'),
            "client_norek"      => $this->input->post('norek'),
            "client_region"     => $this->input->post('group')
        ];

        $this->MKlien->update($data);

        redirect('admin/master_klien');
    }

    public function aksiHapus()
    {
        $data = [
            "client_id"     => $this->input->post('id'),
            "deleted_date"  => date('Y-m-d H:i:s')
        ];

        $this->MKlien->update($data);
        redirect('admin/master_klien');
    }
}
