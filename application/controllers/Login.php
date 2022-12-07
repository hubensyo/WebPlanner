<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */


	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('SPModel');
		$this->load->library('session');
	}


	public function index()
	{
		$data['loginbody'] = 'loginbody/login';
		$this->load->view('loginlayout/logintemplate', $data);
	}

	public function login()
	{
		$data['loginbody'] = 'loginbody/login';
		$this->load->view('loginlayout/logintemplate', $data);
	}

	public function setsession($data)
	{
		$login['ID_Admin'] = $data['ID_Admin'];
		$login['name'] = $data['name'];
		$login['program'] = $data['program'];
		$login['email'] = $data['email'];
		$login['position'] = $data['position'];
		$this->session->set_userdata('login', $login);	
	}

	public function loginprocess()
	{
		$data['email'] = $this->input->post('email');
		$data['password'] = $this->input->post('pass');
		$logindata = $this->SPModel->login($data);
		if (!empty($logindata)) {
			if ($logindata['position'] == "1") {
				// admin tab disabled
				echo 'Success Login';
				$this->session->set_flashdata('success', 'Instructor Mode');
				$this->setsession($logindata);
				redirect("welcome/student_dashboard");
			} else {
				// admin tab enabled
				echo 'Success Login';
				$this->session->set_flashdata('success', 'Admin Mode');
				$this->setsession($logindata);
				redirect("welcome/student_dashboard");
			}
		} else {
			echo 'Not Login';
			$this->session->set_flashdata('success', 'Nt boss');
			redirect("login/login");
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('login');
		redirect('login/login');
	}
}
