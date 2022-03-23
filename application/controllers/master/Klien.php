<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Klien extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('isManagement') != '1'){
			redirect('/');
		}
        $this->load->library('form_validation');
        $this->load->library('table');
        $this->load->model('MKlien');
        $this->load->model('MDropdown');
    }

    public function index(){
		$dataKlien = $this->MKlien->get(['deleted_date' => NULL]);
		$dataWilayah = $this->MDropdown->get(['dropdown_menu' => 'Wilayah', 'deleted_date' => NULL, 'orderBy' => 'dropdown_list ASC']);

		$data = [
			'title' => "admin",
			'Klien' => $dataKlien,
			'Wilayah' => $dataWilayah,
		];

		$this->template->index('admin/master_klien', $data);
		$this->load->view('_components/sideNavigation', $data);
    }

    public function store()
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
        redirect('master/klien');
    }


    public function ajxGetKlien(){
        // $id = explode('|', $_POST['id']);
        $kendaraan = $this->MKlien->getById($_POST['id']);
        echo json_encode($kendaraan);
    }

    function update()
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
        redirect('master/klien');
    }

    public function destroy()
    {
        $data = [
            "client_id"     => $this->input->post('id'),
            "deleted_date"  => date('Y-m-d H:i:s')
        ];

        $this->MKlien->update($data);
        redirect('master/klien');
    }
}
