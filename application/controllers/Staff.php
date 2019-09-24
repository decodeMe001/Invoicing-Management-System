<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Staff extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    function index() {
        if ($this->session->userdata('staff_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
		
		/*** STAFF DASHBOARD** */
        $data['page_name'] = 'dashboard';
        $data['page_title'] = 'Staff-Dashboard';
        $this->load->view('frontend/index', $data);
    }
//Create Invoice
	
	function create()
	{
		$data['page_title'] = 'Manage-Invoice';
		$data['page_name'] = 'create_invoice';
		
		$this->load->view( 'frontend/index',$data);
		
	}
	//get print-invoice
	function print_pdf($param2 = '')
	{
		$page_data['page_title'] = 'Manage-Invoice';
		$page_data['param2'] = $param2;
		
		$this->load->view( 'frontend/print_invoice',$page_data);
		
	}
	
	//get update-page
	function update($param2 = '' , $param3 = '')
	{
		$page_data['page_title'] = 'Manage-Invoice';
		$page_data['page_name'] = 'update_invoice';
		$page_data['param2'] = $param2;
		$page_data['param3'] = $param3;
		
		$this->load->view( 'frontend/index',$page_data);
		
	}
	
  
	function invoice($task = " ", $invoice_id = "") {
        if ($this->session->userdata('staff_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($task == "create") {
            $order_no = $_POST['order_no'];
            //$order = $this->db->get_where('invoice_order', array('order_no' => $order_no))->row()->order_no;
            if ($order_no == true) {
				$clean = $this->security->xss_clean($this->input->post(NULL, TRUE));
                $this->crud_model->insertInvoice($clean);
            } else {
                return false;
            }
            redirect(base_url('staff/invoice'), 'refresh');
        }

        if ($task == "update")
		{
			$this->crud_model->update_invoice($invoice_id);
			$this->session->set_flashdata('message', 'Invoice info updated successfully!!!');
			redirect(base_url('staff/invoice'), 'refresh');
        }

        if ($task == "delete") {
            $this->crud_model->delete_invoice($invoice_id);
            redirect(base_url('staff/invoice'), 'refresh');
        }

        //$data['invoice_info'] = $this->crud_model->select_invoice_info();
        $data['page_name'] = 'manage_invoice';
        $data['page_title'] = 'Manage-Invoice';
        $this->load->view('frontend/index', $data);
	}
	
	function items(){
		$data['page_name'] = 'invoice_items';
        $data['page_title'] = 'Manage-Invoice';
        $this->load->view('frontend/index', $data);
	}
}
ob_end_flush();