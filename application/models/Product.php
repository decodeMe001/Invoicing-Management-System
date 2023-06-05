<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Product extends CI_Model {
	
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	function insert($data)
	{
		$get_data = array(
          'category_id'  => $this->input->post('category_id'),
          'product_code'  => $this->input->post('product_code'),
          'product_name'  => $this->input->post('product_name'),
          'description'  => $this->input->post('description'),
          'quantity_in_stock'  => $this->input->post('quantity_in_stock'),
          'unit_price'  => $this->input->post('unit_price'),
          'selling_price'  => $this->input->post('selling_price')
        );
        $this->db->insert('products', $get_data);
	}

	function update($id)
	{
		$data = array(
          'category_id'  => $this->input->post('category_id'),
          'product_code'  => $this->input->post('product_code'),
          'product_name'  => $this->input->post('product_name'),
          'description'  => $this->input->post('description'),
          'quantity_in_stock'  => $this->input->post('quantity_in_stock'),
          'unit_price'  => $this->input->post('unit_price'),
          'selling_price'  => $this->input->post('selling_price')
        );

      $this->db->where('id', $id);
      $this->db->update('products', $data);

	}

	function destroy($id)
	{
        $this->db->where('id', $id);
        $this->db->delete('products');
    }

}
//session_write_close();
ob_end_flush();