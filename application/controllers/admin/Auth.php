<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function index()
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('user_password', 'User_password', 'trim|required');

		if ($this->form_validation->run() == false) {
			$data['title'] = 'login';
			$this->template->login('admin/login', $data);
		} else {
			//validasi sukses
			$this->_login();
		}
	}

	private function _login()
	{
		$username 	   = $this->input->post('username');
		$password 	   = $this->input->post('user_password');

		$user = $this->db->get_where('master_user', ['username' => $username])->row_array();

		//jika usernya ada
		if ($user) {
			//cek password
			if (password_verify($password, $user['user_password'])) {
				$data = [
					'username' => $user['username'],
					'user_role' => $user['user_role']
				];
				if ($user['user_role'] == 1) {
					$this->load->view('_components/sideNavigation', $data);
					$this->session->set_userdata($data);
					redirect('admin/dashboard');
				} else {
					echo 'Ini untuk management';
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Username atau Password yang anda masukan salah! </div>');
				redirect('admin/Auth');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Username atau Password yang anda masukan salah! </div>');
			redirect('admin/Auth');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('user_role');

		redirect('admin/Auth');
	}
}
