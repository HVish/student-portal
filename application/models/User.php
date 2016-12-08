<?php

class User extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function authorize($username, $password)
    {
        // search user in database
        $user = $this->db->select('*')->from('user')->where(array(
            'username' => $username,
            'password' => md5($password),
        ))->get();
        // check if user found
        if ($user->num_rows()) {
            $userData = $user->row_array();
            // user session vardiables
            $userdata = array(
                'username' => $userData['username'],
                'studentId' => $userData['studentId'],
                'authorized' => true,
            );
            // setting user session
            $this->session->set_userdata($userdata);

            return true;
        } else {
            // user not found hence unautherized
            return false;
        }
    }
    public function getPercentage()
    {
        $result = $this->db->select('percentage')->from('percentage')->where(array('studentId' => $this->session->studentId))->get();

        return $result->row_array();
    }
    public function getSemMarks()
    {
        $result = $this->db->select('semester, SUM(marks) / SUM(maxMarks) * 100 AS percentage')->from('marksheet')->where(array('studentId' => $this->session->studentId))->group_by('semester')->get();

        return $result->result_array();
    }
    public function lastSemMarksheet()
    {
        $result = $this->db->select('(SUM(marks) / SUM(maxMarks) * 100) AS percentage')->from('marksheet')->where(array('studentId' => $this->session->studentId))->group_by('semester')->order_by('semester', 'desc')->limit(2, 0)->get()->result_array();
        if (count($result) == 1) {
            return 0;
        }

        return $result[0]['percentage'] - $result[1]['percentage'];
    }
    public function branchToppers()
    {
        $result = $this->db->select('studentId, name, percentage')->from('percentage')->limit(3, 0)->get()->result_array();

        return $result;
    }
    public function yourRank()
    {
        // checking whether user has any marksheet entry
        $test = $this->db->select('COUNT(studentId) AS found')->from('marksheet')->where(array('studentId' => $this->session->studentId))->get()->row_array();
        // if user don't have any mrksheet entry then send a defult value zero
        if ($test['found'] == '0') {
            return array('rank' => '0');
        }
        $result = $this->db->select('COUNT(*) + 1 AS rank')->from('percentage AS my')->join('percentage AS others', 'others.percentage > my.percentage')->where(array('my.studentId' => $this->session->studentId))->get()->row_array();

        return $result;
    }
    public function attendance()
    {
        // result will store the data of subjects
        $result = array();
        // data will store the formatted for graph plotting
        $data = array();
        // finding subjects in current semester
        $subjects = $this->db->distinct()->select('attendance.subjectId, subject.name')->from('attendance')->join('student', 'student.studentId = attendance.studentId AND student.semester = attendance.semester')->join('subject', 'subject.subjectId = attendance.subjectId')->get()->result_array();
        foreach ($subjects as $key => $value) {
            $query =
            'SELECT
				attendance.subjectId,
				attendance.date,
				attendance.status,
				(IF (attendance.status = "present", @present := @present + 1, @present)) AS cumulativePresent,
				(@total := @total + 1) AS total,
				(@present * 100 / @total) AS percentage
			FROM attendance
			JOIN student ON student.studentId = attendance.studentId AND student.semester = attendance.semester
			WHERE
				attendance.studentId = '.$this->session->studentId.' AND
				attendance.subjectId = '.$value['subjectId'];
            $this->db->trans_start();
            $this->db->query('SET @total := 0, @present := 0');
            $temp = $this->db->query($query);
            $this->db->trans_complete();
            $result[$value['name']] = $temp->result_array();

            // formating data for graph plotting
            // "date" key is used to collect data date-wise!
            foreach ($temp->result_array() as $key => $val) {
                $data[$val['date']][$value['name']] = number_format($val['percentage'], 2);
                $data[$val['date']]['date'] = $val['date'];
            }
        }
        // removing "date" keys, sending only values
        return array_values($data);
    }
    public function marksheetData($semester)
    {
        // get data from database
        $res = $this->db->select('marksheet.*,subject.name, subject.code')->from('marksheet')->join('subject','subject.subjectId = marksheet.subjectId')->where(array('studentId' => $this->session->studentId, 'semester' => $semester))->get()->result_array();
        $rows = array();
        // formatting for the table to be shown in front-ui
        foreach ($res as $key => $value) {
            // creating an array with subjectId as its key so as subject 
            // data come in single row for a particular subject
            $rows[$value['subjectId']]['name'] = $value['name'];
            $rows[$value['subjectId']]['code'] = $value['code'];
            if(isset($rows[$value['subjectId']][$value['examType']])) {
                $rows[$value['subjectId']][$value['examType']]['maxMarks'] += $value['maxMarks'];
                $rows[$value['subjectId']][$value['examType']]['marks'] += $value['marks'];
            } else {
                $rows[$value['subjectId']][$value['examType']]['maxMarks'] = $value['maxMarks'];
                $rows[$value['subjectId']][$value['examType']]['marks'] = $value['marks'];
            }
        }
        return $rows;
    }
}
