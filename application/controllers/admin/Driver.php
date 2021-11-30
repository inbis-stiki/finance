<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Driver extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('user_role'))) {
            redirect('/');
        }

        $this->load->helper(array('form', 'url', 'date'));
        $this->load->library('form_validation');
        $this->load->model('M_Driver');
    }

    public function aksiTambahDriver()
    {
        //get foto
        $config['upload_path'] = './assets/images/fotodriver';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '2048';  //2MB max
        $config['max_width'] = '4480'; // pixel
        $config['max_height'] = '4480'; // pixel
        $config['file_name'] = $_FILES['foto']['name'];

        $this->upload->initialize($config);

        if (!empty($_FILES['foto']['name'])) {
            if ($this->upload->do_upload('foto')) {
                $fotodriver = $this->upload->data();
                $data = [
                    'driver_nik'              => $this->input->post('nik'),
                    'driver_nama'             => $this->input->post('nama'),
                    'driver_foto'             => $fotodriver['file_name'],
                    'driver_foto_ktp'         => $fotodriver['file_name'],
                    'driver_alamat'           => $this->input->post('alamat'),
                    'driver_telepon'          => $this->input->post('telepon')
                ];

                $query = $this->db->insert('master_driver', $data);
                if ($query = true) {
                    $this->session->set_flashdata('inserted', 'Yess');
                    redirect('admin/master_driver');
                }
            } else {
                die("gagal upload");
            }
        } else {
        }
    }

    function editKendaraan()
    {
        $data = [
            "kendaraan_no_rangka"        => $this->input->post('kendaraan_no_rangka'),
            "kendaraan_stnk"             => $this->input->post('kendaraan_stnk'),
            "kendaraan_merk"             => $this->input->post('kendaraan_merk'),
            "kendaraan_tanggal_beli"     => $this->input->post('kendaraan_tanggal_beli')
        ];

        $this->M_kendaraan_master->editKendaraan($data);

        // $rangka = $this->input->post('kendaraan_no_rangka');
        // $stnk = $this->input->post('kendaraan_stnk');
        // $merk = $this->input->post('kendaraan_merk');
        // $tanggal = $this->input->post('kendaraan_tanggal_beli');
        // $this->M_region->editRegion($rangka, $stnk, $merk, $tanggal);
        redirect('admin/master_kendaraan');
    }

    public function aksiHapus()
    {
        $data = [
            "driver_nik"    => $this->input->post('driver_nik'),
            "deleted_date"  => date('Y-m-d H:i:s')
        ];

        $this->M_Driver->editDriver($data);

        redirect('admin/master_driver');
    }
}
