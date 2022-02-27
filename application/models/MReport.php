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
                rt.report_no_rangka,
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
    public function costAdministrasi($noRangka, $noSTNK){
        return $this->db->query('
            SELECT 
                t.transaksi_tanggal as tanggal_transaksi,
                mjp.pengeluaran_jenis as jenis_pengeluaran, 
                t.transaksi_total as total_biaya
            FROM transaksi t , master_jenis_pengeluaran mjp 
            WHERE 
                t.no_rangka = "'.$noRangka.'"
                AND t.kendaraan_stnk = "'.$noSTNK.'"
                AND t.id_pengeluaran = mjp.pengeluaran_id 
                AND mjp.pengeluaran_group = "Administrasi"
            ORDER BY t.transaksi_tanggal DESC
        ')->result();
    }
    public function costMaintenance($noRangka, $noSTNK){
        return $this->db->query('
            SELECT 
                t.transaksi_tanggal as tanggal_service,
                mjp.pengeluaran_jenis as jenis_pengeluaran,
                ms.sparepart_nama as jenis_sparepart,
                t.transaksi_keterangan as merek,
                t.transaksi_no_seri as nomor_seri,
                t.transaksi_jarak_tempuh as pemakaian,
                t.transaksi_jumlah as jumlah,
                t.transaksi_total as total_biaya
            FROM 
                transaksi t , 
                master_jenis_pengeluaran mjp , 
                master_sparepart ms 
            WHERE 
                t.no_rangka = "'.$noRangka.'"
                AND t.kendaraan_stnk = "'.$noSTNK.'"
                AND t.id_pengeluaran = mjp.pengeluaran_id 
                AND mjp.pengeluaran_group = "Maintenance"
                AND ms.sparepart_id = t.id_sparepart 
            ORDER BY t.transaksi_tanggal DESC
        ')->result();
    }
    public function costBBM($noRangka, $noSTNK){
        return $this->db->query('
            SELECT 
                t.transaksi_tanggal as tanggal_service,
                t.transaksi_total as total_biaya, 
                t.transaksi_keterangan as catatan
            FROM 
                transaksi t , 
                master_jenis_pengeluaran mjp
            WHERE 
                t.no_rangka = "'.$noRangka.'"
                AND t.kendaraan_stnk = "'.$noSTNK.'"
                AND t.id_pengeluaran = mjp.pengeluaran_id 
                AND mjp.pengeluaran_jenis = "BBM"
            ORDER BY t.transaksi_tanggal DESC
        ')->result();
    }
    public function costDriver($noRangka, $noSTNK){
        return $this->db->query('
            SELECT 
                t.transaksi_tanggal as tanggal_service,
                t.transaksi_jumlah as total_hari_masuk,
                t.transaksi_total as total_biaya
            FROM 
                transaksi t , 
                master_jenis_pengeluaran mjp
            WHERE 
                t.no_rangka = "'.$noRangka.'"
                AND t.kendaraan_stnk = "'.$noSTNK.'"
                AND t.id_pengeluaran = mjp.pengeluaran_id 
                AND mjp.pengeluaran_jenis = "Driver"
            ORDER BY t.transaksi_tanggal DESC
        ')->result();
    }
    public function costLain($noRangka, $noSTNK){
        return $this->db->query('
            SELECT 
                t.transaksi_tanggal as tanggal_service,
                t.transaksi_keterangan as keterangan,
                t.transaksi_jumlah as jumlah,
                t.transaksi_total as total_biaya
            FROM 
                transaksi t , 
                master_jenis_pengeluaran mjp
            WHERE 
                t.no_rangka = "'.$noRangka.'"
                AND t.kendaraan_stnk = "'.$noSTNK.'"
                AND t.id_pengeluaran = mjp.pengeluaran_id 
                AND mjp.pengeluaran_jenis = "Lain - Lain"
            ORDER BY t.transaksi_tanggal DESC
        ')->result();
    }
}