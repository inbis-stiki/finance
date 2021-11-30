<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tambah_kendaraan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('user_role'))) {
            redirect('/');
        }

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->model('M_add_kendaraan', 'model');
    }

    public function index()
    {
        $data = array();
        $this->load->view('admin/master_kendaraan/add_kendaraan', $data);
    }

    public function aksiTambahKendaraan()
    {
        //get foto
        $config['upload_path'] = './assets/images/fotokendaraan';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '2048';  //2MB max
        $config['max_width'] = '4480'; // pixel
        $config['max_height'] = '4480'; // pixel
        // $config['file_name'] = $_FILES['foto']['name'];

        // var_dump($_FILES['foto']);
        // echo json_encode($_FILES['foto']['name']);
        // die;
        $fotokendaraan = json_encode($_FILES['foto']['name']);
        $files = $_FILES['foto'];

        $this->upload->initialize($config);

        $data_lama = $this->db->get_where("master_kendaraan", array('kendaraan_no_rangka' => $this->input->post('rangka')))->row_array();

        foreach ($files['name'] as $key => $image) {
            $_FILES['images[]']['name'] = $files['name'][$key];
            $_FILES['images[]']['type'] = $files['type'][$key];
            $_FILES['images[]']['tmp_name'] = $files['tmp_name'][$key];
            $_FILES['images[]']['error'] = $files['error'][$key];
            $_FILES['images[]']['size'] = $files['size'][$key];

            $fileName = $image;

            $images[] = $fileName;

            $config['file_name'] = $fileName;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('images[]')) {
                $tmpdata = $this->upload->data();
                // $fotokendaraan .= $tmpdata['file_name'] . ", ";
            } else {
                return false;
            }
        }
        $data = array(
            'kendaraan_no_rangka'         => $this->input->post('rangka'),
            'kendaraan_stnk'             => $this->input->post('stnk'),
            'kendaraan_merk'             => $this->input->post('merk'),
            'kendaraan_tanggal_beli'     => $this->input->post('tanggal'),
            'kendaraan_foto'            => $fotokendaraan
        );

        $this->db->query("CALL disable_kendaraan('" . $data_lama['kendaraan_no_rangka'] . "')");
        $query = $this->db->insert('master_kendaraan', $data);
        if ($query = true) {
            $this->session->set_flashdata('inserted', 'Yess');
            redirect('admin/master_kendaraan');
        }

        // if (!empty($_FILES['foto']['name'])) {
        //     if ($this->upload->do_upload("foto[]")) {
        //         // $fotokendaraan = $this->upload->data();
        //         // $data = array(
        //         //     'kendaraan_no_rangka'         => $this->input->post('rangka'),
        //         //     'kendaraan_stnk'             => $this->input->post('stnk'),
        //         //     'kendaraan_merk'             => $this->input->post('merk'),
        //         //     'kendaraan_tanggal_beli'     => $this->input->post('tanggal'),
        //         //     'kendaraan_foto'            => $fotokendaraan['file_name']
        //         // );

        //         // $this->db->query("CALL disable_kendaraan('".$data_lama['kendaraan_no_rangka']."')");
        //         // $query = $this->db->insert('master_kendaraan', $data);
        //         // if ($query = true) {
        //         //     $this->session->set_flashdata('inserted', 'Yess');
        //         //     redirect('admin/master_kendaraan');
        //         // }
        //     } else {
        //         die("gagal upload");
        //     }
        // } else {
        // }
    }
}
