<?php

class MDriver extends CI_Model{
    public function getAll(){
        return $this->db->get('master_driver')->result();
    }
    public function getById($id){
        return $this->db->get_where('master_driver', ['driver_nik' => $id])->row();
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

        return $this->db->get_where('master_driver', $param)->result();
    }
    public function insert($param){
        $this->db->insert('master_driver', $param);
    }
    public function insertTransKendaraan($param){
        $this->db->insert('transaksi_driverkendaraan', $param);
    }
    public function update($param){
        $this->db->where('driver_nik', $param['driver_nik'])->update('master_driver', $param);
    }
    public function deleteTransKendaraan($param){
        $this->db->where(['kendaraan_no_rangka' => $param['noRangka'], 'kendaraan_stnk' => $param['stnk']])->delete('transaksi_driverkendaraan');
    }
    public function delete($param){
        $this->db->delete('master_driver', $param);
    }
}