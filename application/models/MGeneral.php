<?php

class MGeneral extends CI_Model{
    public function get($table, $param){
        if(!empty($param['orderBy'])){ // order by
            $this->db->order_by($param['orderBy']);
            unset($param['orderBy']);
        }
        if(!empty($param['limit'])){ // limit
            $this->db->limit($param['limit']);
            unset($param['limit']);
        }

        return $this->db->get_where($table, $param)->result();
    }
    public function getKendaraanKlien($param){
        $currDate = date('Y-m-d');
        return $this->db->query('
            SELECT 
                mc.client_nama , mc.client_region 
            FROM transaksi_peminjaman tp , master_client mc 
            WHERE 
                tp.kendaraan_no_rangka = "'.$param['noRangka'].'"
                AND tp.kendaraan_stnk = "'.$param['stnk'].'"
                AND "'.$currDate.'" >= tp.transaksi_peminjaman_start
                AND "'.$currDate.'" <= tp.transaksi_peminjaman_end
                AND tp.client_id = mc.client_id 
            LIMIT 1
        ')->row();
    }
}   