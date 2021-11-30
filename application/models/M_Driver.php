<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Driver extends CI_Model
{
    public function getDriver()
    {
        $this->db->select('*');
        $this->db->from('master_driver');
        $this->db->where('deleted_date IS NULL', NULL, FALSE);
        $query = $this->db->get();
        return $query->result();
    }

    // public function insert($region_kota)
    // {
    //     $arr = [
    //         'region_kota'    => $region_kota
    //     ];
    //     $this->db->insert('master_region', $arr);
    //     return "Berhasil insert";
    // }

    function editDriver($data)
    {
        $this->db->where('driver_nik', $data['driver_nik']);
        $this->db->update('master_driver', $data);
        // $hasil = $this->db->query("Update master_region SET region_kota='$kota' WHERE region_id='$id'");
    }
}
