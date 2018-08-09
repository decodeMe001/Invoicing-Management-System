<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Crud_model extends CI_Model {
    public $roles;    
    function __construct(){
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
        $this->load->helper(array('form', 'url'));
        $this->roles = $this->config->item('roles');
    }
	
	/** Manage users Data **/
    public function insertInvoice($data)
    {
		
    $order_total_before_tax = 0;
    $order_total_tax1 = 0;
    $order_total_tax2 = 0;
    $order_total_tax3 = 0;
    $order_total_tax = 0;
    $order_total_after_tax = 0;
	
    $data1 = array(
          'order_no'               =>  trim($data["order_no"]),
          'order_date'             =>  trim($data["order_date"]),
          'order_receiver_name'    =>  trim($data["order_receiver_name"]),
          'order_receiver_addr'    =>  trim($data["order_receiver_address"]),
          'order_total_before_tax' =>  $order_total_before_tax,
          'order_total_tax1'       =>  $order_total_tax1,
          'order_total_tax2'       =>  $order_total_tax2,
          'order_total_tax3'       =>  $order_total_tax3,
          'order_total_tax'        =>  $order_total_tax,
          'order_total_after_tax'  =>  $order_total_after_tax,
          'order_datetime'         =>  date("Y-m-d")
      );
	   $q = $this->db->insert_string('invoice_order', $data1);             
	   $this->db->query($q);
       $order_id = $this->db->insert_id();
	

      for($count=0; $count < $_POST["total_item"]; $count++)
      {
        $order_total_before_tax = $order_total_before_tax + floatval(trim($data["order_item_actual_amount"][$count]));

        $order_total_tax1 = $order_total_tax1 + floatval(trim($data["order_item_tax1_amount"][$count]));

        $order_total_tax2 = $order_total_tax2 + floatval(trim($data["order_item_tax2_amount"][$count]));

        $order_total_tax3 = $order_total_tax3 + floatval(trim($data["order_item_tax3_amount"][$count]));

        $order_total_after_tax = $order_total_after_tax + floatval(trim($data["order_item_final_amount"][$count]));

        $data2 = array(
            'order_id'               =>  $order_id,
            'item_name'              =>  trim($data["item_name"][$count]),
            'order_item_quantity'          =>  trim($data["order_item_quantity"][$count]),
            'order_item_price'           =>  trim($data["order_item_price"][$count]),
            'order_item_actual_amount'       =>  trim($data["order_item_actual_amount"][$count]),
            'order_item_tax1_rate'         =>  trim($data["order_item_tax1_rate"][$count]),
            'order_item_tax1_amount'       =>  trim($data["order_item_tax1_amount"][$count]),
            'order_item_tax2_rate'         =>  trim($data["order_item_tax2_rate"][$count]),
            'order_item_tax2_amount'       =>  trim($data["order_item_tax2_amount"][$count]),
            'order_item_tax3_rate'         =>  trim($data["order_item_tax3_rate"][$count]),
            'order_item_tax3_amount'       =>  trim($data["order_item_tax3_amount"][$count]),
            'order_item_final_amount'        =>  trim($data["order_item_final_amount"][$count])
          );
		  $q2 = $this->db->insert_string('invoice_order_item', $data2);             
	   	  $this->db->query($q2);
      }
      $order_total_tax = $order_total_tax1 + $order_total_tax2 + $order_total_tax3;

     $data3 = array(
          'order_total_before_tax'     =>  $order_total_before_tax,
          'order_total_tax1'         =>  $order_total_tax1,
          'order_total_tax2'         =>  $order_total_tax2,
          'order_total_tax3'         =>  $order_total_tax3,
          'order_total_tax'          =>  $order_total_tax,
          'order_total_after_tax'      =>  $order_total_after_tax,
          'order_id'             =>  $order_id
        );
		$this->db->where('order_id', $order_id);
        $this->db->update('invoice_order', $data3); 
  }

	
	/** Manage Invoice Data **/
    
    function upload_invoice_logo()
    {
        
        $this->db->insert('invoice_order', $data);
        $invoice_id  =   $this->db->insert_id();
        move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/invoice_image/" . $invoice_id . '.jpg');
    }
	
    function update_invoice($invoice_id)
    {
      $order_total_before_tax = 0;
      $order_total_tax1 = 0;
      $order_total_tax2 = 0;
      $order_total_tax3 = 0;
      $order_total_tax = 0;
      $order_total_after_tax = 0;
      
		$this->db->where('order_id', $invoice_id);
        $this->db->delete('invoice_order_item');
      
      for($count=0; $count < $_POST["total_item"]; $count++)
      {
        $order_total_before_tax = $order_total_before_tax + floatval(trim($_POST["order_item_actual_amount"][$count]));
        $order_total_tax1 = $order_total_tax1 + floatval(trim($_POST["order_item_tax1_amount"][$count]));
        $order_total_tax2 = $order_total_tax2 + floatval(trim($_POST["order_item_tax2_amount"][$count]));
        $order_total_tax3 = $order_total_tax3 + floatval(trim($_POST["order_item_tax3_amount"][$count]));
        $order_total_after_tax = $order_total_after_tax + floatval(trim($_POST["order_item_final_amount"][$count]));
		  
        $data1 = array(
            'order_id'                 =>  $invoice_id,
            'item_name'                =>  trim($_POST["item_name"][$count]),
            'order_item_quantity'      =>  trim($_POST["order_item_quantity"][$count]),
            'order_item_price'         =>  trim($_POST["order_item_price"][$count]),
            'order_item_actual_amount' =>  trim($_POST["order_item_actual_amount"][$count]),
            'order_item_tax1_rate'     =>  trim($_POST["order_item_tax1_rate"][$count]),
            'order_item_tax1_amount'   =>  trim($_POST["order_item_tax1_amount"][$count]),
            'order_item_tax2_rate'     =>  trim($_POST["order_item_tax2_rate"][$count]),
            'order_item_tax2_amount'   =>  trim($_POST["order_item_tax2_amount"][$count]),
            'order_item_tax3_rate'     =>  trim($_POST["order_item_tax3_rate"][$count]),
            'order_item_tax3_amount'   =>  trim($_POST["order_item_tax3_amount"][$count]),
            'order_item_final_amount'  =>  trim($_POST["order_item_final_amount"][$count])
        );
		  $q2 = $this->db->insert_string('invoice_order_item', $data1);             
	   	  $this->db->query($q2);
	  }
      $order_total_tax = $order_total_tax1 + $order_total_tax2 + $order_total_tax3;
      
      
      $data2 =
        array(
          'order_no'               =>  trim($_POST["order_no"]),
          'order_date'             =>  trim($_POST["order_date"]),
          'order_receiver_name'        =>  trim($_POST["order_receiver_name"]),
          'order_receiver_addr'     =>  trim($_POST["order_receiver_address"]),
          'order_total_before_tax'     =>  $order_total_before_tax,
          'order_total_tax1'          =>  $order_total_tax1,
          'order_total_tax2'          =>  $order_total_tax2,
          'order_total_tax3'          =>  $order_total_tax3,
          'order_total_tax'           =>  $order_total_tax,
          'order_total_after_tax'      =>  $order_total_after_tax,
          'order_id'               =>  $invoice_id
        );
      
      $this->db->where('order_id', $invoice_id);
      $this->db->update('invoice_order', $data2);
            
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
    }
    
    function delete_invoice($order_id)
    {
        $this->db->where('order_id', $order_id);
        $this->db->delete('invoice_order');
		$this->db->where('order_id', $order_id);
        $this->db->delete('invoice_order_item');
    }
	 
}