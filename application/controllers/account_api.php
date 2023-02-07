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
            'student_number' => $this->input->post('student_number'),
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'course' => $this->input->post('course'),
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password')
        );

        $this->api_model->insert_api($data);

        $output = array(
            'success' => true
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
            'student_number' => $this->input->post('student_number'),
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'course' => $this->input->post('course'),
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password')
        );

        $this->api_model->update_api($this->input->post('id'), $data);
        $array = array(
            'success' => true
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
                $index['course'] = $response['program'];

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

    function test()
    {
        $perma = $this->api_model->currentSemSY();

        $SY = $perma['Grading_School_Year'];
        $sem = $perma['Grading_Semester'];

        // $data = $this->api_model->test($SY, $sem);

        echo json_encode($perma);
    }

    function changePass()
    {
        $stdnum = $this->input->post('student_number');
        $password = $this->input->post('password');

        $response = $this->api_model->checkAccount($stdnum);

        if ($response == true) {
            $data = array(
                'password' => $password
            );
            $success = $this->api_model->updateAccount($stdnum, $data);
            if ($success == true) {
                $result['success'] = "1";
                $result['message'] = "success";
            } else {
                $result['success'] = "0";
                $result['message'] = "error";
            }
        } else {
            $result['success'] = "0";
            $result['message'] = "not enrolled";
        }

        echo json_encode($result);
    }

    function authentication()
    {
        $perma = $this->api_model->currentSemSY();

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
                } else {
                    $valid = array(
                        'valid' => 0
                    );
                    $success = $this->api_model->updateAccount($stdnum, $valid);
                    $data['login'] = array();
                    $data['success'] = "0";
                    $data['status'] = "not enrolled";
                    $data['message'] = "not enrolled";
                }
            } else {
                $data['login'] = array();
                $data['success'] = "0";
                $data['status'] = "enrolled";
                $data['message'] = "wrong password";
            }
        }
        if ($checked == false) {
            if ($stdnum == $password) {
                $boolean = $this->api_model->checkEnrolled($stdnum, $SY, $sem);
                if ($boolean == "true") {
                    $account = $this->api_model->accounts($stdnum, $SY, $sem);

                    $newAcc = array(
                        'student_number' => $account['Student_Number'],
                        'first_name' => $account['First_Name'],
                        'middle_name' => $account['Middle_Name'],
                        'last_name' => $account['Last_Name'],
                        'course' => $account['Course'],
                        'year_level' => $account['Year_Level'],
                        'school_year' => $account['School_Year'],
                        'semester' => $account['Semester'],
                        'reference_number' => $account['Reference_Number'],
                        'password' => $account['Student_Number']
                    );
                    $success = $this->api_model->addAccount($newAcc);

                    if ($success == true) {

                        $response = $this->api_model->login($stdnum);

                        $data['login'] = array();
                        $container['student_number'] = $response['student_number'];
                        $container['first_name'] = $response['first_name'];
                        $container['last_name'] = $response['last_name'];
                        $container['password'] = $response['password'];

                        array_push($data['login'], $container);

                        $data['success'] = "1";
                        $data['status'] = "enrolled";
                        $data['message'] = "registered";
                    } else {
                        $data['login'] = array();
                        $data['success'] = "0";
                        $data['status'] = "enrolled";
                        $data['message'] = "error";
                    }
                } else {
                    $data['login'] = array();
                    $data['success'] = "0";
                    $data['status'] = "not enrolled";
                    $data['message'] = "not enrolled";
                }
            } else {
                $data['login'] = array();
                $data['success'] = "0";
                $data['message'] = "not matching";
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
                } else {
                    $data['login'] = array();
                    $data['success'] = "0";
                    $data['status'] = "not enrolled";
                    $data['message'] = "not enrolled";
                }
            } else {
                $data['login'] = array();
                $data['success'] = "0";
                $data['status'] = "enrolled";
                $data['message'] = "wrong password";
            }
        }
        echo json_encode($data);
    }

    function getDefaultSched()
    {
        $perma = $this->api_model->currentSemSY();

        $SY = $perma['Grading_School_Year'];
        $sem = $perma['Grading_Semester'];

        $stdnum = $this->input->post('student_number');

        $sched = $this->api_model->sched($stdnum, $SY, $sem);

        $data = array();

        foreach ($sched as $value) {
            $data1 = array(
                'student_number' => $value['Student_Number'],
                'SubCode' => $value['Course_Code'],
                'SubName' => $value['Course_Title'],
                'Day' => $value['Day'],
                'SubTimeStart' => $value['sched_start_time'],
                'SubTimeEnd' => $value['sched_end_time'],
                'SubRoomLoc' => $value['Room'],
                'SubNotes' => $value['Semester'] . " Semester of SY " . $SY
            );
            array_push($data, $data1);
        }
        $success = $this->api_model->addDefaultSched($data);
        if (end($success) == "insert") {
            $response['success'] = "1";
            $response['status'] = "inserted";
            $response['message'] = "success";
        }
        if (end($success) == "already exists") {
            $response['success'] = "0";
            $response['status'] = "unsuccessful";
            $response['message'] = "data already exists";
        }
        echo json_encode($response);
    }

    function apiAddSchedule()
    {
        $post['stdnum'] = $this->input->post('student_number');
        $post['subCode'] = $this->input->post('sub_code');
        $post['subName'] = $this->input->post('sub_name');
        $post['subTimeStart'] = $this->input->post('sub_time_start');
        $post['subTimeEnd'] = $this->input->post('sub_time_end');
        $post['subNote'] = $this->input->post('sub_note');
        $post['subDay'] = $this->input->post('sub_day');
        $post['roomLoc'] = $this->input->post('sub_room_loc');

        $data = array(
            'student_number' => $post['stdnum'],
            'SubCode' => $post['subCode'],
            'SubName' => $post['subName'],
            'SubTimeStart' => $post['subTimeStart'],
            'SubTimeEnd' => $post['subTimeEnd'],
            'SubNotes' => $post['subNote'],
            'Day' => $post['subDay'],
            'SubRoomLoc' => $post['roomLoc']
        );

        $response = $this->api_model->addSchedule($data);
        echo json_encode($response);
    }
}