<?php
class M_kendaraan extends CI_Model{
    public function tambah(){
        $this->db->trans_start();

        //INSERT KE TABEL MASTER_INSTANSI
        //get foto
		$config['upload_path'] = './assets/images/fotokendaraan';
		$config['allowed_types'] = 'jpg|png|jpeg';
		$config['max_size'] = '2048';  //2MB max
		$config['max_width'] = '4480'; // pixel
		$config['max_height'] = '4480'; // pixel
		$config['file_name'] = $_FILES['foto']['name'];
  
		$this->upload->initialize($config);

		if (!empty($_FILES['foto']['name'])) {
	        if ( $this->upload->do_upload('foto') ) {
                $instansi = [
                    'instansi_nama' => $this->input->post('instansi', true),
                    'instansi_jenis' => $this->input->post('jenis_instansi', true)
                ];
        
                $this->db->insert('master_instansi', $instansi);
        
                $last_id = $this->db->insert_id();
	            $fotokendaraan = $this->upload->data();
	            $data = array(
					'kendaraan_no_rangka' 		=> $this->input->post('rangka'),
					'kendaraan_stnk' 	        => $this->input->post('stnk'),
					'kendaraan_merk' 	        => $this->input->post('merk'), 
					'kendaraan_tanggal_beli' 	=> $this->input->post('tanggal'),
                    'id_region'                 => $this->input->post('kota'),
					'id_instansi'               => $last_id,
					'kendaraan_foto'			=> $fotokendaraan['file_name']
				);

				$query = $this->db->insert('master_kendaraan', $data);
				if ($query = true) {
					$this->session->set_flashdata('inserted', 'Yess');
					// redirect('admin/pencatatan/unit_kendaraan');
				}
	        }else {
              die("gagal upload");
	        }
	    }else {
	      
	    }
        $this->db->trans_complete();

    }

    function getData()
    {
        $query = $this->db->query("SELECT * FROM master_region order by region_kota asc");

        return $query->result();
    }
}
?>