<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_kendaraan_master extends CI_Model
{
    public function getKendaraan()
    {
        $statuskendaraan = "disabled_date IS NULL AND is_active = 1";
        $this->db->select('*');
        $this->db->from('master_kendaraan');
        // $this->db->where('disabled_date IS NULL', NULL, FALSE);
        $this->db->where($statuskendaraan);
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

    public function getById($id){
        return $this->db->get_where('master_kendaraan', ['kendaraan_no_rangka' => $id, 'disabled_date' => null])->row();
    }

    public function update($where, $data ){
        $this->db->where($where);
        $this->db->update('master_kendaraan', $data);
        $hasil = $this->db->get();
        var_dump($hasil);
    }
}
