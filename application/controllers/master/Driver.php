<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Driver extends CI_Controller
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
        $this->load->library('upload');
		$this->load->model('MDriver');
		$this->load->model('MKendaraan');
		$this->load->model('MDropdown');
    }
    public function index(){
		$dataDriver 	= $this->MDriver->get(['deleted_date' => NULL]);
		$dataKendaraan 	= $this->MKendaraan->get(['disabled_date' => NULL, 'is_active' => "1"]);

		$data = [
			'title' => "admin",
			'Driver' => $dataDriver,
			'Kendaraan' => $dataKendaraan,
		];

		$this->template->index('admin/driver/master_driver', $data);
		$this->load->view('_components/sideNavigation', $data);
    }
    public function vAdd(){
		$dataSIM = $this->MDropdown->get(['dropdown_menu' => 'SIM', 'deleted_date' => NULL]);

		$data['title'] 	= 'admin';
		$data['Sim'] 	= $dataSIM;
		$data['auth'] 	= $this->db->get_where('master_user', ['username' => $this->session->userdata('username')])->row_array();

		$this->template->index('admin/add_driver', $data);
		$this->load->view('_components/sideNavigation', $data);
    }

    public function vEdit($id)
	{
		$dataSIM = $this->MDropdown->get(['dropdown_menu' => "SIM", 'deleted_date' => NULL]);

		$data['title'] = 'admin';
		$data['Sim'] = $dataSIM;
		$data['auth'] = $this->db->get_where('master_user', ['username' => $this->session->userdata('username')])->row_array();
		$data['driver'] = $this->MDriver->getById($id);

		$this->template->index('admin/edit_driver', $data);
		$this->load->view('_components/sideNavigation', $data);
	}


    public function store()
    {
        $uploadFoto = $this->upload_image('foto');
        if ($uploadFoto['status' == false]) {
            redirect('admin/tambah_driver');
        }

        $uploadKTP = $this->upload_image('ktp');
        if ($uploadKTP['status' == false]) {
            redirect('admin/tambah_driver');
        }

        $formData['driver_nik']          = $_POST['nik'];
        $formData['driver_nama']         = $_POST['nama'];
        $formData['driver_foto']         = $uploadFoto['link'];
        $formData['driver_foto_ktp']     = $uploadKTP['link'];
        $formData['driver_alamat']       = $_POST['alamat'];
        $formData['driver_telepon']      = $_POST['telp'];
        $formData['driver_gaji']         = $_POST['gaji'];
        $formData['driver_sim']          = implode(",", $_POST['sim']);
        $formData['driver_tanggalmasuk'] = $_POST['tanggal'];

        $this->MDriver->insert($formData);
        redirect('master/driver');
    }
    public function update()
    {
        if (!empty($_FILES['foto']['name'])) {
            $uploadFoto = $this->upload_image('foto');
            if ($uploadFoto['status' == false]) {
                redirect('admin/tambah_driver');
            } else {
                $formData['driver_foto'] = $uploadFoto['link'];
            }
        }

        if (!empty($_FILES['ktp']['name'])) {
            $uploadKTP = $this->upload_image('ktp');
            if ($uploadKTP['status' == false]) {
                redirect('admin/tambah_driver');
            } else {
                $formData['driver_foto_ktp'] = $uploadKTP['link'];
            }
        }


        $formData['driver_nik']         = $_POST['nik'];
        $formData['driver_nama']        = $_POST['nama'];
        $formData['driver_alamat']      = $_POST['alamat'];
        $formData['driver_telepon']     = $_POST['telp'];
        $formData['driver_gaji']         = $_POST['gaji'];
        $formData['driver_sim']         = implode(",", $_POST['sim']);

        $this->MDriver->update($formData);
        redirect('master/driver');
    }

    public function assign(){
        $this->load->model("MDriver");
        $kendaraan = explode('|', $_POST['kendaraan']);
        $dataStore['kendaraan_no_rangka'] = $kendaraan[0];
        $dataStore['kendaraan_stnk']      = $kendaraan[1];
        $dataStore['driver_nik']          = $_POST['driver_nik'];
        $dataStore['start_date']          = $_POST['awal'];
        $dataStore['end_date']            = $_POST['akhir'];
        $this->MDriver->insertTransKendaraan($dataStore);
        redirect('master/driver');
    }

    public function destroy()
    {
        $currDate = date('Y-m-d H:i:s');
        $data = [
            "driver_nik"    => $this->input->post('driver_nik'),
            "deleted_date"  => $currDate
        ];

        $this->MDriver->update($data);
        $this->db->where('driver_nik', $this->input->post('driver_nik'))->update('transaksi_driverkendaraan', ['disabled_date' => $currDate]);

        redirect('master/driver');
    }

    public function upload_image($resource)
    {
        $path = './assets/images/driver/' . $resource;
        $conf['upload_path']    = $path;
        $conf['allowed_types']  = "jpg|png|jpeg|bmp";
        $conf['max_size']       = 2048;
        $conf['file_name']      = time();
        $conf['encrypt_name']   = TRUE;

        $this->upload->initialize($conf);
        if ($this->upload->do_upload($resource)) {
            $img = $this->upload->data();
            return [
                'status' => true,
                'msg'   => 'Data berhasil terupload',
                'link'  => base_url($path . '/' . $img['file_name'])
            ];
        } else {
            return [
                'status' => false,
                'msg'   => $this->upload->display_errors(),
            ];
        }
    }
}
