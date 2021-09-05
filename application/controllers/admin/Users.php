<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/user_model', 'admin_user_model');
		$this->load->model('profile_model', 'profile_model');
		$this->load->library('datatable'); // loaded my custom serverside datatable library
		$this->load->model('common_model');
		$this->lang->load('user_lang', 'english');
		$this->lang->load('home_lang', 'english');
	}

	//-------------------------------------------------------
	public function index()
	{
		$data['view'] = 'admin/users/user_list';
		$this->load->view('admin/layout', $data);
	}
	
	//-------------------------------------------------------
	public function datatable_json()
	{				   					   
		$records = $this->admin_user_model->get_all_users();
		$data = array();
		foreach ($records['data']  as $row) 
		{  
			$status = ($row['is_active'] == 0)? 'Deactive': 'Active'.'<span>';
			$data[]= array(
				$row['id'],
				$username = $row['firstname'].' '.$row['lastname'],
				$row['email'],
				get_country_name($row['country']),
				'<span class="btn btn-success btn-flat btn-xs" title="status">'.$status.'<span>',				
				'<a title="Delete" class="delete btn btn-sm btn-danger pull-right" data-href="'.base_url('admin/users/del/'.$row['id']).'" data-toggle="modal" data-target="#confirm-delete"> <i class="fa fa-trash-o"></i></a>
				<a title="Edit" class="update btn btn-sm btn-primary pull-right" href="'.base_url('admin/users/edit/'.$row['id']).'"> <i class="fa fa-pencil-square-o"></i></a>
				<a title="View" class="view btn btn-sm btn-info pull-right" href="'.base_url('admin/users/edit/'.$row['id']).'"> <i class="fa fa-eye"></i></a>'
			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
	}

	//-------------------------------------------------------
	public function add()
	{
		if($this->input->post('submit')){
			$this->form_validation->set_rules('firstname', 'Firstname', 'trim|required');
			$this->form_validation->set_rules('lastname', 'Lastname', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
			$this->form_validation->set_rules('mobile_no', 'Number', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				$data['view'] = 'admin/users/user_add';
				$this->load->view('admin/layout', $data);
			}
			else{
				$data = array(
					'firstname' => $this->input->post('firstname'),
					'lastname' => $this->input->post('lastname'),
					'email' => $this->input->post('email'),
					'mobile_no' => $this->input->post('mobile_no'),
					'password' =>  password_hash($this->input->post('password'), PASSWORD_BCRYPT),
					'created_date' => date('Y-m-d : h:m:s'),
					'updated_date' => date('Y-m-d : h:m:s'),
				);
				$data = $this->security->xss_clean($data);
				$result = $this->profile_model->add_user($data);
				if($result){
					$this->session->set_flashdata('msg', 'User has been added successfully!');
					redirect(base_url('admin/users'));
				}
			}
		}
		else{
			$data['view'] = 'admin/users/user_add';
			$this->load->view('admin/layout', $data);
		}
		
	}

	//-------------------------------------------------------
	public function edit($id = 0)
	{
		if($this->input->post('submit')){

			$this->form_validation->set_rules('profile_picture', trans('profile_picture'),'trim|xss_clean|required');
			$this->form_validation->set_rules('description', trans('profile_summary'),'trim|required|min_length[10]|max_length[800]');
			$this->form_validation->set_rules('profile_header', trans('profile_header'),'trim|required|min_length[5]|max_length[100]');

			$this->form_validation->set_rules('resume', trans('resume'),'trim|required');
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


			if ($this->form_validation->run() == FALSE) {
				$data['user'] = $this->profile_model->get_user_by_id($id);
				$data['view'] = 'admin/users/user_edit';
				$this->load->view('admin/layout', $data);
			} else {
				$data = array(
					'firstname' => $this->input->post('firstname'),
					'lastname' => $this->input->post('lastname'),
					'email' => $this->input->post('email'),
					'mobile_no' => $this->input->post('mobile_no'),
					'country' => $this->input->post('country'),
					'city' => $this->input->post('city'),
					'ok_publish' => $this->input->post('ok_publish'),
					'profile_picture' => $this->input->post('profile_picture'),
					'description' => $this->input->post('description'),
					'profile_header' => $this->input->post('profile_header'),					
					'linkedin_link' => $this->input->post('linkedin_link'),
					'page_link' => $this->input->post('page_link'),
					'resume' => $this->input->post('resume'),
					'profile_completed' => 1,
					'updated_date' => date('Y-m-d : h:m:s')
				);

				$data1 = array(
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

						$result = $this->functions->file_insert($path, 'profile_picture', 'image', '150000');
						if($result['status'] == 1){
							$data['profile_picture'] = $path.$result['msg'];
						}
						else{

							$this->session->set_flashdata('error_update', $result['msg']);
							$data['user'] = $this->profile_model->get_user_by_id($id);
							$data['view'] = 'admin/users/user_edit';
							$this->load->view('admin/layout', $data);
						}
					}

					// RESUME UPLOAD
					if(!empty($_FILES['resume']['name']))
					{
						
						$path = "uploads/resume/";

						$this->functions->delete_file($this->input->post('old_resume'));
			
						$result = $this->functions->file_insert($path, 'resume', 'pdf', '2048000');
			
						if($result['status'] == 1){
							$data['resume'] = $path.$result['msg'];
						}
						else{
							$this->session->set_flashdata('error_update', $result['msg']);
							$data['user'] = $this->profile_model->get_user_by_id($id);
							$data['view'] = 'admin/users/user_edit';
							$this->load->view('admin/layout', $data);
						}
					} else {
						$data['resume'] = $this->input->post('old_resume');
					}
					// RESUME UPLOAD END

				$data = $this->security->xss_clean($data); // XSS Clean
				$data1 = $this->security->xss_clean($data1); // XSS Clean

				//$result = $this->profile_model->edit_user($data, $id);
				$result = $this->profile_model->update_user($data, $data1, $id);

				if($result){
					$this->session->set_flashdata('msg', 'User has been updated successfully!');
					redirect(base_url('admin/users'));
				}
			}
		}

		else{
			$data['countries'] 	= $this->common_model->get_countries_list();
			$data['educations'] = $this->common_model->get_educations_list(); 
			$data['user']	 	= $this->profile_model->get_user_by_id($id);
			$data['view'] 		= 'admin/users/user_edit';
			$this->load->view('admin/layout', $data);
		}
	}

	//-------------------------------------------------------
	public function del($id = 0)
	{
		$this->db->delete('rac_users', array('id' => $id));
		$this->session->set_flashdata('msg', 'User has been deleted successfully!');
		redirect(base_url('admin/users'));
	}

}


?>
