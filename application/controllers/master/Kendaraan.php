<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kendaraan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('isManagement') != '1'){
			redirect('/');
		}
        $this->load->helper(array('form', 'url', 'date'));
        $this->load->library('form_validation');
        $this->load->library('table');
        $this->load->model('M_kendaraan_master');
    }
    public function index(){
        $this->load->model('M_User');
		$this->load->model('M_kendaraan_master');
		$dataKendaraan = $this->M_kendaraan_master->getKendaraan();

		$data = [
			'title' => "admin",
			'Kendaraan' => $dataKendaraan,
			'auth' => $this->db->get_where('master_user', ['username' => $this->session->userdata('username')])->row_array()
		];

		$this->template->index('admin/master_kendaraan', $data);
		$this->load->view('_components/sideNavigation', $data);
    }
    public function vAdd(){
        $this->load->model('M_User');
		$this->load->model('MDropdown');

		$datajenis	    = $this->MDropdown->get(['dropdown_menu' => 'Jenis Kendaraan', 'deleted_date' => NULL]);
		$datapt		    = $this->MDropdown->get(['dropdown_menu' => 'PT', 'deleted_date' => NULL]);
        $datawilayah    = $this->MDropdown->get(['dropdown_menu' => 'Wilayah', 'deleted_date' => NULL]);

		$data = [
			'title' 	    => "admin",
			'auth' 		    => $this->db->get_where('master_user', ['username' => $this->session->userdata('username')])->row_array(),
			'datajenis'     => $datajenis,
			'datapt' 	    => $datapt,
            'datawilayah'   => $datawilayah
		];

		$this->template->index('admin/add_kendaraan', $data);
		$this->load->view('_components/sideNavigation', $data);
    }
    public function vEdit($id){
        $id = str_replace('_', ' ', $id);
		$this->load->model('M_User');
		$this->load->model('M_kendaraan_master');$this->load->model('MDropdown');

		$datajenis	    = $this->MDropdown->get(['dropdown_menu' => 'Jenis Kendaraan', 'deleted_date' => NULL]);
		$datapt		    = $this->MDropdown->get(['dropdown_menu' => 'PT', 'deleted_date' => NULL]);
        $datawilayah    = $this->MDropdown->get(['dropdown_menu' => 'Wilayah', 'deleted_date' => NULL]);
		$dataEdit       = $this->M_kendaraan_master->getById($id);



		$data = [
			'title'         => "admin",
			'auth'          => $this->db->get_where('master_user', ['username' => $this->session->userdata('username')])->row_array(),
			'kendaraan'     => $dataEdit,
			'datajenis'     => $datajenis,
			'datapt' 	    => $datapt,
            'datawilayah'   => $datawilayah
		];


		$this->template->index('admin/edit_kendaraan', $data);
		$this->load->view('_components/sideNavigation', $data);
    }
    public function ajxGetKendaraan(){
        $this->load->model('MKendaraan');
        $id = explode('|', $_POST['id']);
        $kendaraan = $this->MKendaraan->getById($id[0], $id[1]);
        $kendaraan->kendaraan_foto = json_decode($kendaraan->kendaraan_foto);

        $umur = date_diff(date_create($kendaraan->kendaraan_tanggal_beli), date_create(date('Y-m-d')));
        $kendaraan->umur = $umur->format("%m") . " Bulan " . $umur->format('%y') . "Tahun";
        echo json_encode($kendaraan);
    }
    public function ajxGetStnk(){
        $this->load->model('MKendaraan');
        $id = explode('|', $_POST['id']);
        $kendaraan = $this->MKendaraan->getById($id[0], $id[1]);
        $kendaraan->kendaraan_foto_stnk = json_decode($kendaraan->kendaraan_foto_stnk);

        $umur = date_diff(date_create($kendaraan->kendaraan_tanggal_beli), date_create(date('Y-m-d')));
        $kendaraan->umur = $umur->format("%m") . " Bulan " . $umur->format('%y') . "Tahun";
        echo json_encode($kendaraan);
    }

    public function store()
    {
        $dataDuplicate = $this->db->get_where('master_kendaraan', ['kendaraan_no_rangka' => $_POST['rangka'], 'kendaraan_stnk' => $_POST['stnk']])->result();
        if ($dataDuplicate == null) {
            // //get foto
            // $path = './assets/images/fotokendaraan';
            // $config['upload_path'] = $path;
            // $config['allowed_types'] = 'jpg|png|jpeg';
            // $config['max_size'] = '2048';  //2MB max
            // $config['max_width'] = '4480'; // pixel
            // $config['max_height'] = '4480'; // pixel
            // // $config['file_name'] = $_FILES['foto']['name'];

            // // var_dump($_FILES['foto']);
            // // echo json_encode($_FILES['foto']['name']);
            // // die;
            // $fotokendaraan = json_encode($_FILES['foto']['name']);
            // $files = $_FILES['foto'];

            // $this->upload->initialize($config);

            $data_lama = $this->db->get_where("master_kendaraan", array('kendaraan_no_rangka' => $this->input->post('rangka')))->result();

            // foreach ($files['name'] as $key => $image) {
            //     $_FILES['images[]']['name'] = $files['name'][$key];
            //     $_FILES['images[]']['type'] = $files['type'][$key];
            //     $_FILES['images[]']['tmp_name'] = $files['tmp_name'][$key];
            //     $_FILES['images[]']['error'] = $files['error'][$key];
            //     $_FILES['images[]']['size'] = $files['size'][$key];

            //     $fileName = $image;

            //     $images[] = $fileName;

            //     $config['file_name'] = $fileName;

            //     $this->upload->initialize($config);

            //     if ($this->upload->do_upload('images[]')) {
            //         $tmpdata = $this->upload->data();
            //         // $fotokendaraan .= $tmpdata['file_name'] . ", ";
            //     } else {
            //         $this->load->model('M_User');
            //         $this->load->model('MDropdown');
        
            //         $datajenis	= $this->MDropdown->get(['dropdown_menu' => 'Jenis Kendaraan', 'deleted_date' => NULL]);
            //         $datapt		= $this->MDropdown->get(['dropdown_menu' => 'PT', 'deleted_date' => NULL]);
        
            //         $data = [
            //             'title' => "admin",
            //             'auth' => $this->db->get_where('master_user', ['username' => $this->session->userdata('username')])->row_array(),
            //             'temp' => $_POST,
            //             'datajenis' => $datajenis,
            //             'datapt' 	=> $datapt
            //         ];
        
            //         $this->session->set_flashdata('err_msg', $this->upload->display_errors());
            //         $this->template->index('admin/add_kendaraan', $data);
            //         $this->load->view('_components/sideNavigation', $data);
            //         return false;
            //     }
            // }
            $uploadFoto = $this->upload_image('foto');
            $uploadStnk = $this->upload_image('stnk');
            // var_dump($uploadFoto);
            // die;
            // if ($uploadFoto['status' == false]) {
            //     redirect('admin/')
            // }
            $jenis = $this->input->post('jenis_kendaraan');
            $data = array(
                'kendaraan_no_rangka'           => strtoupper($this->input->post('rangka')),
                'kendaraan_stnk'                => strtoupper($this->input->post('stnk')),
                'kendaraan_merk'                => $this->input->post('merk'),
                'kendaraan_tanggal_beli'        => $this->input->post('tanggal'),
                'kendaraan_jenis'               => $jenis,
                'kendaraan_pt'                  => $jenis == "Perusahaan" ? $this->input->post('pt') : null,
                'kendaraan_deadlinestnk'         => $this->input->post('pajak'),
                'kendaraan_deadlinekir'         => $this->input->post('kir'),
                'kendaraan_kapasitas_tangki'    => $this->input->post('tangki'),
                'kendaraan_foto'                => str_replace(" ", "_", $uploadFoto['link']),
                'kendaraan_foto_stnk'           => str_replace(" ", "_", $uploadStnk['link']),
                'kendaraan_wilayah'             => $this->input->post('lokasi_ambil')
            );

            // $this->db->query("CALL disable_kendaraan('" . $data_lama['kendaraan_no_rangka'] . "')");
            foreach ($data_lama as $item) {
                if ($item->disabled_date == null) {
                    $this->db->where(['kendaraan_no_rangka' => $item->kendaraan_no_rangka, 'kendaraan_stnk' => $item->kendaraan_stnk])->update('master_kendaraan', ['disabled_date' => date('Y-m-d H:i:s')]);
                }
            }
            $query = $this->db->insert('master_kendaraan', $data);
            if ($query = true) {
                $this->session->set_flashdata('inserted', 'Yess');
                redirect('master/kendaraan');
            }
        } else {

            $this->load->model('M_User');
            $this->load->model('MDropdown');

            $datajenis	= $this->MDropdown->get(['dropdown_menu' => 'Jenis Kendaraan', 'deleted_date' => NULL]);
            $datapt		= $this->MDropdown->get(['dropdown_menu' => 'PT', 'deleted_date' => NULL]);

            $data = [
                'title' => "admin",
                'auth' => $this->db->get_where('master_user', ['username' => $this->session->userdata('username')])->row_array(),
                'temp' => $_POST,
                'datajenis' => $datajenis,
                'datapt' 	=> $datapt
            ];

            $this->session->set_flashdata('err_msg', 'Data No Rangka & STNK telah tersimpan!');
            $this->template->index('admin/add_kendaraan', $data);
            $this->load->view('_components/sideNavigation', $data);
        }
    }

    function changeSTNK()
    {
        $this->load->model('MKendaraan');
        $dataDuplicate = $this->db->get_where('master_kendaraan', ['kendaraan_no_rangka' => $_POST['rangka'], 'kendaraan_stnk' => $_POST['stnk']])->result();
        if ($dataDuplicate == null) {
            $kendaraan = $this->MKendaraan->getById($_POST['rangka'], $_POST['stnkLama']);
            $dataStore['kendaraan_no_rangka']           = $kendaraan->kendaraan_no_rangka;
            $dataStore['kendaraan_stnk']                = $_POST['stnk'];
            $dataStore['kendaraan_merk']                = $kendaraan->kendaraan_merk;
            $dataStore['kendaraan_tanggal_beli']        = $kendaraan->kendaraan_tanggal_beli;
            $dataStore['kendaraan_foto']                = $kendaraan->kendaraan_foto;
            $dataStore['kendaraan_pemilik']             = $kendaraan->kendaraan_pemilik;
            $dataStore['kendaraan_deadlinestnk']         = $kendaraan->kendaraan_deadlinestnk;
            $dataStore['kendaraan_deadlinekir']         = $kendaraan->kendaraan_deadlinekir;
            $dataStore['kendaraan_kapasitas_tangki']    = $kendaraan->kendaraan_kapasitas_tangki;
            $dataStore['kendaraan_jenis']               = $kendaraan->kendaraan_jenis;
            $dataStore['kendaraan_pt']                  = $kendaraan->kendaraan_pt;
            $dataStore['kendaraan_wilayah']             = $kendaraan->kendaraan_wilayah;
            $this->MKendaraan->insert($dataStore);

            $dataUpdate['kendaraan_no_rangka'] = $_POST['rangka'];
            $dataUpdate['kendaraan_stnk']   = $_POST['stnkLama'];
            $dataUpdate['disabled_date']    = date('Y-m-d H:i:s');
            $this->MKendaraan->update($dataUpdate);

            $this->session->set_flashdata('succ_msg', 'Berhasil mengubah Nomor STNK!');
            redirect('master/kendaraan');
        } else {
            $this->session->set_flashdata('err_msg', 'Data No Rangka & STNK telah tersimpan!');
            redirect('master/kendaraan');
        }
    }

    public function update()
    {
        // $dataDuplicate = $this->db->get_where('master_kendaraan', ['kendaraan_no_rangka' => $_POST['rangka'], 'kendaraan_stnk' => $_POST['stnk']])->result();
        // if($dataDuplicate == null){
        //get foto
        // $config['upload_path'] = './assets/images/fotokendaraan';
        // $config['allowed_types'] = 'jpg|png|jpeg';
        // $config['max_size'] = '2048';  //2MB max
        // $config['max_width'] = '4480'; // pixel
        // $config['max_height'] = '4480'; // pixel
        // // $config['file_name'] = $_FILES['foto']['name'];

        // // echo json_encode($_FILES['foto']['name']);
        // // die;
        // $fotokendaraan = json_encode($_FILES['foto']['name']);
        // $files = $_FILES['foto'];

        // $this->upload->initialize($config);

        // // $data_lama = $this->db->get_where("master_kendaraan", array('kendaraan_no_rangka' => $this->input->post('rangka')))->result();
        // // var_dump($_FILES['foto']['name']);

        // if ($_FILES['foto']['name'][0] != "") {

        //     foreach ($files['name'] as $key => $image) {
        //         $_FILES['images[]']['name'] = $files['name'][$key];
        //         $_FILES['images[]']['type'] = $files['type'][$key];
        //         $_FILES['images[]']['tmp_name'] = $files['tmp_name'][$key];
        //         $_FILES['images[]']['error'] = $files['error'][$key];
        //         $_FILES['images[]']['size'] = $files['size'][$key];

        //         $fileName = $image;

        //         $images[] = $fileName;

        //         $config['file_name'] = $fileName;

        //         $this->upload->initialize($config);

        //         if ($this->upload->do_upload('images[]')) {
        //             $tmpdata = $this->upload->data();
        //             // $fotokendaraan .= $tmpdata['file_name'] . ", ";
        //         } else {
        //             return false;
        //         }
        //     }
        //     $data['kendaraan_foto'] = str_replace(" ", "_", $fotokendaraan);
        // }
        if (!empty($_FILES['foto']['name'][0])) {
            $uploadFoto = $this->upload_image('foto');
            $data['kendaraan_foto'] = $uploadFoto['link'];
        }

        if (!empty($_FILES['stnk']['name'][0])) {
            $uploadStnk = $this->upload_image('stnk');
            $data['kendaraan_foto_stnk'] = $uploadStnk['link'];
        }
        $jenis = $this->input->post('jenis_kendaraan');
        $data['kendaraan_merk'] = $this->input->post('merk');
        $data['kendaraan_kapasitas_tangki'] = $this->input->post('tangki');
        $data['kendaraan_tanggal_beli'] = $this->input->post('tanggal');
        $data['kendaraan_deadlinestnk'] = $this->input->post('pajak');
        $data['kendaraan_deadlinekir'] = $this->input->post('kir');
        $data['kendaraan_jenis'] = $jenis;
        $data['kendaraan_pt'] = $jenis == "Perusahaan" ? $this->input->post('pt') : null;
        $data['kendaraan_wilayah'] = $this->input->post('lokasi_ambil');
        $data['is_active'] = $this->input->post('status');
        // $data = array(
        //     'kendaraan_merk'             => $this->input->post('merk'),
        //     'kendaraan_tanggal_beli'     => $this->input->post('tanggal')
        // );
        // var_dump($data);

        $where = array(
            'kendaraan_no_rangka' => $this->input->post('rangka')
        );

        // $this->db->query("CALL disable_kendaraan('" . $data_lama['kendaraan_no_rangka'] . "')");
        // foreach ($data_lama as $item) {
        //     if($item->disabled_date == null){
        //         $this->db->where(['kendaraan_no_rangka' => $item->kendaraan_no_rangka, 'kendaraan_stnk' => $item->kendaraan_stnk])->update('master_kendaraan', ['disabled_date' => date('Y-m-d H:i:s')]);
        //     }
        // }
        // $this->M_kendaraan_master->update($where, $data);
        // redirect('master/kendaraan');
        // $rangka = $this->input->post('rangka');
        $this->db->where($where);
        $query = $this->db->update('master_kendaraan', $data);
        // echo $this->db->last_query();

        // var_dump($query);
        // die;
        if ($query = true) {
            $this->session->set_flashdata('inserted', 'Yess');
            redirect('master/kendaraan');
        }
        // }else{

        //     $this->load->model('M_User');
        //     $this->load->model('M_add_kendaraan');

        //     $datakota = $this->M_add_kendaraan->getData();
        //     $datakendaraan = $this->M_add_kendaraan->getKendaraan();
        //     $datainstansi = $this->M_add_kendaraan->getInstansi();

        //     $data = [
        //         'title' => "admin",
        //         'auth' => $this->db->get_where('master_user', ['username' => $this->session->userdata('username')])->row_array(),
        //         'temp' => $_POST
        //     ];

        //     $this->session->set_flashdata('err_msg', 'Data No Rangka & STNK telah tersimpan!');
        //     $this->template->index('admin/add_kendaraan', $data);
        //     $this->load->view('_components/sideNavigation', $data);
        // }
    }

    public function upload_image($resource)
    {
        // var_dump($_FILES[$resource]['name']);
        // die;
        $path = 'assets/images/kendaraan/' . $resource;
            $config['upload_path'] = $path;
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size'] = '2048';  //2MB max
            $config['max_width'] = '4480'; // pixel
            $config['max_height'] = '4480'; // pixel
            // $config['file_name'] = $_FILES['foto']['name'];

            // var_dump($_FILES['foto']);
            // echo json_encode($_FILES['foto']['name']);
            // die;
            $fotokendaraan = [] ;
            $files = $_FILES[$resource];

            $this->upload->initialize($config);

            $data_lama = $this->db->get_where("master_kendaraan", array('kendaraan_no_rangka' => $this->input->post('rangka')))->result();

            foreach ($files['name'] as $key => $image) {
                $_FILES['images[]']['name'] = $files['name'][$key];
                $_FILES['images[]']['type'] = $files['type'][$key];
                $_FILES['images[]']['tmp_name'] = $files['tmp_name'][$key];
                $_FILES['images[]']['error'] = $files['error'][$key];
                $_FILES['images[]']['size'] = $files['size'][$key];

                $fileName = $image;

                $images[] = $fileName;

                $config['file_name'] = $fileName;

                $this->upload->initialize($config);

                if ($this->upload->do_upload('images[]')) {
                    $img = $this->upload->data();
                    array_push($fotokendaraan, base_url($path . '/' . $img['file_name']));
                } else {
                    $this->load->model('M_User');
                    $this->load->model('MDropdown');
        
                    $datajenis	= $this->MDropdown->get(['dropdown_menu' => 'Jenis Kendaraan', 'deleted_date' => NULL]);
                    $datapt		= $this->MDropdown->get(['dropdown_menu' => 'PT', 'deleted_date' => NULL]);
        
                    $data = [
                        'title' => "admin",
                        'auth' => $this->db->get_where('master_user', ['username' => $this->session->userdata('username')])->row_array(),
                        'temp' => $_POST,
                        'datajenis' => $datajenis,
                        'datapt' 	=> $datapt
                    ];
        
                    $this->session->set_flashdata('err_msg', $this->upload->display_errors());
                    $this->template->index('admin/add_kendaraan', $data);
                    $this->load->view('_components/sideNavigation', $data);
                    // return false;
                }
            }
            // $tmp = json_encode($fotokendaraan);
            // var_dump(json_encode($fotokendaraan));
            // var_dump(json_decode($tmp));
            // die;
            return [
                'status' => true,
                'msg'   => 'Data berhasil terupload',
                'link'  => json_encode($fotokendaraan)
            ];
    }
}
