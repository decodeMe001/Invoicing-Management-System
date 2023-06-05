<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
ob_start();

require_once __DIR__ . '\..\..\autoload.php';
<<<<<<< HEAD
=======

>>>>>>> 060766fe05b38dadf2897b881fab97884399e5e3
// cart-class
use utility\CartItems;

class Admin extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->database();
<<<<<<< HEAD
		$this->load->library("cart");
=======
		$this->load->library('session');
>>>>>>> 060766fe05b38dadf2897b881fab97884399e5e3
    }

     /***default function, redirects to login page if no admin logged in yet** */
    function index() {
        if ($this->session->userdata('login_type') != 'admin'){
            redirect(base_url() . 'account', 'refresh');
<<<<<<< HEAD
		if ($this->session->userdata('manager') != 1)
			redirect(base_url() . 'account', 'refresh');
        if ($this->session->userdata('admin_login') == 1)
            redirect(base_url() . 'admin/dashboard', 'refresh');
		if ($this->session->userdata('manager') == 1)
			redirect(base_url(). 'admin/dashboard', 'refresh');
=======
		}

>>>>>>> 060766fe05b38dadf2897b881fab97884399e5e3
    }

    /*** ADMIN DASHBOARD** */

    function dashboard()
	{
<<<<<<< HEAD
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }

	    if ($this->session->userdata('manager') != 1) {
=======
	    if ($this->session->userdata('login_type') != 'admin') {
>>>>>>> 060766fe05b38dadf2897b881fab97884399e5e3
            redirect(base_url(), 'refresh');
        }
		
        $data['page_name'] = 'dashboard';
<<<<<<< HEAD
	    $data['page_title'] = 'Admin-Dashboard';
		$data['staff_sales_record'] = $this->db->get_where('invoice_order', array('order_date' => date('Y-m-d')))->result_array();
		$data['monthly_record'] = $this->crud_model->get_total_monthly_sales_amount();
		$data['total_profit'] = $this->crud_model->get_all_product_profit();
		$data['total_cp'] = $this->crud_model->get_total_cp();
		$data['total_sp'] = $this->crud_model->get_total_sp();
=======
	    $data['page_title'] = 'Dashboard';
>>>>>>> 060766fe05b38dadf2897b881fab97884399e5e3
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

<<<<<<< HEAD
	
	//Category Function
	function category($task = " ", $cat_id = "") {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
		if ($this->session->userdata('manager') != 1) {
            redirect(base_url(), 'refresh');
        }

        if ($task == "create") {
            $clean = $this->security->xss_clean($this->input->post(NULL, TRUE));
			$this->crud_model->insert_category($clean);
			$this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Created Successfully!!!</div>');
            redirect(base_url('admin/category'), 'refresh');
        }

        if ($task == "update")
		{
			$this->crud_model->update_category($cat_id);
			$this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Updated Successfully!!!</div>');
			redirect(base_url('admin/category'), 'refresh');
        }

        if ($task == "delete") {
            $this->crud_model->delete_category($cat_id);
			$this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Deleted Successfully!!!</div>');
            redirect(base_url('admin/category'), 'refresh');
        }

        $data['page_name'] = 'manage_category';
        $data['page_title'] = 'Manage-Category';
		$data['total_rows'] = $this->db->count_all('store_category');
		$data['category_data'] = $this->db->get('store_category')->result_array();
        $this->load->view('frontend/index', $data);
	}

	function product($task = " ", $product_id = "") {
        if ($this->session->userdata('admin_login') != 1 | $this->session->userdata('manager') != 1) {
            redirect(base_url(), 'refresh');
        }

        if ($task == "create") {
            $clean = $this->security->xss_clean($this->input->post(NULL, TRUE));
			$this->crud_model->insert_product($clean);
			$this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Created Successfully!!!</div>');
            redirect(base_url('admin/product'), 'refresh');
        }

        if ($task == "update")
		{
			$this->crud_model->update_product($product_id);
			$this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Updated Successfully!!!</div>');
			redirect(base_url('admin/product'), 'refresh');
        }

        if ($task == "delete") {
            $this->crud_model->delete_product($product_id);
			$this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Deleted Successfully!!!</div>');
            redirect(base_url('admin/product'), 'refresh');
        }

        $data['page_name'] = 'manage_product';
        $data['page_title'] = 'Manage-Products';
		$data['total_rows'] = $this->db->count_all('store_product');
		$data['product_data'] = $this->db->get('store_product')->result_array();
        $this->load->view('frontend/index', $data);
	}

	function expired(){
		$data['page_name'] = 'expired_product';
		$data['page_title'] = 'Expired-Products';
		$data['product_data'] = $this->db->get_where('store_product', array('expiry_date <=' => date('Y-m-d')))->result_array();
		$this->load->view('frontend/index', $data);
	}
=======
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
>>>>>>> 060766fe05b38dadf2897b881fab97884399e5e3

	function going_soon(){
		$data['page_name'] = 'expired_in_six_months';
		$data['page_title'] = 'Going-Soon-Products';
		$sixMonthsFromNow = date('Y-m-d', strtotime('+6 months'));
		$this->db->select('*');
		$this->db->from('store_product');
		$this->db->where('expiry_date >=', date('Y-m-d'));
		$this->db->where('expiry_date <=', $sixMonthsFromNow);
		$query = $this->db->get();
		$data['product_data'] = $query->result_array();
		$data['total_rows'] = $query->num_rows();
		$this->load->view('frontend/index', $data);
	}
	
	function ice_cream_items() {
        if ($this->session->userdata('login_type') != 'admin') {
            redirect(base_url(), 'refresh');
        }

<<<<<<< HEAD
	function customers($task = " ", $customer_id = "") {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
		if ($this->session->userdata('manager') != 1) {
=======
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
>>>>>>> 060766fe05b38dadf2897b881fab97884399e5e3
            redirect(base_url(), 'refresh');
        }

        if ($task == "create") {
            $clean = $this->security->xss_clean($this->input->post(NULL, TRUE));
<<<<<<< HEAD
			$this->crud_model->insert_customer($clean);
			$this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Created Successfully!!!</div>');
            redirect(base_url('admin/customers'), 'refresh');
        }

        if ($task == "update")
		{
			$this->crud_model->update_customer($customer_id);
			$this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Updated Successfully!!!</div>');
			redirect(base_url('admin/customers'), 'refresh');
        }

        if ($task == "delete") {
            $this->crud_model->delete_customer($customer_id);
			$this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Deleted Successfully!!!</div>');
            redirect(base_url('admin/customers'), 'refresh');
        }

        $data['page_name'] = 'customers';
        $data['page_title'] = 'Manage-Customers';
		$data['total_rows'] = $this->db->count_all('customers');
		$data['customer_data'] = $this->db->get('customers')->result_array();
        $this->load->view('frontend/index', $data);
	}

	// Expenses
	function expenses($task = " ", $expense_id = "") {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
		if ($this->session->userdata('manager') != 1) {
            redirect(base_url(), 'refresh');
        }

        if ($task == "create") {
            $clean = $this->security->xss_clean($this->input->post(NULL, TRUE));
			$this->crud_model->insert_expenses($clean);
			$this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Created Successfully!!!</div>');
            redirect(base_url('admin/expenses'), 'refresh');
=======
			$this->stationary_sales->insert($clean);
			$this->session->set_flashdata('stationary_success_msg','<div class="alert alert-success text-center">Data Created Successfully!!!</div>');
            redirect(base_url('admin/stationary'), 'refresh');
>>>>>>> 060766fe05b38dadf2897b881fab97884399e5e3
        }

        if ($task == "update")
		{
<<<<<<< HEAD
			$this->crud_model->update_expenses($expense_id);
			$this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Updated Successfully!!!</div>');
			redirect(base_url('admin/expenses'), 'refresh');
        }

        if ($task == "delete") {
            $this->crud_model->delete_expenses($expense_id);
			$this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Deleted Successfully!!!</div>');
            redirect(base_url('admin/expenses'), 'refresh');
        }

        $data['page_name'] = 'expenses';
        $data['page_title'] = 'Manage-Expenses';
		$data['total_rows'] = $this->db->count_all('expenses');
		$data['expense_data'] = $this->db->get('expenses')->result_array();
        $this->load->view('frontend/index', $data);
	}

	// Suppliers
	function suppliers($task = " ", $supplier_id = "") {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
		if ($this->session->userdata('manager') != 1) {
            redirect(base_url(), 'refresh');
        }

        if ($task == "create") {
            $clean = $this->security->xss_clean($this->input->post(NULL, TRUE));
			$this->crud_model->insert_suppliers($clean);
			$this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Created Successfully!!!</div>');
            redirect(base_url('admin/suppliers'), 'refresh');
        }

        if ($task == "update")
		{
			$this->crud_model->update_suppliers($supplier_id);
			$this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Updated Successfully!!!</div>');
			redirect(base_url('admin/suppliers'), 'refresh');
        }

        if ($task == "delete") {
            $this->crud_model->delete_suppliers($supplier_id);
			$this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Deleted Successfully!!!</div>');
            redirect(base_url('admin/suppliers'), 'refresh');
        }

        $data['page_name'] = 'suppliers';
        $data['page_title'] = 'Manage-Suppliers';
		$data['total_rows'] = $this->db->count_all('suppliers');
		$data['supplier_data'] = $this->db->get('suppliers')->result_array();
=======
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
>>>>>>> 060766fe05b38dadf2897b881fab97884399e5e3
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
		if ($this->session->userdata('manager') != 1) {
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
<<<<<<< HEAD
			$this->crud_model->insert_staff($clean);
            $this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Created Successfully!!!</div>');
            redirect(base_url('admin/profile'), 'refresh');
=======
			$this->supplier->insert($clean);
			$this->session->set_flashdata('supplier_success_msg', '<div class="alert alert-success text-center">Data Created Successfully!!!</div>', 60);
            redirect(base_url('admin/supplier'), 'refresh');
>>>>>>> 060766fe05b38dadf2897b881fab97884399e5e3
        }

        if ($task == "update")
		{
<<<<<<< HEAD
			$this->crud_model->update_staff($id);
			$this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Updated Successfully!!!</div>');
			redirect(base_url('admin/profile'), 'refresh');
        }

        if ($task == "delete")
		{
            $this->crud_model->delete_staff($id);
			$this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Deleted Successfully!!!</div>');
            redirect(base_url('admin/profile'), 'refresh');
        }

        $page_data['page_name'] = 'manage_profile';
        $page_data['page_title'] = 'Staff Profile';
        $page_data['update_admin'] = $this->db->get_where('admin', array('admin_id' => $this->session->userdata('id')))->result_array();
	    $page_data['staff'] = $this->db->get_where('admin', array('role' => 'staff'))->result_array();
        $this->load->view('frontend/index', $page_data);
	}

	function daily_staff_sales_record(){
		if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
		if ($this->session->userdata('manager') != 1) {
            redirect(base_url(), 'refresh');
        }
        

		$page_data['page_name'] = 'daily_staff_report';
        $page_data['page_title'] = 'Staff Sales Report';
		$page_data['sales_record'] = $this->db->get_where('invoice_order', array('order_date' => date('Y-m-d')))->result_array();
		$this->load->view('frontend/index', $page_data);
	}

	function monthly_sales_record(){
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
		if ($this->session->userdata('manager') != 1) {
            redirect(base_url(), 'refresh');
        }

		// $this->db->select('DATE(order_date) AS sales_date, SUM(order_total) AS total_sales, SUM(selling_price - cost_price) AS total_profit');
		$this->db->select('DATE(order_date) AS sales_date, SUM(order_total) AS total_sales, 
							SUM(profit_margin) AS total_daily_profit,
							SUM(method_by_pos) AS total_daily_pos,
							SUM(method_by_transfer) AS total_daily_transfer,
							SUM(method_by_cash) AS total_daily_cash'
						);
		$this->db->from('invoice_order');
		$this->db->where('MONTH(order_date)', date('m')); // Replace $month with the desired month number (e.g., 1 for January)
		$this->db->where('YEAR(order_date)', date('Y')); // Replace $year with the desired year
		$this->db->group_by('DATE(order_date)');
		$this->db->order_by('DATE(order_date)');
		$query = $this->db->get();
		$data["results"] = $query->result_array();
		$data['total_rows'] = $query->num_rows();
		$data['page_title'] = 'Monthly Sales Report';
		$data['page_name'] = 'monthly_daily_sales';
		$this->load->view('frontend/index', $data);
	}

	function most_sold_products(){
		if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
		if ($this->session->userdata('manager') != 1) {
            redirect(base_url(), 'refresh');
        }
=======
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
>>>>>>> 060766fe05b38dadf2897b881fab97884399e5e3

		$this->db->select('item_name, SUM(order_item_quantity) AS total_sold, SUM(order_item_actual_amount) AS total_amount_sold');
		$this->db->from('invoice_order_item');
		$this->db->where('MONTH(created_at)', date('m')); // Replace $month with the desired month number (e.g., 1 for January)
		$this->db->where('YEAR(created_at)', date('Y')); // Replace $year with the desired year
		$this->db->group_by('item_name');
		$this->db->order_by('total_sold', 'DESC');
		$this->db->limit(50);
		$query = $this->db->get();
		$data["results"] = $query->result_array();
		$data['total_rows'] = $query->num_rows();
		$data['page_title'] = 'Sold Products';
		$data['page_name'] = 'most_sold';
		$this->load->view('frontend/index', $data);
	}
<<<<<<< HEAD


    function checkout($task = " ", $id = " "){
		if ($this->session->userdata('admin_login') != 1){
		  redirect(base_url(), 'refresh');
		}
		if ($this->session->userdata('manager') != 1){
		  redirect(base_url(), 'refresh');
		}
		if ($task == "create"){
			$clean = $this->security->xss_clean($this->input->post(NULL, TRUE));
			$this->crud_model->insertOrder($clean);
			$this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Transaction Completed Successfully!</div>');	
		}
		
		$data['page_title'] = 'Products Details';
		$data['page_name'] = 'checkout';
		$data['total_rows'] = $this->db->count_all('store_product');
		$data['product_data'] = $this->db->get('store_product')->result_array();
		$this->cart->destroy();
		$this->load->view( 'frontend/index',$data);
    }
	
	function load_cart(){
		echo $this->view_cart();
	}
	
	 function add_to_cart(){
		$data = array(
			"id"  => $_POST["id"],
			"name"  => $_POST["title"],
			"qty"  => $_POST["qty"],
			"price"  => $_POST["price"],
			"options" => array("brand_name" => $_POST["brand_name"], "qty_in_stock" => $_POST["qty_in_stock"], "profit_margin"=>$_POST["profit_margin"])
		);
		$this->cart->insert($data);
		echo $this->view_cart();
	}
	
	function remove_from_cart()
	{
		$row_id = $_POST["id"];
		$data = array('rowid'  => $row_id, 'qty'  => 0);
		$this->cart->update($data);
		echo $this->view_cart();
	}

	function clear_cart()
	{
		$this->cart->destroy();
		echo $this->view_cart();
	}
	
	function view_cart(){
		$output = '';
		$output .= '
		
		<div class="table-responsive">
			<div align="right"><br/>
				<button type="button" id="clear_cart" class="btn btn-warning">Clear Cart</button>
			</div>
			<table class="table table-bordered table-striped display" style="width:100%;">
				<thead>
					<tr>
						<th width="6%">Sr No.</th>
						<th width="30%">Item Name</th>
						<th width="8%">Qty</th>
						<th width="15%">Amount[&#8358;]</th>
						<th width="15%">Total[&#8358;]</th>
						<th width="15%">Action</th>
					</tr>
				</thead>
		  ';
		  $count = 0;
		  foreach($this->cart->contents() as $items)
		  {
			   $count++;
			   $output .='
				<tr> 
					<td><span id="sr_no">'.$count.'</span></td>
					<td>'.$items["name"].'</td>
					<td>'.$items["qty"].'</td>
					<td>&#8358;'.number_format($items["price"], 2, '.', ',').'</td>
					<td>&#8358;'.number_format($items["subtotal"], 2, '.', ',').'</td>
					<td>
						<button type="button" name="remove" class="btn btn-danger btn-xs remove_inventory" id="'.$items["rowid"].'">
							<i class="fa fa-times" style="color: #fff;"></i>
						</button>
					</td>
				</tr>
				';
				}
				$output .='
				<tr>
				<td colspan="4" align="right"><b>Total:</b></td>
				<td><b><input id="cart_total" class="form-control input-sm" value="&#8358;'.number_format($this->cart->total(), 2, '.', ',').'" disabled /></b></td>
				</tr>
			</table>
			<center>
				<input type="submit" id="checkButton" class="btn btn-success btn-lg" value="Proceed to Pay" disabled />
			</center>
			<br/><br/><hr/>
		</div>
		
		  ';

		if($count == 0)
		{
			$output = '<h6 align="left">Cart is Empty</h6>';
		}
		
		return $output;
	}
	
	public function sales_item(){
        if ($this->session->userdata('admin_login') != 1)
		{
			redirect(base_url(), 'refresh');
		}
		if ($this->session->userdata('manager') != 1) {
            redirect(base_url(), 'refresh');
        }

        $data['page_title'] = 'Manage Sales Items';
		$data['page_name'] = 'cart_items';
		$this->load->view( 'frontend/index',$data);
    }
	
	public function sales_order($task="", $id=""){
		 if ($this->session->userdata('admin_login') != 1){
			redirect(base_url(), 'refresh');
		}
		if ($this->session->userdata('manager') != 1) {
            redirect(base_url(), 'refresh');
        }
		
		if ($task == "update"){
			$this->crud_model->update_order($id);
			$this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Updated Successfully!!!</div>');
			redirect(base_url('admin/sales_order'), 'refresh');
=======
	
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
>>>>>>> 060766fe05b38dadf2897b881fab97884399e5e3
        }
        if ($param1 == 'change_password') {
            $current_password_input = sha1($this->input->post('password'));
            $new_password = sha1($this->input->post('new_password'));
            $confirm_new_password = sha1($this->input->post('confirm_new_password'));

<<<<<<< HEAD
        if ($task == "delete"){
            $this->crud_model->delete_order($id);
			$this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Deleted Successfully!!!</div>');
            redirect(base_url('admin/sales_order'), 'refresh');
        }

		$total_today = 0;
		$total_cash = 0;
		$total_pos = 0;
		$total_transfer = 0;
		$get_date = date('Y-m-d', strtotime('today midnight'));
		$sales_amt = $this->db->get_where('invoice_order', array('order_date' => $get_date))->result_array();
		foreach($sales_amt as $sales){
			$total_today += $sales['order_total'];
			$total_cash += $sales['method_by_cash'];
			$total_pos += $sales['method_by_pos'];
			$total_transfer += $sales['method_by_transfer'];
		}
		$data["total_sales"] = $total_today;
		$data["total_daily_cash"] = $total_cash;
		$data["total_daily_pos"] = $total_pos;
		$data["total_daily_transfer"] = $total_transfer;

		$data['page_title'] = 'Manage Sales Order';
		$data['page_name'] = 'orders';
		$data['invoice_data'] = $this->db->get('invoice_order')->result_array();
		$data['total_rows'] = $this->db->count_all('invoice_order');
		$this->load->view( 'frontend/index',$data);
	}
	
	//get update-page
	function update_sales($param2 = '')
	{
		$page_data['page_title'] = 'Manage-Order';
		$page_data['page_name'] = 'update_orders';
		$page_data['param2'] = $param2;
		$this->load->view( 'frontend/index',$page_data);
=======
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
	
	/** POS-invoice printer **/
	function print_invoice($id=" "){
		try {
			$db_items = $this->crud_model->get_cart_items($id);
			$db_order = $this->crud_model->get_order($id);
			
			foreach($db_order as $result){
				/* Information for the receipt */
				$subtotal = new CartItems('Total', $result['order_total']);
				$balance = new CartItems('Balance', $result['balance']);
				$total = new CartItems('Cash Paid', $result['paid'], true);
			}
			
			$header = new CartItems('Photo Type(Qty)', '#');
			$tax = new CartItems('A local tax', '0.00');
			$this->receiptprint->connect();
			$this->receiptprint->print_test_receipt($header, $db_items, $subtotal, $balance, $tax, $total);
			$this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Printed Successfully!!!</div>');

		} catch (Exception $e) {
			log_message("error", "Error: Could not print. Message ".$e->getMessage());
			$this->receiptprint->close_after_exception();
		}
		redirect(base_url('admin/invoice'), 'refresh');		
	}
>>>>>>> 060766fe05b38dadf2897b881fab97884399e5e3

	}
    /*****SITE/SYSTEM SETTINGS******** */

<<<<<<< HEAD
    public function settings($param1 = '') {
        if ($this->session->userdata('admin_login') != 1){
=======
    function settings($param1 = '') {
        if ($this->session->userdata('login_type') != 'admin')
>>>>>>> 060766fe05b38dadf2897b881fab97884399e5e3
            redirect(base_url() . 'account', 'refresh');
		}
		if ($this->session->userdata('manager') != 1) {
			redirect(base_url(), 'refresh');
		}

        if ($param1 == 'do_update') {
<<<<<<< HEAD
            $this->crud_model->update_system_settings();
			$this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Updated Successfully!!!</div>');
=======
            $this->user->update_system_settings();
			$this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Settings Updated Successfully!!!</div>');
>>>>>>> 060766fe05b38dadf2897b881fab97884399e5e3
            redirect(base_url() . 'admin/settings/', 'refresh');
        }
        $page_data['page_name'] = 'sys_settings';
        $page_data['page_title'] = 'App-Settings';
        $this->load->view('frontend/index', $page_data);

    }

    /******MANAGE OWN PROFILE AND CHANGE PASSWORD** */

<<<<<<< HEAD
    function profile($param1 = '', $param2 = '') {
        if ($this->session->userdata('admin_login') != 1){
=======
    function staff($param1 = '', $param2 = '') {
        if ($this->session->userdata('login_type') != 'admin')
>>>>>>> 060766fe05b38dadf2897b881fab97884399e5e3
            redirect(base_url() . 'account', 'refresh');
		}
		if ($this->session->userdata('manager') != 1) {
            redirect(base_url(), 'refresh');
        }
		
        if ($param1 == 'update_profile_info') {
            $data['user_name'] = $this->input->post('name');
            $data['role'] = $this->input->post('role');

            $this->db->where('admin_id', $this->session->userdata('id'));
            $this->db->update('admin', $data);

<<<<<<< HEAD
            $this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Updated Successfully!!!</div>');
            redirect(base_url() . 'admin/profile');
=======
            $this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Profile Settings Updated Successfully!!!</div>');
            redirect(base_url() . 'admin/staff');
>>>>>>> 060766fe05b38dadf2897b881fab97884399e5e3
        }
        if ($param1 == 'change_password') {
            $current_password_input = sha1($this->input->post('password'));
            $new_password = sha1($this->input->post('new_password'));
            $confirm_new_password = sha1($this->input->post('confirm_new_password'));

            $current_password_db = $this->db->get_where('admin', array('admin_id' => $this->session->userdata('id')))->row()->password;

            if ($current_password_db == $current_password_input && $new_password == $confirm_new_password) {
                $this->db->where('admin_id', $this->session->userdata('id'));
                $this->db->update('admin', array('password' => $new_password));
<<<<<<< HEAD

                $this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Updated Successfully!!!</div>');
                redirect(base_url() . 'admin/profile');
=======
                $this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Password Settings Updated Successfully!!!</div>');
                redirect(base_url() . 'admin/staff');
>>>>>>> 060766fe05b38dadf2897b881fab97884399e5e3
            } else {
                $this->session->set_flashdata('error_msg','<div class="alert alert-danger text-center">Settings Update Failed...</div>');
                redirect(base_url() . 'admin/staff');
            }
        }
<<<<<<< HEAD
        $page_data['page_name'] = 'manage_profile';
        $page_data['page_title'] = 'Staff Profile';
        $page_data['update_admin'] = $this->db->get_where('admin', array('admin_id' => $this->session->userdata('id')))->result_array();
	    $page_data['staff'] = $this->db->get_where('admin', array('role' => 'staff'))->result_array();
        $this->load->view('frontend/index', $page_data);
    }

	/** POS-invoice printer **/
	
=======
        $data['page_name'] = 'manage_profile';
        $data['page_title'] = 'Staff Profile';
        $data['update_admin'] = $this->db->get_where('admin', array('admin_id' => $this->session->userdata('id')))->result_array();
	    $data['staff'] = $this->db->get_where('admin', array('role' => 'staff'))->result_array();
		$data['total_rows'] = $this->db->count_all('admin');
        $this->load->view('frontend/index', $data);
    }
>>>>>>> 060766fe05b38dadf2897b881fab97884399e5e3
}

ob_end_flush();
