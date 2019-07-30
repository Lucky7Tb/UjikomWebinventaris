<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Model_user', "User");
	}

	private function user_check()
	{
		$Username = $this->input->post('username');
		$Password = $this->input->post('password');
		$User = $this->User->GetUser($Username);

		if ($User) {
			if($User['status'] == 0){
				$this->session->set_flashdata('danger', "Akun anda belum aktif silahkan hubungi admin");
				redirect('auth/login', 'refresh');
			}else if($User['status'] == 10){
				if (password_verify($Password, $User['password'])) {
					$Data = [
						'user' => $Username,
						'level' => $User['level'],
						'email' => $User['email'],
						'login' => TRUE
					];
					$this->session->set_userdata($Data);
					redirect('admin/index/', 'refresh');
				} else {
					$this->session->set_flashdata('danger', 'Password salah!!!');
					redirect('auth/login', 'refresh');
				}
			}
		} else {
			$this->session->set_flashdata('danger', "Tidak ada username seperti : $Username !!!");
			redirect('auth/login', 'refresh');
		}
	}

	public function register()
	{
		$title['title'] = "Register";
		$this->form_validation->set_rules($this->User->RulesRegister());
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('authlayout/header', $title);
			$this->load->view('auth/register');
			$this->load->view('authlayout/footer');
		} else {
			$this->User->AddUser();
			if ($this->session->userdata('level') == 1 || $this->session->userdata('level') == 2) {
				$this->session->set_flashdata('success', 'Registrasi telah berhasil !!!');
				redirect('admin/index', 'refresh');
			} else {
				$this->session->set_flashdata('success', 'Registrasi telah berhasil !!!');
				$options = array(
					'cluster' => 'ap1',
					'useTLS' => true
				);
				$pusher = new Pusher\Pusher(
					'6e49ca7b930fac5e00f3',
					'a7181f27bc21d40de468',
					'831787',
					$options
				);

				$data['message'] = 'success';
				$data['user'] = $this->User->CountUserNotActived();
				$pusher->trigger('my-channel', 'my-event', $data);
				redirect('auth/login', 'refresh');
			}
		}
	}

	public function login()
	{
		$title['title'] = "Login";
		$this->form_validation->set_rules($this->User->RulesLogin());
		if ($this->session->has_userdata('login')) {
			redirect('admin/index', 'refresh');
		}
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('authlayout/header', $title);
			$this->load->view('auth/login');
			$this->load->view('authlayout/footer');
		} else {
			$this->user_check()();
		}
	}

	public function logout()
	{
		$UserData = ['user', 'level', 'login'];
		$this->session->unset_userdata($UserData);
		redirect('auth/login', 'refresh');
	}
}
