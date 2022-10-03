<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
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
		$this->session->userdata('login')['ID_Admin'];
		if (empty($this->session->userdata('login')['ID_Admin'])) {
			redirect('login/login');
		}
	}

	// dashboard section
	public function index()
	{
		$data['body'] = 'body/dashboard';
		$data['content'] = $this->SPModel->test();
		$this->load->view('layout/template', $data);
	}

	public function update($id)
	{
		$data['student_no'] = $this->input->post('student_no');
		$data['name'] = $this->input->post('name');
		$data['program'] = $this->input->post('program');
		$data['email'] = $this->input->post('email');
		$data['password'] = $this->input->post('password');
		$this->SPModel->edit($id, $data);
		redirect('welcome/index');
	}

	public function add()
	{
		$data['student_no'] = $this->input->post('student_no');
		$data['name'] = $this->input->post('name');
		$data['program'] = $this->input->post('program');
		$data['email'] = $this->input->post('email');
		$data['password'] = $this->input->post('password');
		$data['valid'] = 1;
		$this->SPModel->insert($data);
		redirect('welcome/index');
	}

	// admin section
	public function admin()
	{
		$data['body'] = 'body/admin';
		$data['admin'] = $this->SPModel->test1();
		$this->load->view('layout/template', $data);
	}

	public function update1($id)
	{
		$data['name'] = $this->input->post('name');
		$data['program'] = $this->input->post('program');
		$data['email'] = $this->input->post('email');
		$data['password'] = $this->input->post('password');
		$data['position'] = $this->input->post('position');
		$this->SPModel->edit1($id, $data);
		redirect('welcome/admin');
	}

	public function add1()
	{
		$data['name'] = $this->input->post('name');
		$data['program'] = $this->input->post('program');
		$data['email'] = $this->input->post('email');
		$data['password'] = $this->input->post('password');
		$data['position'] = $this->input->post('position');
		$data['valid'] = 1;
		$this->SPModel->insert1($data);
		redirect('welcome/admin');
	}

	public function getsession()
	{	
		$data['position'] = $this->session->setsession();
		$this->session->userdata('position');
	}

	public function calendar()
	{
		$data['body'] = 'body/calendar';
		$data['content'] = $this->SPModel->test();
		$this->load->view('layout/template', $data);
	}

	public function fetchEvents()
	{
		$getTodo = $this->SPModel->getTodo();
		echo json_encode($getTodo);
	}

}
