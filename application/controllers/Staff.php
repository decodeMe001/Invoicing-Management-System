<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
ob_start();

require_once __DIR__ . '\..\..\autoload.php';
// cart-class
use utility\CartItems;

class Staff extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->database();
		$this->load->library("cart");
    }

    /***default function, redirects to login page if no staff logged in yet** */
    function index() {
        if ($this->session->userdata('staff_login') != 1)
            redirect(base_url() . 'account', 'refresh');
		if ($this->session->userdata('manager') != 1)
			redirect(base_url() . 'account', 'refresh');
        if ($this->session->userdata('staff_login') == 1)
            redirect(base_url() . 'staff/dashboard', 'refresh');
		if ($this->session->userdata('manager') == 1)
			redirect(base_url(). 'staff/dashboard', 'refresh');
    }

    /*** ADMIN DASHBOARD** */

    function dashboard()
	{
        if ($this->session->userdata('staff_login') != 1) {
            redirect(base_url(), 'refresh');
        }

	    if ($this->session->userdata('manager') != 1) {
            redirect(base_url(), 'refresh');
        }
        $data['page_name'] = 'dashboard';
	    $data['page_title'] = 'Admin-Dashboard';
		$data['staff_sales_record'] = $this->db->get_where('invoice_order', array('order_date' => date('Y-m-d')))->result_array();
		$data['monthly_record'] = $this->crud_model->get_total_monthly_sales_amount();
		$data['total_profit'] = $this->crud_model->get_all_product_profit();
		$data['total_cp'] = $this->crud_model->get_total_cp();
		$data['total_sp'] = $this->crud_model->get_total_sp();
        $this->load->view('frontend/index', $data);
    }

	
	//Category Function
	function category($task = " ", $cat_id = "") {
        if ($this->session->userdata('staff_login') != 1) {
            redirect(base_url(), 'refresh');
        }
		if ($this->session->userdata('manager') != 1) {
            redirect(base_url(), 'refresh');
        }

        if ($task == "create") {
            $clean = $this->security->xss_clean($this->input->post(NULL, TRUE));
			$this->crud_model->insert_category($clean);
			$this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Created Successfully!!!</div>');
            redirect(base_url('staff/category'), 'refresh');
        }

        if ($task == "update")
		{
			$this->crud_model->update_category($cat_id);
			$this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Updated Successfully!!!</div>');
			redirect(base_url('staff/category'), 'refresh');
        }

        if ($task == "delete") {
            $this->crud_model->delete_category($cat_id);
			$this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Deleted Successfully!!!</div>');
            redirect(base_url('staff/category'), 'refresh');
        }

        $data['page_name'] = 'manage_category';
        $data['page_title'] = 'Manage-Category';
		$data['total_rows'] = $this->db->count_all('store_category');
		$data['category_data'] = $this->db->get('store_category')->result_array();
        $this->load->view('frontend/index', $data);
	}

	function product($task = " ", $product_id = "") {
        if ($this->session->userdata('staff_login') != 1 | $this->session->userdata('manager') != 1) {
            redirect(base_url(), 'refresh');
        }

        if ($task == "create") {
            $clean = $this->security->xss_clean($this->input->post(NULL, TRUE));
			$this->crud_model->insert_product($clean);
			$this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Created Successfully!!!</div>');
            redirect(base_url('staff/product'), 'refresh');
        }

        if ($task == "update")
		{
			$this->crud_model->update_product($product_id);
			$this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Updated Successfully!!!</div>');
			redirect(base_url('staff/product'), 'refresh');
        }

        if ($task == "delete") {
            $this->crud_model->delete_product($product_id);
			$this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Deleted Successfully!!!</div>');
            redirect(base_url('staff/product'), 'refresh');
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

	function customers($task = " ", $customer_id = "") {
        if ($this->session->userdata('staff_login') != 1) {
            redirect(base_url(), 'refresh');
        }
		if ($this->session->userdata('manager') != 1) {
            redirect(base_url(), 'refresh');
        }

        if ($task == "create") {
            $clean = $this->security->xss_clean($this->input->post(NULL, TRUE));
			$this->crud_model->insert_customer($clean);
			$this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Created Successfully!!!</div>');
            redirect(base_url('staff/customers'), 'refresh');
        }

        if ($task == "update")
		{
			$this->crud_model->update_customer($customer_id);
			$this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Updated Successfully!!!</div>');
			redirect(base_url('staff/customers'), 'refresh');
        }

        if ($task == "delete") {
            $this->crud_model->delete_customer($customer_id);
			$this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Deleted Successfully!!!</div>');
            redirect(base_url('staff/customers'), 'refresh');
        }

        $data['page_name'] = 'customers';
        $data['page_title'] = 'Manage-Customers';
		$data['total_rows'] = $this->db->count_all('customers');
		$data['customer_data'] = $this->db->get('customers')->result_array();
        $this->load->view('frontend/index', $data);
	}

	// Expenses
	function expenses($task = " ", $expense_id = "") {
        if ($this->session->userdata('staff_login') != 1) {
            redirect(base_url(), 'refresh');
        }
		if ($this->session->userdata('manager') != 1) {
            redirect(base_url(), 'refresh');
        }

        if ($task == "create") {
            $clean = $this->security->xss_clean($this->input->post(NULL, TRUE));
			$this->crud_model->insert_expenses($clean);
			$this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Created Successfully!!!</div>');
            redirect(base_url('staff/expenses'), 'refresh');
        }

        if ($task == "update")
		{
			$this->crud_model->update_expenses($expense_id);
			$this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Updated Successfully!!!</div>');
			redirect(base_url('staff/expenses'), 'refresh');
        }

        if ($task == "delete") {
            $this->crud_model->delete_expenses($expense_id);
			$this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Deleted Successfully!!!</div>');
            redirect(base_url('staff/expenses'), 'refresh');
        }

        $data['page_name'] = 'expenses';
        $data['page_title'] = 'Manage-Expenses';
		$data['total_rows'] = $this->db->count_all('expenses');
		$data['expense_data'] = $this->db->get('expenses')->result_array();
        $this->load->view('frontend/index', $data);
	}

	// Suppliers
	function suppliers($task = " ", $supplier_id = "") {
        if ($this->session->userdata('staff_login') != 1) {
            redirect(base_url(), 'refresh');
        }
		if ($this->session->userdata('manager') != 1) {
            redirect(base_url(), 'refresh');
        }

        if ($task == "create") {
            $clean = $this->security->xss_clean($this->input->post(NULL, TRUE));
			$this->crud_model->insert_suppliers($clean);
			$this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Created Successfully!!!</div>');
            redirect(base_url('staff/suppliers'), 'refresh');
        }

        if ($task == "update")
		{
			$this->crud_model->update_suppliers($supplier_id);
			$this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Updated Successfully!!!</div>');
			redirect(base_url('staff/suppliers'), 'refresh');
        }

        if ($task == "delete") {
            $this->crud_model->delete_suppliers($supplier_id);
			$this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Deleted Successfully!!!</div>');
            redirect(base_url('staff/suppliers'), 'refresh');
        }

        $data['page_name'] = 'suppliers';
        $data['page_title'] = 'Manage-Suppliers';
		$data['total_rows'] = $this->db->count_all('suppliers');
		$data['supplier_data'] = $this->db->get('suppliers')->result_array();
        $this->load->view('frontend/index', $data);
	}

	
	function daily_staff_sales_record(){
		if ($this->session->userdata('staff_login') != 1) {
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

	
    function checkout($task = " ", $id = " "){
		if ($this->session->userdata('staff_login') != 1){
		  redirect(base_url(), 'refresh');
		}
		if ($this->session->userdata('manager') != 1){
		  redirect(base_url(), 'refresh');
		}
		if ($task == "print_slip"){
			$clean = $this->security->xss_clean($this->input->post(NULL, TRUE));
			$this->crud_model->insertOrder($clean);
			$this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Transaction Completed Successfully!</div>');	
		}
		
		if ($task == "no_slip"){
			$clean = $this->security->xss_clean($this->input->post(NULL, TRUE));
			$this->crud_model->insertOrderWithoutSlip($clean);
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
				<input type="submit" id="checkButton" onclick="showPrintDialog(event)" class="btn btn-success btn-lg" value="Proceed to Pay" disabled />
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
        if ($this->session->userdata('staff_login') != 1)
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
		if ($this->session->userdata('staff_login') != 1){
			redirect(base_url(), 'refresh');
		}
		if ($this->session->userdata('manager') != 1) {
            redirect(base_url(), 'refresh');
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

	}
    
}

ob_end_flush();
