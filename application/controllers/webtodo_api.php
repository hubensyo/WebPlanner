<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class webtodo_api extends CI_Controller {

	function index(){
        $this->load->view('webtodo_view');
    }

    function action(){
        if($this->input->post('data_action')){
            $data_action = $this->input->post('data_action');
            
            if($data_action == "Delete")
            {
                $api_url = "http://10.0.3.36/tims/index.php/todo_api/delete";

                $form_data = array(
                'id'  => $this->input->post('user_id')
                );

                $client = curl_init($api_url);

                curl_setopt($client, CURLOPT_POST, true);

                curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);

                curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

                $response = curl_exec($client);

                curl_close($client);

                echo $response;
            }

            if($data_action == "Edit")
            {
                $api_url = "http://10.0.3.36/tims/index.php/todo_api/update";

                $form_data = array(
                    'task'    =>  $this->input->post('task'),
                    'student_number'     =>  $this->input->post('student_number'),
                    'date_start'     =>  $this->input->post('date_start'),
                    'date_end'     =>  $this->input->post('date_end'),
                    'due_time'     =>  $this->input->post('due_time'),
                    'status'     =>  $this->input->post('status'),
                    'id'    => $this->input->post('user_id')
                );

                $client = curl_init($api_url);

                curl_setopt($client, CURLOPT_POST, true);

                curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);

                curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

                $response = curl_exec($client);

                curl_close($client);


                echo $response;
            }
            
            if($data_action == "fetch_single")
            {
                $api_url = "http://10.0.3.36/tims/index.php/todo_api/fetch_single";

                $form_data = array(
                'id'  => $this->input->post('user_id')
                );

                $client = curl_init($api_url);

                curl_setopt($client, CURLOPT_POST, true);

                curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);

                curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

                $response = curl_exec($client);

                curl_close($client);

                echo $response;
            }

            if($data_action == "Insert"){
                $api_url = "http://10.0.3.36/tims/index.php/todo_api/insert";

            $form_data= array(
                'task'    =>  $this->input->post('task'),
                'student_number'     =>  $this->input->post('student_number'),
                'date_start'     =>  $this->input->post('date_start'),
                'date_end'     =>  $this->input->post('date_end'),
                'due_time'     =>  $this->input->post('due_time'),
                'status'     =>  $this->input->post('status')
            );

            $client = curl_init($api_url);

            curl_setopt($client, CURLOPT_POST, true);

            curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);

            curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($client);

            curl_close($client);

            echo json_encode($response);

            }

            if($data_action == "fetch_all"){
                $api_url = "http://10.0.3.36/tims/index.php/todo_api";

                $client = curl_init($api_url);

                curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                
                $response = curl_exec($client);

                curl_close($client);

                $result = json_decode($response, true);

                $output = '';
                if (is_countable($result) && count($result) > 0){
                    foreach($result as $row){
                        $output .='
                        <tr>
                            <td>'.$row['task'].'</td>
                            <td>'.$row['student_number'].'</td>
                            <td>'.date("F j, Y",strtotime($row['date_start'])).'</td>
                            <td>'.date("F j, Y",strtotime($row['date_end'])).'</td>
                            <td>'.date("g:i a",strtotime($row['due_time'])).'</td>
                            <td>'.$row['status'].'</td>
                            <td><button type="button" name="edit" class="edit btn btn-primary bt-xs" id="'.$row['id'].'" >Edit</button></td>
                            <td><button type="button" name="delete" class="delete btn btn-danger bt-xs" id="'.$row['id'].'">Delete</button></td>
                        </tr>
                        ';
                    }
                }

                else{
                    $output .='
                        <tr>
                            <td colspan="4" style="text-align:center">NO DATA FOUND</td>
                        </tr>
                        ';
                }

                echo $output;
            }
        }
    }
}
