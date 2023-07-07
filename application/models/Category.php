<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Category extends CI_Model {
	
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	function insert($data)
	{
		$get_data = array(
          'category_name'  => $this->input->post('category_name'),
          'description'  => $this->input->post('description')
        );
        $this->db->insert('category', $get_data);
	}

	function update($id)
	{
		$data = array(
          'category_name'  => $this->input->post('category_name'),
          'description'  => $this->input->post('description')
        );

      $this->db->where('id', $id);
      $this->db->update('category', $data);

	}

	function destroy($id)
	{
        $this->db->where('id', $id);
        $this->db->delete('category');
    }


}
//session_write_close();
ob_end_flush();