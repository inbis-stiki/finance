<?php

class MJenisBiaya extends CI_Model{
    public function getAll(){
        return $this->db->get('transaksi')->result();
    }
    public function getById($id){
        return $this->db->get_where('transaksi', ['transaksi_id' => $id])->row();
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

        return $this->db->get_where('transaksi', $param)->result();
    }
    public function insert($param){
        $this->db->insert('transaksi', $param);
    }
    public function update($param){
        $this->db->where('transaksi_id', $param['transaksi_id'])->update('transaksi', $param);
    }
    public function delete($param){
        $this->db->delete('transaksi', $param);
    }
}