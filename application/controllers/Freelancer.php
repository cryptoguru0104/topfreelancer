<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Freelancer extends Main_Controller{

	public function __construct()
	{
		parent::__construct();
		$this->per_page_record = 8;
		$this->load->model('freelancer_model');
		$this->load->model('common_model');
	}

	//----------------------------------------------------------------------------------
	// All Businesses
	public function index()
	{

		$count = $this->freelancer_model->count_all_freelancers();
		$offset = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
		$url= base_url("freelancer/");

		$config = $this->functions->pagination_config($url,$count,$this->per_page_record);
		$config['uri_segment'] = 2;		
		$this->pagination->initialize($config);


		//$data['freelancers'] = $this->freelancer_model->get_freelancers();
		$data['freelancers'] = $this->freelancer_model->get_all_freelancers($this->per_page_record, $offset, null); // Get all freelancers
		$data['countries'] = $this->common_model->get_countries_list(); 

		$data['title'] = trans('top_freelancers');
		$data['meta_description'] = 'your meta description here';
		$data['keywords'] = 'meta tags here';
		
		$data['layout'] = 'freelancer/freelancers_page';
		$this->load->view('layout', $data);
	}

	//--------------------------------------------------------------
	// Advance Search functionality 
	public function search()
	{
		$search = array();
		if($this->input->post('search'))
		{
			$this->form_validation->set_rules('kws', 'Keywords', 'trim|required');
			$this->form_validation->set_rules('sortby', 'sortby', 'required');
			$this->form_validation->set_rules('language', 'Language', 'trim');
			$this->form_validation->set_rules('country', 'Country', 'trim');
			$this->form_validation->set_rules('city', 'City', 'trim');
			$this->form_validation->set_rules('nationality', 'Nationality', 'trim');

			if ($this->form_validation->run() === FALSE) {
				redirect(base_url('freelancer/search'));
				return;
			}

			// search keywords
			if(!empty($this->input->post('kws')))
				$search['kws'] = make_slug($this->input->post('kws'));

			// search language
			if(!empty($this->input->post('language')))
				$search['language'] = $this->input->post('language');
				
			// search country
			if(!empty($this->input->post('country')))
				$search['country'] = $this->input->post('country');

			// search city
			if(!empty($this->input->post('city')))
				$search['city'] = $this->input->post('city');

			// search nationality
			if(!empty($this->input->post('nationality')))
				$search['nationality'] = $this->input->post('nationality');

			//search sortby
			if(!empty($this->input->post('sortby')))
				$search['sortby'] = $this->input->post('sortby');

			$query = $this->uri->assoc_to_uri($search);
			redirect(base_url('freelancer/search/'.$query),'refresh');

		}
		$search_array 				= $this->uri->uri_to_assoc(3);
		$search_query 				= $this->uri->assoc_to_uri($search_array);
		$pg_arr 					= pagination_assoc('p', 3); // helper function

		$count 						= $this->freelancer_model->count_all_search_result($search_array);

		$offset 					= $pg_arr['offset'];

		$url						= base_url("freelancer/search/".$pg_arr['uri']);

		$config = $this->functions->pagination_config($url,$count,$this->per_page_record);
		$config['uri_segment'] 		= $pg_arr['seg'];	

		$this->pagination->initialize($config);

		$data['search_value'] 		= $search_array;
		$data['count'] 				= $count;
		$data['freelancers'] 		= $this->freelancer_model->get_all_freelancers($this->per_page_record, $offset, $search_array);
		$data['countries'] 			= $this->common_model->get_countries_list(); 

		$data['title'] 				= trans('search_results');
		$data['meta_description'] 	= 'your meta description here';
		$data['keywords'] 			= 'meta tags here';
		
		$data['layout'] 			= 'freelancer/freelancers_page';
		$this->load->view('layout', $data);
	}

	//----------------------------------------------------
	// Get all freelancers
	public function get_freelancer_detail()
	{
		$id = $this->input->post('id');

		$this->db->select('*')
		->from('rac_users as ru')
		->join('rac_user_profile as rup', 'ru.id = rup.user_id', 'LEFT')
		->where('ru.id', $id)
		->group_by('ru.id');
		$query = $this->db->get();
		echo json_encode($query->result_array());
	}
	
	//----------------------------------------------------
	// Get all freelancers
	public function get_freelancer_job_detail($userid)
	{
		$this->db->select('firstname, lastname, email, resume')
		->from('rac_users')
		->where('ru.id', $userid)
		->group_by('ru.id');
		$query = $this->db->get();
		echo json_encode($query->result_array());
	}
	

	//-----------------------------------------------------------------------------
	// Contact Freelancer on Freelancers Page
	public function contactFreelancer()
	{
		$json = array();
	
		$id 				= $this->input->post('id');
		$flEmail 			= $this->input->post('fe');
		$name 				= $this->input->post('name');
		$email 				= $this->input->post('email');
		$subject 			= $this->input->post('subject');
		$message 		   	= $this->input->post('message');

        $recaptchaResponse 	= trim($this->input->post('g-recaptcha-response'));
 
        $userIp				= $this->input->ip_address();
     
        $secret 			= $this->config->item('google_secret');
   
        $url				= "https://www.google.com/recaptcha/api/siteverify?secret=".$secret."&response=".$recaptchaResponse."&remoteip=".$userIp;
 
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, $url); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        $output = curl_exec($ch); 
        curl_close($ch);      
         
        $status= json_decode($output, true);
 
        if ($status['success']) {
            exit;
        } else {
			$json['error']['captcha'] = 'Sorry Google Recaptcha Unsuccessful!';
        }
		
        // name validation
        if(empty(trim($name))){
            $json['error']['name'] = trans('enter_your_name');
        }
        // email validation
        if(empty(trim($email))){
            $json['error']['email'] = trans('enter_email');
        }
        // check email validation
        if ($this->validateEmail($email) == FALSE) {
            $json['error']['email'] = 'Please enter valid email address';
        }
        // // check conatct no validation
        // if($this->validateMobile($contactNo) == FALSE) {
        //     $json['error']['contactno'] = 'Please enter valid contact no. format: 9000000001';
        // }
        // comment validation
        if(empty($message)){
            $json['error']['message'] = 'Please enter your message';
        }

		if(empty($json['error']))
		{
			$data = array(
				'freelancer_id' 	=> $id,
				'to' 				=> $flEmail,
				'name' 				=> $name,
				'email'				=> $email,
				'subject' 			=> $subject,
				'message' 			=> $message,
				'created_date' 		=> date('Y-m-d : h:m:s')
			);

			$data 		= $this->security->xss_clean($data); // XSS Clean Data

			$result 	= $this->freelancer_model->contactFreelancer($data);

			// email code
			$this->load->helper('email_helper');
			$from 		= $email;
			$to 		= $flEmail;
			$subject 	= $subject .' - '. $this->general_settings['application_name'];
			$message 	= '<p>Name: '.$name.'</p> 
			<p>Email: '.$email.'</p>
			<p>Message: '.$message.'</p>
			<p>Best Regards <br /> Top Freelancer Team</p>';

			sendEmail($from, $to, $subject, $message, $file = '' , $cc = '');

			if(sendEmail($from, $to, $subject, $message, $file = '' , $cc = '')) {
				$json['success'] = 'Your message has been sent successfully!';
			} else{
				$json['failed'] = 'Something went wrong, please check!';
			}
				
			$this->output->set_header('Content-Type: application/json');
			echo json_encode($json);

		} else {
			$this->output->set_header('Content-Type: application/json');
			echo json_encode($json);

		}
	}

	//---------------------------------------------------------------------
	// Save Freelacers
	public function save_freelancer()
	{
		if(!$this->session->userdata('is_user_login')){
			echo 'not_login';
			exit();
		}
		$fid = $this->input->post('freelancer_id');
		
		$data = array(
			'freelancer_id' 	=> $fid,
			'user_id' 			=> $this->session->userdata('user_id'),
		);

		// if job is aleady saved
		$result = $this->freelancer_model->is_already_saved($data);
		if($result) {
			echo 'already_saved';
			echo $fid;
			exit();
		}

		// save the job
		$result = $this->freelancer_model->save_freelancer($data);
		if($result){
			echo 'saved';
			echo $fid;
			exit();
		}
	}

	public function get_favorite_freelancers() {

		$user_id					= $this->session->userdata('user_id');
		
		$data['freelancers']		= $this->freelancer_model->favoriteFreelancers($user_id);
		$data['countries'] = $this->common_model->get_countries_list(); 

		$data['title'] 				= trans('search_results');
		$data['meta_description'] 	= 'your meta description here';
		$data['keywords'] 			= 'meta tags here';
		
		$data['layout'] 			= 'freelancer/favorite_freelancers_page';
		$this->load->view('layout', $data);		
	}

    // check email validation
    public function validateEmail($email) {
        return preg_match('/^[^\@]+@.*.[a-z]{2,15}$/i', $email)?TRUE:FALSE;
    } 
    // check mobile validation
    public function validateMobile($mobile) {
        return preg_match('/^[0-9]{10}+$/', $mobile)?TRUE:FALSE;
    } 

}

?> 
