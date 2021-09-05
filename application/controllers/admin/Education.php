<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Education extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/education_model', 'education_model');
	}

	public function index()
	{
		$data['all_educations'] = $this->education_model->get_all_education();
		$data['view'] = 'admin/education/education_list';
		$this->load->view('admin/layout', $data);
	}

	public function add()
	{
		if($this->input->post('submit')){
			$this->form_validation->set_rules('type', 'education', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				$data['view'] = 'admin/education/education_add';
				$this->load->view('admin/layout', $data);
			}
			else{
				$data = array(
					'type' => $this->input->post('type'),
				);
				$data = $this->security->xss_clean($data);
				$result = $this->education_model->add_education($data);
				if($result){
					$this->session->set_flashdata('msg', 'Education has been Added Successfully!');
					redirect(base_url('admin/education'));
				}
			}
		}
		else{
			$data['view'] = 'admin/education/education_add';
			$this->load->view('admin/layout', $data);
		}
	}

	public function edit($id=0)
	{
		if($this->input->post('submit')){
			$data = array(
				'type' => $this->input->post('type'),
			);
			$data = $this->security->xss_clean($data);
			$result = $this->education_model->edit_education($data, $id);
			if($result){
				$this->session->set_flashdata('msg', 'Education has been updated successfully!');
				redirect(base_url('admin/education'));
			}
		}
		else{
			$data['education'] = $this->education_model->get_education_by_id($id);
			$data['view'] = 'admin/education/education_edit';
			$this->load->view('admin/layout', $data);
		}
	}

	public function del($id)
	{
		$this->db->delete('rac_education', array('id' => $id));
		$this->session->set_flashdata('msg', 'Education has been Deleted Successfully!');
		redirect(base_url('admin/education'));
	}
}

?>
