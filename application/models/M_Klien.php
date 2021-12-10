<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Klien extends CI_Model
{
    public function getKlien()
    {
        $this->db->select('*');
        $this->db->from('master_client');
        $this->db->join('master_region', 'master_client.id_region = master_region.region_id');
        $this->db->where('master_client.deleted_date IS NULL', NULL, FALSE);
        $query = $this->db->get();
        return $query->result();
    }

    public function getWilayah()
    {
        $this->db->select('*');
        $this->db->from('master_region');
        $this->db->where('deleted_date IS NULL', NULL, FALSE);
        $this->db->order_by('region_kota ASC');
        $query = $this->db->get();
        return $query->result();

        //$query = $this->db->query("SELECT * FROM master_region WHERE deleted_date IS NULL order by region_kota asc");
    }

    public function insert($client_nama, $client_jenis, $client_alamat, $client_contact, $client_npwp, $client_norek, $id_region)
    {
        $arr = [
            'client_nama'     => $client_nama,
            'client_jenis'    => $client_jenis,
            'client_alamat'   => $client_alamat,
            'client_contact'  => $client_contact,
            'client_npwp'     => $client_npwp,
            'client_norek'    => $client_norek,
            'id_region'       => $id_region
        ];
        $this->db->insert('master_client', $arr);
        return "Berhasil insert";
    }

    public function editKlien($data)
    {
        $this->db->where('client_nama', $data['client_nama']);
        $this->db->update('master_client', $data);

        //$hasil = $this->db->query("Update master_sparepart SET sparepart_nama='$nama', sparepart_km='$km', sparepart_bulan='$bulan'  WHERE sparepart_id='$id'");
    }
}
