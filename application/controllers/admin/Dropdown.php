<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dropdown extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('user_role'))) {
            redirect('/');
        }

        $this->load->library('form_validation');
        $this->load->model('M_Dropdown');
    }

    public function aksiTambahDropdown()
    {
        $data = [
            "dropdown_menu"      => $_POST['menu'],
            "dropdown_list"      => $_POST['list'],
            "created_date"       => date('Y-m-d H:i:s')
        ];

        $this->db->insert('master_dropdown', $data);
        $this->session->set_flashdata('sukses', "Data Berhasil Disimpan");

        //$this->M_Sparepart->insert($sparepart_nama, $sparepart_km, $sparepart_bulan);
        redirect('admin/master_dropdown');
    }

    function aksiEditDropdown()
    {
        $data = [
            "dropdown_id"        => $_POST['dropdown_id'],
            "dropdown_menu"      => $_POST['menu'],
            "dropdown_list"      => $_POST['list']
        ];

        $this->M_Dropdown->editDropdown($data);

        redirect('admin/master_dropdown');
    }

    public function aksiHapus()
    {
        $data = [
            "dropdown_id"   => $this->input->post('dropdown_id'),
            "deleted_date"  => date('Y-m-d H:i:s')
        ];

        $this->M_Dropdown->editDropdown($data);

        redirect('admin/master_dropdown');
    }
}
