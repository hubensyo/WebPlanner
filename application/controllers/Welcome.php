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
		$this->load->model('TDModel');
		$this->load->model('api_model');
		$this->load->library('session');
		$this->session->userdata('login')['ID_Admin'];
		if (empty($this->session->userdata('login')['ID_Admin'])) {
			redirect('login/login');
		}
	}

	// dashboard section
	public function student_dashboard()
	{
		$data['body'] = 'body/dashboard';
		$data['content'] = $this->SPModel->student_dashboard();
		$this->load->view('layout/template', $data);
	}

	public function update_students($student_number)
	{
		$data['student_number'] = $this->input->post('student_number');
		$data['first_name'] = $this->input->post('first_name');
		$data['middle_name'] = $this->input->post('middle_name');
		$data['last_name'] = $this->input->post('last_name');
		$data['program'] = $this->input->post('program');
		$data['email'] = $this->input->post('email');
		$data['password'] = $this->input->post('password');
		$this->SPModel->edit_students($student_number, $data);
		// print_r($data);
		// die;
		redirect('welcome/student_dashboard');
	}

	public function add_students()
	{
		$data['student_number'] = $this->input->post('student_number');
		$data['first_name'] = $this->input->post('first_name');
		$data['middle_name'] = $this->input->post('middle_name');
		$data['last_name'] = $this->input->post('last_name');
		$data['program'] = $this->input->post('program');
		$data['email'] = $this->input->post('email');
		$data['password'] = $this->input->post('password');
		$data['valid'] = 1;
		$this->SPModel->insert_students($data);
		redirect('welcome/student_dashboard');
	}

	// admin section
	public function admin()
	{
		$data['body'] = 'body/admin';
		$data['admin'] = $this->SPModel->admin_dashboard();
		$this->load->view('layout/template', $data);
	}

	public function update_admin($id)
	{
		$data['name'] = $this->input->post('name');
		$data['program'] = $this->input->post('program');
		$data['email'] = $this->input->post('email');
		$data['password'] = $this->input->post('password');
		$data['position'] = $this->input->post('position');
		$this->SPModel->edit_admin($id, $data);
		redirect('welcome/admin');
	}

	public function add_admin()
	{
		$data['name'] = $this->input->post('name');
		$data['program'] = $this->input->post('program');
		$data['email'] = $this->input->post('email');
		$data['password'] = $this->input->post('password');
		$data['position'] = $this->input->post('position');
		$data['valid'] = 1;
		$this->SPModel->insert_admin($data);
		redirect('welcome/admin');
	}

	public function add_task()
	{
		$data['task'] = $this->input->post('task');
		$data['student_number'] = $this->input->post('student_number');
		$data['date_start'] = $this->input->post('date_start');
		$data['date_end'] = $this->input->post('date_end');
		$data['due_time'] = $this->input->post('due_time');
		$data['status'] = 1;
		$data['valid'] = 1;
		$this->SPModel->insert_task($data);
		redirect('welcome/todo/' . $data['student_number']);
	}

	public function getsession()
	{
		$data['position'] = $this->session->setsession();
		$this->session->userdata('position');
	}


	//to do list section
	public function todo($param = '')
	{
		$studnum = $param;
		$data['student_number'] = $studnum;
		$data['body'] = 'body/webtodo_view';
		$data['todolist'] = $this->SPModel->todoview($studnum);
		// print_r($studnum);
		$this->load->view('layout/template', $data);
	}

	public function todo_update($id)
	{
		$data['task'] = $this->input->post('task');
		$data['student_number'] = $this->input->post('student_number');
		$data['date_start'] = $this->input->post('date_start');
		$data['date_end'] = $this->input->post('date_end');
		$data['due_time'] = $this->input->post('due_time');
		$data['status'] = 1;
		$this->SPModel->edit_todo($id, $data);
		// echo json_encode($data);
		redirect('welcome/todo/' . $data['student_number']);
	}

	public function todo_all()
	{
		$data['body'] = 'body/all_todo';
		$data['todolist'] = $this->SPModel->todo_allview();
		// print_r($studnum);
		$this->load->view('layout/template', $data);
	}

	public function add_alltask()
	{
		$data['task'] = $this->input->post('task');
		$data['student_number'] = $this->input->post('student_number');
		$data['date_start'] = $this->input->post('date_start');
		$data['date_end'] = $this->input->post('date_end');
		$data['due_time'] = $this->input->post('due_time');
		$data['status'] = 1;
		$data['valid'] = 1;
		$this->SPModel->insert_task($data);
		redirect('welcome/todo_all');
	}

	public function todoall_update($id)
	{
		$data['task'] = $this->input->post('task');
		$data['student_number'] = $this->input->post('student_number');
		$data['date_start'] = $this->input->post('date_start');
		$data['date_end'] = $this->input->post('date_end');
		$data['due_time'] = $this->input->post('due_time');
		$data['status'] = 1;
		$this->SPModel->edit_todo($id, $data);
		// echo json_encode($data);
		redirect('welcome/todo_all');
	}

	public function back()
	{
		$data['body'] = 'body/dashboard';
		$data['content'] = $this->SPModel->student_dashboard();
		$this->load->view('layout/template', $data);
	}

	public function delete($param = "")
	{
		$student_number = $param;
		$data = array(
			'valid' => 0
		);
		$this->SPModel->edit_students($student_number, $data);
		redirect('welcome/student_dashboard');
	}

	public function delete_admin($param = "")
	{
		$name = $param;
		$data = array(
			'valid' => 0
		);
		$this->SPModel->edit_admin($name, $data);
		redirect('welcome/admin');
	}

	public function delete_todo($param = "")
	{
		$name = $param;
		$data = array(
			'valid' => 0
		);
		$this->SPModel->edit_todo($name, $data);
		redirect('welcome/todo');
	}



	//calendar section
	public function calendar()
	{
		$data['body'] = 'body/calendar';
		$data['content'] = $this->SPModel->calendar_view();
		$this->load->view('layout/template', $data);
	}

	// public function update2($id)
	// {
	// 	// $data['title'] = $this->input->post('title');
	// 	// $data['description'] = $this->input->post('description');
	// 	// $data['date_start'] = $this->input->post('date_start');
	// 	// $data['date_finish'] = $this->input->post('date_finish');
	// 	// $this->SPModel->edit2($id, $data);
	// 	redirect('welcome/calendar');
	// }

	public function add_CalendarEvent()
	{
		$eventID = $this->input->post('eventID');
		if (empty($eventID)) {
			$data['title'] = $this->input->post('title');
			$data['description'] = $this->input->post('description');
			$data['datetime_start'] =  $this->input->post('date_start');
			$data['datetime_finish'] = $this->input->post('date_finish');
			$this->SPModel->insert_calendar($data);
		} else {
			$data['title'] = $this->input->post('title');
			$data['description'] = $this->input->post('description');
			$data['datetime_start'] = $this->input->post('date_start');
			$data['datetime_finish'] = $this->input->post('date_finish');
			$this->SPModel->edit_calendar($eventID, $data);
		}
		redirect('welcome/calendar');
	}

	public function updateEvents()
	{
		try {
			$eventID = $this->input->post('ID');
			$data['title'] = $this->input->post('title');
			$data['description'] = $this->input->post('description');
			$data['datetime_start'] =  str_replace('T', ' ', $this->input->post('date_start'));
			$data['datetime_finish'] = str_replace('T', ' ', $this->input->post('date_finish'));
			$this->SPModel->edit_calendar($eventID, $data);
			echo json_encode($data);
		} catch (Exception $e) {
			echo json_encode($e);
		}
	}

	public function fetchEvents()
	{
		$getEvents = $this->SPModel->getEvents();
		echo json_encode($getEvents);
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
		$response = $this->SPModel->delete_event($id, $data);
		echo json_encode($response);
		redirect('welcome/calendar');
	}

	public function deleteEventInfo()
	{
		$data['ID'] = $this->input->post('ID');
		$delEvent = $this->SPModel->fetchEventInfo($data['ID']);
		echo json_encode($delEvent);
	}

	// need adam for future
	// todo api
	// function index()
	//     {
	//         $data = array(
	//             'student_number'    =>  $this->input->post('student_number')
	//         );
	//         $data = $this->TDModel->fetch_all($data);
	//         echo json_encode($data->result_array());
	//     }

	//     function todo()
	//     {
	//         $stdnum = $this->input->post('student_number');
	//         $data = $this->TDModel->task($stdnum);


	//         if (isset($stdnum)){
	//             if (!empty($data)){
	//                 echo json_encode(['tasks'=>$data->result_array(), 'success'=> "1", 'message'=> "success"]);
	//             }
	//             else{
	//                 $data['success'] = "0";
	//                 $data['message'] = "error";
	//                 echo json_encode(['tasks'=>$data->result_array()]);
	//             }
	//         }
	//         else{
	//             echo "null";
	//         }


	//     }

	//     function insert()
	//     {
	//         $data = array(
	//             'task'    =>  $this->input->post('task'),
	//             'student_number'     =>  $this->input->post('student_number'),
	//             'date_start'     =>  $this->input->post('date_start'),
	//             'date_end'     =>  $this->input->post('date_end'),
	//             'due_time'     =>  $this->input->post('due_time'),
	//             'status'     =>  $this->input->post('status')
	//         );

	//         $this->TDModel->insert_api($data);

	//         echo json_encode($data);
	//     }

	//     function update()
	//     {
	//         $data = array(
	//             'task'    =>  $this->input->post('task'),
	//             'student_number'     =>  $this->input->post('student_number'),
	//             'date_start'     =>  $this->input->post('date_start'),
	//             'date_end'     =>  $this->input->post('date_end'),
	//             'due_time'     =>  $this->input->post('due_time')
	//         );

	//         $task_id = $this->input->post('id');
	//         $stdnum = $this->input->post('student_number');

	//         $this->TDModel->update_api($task_id, $stdnum, $data);
	//         $array = array(
	//             'success'  => true
	//         );
	//         echo json_encode($array);
	//     }

	//     function fetch_single()
	//     {
	//         if ($this->input->post('id')) {
	//             $data = $this->TDModel->fetch_single_user($this->input->post('id'));
	//             foreach ($data as $row) {
	//                 $output['task'] = $row['task'];
	//                 $output['student_number'] = $row['student_number'];
	//                 $output['date_start'] = $row['date_start'];
	//                 $output['date_end'] = $row['date_end'];
	//                 $output['due_time'] = $row['due_time'];
	//                 $output['status'] = $row['status'];
	//             }
	//             echo json_encode($output);
	//         }
	//     }

	//     function fetch_item(){
	//         $task_id = $this->input->post('id');
	//         $data = $this->TDModel->edit($task_id);

	//         if (isset($task_id)){
	//             if (!empty($data)){
	//                 echo json_encode(['edit'=>$data->row_array(), 'success'=> "1", 'message'=> "success"]);
	//             }
	//             else{
	//                 $data['success'] = "0";
	//                 $data['message'] = "error";
	//                 echo json_encode(['edit'=>$data->row_array()]);
	//             }
	//         }
	//         else{
	//             echo "null";
	//         }

	//     }

	//     function delete()
	//     {
	//         if ($this->input->post('id')) {
	//             if ($this->TDModel->delete_single_task($this->input->post('id'))) {
	//                 $array = array(
	//                     'success' => true
	//                 );
	//             } else {
	//                 $array = array(
	//                     'error' => true
	//                 );
	//             }
	//             echo json_encode($array);
	//         }
	//     }

	//account api
	// function index(){
	// 	$data = $this->api_model->fetch_all();
	// 	echo json_encode($data->result_array());

	// }

	// function insert(){
	// 	$data = array(
	// 		'student_number'     =>  $this->input->post('student_number'),
	// 		'first_name'    =>  $this->input->post('first_name'),
	// 		'last_name'    =>  $this->input->post('last_name'),
	// 		'program'     =>  $this->input->post('program'),
	// 		'email'     =>  $this->input->post('email'),
	// 		'password'     =>  $this->input->post('password')
	// 	);

	// 	$this->api_model->insert_api($data);

	// 	$output = array(
	// 		'success'       =>  true
	// 	);

	// 	echo json_encode($data);
	// }

	// function fetch_single()
	// {
	// 	if($this->input->post('id')){
	// 		$data = $this->api_model->fetch_single_user($this->input->post('id'));
	// 		foreach($data as $row){
	// 			$output['student_number'] = $row['student_number'];
	// 			$output['first_name'] = $row['first_name'];
	// 			$output['last_name'] = $row['last_name'];
	// 			$output['program'] = $row['program'];
	// 			$output['email'] = $row['email'];
	// 			$output['password'] = $row['password'];
	// 		}
	// 		echo json_encode($output);
	// 	}
	// }

	// function update(){
	// 	$data = array(
	// 		'student_number'     =>  $this->input->post('student_number'),
	// 		'first_name'    =>  $this->input->post('first_name'),
	// 		'last_name'    =>  $this->input->post('last_name'),
	// 		'program'     =>  $this->input->post('program'),
	// 		'email'     =>  $this->input->post('email'),
	// 		'password'     =>  $this->input->post('password')
	// 	);

	// 	$this->api_model->update_api($this->input->post('id'), $data);
	// 	$array = array(
	// 		'success'  => true
	// 	);

	// 	echo json_encode($array, true);
	// }

	// function delete(){
	// 	if($this->input->post('id')){
	// 		if($this->api_model->delete_single_user($this->input->post('id'))){
	// 			$array = array(
	// 			'success' => true
	// 		);}
	// 		else{
	// 			$array = array(
	// 			'error' => true
	// 		);}
	// 	echo json_encode($array);
	// 	}
	// }

	// function authentication(){
	// 	$stdnum = $this->input->post('student_number');
	// 	$password = $this->input->post('password');
	// 	$response = $this->api_model->login($stdnum);
	// 	// echo $password;
	// 	// echo $stdnum;
	// 	// echo $password;
	// 	// echo $response['password'];

	// 	$result = array();
	// 	$result['login'] = array();

	// 	if (isset($stdnum, $password)){

	// 		if ($password === $response['password']){

	// 			$index['id'] = $response['id'];
	// 			$index['student_number'] = $response['student_number'];
	// 			$index['first_name'] = $response['first_name'];
	// 			$index['last_name'] = $response['last_name'];
	// 			$index['program'] = $response['program'];
	// 			$index['email'] = $response['email'];

	// 			array_push($result['login'], $index);

	// 			$result['success'] = "1";
	// 			$result['message'] = "success";
	// 			echo json_encode($result);                

	// 			}
	// 		else{
	// 				$result['success'] = "0";
	// 				$result['message'] = "error";
	// 				echo json_encode($result);
	// 			}
	// 	}
	// 	else{
	// 		echo "null";
	// 	}

	// }
}
