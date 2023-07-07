<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Vendor extends CI_Model {
	
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	function insert($data)
	{
		$get_data = array(
          'name'  =>  trim($_POST['name']),
          'phone'  =>  trim($_POST['phone']),
          'debt'  =>  trim($_POST['debt']),
		  'credit_limit'  =>  trim($_POST['credit_limit']),
        );
        $db = $this->db->insert_string('vendor',$get_data);
        $this->db->query($db);
	}

	function update($id)
	{
		$data['name'] 		= $this->input->post('name');
        $data['phone'] 		= $this->input->post('phone');
        $data['debt'] 		= $this->input->post('debt');
        $data['credit_limit'] = $this->input->post('credit_limit');

        $this->db->where('id', $id);
		$this->db->update('vendor', $data);
				
		$data3 = array('balance'  => $this->input->post('debt'));
		$this->db->where('vendor_id', $id);
        $this->db->update('ice_cream_sales', $data3);

	}

	function destroy($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('vendor');
	}

}
//session_write_close();
ob_end_flush();