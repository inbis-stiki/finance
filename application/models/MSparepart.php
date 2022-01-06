<?php

class MSparepart extends CI_Model{
    public function getAll(){
        return $this->db->get('master_sparepart')->result();
    }
    public function getById($id){
        return $this->db->get_where('master_sparepart', ['sparepart_id' => $id])->row();
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

        return $this->db->get_where('master_sparepart', $param)->result();
    }
    public function insert($param){
        $this->db->insert('master_sparepart', $param);
    }
    public function update($param){
        $this->db->where('sparepart_id', $param['sparepart_id'])->update('master_sparepart', $param);
    }
    public function delete($param){
        $this->db->delete('master_sparepart', $param);
    }
}