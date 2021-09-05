<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home_slider extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/setting_model', 'setting_model');
		$this->load->model('home_model', 'home_model');
		$this->load->library('functions');
	}

	//-------------------------------------------------------------------------
	// Slider Setting View
	public function index()
	{
		$data['sliders'] = $this->home_model->get_sliders();

		$data['title'] 		= "Home Slider Settings";
		$data['view'] 		= 'admin/sliders/home_slider';
		$this->load->view('admin/layout', $data);
	}
	

	//-------------------------------------------------------------------------
	public function add()
	{

		$this->load->library('upload');
		$files = $_FILES;

		$cpt = count ( $_FILES ['image'] ['name'] );
	
		$total_slides 		= count($this->input->post('title[]'));

		$this->form_validation->set_rules($_FILES['image']['name'], 'Slide Image','trim|xss_clean|required');
		$this->form_validation->set_rules('title[]', 'Slider Title', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('subtitle[]', 'Slider Content', 'trim|required|min_length[3]');

		if ($this->form_validation->run() == FALSE) {
			$data = array(
				'errors' => validation_errors()
			);
			$this->session->set_flashdata('error', $data['errors']);
			redirect(base_url('admin/home_slider'),'refresh');

		} else {

			// return;
			$imgData = array();
			if(!empty($_FILES['image']['name']) && count(array_filter($_FILES['image']['name'])) > 0) 
			{ 
				
				for($i = 0; $i < $cpt; $i++)
				{ 
					if (strlen($files['image']['name'][$i]) == 0) continue;
					$_FILES ['image'] ['name'] = $files ['image'] ['name'] [$i];
					$_FILES ['image'] ['type'] = $files ['image'] ['type'] [$i];
					$_FILES ['image'] ['tmp_name'] = $files ['image'] ['tmp_name'] [$i];
					$_FILES ['image'] ['error'] = $files ['image'] ['error'] [$i];
					$_FILES ['image'] ['size'] = $files ['image'] ['size'] [$i];
			
					$this->upload->initialize($this->set_upload_options());
					$this->upload->do_upload('image');
					$imgData[$i] = $this->upload->data();

				}
			}
		
			$slider_result			= true;
			for($i = 0; $i < $total_slides; $i++)
			{
				$data = array(
					// 'image' 				=> $imgData['file_name']) ? 'uploads/slider/' . $imgData['file_name'] . '' : '',
					'title' 				=> $this->input->post('title['.$i.']'),
					'subtitle' 				=> $this->input->post('subtitle['.$i.']'),
					'created_at' 			=> date('Y-m-d : h:m:s'),
				);

				if (isset($imgData[$i])){
					$data = array_merge($data, array('image' => 'uploads/slider/'.$imgData[$i]['file_name']));

					$refs					= $this->input->post('id['.$i.']');
					$data 					= $this->security->xss_clean($data);

					if ($this->input->post('operation['.$i.']') == 0)
						$slider_result 			&= !empty($this->setting_model->insert_sliders($data));
					else if ($this->input->post('operation['.$i.']') > 0)
						$slider_result 			&= !empty($this->setting_model->update_sliders($data, $refs));

						var_dump($data);
			}


			if($slider_result) {
				$this->session->set_flashdata('success', 'Slider has been saved Successfully!');
				redirect(base_url('admin/home_slider'), 'refresh');
			}
			return true;
		}
	}
	}


	private function set_upload_options()
	{   
		//upload an image options
		$config 						= array();
		$config['upload_path'] 			= './uploads/slider/';
		$config['allowed_types'] 		= 'jpeg|jpg|png';
		$config['max_size']      		= '150000';
		$config['overwrite']     		= True;
		$config['remove_spaces']		= True;
	
		return $config;
	}

}

?>	
