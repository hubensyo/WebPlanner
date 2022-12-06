<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class account_api extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->model('api_model');
    }


    function index(){
        $data = $this->api_model->fetch_all();
        echo json_encode($data->result_array());
        
    }

    function insert(){
        $data = array(
            'student_number'     =>  $this->input->post('student_number'),
            'first_name'    =>  $this->input->post('first_name'),
            'last_name'    =>  $this->input->post('last_name'),
            'program'     =>  $this->input->post('program'),
            'email'     =>  $this->input->post('email'),
            'password'     =>  $this->input->post('password')
        );

        $this->api_model->insert_api($data);
        
        $output = array(
            'success'       =>  true
        );

        echo json_encode($data);
    }

    function fetch_single()
    {
        if($this->input->post('id')){
            $data = $this->api_model->fetch_single_user($this->input->post('id'));
            foreach($data as $row){
                $output['student_number'] = $row['student_number'];
                $output['first_name'] = $row['first_name'];
                $output['last_name'] = $row['last_name'];
                $output['program'] = $row['program'];
                $output['email'] = $row['email'];
                $output['password'] = $row['password'];
            }
            echo json_encode($output);
        }
    }

    function update(){
        $data = array(
            'student_number'     =>  $this->input->post('student_number'),
            'first_name'    =>  $this->input->post('first_name'),
            'last_name'    =>  $this->input->post('last_name'),
            'program'     =>  $this->input->post('program'),
            'email'     =>  $this->input->post('email'),
            'password'     =>  $this->input->post('password')
        );

        $this->api_model->update_api($this->input->post('id'), $data);
        $array = array(
            'success'  => true
        );

        echo json_encode($array, true);
    }

    function delete(){
        if($this->input->post('id')){
            if($this->api_model->delete_single_user($this->input->post('id'))){
                $array = array(
                'success' => true
            );}
            else{
                $array = array(
                'error' => true
            );}
        echo json_encode($array);
        }
    }

    function authentication(){
        $stdnum = $this->input->post('student_number');
        $password = $this->input->post('password');
        $response = $this->api_model->login($stdnum);
        // echo $password;
        // echo $stdnum;
        // echo $password;
        // echo $response['password'];
        
        $result = array();
        $result['login'] = array();
                
        if (isset($stdnum, $password)){

            if ($password === $response['password']){
                
                $index['id'] = $response['id'];
                $index['student_number'] = $response['student_number'];
                $index['first_name'] = $response['first_name'];
                $index['last_name'] = $response['last_name'];
                $index['program'] = $response['program'];
                $index['email'] = $response['email'];

                array_push($result['login'], $index);

                $result['success'] = "1";
                $result['message'] = "success";
                echo json_encode($result);                
                
                }
            else{
                    $result['success'] = "0";
                    $result['message'] = "error";
                    echo json_encode($result);
                }
        }
        else{
            echo "null";
        }

    }
    
}

