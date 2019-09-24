<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
// use PhpOffice\PhpSpreadsheet\Spreadsheet;
// use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Admin extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->database();

    }

    /***default function, redirects to login page if no admin logged in yet** */
    function index() {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'account', 'refresh');
        if ($this->session->userdata('admin_login') == 1)
            redirect(base_url() . 'admin/dashboard', 'refresh');

    }

    /*** ADMIN DASHBOARD** */

    function dashboard()
	{
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
	      if ($this->session->userdata('staff_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $data['page_name'] = 'dashboard';
	      $data['page_title'] = 'Admin-Dashboard';
        $this->load->view('frontend/index', $data);
    }

	//Create Invoice

	function create()
	{
		$data['page_title'] = 'Manage-Invoice';
		$data['page_name'] = 'create_invoice';
		$data['get_array'] = $this->db->get('pricing_rate_item')->result_array();
		$data['total_rows'] = $this->db->count_all('pricing_rate_item');
		$data['customer'] = $this->db->get('customers')->result_array();
		$this->load->view( 'frontend/index',$data);

	}

	//get update-page
	function update($param2 = '')
	{
		$page_data['page_title'] = 'Manage-Photo-Invoice';
		$page_data['page_name'] = 'update_invoice';
		$page_data['param2'] = $param2;
		$page_data['get_array'] = $this->db->get('pricing_rate_item')->result_array();
		$this->load->view( 'frontend/index',$page_data);

	}

	function invoice($task = " ", $invoice_id = "") {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
		if ($this->session->userdata('staff_login') != 1) {
            redirect(base_url(), 'refresh');
        }

        if ($task == "create") {
            $order_no = $_POST['order_no'];
            if ($order_no == true) {
				$clean = $this->security->xss_clean($this->input->post(NULL, TRUE));
                $this->crud_model->insertInvoice($clean);
				$this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Data Created Successfully!!!</div>');
            } else {
                return false;
            }
            redirect(base_url('admin/invoice'), 'refresh');
        }

        if ($task == "update")
		{
			$this->crud_model->update_invoice($invoice_id);
			$this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Data Updated Successfully!!!</div>');
			redirect(base_url('admin/invoice'), 'refresh');
        }

        if ($task == "delete") {
            $this->crud_model->delete_invoice($invoice_id);
			$this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Data Deleted Successfully!!!</div>');
            redirect(base_url('admin/invoice'), 'refresh');
        }

        //$data['invoice_info'] = $this->crud_model->select_invoice_info();
        $data['page_name'] = 'manage_invoice';
        $data['page_title'] = 'Manage-Order';
	      $data['get_invoice_data'] = $this->db->get('invoice_order')->result_array();
        $this->load->view('frontend/index', $data);
	}

	function staff($task = " ", $id = "") {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }

        if ($task == "create")
		{
			$clean = $this->security->xss_clean($this->input->post(NULL, TRUE));
			$this->crud_model->insert_staff($clean);
            $this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Staff Data Created Successfully!!!</div>');
            redirect(base_url('admin/profile'), 'refresh');
        }

		if ($task == "update")
		{
			$this->crud_model->update_staff($id);
			$this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Staff Data Updated Successfully!!!</div>');
			redirect(base_url('admin/profile'), 'refresh');
        }

        if ($task == "delete")
		{
            $this->crud_model->delete_staff($id);
			$this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Staff Data Deleted Successfully!!!</div>');
            redirect(base_url('admin/profile'), 'refresh');
        }

        $page_data['page_name'] = 'manage_profile';
        $page_data['page_title'] = 'Staff Profile';
        $page_data['update_admin'] = $this->db->get_where('admin', array('admin_id' => $this->session->userdata('id')))->result_array();
	      $page_data['staff'] = $this->db->get_where('admin', array('role' => 'staff'))->result_array();
        $this->load->view('frontend/index', $page_data);
	}

	function customer($task=" ", $id = " ")
	{
    if ($this->session->userdata('admin_login') != 1)
    {
        redirect(base_url(), 'refresh');
    }
    if ($this->session->userdata('staff_login') != 1)
    {
        redirect(base_url(), 'refresh');
    }
		if ($task == "create")
		{
      $clean = $this->security->xss_clean($this->input->post(NULL, TRUE));
      $this->crud_model->insert_customer($clean);
      $this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Customer Data Created Successfully!!!</div>');
      redirect(base_url('admin/customer'), 'refresh');
    }

		if ($task == "update")
		{
			$this->crud_model->update_customer($id);
			$this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Customer Data Updated Successfully!!!</div>');
			redirect(base_url('admin/customer'), 'refresh');
    }

    if ($task == "delete")
		{
      $this->crud_model->delete_customer($id);
       $this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Customer Data Deleted Successfully!!!</div>');
       redirect(base_url('admin/customer'), 'refresh');
    }

    $data['page_title'] = 'Manage-Customer';
		$data['page_name'] = 'manage_customer';
		$data['customer_info'] = $this->crud_model->select_customer_info();
		$this->load->view( 'frontend/index',$data);
    }

    function customer_record_debt($task = " ", $id = " "){
      if ($this->session->userdata('admin_login') != 1)
      {
          redirect(base_url(), 'refresh');
      }
      if ($this->session->userdata('staff_login') != 1)
      {
          redirect(base_url(), 'refresh');
      }
      if ($task == "create")
  		{
        $clean = $this->security->xss_clean($this->input->post(NULL, TRUE));
        $this->crud_model->insert_record($clean);
        $this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Customer Record Created Successfully!!!</div>');
        redirect(base_url('admin/customer_record_debt'), 'refresh');
      }
      if ($task == "update")
  		{
  			$this->crud_model->update_debt($id);
  			$this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Customer Debt Updated Successfully!!!</div>');
  			redirect(base_url('admin/customer_record_debt'), 'refresh');
      }
      if ($task == "delete")
  		{
        $this->crud_model->delete_debt($id);
         $this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Customer Debt Deleted Successfully!!!</div>');
         redirect(base_url('admin/customer_record_debt'), 'refresh');
      }
      $data['page_title'] = 'Manage-Debt';
	  $data['page_name'] = 'manage_debt';
      $data['customer'] = $this->db->get('invoice_order')->result_array();
	  $this->load->view( 'frontend/index',$data);
    }

	function get_customer()
  {
		$get_name = $this->input->post('selected_name'); //Ajax post received
		$valid = array('success' => false);
		if (isset($get_name)){
			if ($get_name != '') {
				$valid['success'] = true;
				$result = $this->db->get_where('customers', array('customer_name' => $get_name))->result_array();
				 foreach($result as $val)
         {
					$valid['address'] = $val['address'];
					$valid['phone'] = $val['phone'];
				 }

			}else{
				$valid['success'] = true;
			}

		}
		echo json_encode($valid);
	}
  function get_customer_debt_record()
  {
		$get_name = $this->input->post('selected_name'); //Ajax post received
		$valid = array('success' => false);
		if (isset($get_name)){
			if ($get_name != '') {
				$valid['success'] = true;
				$result = $this->db->get_where('invoice_order', array('order_receiver_name' => $get_name))->result_array();
				 foreach($result as $val)
				{
					$valid['paid'] = $val['paid'];
					$valid['balance'] = $val['balance'];
					$valid['order_date'] = $val['order_date'];
				 }

			}else{
				$valid['success'] = true;
			}

		}
		echo json_encode($valid);
	}

	function pricing($task=" ", $rate_id = " ")
	{
        if ($this->session->userdata('admin_login') != 1)
		      {
            redirect(base_url(), 'refresh');
            }
    		if ($task == "create")
    		{
    			$clean = $this->security->xss_clean($this->input->post(NULL, TRUE));
    			$this->crud_model->insert_pricing($clean);
                $this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Data Created Successfully!!!</div>');
                redirect(base_url('admin/pricing'), 'refresh');
        }

		if ($task == "update")
		{
			$this->crud_model->update_pricing($rate_id);
			$this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Data Updated Successfully!!!</div>');
			redirect(base_url('admin/pricing'), 'refresh');
        }

        if ($task == "delete")
		{
            $this->crud_model->delete_pricing($rate_id);
			$this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Data Deleted Successfully!!!</div>');
            redirect(base_url('admin/pricing'), 'refresh');
        }

        $data['page_title'] = 'Manage-Pricing';
    		$data['page_name'] = 'manage_photo_info';
    		$this->load->view( 'frontend/index',$data);
    }

    /*****SITE/SYSTEM SETTINGS******** */

    function settings($param1 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'account', 'refresh');

        if ($param1 == 'do_update') {
            $this->crud_model->update_system_settings();
			$this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Settings Updated Successfully!!!</div>');
            redirect(base_url() . 'admin/settings/', 'refresh');
        }
        $page_data['page_name'] = 'sys_settings';
        $page_data['page_title'] = 'App-Settings';
        $this->load->view('frontend/index', $page_data);

    }

    /******MANAGE OWN PROFILE AND CHANGE PASSWORD** */

    function profile($param1 = '', $param2 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'account', 'refresh');

        if ($param1 == 'update_profile_info') {
            $data['user_name'] = $this->input->post('name');
            $data['role'] = $this->input->post('role');

            $this->db->where('admin_id', $this->session->userdata('id'));
            $this->db->update('admin', $data);

            $this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Profile Settings Updated Successfully!!!</div>');
            redirect(base_url() . 'admin/profile');
        }
        if ($param1 == 'change_password') {
            $current_password_input = sha1($this->input->post('password'));
            $new_password = sha1($this->input->post('new_password'));
            $confirm_new_password = sha1($this->input->post('confirm_new_password'));

            $current_password_db = $this->db->get_where('admin', array('admin_id' =>
                        $this->session->userdata('id')))->row()->password;

            if ($current_password_db == $current_password_input && $new_password == $confirm_new_password) {
                $this->db->where('admin_id', $this->session->userdata('id'));
                $this->db->update('admin', array('password' => $new_password));

                $this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Password Settings Updated Successfully!!!</div>');
                redirect(base_url() . 'admin/profile');
            } else {
                $this->session->set_flashdata('error_msg','<div class="alert alert-danger text-center">Settings Update Failed...</div>');
                redirect(base_url() . 'admin/profile');
            }
        }
        $page_data['page_name'] = 'manage_profile';
        $page_data['page_title'] = 'Staff Profile';
        $page_data['update_admin'] = $this->db->get_where('admin', array('admin_id' => $this->session->userdata('id')))->result_array();
	      $page_data['staff'] = $this->db->get_where('admin', array('role' => 'staff'))->result_array();
        $this->load->view('frontend/index', $page_data);
    }

	function sales(){
		$data['page_name'] = 'invoice_items';
        $data['page_title'] = 'Manage-Sales';
        $this->load->view('frontend/index', $data);
	}

	//get print-invoice
	function print_pdf($param2 = '')
	{
		$page_data['page_title'] = 'Manage-Invoice';
		$page_data['page_name'] = 'create_invoice';
		$page_data['param2'] = $param2;

		$this->load->view( 'frontend/print_invoice',$page_data);

	}
	//get print-invoice
	// function excel()
	// {
	// 	//require(APPPATH.'third_party/PHPExcel-1.8/Classes/PHPExcel.php');
	// 	//require(APPPATH.'third_party/PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');
  //
	// 	$spreadsheet = new Spreadsheet();
	// 	$spreadsheet->getActiveSheet();
  //
	// 	$spreadsheet->getActiveSheet()->setCellValue('A1','Sr-No');
	// 	$spreadsheet->getActiveSheet()->setCellValue('B1','Order ID');
	// 	$spreadsheet->getActiveSheet()->setCellValue('C1','Item Name');
	// 	$spreadsheet->getActiveSheet()->setCellValue('D1','Type');
	// 	$spreadsheet->getActiveSheet()->setCellValue('E1','Size');
	// 	$spreadsheet->getActiveSheet()->setCellValue('F1','Quantity');
	// 	$spreadsheet->getActiveSheet()->setCellValue('G1','Price');
	// 	$spreadsheet->getActiveSheet()->setCellValue('H1','Created At');
	// 	$spreadsheet->getActiveSheet()->setCellValue('I1','Amount');
  //
  //
	// 	$result1 = $this->db->get('invoice_order_item')->result();
  //
	// 	$excel_row = 2;
	// 	$no = 1;
  //
	// 	foreach($result1 as $row) {
	// 		$spreadsheet->getActiveSheet()->setCellValue('A'.$excel_row, $no++);
	// 		$spreadsheet->getActiveSheet()->setCellValue('B'.$excel_row, $row->order_id);
	// 		$spreadsheet->getActiveSheet()->setCellValue('C'.$excel_row, $row->item_name);
	// 		$spreadsheet->getActiveSheet()->setCellValue('D'.$excel_row, $row->order_photo_type);
	// 		$spreadsheet->getActiveSheet()->setCellValue('E'.$excel_row, $row->order_photo_size);
	// 		$spreadsheet->getActiveSheet()->setCellValue('F'.$excel_row, $row->order_item_quantity);
	// 		$spreadsheet->getActiveSheet()->setCellValue('G'.$excel_row, $row->order_item_price);
	// 		$spreadsheet->getActiveSheet()->setCellValue('H'.$excel_row, $row->created_at);
	// 		$spreadsheet->getActiveSheet()->setCellValue('I'.$excel_row, $row->order_item_actual_amount);
	// 		$excel_row++;
	// 	}
	// 	$spreadsheet->getActiveSheet()->setTitle("Blessed Digital Report");
	// 	$filename = "BlessedStanReport-".date("Y-m-d-H-i-s").'.xlsx';
  //
	// 	ob_end_clean();
	// 	header('Content-Type: application/vnd.ms-excel');
	// 	header('Content-disposition: attachment; filename="'.$filename.'"');
	// 	header("Cache-Control: max-age=0");
	// 	$writer = new Xlsx($spreadsheet);
	// 	$writer->save('php://output');
	// 	ob_end_clean();
  //
	// }

}

ob_end_flush();
