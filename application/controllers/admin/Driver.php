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
        $this->load->library('upload');
        $this->load->model('M_Driver');
        $this->load->model('MDriver');
    }

    public function vAdd()
    {
    }

    public function aksiTambahDriver()
    {
        $uploadFoto = $this->upload_image('foto');
        if ($uploadFoto['status' == false]) {
            redirect('admin/tambah_driver');
        }

        $uploadKTP = $this->upload_image('ktp');
        if ($uploadKTP['status' == false]) {
            redirect('admin/tambah_driver');
        }

        $formData['driver_nik']          = $_POST['nik'];
        $formData['driver_nama']         = $_POST['nama'];
        $formData['driver_foto']         = $uploadFoto['link'];
        $formData['driver_foto_ktp']     = $uploadKTP['link'];
        $formData['driver_alamat']       = $_POST['alamat'];
        $formData['driver_telepon']      = $_POST['telp'];
        $formData['driver_gaji']         = $_POST['gaji'];
        $formData['driver_sim']          = implode(",", $_POST['sim']);
        $formData['driver_tanggalmasuk'] = $_POST['tanggal'];

        $this->MDriver->insert($formData);
        redirect('admin/master_driver');
    }
    public function aksiUbahDriver()
    {
        if (!empty($_FILES['foto']['name'])) {
            $uploadFoto = $this->upload_image('foto');
            if ($uploadFoto['status' == false]) {
                redirect('admin/tambah_driver');
            } else {
                $formData['driver_foto'] = $uploadFoto['link'];
            }
        }

        if (!empty($_FILES['ktp']['name'])) {
            $uploadKTP = $this->upload_image('ktp');
            if ($uploadKTP['status' == false]) {
                redirect('admin/tambah_driver');
            } else {
                $formData['driver_foto_ktp'] = $uploadKTP['link'];
            }
        }


        $formData['driver_nik']         = $_POST['nik'];
        $formData['driver_nama']        = $_POST['nama'];
        $formData['driver_alamat']      = $_POST['alamat'];
        $formData['driver_telepon']     = $_POST['telp'];
        $formData['driver_gaji']         = $_POST['gaji'];
        $formData['driver_sim']         = implode(",", $_POST['sim']);

        $this->MDriver->update($formData);
        redirect('admin/master_driver');
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
    public function aksiAssign(){
        $this->load->model("MDriver");
        $kendaraan = explode('|', $_POST['kendaraan']);
        $dataStore['kendaraan_no_rangka'] = $kendaraan[0];
        $dataStore['kendaraan_stnk']      = $kendaraan[1];
        $dataStore['driver_nik']          = $_POST['driver_nik'];
        $dataStore['start_date']          = $_POST['awal'];
        $dataStore['end_date']            = $_POST['akhir'];
        $this->MDriver->insertTransKendaraan($dataStore);
        redirect('admin/master_driver');
    }

    public function aksiHapus()
    {
        $currDate = date('Y-m-d H:i:s');
        $data = [
            "driver_nik"    => $this->input->post('driver_nik'),
            "deleted_date"  => $currDate
        ];

        $this->M_Driver->editDriver($data);
        $this->db->where('driver_nik', $this->input->post('driver_nik'))->update('transaksi_driverkendaraan', ['disabled_date' => $currDate]);

        redirect('admin/master_driver');
    }

    public function upload_image($resource)
    {
        $path = './assets/images/driver/' . $resource;
        $conf['upload_path']    = $path;
        $conf['allowed_types']  = "jpg|png|jpeg|bmp";
        $conf['max_size']       = 2048;
        $conf['file_name']      = time();
        $conf['encrypt_name']   = TRUE;

        $this->upload->initialize($conf);
        if ($this->upload->do_upload($resource)) {
            $img = $this->upload->data();
            return [
                'status' => true,
                'msg'   => 'Data berhasil terupload',
                'link'  => base_url($path . '/' . $img['file_name'])
            ];
        } else {
            return [
                'status' => false,
                'msg'   => $this->upload->display_errors(),
            ];
        }
    }
}
