<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Supplier extends CI_Model {
	
	function __construct(){
		parent::__construct();
		$this->load->database();
	
	}
	
	// Manage Supplier
	
	public function insert($data)
	{
		$get_data = array(
          'name'  => $this->input->post('name'),
          'phone'  => $this->input->post('phone'),
          'product'  => $this->input->post('product'),
          'total'  => $this->input->post('total'),
          'vat'  => $this->input->post('vat'),
          'amount_paid'  => $this->input->post('amount_paid'),
          'payment_date'  => $this->input->post('payment_date')
        );
        $this->db->insert('supplier', $get_data);
	}
	
	public function update($id) {
		$data = array(
          'name'  => $this->input->post('name'),
          'phone'  => $this->input->post('phone'),
          'product'  => $this->input->post('product'),
          'total'  => $this->input->post('total'),
          'vat'  => $this->input->post('vat'),
          'amount_paid'  => $this->input->post('amount_paid'),
          'payment_date'  => $this->input->post('payment_date'),
        );

      $this->db->where('id', $id);
      $this->db->update('supplier', $data);
	}
	
	public function destroy($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('supplier');
    }

}
//session_write_close();
ob_end_flush();