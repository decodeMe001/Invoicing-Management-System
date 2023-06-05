<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Account extends CI_Controller {
	public $roles;
	function __construct(){
		parent::__construct();
        $this->load->database();
<<<<<<< HEAD
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->model('crud_model');
=======
>>>>>>> 060766fe05b38dadf2897b881fab97884399e5e3
		$this->roles = $this->config->item('roles');

	}

	public function index() {
<<<<<<< HEAD
		if ($this->session->userdata('admin_login') == 1)
            redirect('admin/dashboard', 'refresh');
		
		if ($this->session->userdata('manager') == 1)
            redirect('admin/dashboard', 'refresh');
			
        else if ($this->session->userdata('staff_login') == 1)
            redirect('staff/dashboard', 'refresh');

=======
>>>>>>> 060766fe05b38dadf2897b881fab97884399e5e3
		$data['page_title'] = 'Login';
        $data['page_name'] = 'login';
        $this->load->view('frontend/login', $data);
	}

	public function login(){

		$validator = array('success' => false, 'messages' => array());

		$validate_data = array(
			array(
				'field' => 'user_name',
				'label' => 'username',
				'rules' => 'required|trim|xss_clean|callback_validate_username'
			),
			array(
				'field' => 'password',
				'label' => 'password',
				'rules' => 'trim|required|xss_clean|min_length[6]|max_length[20]'
			)
		);

        $this->form_validation->set_rules($validate_data);
		$this->form_validation->set_message('min_length', 'The {field} must not be less than 6 characters');
		$this->form_validation->set_error_delimiters('<p class="text-danger error">', '</p>');

        if($this->form_validation->run() == true){

			$username = $_POST['user_name'];
			$password = $_POST['password'];

<<<<<<< HEAD
			//Validating login
			$data = $this->validate_login($username, $password);

			if($data){
				$newdata = array('admin_login'  => '1', 'logged_in' => TRUE, 'staff_login' => '1', 'manager' => '1');
=======
			if($this->validate_login($username, $password) && $this->validate_username() && $this->session->userdata('login_type') == 'admin'){
				$newdata = array('logged_in' => TRUE);

>>>>>>> 060766fe05b38dadf2897b881fab97884399e5e3
				$this->session->set_userdata($newdata);
				$validator['success'] = true;
				$validator['redirect_url'] = "admin/dashboard";
		
			}else if($this->validate_login($username, $password) && $this->validate_username() && $this->session->userdata('login_type') == 'staff'){
				$newdata = array('logged_in' => TRUE);

				$this->session->set_userdata($newdata);
				$validator['success'] = true;
				$validator['redirect_url'] = "staff/dashboard";
			}else {
				$validator['success'] = false;
				$validator['messages'] = 'Invalid username/password combination';
			}
		}
		else {
			$validator['success'] = false;
			foreach ($_POST as $key => $value)
			{
				/* Display the error after failed login */
				$validator['messages'][$key] = form_error($key);
			}
		}
		echo json_encode($validator);
	}

	public function validate_username()
	{
		$username = $this->user->validate_username();

		if($username === true) {
			return true;
		}
		else {
			$this->form_validation->set_message('validate_username', 'The {field} does not exists');
			return false;
		}
	}


	//Validating login from ajax request
    public function validate_login($username = '', $password = '') {
        $credential = array('user_name' => $username, 'password' => sha1($password));

        // Checking login credential for admin in Database
        $query = $this->db->get_where('admin', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
<<<<<<< HEAD
            $this->session->set_userdata('admin_login', '1');
            $this->session->set_userdata('manager', '1');
			$this->session->set_userdata('staff_login', '1');
=======
>>>>>>> 060766fe05b38dadf2897b881fab97884399e5e3
            $this->session->set_userdata('id', $row->admin_id);
            $this->session->set_userdata('username', $row->user_name);
            $this->session->set_userdata('cashier', $row->name);
            $this->session->set_userdata('login_type', $row->role);
            return true;
        }

   		return false;
    }

	/*******LOGOUT FUNCTION ****** */

    function logout() {

		$this->session->sess_destroy();
		session_write_close();
        redirect(base_url(), 'refresh');
    }
}
ob_end_flush();
