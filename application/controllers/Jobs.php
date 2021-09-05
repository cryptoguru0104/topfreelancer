<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jobs extends Main_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->per_page_record = 8;
		$this->load->model('job_model'); // load job model
	}

	//--------------------------------------------------------------
	// Main Index Function
	public function index()
	{
		$count = $this->job_model->count_all_jobs();
		$offset = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
		$url	= base_url("jobs/");

		$config = $this->functions->pagination_config($url,$count,$this->per_page_record);
		$config['uri_segment'] = 2;		
		$this->pagination->initialize($config);

		$data['jobs'] 		= $this->job_model->get_all_jobs($this->per_page_record, $offset, null); // Get all jobs
		$data['countries'] 	= $this->common_model->get_countries_list(); 
		//$data['cities'] 	= $this->common_model->get_cities_list(0); 

		$data['title'] = trans('label_jobs');

		$data['meta_description'] = 'your meta description here';
		$data['keywords'] = 'meta tags here';
		if ($this->session->userdata('event_id')){
			$data['event_id'] = $this->session->userdata('event_id');
			$this->session->unset_userdata('event_id');
		}
		$data['layout'] = 'freelancer/jobs/job_list_page';
		$this->load->view('layout', $data);
	}

	//--------------------------------------------------------------
	// Advance Search functionality 
	public function search()
	{
		$search = array();
		if($this->input->post('search'))
		{
			$this->form_validation->set_rules('title', trans('what_looking'), 'trim');

			if ($this->form_validation->run() === FALSE) {
				redirect(base_url('jobs/search'));
				return;
			}

			// search keywords
			if(!empty($this->input->post('kws')))
				$search['kws'] = make_slug($this->input->post('kws'));

			// search job title
			if(!empty($this->input->post('title')))
				$search['title'] = make_slug($this->input->post('title'));

			// search job country
			if(!empty($this->input->post('country')))
				$search['country'] = $this->input->post('country');

			// search catagory
			if(!empty($this->input->post('city')))
				$search['city'] = $this->input->post('city');

			// search experience
			if(!empty($this->input->post('language')))
				$search['language'] = $this->input->post('language');

			// search job type
			if(!empty($this->input->post('nationality')))
				$search['nationality'] = $this->input->post('nationality');

			// search job type
			if(!empty($this->input->post('sortby')))
				$search['sortby'] = $this->input->post('sortby');

			$query = $this->uri->assoc_to_uri($search);

			redirect(base_url('jobs/search/'.$query),'refresh');

		}
		
		$search_array = $this->uri->uri_to_assoc(3);
		$search_query = $this->uri->assoc_to_uri($search_array);
		$pg_arr = pagination_assoc('p', 3); // helper function

		$count = $this->job_model->count_all_search_result($search_array);
		$offset = $pg_arr['offset'];

		$url= base_url("jobs/search/".$pg_arr['uri']);

		$config = $this->functions->pagination_config($url,$count,$this->per_page_record);
		$config['uri_segment'] = $pg_arr['seg'];	

		$this->pagination->initialize($config);

		$data['search_value'] = $search_array;
		$data['jobs'] = $this->job_model->get_all_jobs($this->per_page_record, $offset, $search_array);
		$data['countries'] = $this->common_model->get_countries_list(); 

		$data['title'] = trans('search_results');
		$data['meta_description'] = 'your meta description here';
		$data['keywords'] = 'meta tags here';
		
		$data['layout'] = 'freelancer/jobs/job_list_page';
		$data['count'] = $count;
		$this->load->view('layout', $data, $count);
	}

	//--------------------------------------------------------------
	// complete job detail page
	public function job_detail()
	{	
		$job_id = $this->uri->segment(2);
		$user_id = $this->session->userdata('user_id');
		
		// checking for already applied application
		$data['already_applied'] = $this->job_model->check_applied_application($user_id, $job_id);	

		$data['user_detail'] = $this->job_model->get_user_by_id($user_id);
		$data['job_detail'] = $this->job_model->get_job_by_id($job_id);

		$data['job_actual_link'] = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; // redirect to same job detail page after login 

		$data['cities_job'] = $this->job_model->get_cities_with_jobs(); //right sidebar

		// social media sharing 	
		$data['show_og_tags'] = true;
        $data['og_title'] = $data['job_detail']['title'];
        $description_text = trim(html_escape(strip_tags($data['job_detail']['description'])));
        $data['og_description'] = text_limit($description_text, 200);
        $data['og_type'] = "Job";
        $data['og_url'] = base_url('jobs/'.$data['job_detail']['id'].'/'.$data['job_detail']['job_slug']);
        $data['og_image'] = base_url('assets/img/logo.png');	

		$data['title'] = $data['job_detail']['title'];
		$data['meta_description'] = text_limit($description_text, 150);
		$data['keywords'] = $data['job_detail']['title'];
		
		$data['layout'] = 'freelancer/jobs/job_detail_page';
		$this->load->view('layout', $data);
	}

	//-------------------------------------------------------------------------------------------
	// when applicant will apply for the job
	public function apply_job()
	{
		$json = array();
		$user_id 			= $this->input->post('uid');
		$job_id 			= $this->input->post('jid');
		$biz_id 			= $this->input->post('bid');
		$emp_email 			= $this->input->post('emp_email');
		$cover_letter 		= $this->input->post('cover_letter');
		$applied_date		= date('l jS \of F Y');

		// $recaptchaResponse 	= trim($this->input->post('g-recaptcha-response'));
		// $userIp				= $this->input->ip_address();
		// $secret 			= $this->config->item('google_secret');
		// $url				= "https://www.google.com/recaptcha/api/siteverify?secret=".$secret."&response=".$recaptchaResponse."&remoteip=".$userIp;
	 
		// $ch = curl_init(); 
		// curl_setopt($ch, CURLOPT_URL, $url); 
		// curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		// $output = curl_exec($ch); 
		// curl_close($ch);      
			 
		// $status				= json_decode($output, true);
	 
		// if ($status['success']) {
		// 	exit;
		// } else {
		// 	$json['error']['captcha'] = 'Sorry Google Recaptcha Unsuccessful!';
		// }

        // name validation
        if(empty(trim($cover_letter))){
            $json['error']['cover_letter'] = "Cover Letter";
        }

		if (!empty($this->input->post('destroyEventID'))){
			$this->session->unset_userdata('event_id');
			$json['destroy'] = true;
		}

		if(empty($json['error']))
		{
			//insert job applicant to the "rac_applied_job" table
			$result = $this->job_model->insert_job_application($user_id, $biz_id, $job_id, $cover_letter); 

			if($result){
			    $job 			= get_job_detail($job_id);
				$business 		= get_business_name($job['business_id']);
			    $user_name 		= get_user_fname($user_id) . get_user_lname($user_id);
				$user_email 	= get_user_email($user_id);
				$user_phone 	= get_user_phone($user_id);
				$user_resume 	= base_url(get_user_resume($user_id));

			    $emp_to 		= $emp_email;
				$from			= 'noreply@topfreelancer.com';
			    
			    // send email to employer
			    $mail_data = array(
			    	'job_title' 	=> $job['title'],
			    	'job_emp' 		=> $business,
			    	'job_date' 		=> $job['created_date'],
			    	'apply_date' 	=> $applied_date,
			    	'fl_name' 		=> $user_name,
			    	'fl_email' 		=> $user_email,
			    	'fl_phone' 		=> $user_phone,
			    	'cover_letter' 	=> $cover_letter,
			    );
			    
			    // Job Seeker
			    $this->mailer->mail_template($from,$user_email,'job-applied',$mail_data, $user_resume);
			    
			    //Employer Alert
			    $this->mailer->mail_template($from,$emp_to,'freelancer-applied',$mail_data, $user_resume);
				
				if(sendEmail($this->mailer->mail_template($from,$emp_to,'freelancer-applied',$mail_data, $user_resume))) {
					//$json['success'] = 'Your message has been sent successfully!';
					$json['success'] = trans('job_application_sent_msg');
				} else{
					$json['failed'] = 'Something went wrong, please check!';
				}
		
				$json['success'] = 'Your message has been sent successfully!';
				$this->output->set_header('Content-Type: application/json');
				echo json_encode($json);
			}
		} else {
			$this->output->set_header('Content-Type: application/json');
			echo json_encode($json);
		}
	}

}// endClass
