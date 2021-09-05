<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Employer extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('admin/employer_model', 'employer_model');
		$this->load->library('datatable'); // loaded my custom serverside datatable library
	}

	//------------------------------------------------
	public function index()
	{
		$this->session->unset_userdata('employer_search_type');
		$this->session->unset_userdata('employer_search_from');
		$this->session->unset_userdata('employer_search_to');
		
		$data['title'] = 'Employer List : TopFreelancer';
		$data['view']  = 'admin/employers/employer_list';
		$this->load->view('admin/layout', $data);	
	}
	
	//-----------------------------------------
	function datatable_json()
	{				   					   
		$records = $this->employer_model->get_all_employers();
        $data = array();
        foreach ($records['data']  as $row) 
		{
			$data[]= array(
				$row['employer_id'],
				$row['business_name'],
				$row['email'],
                $username = $row['firstname']. ' ' .$row['lastname'],
                
				 '<a class="edit btn btn-xs btn-warning" href='.base_url("admin/employer/edit/".$row['id']).' title="Employer Details" > 
				 <i class="fa fa-eye"></i></a>&nbsp;&nbsp;
				 <a class="edit btn btn-xs btn-primary" href='.base_url("admin/employer/edit/".$row['id']).' title="Job Details" > 
				 <i class="fa fa-edit"></i></a>&nbsp;&nbsp;
				 <a class="delete btn btn-xs btn-danger" href='.base_url("admin/employer/del/".$row['id']).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> 
				 <i class="fa fa-trash-o"></i></a>'
			);
        }
		$records['data']=$data;
        echo json_encode($records);						   
	}

	//--------------------------------------------------
	function search()
	{
		$this->session->set_userdata('employer_search_type',$this->input->post('employer_search_type'));
		$this->session->set_userdata('employer_search_from',$this->input->post('employer_search_from'));
		$this->session->set_userdata('employer_search_to',$this->input->post('employer_search_to'));
	}

	//-------------------------------------------------------
	// Add New Employer
	public function add()
	{
		$data['countries'] = $this->common_model->get_countries_list(); 

		if ($this->input->post('submit')) {

	        //validate inputs
			$this->form_validation->set_rules('firstname','firstname','trim|required|min_length[3]');
			$this->form_validation->set_rules('lastname','lastname','trim|required|min_length[3]');
			$this->form_validation->set_rules('email','email','trim|required|min_length[7]|valid_email|is_unique[rac_businesses.email]');
			$this->form_validation->set_rules('password','password','trim|required|min_length[3]');
			$this->form_validation->set_rules('confirmpassword','confirm password','trim|required|min_length[3]|matches[password]');
			$this->form_validation->set_rules('business_name','Business Name','trim|required|min_length[3]');
			$this->form_validation->set_rules('category','category','trim|required');
			$this->form_validation->set_rules('org_type','Organization Type','trim');
			$this->form_validation->set_rules('country','Country','trim|required');
			$this->form_validation->set_rules('city','City','trim|required');
			$this->form_validation->set_rules('postcode','Postcode','trim|required');
			$this->form_validation->set_rules('address','Address','trim|required|min_length[3]');
			$this->form_validation->set_rules('phone_no','Phone Number','trim');
			$this->form_validation->set_rules('website','website','trim');
			$this->form_validation->set_rules('description','Business Description','trim|min_length[5]');


			if ($this->form_validation->run() == FALSE) { 
				$data = array(
					'errors' => validation_errors(), 
				);
				$this->session->set_flashdata('error', $data['errors']);
				redirect(base_url('admin/employer/add'));
			}else{

				$emp_info = array(
					'firstname' => $this->input->post('firstname'), 
					'lastname' => $this->input->post('lastname'),
					'email' => $this->input->post('email'),
					'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
					'created_date' => date('Y-m-d : h:m:s'),
					'updated_date' => date('Y-m-d : h:m:s')
				);

				$business_info = array(
					'business_name' => $this->input->post('business_name'), 
					'business_slug' => make_slug($this->input->post('business_name')),
					'category' => $this->input->post('category'),
					'org_type' => $this->input->post('org_type'),
					'address' => $this->input->post('address'),
					'country' => $this->input->post('country'),
					'city' => $this->input->post('city'),
					'postcode' => $this->input->post('postcode'),
					'phone_no' => $this->input->post('phone_no'),
					'website' => $this->input->post('website'),
					'description' => $this->input->post('description'),
					'business_logo' => 'uploads/business_logos/default.png'
				);

				$emp_info = $this->security->xss_clean($emp_info);
				$emp_id = $this->employer_model->insert_employers($emp_info); // Insert Employer Info & get ID

				$business_info['business_id'] = $emp_id;
				$business_info = $this->security->xss_clean($business_info);
				$result = $this->employer_model->insert_business($business_info); // Insert Business Info
				
				if ($result) {
					$this->session->set_flashdata('registration_success','<p class="alert alert-success">Registration has been done successfully. Please login in below</p>');
					redirect(base_url('admin/employer/add'), 'refresh');
				}else{
					echo "failed";
				}
			}
		}
		else{
			$data['title'] = 'Employer Registration';

			$data['view'] = 'admin/employers/employer_add';
			$this->load->view('admin/layout', $data);
		}
		
	}

	//---------------------------------------------------------------------------
	// Update Employer
	public function edit($id = 0)
	{

		$data['countries'] = $this->common_model->get_countries_list(); 

		if ($this->input->post('update')) {

			$this->form_validation->set_rules('firstname','firstname','trim|required|min_length[3]');
			$this->form_validation->set_rules('lastname','lastname','trim|required|min_length[3]');
			$this->form_validation->set_rules('email','email','trim|required|min_length[5]|valid_email');
			$this->form_validation->set_rules('mobile_no', 'number','trim|min_length[3]');
			$this->form_validation->set_rules('designation','designation','trim|required|min_length[3]');
			$this->form_validation->set_rules('city','city','trim|required');
			$this->form_validation->set_rules('country','country','trim|required');
			$this->form_validation->set_rules('address','address','trim|required|min_length[5]');
			
			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('error', $data['errors']);
				redirect(base_url('admin/employer/edit/'.$id),'refresh');
			}
			else{
				$data = array(
					'firstname' => $this->input->post('firstname'),
					'lastname' => $this->input->post('lastname'),
					'email' => $this->input->post('email'),
					'mobile_no' => $this->input->post('mobile_no'),
					'designation' => $this->input->post('designation'),
					'country' => $this->input->post('country'),
					'city' => $this->input->post('city'),
					'address' => $this->input->post('address'),
					'updated_date' => date('Y-m-d : h:m:s')
				);

				$data = $this->security->xss_clean($data); // filter data through the XSS filter
				$result = $this->employer_model->update_employer($data,$id);

				if ($result) {
					$this->session->set_flashdata('success','Personal Info has been updated successfully');
					redirect(base_url('admin/employer'));
				}
			 }
		}
		else{
			$data['emp_info'] = $this->employer_model->get_employer_by_id($id);
			$data['business_info'] = $this->employer_model->get_business_info_by_id($id);
			
			$data['title'] = 'Employer List';
			$data['view']  = 'admin/employers/employer_edit';
			$this->load->view('admin/layout', $data);	
		}
	}

	//-------------------------------------------------------
	// Update Business Info
	public function update_business($id)
	{

		$data['countries'] = $this->common_model->get_countries_list(); 

		if ($this->input->post('update')) {

			$this->form_validation->set_rules('business_name','business name','trim|required|min_length[3]');
			$this->form_validation->set_rules('email','email','trim|required|min_length[3]');
			$this->form_validation->set_rules('phone_no','phone number','trim|required|min_length[3]');
			$this->form_validation->set_rules('website','website','trim');
			$this->form_validation->set_rules('category','category','trim|required');
			$this->form_validation->set_rules('founded_date','founded date','trim');
			$this->form_validation->set_rules('org_type','organization type','trim|required');
			$this->form_validation->set_rules('no_of_employers','no of employers','trim|required');
			$this->form_validation->set_rules('description','description','trim|required|min_length[3]');
			$this->form_validation->set_rules('country','country','trim|required');
			$this->form_validation->set_rules('state','state','trim|required');
			$this->form_validation->set_rules('city','city','trim|required');
			$this->form_validation->set_rules('postcode','postcode','trim|required');
			$this->form_validation->set_rules('address','address','trim|required|min_length[3]');
			$this->form_validation->set_rules('facebook_link','facebook link','trim');
			$this->form_validation->set_rules('twitter_link','twitter link','trim');
			$this->form_validation->set_rules('youtube_link','youtube link','trim');
			$this->form_validation->set_rules('vimeo_link','vimeo link','trim');
			$this->form_validation->set_rules('google_link','google plus','trim');
			$this->form_validation->set_rules('linkedin_link','linkedin_link','trim');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('error', $data['errors']);
				redirect(base_url('admin/employer/edit/'.$id),'refresh');
			}
			else{
				$comp_id = $this->input->post('business_id');
				$data = array(
					'business_name' => $this->input->post('business_name'),
					'business_slug' => make_slug($this->input->post('business_name')),
					'email' => $this->input->post('email'),
					'phone_no' => $this->input->post('phone_no'),
					'website' => $this->input->post('website'),
					'category' => $this->input->post('category'),
					'founded_date' => $this->input->post('founded_date'),
					'org_type' => $this->input->post('org_type'),
					'no_of_employers' => $this->input->post('no_of_employers'),
					'description' => $this->input->post('description'),
					'country' => $this->input->post('country'),
					'state' => $this->input->post('state'),
					'city' => $this->input->post('city'),
					'postcode' => $this->input->post('postcode'),
					'address' => $this->input->post('address'),
					'facebook_link' => $this->input->post('facebook_link'),
					'twitter_link' => $this->input->post('twitter_link'),
					'youtube_link' => $this->input->post('youtube_link'),
					'vimeo_link' => $this->input->post('vimeo_link'),
					'google_link' => $this->input->post('google_link'),
					'linkedin_link' => $this->input->post('linkedin_link'),
					'updated_date' => date('Y-m-d : h:m:s')
				);

				$new_logo = $_FILES['userfile']['name'];

				// upload business logo 
				if(!empty($new_logo))
				{
					unlink($this->input->post('old_logo')); // delete old logo

					$config = array(
						'upload_path' => "./uploads/business_logos/",
						'allowed_types' => "png|jpg",
						'overwrite' => TRUE,
						'max_size' => "148000", // Can be set to particular file size , here it is 0.5 MB(148 Kb)
						);

					$new_name = time().$_FILES["userfile"]['name'];
					$config['file_name'] = $new_name;

					$this->load->library('upload', $config);

					if($this->upload->do_upload())
					{
						$file_data = array('upload_data' => $this->upload->data());
						$data['business_logo'] = 'uploads/business_logos/'. $file_data['upload_data']['file_name'];
					}
					else
					{
						$data['file_error'] = array('error' => $this->upload->display_errors());
					
						$this->session->set_flashdata('file_error','Error! Please select a valid file formate');
						redirect(base_url('admin/employer'));
					}
				}
				else{
					$data['business_logo'] = $this->input->post('old_logo');
				}
				//end logo code

				$data = $this->security->xss_clean($data); // filter data through the XSS filter
				$result = $this->employer_model->update_business_info($data, $comp_id, $id);

				if ($result) {
					$this->session->set_flashdata('success','Business Info has been updated successfully');
					redirect(base_url('admin/employer'));
				}

			 }
		}
	}

	//-------------------------------------------------------
	public function del($id = 0)
	{
		$this->db->delete('rac_businesses', array('id' => $id));
		$this->session->set_flashdata('success', 'Employer has been deleted successfully!');
		redirect(base_url('admin/employer'));
	}
	
}
?>
