<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sparepart extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('table');
        $this->load->model('MSparepart');

    }

    public function index(){
		$dataPart = $this->MSparepart->get(['deleted_date' => NULL]);

		$data = [
			'title' => "admin",
			'Sparepart' => $dataPart,
		]; // PLACEHOLDER VARIABLE DATA

		$this->template->index('admin/master_sparepart', $data);
		$this->load->view('_components/sideNavigation', $data);
    }

    public function store()
    {
        $data = [

            "sparepart_nama"     => $_POST['jenis'],
            "sparepart_km"       => $_POST['km-txt'],
            "sparepart_bulan"    => $_POST['bulan-txt'],
            "sparepart_ukuran"    => $_POST['ukuran'],
            "sparepart_detail"    => $_POST['detail']
        ];

        $this->MSparepart->insert($data);
        $this->session->set_flashdata('sukses', "Data Berhasil Disimpan");

        redirect('master/sparepart');
    }

    function update()
    {
        $data = [
            "sparepart_id"       => $this->input->post('sparepart_id'),
            "sparepart_nama"     => $this->input->post('jenis2'),
            "sparepart_km"       => $this->input->post('km-txt2'),
            "sparepart_bulan"    => $this->input->post('bulan-txt2'),
            "sparepart_ukuran"    => $this->input->post('ukuran2'),
            "sparepart_detail"    => $this->input->post('detail2')
        ];

        $this->MSparepart->update($data);

        redirect('master/sparepart');
    }

    public function destroy()
    {
        $data = [
            "sparepart_id"       => $this->input->post('sparepart_id'),
            "deleted_date"  => date('Y-m-d H:i:s')
        ];

        $this->MSparepart->update($data);

        redirect('master/sparepart');
    }
}
