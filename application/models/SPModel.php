<?php

class SPModel extends CI_Model
{
    //students
    function test()
    {
        $this->db->where('valid', 1);
        $query = $this->db->get('content');
        return $query->result_array();
    }

    function edit($id, $data)
    {
        $this->db->where('ID', $id);
        $this->db->update('content', $data);
    }

    function insert($data)
    {
        $this->db->insert('content', $data);
    }

    //admin
    function test1()
    {
        $this->db->where('valid', 1);
        $query = $this->db->get('admin');
        return $query->result_array();
    }

    function edit1($id, $data)
    {
        $this->db->where('ID_Admin', $id);
        $this->db->update('admin', $data);
    }

    function insert1($data)
    {
        $this->db->insert('admin', $data);
    }

    function login($data)
    {
        $this->db->where('email', $data["email"]);
        $this->db->where('password', $data["password"]);
        $query = $this->db->get('admin');
        return $query->row_array();
    }

    function getTodo()
    {
        $query = $this->db->get('todo');
        return $query->result_array();
    }

}
