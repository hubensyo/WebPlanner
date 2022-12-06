<?php 
class api_model extends CI_Model{

    function fetch_all(){
        $this->db->order_by('id', 'DESC');
        return $this->db->get('mydatabase');
    }

    function insert_api($data){
        $this->db->insert('mydatabase', $data);
    }

    function fetch_single_user($user_id){
        $this->db->where('id', $user_id);
        $query = $this->db->get('mydatabase');
        return $query->result_array();
    }

    function login($stdnum){
        $this->db->where('student_number', $stdnum);
        $query = $this->db->get('mydatabase');
        return $query->row_array();
    }

    function update_api($user_id, $data){
        $this->db->where("id", $user_id);
        $this->db->update("mydatabase", $data);
    }

    function delete_single_user($user_id){
        $this->db->where("id", $user_id);
        $this->db->delete("mydatabase");

        if($this->db->affected_rows() > 0){
            return true;
        }

        else{
            return false;
        }
    }

}
