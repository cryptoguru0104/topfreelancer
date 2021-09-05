<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Category extends MY_Controller
{ 
	function __construct(){
		parent ::__construct();
		$this->load->model('admin/category_model', 'category_model');
	}

	//-----------------------------------------------------
	public function index()
	{
		$data['title'] = 'Category List';
		$data['view'] = 'admin/category/category-list';
		$this->load->view('admin/layout', $data);
	}

	//-----------------------------------------------------
	public function add()
	{
		if($this->input->post()){
			$this->form_validation->set_rules('category', 'Category', 'trim|is_unique[rac_categories.name]|required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
			if ($this->form_validation->run() === FALSE) {
				$data['view'] = 'admin/category/category_add';
				$this->load->view('admin/layout', $data);
				return;
			}

			$slug = make_slug($this->input->post('category'));
			$data = array(
				'name' => ucfirst($this->input->post('category')),
				'slug' => $slug
			);
			$data = $this->security->xss_clean($data);
			$result = $this->category_model->add_category($data);
			$this->session->set_flashdata('success','category has been added successfully');
			redirect(base_url('admin/category'));
		}
		else{
			$data['title'] = 'Add Category';
			$data['view'] = 'admin/category/category_add';
			$this->load->view('admin/layout', $data);
		}
	}

	//-----------------------------------------------------
	public function edit($id=0)
	{
		if($this->input->post()){
			$this->form_validation->set_rules('category', 'Category', 'trim|required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
			if ($this->form_validation->run() === FALSE) {
				$data['view'] = 'admin/category/category_edit';
				$this->load->view('admin/layout', $data);
				return;
			}

			$slug = make_slug($this->input->post('category'));
			$data = array(
				'name' => ucfirst($this->input->post('category')),
				'slug' => $slug
			);
			$data = $this->security->xss_clean($data);
			$result = $this->category_model->edit_category($data, $id);
			$this->session->set_flashdata('success','category has been updated successfully');
			redirect(base_url('admin/category'));
		}
		else{
			$data['title'] = 'Update Category';
			$data['category'] = $this->category_model->get_category_by_id($id);
			$data['view'] = 'admin/category/category_edit';
			$this->load->view('admin/layout', $data);
		}
	}

	//-----------------------------------------------------
	public function del($id = 0)
	{
		$this->db->delete('rac_categories', array('id' => $id));
		$this->session->set_flashdata('success', 'category has been Deleted Successfully!');
		redirect(base_url('admin/category'));
	}

}
?>
