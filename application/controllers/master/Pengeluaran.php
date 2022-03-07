<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengeluaran extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('isMaster') != '1'){
			redirect('/');
		}
        $this->load->library('form_validation');
        $this->load->library('table');
        $this->load->model('MPengeluaran');
    }

    public function index(){
		$dataPengeluaran = $this->MPengeluaran->get(['deleted_date' => NULL]);

		$data = [
			'title' => "admin",
			'Pengeluaran' => $dataPengeluaran,
		];

		$this->template->index('admin/master_pengeluaran', $data);
		$this->load->view('_components/sideNavigation', $data);
    }


    public function store()
    {
        $data = [

            "pengeluaran_jenis"     => $_POST['jenis'],
            "pengeluaran_group"     => $_POST['group']
        ];

        $this->MPengeluaran->insert($data);
        $this->session->set_flashdata('sukses', "Data Berhasil Disimpan");
        redirect('master/pengeluaran');
    }

    function update()
    {
        $data = [
            "pengeluaran_id"       => $this->input->post('pengeluaran_id'),
            "pengeluaran_jenis"     => $this->input->post('jenis'),
            "pengeluaran_group"       => $this->input->post('group')
        ];

        $this->MPengeluaran->update($data);

        redirect('master/pengeluaran');
    }

    public function destroy()
    {
        $data = [
            "pengeluaran_id"       => $this->input->post('pengeluaran_id'),
            "deleted_date"  => date('Y-m-d H:i:s')
        ];

        $this->MPengeluaran->update($data);

        redirect('master/pengeluaran');
    }
}
