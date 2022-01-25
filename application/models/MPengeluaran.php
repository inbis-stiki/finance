<?php

class MPengeluaran extends CI_Model{
    public function getAll(){
        return $this->db->get('master_jenis_pengeluaran')->result();
    }
    public function getById($id){
        return $this->db->get_where('master_jenis_pengeluaran', ['pengeluaran_id' => $id])->row();
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

        return $this->db->get_where('master_jenis_pengeluaran', $param)->result();
    }
    public function insert($param){
        $this->db->insert('master_jenis_pengeluaran', $param);
    }
    public function update($param){
        $this->db->where('pengeluaran_id', $param['pengeluaran_id'])->update('master_jenis_pengeluaran', $param);
    }
    public function delete($param){
        $this->db->delete('master_jenis_pengeluaran', $param);
    }
}