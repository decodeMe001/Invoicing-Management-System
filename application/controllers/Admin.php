<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Admin extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    /***default function, redirects to login page if no admin logged in yet** */

    function index() {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'account', 'refresh');
        if ($this->session->userdata('admin_login') == 1)
            redirect(base_url() . 'admin/dashboard', 'refresh');
    }

    /*** ADMIN DASHBOARD** */

    function dashboard() {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name'] = 'dashboard';
		$page_data['page_title'] = 'Dashboard';
        $this->load->view('frontend/index', $page_data);
    }
	//get create-page
	function create($param2 = '' , $param3 = '')
	{
		$page_data['page_title'] = 'Manage-Invoice';
		$page_data['page_name'] = 'create_invoice';
		$page_data['param2'] = $param2;
		$page_data['param3'] = $param3;
		
		$this->load->view( 'frontend/index',$page_data);
		
	}
	//get print-invoice
	function print_pdf($param2 = '' , $param3 = '')
	{
		$page_data['page_title'] = 'Manage-Invoice';
		$page_data['page_name'] = 'create_invoice';
		$page_data['param2'] = $param2;
		$page_data['param3'] = $param3;
		
		$this->load->view( 'frontend/print_invoice',$page_data);
		
	}
	//get update-page
	function update($param2 = '' , $param3 = '')
	{
		$page_data['page_title'] = 'Manage-Invoice';
		$page_data['page_name'] = 'update_invoice';
		$page_data['param2'] = $param2;
		$page_data['param3'] = $param3;
		
		$this->load->view( 'frontend/index',$page_data);
		
	}
	
    /*****SITE/SYSTEM SETTINGS******** */

    function settings($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'account', 'refresh');

        if ($param1 == 'do_update') {
            $this->crud_model->update_system_settings();
            $this->session->set_flashdata('message', 'settings_updated');
            redirect(base_url() . 'admin/settings/', 'refresh');
        }
        if ($param1 == 'upload_logo') {
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/logo.png');
            $this->session->set_flashdata('message', 'settings_updated');
            redirect(base_url() . 'admin/settings/', 'refresh');
        }
        $page_data['page_name'] = 'sys_settings';
        $page_data['page_title'] = 'Settings';
        $page_data['settings'] = $this->db->get('settings')->result_array();
        $this->load->view('frontend/index', $page_data);
    }

    /******MANAGE OWN PROFILE AND CHANGE PASSWORD** */

    function profile($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'account', 'refresh');

        if ($param1 == 'update_profile_info') {
            $data['user_name'] = $this->input->post('name');
            $data['role'] = $this->input->post('role');

            $this->db->where('id', $this->session->userdata('login_user_id'));
            $this->db->update('users', $data);

            $this->session->set_flashdata('message', 'profile_info_updated_successfuly');
            redirect(base_url() . 'admin/profile');
        }
        if ($param1 == 'change_password') {
            $current_password_input = sha1($this->input->post('password'));
            $new_password = sha1($this->input->post('new_password'));
            $confirm_new_password = sha1($this->input->post('confirm_new_password'));

            $current_password_db = $this->db->get_where('users', array('id' =>
                        $this->session->userdata('login_user_id')))->row()->password;

            if ($current_password_db == $current_password_input && $new_password == $confirm_new_password) {
                $this->db->where('id', $this->session->userdata('login_user_id'));
                $this->db->update('users', array('password' => $new_password));

                $this->session->set_flashdata('message', 'password_info_updated_successfuly');
                redirect(base_url() . 'admin/profile');
            } else {
                $this->session->set_flashdata('message', 'password_update_failed');
                redirect(base_url() . 'admin/profile');
            }
        }
        $page_data['page_name'] = 'manage_profile';
        $page_data['page_title'] = 'Profile';
        $page_data['edit_data'] = $this->db->get_where('users', array('id' => $this->session->userdata('login_user_id')))->result_array();
        $this->load->view('frontend/index', $page_data);
    }
	
	function invoice($task = " ", $invoice_id = "") {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($task == "create") {
            $order_no = $_POST['order_no'];
            //$order = $this->db->get_where('invoice_order', array('order_no' => $order_no))->row()->order_no;
            if ($order_no == true) {
				$clean = $this->security->xss_clean($this->input->post(NULL, TRUE));
                $this->crud_model->insertInvoice($clean);
            } else {
                return false;
            }
            redirect(base_url('admin/invoice'), 'refresh');
        }

        if ($task == "update")
		{
                $this->crud_model->update_invoice($invoice_id);
                $this->session->set_flashdata('message', 'Invoice info updated successfully!!!');
                redirect(base_url('admin/invoice'), 'refresh');
        }

        if ($task == "delete") {
            $this->crud_model->delete_invoice($invoice_id);
            redirect(base_url('admin/invoice'), 'refresh');
        }

        //$data['invoice_info'] = $this->crud_model->select_invoice_info();
        $data['page_name'] = 'manage_invoice';
        $data['page_title'] = 'Manage-Invoice';
        $this->load->view('frontend/index', $data);
	}
	
	function items(){
		$data['page_name'] = 'invoice_items';
        $data['page_title'] = 'Manage-Invoice';
        $this->load->view('frontend/index', $data);
	}

}
