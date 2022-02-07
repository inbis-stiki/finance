<?php

class MReport extends CI_Model{
    public function getAll(){
        return $this->db->get('report_transaksi')->result();
    }
    public function getById($id){
        return $this->db->get_where('report_transaksi', ['report_id' => $id])->row();
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

        return $this->db->get_where('report_transaksi', $param)->result();
    }
    public function insert($param){
        $this->db->insert('report_transaksi', $param);
    }
    public function update($param){
        $this->db->where('report_id', $param['report_id'])->update('report_transaksi', $param);
    }
    public function delete($param){
        $this->db->delete('report_transaksi', $param);
    }
    public function deleteAll(){
        $this->db->delete('report_transaksi');
    }
}