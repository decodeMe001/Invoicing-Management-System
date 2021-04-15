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
        if ($this->session->userdata('login_type') != 'admin'){
            redirect(base_url() . 'account', 'refresh');
		}

    }

    /*** ADMIN DASHBOARD** */

    function dashboard()
	{
	    if ($this->session->userdata('login_type') != 'admin') {
            redirect(base_url(), 'refresh');
        }
		
        $data['page_name'] = 'dashboard';
	    $data['page_title'] = 'Dashboard';
        $this->load->view('frontend/index', $data);
    }
	
	// Ice-Cream
	function ice_cream($task = " ", $id = "") {
        if ($this->session->userdata('login_type') != 'admin') {
            redirect(base_url(), 'refresh');
        }

        if ($task == "create") {
            $clean = $this->security->xss_clean($this->input->post(NULL, TRUE));
			$this->ice_cream_sales->insert($clean);
			$this->session->set_flashdata('ice_cream_success_msg','<div class="alert alert-success text-center">Data Created Successfully!!!</div>');
           
            redirect(base_url('admin/ice_cream'), 'refresh');
        }

        if ($task == "update")
		{
			$this->ice_cream_sales->update($id);
			$this->session->set_flashdata('ice_cream_delete_success_msg','<div class="alert alert-success text-center">Data Updated Successfully!!!</div>');
			redirect(base_url('admin/ice_cream'), 'refresh');
        }

        if ($task == "delete") {
            $this->ice_cream_sales->destroy($id);
            redirect(base_url('admin/ice_cream'), 'refresh');
        }

        $data['page_name'] = 'icecream/ice_cream_sales_list';
        $data['page_title'] = 'Manage-Ice-Cream';
	    $data['get_data'] = $this->db->get('ice_cream_sales')->result_array();
	    $data['total_rows'] = $this->db->count_all('ice_cream_sales');
        $this->load->view('frontend/index', $data);
	}
	
	//ice_cream update-page
	function update_ice_cream($id)
	{
		$page_data['page_title'] = 'Update-Invoice';
		$page_data['page_name'] = 'update_ice_cream';
		$page_data['id'] = $id;
		$page_data['get_product'] = $this->db->get('products')->result_array();
		$page_data['category_list'] = $this->db->get('category')->result_array();
		$this->load->view( 'frontend/index',$page_data);

	}
	
	function ice_cream_items() {
        if ($this->session->userdata('login_type') != 'admin') {
            redirect(base_url(), 'refresh');
        }

        $data['page_name'] = 'icecream/items';
        $data['page_title'] = 'Ice-Cream Sales List';
	    $data['get_data'] = $this->db->get('ice_cream_sales_order')->result_array();
	    $data['total_rows'] = $this->db->count_all('ice_cream_sales_order');
        $this->load->view('frontend/index', $data);
	}
	
	function create_ice_cream()
	{
		if ($this->session->userdata('login_type') != 'admin') {
            redirect(base_url(), 'refresh');
        }
		$data['page_title'] = 'Manage-Ice-Cream';
		$data['page_name'] = 'icecream/create_sales';
		$data['get_product_array'] = $this->db->get('products')->result_array();
		$data['category_list'] = $this->db->get('category')->result_array();
		$data['total_product_rows'] = $this->db->count_all('products');
		$data['total_category_rows'] = $this->db->count_all('category');
		$data['vendor'] = $this->db->get('vendor')->result_array();
		$this->load->view('frontend/index', $data);

	}
	
	// Stationary
	function stationary($task = " ", $id = "") {
        if ($this->session->userdata('login_type') != 'admin') {
            redirect(base_url(), 'refresh');
        }

        if ($task == "create") {
            $clean = $this->security->xss_clean($this->input->post(NULL, TRUE));
			$this->stationary_sales->insert($clean);
			$this->session->set_flashdata('stationary_success_msg','<div class="alert alert-success text-center">Data Created Successfully!!!</div>');
            redirect(base_url('admin/stationary'), 'refresh');
        }

        if ($task == "update")
		{
			$this->stationary_sales->update($id);
			$this->session->set_flashdata('stationary_update_success_msg','<div class="alert alert-success text-center">Data Updated Successfully!!!</div>');
			redirect(base_url('admin/stationary'), 'refresh');
        }

        if ($task == "delete") {
            $this->stationary_sales->destroy($id);
			$this->session->set_flashdata('stationary_success_msg','<div class="alert alert-success text-center">Data Deleted Successfully!!!</div>');
            redirect(base_url('admin/stationary'), 'refresh');
        }

        $data['page_name'] = 'stationary/stationary_sales_list';
        $data['page_title'] = 'Manage-Stationary';
	    $data['get_data'] = $this->db->get('stationary_sales')->result_array();
	    $data['total_rows'] = $this->db->count_all('stationary_sales');
        $this->load->view('frontend/index', $data);
	}
	
	//stationary update-page
	function update_stationary($id)
	{
		$page_data['page_title'] = 'Update-Invoice';
		$page_data['page_name'] = 'update_stationary';
		$page_data['id'] = $id;
		$page_data['get_product'] = $this->db->get('products')->result_array();
		$page_data['category_list'] = $this->db->get('category')->result_array();
		$this->load->view( 'frontend/index',$page_data);

	}
	
	function stationary_items($task = " ", $id = "") {
        if ($this->session->userdata('login_type') != 'admin') {
            redirect(base_url(), 'refresh');
        }

        $data['page_name'] = 'stationary/items';
        $data['page_title'] = 'Stationary Sales List';
	    $data['get_data'] = $this->db->get('stationary_sales_order')->result_array();
	    $data['total_rows'] = $this->db->count_all('stationary_sales_order');
        $this->load->view('frontend/index', $data);
	}
	
	function create_stationary()
	{
		if ($this->session->userdata('login_type') != 'admin') {
            redirect(base_url(), 'refresh');
        }
		$data['page_title'] = 'Manage-Stationary';
		$data['page_name'] = 'stationary/create_sales';
		$data['get_product_array'] = $this->db->get('products')->result_array();
		$data['category_list'] = $this->db->get('category')->result_array();
		$data['total_product_rows'] = $this->db->count_all('products');
		$data['total_category_rows'] = $this->db->count_all('category');
		$data['vendor'] = $this->db->get('vendor')->result_array();
		$this->load->view( 'frontend/index', $data);

	}
	
	//Ajax get call
	function get_profit_margin() {
		$ice_cream = $this->db->get('ice_cream_sales')->result_array();
		$stationary = $this->db->get('stationary_sales')->result_array();
		$vat = $this->db->get('supplier')->result_array();
		$data = array('response' => false);
		if($stationary || $ice_cream || $vat){
			$data['data'] = array('ice_cream' => $ice_cream, 'stationary' => $stationary, 'vat' => $vat);
			$data['response'] = true;
		}else {
			$data['response'] = false;
			return false;
		}	
		echo json_encode($data);
	}
	
	//Ajax get call
	function get_stationary_list(){
		$stationary = $this->db->get('stationary_sales')->result_array();
		$data = array('response' => false);
		if($stationary){
			$data['data'] = $stationary;
			$data['response'] = true;
		}else {
			$data['response'] = false;
			return false;
		}	
		echo json_encode($data);
	}
	
	//Ajax get call
	function get_ice_cream_list(){
		$ice_cream = $this->db->get('ice_cream_sales')->result_array();
		$data = array('response' => false);
		if($ice_cream){
			$data['data'] = $ice_cream;
			$data['response'] = true;
		}else {
			$data['response'] = false;
			return false;
		}	
		echo json_encode($data);
	}
	
	//Ajax post call
	function get_product_details()
	{
		$get_id = $this->input->post('selected_product'); 
		$data = array('response' => false);
		if (isset($get_id)){
			if ($get_id != '') {
				$data['response'] = true;
				$result = $this->db->get_where('products', array('id' => $get_id))->result_array();
				foreach($result as $val) {
					$data['unit_price'] = $val['unit_price'];
					$data['item_name'] = $val['product_name'];
					$data['quantity_left'] = $val['quantity_in_stock'] - $val['quantity_sold'];
					$data['quantity_in_stock'] = $val['quantity_in_stock'];
					$data['quantity_sold'] = $val['quantity_sold'];
					$data['selling_price'] = $val['selling_price'];
				}
				$data['response'] = true;
			}else{
				$data['response'] = false;
				return false;
			}

		}
		echo json_encode($data);
	}
	
	function supplier($task = " ", $id = "") {
        if ($this->session->userdata('login_type') != 'admin') {
            redirect(base_url(), 'refresh');
        }

        if ($task == "create") {
			$clean = $this->security->xss_clean($this->input->post(NULL, TRUE));
			$this->supplier->insert($clean);
			$this->session->set_flashdata('supplier_success_msg', '<div class="alert alert-success text-center">Data Created Successfully!!!</div>', 60);
            redirect(base_url('admin/supplier'), 'refresh');
        }

        if ($task == "update")
		{
			$this->supplier->update($id);
			$this->session->set_flashdata('supplier_success_msg','<div class="alert alert-success text-center">Data Updated Successfully!!!</div>');
			redirect(base_url('admin/supplier'), 'refresh');
        }

        if ($task == "delete") {
            $this->supplier->destroy($id);
            redirect(base_url('admin/supplier'), 'refresh');
        }

        $data['page_name'] = 'supplier';
        $data['page_title'] = 'Manage-Supplier';
	    $data['get_supplier_data'] = $this->db->get('supplier')->result_array();
		$data['total_rows'] = $this->db->count_all('supplier');
        $this->load->view('frontend/index', $data);
	}
	
	/** Product-Category Controller **/
	function category($task = " ", $id = "")
	{
		if ($this->session->userdata('login_type') != 'admin') {
            redirect(base_url(), 'refresh');
        }
		
		if ($task == "create") {
			$clean = $this->security->xss_clean($this->input->post(NULL, TRUE));
			$this->category->insert($clean);
			$this->session->set_flashdata('category_success_msg', '<div class="alert alert-success text-center">Data Created Successfully!!!</div>', 60);
            redirect(base_url('admin/category'), 'refresh');
        }
		
		if ($task == "update")
		{
			$this->category->update($id);
			$this->session->set_flashdata('category_success_msg','<div class="alert alert-success text-center">Data Updated Successfully!!!</div>');
			redirect(base_url('admin/category'), 'refresh');
		}
		
		if ($task == "delete") {
            $this->category->destroy($id);
			$this->session->set_flashdata('category_success_msg','<div class="alert alert-success text-center">Data Deleted Successfully!!!</div>');
            redirect(base_url('admin/category'), 'refresh');
        }
		
		$data['page_title'] = 'Manage Category';
		$data['page_name'] = 'category';
		$data['get_category_array'] = $this->db->get('category')->result_array();
		$data['total_category_rows'] = $this->db->count_all('category');
		$this->load->view( 'frontend/index', $data);
	}
	
	/** Product Controller **/
	function product($task = " ", $id = "")
	{
		if ($this->session->userdata('login_type') != 'admin') {
            redirect(base_url(), 'refresh');
        }

        if ($task == "create") {
			$clean = $this->security->xss_clean($this->input->post(NULL, TRUE));
			$this->product->insert($clean);
			$this->session->set_flashdata('product_success_msg', '<div class="alert alert-success text-center">Data Created Successfully!!!</div>', 60);
            redirect(base_url('admin/product'), 'refresh');
        }
		
		if ($task == "update")
		{
			$this->product->update($id);
			$this->session->set_flashdata('product_success_msg','<div class="alert alert-success text-center">Data Updated Successfully!!!</div>');
			redirect(base_url('admin/product'), 'refresh');
		}

        if ($task == "delete") {
            $this->product->destroy($id);
			$this->session->set_flashdata('product_success_msg','<div class="alert alert-success text-center">Data Deleted Successfully!!!</div>');
            redirect(base_url('admin/product'), 'refresh');
        }
		
		$data['page_title'] = 'Manage Product';
		$data['page_name'] = 'product';
		$data['get_product_array'] = $this->db->get('products')->result_array();
		$data['total_product_rows'] = $this->db->count_all('products');
		$data['get_category_array'] = $this->db->get('category')->result_array();
		$data['total_category_rows'] = $this->db->count_all('category');
		$this->load->view( 'frontend/index', $data);
	}

	// VENDOR
	function vendor($task=" ", $id = " "){
		if ($this->session->userdata('login_type') != 'admin')
		{
			redirect(base_url(), 'refresh');
		}
		
		if ($task == "create"){
			$clean = $this->security->xss_clean($this->input->post(NULL, TRUE));
			$this->vendor->insert($clean);
			$this->session->set_flashdata('vendor_success_msg','<div class="alert alert-success text-center"> Data Created Successfully!!!</div>');
			redirect(base_url('admin/vendor'), 'refresh');
		}

		if ($task == "update")
		{
			$this->vendor->update($id);
			$this->session->set_flashdata('vendor_success_msg','<div class="alert alert-success text-center"> Data Updated Successfully!!!</div>');
			redirect(base_url('admin/vendor'), 'refresh');
		}

		if ($task == "delete"){
			$this->vendor->destroy($id);
			$this->session->set_flashdata('vendor_success_msg','<div class="alert alert-success text-center"> Data Deleted Successfully!!!</div>');
			redirect(base_url('admin/vendor'), 'refresh');
		}

		$data['page_title'] = 'Manage-Vendor';
		$data['page_name'] = 'vendor';
		$data['vendor_list'] = $this->db->get('vendor')->result_array();
		$data['total_vendor_rows'] = $this->db->count_all('vendor');
		$this->load->view( 'frontend/index', $data);
    }


	function get_customer()
	{
		$get_name = $this->input->post('selected_name'); //Ajax post received
		$valid = array('success' => false);
		if (isset($get_name)){
			if ($get_name != '') {
				$valid['success'] = true;
				$result = $this->db->get_where('customers', array('customer_name' => $get_name))->result_array();
				foreach($result as $val) {
					$valid['address'] = $val['address'];
					$valid['phone'] = $val['phone'];
				}
			}else{
				$valid['success'] = true;
			}

		}
		echo json_encode($valid);
	}
	
	/******MANAGE OWN PROFILE AND CHANGE PASSWORD** */

    function profile($param1 = '', $param2 = '') {
        if ($this->session->userdata('login_type') != 'admin')
            redirect(base_url() . 'account', 'refresh');

        if ($param1 == 'update_profile_info') {
            $data['user_name'] = $this->input->post('name');
            $data['role'] = $this->input->post('role');

            $this->db->where('admin_id', $this->session->userdata('id'));
            $this->db->update('admin', $data);

            $this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Profile Settings Updated Successfully!!!</div>');
            redirect(base_url() . 'admin/profile');
        }
        if ($param1 == 'change_password') {
            $current_password_input = sha1($this->input->post('password'));
            $new_password = sha1($this->input->post('new_password'));
            $confirm_new_password = sha1($this->input->post('confirm_new_password'));

            $current_password_db = $this->db->get_where('admin', array('admin_id' =>
            $this->session->userdata('id')))->row()->password;

            if ($current_password_db == $current_password_input && $new_password == $confirm_new_password) {
                $this->db->where('admin_id', $this->session->userdata('id'));
                $this->db->update('admin', array('password' => $new_password));
                $this->session->set_flashdata('profile_success_msg','<div class="alert alert-success text-center">Password Settings Updated Successfully!!!</div>');
                redirect(base_url() . 'admin/profile');
            } else {
                $this->session->set_flashdata('profile_error_msg','<div class="alert alert-danger text-center">Settings Update Failed...</div>');
                redirect(base_url() . 'admin/profile');
            }
        }
        $data['page_title'] = 'Staff Profile';
        $data['page_name'] = 'manage_profile';
        $data['update_admin'] = $this->db->get_where('admin', array('admin_id' => $this->session->userdata('id')))->result_array();
	    $data['staff'] = $this->db->get_where('admin', array('role' => 'staff'))->result_array();
		$data['total_rows'] = $this->db->count_all('admin');
        $this->load->view('frontend/index', $data);
		
	}

    /*****SITE/SYSTEM SETTINGS******** */

    function settings($param1 = '') {
        if ($this->session->userdata('login_type') != 'admin')
            redirect(base_url() . 'account', 'refresh');

        if ($param1 == 'do_update') {
            $this->user->update_system_settings();
			$this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Settings Updated Successfully!!!</div>');
            redirect(base_url() . 'admin/settings/', 'refresh');
        }
        $page_data['page_name'] = 'sys_settings';
        $page_data['page_title'] = 'App-Settings';
        $this->load->view('frontend/index', $page_data);

    }

    /******MANAGE OWN PROFILE AND CHANGE PASSWORD** */

    function staff($param1 = '', $param2 = '') {
        if ($this->session->userdata('login_type') != 'admin')
            redirect(base_url() . 'account', 'refresh');

        if ($param1 == 'update_profile_info') {
            $data['user_name'] = $this->input->post('name');
            $data['role'] = $this->input->post('role');

            $this->db->where('admin_id', $this->session->userdata('id'));
            $this->db->update('admin', $data);

            $this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Profile Settings Updated Successfully!!!</div>');
            redirect(base_url() . 'admin/staff');
        }
        if ($param1 == 'change_password') {
            $current_password_input = sha1($this->input->post('password'));
            $new_password = sha1($this->input->post('new_password'));
            $confirm_new_password = sha1($this->input->post('confirm_new_password'));

            $current_password_db = $this->db->get_where('admin', array('admin_id' => $this->session->userdata('id')))->row()->password;

            if ($current_password_db == $current_password_input && $new_password == $confirm_new_password) {
                $this->db->where('admin_id', $this->session->userdata('id'));
                $this->db->update('admin', array('password' => $new_password));
                $this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Password Settings Updated Successfully!!!</div>');
                redirect(base_url() . 'admin/staff');
            } else {
                $this->session->set_flashdata('error_msg','<div class="alert alert-danger text-center">Settings Update Failed...</div>');
                redirect(base_url() . 'admin/staff');
            }
        }
        $data['page_name'] = 'manage_profile';
        $data['page_title'] = 'Staff Profile';
        $data['update_admin'] = $this->db->get_where('admin', array('admin_id' => $this->session->userdata('id')))->result_array();
	    $data['staff'] = $this->db->get_where('admin', array('role' => 'staff'))->result_array();
		$data['total_rows'] = $this->db->count_all('admin');
        $this->load->view('frontend/index', $data);
    }
}

ob_end_flush();
