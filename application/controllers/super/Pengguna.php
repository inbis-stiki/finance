<?php

class Pengguna extends CI_Controller{
    public function __construct(){
        parent::__construct();
        if($this->session->userdata('isManagement') != '1'){
            redirect('/');
        }
        $this->load->library('table');
        $this->load->model('MUser');
    }
    public function index(){
		$dataPengguna = $this->MUser->getAll();

		$data = [
			'title' => "admin",
			'User' => $dataPengguna,
		];

		$this->template->index('admin/pengguna', $data);
		$this->load->view('_components/sideNavigation', $data);
    }
    public function store(){
        $user = $this->MUser->get(['user_username' => $_POST['username']]);
        if($user != null){
            $this->session->set_flashdata('err_msg', 'Username telah dipakai!');
            redirect('super/pengguna');
        }

        $dataStore['user_username']     = $_POST['username'];
        $dataStore['user_nama']         = $_POST['nama'];
        $dataStore['user_password']     = hash('sha256', md5($_POST['password']));
        $dataStore['user_isManagement'] = !empty($_POST['isManagement']) ? '1' : '0';
        $dataStore['user_isAdmin']      = !empty($_POST['isAdmin']) ? '1' : '0';
        $dataStore['user_isMaster']     = !empty($_POST['isMaster']) ? '1' : '0';
        $dataStore['user_isSuper']      = !empty($_POST['isSuper']) ? '1' : '0';
        $this->MUser->insert($dataStore);
        redirect('super/pengguna');
    }
    public function update(){
        $dataStore['user_username']     = $_POST['username'];
        $dataStore['user_nama']         = $_POST['nama'];
        $dataStore['user_isManagement'] = !empty($_POST['isManagement']) ? '1' : '0';
        $dataStore['user_isAdmin']      = !empty($_POST['isAdmin']) ? '1' : '0';
        $dataStore['user_isMaster']     = !empty($_POST['isMaster']) ? '1' : '0';
        $dataStore['user_isSuper']      = !empty($_POST['isSuper']) ? '1' : '0';
        $this->MUser->update($dataStore);
        redirect('super/pengguna');
    }
    public function resetPassword(){
        $dataStore['user_username'] = $_POST['username'];
        $dataStore['user_password'] = hash('sha256', md5($_POST['password']));
        $this->MUser->update($dataStore);
        redirect('super/pengguna');
    }
    public function destroy(){
        $this->MUser->delete(['user_username' => $_POST['username']]);
        redirect('super/pengguna');
    }
}