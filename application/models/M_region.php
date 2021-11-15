<?php
class M_region extends CI_Model{

    var $table = 'master_region';
    var $column_order = array('region_id', 'region_kota');
    var $order = array('region_id', 'region_kota');

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query(){
        // $this->db->from($this->table);
        // $i = 0;
        // foreach ($this->column_search as $item) {
        //     if ($_POST['search']['value']) {
        //         if($i===0){
        //             $this->db->group_start();
        //             $this->db->like($item, $_POST['search']['value']);
        //         }else {
        //             $this->db->or_like($item, $_POST['search']['value']);
        //         }
        //         if (count($this->column_search) - 1 == $i) {
        //             $this->db->group_end();
        //         }
        //     }
        //     $i++;
        // }
        // if (isset($_POST['order'])) {
        //     $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        // } elseif (isset($this->order)) {
        //     $order = $this->order;
        //     $this->db->order_by(key($order), $order[key($order)]);
        // }
        $this->db->from($this->table);
        if (isset($_POST['search']['value'])) {
            $this->db->like('region_kota', $_POST['search']['value']);
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->order[$_POST['order']['0']['column']],$_POST['order']['0']['dir']);
        }else {
            $this->db->order_by('region_id', 'ASC');
        }
    }

    public function get_datatables(){
        $this->_get_datatables_query();
        if($_POST['length']!=-1){
            $this->db->limit($_POST['length'],$_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered(){
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
     
    function show_region(){
        $hasil=$this->db->query("SELECT * FROM master_region");
        return $hasil;
    }
 
    function simpan_region($nama_kota){
        $hasil=$this->db->query("INSERT INTO master_region (region_kota) VALUES ('$nama_kota')");
        return $hasil;
    }

    function get_region($table){
        $data = $this->db->get($table);
        return $data->result_array();
    }
     
}