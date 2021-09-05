<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Job_type extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/job_type_model', 'job_type_model');
	}

	public function index()
	{
		$data['types'] = $this->job_type_model->get_all_job_type();
		$data['view'] = 'admin/job_type/job_type_list';
		$this->load->view('admin/layout', $data);
	}

	public function add()
	{
		if($this->input->post('submit')){
			$this->form_validation->set_rules('type', 'Job type', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				$data['view'] = 'admin/job_type/job_type_add';
				$this->load->view('admin/layout', $data);
			}
			else{
				$data = array(
					'type' => $this->input->post('type'),
				);
				$data = $this->security->xss_clean($data);
				$result = $this->job_type_model->add_job_type($data);
				if($result){
					$this->session->set_flashdata('msg', 'Job type has been Added Successfully!');
					redirect(base_url('admin/job_type'));
				}
			}
		}
		else{
			$data['view'] = 'admin/job_type/job_type_add';
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
			$result = $this->job_type_model->edit_job_type($data, $id);
			if($result){
				$this->session->set_flashdata('msg', 'Job type has been updated successfully!');
				redirect(base_url('admin/job_type'));
			}
		}
		else{
			$data['type'] = $this->job_type_model->get_job_type_by_id($id);
			$data['view'] = 'admin/job_type/job_type_edit';
			$this->load->view('admin/layout', $data);
		}
	}

	public function del($id)
	{
		$this->db->delete('rac_job_type', array('id' => $id));
		$this->session->set_flashdata('msg', 'Job type has been Deleted Successfully!');
		redirect(base_url('admin/job_type'));
	}
}

?>
