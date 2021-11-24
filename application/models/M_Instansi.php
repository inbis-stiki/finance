<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Instansi extends CI_Model
{
    public function getInstansi()
    {
        $this->db->select('*');
        $this->db->from('master_instansi');
        $this->db->where('deleted_date IS NULL', NULL, FALSE);
        $query = $this->db->get();
        return $query->result();
    }

    public function insert($instansi_nama, $instansi_jenis)
    {
        $arr = [
            'instansi_nama'    => $instansi_nama,
            'instansi_jenis'   => $instansi_jenis
        ];
        $this->db->insert('master_instansi', $arr);
        return "Berhasil insert";
    }

    public function editInstansi($data)
    {
        $this->db->where('instansi_id', $data['instansi_id']);
        $this->db->update('master_instansi', $data);

        //$hasil = $this->db->query("Update master_sparepart SET sparepart_nama='$nama', sparepart_km='$km', sparepart_bulan='$bulan'  WHERE sparepart_id='$id'");
    }
}
