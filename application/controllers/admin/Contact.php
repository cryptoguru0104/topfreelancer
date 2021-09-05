<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Contact extends MY_Controller
{ 
	function __construct(){
		parent ::__construct();
		$this->load->model('admin/contact_model', 'contact_model');
	}

	//-----------------------------------------------------
	public function index()
	{
		$data['title'] = 'Contact List';
		$data['view'] = 'admin/contact/contact-list';
		$data['queries'] = $this->contact_model->get_contact_form_details();
		$this->load->view('admin/layout', $data);
	}

	//-----------------------------------------------------
	public function del($id = 0)
	{
		$this->db->delete('rac_contact_us', array('id' => $id));
		$this->session->set_flashdata('success', 'Query has been Deleted Successfully!');
		redirect(base_url('admin/contact'));
	}

}
?>
