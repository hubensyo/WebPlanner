<?php
defined('BASEPATH') or exit('No direct script access allowed');

class account_api extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('api_model');
    }


    function index()
    {
        $data = $this->api_model->fetch_all();
        echo json_encode($data->result_array());
    }

    function insert()
    {
        $data = array(
            'student_number'     =>  $this->input->post('student_number'),
            'first_name'    =>  $this->input->post('first_name'),
            'last_name'    =>  $this->input->post('last_name'),
            'course'     =>  $this->input->post('course'),
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
        if ($this->input->post('id')) {
            $data = $this->api_model->fetch_single_user($this->input->post('id'));
            foreach ($data as $row) {
                $output['student_number'] = $row['student_number'];
                $output['first_name'] = $row['first_name'];
                $output['last_name'] = $row['last_name'];
                $output['course'] = $row['course'];
                $output['email'] = $row['email'];
                $output['password'] = $row['password'];
            }
            echo json_encode($output);
        }
    }

    function update()
    {
        $data = array(
            'student_number'     =>  $this->input->post('student_number'),
            'first_name'    =>  $this->input->post('first_name'),
            'last_name'    =>  $this->input->post('last_name'),
            'course'     =>  $this->input->post('course'),
            'email'     =>  $this->input->post('email'),
            'password'     =>  $this->input->post('password')
        );

        $this->api_model->update_api($this->input->post('id'), $data);
        $array = array(
            'success'  => true
        );

        echo json_encode($array, true);
    }

    function delete()
    {
        if ($this->input->post('id')) {
            if ($this->api_model->delete_single_user($this->input->post('id'))) {
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

    function authentication2()
    {
        $stdnum = $this->input->post('student_number');
        $password = $this->input->post('password');
        $response = $this->api_model->login($stdnum);
        // echo $password;
        // echo $stdnum;
        // echo $password;
        // echo $response['password'];

        $result = array();
        $result['login'] = array();

        if (isset($stdnum, $password)) {

            if ($password === $response['password']) {

                $index['id'] = $response['id'];
                $index['student_number'] = $response['student_number'];
                $index['first_name'] = $response['first_name'];
                $index['last_name'] = $response['last_name'];
                $index['course'] = $response['course'];

                array_push($result['login'], $index);

                $result['success'] = "1";
                $result['message'] = "success";
                echo json_encode($result);
            } else {
                $result['success'] = "0";
                $result['message'] = "error";
                echo json_encode($result);
            }
        } else {
            echo "null";
        }
    }

    // function test()
    // {
    //     $perma = $this->api_model->testUpdate();

    //     $SY = $perma['Grading_School_Year'];
    //     $sem = $perma['Grading_Semester'];

    //     $data = $this->api_model->test($SY, $sem);

    //     echo json_encode($data);
    // }

    function authentication()
    {
        $perma = $this->api_model->testUpdate();

        $SY = $perma['Grading_School_Year'];
        $sem = $perma['Grading_Semester'];

        $stdnum = $this->input->post('student_number');
        $password = $this->input->post('password');

        $checked = $this->api_model->checkAccount($stdnum);
        if ($checked == true) {
            $response = $this->api_model->login($stdnum);
            if ($password = $response['password']) {
                $boolean = $this->api_model->checkEnrolled($stdnum, $SY, $sem);
                if ($boolean == "true") {
                    $data['login'] = array();
                    $container['student_number'] = $response['student_number'];
                    $container['first_name'] = $response['first_name'];
                    $container['last_name'] = $response['last_name'];
                    $container['password'] = $response['password'];

                    array_push($data['login'], $container);

                    $data['success'] = "1";
                    $data['status'] = "enrolled";
                    $data['message'] = "logged in";
                    // echo json_encode($data);
                } else {
                    $valid = array(
                        'valid' => 0
                    );
                    $success = $this->api_model->updateAccount($stdnum, $valid);
                    $data['success'] = "0";
                    $data['status'] = "not enrolled";
                    $data['message'] = "not enrolled";
                    // echo json_encode($data);
                }
            } else {
                $data['success'] = "0";
                $data['status'] = "enrolled";
                $data['message'] = "wrong password";
                // echo json_encode($data);
            }
        }
        if ($checked == false) {
            if ($stdnum == $password) {
                $boolean = $this->api_model->checkEnrolled($stdnum, $SY, $sem);
                if ($boolean == "true") {
                    $account = $this->api_model->accTest($stdnum, $SY, $sem);

                    $newAcc = array(
                        'student_number'     =>  $account['Student_Number'],
                        'first_name'    =>  $account['First_Name'],
                        'middle_name'     =>  $account['Middle_Name'],
                        'last_name'    =>  $account['Last_Name'],
                        'course'     =>  $account['Course'],
                        'year_level'     =>  $account['Year_Level'],
                        'school_year'     =>  $account['School_Year'],
                        'semester'     =>  $account['Semester'],
                        'reference_number'     =>  $account['Reference_Number'],
                        'password'     =>  $account['Student_Number']
                    );
                    $success = $this->api_model->addAccount($newAcc);

                    // echo json_encode($success);
                    if ($success == true) {
                        $data['success'] = "1";
                        $data['status'] = "enrolled";
                        $data['message'] = "registered";
                        // echo json_encode($data);
                    } else {
                        $data['success'] = "0";
                        $data['status'] = "enrolled";
                        $data['message'] = "error";
                        // echo json_encode($data);
                    }
                } else {
                    $data['success'] = "0";
                    $data['status'] = "not enrolled";
                    // echo json_encode($data);
                }
            } else {
                $data['success'] = "0";
                $data['message'] = "not matching";
                // echo json_encode($data);
            }
        }
        if ($checked == "not enrolled") {
            $response = $this->api_model->login($stdnum);
            if ($password = $response['password']) {
                $boolean = $this->api_model->checkEnrolled($stdnum, $SY, $sem);
                if ($boolean == "true") {
                    $valid = array(
                        'valid' => 1
                    );
                    $success = $this->api_model->updateAccount($stdnum, $valid);
                    $data['success'] = "1";
                    $data['status'] = "enrolled";
                    $data['message'] = "logged in";
                    // echo json_encode($data);
                } else {
                    $data['success'] = "0";
                    $data['status'] = "not enrolled";
                    $data['message'] = "not enrolled";
                    // echo json_encode($data);
                }
            } else {
                $data['success'] = "0";
                $data['status'] = "enrolled";
                $data['message'] = "wrong password";
                // echo json_encode($data);
            }
        }
        echo json_encode($data);
    }
}
