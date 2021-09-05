<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job extends Main_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->rbac->check_user_authentication();	// checking user login session (rbac is a library function)
		$this->load->model('job_model');
		$this->load->model('common_model');
		//$this->load->model('employers/package_model', 'package_model');
	}

	//------------------------------------------------------------------------
	// public function expire()
	// {
	// 	$data['title'] = trans('limit_expire');
	// 	$data['layout'] = 'freelancer/my_jobs/limit_expire';
	// 	$this->load->view('layout', $data);
	// }

	//---------------------------------------------------------------------------------------
	public function index()
	{

		$data['countries'] = $this->common_model->get_countries_list(); 
		$user_id = $this->session->userdata('user_id');

		if ($this->input->post('post_job')) {
			$this->form_validation->set_rules('job_title', trans('job_title'),'trim|required|min_length[3]|max_length[50]');
			$this->form_validation->set_rules('publish_vacancy', trans('publish_vacancy'),'trim|required');
			$this->form_validation->set_rules('expiry_date','expiry_date','trim|required');
			$this->form_validation->set_rules('skills', trans('skills'),'trim|required');
			$this->form_validation->set_rules('requirements', trans('vacancy_requirements'),'trim|required|min_length[10]|max_length[500]');
			$this->form_validation->set_rules('experience', trans('min_experience'),'trim|required');
			$this->form_validation->set_rules('lang1', trans('lang1'),'trim|required');
			$this->form_validation->set_rules('city', trans('city'),'trim|required|min_length[3]');
			$this->form_validation->set_rules('country', trans('country'),'trim|required');
			$this->form_validation->set_rules('employment_type', trans('emp_type'),'trim|required');
			$this->form_validation->set_rules('min_salary', trans('day_rate'),'trim|required');
			$this->form_validation->set_rules('max_salary', trans('day_rate'),'trim|required');
			$this->form_validation->set_rules('start_date', trans('start_date'),'trim|required');
			$this->form_validation->set_rules('time_period', trans('time_period'),'trim|required');
			$this->form_validation->set_rules('availability', trans('min_availability'),'trim|required');
			$this->form_validation->set_rules('name', trans('name'),'trim|required');
			$this->form_validation->set_rules('email', trans('email'),'trim|required');


			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors(),
				);

				$this->session->set_flashdata('error_update',$data['errors']);
				redirect(base_url('/myjobs/new-vacancy'));

			}else{
				$data = array(
					'business_id' 		=> $user_id,
					'page_title' 		=> ucfirst($this->input->post('title')).'-'. ucfirst($this->input->post('name')),
					'title' 			=> ucfirst($this->input->post('job_title')),
					'vacancy_info' 		=> $this->input->post('vacancy_info'),
					'skills' 			=> $this->input->post('skills'),
					'requirements' 		=> $this->input->post('requirements'),
					'experience' 		=> $this->input->post('experience'),
					'lang1' 			=> $this->input->post('lang1'),
					'lang2' 			=> $this->input->post('lang2'),
					'nationality' 		=> $this->input->post('nationality'),
					'city' 				=> $this->input->post('city'),
					'country' 			=> $this->input->post('country'),
					'employment_type' 	=> $this->input->post('employment_type'),
					'travel' 			=> $this->input->post('travel_req'),
					'min_salary' 		=> $this->input->post('min_salary'),
					'max_salary' 		=> $this->input->post('max_salary'),
					'pay_type' 			=> $this->input->post('pay_type'),
					'flights' 			=> $this->input->post('flights'),
					'hotel' 			=> $this->input->post('hotel'),
					'start_date' 		=> $this->input->post('start_date'),
					'time_period' 		=> $this->input->post('time_period'),
					'availability' 		=> $this->input->post('availability'),
					'project_phase' 	=> $this->input->post('project_phase'),
					'name' 				=> $this->input->post('name'),
					'phone' 			=> $this->input->post('phone'),
					'email' 			=> $this->input->post('email'),
					'trainer' 			=> $this->input->post('trainer'),
					'consultant' 		=> $this->input->post('consultant'),
					'publish_vacancy' 	=> $this->input->post('publish_vacancy'),
					'expiry_date' 		=> $this->input->post('expiry_date'),
					'created_date' 		=> date('Y-m-d : h:m:s'),
					'updated_date' 		=> date('Y-m-d : h:m:s')
				);
				$data['job_slug'] 		= $this->make_job_slug($this->input->post('job_title'), $this->input->post('city'));

				// RESUME UPLOAD
				if(!empty($_FILES['vacancy_info']['name']))
				{
					$path = "uploads/vacancy_info/";
	
					$result = $this->functions->file_insert($path, 'vacancy_info', 'pdf', '2048000');
				
					if($result['status'] == 1){
						$data['vacancy_info'] = $path.$result['msg'];
					}else{
						$this->session->set_flashdata('error_update', $result['msg']);
						redirect(base_url('/myjobs/new-vacancy'),'refresh');
					}
				} else {
					$data['vacancy_info'] = $this->input->post('vacancy_info');
				}

				$data 					= $this->security->xss_clean($data);

				$result 				= $this->job_model->add_job($data);

				// $featured_data = array(
				// 	'employer_id' => $emp_id,
				// 	'job_id' => $job_id,
				// 	'package_id' => $pkg['package_id'],
				// 	'payment_id' => $pkg['payment_id'],
				// 	'is_featured' => ($pkg['price'] == 0)? 0 : 1
				// );

				//$result = $this->job_model->add_featured_job($featured_data);

				if ($result){
					$this->session->set_flashdata('update_success',trans('job_posted_success'));
					redirect(base_url('/myjobs/new-vacancy'));
				}
				else{
					echo "failed";
				}
			}
		}
		else{

			$data['title'] = trans('post_new_job');
			$data['meta_description'] = 'your meta description here';
			$data['keywords'] = 'meta tags here';
			$data['layout'] = 'freelancer/my_jobs/new_vacancy';
			$this->load->view('layout', $data);
		}
	}

	//----------------------------------------------------
	// Get Job Info

	public function getEventID()
	{

		$this->output->set_header('Content-Type: application/json');
		echo json_encode($json);		
	}

	public function get_job_details()
	{
		$id = $this->input->post('id');
		if ($this->session->userdata('event_id')){
			$id = $this->session->userdata('event_id');
			$this->session->unset_userdata('event_id');
		}

		$this->db->select('*')
		->from('rac_job_post')
		->where('id', $id);
		$query = $this->db->get();
		
		echo json_encode($query->result_array());
	}

	public function listing()
	{
		$emp_id = $this->session->userdata('employer_id');

		$data['job_info'] = $this->job_model->get_all_jobs($emp_id);

		$data['title'] = trans('job_listing');
		$data['meta_description'] = 'your meta description here';
		$data['keywords'] = 'meta tags here';

		$data['layout'] = 'freelancer/my_jobs/job_listing_page';
		$this->load->view('layout', $data);
	}

	//-----------------------------------------------------------------------------------------
	public function edit($job_id=0)
	{
		$emp_id = $this->session->userdata('employer_id');

		$data['countries'] = $this->common_model->get_countries_list(); 


		if ($this->input->post('edit_job')) {
			$this->form_validation->set_rules('job_title','job title','trim|required|min_length[3]');
			$this->form_validation->set_rules('job_type','job type','trim|required');
			$this->form_validation->set_rules('category','category','trim|required');
			$this->form_validation->set_rules('industry','industry','trim|required');
			$this->form_validation->set_rules('min_experience','min experience','trim|required');
			$this->form_validation->set_rules('max_experience','max experience','trim|required');
			$this->form_validation->set_rules('min_salary','min salary','trim|required');
			$this->form_validation->set_rules('max_salary','max salary','trim|required');
			$this->form_validation->set_rules('salary_period','salary period','trim|required');
			$this->form_validation->set_rules('skills','skills','trim|required');
			$this->form_validation->set_rules('description','description','trim|required|min_length[3]');
			$this->form_validation->set_rules('total_positions','total positions','trim|required');
			$this->form_validation->set_rules('gender','gender','trim|required');
			$this->form_validation->set_rules('employment_type','employment type','trim|required');
			$this->form_validation->set_rules('education','education','trim|required');
			$this->form_validation->set_rules('country','country','trim|required');
			$this->form_validation->set_rules('city','city','trim|required');
			$this->form_validation->set_rules('location','location','trim|required');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors(),
				);

				$this->session->set_flashdata('edit_job_error',$data['errors']);
				redirect(base_url('freelancer/my_jobs/edit/'.$job_id),'refresh');

			}
			else{
				$data = array(
					'employer_id' => $emp_id,
					'business_id' => get_business_id_by_employer($emp_id), // helper function
					'title' => $this->input->post('job_title'),
					'job_type' => $this->input->post('job_type'),
					'category' => $this->input->post('category'),
					'industry' => $this->input->post('industry'),
					'experience' => $this->input->post('min_experience').'-'.$this->input->post('max_experience'),
					'salary_period' => $this->input->post('salary_period'),
					'min_salary' => $this->input->post('min_salary'),
					'max_salary' => $this->input->post('max_salary'),
					'description' => $this->input->post('description'),
					'skills' => $this->input->post('skills'),
					'total_positions' => $this->input->post('total_positions'),
					'gender' => $this->input->post('gender'),
					'education' => $this->input->post('education'),
					'employment_type' => $this->input->post('employment_type'),
					'country' => $this->input->post('country'),
					'city' => $this->input->post('city'),
					'location' => $this->input->post('location'),
					'expiry_date' => $this->input->post('expiry_date'),
					'updated_date' => date('Y-m-d : h:m:s')
				);
				
				$data['job_slug'] = $this->make_job_slug($this->input->post('job_title'), $this->input->post('city'));


				$data = $this->security->xss_clean($data);
				$result = $this->job_model->edit_job($data,$job_id,$emp_id);

				if ($result) {
					$this->session->set_flashdata('update_success',trans('job_updated_success'));
					redirect(base_url('freelancer/my_jobs/listing'));
				}else{
					echo "failed";
				}
			}
		}
		else{
			$emp_id = $emp_id;
			$data['job_detail'] = $this->job_model->get_job_by_id($job_id,$emp_id);

			$data['title'] = trans('edit_job');
			$data['meta_description'] = 'your meta description here';
			$data['keywords'] = 'meta tags here';

			$data['layout'] = 'freelancer/my_jobs/edit_job_page';
			$this->load->view('layout', $data);
		}
	}

	//-----------------------------------------------------------------------------------------
	public function delete($id=0)
	{
		$emp_id = $this->session->userdata('employer_id');
		
		$this->db->where('id',$id);
		$this->db->where('employer_id',$emp_id);
		$this->db->delete('rac_job_post');
		$this->session->set_flashdata('deleted',trans('job_deleted_success'));
		redirect(base_url('freelancer/my_jobs/listing'));

	}

	//-----------------------------------------------------------------------------------------
	// make job slugon
	private function make_job_slug($job_title, $city){
		$final_job_url ='';
		$job_title = trim($job_title);
		$city = get_city_name($city);
		$job_title_slug = make_slug($job_title). '-job-in-'.make_slug($city) ;  // make slug is a helper function
		$final_job_url = $job_title_slug;
		return $final_job_url;
	}

	//-----------------------------------------------------------------------------
	// Contact Freelancer on Freelancers Page
	public function contactBusiness()
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
   
        $url		="https://www.google.com/recaptcha/api/siteverify?secret=".$secret."&response=".$recaptchaResponse."&remoteip=".$userIp;
 
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



}// endclass
