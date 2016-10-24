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
            'password' => md5($password)
        ))->get();
		// check if user found
		if($user->num_rows()) {
			$userData = $user->row_array();
			// user session vardiables
			$userdata = array(
				'username' => $userData['username'],
				'userId'=> $userData['userId'],
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
		$result = $this->db->select('(SUM(marks) / SUM(maxMarks) * 100) AS percentage')->from('marksheet')->where(array('userId' => $this->session->userId))->group_by('userId')->get();
		return $result->row_array();
	}
	public function getSemMarks()
	{
		$result = $this->db->select('semester, SUM(marks) / SUM(maxMarks) * 100 AS percentage')->from('marksheet')->where(array('userId' => $this->session->userId))->group_by('semester')->get();
		return $result->result_array();
	}
	public function lastSemMarksheet()
	{
		$result = $this->db->select('(SUM(marks) / SUM(maxMarks) * 100) AS percentage')->from('marksheet')->where(array('userId' => $this->session->userId))->group_by('semester')->order_by('semester', 'desc')->limit(2,0)->get()->result_array();
		return $result[0]['percentage'] - $result[1]['percentage'];
	}
}
