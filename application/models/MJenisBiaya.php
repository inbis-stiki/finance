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
    public function getWilayah($param){
        $currDate = date('Y-m-d');
        return $this->db->query('
            SELECT
                mc.client_region , mc.client_nama
            FROM transaksi_peminjaman tp, master_client mc 
            WHERE 
                tp.kendaraan_no_rangka = "'.$param['noRangka'].'" 
                AND tp.kendaraan_stnk =  "'.$param['stnk'].'"
                AND "'.$currDate.'" >= tp.transaksi_peminjaman_start
                AND "'.$currDate.'" <= tp.transaksi_peminjaman_end
                AND tp.client_id = mc.client_id
            LIMIT 1
            ')->row();
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