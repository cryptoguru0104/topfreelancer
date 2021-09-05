<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Myjobs extends Main_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->rbac->check_user_authentication();
		$this->load->model('myjob_model');
		$this->load->model('profile_model');
	}

	//-------------------------------------------------------------------------------
	// Applied Jobs
	public function index()
	{
		$pagecount						= 4;
		$count 							= $this->myjob_model->count_all_applied_jobs();
		$offset 						= ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
		$url							= base_url("myjobs/");

		$config 						= $this->functions->pagination_config($url,$count,$pagecount);
		$config['uri_segment'] = 2;		
		$this->pagination->initialize($config);

		$user_id 						= $this->session->userdata('user_id');
		$data['jobs'] 					= $this->myjob_model->get_applied_jobs($pagecount, $offset, $user_id); // Fetching Applied jobs

		$data['title'] 					= trans('applied_jobs');
		$data['meta_description'] 		= 'your meta description here';
		$data['keywords'] 				= 'meta tags here';

		$data['layout'] 				= 'freelancer/my_jobs/applied_job_page';
		$this->load->view('layout', $data);
	}

	//-------------------------------------------------------------------------------
	// Posted Jobs
	public function posted()
	{
		$pagecount						= 3;
		$count 							= $this->myjob_model->count_all_posted_jobs();
		$offset 						= ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
		$url							= base_url("myjobs/posted/");

		$config 						= $this->functions->pagination_config($url,$count,$pagecount);
		$config['uri_segment'] = 2;		
		$this->pagination->initialize($config);

		$user_id 						= $this->session->userdata('user_id');
		$is_active = 
		$data['jobs'] 					= $this->myjob_model->get_posted_jobs($pagecount, $offset, $user_id); // Fetching Posted jobs

		$data['title'] 					= trans('posted_jobs');
		$data['meta_description'] 		= 'your meta description here';
		$data['keywords'] 				= 'meta tags here';

		$data['layout'] 				= 'freelancer/my_jobs/posted_job_page';
		$this->load->view('layout', $data);
	}

	//-------------------------------------------------------------------------------
	// Matching Jobs
	public function matching()
	{
		$user_id = $this->session->userdata('user_id');
		$skills = get_user_skills($user_id); // helper function

		$data['jobs'] = $this->myjob_model->get_matching_jobs($skills);

		$data['title'] = trans('label_matching_jobs');
		$data['meta_description'] = 'your meta description here';
		$data['keywords'] = 'meta tags here';
		
		$data['layout'] = 'freelancer/my_jobs/matching_jobs_page';
		$this->load->view('layout', $data);
	}

	//---------------------------------------------------------------------
	// get saved Jobs
	public function saved()
	{
		$user_id = $this->session->userdata('user_id');

		$data['jobs'] = $this->myjob_model->get_saved_jobs($user_id);

		$data['title'] = trans('label_saved_jobs');
		$data['meta_description'] = 'your meta description here';
		$data['keywords'] = 'meta tags here';
		
		$data['layout'] = 'freelancer/my_jobs/saved_job_page';
		$this->load->view('layout', $data);
	}

	//---------------------------------------------------------------------
	// Save Jobs
	public function save_job()
	{
		if(!$this->session->userdata('is_user_login')){
			echo 'not_login';
			exit();
		}
			
		$data = array(
			'job_id' => $this->input->post('job_id'),
			'seeker_id' => $this->session->userdata('user_id'),
		);

		// if job is aleady saved
		$result = $this->myjob_model->is_already_saved($data);
		if($result) {
			echo 'already_saved';
			exit();
		}

		// save the job
		$result = $this->myjob_model->save_job($data);
		if($result){
			echo 'saved';
			exit();
		}
	}

	//-----------------------------------------------------------------
	// Delete Job
	public function delete($job_id)
	{
		$user_id = $this->session->userdata('user_id');

		$this->db->where('job_id',$job_id);
		$this->db->where('seeker_id',$user_id);
		$this->db->delete('rac_saved_jobs');

		echo $this->db->last_query();

		$this->session->set_flashdata('success',trans('job_deleted'));
		redirect(base_url('myjobs/saved'));
	}


}// endClass
