<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Master_region extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('m_region');
    }
     
    function index(){
        $this->data['region']=$this->m_region->get_region('master_region');
        $this->load->view('admin/master_region', $this->data);

    }

    function get_data_region(){
        $results = $this->m_region->get_datatables();
        $data = [];
        $no = $_POST['start'];
        foreach ($results as $result) {
            $row = array();
            $row[] = ++$no;
            $row[] = $result->region_kota;
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->m_region->count_all(),
            "recordsFiltered" => $this->m_region->count_filtered(),
            "data" => $data,
        );
        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }

    public function addRegion()
    {
        

        // var_dump($this->input->post());
        // die;
        $nama_kota=$this->input->post('nama_kota');
        $this->m_region->simpan_region($nama_kota);
    }

    // function get_region_json(){
    //     header('Content-Type: application/json');
    //     echo $this->m_region->get_all_region();
    // }
 
    function simpan_region(){
        $nama_kota=$this->input->post('nama_kota');
        $this->m_region->simpan_region($nama_kota);
        redirect('admin/master_region');
    }

    // function edit_region(){
    //     $id=$this->input->post('region_id');
    //     $data=array(
    //         'region_kota' => $this->input->post('nama_kota')
    //     );
    //     $this->db->where('region_id', $id);
    //     $this->db->update('master_region', $data);
    //     redirect('admin/master_region');
    // }
}