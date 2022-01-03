<?php

class MKendaraan extends CI_Model{
    public function getAll(){
        return $this->db->get('master_kendaraan')->result();
    }
    public function getById($id, $id2){
        return $this->db->get_where('master_kendaraan', ['kendaraan_no_rangka' => $id, 'kendaraan_stnk' => $id2])->row();
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

        return $this->db->get_where('master_kendaraan', $param)->result();
    }
    public function insert($param){
        $this->db->insert('master_kendaraan', $param);
    }
    public function update($param){
        $this->db->where('kendaraan_no_rangka', $param['kendaraan_no_rangka'])->where('kendaraan_stnk', $param['kendaraan_stnk'])->update('master_kendaraan', $param);
    }
    public function delete($param){
        $this->db->delete('master_kendaraan', $param);
    }
}