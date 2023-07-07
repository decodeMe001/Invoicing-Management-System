<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class User extends CI_Model {

    function __construct(){
        parent::__construct();
        $this->load->database();
        // $this->load->helper(array('form', 'url'));
    }

	public function validate_username()
	{
		$username = $this->input->post('user_name');
		$sql = "SELECT * FROM admin WHERE user_name = ?";
		$query = $this->db->query($sql, array($username));
		return ($query->num_rows() == 1) ? true : false;
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
