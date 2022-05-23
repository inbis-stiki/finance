<?php

class Profile extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('MUser');
        $this->load->library('upload');
    }
    public function edit($username){
        if($this->session->userdata('username') != $username){
            redirect('/');
        }

		$data['title']  = 'admin';
        $data['user']   = $this->MUser->getById($username);

		$this->template->index('profile', $data);
		$this->load->view('_components/sideNavigation', $data);
    }
    public function update(){
        if (!empty($_FILES['foto']['name'])) {
            $uploadFoto = $this->upload_image('foto');
            print_r($uploadFoto);
            // if ($uploadFoto['status' == false]) {
            //     $this->session->set_flashdata('err_msg', $uploadFoto['msg']);
            //     redirect('profile/edit/'.$_POST['username']);
            // } else {
            //     $formData['user_img'] = $uploadFoto['link'];
            // }
        }

        // $formData['user_username'] = $_POST['username'];
        // $formData['user_nama']     = $_POST['nama'];
        // $this->MUser->update($formData);

        // if(!empty($formData)) $this->session->set_userdata('foto', $formData['user_img']);
        // $this->session->set_userdata('name', $_POST['nama']);

        // $this->session->set_flashdata('succ_msg', 'Berhasil mengubah data pengguna!');
        // redirect('profile/edit/'.$_POST['username']);
    }
    public function changePass(){
        $this->MUser->update(['user_username' => $_POST['username'], 'user_password' => hash('sha256', md5($_POST['pass']))]);
        $this->session->set_flashdata('succ_msg', 'Berhasil mengubah password!');
        redirect('profile/edit/'.$_POST['username']);
    }
    public function upload_image($resource)
    {
        $path = 'assets/images/user';
        $conf['upload_path']    = $path;
        $conf['allowed_types']  = "jpg|png|jpeg|bmp";
        $conf['max_size']       = 2048;
        $conf['file_name']      = time();
        $conf['encrypt_name']   = TRUE;

        print_r($resource);

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