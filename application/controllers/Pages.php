<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Pages extends CI_Controller {
	function __construct(){
		parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library(array('session', 'form_validation')); 
        $this->load->database();
        $this->load->model('crud_model');	
		/* cache control */
        $this->output->set_header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
	}

	public function index()
	{
		$this->load->view('');
	}
}
