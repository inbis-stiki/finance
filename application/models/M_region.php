<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_region extends CI_Model
{
    public function getRegion()
    {
        $this->db->select('*');
        $this->db->from('master_region');
        $query = $this->db->get();
        return $query->result();
    }

    public function insert($region_kota)
    {
        $arr = [
            'region_kota'    => $region_kota
        ];
        $this->db->insert('master_region', $arr);
        return "Berhasil insert";
    }

    function editRegion($kota, $id){
        $hasil = $this->db->query("Update master_region SET region_kota='$kota' WHERE region_id='$id'");
    }
}
