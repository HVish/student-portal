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
        if($this->session->authorized) {
			$headerData = array(
				'username' => $this->session->username,
				'title' => 'dashboard',
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
			$this->load->view('dashboard');
			$this->load->view('footer');
		} else {
			redirect(base_url());
		}
    }
	/*
		Btech aggregate percentage
	 */
	public function btechPercent()
	{
		if($this->session->authorized) {
			$result = $this->user->getPercentage();
			echo $result['percentage'];
		} else {
			echo "unautherized";
		}
	}
	/*
		Btech semester-wise progress
	 */
	public function btechProgress()
	{
		if($this->session->authorized) {
			$result = $this->user->getSemMarks();
			$data = array(
				'progress' => array(),
				'aggregate' => 100
			);
			foreach ($result as $key => $value) {
				array_push($data['progress'], array_values($value));
			}
			$data['aggregate'] = floatval($this->user->getPercentage()['percentage']);
			$data['change'] = floatval($this->user->lastSemMarksheet());
			echo json_encode($data);
		} else {
			redirect(base_url());
		}
	}
	/*
		access inbox
	 */
	public function inbox()
	{
		if($this->session->authorized) {
			$headerData = array(
				'username' => $this->session->username,
				'title' => 'inbox',
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
			$this->load->view('inbox');
			$this->load->view('footer');
		} else {
			redirect(base_url());
		}
	}
	/*
		Compose new email
	 */
	public function compose()
	{
		if($this->session->authorized) {
			$headerData = array(
				'username' => $this->session->username,
				'title' => 'compose',
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
			$this->load->view('mailCompose');
			$this->load->view('footer');
		} else {
			redirect(base_url());
		}
	}
	/*
		branch topper analysis
	 */
	public function branchToppers($value='')
	{
		if($this->session->authorized) {
			echo json_encode($this->user->branchToppers());
		} else {
			echo "unautherized";
		}
	}
	/*
		student rank in his/her branch
	 */
	public function yourRank()
	{
		if($this->session->authorized) {
			echo json_encode($this->user->yourRank());
		} else {
			echo "unautherized";
		}
	}
	/*
		student attendance analysis of all subjects (in percentages)
	 */
	public function attendance()
	{
		if($this->session->authorized) {
			echo json_encode($this->user->attendance());
		} else {
			echo "unautherized";
		}
	}
    /*
        student marksheet for particular semester
    */
    public function marksheet($semester)
    {
        if($this->session->authorized) {
			$headerData = array(
				'username' => $this->session->username,
				'title' => 'marksheet',
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
            $data['tabledata'] = $this->user->marksheetData($semester);
            $data['semester'] = $semester;
			$this->load->view('header', $headerData);
			$this->load->view('marksheet', $data);
			$this->load->view('footer');
		} else {
			redirect(base_url());
		}
    }
	/*
		module testing
	 */
	public function test()
	{
		if($this->session->authorized) {
			echo "<pre>";
			print_r($this->user->marksheetData(3));
		} else {
			echo "unautherized";
		}
	}
}
