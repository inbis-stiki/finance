<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Sparepart extends CI_Model
{
    public function getSparepart()
    {
        $this->db->select('*');
        $this->db->from('master_sparepart');
        $query = $this->db->get();
        return $query->result();
    }

    public function insert($sparepart_nama, $sparepart_km, $sparepart_bulan)
    {
        $arr = [
            'sparepart_nama'    => $sparepart_nama,
            'sparepart_km'      => $sparepart_km,
            'sparepart_bulan'   => $sparepart_bulan
        ];
        $this->db->insert('master_sparepart', $arr);
        return "Berhasil insert";
    }
}
