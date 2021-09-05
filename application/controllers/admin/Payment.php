<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/payment_model', 'payment_model');
	}

	public function index(){

		$data['payment_detail'] = $this->payment_model->get_all_payments();

		$data['title'] = 'Payments';
		$data['view'] = 'admin/payment/payment_list';
		$this->load->view('admin/layout',$data);
	}
	

}


?>