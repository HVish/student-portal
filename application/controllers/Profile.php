<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
    /*
    	Constructor: initializes model to use
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user');
    }
	public function index()
	{
		if($this->session->authorized) {
			$headerData = array(
				'username' => $this->session->username,
				'title' => 'profile',
				'alerts' => array(
					'tasks' => array(
						array(
							'title' => 'Submit Assignment',
							'message' => 'Your DB Lab assignment is not submitted.',
							'progress' => '10'
						)
					),
					'mails' => array(
					 	array(
							'image' => 'avatar-mini.jpg',
							'from' => 'Udit Vasu',
							'time' => '7:00pm',
							'message' => 'Completed report on project!'
						)
					),
					'notifications' => array(
						array(
							'message' => 'MTT2 time table',
							'url' => '#'
						)
					)
				)
			);
			$this->load->view('header', $headerData);
			$this->load->view('profile');
			$this->load->view('footer');
		} else {
			redirect(base_url());
		}
	}
}
