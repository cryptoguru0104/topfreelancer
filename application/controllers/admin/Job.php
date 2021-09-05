<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Job extends MY_Controller 
{ 
	function __construct()
	{
		parent::__construct();
		$this->load->model('admin/job_model', 'job_model');
		$this->load->helper('email_helper');
		$this->load->library('mailer');
		$this->load->library('datatable');
	}

	//------------------------------------------------
	public function index()
	{
		$this->session->unset_userdata('job_search_type');
		$this->session->unset_userdata('job_search_from');
		$this->session->unset_userdata('job_search_to');
		$this->session->unset_userdata('job_search_industry');
		$this->session->unset_userdata('job_search_category');
		$this->session->unset_userdata('job_search_location');

		$data['countries'] = $this->common_model->get_countries_list(); 

		$data['title'] = 'Job List';
		$data['view']  = 'admin/job/job_list';
		$this->load->view('admin/layout', $data);
	}

	//------------------------------------------------
	public function datatable_json()
	{				   				   
		$records = $this->job_model->GetAll();
        $data = array();

        $i= 1;
        foreach ($records['data']  as $row) 
		{
			$buttoncontroll = '<a class="btn btn-xs btn-success" href='.base_url("admin/job/edit/".$row['id']).' title="View" > 
				 <i class="fa fa-eye"></i></a>&nbsp;&nbsp;

				  <a class="edit btn btn-xs btn-primary" href='.base_url("admin/job/edit/".$row['id']).' title="Edit" > 
				 <i class="fa fa-edit"></i></a>&nbsp;&nbsp;

				 <a class="btn-delete btn btn-xs btn-danger" href='.base_url("admin/job/del/".$row['id']).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> 
				 <i class="fa fa-trash-o"></i></a>';
			
			$data[]= array(
				$i++,
				$row['title'],
				'<a class="edit btn btn-xs btn-info mb-3" href='.base_url("admin/applicants/view/".$row['id']).' title="Applicants" > 
				 Applied [ '.$row['cand_applied'].' ]
				</a>
				<a class="edit btn btn-xs btn-info" href='.base_url("admin/applicants/shortlisted/".$row['id']).' title="Applicants" > 
				 Shortlisted [ '.$row['total_shortlisted'].' ]
				</a>',
				get_country_name($row['country']), // same as above
				date_time($row['created_date']),
				$row['publish_vacancy'],
				$buttoncontroll
			);
        }
		$records['data'] = $data;
        echo json_encode($records);						   
	}

	//--------------------------------------------------
	public function search()
	{
		$this->session->set_userdata('job_search_from',$this->input->post('job_search_from'));
		$this->session->set_userdata('job_search_to',$this->input->post('job_search_to'));
		$this->session->set_userdata('job_search_industry',$this->input->post('job_search_industry'));
		$this->session->set_userdata('job_search_category',$this->input->post('job_search_category'));
		$this->session->set_userdata('job_search_location',$this->input->post('job_search_location'));
	}

	//---------------------------------------------------------------------------
	// Post New Vacancy 
	function post()
	{	
		$admin_id = $this->session->userdata('admin_id');
		

		$data['countries'] = $this->common_model->get_countries_list(); 
		$data['businesses'] = $this->job_model->get_all_businesses(); 

		if ($this->input->post('post_job')) {
			$this->form_validation->set_rules('employer_id','business','trim|required');
			$this->form_validation->set_rules('job_title','job title','trim|required|min_length[3]');
			$this->form_validation->set_rules('job_type','job type','trim|required');
			$this->form_validation->set_rules('category','category','trim|required');
			$this->form_validation->set_rules('industry','industry','trim|required');
			$this->form_validation->set_rules('min_experience','min experience','trim|required');
			$this->form_validation->set_rules('max_experience','max experience','trim|required');
			$this->form_validation->set_rules('salary_period','salary period','trim|required');
			$this->form_validation->set_rules('min_salary','min salary','trim|required');
			$this->form_validation->set_rules('max_salary','max salary','trim|required');
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

				$this->session->set_flashdata('error',$data['errors']);
				redirect(base_url('admin/job/post'),'refresh');

			}else{
				$data = array(
					'admin_id' => $admin_id,
					'business_id' => $this->input->post('employer_id'),
					'title' => $this->input->post('job_title'),
					'job_type' => $this->input->post('job_type'),
					'category' => $this->input->post('category'),
					'industry' => $this->input->post('industry'),
					'experience' => $this->input->post('min_experience').'-'.$this->input->post('max_experience'),
					'min_salary' => $this->input->post('min_salary'),
					'max_salary' => $this->input->post('max_salary'),
					'salary_period' => $this->input->post('salary_period'),
					'description' => $this->input->post('description'),
					'skills' => $this->input->post('skills'),
					'total_positions' => $this->input->post('total_positions'),
					'gender' => $this->input->post('gender'),
					'education' => $this->input->post('education'),
					'employment_type' => $this->input->post('employment_type'),
					'country' => $this->input->post('country'),
					'city' => $this->input->post('city'),
					'location' => $this->input->post('location'),
					'created_date' => date('Y-m-d : h:m:s'),
					'updated_date' => date('Y-m-d : h:m:s')
				);
				$data['job_slug'] = $this->make_job_slug($this->input->post('job_title'), $this->input->post('city'));

				$data = $this->security->xss_clean($data);
				$result = $this->job_model->add_job($data);

				if ($result){
					$this->session->set_flashdata('success','Congratulation! Job has been Posted successfully');
					redirect(base_url('admin/job'));
				}
				else{
					echo "failed";
				}
			}
		}
		else{
			$data['title'] = 'Post Job';
			$data['view']  = 'admin/job/job_add';
			$this->load->view('admin/layout', $data);
		}
	}
	
	//--------------------------------------------------------	
	// Edit Job
	public function edit($job_id=0)
	{		
		$admin_id = $this->session->userdata('admin_id');

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
				redirect(base_url('admin/job/edit/'.$job_id),'refresh');

			}
			else{
				$data = array(
					'admin_id' => $admin_id,
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
					'updated_date' => date('Y-m-d : h:m:s')
				);
				$data['job_slug'] = $this->make_job_slug($this->input->post('job_title'), $this->input->post('city'));


				$data = $this->security->xss_clean($data);
				$result = $this->job_model->edit_job($data,$job_id,$admin_id);

				if ($result) {
					$this->session->set_flashdata('success','Congratulation! Job has been Updated successfully');
					redirect(base_url('admin/job'));
				}else{
					echo "failed";
				}
			}
		}
		else{
			$data['job_detail'] = $this->job_model->get_job_by_id($job_id,$admin_id);

			$data['title'] = 'Edit Job';
			$data['view']  = 'admin/job/job_edit';
			$this->load->view('admin/layout', $data);
		}  
	}

	//---------------------------------------------------------------------------------------
	// Delete the job
	public function del($id=0)
	{
		$this->db->where('id',$id);
		$this->db->delete('rac_job_post');

		$this->session->set_flashdata('success','Congratulation! Job has been Deleted successfully');
		redirect(base_url('admin/job'),'refresh');

	}

	//-----------------------------------------------------
	// Get the Freelancer who applied the job
	public function job_applicants($id=0)
	{
		$data['applicants_ids'] = $this->job_model->getJobApplicant($id);
		foreach($data['applicants_ids'] as $user)
		{
			$user_id =  $user['user_id'];
			$data['user_data'][] = $this->job_model->getApplicantData($user_id);
		}
		$data['title'] = 'Job Applicants'; 
		$data['view'] = 'admin/job/job_applicants'; 
		$this->load->view('admin/layout', $data);  	
	}	
	
	
	//--------------------------------------------------
	// Sending email to the user who applied the job
	function send_email(){
		
		$to = $this->input->post('email');
		$subject = $this->input->post('subject');
		$message = $this->input->post('message');
		$body = $this->mailer->Tpl_CustomMsg('Dear Freelancer ',$message);
		$cc = '';
		$file = '';
		
		$check = sendEmail($from='', $to, $subject, $body, $file, $cc);
					  
		  if( $check ){
			  echo 'success';
		  }
	}
	
	//--------------------------------------------------
	// sending email to user for schedualing interview
	function schedual_interview(){
		
		$date = $this->input->post('date');
		$time_from = $this->input->post('time_from');
		$time_to = $this->input->post('time_to');	
		$time = $time_from.' to '.$time_to;
		$location = $this->input->post('location');		
		$to = $this->input->post('email');
		$interviewers = $this->input->post('interviewers');
		$subject = 'Jobs Pro : Interview Call';
		$message = $this->input->post('message');
		$body= $this->mailer->Tpl_InterviewMsg('Dear Freelancer ',$date,$time,$location,$interviewers,$message);
		$cc = '';
		$file = '';
		
		$check = sendEmail($from='', $to, $subject, $body, $file, $cc);
					  
		  if( $check ){
			  echo 'success';
		  }
		
	}

	//-----------------------------------------------------------------------------------------
	// make job slug
	private function make_job_slug($job_title, $city){
		$final_job_url ='';
		$job_title = trim($job_title);
		$city = get_city_name($city);
		$job_title_slug = make_slug($job_title). '-job-in-'.make_slug($city) ;  // make slug is a helper function
		$final_job_url = $job_title_slug;
		return $final_job_url;
	}
}	

?>
