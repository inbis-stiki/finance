<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_kendaraan_master extends CI_Model
{
    public function getKendaraan()
    {
        $this->db->select('*');
        $this->db->from('master_kendaraan');
        $this->db->where('disabled_date IS NULL', NULL, FALSE);
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

    function editKendaraan($data)
    {
        $this->db->where('kendaraan_no_rangka', $data['kendaraan_no_rangka']);
        $this->db->update('master_kendaraan', $data);
        // $hasil = $this->db->query("Update master_region SET region_kota='$kota' WHERE region_id='$id'");
    }
}
