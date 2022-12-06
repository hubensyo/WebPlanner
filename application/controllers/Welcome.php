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
		$data['student_number'] = $this->input->post('student_number');
		$data['first_name'] = $this->input->post('first_name');
		$data['middle_name'] = $this->input->post('middle_name');
		$data['last_name'] = $this->input->post('last_name');
		$data['program'] = $this->input->post('program');
		$data['email'] = $this->input->post('email');
		$data['password'] = $this->input->post('password');
		$this->SPModel->edit($id, $data);
		redirect('welcome/index');
	}

	public function add()
	{
		$data['student_number'] = $this->input->post('student_number');
		$data['first_name'] = $this->input->post('first_name');
		$data['middle_name'] = $this->input->post('middle_name');
		$data['last_name'] = $this->input->post('last_name');
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


	//to do list section
	public function todo()
	{
		$data['body'] = 'body/webtodo_view';
		$data['todolist'] = $this->SPModel->todoview();
		$this->load->view('layout/template', $data);
	}

	public function back()
	{
		$data['body'] = 'body/dashboard';
		$data['content'] = $this->SPModel->test();
		$this->load->view('layout/template', $data);
	}


	//calendar section
	public function calendar()
	{
		$data['body'] = 'body/calendar';
		$data['content'] = $this->SPModel->test2();
		$this->load->view('layout/template', $data);
	}

	public function update2($id)
	{
		// $data['title'] = $this->input->post('title');
		// $data['description'] = $this->input->post('description');
		// $data['date_start'] = $this->input->post('date_start');
		// $data['date_finish'] = $this->input->post('date_finish');
		// $this->SPModel->edit2($id, $data);
		redirect('welcome/calendar');
	}

	public function add2()
	{
		$eventID = $this->input->post('eventID');
		if (empty($eventID)) {
			$data['title'] = $this->input->post('title');
			$data['description'] = $this->input->post('description');
			$data['datetime_start'] =  $this->input->post('date_start');
			$data['datetime_finish'] = $this->input->post('date_finish');
			$this->SPModel->insert2($data);
		} else {
			$data['title'] = $this->input->post('title');
			$data['description'] = $this->input->post('description');
			$data['datetime_start'] = $this->input->post('date_start');
			$data['datetime_finish'] = $this->input->post('date_finish');
			$this->SPModel->edit2($eventID, $data);
		}
		redirect('welcome/calendar');
	}

	public function updateEvents()
	{
		try{
			$eventID = $this->input->post('ID');
			$data['title'] = $this->input->post('title');
			$data['description'] = $this->input->post('description');
			$data['datetime_start'] =  str_replace('T',' ',$this->input->post('date_start'));
			$data['datetime_finish'] = str_replace('T',' ',$this->input->post('date_finish'));
			$this->SPModel->edit2($eventID, $data);
			echo json_encode($data);
			
		}
		catch(Exception $e){ 
			echo json_encode($e);
		}
	}

	public function fetchEvents()
	{
		$getTodo = $this->SPModel->getTodo();
		echo json_encode($getTodo);
	}

	//Date Click
	public function fetchDateClickEvent()
	{
		$data['datetime_start'] = $this->input->post('date');
		$getDateEvent = $this->SPModel->fetchDateEvent($data['datetime_start']);
		echo json_encode($getDateEvent);
	}

	public function fetchDateClickEventInfo()
	{
		$data['ID'] = $this->input->post('ID');
		$getDateEvent = $this->SPModel->fetchDateEventInfo($data['ID']);
		echo json_encode($getDateEvent);
	}

	//Event Click
	public function fetchClickEvent()
	{
		$data['datetime_start'] = $this->input->post('date');
		$getEvent = $this->SPModel->fetchEvent($data['datetime_start']);
		echo json_encode($getEvent);
	}

	public function fetchClickEventInfo()
	{
		$data['ID'] = $this->input->post('ID');
		$getEvent = $this->SPModel->fetchEventInfo($data['ID']);
		echo json_encode($getEvent);
	}

	//Delete Event

	public function deleteEvent($param = "")
	{
		$id = $param;
		$data['valid'] = 0;
		$response = $this->SPModel->edit3($id, $data);
		echo json_encode($response);
		redirect('welcome/calendar');
	}

	public function deleteEventInfo()
	{
		$data['ID'] = $this->input->post('ID');
		$delEvent = $this->SPModel->fetchEventInfo($data['ID']);
		echo json_encode($delEvent);
	}
}
