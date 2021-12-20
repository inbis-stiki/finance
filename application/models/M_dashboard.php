<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_dashboard extends CI_Model
{
    public function getGlobalCost()
    {
        $this->db->select('*');
        $this->db->from('reporttemp');
        // $this->db->where('disabled_date IS NULL', NULL, FALSE);
        // $this->db->where($statuskendaraan);
        $query = $this->db->get();
        return $query->result();
    }
    public function getDaftarKendaraan()
    {
        $this->db->select('');
        $this->db->from('reporttemp');
        // $this->db->where('disabled_date IS NULL', NULL, FALSE);
        // $this->db->where($statuskendaraan);
        $query = $this->db->get();
        return $query->result();
    }
    
}
