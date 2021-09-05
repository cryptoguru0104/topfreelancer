<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends Main_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->rbac->check_user_authentication();	// checking user login session (rbac is a library function)
		$this->load->model('profile_model');
		$this->load->model('common_model');
	}

	//-----------------------------------------------------------------------------------
	// Update Personal Info
	public function index()
	{		
		$data['countries'] = $this->common_model->get_countries_list(); 
		$data['educations'] = $this->common_model->get_educations_list(); 

		$user_id = $this->session->userdata('user_id');

		if ($this->input->post('update'))
		{
			
			// $this->form_validation->set_rules('profile_picture', trans('profile_picture'),'trim|xss_clean|required');
			$this->form_validation->set_rules('description', trans('profile_summary'),'trim|required|min_length[10]|max_length[800]');
			$this->form_validation->set_rules('profile_header', trans('profile_header'),'trim|required|min_length[5]|max_length[100]');

			// $this->form_validation->set_rules('resume', trans('resume'),'trim|required');
			$this->form_validation->set_rules('skills', trans('skills'),'trim|required');
			

			$this->form_validation->set_rules('experience', trans('total_experience'),'trim|required');
			$this->form_validation->set_rules('education_level', trans('education'),'trim|required');
			$this->form_validation->set_rules('nationality', trans('nationality'),'trim|required');
			$this->form_validation->set_rules('residency', trans('residency_visa'),'trim|required');
			$this->form_validation->set_rules('lang1', trans('language'),'trim|required');
			$this->form_validation->set_rules('lang2', trans('language'),'trim|required');

			$this->form_validation->set_rules('availability', trans('availability'),'trim|required');
			$this->form_validation->set_rules('start_date', trans('start_date'),'trim|required');
			$this->form_validation->set_rules('employment', trans('emp_type'),'trim|required');
			$this->form_validation->set_rules('travel_willingness', trans('travel_willingness'),'trim|required');
			$this->form_validation->set_rules('day_rate', trans('day_rate'),'trim|required');
			$this->form_validation->set_rules('publish_profile', trans('publish_profile'),'trim|required');

			
			if ($this->form_validation->run() == FALSE) 
			{
				$data = array(
					'errors' => validation_errors(),
					'ok_publish' => $this->input->post('ok_publish'),
					'profile_picture' => $this->input->post('profile_picture'),
					'description' => $this->input->post('description'),
					'profile_header' => $this->input->post('profile_header'),					
					'linkedin_link' => $this->input->post('linkedin_link'),
					'page_link' => $this->input->post('page_link'),
					'resume' => $this->input->post('resume'),
					'profile_completed' => 1,
					'updated_date' => date('Y-m-d : h:m:s'),
					'user_id' => $user_id,
					'business_name' => $this->input->post('business_name'),//
					'skills' => $this->input->post('skills'),
					'experience' => $this->input->post('experience'),
					'education_level' => $this->input->post('education_level'),
					'nationality' => $this->input->post('nationality'),
					'residency' => $this->input->post('residency'),
					'lang1' => $this->input->post('lang1'),
					'lang2' => $this->input->post('lang2'),
					'availability' => $this->input->post('availability'),
					'start_date' => $this->input->post('start_date'),					
					'employment' => $this->input->post('employment'),
					'travel_willingness' => $this->input->post('travel_willingness'),
					'day_rate' => $this->input->post('day_rate'),
					'trainer' => $this->input->post('trainer'),
					'consultant' => $this->input->post('consultant'),
					'publish_profile' => $this->input->post('publish_profile'),
					'updated_date' => date('Y-m-d : h:m:s')
				);

				$this->session->set_flashdata('error_update', $data['errors']);
				$this->session->set_flashdata('dt', $data);

				redirect(base_url('profile'),'refresh');
				
			}
			else
			{
				$data = array(
					
					'ok_publish' => $this->input->post('ok_publish'),
					'profile_picture' => $this->input->post('profile_picture'),
					'description' => $this->input->post('description'),
					'profile_header' => $this->input->post('profile_header'),					
					'linkedin_link' => $this->input->post('linkedin_link'),
					'business_name' => $this->input->post('business_name'),//
					'page_link' => $this->input->post('page_link'),
					'resume' => $this->input->post('resume'),
					'profile_completed' => 1,
					'updated_date' => date('Y-m-d : h:m:s')
				);

				$data1 = array(
					'user_id' => $user_id,
					'skills' => $this->input->post('skills'),
					'experience' => $this->input->post('experience'),
					'education_level' => $this->input->post('education_level'),
					'nationality' => $this->input->post('nationality'),
					'residency' => $this->input->post('residency'),
					'lang1' => $this->input->post('lang1'),
					'lang2' => $this->input->post('lang2'),
					'availability' => $this->input->post('availability'),
					'start_date' => $this->input->post('start_date'),					
					'employment' => $this->input->post('employment'),
					'travel_willingness' => $this->input->post('travel_willingness'),
					'day_rate' => $this->input->post('day_rate'),
					'trainer' => $this->input->post('trainer'),
					'consultant' => $this->input->post('consultant'),
					'publish_profile' => $this->input->post('publish_profile'),
					'updated_date' => date('Y-m-d : h:m:s')
				);

					// PROFILE PICTURE
					if(!empty($_FILES['profile_picture']['name']))
					{
						$path = 'uploads/profile_pictures/';
						
						$this->functions->delete_file($this->input->post('old_profile_picture'));

						$result = $this->functions->file_insert($path, 'profile_picture', 'image', '2000000');
						if($result['status'] == 1){
							$data['profile_picture'] = $path.$result['msg'];
						}
						else{

							$this->session->set_flashdata('error_update', $result['msg']);
							redirect(base_url('profile'),'refresh');
						}
					}

					// RESUME UPLOAD
					if(!empty($_FILES['resume']['name']))
					{
						
						$path = "uploads/resume/";

						$this->functions->delete_file($this->input->post('old_resume'));
			
						$result = $this->functions->file_insert($path, 'resume', 'pdf', '50480000');
			
						if($result['status'] == 1){
							$data['resume'] = $path.$result['msg'];
						}
						else{
							$this->session->set_flashdata('error_update', $result['msg']);
							redirect(base_url('profile'),'refresh');
						}
					} else {
						$data['resume'] = $this->input->post('old_resume');
					}
					// RESUME UPLOAD END

				$data = $this->security->xss_clean($data); // XSS Clean
				$data1 = $this->security->xss_clean($data1); // XSS Clean

				$result = $this->profile_model->update_user($data, $data1, $user_id);

				if ($result) 
				{
					$this->session->set_flashdata('update_success',trans('profile_update_msg'));
					redirect(base_url('profile'));
				}
			}
		}
		
		else{

			$data['countries'] = $this->common_model->get_countries_list(); 
			$data['user_info'] = $this->profile_model->get_user_by_id($user_id);
			$data['education'] = $this->common_model->get_educations_list();
			$data['econsultation_info'] = $this->profile_model->get_econsultation_info($user_id);


			$data['title'] = trans('profile');
			$data['meta_description'] = 'your meta description here';
			$data['keywords'] = 'meta tags here';
		
			$data['layout'] = 'freelancer/user_profile_page';
			$this->load->view('layout', $data);
		}
	}

	public function updateEconsultation(){
		
		$user_id = $this->session->userdata('user_id');

		if ($this->input->post('updateEconsultation'))
		{
		$this->form_validation->set_rules('conference_name', trans('conference_name'),'trim|required');
		$this->form_validation->set_rules('conference_link', trans('conference_link'),'trim|required');
		$this->form_validation->set_rules('conference_invmsg', trans('conference_invmsg'),'trim|required');
		$this->form_validation->set_rules('payment_name', trans('payment_name'),'trim|required');
		$this->form_validation->set_rules('payment_link', trans('payment_link'),'trim|required');
		$this->form_validation->set_rules('payment_details', trans('payment_details'),'trim|required');
		$this->form_validation->set_rules('econsultation_hourly_rate', trans('econsultation_hourly_rate'),'trim|required');
		$this->form_validation->set_rules('timezone', trans('timezone'),'trim|required');
		
		if ($this->form_validation->run() == FALSE) 
		{
			$data = array(
				'errors' => validation_errors()
			);

			$this->session->set_flashdata('error_update', $data['errors']);
			redirect(base_url('profile'),'refresh');

		}
		else
		{
			$data = array(
				'user_id' => $user_id,
				'econsultation_participate' => $this->input->post('econsultation_participate'),
				'conference_details' => $this->input->post('conference_details'),
				'conference_name' => $this->input->post('conference_name'),
				'conference_link' => $this->input->post('conference_link'),					
				'conference_invmsg' => $this->input->post('conference_invmsg'),
				'payment_name' => $this->input->post('payment_name'),
				'payment_link' => $this->input->post('payment_link'),
				'payment_details' => $this->input->post('payment_details'),
				'econsultation_hourly_rate' => $this->input->post('econsultation_hourly_rate'),
				'timezone' => $this->input->post('timezone'),
			);

			$data = $this->security->xss_clean($data); // XSS Clean
			$result = $this->profile_model->update_user_econsultation($data,$user_id);
			if ($result) 
			{
				$this->session->set_flashdata('update_success','econsultant updated successfully');
			 
				redirect(base_url('profile'));
			}
			
		}
	}
	else{

		$data['countries'] = $this->common_model->get_countries_list(); 
		$data['user_info'] = $this->profile_model->get_user_by_id($user_id);
		$data['education'] = $this->common_model->get_educations_list();

		$data['title'] = trans('profile');
		$data['meta_description'] = 'your meta description here';
		$data['keywords'] = 'meta tags here';
	
		$data['layout'] = 'freelancer/user_profile_page';
		$this->load->view('layout', $data);
		}
	}

	// eConsultant Booking Page
	public function eConsultantBooking(){
		$user_id = $this->session->userdata('user_id');


		$data['booking_info'] = $this->profile_model->get_booking_info($user_id);


		$data['title'] = "Econsultant Booking";
		$data['meta_description'] = 'your meta description here';
		$data['keywords'] = 'meta tags here';
	
		$data['layout'] = 'freelancer/profile/econsultant_booking';
		$this->load->view('layout', $data);
		
	}

	//-----------------------------------------------------------------------------------
	// User Skills
	public function skill()
	{
		if ($this->input->post('update_skill')){

			$user_id = $this->session->userdata('user_id');
			$this->form_validation->set_rules('new_skill','new skill','trim|required|min_length[3]');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' =>validation_errors()
				);

				$this->session->set_flashdata('error', $data['errors']);
				redirect(base_url('profile'),'refresh');
			}
			else{
				$data = array(
					'user_id' => $user_id,
					'new_skill' => $this->input->post('new_skill'),
					'experience' => $this->input->post('experience'),
					'updated_date' => date('Y-m-d : h:m:s')
				);

				$result = $this->profile_model->update_skill($data,$user_id);

				if ($result) {
					$this->session->set_flashdata('update_skill_success',trans('skill_updated'));
					redirect(base_url('profile'));
				}
			}
		}
		else{
			$user_id = $this->session->userdata('user_id');
			$data['user_info'] = $this->profile_model->get_user_by_id($user_id);

			$data['title'] = 'title here';
			$data['meta_description'] = 'your meta description here';
			$data['keywords'] = 'meta tags here';

			$data['layout'] = 'freelancer/user_profile_page';
			$this->load->view('layout', $data);
		}
	}


	//----------------------------------------------------------------------
	// User Summary
	public function summary()
	{
		if ($this->input->post('update_summary')){

			$user_id = $this->session->userdata('user_id');
			$this->form_validation->set_rules('summary','summary','trim|required|min_length[20]');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' =>validation_errors()
				);

				$this->session->set_flashdata('error_update_summary', $data['errors']);
				redirect(base_url('profile'),'refresh');
			}else{
				$data = array(
					'user_id' => $user_id,
					'summary' => $this->input->post('summary'),
					'updated_date' => date('Y-m-d : h:m:s')
				);

				$result = $this->profile_model->update_summary($data,$user_id);

				if ($result) {
					$this->session->set_flashdata('update_summary_success',trans('summary_updated'));
					redirect(base_url('profile'));
				}
			}
		}
		else{
			$user_id = $this->session->userdata('user_id');
			$data['user_info'] = $this->profile_model->get_user_by_id($user_id);

			$data['title'] = 'title here';
			$data['meta_description'] = 'your meta description here';
			$data['keywords'] = 'meta tags here';

			$data['layout'] = 'freelancer/user_profile_page';
			$this->load->view('layout', $data);
		}
	}

	
}
