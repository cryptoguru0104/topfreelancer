<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Packages extends MY_Controller {



	public function __construct()

	{

		parent::__construct();

		$this->load->model('admin/package_model', 'package_model');

		$this->load->library('datatable'); // loaded my custom serverside datatable library

	}



	//-------------------------------------------------------

	public function index()

	{

		$data['packages'] = $this->package_model->get_all_packages();



		$data['view'] = 'admin/packages/package_list';

		$this->load->view('admin/layout', $data);

	}



	//-------------------------------------------------------

	public function add()

	{

		if($this->input->post('submit')){

			$this->form_validation->set_rules('title', 'plan_title', 'trim|required');

			$this->form_validation->set_rules('price', 'price', 'trim|required');

			$this->form_validation->set_rules('no_of_days', 'no_of_days', 'trim|required');

			$this->form_validation->set_rules('no_of_posts', 'no_of_posts', 'trim|required');

			$this->form_validation->set_rules('detail', 'detail', 'trim');

			$this->form_validation->set_rules('sort_order', 'Sort Order', 'trim');

			$this->form_validation->set_rules('package_for', 'package for', 'trim');





			if ($this->form_validation->run() == FALSE) {

				$data['view'] = 'admin/packages/package_add';

				$this->load->view('admin/layout', $data);

			}

			else{



				$data = array(

					'package_for' => $this->input->post('package_for'),

					'title' => $this->input->post('title'),

					'price' => $this->input->post('price'),

					'detail' => $this->input->post('detail'),

					'no_of_days' => $this->input->post('no_of_days'),

					'no_of_posts' => $this->input->post('no_of_posts'),

					'sort_order' => $this->input->post('sort_order'),

					'created_date' => date('Y-m-d : h:m:s'),

					'updated_date' => date('Y-m-d : h:m:s'),

				);

				$data = $this->security->xss_clean($data);

				$result = $this->package_model->add_package($data);

				if($result){

					$this->session->set_flashdata('msg', 'package has been added successfully!');

					redirect(base_url('admin/packages'));

				}

			}

		}

		else{

			$data['view'] = 'admin/packages/package_add';

			$this->load->view('admin/layout', $data);

		}

		

	}



	//-------------------------------------------------------

	public function edit($id = 0)

	{

		if($this->input->post('submit')){

			$this->form_validation->set_rules('title', 'plan_title', 'trim|required');

			$this->form_validation->set_rules('no_of_days', 'no_of_days', 'trim|required');

			$this->form_validation->set_rules('no_of_posts', 'no_of_posts', 'trim|required');

			$this->form_validation->set_rules('status', 'status', 'trim|required');

			$this->form_validation->set_rules('price', 'price', 'trim|required');

			$this->form_validation->set_rules('detail', 'detail', 'trim');

			$this->form_validation->set_rules('sort_order', 'Sort Order', 'trim');

			$this->form_validation->set_rules('package_for', 'package for', 'trim');



			if ($this->form_validation->run() == FALSE) {

				$data = array(

					'errors' => validation_errors()

				);



				$this->session->set_flashdata('error', $data['errors']);

				redirect(base_url('admin/packages/edit/'.$id),'refresh');

			}

			else{

				$data = array(

					'package_for' => $this->input->post('package_for'),

					'title' => $this->input->post('title'),

					'price' => $this->input->post('price'),

					'detail' => $this->input->post('detail'),

					'no_of_days' => $this->input->post('no_of_days'),

					'no_of_posts' => $this->input->post('no_of_posts'),

					'sort_order' => $this->input->post('sort_order'),

					'is_active' => $this->input->post('status'),

					'updated_date' => date('Y-m-d : h:m:s'),

				);

				$data = $this->security->xss_clean($data);

				$result = $this->package_model->update_package($id, $data);

				if($result){

					$this->session->set_flashdata('msg', 'package has been updated successfully!');

					redirect(base_url('admin/packages'));

				}

			}

		}

		else{

			$data['package'] = $this->package_model->get_package_by_id($id);

			$data['view'] = 'admin/packages/package_edit';

			$this->load->view('admin/layout', $data);

		}

	}



	//-------------------------------------------------------

	public function del($id = 0)

	{

		$this->db->delete('rac_packages', array('id' => $id));

		$this->session->set_flashdata('msg', 'Package has been deleted successfully!');

		redirect(base_url('admin/packages'));

	}



}





?>
