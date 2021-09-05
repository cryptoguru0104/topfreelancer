<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Testimonial extends MY_Controller
{
	function __construct()
	{
		parent ::__construct();
		$this->load->model('admin/testimonial_model', 'testimonial_model');
	}

	public function index()
	{
		$data['title'] = 'Testimonial List';

		$data['testimonials'] = $this->testimonial_model->get_all_testimonials();

		$data['view'] = 'admin/testimonial/list';

		$this->load->view('admin/layout',$data);
	}

	//-----------------------------------------------------
	public function add()
	{
		if($this->input->post('submit'))
		{

			$this->form_validation->set_rules('testimonial', 'testimonial', 'trim|required');
			$this->form_validation->set_rules('testimonial_by', 'testimonial_by', 'trim|required');
			$this->form_validation->set_rules('about', 'Business and Designation', 'trim|required');

			if ($this->form_validation->run() === FALSE) {
				
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('admin/testimonial/add'),'refresh');
			}

			$data = array(
				'testimonial' => $this->input->post('testimonial'),
				'testimonial_by' => ucfirst($this->input->post('testimonial_by')),
				'comp_and_desig' => ucfirst($this->input->post('about')),
				'is_default' => $this->input->post('default'),
				'status' => $this->input->post('status'),
			);

			// thumbnail picture
			if(!empty($_FILES['photo']['name']))
			{
				$path = "assets/testimonials/";
				$result = $this->functions->file_insert($path, 'photo','image', '1000000');
				if($result['status'] == 1){
					$data['photo'] = $path.$result['msg'];
				}
				else
				{
				    $this->session->set_flashdata('error', $result['msg']);
			        redirect(base_url('admin/testimonial/add'));
				}
			}

			$data = $this->security->xss_clean($data);
			$result = $this->testimonial_model->add_testimonial($data);
			$this->session->set_flashdata('success','Testimonial has been added successfully');
			redirect(base_url('admin/testimonial'));
		}
		else{

			$data['title'] = 'Add testimonial';
			
			$data['view'] = 'admin/testimonial/add';

			$this->load->view('admin/layout',$data);
		}
	}

	//-----------------------------------------------------
	public function edit($id=0)
	{

		if($this->input->post()){

			$this->form_validation->set_rules('testimonial', 'testimonial', 'trim|required');
			$this->form_validation->set_rules('testimonial_by', 'testimonial_by', 'trim|required');
			$this->form_validation->set_rules('about', 'Business and Designation', 'trim|required');

			if ($this->form_validation->run() === FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('admin/testimonial/edit/'.$id),'refresh');				
			}

			$data = array(
				'testimonial' => $this->input->post('testimonial'),
				'testimonial_by' => ucfirst($this->input->post('testimonial_by')),
				'comp_and_desig' => ucfirst($this->input->post('about')),
				'is_default' => $this->input->post('default'),
				'status' => $this->input->post('status'),
			);

			// update pictures
			if(!empty($_FILES['photo']['name']))
			{
				unlink($this->input->post('old_photo'));
				
				$result = $this->functions->file_insert($path, 'photo','image', '1000000');
				if($result['status'] == 1){
					$data['photo'] = $path.$result['msg'];
				}
				else
				{
					$this->session->set_flashdata('error',$result['msg']);
					redirect(base_url('admin/testimonial/edit/'.$id));
				}
			}


			$data = $this->security->xss_clean($data);
			$result = $this->testimonial_model->edit_testimonial($data, $id);
			$this->session->set_flashdata('success','Testimonial has been updated successfully');
			redirect(base_url('admin/testimonial'));
		}
		else{

			$data['title'] = 'Update testimonial';

			$data['testimonial'] = $this->testimonial_model->get_testimonial_by_id($id);
			
			$data['view'] = 'admin/testimonial/edit';

			$this->load->view('admin/layout', $data);
		}
	}

	//-----------------------------------------------------
	public function del($id = 0)
	{
		// unlink if there is photo
		$photo = $this->db->select('photo')->where('id',$id)->get('rac_testimonials')->row_array()['photo'];
		if($photo)
		unlink($photo);

		$this->db->delete('rac_testimonials', array('id' => $id));
		$this->session->set_flashdata('success', 'Testimonial has been Deleted Successfully!');
		redirect(base_url('admin/testimonial'));
	}

}
?>
