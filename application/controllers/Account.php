<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Account extends CI_Controller {
	function __construct(){
		parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library(array('session', 'form_validation')); 
        $this->load->database();
        $this->load->model('crud_model');
	}

	public function index() {
		$data['page_title'] = 'Login';
        $data['page_name'] = 'login';
        $this->load->view('frontend/login', $data);
	}
    
    function login() {
		
        $validator = array('success' => false, 'messages' => array());

		$validate_data = array(
			array(
				'field' => 'user_name',
				'label' => 'Username',
				'rules' => 'required|trim|xss_clean'
			),
			array(
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'trim|required|xss_clean|min_length[6]|max_length[15]'
			)
		);
        
        $this->form_validation->set_rules($validate_data);
		$this->form_validation->set_message('min_length', 'The {field} must not be less than 6 characters');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        
        if($this->form_validation->run() == true) 
        {
			//Recieving post input of email, password from ajax request
			$username = $_POST["user_name"];
			$password = $_POST["password"];
            
			//Validating login
			$login_status = $this->validate_login($username, $password);
			if($login_status) {

				$newdata = array('admin_login'  => '1','logged_in' => TRUE);

				$this->session->set_userdata($newdata);

				$validator['success'] = true;
				//$validator['messages'] = 'Logging in. Please wait...';
				$validator['redirect_url'] = "admin/dashboard";	
			}
			else {
                $validator['success'] = false;
				$validator['messages'] = 'Error!!! Invalid credentials...';	
            }
			
        }else
        {
            foreach($_POST as $key => $val)
            {
                $validator['messages'][$key] = form_error($key);
            }
        }
        
        echo json_encode($validator);
    }
	
	//Validating login from ajax request
    function validate_login($username = '', $password = '') {
        $credential = array('user_name' => $username, 'password' => sha1($password));
        
        // Checking login credential for admin
        $query = $this->db->get_where('users', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('admin_login', '1');
            $this->session->set_userdata('login_user_id', $row->id);
            $this->session->set_userdata('name', $row->user_name);
            $this->session->set_userdata('login_type', $row->role);
            return true;
        }
    
   		return false;
    }
	
	/*******LOGOUT FUNCTION ****** */

    function logout() {
        $this->session->sess_destroy();
        $this->session->set_flashdata('messages', 'You/'.'ve logged Out Successfully!!');
        redirect(base_url(), 'refresh');
    }
}
