<?php
class M_add_kendaraan extends CI_Model{
    

    function getData()
    {
        $query = $this->db->query("SELECT * FROM master_region order by region_kota asc");

        return $query->result();
    }
	
	function getKendaraan()
    {
        $query = $this->db->query("SELECT kendaraan_no_rangka, kendaraan_stnk FROM master_kendaraan WHERE disabled_date IS NULL order by kendaraan_stnk asc");

        return $query->result();
    }

	function getInstansi()
    {
        $query = $this->db->query("SELECT instansi_id, instansi_nama FROM master_instansi WHERE deleted_date IS NULL order by instansi_nama asc");

        return $query->result();
    }
}
?>