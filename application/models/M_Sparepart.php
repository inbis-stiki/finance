<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Sparepart extends CI_Model
{
<<<<<<< Updated upstream
=======
    public function getById($id)
    {
        return $this->db->get_where('master_sparepart', ['sparepart_id' => $id])->row();
    }

>>>>>>> Stashed changes
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
<<<<<<< Updated upstream
=======

    public function editPart($nama, $km, $bulan, $id)
    {
        $hasil = $this->db->query("Update master_sparepart SET sparepart_nama='$nama', sparepart_km='$km', sparepart_bulan='$bulan'  WHERE sparepart_id='$id'");
    }
>>>>>>> Stashed changes
}
