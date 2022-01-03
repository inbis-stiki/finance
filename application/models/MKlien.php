<?php

class MKlien extends CI_Model{
    public function getAll(){
        return $this->db->get('master_client')->result();
    }
    public function getById($id){
        return $this->db->get_where('master_client', ['client_id' => $id])->row();
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

        return $this->db->get_where('master_client', $param)->result();
    }
    public function insert($param){
        $this->db->insert('master_client', $param);
    }
    public function update($param){
        $this->db->where('client_id', $param['client_id'])->update('master_client', $param);
    }
    public function delete($param){
        $this->db->delete('master_client', $param);
    }
}