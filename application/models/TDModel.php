<?php
class TDModel extends CI_Model
{

    function fetch_all()
    {
        $this->db->order_by('id', 'DESC');
        return $this->db->get('dominicanplanner_todo');
    }

    function task($stdnum){
        $this->db->where('student_number', $stdnum);
        $this->db->order_by('id', 'DESC');
        return $this->db->get('dominicanplanner_todo');
        // return $query->result_array();
    }

    function edit($task_id){
        $this->db->where('id', $task_id);
        return $this->db->get('dominicanplanner_todo');

    }

    function insert_api($data)
    {
        $this->db->insert('dominicanplanner_todo', $data);
    }

    function fetch_single_user($task_id)
    {
        $this->db->where('id', $task_id);
        $query = $this->db->get('dominicanplanner_todo');
        return $query->result_array();
    }

    function update_api($task_id, $stdnum, $data)
    {
        $this->db->where("student_number", $stdnum);
        $this->db->where("id", $task_id);
        $this->db->update("dominicanplanner_todo", $data);
    }

    function delete_single_task($task_id)
    {
        $this->db->where("id", $task_id);
        $this->db->delete("dominicanplanner_todo");

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
