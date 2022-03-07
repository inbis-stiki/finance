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
    public function jenisPengeluaran($month, $year){
        $filter = [];
        if($month != "All") array_push($filter, 'MONTH(t.transaksi_tanggal) = "'.$month.'"');
        if($year != "All") array_push($filter, 'YEAR(t.transaksi_tanggal) = "'.$year.'"');
        $and = count($filter) > 0 ? ' AND ' : '';

        return $this->db->query('
            SELECT 
                mjp.pengeluaran_group, sum(t.transaksi_total) as total_jenis_pengeluaran 
            FROM 
                transaksi t, master_jenis_pengeluaran mjp
            WHERE 
                t.id_pengeluaran IS NOT NULL
                '.$and.'
                '.implode(' AND ', $filter).'
                AND t.id_pengeluaran = mjp.pengeluaran_id 
            GROUP BY mjp.pengeluaran_group  
        ')->result();
    }
}