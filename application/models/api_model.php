<?php 
class api_model extends CI_Model{

    function fetch_all(){
        $this->db->order_by('id', 'DESC');
        $this->db->where('valid', 1);
        return $this->db->get('dominicanplanner_account');
    }

    function insert_api($data){
        $this->db->insert('dominicanplanner_account', $data);
    }

    function fetch_single_user($user_id){
        $this->db->where('id', $user_id);
        $this->db->where('valid', 1);
        $query = $this->db->get('dominicanplanner_account');
        return $query->result_array();
    }

    function login($stdnum){
        $this->db->where('student_number', $stdnum);
        $this->db->where('valid', 1);
        $query = $this->db->get('dominicanplanner_account');
        return $query->row_array();
    }

    function update_api($user_id, $data){
        $this->db->where("id", $user_id);
        $this->db->update("dominicanplanner_account", $data);
    }

    function delete_single_user($user_id){
        $this->db->where("id", $user_id);
        $this->db->update("dominicanplanner_account");

        if($this->db->affected_rows() > 0){
            return true;
        }

        else{
            return false;
        }
    }

}
