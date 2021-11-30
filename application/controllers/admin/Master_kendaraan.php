<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master_kendaraan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('user_role'))) {
            redirect('/');
        }

        $this->load->helper(array('form', 'url', 'date'));
        $this->load->library('form_validation');
        $this->load->model('M_kendaraan_master');
    }

    public function aksiTambahKendaraan()
    {
        //get foto
        $config['upload_path'] = './assets/images/fotokendaraan';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '2048';  //2MB max
        $config['max_width'] = '4480'; // pixel
        $config['max_height'] = '4480'; // pixel
        $config['file_name'] = $_FILES['foto']['name'];

        $this->upload->initialize($config);

        $data_lama = $this->db->get_where("master_kendaraan", array('kendaraan_no_rangka' => $this->input->post('rangka')))->row_array();

        if (!empty($_FILES['foto']['name'])) {
            if ($this->upload->do_upload('foto')) {
                $fotokendaraan = $this->upload->data();
                $data = array(
                    'kendaraan_no_rangka'         => $this->input->post('rangka'),
                    'kendaraan_stnk'             => $this->input->post('stnk'),
                    'kendaraan_merk'             => $this->input->post('merk'),
                    'kendaraan_tanggal_beli'     => $this->input->post('tanggal'),
                    'kendaraan_foto'            => $fotokendaraan['file_name']
                );

                $this->db->query("CALL disable_kendaraan('".$data_lama['kendaraan_no_rangka']."')");
                $query = $this->db->insert('master_kendaraan', $data);
                if ($query = true) {
                    $this->session->set_flashdata('inserted', 'Yess');
                    redirect('admin/master_kendaraan');
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
        redirect('admin/Admin/master_kendaraan');
    }

    public function updateKendaraan()
    {
        $kendaraan_no_rangka = $this->input->post('kendaraan_no_rangka');
        $config['upload_path'] = './assets/images/fotokendaraan';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '2048';  //2MB max
        $config['max_width'] = '4480'; // pixel
        $config['max_height'] = '4480'; // pixel

        $this->load->library('upload', $config);
        if (! $this->upload->do_upload('kendaraan_foto')) {
            $kendaraan_stnk = $this->input->post('kendaraan_stnk', TRUE);
            $kendaraan_merk = $this->input->post('kendaraan_merk', TRUE);
            $kendaraan_tanggal_beli = $this->input->post('kendaraan_tanggal_beli', TRUE);

            $data = array(
                'kendaraan_stnk' => $kendaraan_stnk,
                'kendaraan_merk' => $kendaraan_merk,
                'kendaraan_tanggal_beli' => $kendaraan_tanggal_beli,
            );

            $this->db->where('kendaraan_no_rangka', $kendaraan_no_rangka);
            $this->db->update('master_kendaraan', $data);
            $this->session->set_flashdata('inserted', 'Yess');
            // redirect('admin/master_kendaraan');
            $test = $this->db->last_query();
            echo $test;
        } else {
            $kendaraan_foto = $this->upload->data();
            $kendaraan_foto = $kendaraan_foto['file_name'];
            $kendaraan_stnk = $this->input->post('kendaraan_stnk', TRUE);
            $kendaraan_merk = $this->input->post('kendaraan_merk', TRUE);
            $kendaraan_tanggal_beli = $this->input->post('kendaraan_tanggal_beli', TRUE);

            $data = array(
                'kendaraan_stnk' => $kendaraan_stnk,
                'kendaraan_merk' => $kendaraan_merk,
                'kendaraan_tanggal_beli' => $kendaraan_tanggal_beli,
                'kendaraan_foto' => $kendaraan_foto,
            );

            $this->db->where('kendaraan_no_rangka', $kendaraan_no_rangka);
            $this->db->update('master_kendaraan', $data);
            $this->session->set_flashdata('inserted', 'Yess');
            // redirect('admin/master_kendaraan');
            $test = $this->db->last_query();
            echo $test;
        }

        // $rangka = $this->input->post('kendaraan_no_rangka');
        // $config['upload_path'] = './assets/images/fotokendaraan';
        // $config['allowed_types'] = 'jpg|png|jpeg';
        // $config['max_size'] = '2048';  //2MB max
        // $config['max_width'] = '4480'; // pixel
        // $config['max_height'] = '4480'; // pixel
        // $config['file_name'] = $_FILES['foto']['name'];

        // $this->upload->initialize($config);

        // if (!empty($_FILES['foto']['name'])) {
        //     if ($this->upload->do_upload('foto')) {
        //         $fotokendaraan = $this->upload->data();
        //         $data = array(
        //             'kendaraan_no_rangka'         => $this->input->post('kendaraan_no_rangka'),
        //             'kendaraan_stnk'             => $this->input->post('kendaraan_stnk'),
        //             'kendaraan_merk'             => $this->input->post('kendaraan_merk'),
        //             'kendaraan_tanggal_beli'     => $this->input->post('kendaraan_tanggal_beli'),
        //             'kendaraan_foto'            => $fotokendaraan['file_name']
        //         );

                
        //         $query = $this->db->where('rangka', $rangka)->update('master_kendaraan', $data);
        //         if ($query = true) {
        //             $this->session->set_flashdata('inserted', 'Yess');
        //             redirect('admin/master_kendaraan');
        //         }
        //     } else {
        //         $data = array(
        //             'kendaraan_no_rangka'         => $this->input->post('kendaraan_no_rangka'),
        //             'kendaraan_stnk'             => $this->input->post('kendaraan_stnk'),
        //             'kendaraan_merk'             => $this->input->post('kendaraan_merk'),
        //             'kendaraan_tanggal_beli'     => $this->input->post('kendaraan_tanggal_beli')
        //         );

        //         $query = $this->db->where('rangka', $rangka)->update('master_kendaraan', $data);
        //         if ($query = true) {
        //             $this->session->set_flashdata('inserted', 'Yess');
        //             redirect('admin/master_kendaraan');
        //         }
        //     }
        // } else {
        // }
    }
}
