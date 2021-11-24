<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengeluaran extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('user_role'))) {
            redirect('/');
        }

        $this->load->library('form_validation');
        $this->load->model('M_Pengeluaran');
    }

    public function aksiTambahPengeluaran()
    {
        $data = [

            "pengeluaran_jenis"     => $_POST['jenis'],
            "pengeluaran_group"     => $_POST['group']
        ];

        $this->db->insert('master_jenis_pengeluaran', $data);
        $this->session->set_flashdata('sukses', "Data Berhasil Disimpan");

        //$this->M_Sparepart->insert($sparepart_nama, $sparepart_km, $sparepart_bulan);
        redirect('admin/Admin/master_pengeluaran');
    }

    function aksiEditPengeluaran()
    {
        $data = [
            "pengeluaran_id"       => $this->input->post('pengeluaran_id'),
            "pengeluaran_jenis"     => $this->input->post('jenis'),
            "pengeluaran_group"       => $this->input->post('group')
        ];

        $this->M_Pengeluaran->editPengeluaran($data);

        redirect('admin/Admin/master_pengeluaran');
    }

    public function aksiHapus()
    {
        $data = [
            "pengeluaran_id"       => $this->input->post('pengeluaran_id'),
            "deleted_date"  => date('Y-m-d H:i:s')
        ];

        $this->M_Pengeluaran->editPengeluaran($data);

        redirect('admin/Admin/master_pengeluaran');
    }
}
