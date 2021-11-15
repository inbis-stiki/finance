<?php
class M_kendaraan extends CI_Model{
    public function tambah(){
        $this->db->trans_start();

        // INSERT KE TABEL MASTER_INSTANSI
        $instansi = [
            'instansi_nama' => $this->input->post('instansi', true),
            'instansi_jenis' => $this->input->post('jenis_instansi', true)
        ];

        $this->db->insert('master_instansi', $instansi);

        $last_id = $this->db->insert_id();
        // var_dump($last_id);

        // INSERT KE TABEL MASTER_KENDARAAN
        $kendaraan = [
            'kendaraan_no_rangka' => $this->input->post('rangka', true),
            'kendaraan_stnk' => $this->input->post('stnk', true),
            'kendaraan_merk' => $this->input->post('merk', true),
            'id_instansi' => $last_id
        ];

        $this->db->insert('master_kendaraan', $kendaraan);

        $this->db->trans_complete();
    }

    function getAllGroups(){
        $query = $this->db->query('select region_kota from master_region');

        return $query->result();
    }
}
?>