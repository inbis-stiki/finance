<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Dropdown extends CI_Model
{
    public function getDropdownWilayah()
    {
        $this->db->select('*');
        $this->db->from('master_dropdown');
        $this->db->where('deleted_date IS NULL', NULL, FALSE);
        $this->db->where('dropdown_menu', 'Wilayah');
        $query = $this->db->get();
        return $query->result();
    }

    public function getDropdownSIM()
    {
        $this->db->select('*');
        $this->db->from('master_dropdown');
        $this->db->where('deleted_date IS NULL', NULL, FALSE);
        $this->db->where('dropdown_menu', 'SIM');
        $query = $this->db->get();
        return $query->result();
    }

    public function getDropdownPT()
    {
        $this->db->select('*');
        $this->db->from('master_dropdown');
        $this->db->where('deleted_date IS NULL', NULL, FALSE);
        $this->db->where('dropdown_menu', 'PT');
        $query = $this->db->get();
        return $query->result();
    }

    public function insert($dropdown_menu, $dropdown_list, $created_date)
    {
        $arr = [
            'dropdown_menu'   => $dropdown_menu,
            'dropdown_list'   => $dropdown_list,
            'created_date'    => $created_date
        ];
        $this->db->insert('master_dropdown', $arr);
        return "Berhasil insert";
    }

    public function editDropdown($data)
    {
        $this->db->where('dropdown_id', $data['dropdown_id']);
        $this->db->update('master_dropdown', $data);

        //$hasil = $this->db->query("Update master_sparepart SET sparepart_nama='$nama', sparepart_km='$km', sparepart_bulan='$bulan'  WHERE sparepart_id='$id'");
    }
}
