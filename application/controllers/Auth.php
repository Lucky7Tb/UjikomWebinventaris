<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('M_User', "User");
	}

	private function UserCheck()
	{
		$Username = $this->input->post('username');
		$Password = $this->input->post('password');
		$User = $this->User->GetUser($Username);

		if ($User) {
			if (password_verify($Password, $User['password'])) {
				$Data = [
					'user' => $Username,
					'level' => $User['level'],
					'email' => $User['email'],
					'login' => true
				];
				$this->session->set_userdata($Data);
				redirect('admin/index', 'refresh');
			} else {
				$this->session->set_flashdata('danger', 'Wrong Password !!!');
				echo password_hash($Password, PASSWORD_DEFAULT);
				redirect('auth/login', 'refresh');
			}
		} else {
			$this->session->set_flashdata('danger', "There is no username like: $Username !!!");
			redirect('auth/login', 'refresh');
		}
	}

	public function register()
	{
		$title['title'] = "Register";
		$this->form_validation->set_rules($this->User->RulesRegister());
		if ($this->session->userdata('level') == 3 || $this->session->userdata('level') == 2) {
			redirect('admin/index', 'refresh');
		}
		if ($this->form_validation->run() == false) {
			$this->load->view('authlayout/header', $title);
			$this->load->view('auth/register');
			$this->load->view('authlayout/footer');
		} else {
			$this->User->AddUser();
			$this->session->set_flashdata('success', 'Registration is complete !!!');
			redirect('auth/login', 'refresh');
		}
	}

	public function login()
	{
		$title['title'] = "Login";
		$this->form_validation->set_rules($this->User->RulesLogin());
		if ($this->session->has_userdata('login')) {
			redirect('admin/index', 'refresh');
		}

		if ($this->form_validation->run() == false) {
			$this->load->view('authlayout/header', $title);
			$this->load->view('auth/login');
			$this->load->view('authlayout/footer');
		} else {
			$this->UserCheck();
		}
	}

	public function logout()
	{
		$UserData = ['user', 'level', 'login'];

		$this->session->unset_userdata($UserData);
		redirect('auth/login', 'refresh');
	}
}
