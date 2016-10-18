<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    /*
    	Constructor: initializes model to use
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user');
    }
	/*
		Defualt function called when nothing is mentioned in url
	 */
    public function index()
    {
        if ($this->session->authorized) {
            redirect(base_url().'home/dashboard');
        } else {
            $this->load->view('login');
        }
    }
	/*
		Handle login requests.
		Data should be sent by post method.
	 */
    public function login()
    {
		// getting user data from post method.
        $user = $this->input->post('username');
        $pass = $this->input->post('password');
        // check user credentials
        if ($this->user->authorize($user, $pass)) {
            echo 'success';
        } else {
            echo 'unautherized';
        }
    }
	/*
		logout user and destroy session
	 */
    public function logout()
    {
		// logic to destroy session
        $userdata = array('username', 'authorized');
        $this->session->unset_userdata($userdata);
		// finally redirect to login page
        redirect(base_url());
    }
	/*
		if user authorised then show dashboard
	 */
    public function dashboard()
    {
        echo 'Welcome JECRCian';
    }
}
