<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Pengeluaran extends CI_Model
{
    public function getPengeluaran()
    {
        $this->db->select('*');
        $this->db->from('master_jenis_pengeluaran');
        $this->db->where('deleted_date IS NULL', NULL, FALSE);
        $query = $this->db->get();
        return $query->result();
    }

    public function insert($pengeluaran_jenis, $pengeluaran_group)
    {
        $arr = [
            'pengeluaran_jenis'    => $pengeluaran_jenis,
            'pengeluaran_group'    => $pengeluaran_group
        ];
        $this->db->insert('master_jenis_pengeluaran', $arr);
        return "Berhasil insert";
    }

    public function editPengeluaran($data)
    {
        $this->db->where('pengeluaran_id', $data['pengeluaran_id']);
        $this->db->update('master_jenis_pengeluaran', $data);

        //$hasil = $this->db->query("Update master_sparepart SET sparepart_nama='$nama', sparepart_km='$km', sparepart_bulan='$bulan'  WHERE sparepart_id='$id'");
    }
}
