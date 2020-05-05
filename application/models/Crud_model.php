<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Crud_model extends CI_Model {

    public $roles;

    function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->helper(array('form', 'url'));
        $this->roles = $this->config->item('roles');
    }

	public function validate_username()
	{
			$username = $this->input->post('user_name');
			$sql = "SELECT * FROM admin WHERE user_name = ?";
			$query = $this->db->query($sql, array($username));
		return ($query->num_rows() == 1) ? true : false;
	}

	/** Manage users Data **/
    public function insertInvoice($data)
    {

    $order_total = 0;
		$balance = 0;
		$time = time();

    $data1 = array(
          'order_no'               	=>  trim($data["order_no"]),
          'order_date'             	=>  trim($data["order_date"]),
          'order_receiver_name'    	=>  trim($data["order_receiver_name"]),
          'order_receiver_addr'    	=>  trim($data["order_receiver_address"]),
          'order_total'			 	=>  $order_total,
				  'balance'					=>	$balance,
				  'paid'    				=>  trim($data["order_amt_received"]),
          'order_receiver_phone'	=>  trim($data["phone"]),
          'order_datetime'         	=>  date("d-m-Y H:i:s", $time)
      );
	   $q = $this->db->insert_string('invoice_order', $data1);
	   $this->db->query($q);
       $order_id = $this->db->insert_id();


      for($count=0; $count < $_POST["total_item"]; $count++)
      {
        $order_total = $order_total + floatval(trim($data["order_item_actual_amount"][$count]));
		$balance = $order_total - floatval(trim($data["order_amt_received"]));

        $data2 = array(
            'order_id'               =>  $order_id,
            'item_name'              =>  trim($data["item_name"][$count]),
						'order_photo_type'              =>  trim($data["photo_type"][$count]),
						'order_photo_size'              =>  trim($data["photo_size"][$count]),
            'order_item_quantity'          =>  trim($data["order_item_quantity"][$count]),
            'order_item_price'           =>  trim($data["order_item_price"][$count]),
            'order_item_actual_amount'       =>  trim($data["order_item_actual_amount"][$count])

          );
		  $q2 = $this->db->insert_string('invoice_order_item', $data2);
	   	  $this->db->query($q2);
	  }

     $data3 = array(
          'order_total'  => $order_total,
		  		'balance'		 => $balance,
          'order_id'     => $order_id
        );
				$this->db->where('order_id', $order_id);
        $this->db->update('invoice_order', $data3);
  }


    function update_invoice($invoice_id)
    {
      	$order_total = 0;

		$this->db->where('order_id', $invoice_id);
        $this->db->delete('invoice_order_item');

      for($count=0; $count < $_POST["total_item"]; $count++)
      {
        $order_total = $order_total + floatval(trim($_POST["order_item_actual_amount"][$count]));
		 $balance = $order_total - floatval(trim($_POST["order_amt_received"]));

        $data1 = array(
            'order_id'                   =>  $invoice_id,
            'item_name'              	 =>  trim($_POST["item_name"][$count]),
			'order_photo_type'           =>  trim($_POST["photo_type"][$count]),
			'order_photo_size'           =>  trim($_POST["photo_size"][$count]),
            'order_item_quantity'        =>  trim($_POST["order_item_quantity"][$count]),
            'order_item_price'           =>  trim($_POST["order_item_price"][$count]),
            'order_item_actual_amount'   =>  trim($_POST["order_item_actual_amount"][$count])
        );
		  $q2 = $this->db->insert_string('invoice_order_item', $data1);
	   	  $this->db->query($q2);
	  }

      $data2 =
        array(
          'order_no'               	=>  trim($_POST["order_no"]),
          'order_date'             	=>  trim($_POST["order_date"]),
          'order_receiver_name'    	=>  trim($_POST["order_receiver_name"]),
          'order_receiver_addr'    	=>  trim($_POST["order_receiver_address"]),
          'order_total'			 	=>  $order_total,
				  'balance'					=>	$balance,
				  'paid'    				=>  trim($_POST["order_amt_received"]),
          'order_receiver_phone'	=>  trim($_POST["phone"]),
          'order_id'               	=>  $invoice_id
        );

      $this->db->where('order_id', $invoice_id);
      $this->db->update('invoice_order', $data2);

    }

    function delete_invoice($order_id)
    {
        $this->db->where('order_id', $order_id);
        $this->db->delete('invoice_order');
				$this->db->where('order_id', $order_id);
        $this->db->delete('invoice_order_item');
    }

	function insert_pricing($data)
	{
		$get_data = array(
          'photo_type'  => $this->input->post('photo_type'),
          'photo_size'  => $this->input->post('photo_size'),
          'unit_price'  => $this->input->post('unit_price')
        );
        $this->db->insert('pricing_rate_item',$get_data);
	}

	function update_pricing($rate_id)
	{
		$data = array(
          'photo_type'  => $this->input->post('photo_type'),
          'photo_size'  => $this->input->post('photo_size'),
          'unit_price'  => $this->input->post('unit_price')
        );

      $this->db->where('rate_id', $rate_id);
      $this->db->update('pricing_rate_item', $data);

	}

	function delete_pricing($rate_id)
	{
        $this->db->where('rate_id', $rate_id);
        $this->db->delete('pricing_rate_item');
    }

	function insert_staff($data)
	{
		$get_data = array(
          'name'  =>  $_POST['staff_name'],
          'user_name'  =>  $_POST['staff_username'],
          'email'  =>  $_POST['staff_email'],
				  'role'  =>  $_POST['staff_role'],
				  'password'  =>  sha1($this->input->post('password'))
        );
        $db = $this->db->insert_string('admin',$get_data);
        $this->db->query($db);
	}

	function update_staff($id)
	{
				$data['name'] 		= $this->input->post('staff_name');
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

	function select_customer_info()
    {
        return $this->db->get('customers')->result_array();
    }

	function insert_customer($data)
	{
		$get_data = array(
          'customer_name'  =>  trim($_POST['customer_name']),
          'address'  =>  trim($_POST['customer_address']),
          'phone'  =>  trim($_POST['customer_phone']),
		  'status'  =>  trim($_POST['status']),
        );
        $db = $this->db->insert_string('customers',$get_data);
        $this->db->query($db);
	}
	function insert_record($data)
	{
				$get_debt = array(
          'customer_name'  =>  trim($_POST['order_receiver_name']),
          'amount_paid'  =>  trim($_POST['amount_paid']),
          'balance'  =>  trim($_POST['balance']),
				  'date_received'  =>  trim($_POST['date']),
        );
        $db = $this->db->insert_string('record_debt',$get_debt);
        $this->db->query($db);
	}

	function update_customer($id)
	{
		$data['customer_name'] 	= $this->input->post('customer_name');
        $data['address'] 		= $this->input->post('customer_address');
        $data['phone'] 			= $this->input->post('customer_phone');
        $data['status']         = $this->input->post('status');

        $this->db->where('id', $id);
				$this->db->update('customers', $data);

	}

	function delete_customer($id)
	{
      $this->db->where('id', $id);
      $this->db->delete('customers');
  }
	function update_debt($id)
	{
				$data['customer_name'] 	= $this->input->post('customer_name');
        $data['amount_paid'] 		= $this->input->post('paid');
        $data['balance'] 			= $this->input->post('balance');

        $this->db->where('id', $id);
				$this->db->update('record_debt', $data);

	}

	function delete_debt($id)
	{
      $this->db->where('id', $id);
      $this->db->delete('record_debt');
  }

	////////IMAGE URL//////////
    function get_image_url($type = '', $id = '') {
        if (file_exists('uploads/' . $type . '_image/' . $id . '.jpg'))
            $image_url = base_url() . 'uploads/' . $type . '_image/' . $id . '.jpg';
        else
            $image_url = base_url() . 'uploads/user.jpg';

        return $image_url;
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
