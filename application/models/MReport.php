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
        if(!empty($param['groupBy'])){
            $this->db->group_by(explode(',', $param['groupBy']));
            unset($param['groupBy']);
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
    public function globalCostArea(){
        return $this->db->query('
            SELECT 
                rt.report_wilayah ,
                SUM(rt.report_jumlah_transaksi) AS report_jumlah_transaksi,
                SUM(rt.report_total_transaksi) AS report_total_transaksi
            FROM report_transaksi rt 
            GROUP BY rt.report_wilayah 
        ')->result();
    }
    public function globalCostTahun($thn){
        return $this->db->query('
            SELECT 
                MONTH(rt.report_tanggal) as report_bulan,
                SUM(rt. report_total_transaksi) AS report_total_transaksi
            FROM report_transaksi rt 
            WHERE YEAR(rt.report_tanggal) = "'.$thn.'"
            GROUP BY MONTH(rt.report_tanggal)
            ORDER BY MONTH(rt.report_tanggal) ASC
        ')->result();
    }
    public function globalCostTahunArea($area){
        return $this->db->query('
            SELECT 
                MONTH(rt.report_tanggal) as report_bulan,
                SUM(rt. report_total_transaksi) AS report_total_transaksi
            FROM report_transaksi rt 
            WHERE YEAR(rt.report_tanggal) = "'.date('Y').'" AND rt.report_wilayah = "'.$area.'"
            GROUP BY MONTH(rt.report_tanggal)
            ORDER BY MONTH(rt.report_tanggal) ASC
        ')->result();
    }
    public function reportSparepart(){
        return $this->db->query('
            SELECT 
                ms.sparepart_nama ,
                SUM(t.transaksi_jumlah) as sparepart_total
            FROM 
                transaksi t, 
                master_jenis_pengeluaran mjp ,
                master_sparepart ms 
            WHERE 
                mjp.pengeluaran_group = "Maintenance"
                AND mjp.pengeluaran_id = t.id_pengeluaran 
                AND ms.sparepart_id = t.id_sparepart 
            GROUP BY t.id_sparepart 
            ORDER BY SUM(t.transaksi_jumlah) DESC
        ')->result();
    }
    public function reportKendaraan(){
        return $this->db->query('
            SELECT
                rt.report_stnk ,
                rt.report_klien ,
                SUM(rt.report_jumlah_transaksi) as report_jumlah_transaksi ,
                SUM(rt.report_total_transaksi) as report_total_transaksi
            FROM report_transaksi rt 
            GROUP BY
                rt.report_no_rangka , 
                rt.report_stnk ,
                rt.report_klien ,
                rt.report_wilayah 
            ORDER BY SUM(rt.report_total_transaksi) DESC
        ')->result();
    }
}