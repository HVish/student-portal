<?php

class ErrorPages extends CI_Controller
{
	public function __construct()
    {
        parent::__construct();
    }

    public function notFound()
    {
		header('HTTP/1.1 404 Not Found');
        $this->load->view('notFound');
    }
}
