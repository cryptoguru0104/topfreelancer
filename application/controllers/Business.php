<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Business extends Main_Controller{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('business_model');
	}

	//----------------------------------------------------------------------------------
	// All Businesses
	public function index()
	{
		$data['businesses'] = $this->business_model->get_businesses();

		$data['title'] = trans('top_businesses');
		$data['meta_description'] = 'your meta description here';
		$data['keywords'] = 'meta tags here';
		
		$data['layout'] = 'freelancer/business/businesses_page';
		$this->load->view('layout', $data);
	}

	//----------------------------------------------------------------------------------
	// Business Detail
	public function detail($title)
	{
		$business_id = get_business_id($title);

		$data['business_info'] = $this->business_model->get_business_detail($business_id);

		$data['jobs'] = $this->business_model->get_jobs_by_businesses($business_id); // Get business jobs

		$data['title'] = trans('business_details');
		$data['meta_description'] = 'your meta description here';
		$data['keywords'] = 'meta tags here';
		
		$data['layout'] = 'freelancer/business/business_detail_page';
		$this->load->view('layout', $data);
	}

}

?> 
