<?php

class SPModel extends CI_Model
{
    //students
    function test()
    {
        $this->db->where('valid', 1);
        $query = $this->db->get('dominicanplanner_account');
        return $query->result_array();
    }

    function todoview()
    {
        $this->db->where('valid', 1);
        $query = $this->db->get('dominicanplanner_todo');
        return $query->result_array();
    }

    function edit($id, $data)
    {
        $this->db->where('ID', $id);
        $this->db->update('dominicanplanner_account', $data);
    }

    function insert($data)
    {
        $this->db->insert('dominicanplanner_account', $data);
    }

    //admin
    function test1()
    {
        $this->db->where('valid', 1);
        $query = $this->db->get('dominicanplanner_admin');
        return $query->result_array();
    }

    function edit1($id, $data)
    {
        $this->db->where('ID_Admin', $id);
        $this->db->update('dominicanplanner_admin', $data);
    }

    function insert1($data)
    {
        $this->db->insert('dominicanplanner_admin', $data);
    }

    //calendar

    function test2()
    {
        $this->db->where('valid', 1);
        $query = $this->db->get('dominicanplanner_calendar');
        return $query->result_array();
    }

    function edit2($id, $data)
    {
        $this->db->where('ID', $id);
        $this->db->update('dominicanplanner_calendar', $data);
    }

    function insert2($data)
    {
        $this->db->insert('dominicanplanner_calendar', $data);
    }

    //login
    function login($data)
    {
        $this->db->where('email', $data["email"]);
        $this->db->where('password', $data["password"]);
        $query = $this->db->get('dominicanplanner_admin');
        return $query->row_array();
    }

    //fetching Date
    function getTodo()
    {
        $this->db->where('valid', 1);
        $query = $this->db->get('dominicanplanner_calendar');
        return $query->result_array();
    }

    function fetchDateEvent($date)
    {
        $this->db->where('datetime_start <', $date);
        $this->db->where('datetime_finish >', $date);
        $this->db->or_where("datetime_start LIKE '$date%'");
        $this->db->or_where("datetime_finish LIKE '$date%'");
        $query = $this->db->get('dominicanplanner_calendar');
        return $query->result_array();
    }
    
    function fetchDateEventInfo($ID)
    {
        $this->db->where('ID',$ID);
        $query = $this->db->get('dominicanplanner_calendar');
        return $query->row_array();
    }

    function deleteDateEventInfo($ID)
    {
        $this->db->where('ID',$ID);
        $this->db->where('valid', 0);
        $query = $this->db->update('dominicanplanner_calendar');
        return $query->row_array();
    }

    //fetching Event

    function fetchEvent($date)
    {
        $this->db->where('datetime_start <', $date);
        $this->db->where('datetime_finish >', $date);
        $this->db->or_where("datetime_start LIKE '$date%'");
        $this->db->or_where("datetime_finish LIKE '$date%'");
        $query = $this->db->get('dominicanplanner_calendar');
        return $query->result_array();
    }
    
    function fetchEventInfo($ID)
    {
        $this->db->where('ID',$ID);
        $query = $this->db->get('dominicanplanner_calendar');
        return $query->row_array();
    }

    //delete event
    function edit3($id, $data)
    {
        $this->db->where('ID', $id);
        $this->db->update('dominicanplanner_calendar', $data);
        $this->db->trans_complete();
        // was there any update or error?
        if ($this->db->affected_rows() == '1') {
            return TRUE;
        } else {
            // any trans error?
            if ($this->db->trans_status() === FALSE) {
                return false;
            }
            return true;
        }
    }


}
