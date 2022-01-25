<?php

class MUser extends CI_Model{
    public function getAll(){
        return $this->db->get('user')->result();
    }
    public function getById($id){
        return $this->db->get_where('user', ['username' => $id])->row();
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

        return $this->db->get_where('user', $param)->result();
    }
    public function insert($param){
        $this->db->insert('user', $param);
    }
    public function update($param){
        $this->db->where('username', $param['username'])->update('user', $param);
    }
    public function delete($param){
        $this->db->delete('user', $param);
    }
}