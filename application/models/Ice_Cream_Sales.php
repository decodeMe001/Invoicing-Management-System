<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Ice_Cream_Sales extends CI_Model {
	
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
    public function insert($data)
    {
		$total_cost_price = 0;
		$total_selling_price = 0;
		$qty_sold = 0;
		
		$data1 = array(
			  'sales_code'              =>  trim($data["sales_code"]),
			  'vendor_id'    			=>  trim($data["vendor_id"]),
			  'payment_date'            =>  trim($data["payment_date"]),
			  'total_cost_price'		=>  $total_cost_price,
			  'total_selling_price'		=>  trim($data["final_amt"]),
			  'profit'    				=>  trim($data["total_profit"]),
			  'balance'    				=>  trim($data["balance"]),
			  'cash_paid'    			=>  trim($data["cash_paid"])
			);
		$q = $this->db->insert_string('ice_cream_sales', $data1);
		$this->db->query($q);
		$sales_id = $this->db->insert_id();

      for($count=0; $count < $_POST["total_item"]; $count++)
      {
        $total_cost_price += floatval(trim($data["total_cost_price"][$count]));
        $total_selling_price += floatval(trim($data["total_selling_price"][$count]));
		
        $data2 = array(
			'sales_id'               =>  $sales_id,
			'category_id'    		 =>  trim($data["category"][$count]),
			'product_id'    		 =>  trim($data["product_id"][$count]),
			'item_name'    		     =>  trim($data["item_name"][$count]),
            'order_item_quantity'    =>  trim($data["order_item_quantity"][$count]),
            'unit_price'      		 =>  trim($data["unit_price"][$count]),
            'selling_price'      	 =>  trim($data["selling_price"][$count]),
            'total_cost_price'       =>  trim($data["total_cost_price"][$count]),
            'total_selling_price'    =>  trim($data["total_selling_price"][$count]),

		  );
		$q2 = $this->db->insert_string('ice_cream_sales_order', $data2);
		$qty_left = (int)trim($data["qty_stocked"][$count]) - (int)trim($data["order_item_quantity"][$count]);
		$sold_total = (int)trim($data["quantity_sold"][$count]) + (int)trim($data["order_item_quantity"][$count]);
		$qty_data = array('quantity_in_stock' => $qty_left, 'quantity_sold' => $sold_total);
		$this->db->where('id', trim($data["product_id"][$count]));
		$this->db->update('products', $qty_data);
		$this->db->query($q2);
	  }
		
		$data3 = array(
			'total_cost_price'  => $total_cost_price,
			'total_selling_price'  => $total_selling_price,
			'id'     => $sales_id
		);
		$this->db->where('id', $sales_id);
        $this->db->update('ice_cream_sales', $data3);
		
		//update vendor debt
		
		$data4 = array('debt' => trim($data["balance"]));
		$this->db->where('id', trim($data["vendor_id"]));
		$this->db->update('vendor', $data4);
		
	}
	
	public function update($id)
    {
		$total_cost_price = 0;
		$total_selling_price = 0;
		$qty_sold = 0;
		
		$this->db->where('sales_id', $id);
        $this->db->delete('ice_cream_sales_order');
		for($count=0; $count < $_POST["total_item"]; $count++)
		{
			$total_cost_price += floatval(trim($_POST["total_cost_price"][$count]));
			$total_selling_price += floatval(trim($_POST["total_selling_price"][$count]));

			$data2 = array(
			'sales_id'               =>  $id,
			'category_id'    		 =>  trim($_POST["category"][$count]),
			'product_id'    		 =>  trim($_POST["product_id"][$count]),
			'item_name'    		     =>  trim($_POST["item_name"][$count]),
			'order_item_quantity'    =>  trim($_POST["order_item_quantity"][$count]),
			'unit_price'      		 =>  trim($_POST["unit_price"][$count]),
			'selling_price'      	 =>  trim($_POST["selling_price"][$count]),
			'total_cost_price'       =>  trim($_POST["total_cost_price"][$count]),
			'total_selling_price'    =>  trim($_POST["total_selling_price"][$count]));
			
			$q2 = $this->db->insert_string('ice_cream_sales_order', $data2);
			$qty_left = (int)trim($_POST["qty_stocked"][$count]) - (int)trim($_POST["order_item_quantity"][$count]);
			$sold_total = (int)trim($_POST["order_item_quantity"][$count]);
			$qty_data = array('quantity_in_stock' => $qty_left, 'quantity_sold' => $sold_total);
			$this->db->where('id', trim($_POST["product_id"][$count]));
			$this->db->update('products', $qty_data);
			$this->db->query($q2);
		}
	  
		$data1 = array(
			  'vendor_id'    			=>  trim($_POST["vendor_id"]),
			  'payment_date'            =>  trim($_POST["payment_date"]),
			  'total_cost_price'		=>  $total_cost_price,
			  'total_selling_price'		=>  $total_selling_price,
			  'profit'    				=>  trim($_POST["total_profit"]),
			  'cash_paid'    			=>  trim($_POST["cash_paid"]),
			  'balance'    				=>  trim($_POST["balance"])
			);
	
		$this->db->where('id', $id);
        $this->db->update('ice_cream_sales', $data1);
		
		//update vendor
		$data4 = array('debt' => trim($_POST["balance"]));
		$this->db->where('id', trim($_POST["vendor_id"]));
		$this->db->update('vendor', $data4);
		
	}
  
	
    function destroy($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('ice_cream_sales');
		$this->db->where('sales_id', $id);
        $this->db->delete('ice_cream_sales_order');
    }

}
//session_write_close();
ob_end_flush();