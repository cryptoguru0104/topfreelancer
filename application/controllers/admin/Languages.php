<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Languages extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('datatable'); // loaded my custom serverside datatable library
		$this->load->model('admin/languages_model', 'languages_model');
	}

	public function index()
	{
		$data['title'] = 'Languages List';
		$data['view'] = 'admin/language/language_list';
		$this->load->view('admin/layout', $data);
	}

	public function add()
	{
		if($this->input->post('submit')){
			$this->form_validation->set_rules('lang_name', 'Language Name', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				$data['view'] = 'admin/languages/language_add';
				$this->load->view('admin/layout', $data);
			}
			else{
				$data = array(
					'lang_name' => $this->input->post('lang_name'),
				);
				$data = $this->security->xss_clean($data);
				$result = $this->languages_model->add_language($data);
				if($result){
					$this->session->set_flashdata('msg', 'language has been Added Successfully!');
					redirect(base_url('admin/languages'));
				}
			}
		}
		else{
			$data['view'] = 'admin/language/language_add';
			$this->load->view('admin/layout', $data);
		}
	}

	public function edit($id=0)
	{
		if($this->input->post('submit')){
			$data = array(
				'lang_name' 	=> $this->input->post('lang_name'),
				'status' 		=> $this->input->post('status'),
			);
			$data = $this->security->xss_clean($data);
			$result = $this->languages_model->edit_language($data, $id);
			if($result){
				$this->session->set_flashdata('msg', 'language has been updated successfully!');
				redirect(base_url('admin/languages'));
			}
		}
		else{
			$data['language'] = $this->languages_model->get_language_by_id($id);
			$data['view'] = 'admin/language/language_edit';
			$this->load->view('admin/layout', $data);
		}
	}

	public function del($id)
	{
		$result = $this->languages_model->delete_language($id);
		if ($result) {
			$this->session->set_flashdata('msg', 'language has been Deleted Successfully!');
		} else {
			$this->session->set_flashdata('msg', 'Error while deleting language!');
		}
		redirect(base_url('admin/languages'));
	}

	//-------------------------------------------------------
	public function languages_datatable_json()
	{				   					   
		$records = $this->languages_model->get_all_languages();
		$data = array();
		$count=0;
		foreach ($records['data']  as $row) 
		{  
			$status = ($row['status'] == 0)? 'Inactive': 'Active'.'<span>';
			$data[]= array(
				++$count,
				$row['lang_name'],
				'<span class="btn btn-success btn-flat btn-xs" title="status">'.$status.'<span>',				
				'<a title="Delete" class="btn-delete btn btn-xs btn-danger pull-right" href="'.base_url('admin/languages/del/'.$row['lang_id']).'" onclick="return confirm(\'Do you want to delete ?\')" > <i class="fa fa-trash-o"></i></a>
				<a title="Edit" class="update btn btn-xs btn-primary pull-right" href="'.base_url('admin/languages/edit/'.$row['lang_id']).'"> <i class="fa fa-pencil-square-o"></i></a>'
			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
	}
}

?>
