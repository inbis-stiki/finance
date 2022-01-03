<?php

class MDropdown extends CI_Model{
    public function getAll(){
        return $this->db->get('master_dropdown')->result();
    }
    public function getById($id){
        return $this->db->get_where('master_dropdown', ['dropdown_id' => $id])->row();
    }
    public function get($param){
        if(!empty($param['orderBy'])){ // order by
            $this->db->order_by($param['orderBy']);
            unset($param['orderBy']);
        }
        if(!empty($param['limit'])){ // limit
            $this->db->limit($param['limit']);
            unset($param['limit']);
        }

        return $this->db->get_where('master_dropdown', $param)->result();
    }
    public function insert($param){
        $this->db->insert('master_dropdown', $param);
    }
    public function update($param){
        $this->db->where('dropdown_id', $param['dropdown_id'])->update('master_dropdown', $param);
    }
    public function delete($param){
        $this->db->delete('master_dropdown', $param);
    }
}