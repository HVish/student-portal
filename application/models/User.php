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
}
