<?php
class api_model extends CI_Model
{

    function fetch_all()
    {
        $this->db->order_by('id', 'DESC');
        return $this->db->get('dominicanplanner_account');
    }

    function insert_api($data)
    {
        $this->db->insert('dominicanplanner_account', $data);
    }

    function fetch_single_user($user_id)
    {
        $this->db->where('id', $user_id);
        $query = $this->db->get('dominicanplanner_account');
        return $query->result_array();
    }

    function login($stdnum)
    {
        $this->db->where('student_number', $stdnum);
        $query = $this->db->get('dominicanplanner_account');
        return $query->row_array();
    }

    function update_api($user_id, $data)
    {
        $this->db->where("id", $user_id);
        $this->db->update("dominicanplanner_account", $data);
    }

    function delete_single_user($user_id)
    {
        $this->db->where("id", $user_id);
        $this->db->delete("dominicanplanner_account");

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function testUpdate()
    {
        $this->db->select('Grading_School_Year');
        $this->db->select('Grading_Semester');
        $this->db->from('legend');
        $query = $this->db->get();
        return $query->row_array();
    }

    function checkAccount($stdnum, $SY, $sem){
        $result = $this->db->query('SELECT * FROM fees_enrolled_college AS a WHERE a.Reference_Number = (SELECT Reference_Number FROM student_info WHERE Student_Number = ' . $this->db->escape($stdnum) . ') AND a.schoolyear = ' . $this->db->escape($SY) . ' AND a.semester = ' . $this->db->escape($sem));
        if(!empty($result->row_array())){
            return true;
        }
        else{
            return false;
        }
    }

    function test($stdnum, $SY, $sem)
    {
        $result = $this->db->query('SELECT b.Student_Number, a.First_Name, a.Middle_Name, a.Last_Name, a.Course, b.Year_Level, b.School_Year, b.Reference_Number, b.Semester, b.Sched_Code, e.Course_Code, 
        e.Course_Title, f.Schedule_Time AS sched_start_time, g.Schedule_Time AS sched_end_time, d.`Day`
        FROM student_info AS a 
        LEFT JOIN enrolledstudent_subjects AS b ON a.Student_Number = b.Student_Number
        LEFT JOIN sched AS c ON c.Sched_Code = b.Sched_Code
        LEFT JOIN sched_display AS d ON c.Sched_Code = d.Sched_Code
        LEFT JOIN subject AS e ON c.Course_Code = e.Course_Code
        LEFT JOIN time AS f ON d.Start_Time = f.Time_From 
        LEFT JOIN time AS g ON d.End_Time = g.Time_To
        WHERE b.Student_Number = ' . $this->db->escape($stdnum) . ' AND b.Year_Level = (SELECT MAX(YearLevel) FROM fees_enrolled_college WHERE Reference_Number = b.Reference_Number) 
        AND b.School_Year = ' . $this->db->escape($SY) . ' AND b.Semester = ' . $this->db->escape($sem) . '  AND b.Dropped = 0 AND b.Cancelled = 0 AND b.Charged = 0');
        return $result->result_array();
    }

    function accTest($stdnum, $SY, $sem)
    {
        $result = $this->db->query('SELECT b.Student_Number, a.First_Name, a.Middle_Name, a.Last_Name, a.Course, b.Year_Level, b.School_Year, b.Reference_Number, b.Semester
        FROM student_info AS a 
        LEFT JOIN enrolledstudent_subjects AS b ON a.Student_Number = b.Student_Number
        LEFT JOIN sched AS c ON c.Sched_Code = b.Sched_Code
        LEFT JOIN sched_display AS d ON c.Sched_Code = d.Sched_Code
        LEFT JOIN subject AS e ON c.Course_Code = e.Course_Code
        LEFT JOIN time AS f ON d.Start_Time = f.Time_From 
        LEFT JOIN time AS g ON d.End_Time = g.Time_To
        WHERE b.Student_Number = ' . $this->db->escape($stdnum) . ' AND b.Year_Level = (SELECT MAX(YearLevel) FROM fees_enrolled_college WHERE Reference_Number = b.Reference_Number) 
        AND b.School_Year = ' . $this->db->escape($SY) . ' AND b.Semester = ' . $this->db->escape($sem) . '  AND b.Dropped = 0 AND b.Cancelled = 0 AND b.Charged = 0
        ');
        return $result->row_array();
    }
}
