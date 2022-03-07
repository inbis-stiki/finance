<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dropdown extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('isMaster') != '1') {
            redirect('/');
        }
        $this->load->library('form_validation');
        $this->load->library('table');
        $this->load->model('MDropdown');
    }

    public function index()
    {

        $dataDropdownWil     = $this->MDropdown->get(['dropdown_menu' => 'Wilayah', 'deleted_date' => NULL]);
        $dataDropdownSIM     = $this->MDropdown->get(['dropdown_menu' => 'SIM', 'deleted_date' => NULL]);
        $dataDropdownPT     = $this->MDropdown->get(['dropdown_menu' => 'PT', 'deleted_date' => NULL]);
        $dataDropdownJenKen = $this->MDropdown->get(['dropdown_menu' => 'Jenis Kendaraan', 'deleted_date' => NULL]);
        $dataDropdownJenSpa = $this->MDropdown->get(['dropdown_menu' => 'Jenis Sparepart', 'deleted_date' => NULL]);

        $data = [
            'title' => "admin",
            'Dropdown' => $dataDropdownWil,
            'SIM' => $dataDropdownSIM,
            'PT' => $dataDropdownPT,
            'JenKen' => $dataDropdownJenKen,
            'JenSpa' => $dataDropdownJenSpa,
        ];

        $this->template->index('admin/master_dropdown', $data);
        $this->load->view('_components/sideNavigation', $data);
    }

    public function store()
    {
        $data = [
            "dropdown_menu"      => $_POST['menu'],
            "dropdown_list"      => $_POST['list'],
            "created_date"       => date('Y-m-d H:i:s')
        ];

        $this->MDropdown->insert($data);
        $this->session->set_flashdata('sukses', "Data Berhasil Disimpan");
        redirect('master/dropdown');
    }

    function update()
    {
        $data = [
            "dropdown_id"        => $_POST['dropdown_id'],
            "dropdown_menu"      => $_POST['menu'],
            "dropdown_list"      => $_POST['list']
        ];

        $this->MDropdown->update($data);
        redirect('master/dropdown');
    }

    public function destroy()
    {
        $data = [
            "dropdown_id"   => $this->input->post('dropdown_id'),
            "deleted_date"  => date('Y-m-d H:i:s')
        ];

        $this->MDropdown->update($data);
        redirect('master/dropdown');
    }
}
