<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Employment extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/employment_model', 'employment_model');
	}

	public function index()
	{
		$data['all_employments'] = $this->employment_model->get_all_employment();
		$data['view'] = 'admin/employment/employment_list';
		$this->load->view('admin/layout', $data);
	}

	public function add()
	{
		if($this->input->post('submit')){
			$this->form_validation->set_rules('type', 'employment', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				$data['view'] = 'admin/employment/employment_add';
				$this->load->view('admin/layout', $data);
			}
			else{
				$data = array(
					'type' => $this->input->post('type'),
				);
				$data = $this->security->xss_clean($data);
				$result = $this->employment_model->add_employment($data);
				if($result){
					$this->session->set_flashdata('msg', 'employment has been Added Successfully!');
					redirect(base_url('admin/employment'));
				}
			}
		}
		else{
			$data['view'] = 'admin/employment/employment_add';
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
			$result = $this->employment_model->edit_employment($data, $id);
			if($result){
				$this->session->set_flashdata('msg', 'employment has been updated successfully!');
				redirect(base_url('admin/employment'));
			}
		}
		else{
			$data['employment'] = $this->employment_model->get_employment_by_id($id);
			$data['view'] = 'admin/employment/employment_edit';
			$this->load->view('admin/layout', $data);
		}
	}

	public function del($id)
	{
		$this->db->delete('rac_employment', array('id' => $id));
		$this->session->set_flashdata('msg', 'employment has been Deleted Successfully!');
		redirect(base_url('admin/employment'));
	}
}

?>
