<?php

class Auth extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('MUser');
    }
    public function login(){
        $user = $this->MUser->get(['user_username' => $_POST['username']]);
        if($user != null){ // check user is found
            if($user[0]->user_password == hash('sha256', md5($_POST['user_password']))){ // check password is correct
                $this->setSession($user);
                if($user[0]->user_ismanagement == "1"){
                    redirect('management');
                }else if($user[0]->user_isadmin == "1"){
                    redirect('admin');
                }else if($user[0]->user_ismaster == "1"){
                    redirect('master/driver');
                }else if($user[0]->user_issuper == "1"){
                    redirect('super/pengguna');
                }
            }
        }
        $this->session->set_flashdata('err_msg', 'Username atau password salah!');
        redirect('/');
    }
    public function logout(){
        $this->session->sess_destroy();
        redirect('/');
    }
    public function setSession($param){
        $data['username']       = $param[0]->user_username;
        $data['name']           = $param[0]->user_nama;
        $data['isLogged']       = true;
        $data['isAdmin']        = $param[0]->user_isadmin;
        $data['isManagement']   = $param[0]->user_ismanagement;
        $data['isMaster']       = $param[0]->user_ismaster;
        $data['isSuper']        = $param[0]->user_issuper;
        $this->session->set_userdata($data);
    }
}