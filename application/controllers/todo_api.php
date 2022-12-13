<?php
defined('BASEPATH') or exit('No direct script access allowed');

class todo_api extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('TDModel');
    }

    function index()
    {
        $data = $this->TDModel->fetch_all();
        echo json_encode($data->result_array());
    }

    function todo()
    {
        $stdnum = $this->input->post('student_number');
        $data = $this->TDModel->task($stdnum);


        if (isset($stdnum)){
            if (!empty($data)){
                echo json_encode(['tasks'=>$data->result_array(), 'success'=> "1", 'message'=> "success"]);
            }
            else{
                $data['success'] = "0";
                $data['message'] = "error";
                echo json_encode(['tasks'=>$data->result_array()]);
            }
        }
        else{
            echo "null";
        }
        
        
    }

    function insert()
    {
        $data = array(
            'task'    =>  $this->input->post('task'),
            'student_number'     =>  $this->input->post('student_number'),
            'date_start'     =>  $this->input->post('date_start'),
            'date_end'     =>  $this->input->post('date_end'),
            'due_time'     =>  $this->input->post('due_time'),
            'status'     =>  $this->input->post('status')
        );

        $this->TDModel->insert_api($data);

        echo json_encode($data);
    }

    function update()
    {
        $data = array(
            'task'    =>  $this->input->post('task'),
            'student_number'     =>  $this->input->post('student_number'),
            'date_start'     =>  $this->input->post('date_start'),
            'date_end'     =>  $this->input->post('date_end'),
            'due_time'     =>  $this->input->post('due_time')
        );

        $task_id = $this->input->post('id');
        $stdnum = $this->input->post('student_number');

        $this->TDModel->update_api($task_id, $stdnum, $data);
        $array = array(
            'success'  => true
        );
        echo json_encode($array);
    }

    function fetch_single()
    {
        if ($this->input->post('id')) {
            $data = $this->TDModel->fetch_single_user($this->input->post('id'));
            foreach ($data as $row) {
                $output['task'] = $row['task'];
                $output['student_number'] = $row['student_number'];
                $output['date_start'] = $row['date_start'];
                $output['date_end'] = $row['date_end'];
                $output['due_time'] = $row['due_time'];
                $output['status'] = $row['status'];
            }
            echo json_encode($output);
        }
    }

    function fetch_item(){
        $task_id = $this->input->post('id');
        $data = $this->TDModel->edit($task_id);

        if (isset($task_id)){
            if (!empty($data)){
                echo json_encode(['edit'=>$data->row_array(), 'success'=> "1", 'message'=> "success"]);
            }
            else{
                $data['success'] = "0";
                $data['message'] = "error";
                echo json_encode(['edit'=>$data->row_array()]);
            }
        }
        else{
            echo "null";
        }

    }

    function delete()
    {
        if ($this->input->post('id')) {
            if ($this->TDModel->delete_single_user($this->input->post('id'))) {
                $array = array(
                    'success' => true
                );
            } else {
                $array = array(
                    'error' => true
                );
            }
            echo json_encode($array);
        }
    }
}
