<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class webacc_api extends CI_Controller {

	function index(){
        $this->load->view('webacc_view');
    }

    function action(){
        if($this->input->post('data_action')){
            $data_action = $this->input->post('data_action');
            
            if($data_action == "Delete")
            {
                $api_url = "http://10.0.3.36/tims/index.php/account_api/delete";

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
                $api_url = "http://10.0.3.36/tims/index.php/account_api/update";

                $form_data = array(
                    'student_number'     =>  $this->input->post('student_number'),
                    'first_name'    =>  $this->input->post('first_name'),
                    'last_name'    =>  $this->input->post('last_name'),
                    'program'     =>  $this->input->post('program'),
                    'email'     =>  $this->input->post('email'),
                    'password'     =>  $this->input->post('password'),
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
                $api_url = "http://10.0.3.36/tims/index.php/account_api/fetch_single";

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
                $api_url = "http://10.0.3.36/tims/index.php/account_api/insert";

            $form_data= array(
                'student_number'     =>  $this->input->post('student_number'),
                'first_name'    =>  $this->input->post('first_name'),
                'last_name'    =>  $this->input->post('last_name'),
                'program'     =>  $this->input->post('program'),
                'email'     =>  $this->input->post('email'),
                'password'     =>  $this->input->post('password')
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
                $api_url = "http://10.0.3.36/tims/index.php/account_api";

                $client = curl_init($api_url);

                curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                
                $response = curl_exec($client);

                curl_close($client);

                $result = json_decode($response, true);

                $output = '';
                
                if(count($result) > 0){
                    foreach($result as $row){
                        $output .='
                        <tr>
                            <td>'.$row['student_number'].'</td>
                            <td>'.$row['first_name'].'</td>
                            <td>'.$row['last_name'].'</td>
                            <td>'.$row['program'].'</td>
                            <td>'.$row['email'].'</td>
                            <td>'.$row['password'].'</td>
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

?>