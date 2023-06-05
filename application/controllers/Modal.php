<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Modal extends CI_Controller {


	function __construct()
    {
        parent::__construct();
		$this->load->database();
        $this->load->library('session');
		/*cache control*/
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    }

	/***default functin, redirects to login page if no admin logged in yet***/
	public function index()
	{

	}


	/*
	*	$page_name		=	The name of page
	*/
	function popup($page_name = '' , $param2 = '' , $param3 = '')
	{
<<<<<<< HEAD
		$account_type   = $this->session->userdata('login_type');
		if($this->session->userdata('login_type') == 'admin' || $this->session->userdata('login_type') == 'manager'){
			$account_type = 'admin';
		}else{
			$account_type = 'staff';
		}
		$page_data['param2']		=	$param2;
		$page_data['param3']		=	$param3;
=======
		$account_type           =	$this->session->userdata('login_type');
		$page_data['param2']	=	$param2;
		$page_data['param3']	=	$param3;
>>>>>>> 060766fe05b38dadf2897b881fab97884399e5e3
		$this->load->view( 'frontend/'.$account_type.'/'.$page_name.'.php' ,$page_data);

	}
}
