<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Staff extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
		$this->load->library("cart");
    }
	
	/***default function, redirects to login page if no admin logged in yet** */
    function index() {
        if ($this->session->userdata('staff_login') != 1)
            redirect(base_url() . 'account', 'refresh');
        if ($this->session->userdata('staff_login') == 1)
            redirect(base_url() . 'staff/dashboard', 'refresh');

    }

    function dashboard() {
        if ($this->session->userdata('staff_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
		
		/*** STAFF DASHBOARD** */
        $data['page_name'] = 'dashboard';
        $data['page_title'] = 'Staff-Dashboard';
		$data['sales_record'] = $this->crud_model->get_total_daily_sales_amount();
        $this->load->view('frontend/index', $data);
    }
	
	//Category Function
	function category($task = " ", $cat_id = "") {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
		if ($this->session->userdata('staff_login') != 1) {
            redirect(base_url(), 'refresh');
        }

        if ($task == "create") {
            $clean = $this->security->xss_clean($this->input->post(NULL, TRUE));
			$this->crud_model->insert_category($clean);
			$this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Data Created Successfully!!!</div>');
            redirect(base_url('admin/category'), 'refresh');
        }

        if ($task == "update")
		{
			$this->crud_model->update_category($cat_id);
			$this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Data Updated Successfully!!!</div>');
			redirect(base_url('admin/category'), 'refresh');
        }

        if ($task == "delete") {
            $this->crud_model->delete_category($cat_id);
			$this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Data Deleted Successfully!!!</div>');
            redirect(base_url('admin/category'), 'refresh');
        }

        $data['page_name'] = 'manage_category';
        $data['page_title'] = 'Manage-Category';
		$data['total_rows'] = $this->db->count_all('store_category');
		$data['category_data'] = $this->db->get('store_category')->result_array();
        $this->load->view('frontend/index', $data);
	}

	function product($task = " ", $product_id = "") {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
		if ($this->session->userdata('staff_login') != 1) {
            redirect(base_url(), 'refresh');
        }

        if ($task == "create") {
            $clean = $this->security->xss_clean($this->input->post(NULL, TRUE));
			$this->crud_model->insert_product($clean);
			$this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Data Created Successfully!!!</div>');
            redirect(base_url('admin/product'), 'refresh');
        }

        if ($task == "update")
		{
			$this->crud_model->update_product($product_id);
			$this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Data Updated Successfully!!!</div>');
			redirect(base_url('admin/product'), 'refresh');
        }

        if ($task == "delete") {
            $this->crud_model->delete_product($product_id);
			$this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Data Deleted Successfully!!!</div>');
            redirect(base_url('admin/product'), 'refresh');
        }

        $data['page_name'] = 'manage_product';
        $data['page_title'] = 'Manage-Product';
		$data['total_rows'] = $this->db->count_all('store_product');
		$data['product_data'] = $this->db->get('store_product')->result_array();
        $this->load->view('frontend/index', $data);
	}

	

	function weekly_sales_record(){
		
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
		if ($this->session->userdata('staff_login') != 1) {
            redirect(base_url(), 'refresh');
        }
		
		$day7 = date('Y-m-d', strtotime('-7 days'));
		$day6 = date('Y-m-d', strtotime('-6 days'));
		$day5 = date('Y-m-d', strtotime('-5 days'));
		$day4 = date('Y-m-d', strtotime('-4 days'));
		$day3 = date('Y-m-d', strtotime('-3 days'));
		$day2 = date('Y-m-d', strtotime('-2 days'));
		$day1 = date('Y-m-d', strtotime('-1 days'));
		
		
		$total_cp_1 = 0;
		$total_cp_2 = 0;
		$total_cp_3 = 0;
		$total_cp_4 = 0;
		$total_cp_5 = 0;
		$total_cp_6 = 0;
		$total_cp_7 = 0;
		
		$total_sp_1 = 0;
		$total_sp_2 = 0;
		$total_sp_3 = 0;
		$total_sp_4 = 0;
		$total_sp_5 = 0;
		$total_sp_6 = 0;
		$total_sp_7 = 0;
		
		$total_day_1_profit = 0;
		$total_day_2_profit = 0;
		$total_day_3_profit = 0;
		$total_day_4_profit = 0;
		$total_day_5_profit = 0;
		$total_day_6_profit = 0;
		$total_day_7_profit = 0;
		
		
		$total_day1 = 0;
		$total_day2 = 0;
		$total_day3 = 0;
		$total_day4 = 0;
		$total_day5 = 0;
		$total_day6 = 0;
		$total_day7 = 0;

		$sales_amt1 = $this->db->get_where('invoice_order', array('order_date' => $day1))->result_array();
		$sales_amt2 = $this->db->get_where('invoice_order', array('order_date' => $day2))->result_array();
		$sales_amt3 = $this->db->get_where('invoice_order', array('order_date' => $day3))->result_array();
		$sales_amt4 = $this->db->get_where('invoice_order', array('order_date' => $day4))->result_array();
		$sales_amt5 = $this->db->get_where('invoice_order', array('order_date' => $day5))->result_array();
		$sales_amt6 = $this->db->get_where('invoice_order', array('order_date' => $day6))->result_array();
		$sales_amt7 = $this->db->get_where('invoice_order', array('order_date' => $day7))->result_array();
		
		$sales_amt_order_1 = $this->db->get_where('invoice_order_item', array('created_at' => $day1))->result_array();
		$sales_amt_order_2 = $this->db->get_where('invoice_order_item', array('created_at' => $day2))->result_array();
		$sales_amt_order_3 = $this->db->get_where('invoice_order_item', array('created_at' => $day3))->result_array();
		$sales_amt_order_4 = $this->db->get_where('invoice_order_item', array('created_at' => $day4))->result_array();
		$sales_amt_order_5 = $this->db->get_where('invoice_order_item', array('created_at' => $day5))->result_array();
		$sales_amt_order_6 = $this->db->get_where('invoice_order_item', array('created_at' => $day6))->result_array();
		$sales_amt_order_7 = $this->db->get_where('invoice_order_item', array('created_at' => $day7))->result_array();
		

		foreach($sales_amt1 as $sales){
			$total_day1 += $sales['order_total'];
		}
		
		foreach($sales_amt_order_1 as $sales){
			$get_product = $this->db->get_where('store_product', array('title' => $sales['item_name']))->result_array();
			foreach($get_product as $sales_item){
				$total_cp_1 += $sales_item['market_price'] * $sales['order_item_quantity'];
				$total_sp_1 += $sales_item['selling_price'] * $sales['order_item_quantity'];
			}
		}
			$total_day_1_profit = $total_sp_1 - $total_cp_1;
		
		foreach($sales_amt_order_2 as $sales){
			$get_product = $this->db->get_where('store_product', array('title' => $sales['item_name']))->result_array();
			foreach($get_product as $sales_item){
				$total_cp_2 += $sales_item['market_price'] * $sales['order_item_quantity'];
				$total_sp_2 += $sales_item['selling_price'] * $sales['order_item_quantity'];
			}
		}
			$total_day_2_profit = $total_sp_2 - $total_cp_2;					
		
		foreach($sales_amt_order_3 as $sales){
			$get_product = $this->db->get_where('store_product', array('title' => $sales['item_name']))->result_array();
			foreach($get_product as $sales_item){
				$total_cp_3 += $sales_item['market_price'] * $sales['order_item_quantity'];
				$total_sp_3 += $sales_item['selling_price'] * $sales['order_item_quantity'];
			}
		}
			$total_day_3_profit = $total_sp_3 - $total_cp_3;					
		
		foreach($sales_amt_order_4 as $sales){
			$get_product = $this->db->get_where('store_product', array('title' => $sales['item_name']))->result_array();
			foreach($get_product as $sales_item){
				$total_cp_4 += $sales_item['market_price'] * $sales['order_item_quantity'];
				$total_sp_4 += $sales_item['selling_price'] * $sales['order_item_quantity'];
			}
		}
			$total_day_4_profit = $total_sp_4 - $total_cp_4;					
		
		foreach($sales_amt_order_5 as $sales){
			$get_product = $this->db->get_where('store_product', array('title' => $sales['item_name']))->result_array();
			foreach($get_product as $sales_item){
				$total_cp_5 += $sales_item['market_price'] * $sales['order_item_quantity'];
				$total_sp_5 += $sales_item['selling_price'] * $sales['order_item_quantity'];
			}
		}
				$total_day_5_profit = $total_sp_5 - $total_cp_5;					
		
		foreach($sales_amt_order_6 as $sales){
			$get_product = $this->db->get_where('store_product', array('title' => $sales['item_name']))->result_array();
			foreach($get_product as $sales_item){
				$total_cp_6 += $sales_item['market_price'] * $sales['order_item_quantity'];
				$total_sp_6 += $sales_item['selling_price'] * $sales['order_item_quantity'];
			}
		}
				$total_day_6_profit = $total_sp_6 - $total_cp_6;					
		
		foreach($sales_amt_order_7 as $sales){
			$get_product = $this->db->get_where('store_product', array('title' => $sales['item_name']))->result_array();
			foreach($get_product as $sales_item){
				$total_cp_7 += $sales_item['market_price'] * $sales['order_item_quantity'];
				$total_sp_7 += $sales_item['selling_price'] * $sales['order_item_quantity'];
			}
		}
				$total_day_7_profit = $total_sp_7 - $total_cp_7;					
		
		foreach($sales_amt2 as $sales){
			$total_day2 += $sales['order_total'];
		}
		foreach($sales_amt3 as $sales){
			$total_day3 += $sales['order_total'];
		}
		foreach($sales_amt4 as $sales){
			$total_day4 += $sales['order_total'];
		}
		foreach($sales_amt5 as $sales){
			$total_day5 += $sales['order_total'];
		}
		foreach($sales_amt6 as $sales){
			$total_day6 += $sales['order_total'];

		}
		foreach($sales_amt7 as $sales){
			$total_day7 += $sales['order_total'];
		}

		$data['page_name'] = 'daily_sales';
		$data['page_title'] = 'Weekly-Sales';
		$data['total_day1'] = $total_day1;
		$data['total_day2'] = $total_day2;
		$data['total_day3'] = $total_day3;
		$data['total_day4'] = $total_day4;
		$data['total_day5'] = $total_day5;
		$data['total_day6'] = $total_day6;
		$data['total_day7'] = $total_day7;
		
		$data['day_1_profit'] = $total_day_1_profit;
		$data['day_2_profit'] = $total_day_2_profit;
		$data['day_3_profit'] = $total_day_3_profit;
		$data['day_4_profit'] = $total_day_4_profit;
		$data['day_5_profit'] = $total_day_5_profit;
		$data['day_6_profit'] = $total_day_6_profit;
		$data['day_7_profit'] = $total_day_7_profit;
		$data['daily_profit'] = $this->crud_model->get_daily_profit_amount();
		$data['sales_record'] = $this->crud_model->get_total_daily_sales_amount();
		$this->load->view('frontend/index', $data);
}


    function checkout($task = " ", $id = " "){
		if ($this->session->userdata('admin_login') != 1){
		  redirect(base_url(), 'refresh');
		}
		if ($this->session->userdata('staff_login') != 1){
		  redirect(base_url(), 'refresh');
		}
		if ($task == "create"){
			$order_date = $_POST['order_date'];
            if ($order_date) {
				$clean = $this->security->xss_clean($this->input->post(NULL, TRUE));
                $this->crud_model->insertOrder($clean);
				$this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Order Created Successfully!!!</div>');
            } else {
                return false;
            }
			
			redirect(base_url('admin/checkout'), 'refresh');
		}
		
		$data['page_title'] = 'Products Details';
		$data['page_name'] = 'checkout';
		$data['total_rows'] = $this->db->count_all('store_product');
		$data['product_data'] = $this->db->get('store_product')->result_array();
		$this->cart->destroy();
		$this->load->view( 'frontend/index',$data);
    }
	
	function load_cart()
	{
		echo $this->view_cart();
	}
	
	 function add_to_cart()
	{
		$data = array(
			"id"  => $_POST["id"],
			"name"  => $_POST["title"],
			"qty"  => $_POST["qty"],
			"price"  => $_POST["price"],
			"options" => array("brand_name" => $_POST["brand_name"], "qty_in_stock" => $_POST["qty_in_stock"])
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
	
	function view_cart()
	{
		$output = '';
		$output .= '
		
		<div class="table-responsive">
			<div align="right"><br/>
				<button type="button" id="clear_cart" class="btn btn-warning">Clear Cart</button>
			</div>
			<table class="table table-bordered table-striped display" style="width:100%;">
				<tr>
					<th width="6%">Sr No.</th>
					<th width="30%">Item Name</th>
					<th width="8%">Qty</th>
					<th width="15%">Amount[&#8358;]</th>
					<th width="15%">Total[&#8358;]</th>
					<th width="15%">Action</th>
				</tr>
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
					<td>N'.number_format($items["price"], 2, '.', ',').'</td>
					<td>N'.number_format($items["subtotal"], 2, '.', ',').'</td>
					<td><button type="button" name="remove" class="btn btn-danger btn-xs remove_inventory" id="'.$items["rowid"].'"><i class="fa fa-times" style="color: #fff;"></i></button></td>
				</tr>
				';
				}
				$output .='
				<tr>
				<td colspan="4" align="right"><b>Total</b></td>
				<td id="cart_total">'.number_format($this->cart->total(), 2, '.', ',').'</td>
				</tr><br/><br/><hr/>
			</table>
			<center>
				  <input type="submit" name="proceed" id="proceed" class="btn btn-success btn-lg" value="Proceed to Pay" />
				</center>
			<br/><br/><hr/>
		</div>
		<div id="printerID">
			<div class="printerHeader">
				<p class="printerLabel">LIZZYLOVE PHARMACY</p>
				<p class="printerAddress">135, Alhaji Hassan B/Stop, beside AP Filling Station, Camp. Davies Rd., Isefun, Ayobo, Lagos.</p>
				<p class="printerPhone">TEL: +2348143702571</p>
			</div>
			<p class="printerDate">RECEIPT:000'.$count.'</p>
			<table class="printerTable">
				<thead>
					<tr>
						<th class="quantity">Qty.</th>
						<th class="description">Description</th>
						<th class="price">[&#8358;]</th>
					</tr>
				</thead>
				<tbody>.';
					foreach($this->cart->contents() as $items)
					{
					$output .='
					<tr>
						<td class="quantity">
							'.$items["qty"].' x
						</td>
						<td class="description">
							'.$items["name"].'
						</td>
						<td class="price">&#8358;'.number_format($items["subtotal"], 0, '.', ',').'</td>
					</tr>
					';
				}
				$output .='
					<tr>
						<td class="bdBotom" height="1" colSpan="3"></td>
					</tr>
				</tbody>
			</table><hr/>
			
			<table width="90% " border="0 " cellPadding="0 " cellSpacing="0 " align="center " class="fullPadding " style={{marginBottom: "8px !important"}}>
				<tbody>
					<tr>
						<td>
							<p class="summary_list">TOTAL: &#8358;'.number_format($this->cart->total(), 0, '.', ',').'
								<br/>DISCOUNT: &#8358;0.00
								<br/>PAYMENT METHOD: <span></span>
								<br/>CASH PAID: &#8358;'.number_format($this->cart->total(), 0, '.', ',').'
							</p>
						</td>
					</tr>
				</tbody>
			</table><br/>
			<p class="remark">Thanks for your purchase!
				<br/>ITEM(S) PURCHASED IN GOOD CONDITION ARE NOT REFUNDABLE.
				<br/> Date: '.date('d-m-Y').'
			</p><br/><hr/><br/>
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

        $data['page_title'] = 'Manage Sales Items';
		$data['page_name'] = 'cart_items';
		$this->load->view( 'frontend/index',$data);
    }
	
	public function sales_order($task="", $id=""){
		if ($this->session->userdata('admin_login') != 1){
			redirect(base_url(), 'refresh');
		}
		if ($this->session->userdata('staff_login') != 1){
			redirect(base_url(), 'refresh');
		}
		
		if ($task == "update"){
			$this->crud_model->update_order($id);
			$this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Data Updated Successfully!!!</div>');
			redirect(base_url('admin/sales_order'), 'refresh');
        }

        if ($task == "delete"){
            $this->crud_model->delete_order($id);
			$this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Data Deleted Successfully!!!</div>');
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

	}
}
ob_end_flush();