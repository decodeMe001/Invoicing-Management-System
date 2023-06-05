<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
ob_start();

require_once __DIR__ . '\..\..\autoload.php';

// cart-class
use utility\CartItems;
class Crud_model extends CI_Model {

    public $roles;

    function __construct(){
        parent::__construct();
        $this->load->database();
		$this->load->library(array("ReceiptPrint", "cart"));
        $this->load->helper(array('form', 'url'));
        $this->roles = $this->config->item('roles');
    }

	public function validate_username()
	{
		$username = $this->input->post('user_name');
		$sql = "SELECT * FROM admin WHERE user_name =?";
		$query = $this->db->query($sql, array($username));
		return ($query->num_rows() == 1) ? true : false;
	}
	
	public function insert_category(){
		$get_data = array('name' => $_POST['name']);
		$db = $this->db->insert_string('store_category', $get_data);
        $this->db->query($db);
	}
	
	public function update_category($cat_id){
		$get_data = array('name' => $_POST['name']);
		$this->db->where('id', $cat_id);
		$this->db->update('store_category', $get_data);
	}
	
	public function delete_category($cat_id){
		$this->db->where('id', $cat_id);
        $this->db->delete('store_category');
	}
	
	function insert_product($data)
	{
		$get_data = array(
			'title'  =>  $_POST['title'],
			'brand_name'  =>  $_POST['brand_name'],
			'pharmacological_class'  =>  $_POST['pharmacological_class'],
			'qty_in_stock'  =>  $_POST['qty_in_stock'],
			'market_price'  =>  $_POST['market_price'],
			'selling_price'  =>  $_POST['selling_price'],
			'expiry_date'  =>  $_POST['expiry_date'],
			'edited_by'  =>  $this->session->userdata("cashier"),
			'dosage_form_id'  =>  $_POST['dosage_form_id']
        );
        $db = $this->db->insert_string('store_product', $get_data);
        $this->db->query($db);
	}

	function update_product($id)
	{
		$data['title'] 		= $this->input->post('title');
        $data['brand_name'] = $this->input->post('brand_name');
        $data['pharmacological_class'] 	= $this->input->post('pharmacological_class');
        $data['qty_in_stock']   = $this->input->post('qty_in_stock');
        $data['market_price'] 	= $this->input->post('market_price');
        $data['selling_price'] 	= $this->input->post('selling_price');
        $data['expiry_date'] 	= $this->input->post('expiry_date');
        $data['dosage_form_id'] = $this->input->post('dosage_form_id');
        $this->db->where('id', $id);
		$this->db->update('store_product', $data);
	}

	function delete_product($id)
	{
        $this->db->where('id', $id);
        $this->db->delete('store_product');
    }

	/** Manage Customers**/
	function insert_customer($data)
	{
		$get_data = array(
			'companyName'  =>  $_POST['company'],
			'address'  =>  $_POST['address'],
			'city'  =>  $_POST['city'],
			'phone'  =>  $_POST['phone']
        );
        $db = $this->db->insert_string('customers', $get_data);
        $this->db->query($db);
	}

	function update_customer($id)
	{
		$data['companyName'] = $this->input->post('company');
        $data['address'] = $this->input->post('address');
        $data['city'] 	= $this->input->post('city');
        $data['phone']   = $this->input->post('phone');
        $this->db->where('customerID', $id);
		$this->db->update('customers', $data);
	}

	function delete_customer($id)
	{
        $this->db->where('customerID', $id);
        $this->db->delete('customers');
    }

	/** Manage Expenses **/
	function insert_expenses($data)
	{
		$get_data = array(
			'staff'  =>  $_POST['staff'],
			'category'  =>  $_POST['category'],
			'details'  =>  $_POST['details'],
			'amount'  =>  $_POST['amount'],
			'expense_date'  =>  $_POST['expense_date']
        );
        $db = $this->db->insert_string('expenses', $get_data);
        $this->db->query($db);
	}

	function update_expenses($id)
	{
		$data['staff'] = $this->input->post('staff');
        $data['category'] = $this->input->post('category');
        $data['details'] 	= $this->input->post('details');
        $data['amount']   = $this->input->post('amount');
        $data['expense_date']   = $this->input->post('expense_date');
        $this->db->where('id', $id);
		$this->db->update('expenses', $data);
	}

	function delete_expenses($id)
	{
        $this->db->where('id', $id);
        $this->db->delete('expenses');
    }

	/** Manage Expenses **/
	function insert_suppliers($data)
	{
		$get_data = array(
			'companyName'  =>  $_POST['companyName'],
			'purchase_amount'  =>  $_POST['purchase_amount'],
			'balance'  =>  $_POST['balance'],
			'discount'  =>  $_POST['discount'],
		);
        $db = $this->db->insert_string('suppliers', $get_data);
        $this->db->query($db);
	}

	function update_suppliers($id)
	{
		$data['companyName'] = $this->input->post('companyName');
        $data['purchase_amount']   = $this->input->post('purchase_amount');
        $data['balance'] 	= $this->input->post('balance');
        $data['discount'] 	= $this->input->post('discount');
        $this->db->where('supplierID', $id);
		$this->db->update('suppliers', $data);
	}

	function delete_suppliers($id)
	{
        $this->db->where('supplierID', $id);
        $this->db->delete('suppliers');
    }

	/** Manage orders **/
    public function insertOrder($data)
    {
		try {
		$data1 = array(
			'order_no'      =>  trim($data["order_no"]),
			'order_date'    =>  trim($data["order_date"]),
			'order_total'	   =>  $this->cart->total(),
			'cashier' => $this->session->userdata("cashier"),
			'method_by_pos' => trim($data["method_by_pos"]),
			'method_by_transfer' => trim($data["method_by_transfer"]),
			'method_by_cash' => trim($data["method_by_cash"]),
		);
		$q = $this->db->insert_string('invoice_order', $data1);
		$this->db->query($q);
		$order_id = $this->db->insert_id();
			
		$total_profit_margin = 0;
		$cart_items = $this->cart->contents();
		/* Information for the receipt */
		$subtotal = new CartItems('Total:', number_format($this->cart->total(), 2, '.', ','));
		$total = new CartItems('Cash Paid:', number_format($this->cart->total(), 2, '.', ','));
		$cashier = new CartItems('Cashier:', $this->session->userdata("cashier"));
		
		$header = new CartItems('DESCRIPTION[QTY]        PRICE(#)', false);
		$tax = new CartItems('Tax:', '0.00');
		$this->receiptprint->connect();
		$this->receiptprint->print_test_receipt($header, $cart_items, $subtotal, $total, $tax, $cashier);

		foreach($this->cart->contents() as $items)
		{
			$data2 = array(
				'order_id'               =>  $order_id,
				'item_name'              =>  trim($items["name"]),
				'order_item_quantity'    =>  trim($items["qty"]),
				'order_item_price'       =>  trim($items["price"]),
				'order_item_actual_amount'  =>  trim($items["subtotal"])
			);
			$total_profit_margin += trim($items["options"]["profit_margin"]);
			$get_product_qty = $this->db->get_where('store_product', array('title' => trim($items["name"]), 'selling_price' => trim($items["price"]), 'qty_in_stock' => (int)$items["options"]['qty_in_stock']))->result_array();
			foreach($get_product_qty as $item){
				$qty_left = (int)$item['qty_in_stock'] - (int)$items["qty"];
				$this->db->where(array('title' => trim($items["name"]), 'brand_name' => trim($item["brand_name"]), 'qty_in_stock' => (int)$item['qty_in_stock']));
				$this->db->update('store_product', array('qty_in_stock' => $qty_left));
			}
			$q2 = $this->db->insert_string('invoice_order_item', $data2);
			$this->db->query($q2);
		}
		$this->db->where(array('order_id' => $order_id));
		$this->db->update('invoice_order', array('profit_margin' => $total_profit_margin));

		} catch (Exception $e) {
			log_message("error", "Error: Could not print. Message ".$e->getMessage());
			$this->receiptprint->close_after_exception();
		}
  }


    function update_order($invoice_id="")
    {
		$order_total = 0;
		$this->db->where('order_id', $invoice_id);
        $this->db->delete('invoice_order_item');

		for($count=0; $count < $_POST["total_item"]; $count++)
		{
			$order_total = $order_total + floatval(trim($_POST["order_item_final_amount"][$count]));
			$data1 = array(
				'order_id'                   =>  $invoice_id,
				'item_name'              	 =>  trim($_POST["item_name"][$count]),
				'order_item_price'           =>  trim($_POST["order_item_price"][$count]),
				'order_item_actual_amount'   =>  trim($_POST["order_item_final_amount"][$count])
			);
			$q2 = $this->db->insert_string('invoice_order_item', $data1);
			$this->db->query($q2);
		}

		$data2 = array(
			'order_no'      =>  trim($_POST["order_no"]),
			'order_date'    =>  trim($_POST["order_date"]),
			'method_by_cash'    =>  trim($_POST["method_by_cash"]),
			'method_by_pos'    =>  trim($_POST["method_by_pos"]),
			'method_by_transfer'    =>  trim($_POST["method_by_transfer"]),
			'order_total'   =>  $order_total,
			'order_id'      =>  $invoice_id
		);

      $this->db->where('order_id', $invoice_id);
      $this->db->update('invoice_order', $data2);

    }

    function delete_order($order_id)
    {
        $this->db->where('order_id', $order_id);
        $this->db->delete('invoice_order');
		$this->db->where('order_id', $order_id);
        $this->db->delete('invoice_order_item');
    }
	

	function get_total_monthly_sales_amount(){
		$total = 0;
		$get_date = date('m');
		$sales_amt = $this->db->get_where('invoice_order', array('MONTH(order_date)' => $get_date))->result_array();
		foreach($sales_amt as $sales){
			$total += $sales['order_total'];
		}
		return $total;
	}
	
	function get_all_product_profit(){
		$total_profit = 0;
		$total_cp_product = 0;
		$total_sp_product = 0;
		$get_cp_product = $this->db->get_where('store_product')->result_array();
		foreach($get_cp_product as $product){
			$total_cp_product += $product["market_price"] * $product["qty_in_stock"];
			$total_sp_product += $product["selling_price"] * $product["qty_in_stock"];	
		}
		$total_profit = $total_sp_product - $total_cp_product;
		return $total_profit;
	}
	
	function get_total_cp(){
		$total_cp_product = 0;
		$get_cp_product = $this->db->get_where('store_product')->result_array();
		foreach($get_cp_product as $product){
			$total_cp_product += $product["market_price"] * $product["qty_in_stock"];	
		}
		return $total_cp_product;
	}
	
	function get_total_sp(){
		$total_sp_product = 0;
		$get_cp_product = $this->db->get_where('store_product')->result_array();
		foreach($get_cp_product as $product){
			$total_sp_product += $product["selling_price"] * $product["qty_in_stock"];	
		}
		return $total_sp_product;
	}
	
	

	function insert_staff($data)
	{
		$get_data = array(
<<<<<<< HEAD
			'name'  =>  $_POST['staff_name'],
			'user_name'  =>  $_POST['staff_username'],
			'email'  =>  $_POST['staff_email'],
			'role'  =>  $_POST['staff_role'],
			'password'  =>  sha1($this->input->post('password'))
=======
          'name'  =>  $_POST['staff_name'],
          'user_name'  =>  $_POST['staff_username'],
          'email'  =>  $_POST['staff_email'],
		  'role'  =>  $_POST['staff_role'],
		  'password'  =>  sha1($this->input->post('password'))
>>>>>>> 060766fe05b38dadf2897b881fab97884399e5e3
        );
        $db = $this->db->insert_string('admin',$get_data);
        $this->db->query($db);
	}

	function update_staff($id)
	{
<<<<<<< HEAD
		$data['name'] = $this->input->post('staff_name');
=======
		$data['name'] 		= $this->input->post('staff_name');
>>>>>>> 060766fe05b38dadf2897b881fab97884399e5e3
        $data['user_name'] 		= $this->input->post('staff_username');
        $data['email'] 	= $this->input->post('staff_email');
        $data['role']          = $this->input->post('staff_role');
        $data['password'] 	= sha1($this->input->post('password'));
        $this->db->where('admin_id', $id);
		$this->db->update('admin', $data);
	}

	function delete_staff($id)
	{
        $this->db->where('admin_id', $id);
        $this->db->delete('admin');
    }

	////////IMAGE URL//////////
    function get_image_url($type = '', $id = '') {
        if (file_exists('uploads/' . $type . '_image/' . $id . '.jpg'))
            $image_url = base_url() . 'uploads/' . $type . '_image/' . $id . '.jpg';
        else
            $image_url = base_url() . 'uploads/user.jpg';

        return $image_url;
    }
	
	function get_cart_items($id)
	{
        return $this->db->get_where('invoice_order_item', array('order_id' => $id))->result_array();
	}
	
	function get_order($id){
		return $this->db->get_where('invoice_order', array('order_id' => $id))->result_array();
	}

	//////system settings//////
    function update_system_settings() {
        $data['description'] = $this->input->post('system_name');
        $this->db->where('type', 'system_name');
        $this->db->update('settings', $data);

        $data['description'] = $this->input->post('system_title');
        $this->db->where('type', 'system_title');
        $this->db->update('settings', $data);

        $data['description'] = $this->input->post('address');
        $this->db->where('type', 'address');
        $this->db->update('settings', $data);

        $data['description'] = $this->input->post('phone');
        $this->db->where('type', 'phone');
        $this->db->update('settings', $data);

        $data['description'] = $this->input->post('system_email');
        $this->db->where('type', 'system_email');
        $this->db->update('settings', $data);

        $data['description'] = $this->input->post('language');
        $this->db->where('type', 'language');
        $this->db->update('settings', $data);

        $data['description'] = $this->input->post('company');
        $this->db->where('type', 'company');
        $this->db->update('settings', $data);


		//$logo_id  =   $this->db->insert_id();
		//move_uploaded_file($_FILES["logo"]["tmp_name"], "uploads/company/" . $logo_id . '.jpg');
    }

}
//session_write_close();
ob_end_flush();
