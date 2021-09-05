<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends Main_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->rbac->check_user_authentication();	// checking user login session (rbac is a library function)
		$this->load->model('account_model');
		$this->load->model('profile_model');
		$this->load->model('common_model');
	}

	//----------------------------------------------------------------------------------
	// Get My Account
	public function index()
	{

		$user_id = $this->session->userdata('user_id');
		$data['countries'] 		= $this->common_model->get_countries_list(); 
		$data['user_info'] 		= $this->profile_model->get_user_by_id($user_id);
		$data['business_info'] 	= $this->common_model->get_business_info($user_id);

		$data['title'] = trans('my_account');
		$data['meta_description'] = 'your meta description here';
		$data['keywords'] = 'meta tags here';
		
		$data['layout'] = 'freelancer/account';
		$this->load->view('layout', $data);
	}

		
	//-------------------------------------------------------------------------------
	public function dashboard()
	{
		$data['total_posted_jobs'] = $this->account_model->total_posted_job();
		$data['current_package'] = $this->package_model->get_active_package();

		// featured job post
		$data['total_featured_jobs'] = $this->job_model->count_posted_jobs($data['current_package']['package_id'], 1, $data['current_package']['payment_id']);

		$data['title'] = trans('label_dashboard');
		$data['layout'] = 'freelancer/dashboard';
		$this->load->view('layout', $data);
	}

	//-------------------------------------------------------------------------------
	public function change_email()
	{	
		
		if ($this->input->post('submit')) {

			$user_id = $this->session->userdata('user_id');

			$this->form_validation->set_rules('current_email',trans('current_email'),'trim|required|min_length[7]|valid_email');
			$this->form_validation->set_rules('new_email',trans('new_email'),'trim|required|min_length[7]|valid_email');
			$this->form_validation->set_rules('confirm_email',trans('confirm_email'),'trim|required|min_length[7]|valid_email|matches[new_email]');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('error_update', $data['errors']);
				redirect(base_url('account'),'refresh');

			}else{
				$data = array(
					'id' 				=> $user_id,
					'current_email' 	=> $this->input->post('current_email'),
					'new_email' 		=> $this->input->post('new_email'),
					'confirm_email' 	=> $this->input->post('confirm_email'),
				);

				$data = $this->security->xss_clean($data); // XSS Clean
				
				$result = $this->account_model->update_email($data,$user_id);
				
				if($result) {
					$this->session->set_flashdata('update_success',trans('email_updated_success'));
					redirect(base_url('account'));
				} else {
					$this->session->set_flashdata('update_failed',trans('current_email_incorrect'));
					redirect(base_url('account'));
				}
			}
		}
		else{
			$data['title'] = trans('my_account');
			$data['layout'] = 'freelancer/account';
			$this->load->view('layout', $data);
		}
	}

	//-------------------------------------------------------------------------------
	public function change_password()
	{	
		
		if ($this->input->post('submit')) {

			$user_id = $this->session->userdata('user_id');

			$this->form_validation->set_rules('old_password','old password','trim|required|min_length[3]');
			$this->form_validation->set_rules('new_password','new password','trim|required|min_length[3]');
			$this->form_validation->set_rules('confirm_password','confirm password','trim|required|min_length[3]|matches[new_password]');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);

				$this->session->set_flashdata('error_update', $data['errors']);
				redirect(base_url('account'),'refresh');

			}else{

				$data = array(
					'id' => $user_id,
					'old_password' => $this->input->post('old_password'),
					'password' => password_hash($this->input->post('new_password'), PASSWORD_BCRYPT),
				);

				$data = $this->security->xss_clean($data); // XSS Clean
				
				$result = $this->account_model->update_password($data,$user_id);
				
				if($result) {
					$this->session->set_flashdata('update_success',trans('password_updated_success'));
					
					redirect(base_url('account'));
				}else{
					$this->session->set_flashdata('update_failed',trans('old_pass_incorrect'));
					redirect(base_url('account'));
				}
			}
		}
		else{
			$data['title'] = trans('my_account');
			$data['layout'] = 'freelancer/account';
			$this->load->view('layout', $data);
		}
	}

	//-------------------------------------------------------------------------------
	public function update_info()
	{	
		
		if ($this->input->post('submit')) {

			$user_id = $this->session->userdata('user_id');

			$this->form_validation->set_rules('firstname', trans('first_name'),'trim|required|min_length[3]');
			$this->form_validation->set_rules('lastname', trans('last_name'),'trim|required|min_length[3]');
			$this->form_validation->set_rules('mobile_no',trans('phone'),'trim|required|min_length[3]');
			$this->form_validation->set_rules('country',trans('country'),'required|trim');
			$this->form_validation->set_rules('city',trans('city'),'required|trim');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);

				$this->session->set_flashdata('error_update', $data['errors']);
				redirect(base_url('account'),'refresh');

			}else{

				$data = array(
					'firstname' 	=> $this->input->post('firstname'),
					'lastname' 		=> $this->input->post('lastname'),
					'mobile_no' 	=> $this->input->post('mobile_no'),
					'country' 		=> $this->input->post('country'),
					'city' 			=> $this->input->post('city'),
				);

				if ($this->input->post('business_name')) {
					$data1 = array(
						'business_name' 	=> $this->input->post('business_name'),
						'is_active' 		=> '1',
					);
					$data1 = $this->security->xss_clean($data1); // XSS Clean
					$result = $this->account_model->update_business($data1, $user_id);
				}

				$data = $this->security->xss_clean($data); // XSS Clean
				
				$result = $this->account_model->update_user_info($data, $user_id);

				if($result) {
					$this->session->set_flashdata('update_success',trans('user_info_update'));
					
					redirect(base_url('account'));
				}else{
					$this->session->set_flashdata('update_failed',trans('user_info_incorrect'));
					redirect(base_url('account'));
				}
			}
		}
		else{
			$data['title'] = trans('my_account');
			$data['layout'] = 'freelancer/account';
			$this->load->view('layout', $data);
		}
	}

	//-------------------------------------------------------------------------------
	public function business_update()
	{	
		
		if ($this->input->post('submit')) {

			$user_id = $this->session->userdata('user_id');

			if( $this->input->post('biz_entity') == "1") {
				$this->form_validation->set_rules('business_name', trans('business_name'),'trim|required|min_length[3]');
		
				if ($this->form_validation->run() == FALSE) {
					$data = array(
						'errors' => validation_errors()
					);

					$this->session->set_flashdata('error_update', $data['errors']);
					redirect(base_url('account'),'refresh');

				}else{

					$data = array(
						'is_active' 		=> $this->input->post('biz_entity'),
						'business_name'		=> $biz_name,
						'receive_vac_email'	=> $this->input->post('receive_vac_email'),
					);

					$data = $this->security->xss_clean($data); // XSS Clean
					
					$result = $this->account_model->update_business($data, $user_id);

					if($result) {
						$this->session->set_flashdata('update_success',trans('business_name_update'));
						redirect(base_url('account'));
					}else{
						$this->session->set_flashdata('update_failed',trans('business_incorrect'));
						redirect(base_url('account'));
					}
				}
			} else {

					$data = array(
						'is_active' 		=> 0,
						'business_name'		=> '',
						'receive_vac_email'	=> $this->input->post('receive_vac_email'),
					);

					$data = $this->security->xss_clean($data); // XSS Clean
					
					$result = $this->account_model->update_business($data, $user_id);

					if($result) {
						$this->session->set_flashdata('update_success',trans('business_name_update'));
						redirect(base_url('account'));
					}else{
						$this->session->set_flashdata('update_failed',trans('business_incorrect'));
						redirect(base_url('account'));
					}
			}
		}
		else{
			$data['title'] = trans('my_account');
			$data['layout'] = 'freelancer/account';
			$this->load->view('layout', $data);
		}
	}

	//------------------------------------------------------------
	//Get Cities
	public function get_country_cities()
	{
		$cities = $this->db->select('*')->where('country_id',$this->input->post('country'))->get('rac_cities')->result_array();
	    $options = array('' => 'Select City') + array_column($cities,'name','id');
	    $html = form_dropdown('city',$options,'','class="form-control select2" required');
		$error =  array('msg' => $html);
		echo json_encode($error);
	}


}// endClass
