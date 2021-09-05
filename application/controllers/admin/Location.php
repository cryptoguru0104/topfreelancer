<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Location extends MY_Controller
{
	function __construct()
	{
		parent ::__construct();
		$this->load->library('datatable'); // loaded my custom serverside datatable library
		$this->load->model('admin/location_model', 'location_model');
	}

	// ---------------------------------------------------
	//                     COUNTRY
	//-----------------------------------------------------
	public function index()
	{
		$data['title'] = 'Country List';
		$data['view'] = 'admin/location/country_list';
		$this->load->view('admin/layout', $data);
	}

	//-------------------------------------------------------
	public function country_datatable_json()
	{				   					   
		$records = $this->location_model->get_all_countries();
		$data = array();
		$count=0;
		foreach ($records['data']  as $row) 
		{  
			$status = ($row['status'] == 0)? 'Inactive': 'Active'.'<span>';
			$data[]= array(
				++$count,
				$row['name'],
				'<span class="btn btn-success btn-flat btn-xs" title="status">'.$status.'<span>',				
				'<a title="Delete" class="btn-delete btn btn-xs btn-danger pull-right" href="'.base_url('admin/location/country/del/'.$row['id']).'" onclick="return confirm(\'Do you want to delete ?\')" > <i class="fa fa-trash-o"></i></a>
            	 <a title="Edit" class="update btn btn-xs btn-primary pull-right" href="'.base_url('admin/location/country/edit/'.$row['id']).'"> <i class="fa fa-pencil-square-o"></i></a>'
			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
	}

	//-----------------------------------------------------
	public function country_add()
	{
		if($this->input->post()){
			$this->form_validation->set_rules('country', 'country', 'trim|is_unique[rac_countries.name]|required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
			if ($this->form_validation->run() === FALSE) {
				$data['view'] = 'admin/location/country_add';
				$this->load->view('admin/layout', $data);
				return;
			}

			$slug = make_slug($this->input->post('country'));
			$data = array(
				'name' => ucfirst($this->input->post('country')),
				'slug' => $slug
			);
			$data = $this->security->xss_clean($data);
			$result = $this->location_model->add_country($data);
			$this->session->set_flashdata('success','Country has been added successfully');
			redirect(base_url('admin/location'));
		}
		else{
			$data['title'] = 'Add Country';
			$data['view'] = 'admin/location/country_add';
			$this->load->view('admin/layout', $data);
		}
	}

	//-----------------------------------------------------
	public function country_edit($id=0)
	{

		if($this->input->post()){
			$this->form_validation->set_rules('country', 'country', 'trim|required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
			if ($this->form_validation->run() === FALSE) {
				$data['view'] = 'admin/location/country_edit';
				$this->load->view('admin/layout', $data);
				return;
			}

			$slug = make_slug($this->input->post('country'));
			$data = array(
				'name' => ucfirst($this->input->post('country')),
				'slug' => $slug,
				'status' => $this->input->post('status')
			);
			$data = $this->security->xss_clean($data);
			$result = $this->location_model->edit_country($data, $id);
			$this->session->set_flashdata('success','Country has been updated successfully');
			redirect(base_url('admin/location'));
		}
		else{
			$data['title'] = 'Update Country';
			$data['country'] = $this->location_model->get_country_by_id($id);
			$data['view'] = 'admin/location/country_edit';
			$this->load->view('admin/layout', $data);
		}
	}

	//-----------------------------------------------------
	public function country_del($id = 0)
	{
		$this->db->delete('rac_countries', array('id' => $id));
		$this->session->set_flashdata('success', 'Country has been Deleted Successfully!');
		redirect(base_url('admin/location'));
	}

	// ---------------------------------------------------
	//                     CITY
	//-----------------------------------------------------

	function city()
	{
		$data['title'] = 'City List';
		$data['view'] = 'admin/location/city_list';
		$this->load->view('admin/layout', $data);
	}

	//-------------------------------------------------------
	public function city_datatable_json()
	{				   					   
		$records = $this->location_model->get_all_cities();
		$data = array();
		$count=0;
		foreach ($records['data']  as $row) 
		{  
			$status = ($row['status'] == 0)? 'Inactive': 'Active'.'<span>';
			$data[]= array(
				++$count,
				get_country_name($row['country_id']),
				$row['name'],
				'<span class="btn btn-success btn-flat btn-xs" title="status">'.$status.'<span>',				
				'<a title="Delete" class="btn-delete btn btn-xs btn-danger pull-right" href="'.base_url('admin/location/city/del/'.$row['id']).'" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>
            	 <a title="Edit" class="update btn btn-xs btn-primary pull-right" href="'.base_url('admin/location/city/edit/'.$row['id']).'"> <i class="fa fa-pencil-square-o"></i></a>'
			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
	}

	//-----------------------------------------------------
	public function city_add($id=0)
	{
		if($this->input->post()){

			$this->form_validation->set_rules('city', 'city', 'trim|is_unique[rac_cities.name]|required');
			$this->form_validation->set_rules('country', 'country', 'trim|required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

			if ($this->form_validation->run() === FALSE) {
				$data['title'] 			= 'Add City';
				$data['countries'] 		= $this->common_model->get_countries_list();
				$data['view'] 			= 'admin/location/city_add';
				$this->load->view('admin/layout', $data);
				return;
			}

			$data = array(
				'name' 			=> ucfirst($this->input->post('city')),
				'slug' 			=> make_slug(array($this->input->post('city'),$this->input->post('country'))),
				'country_id' 	=> $this->input->post('country'),
			);
			$data 		= $this->security->xss_clean($data);
			$result 	= $this->location_model->add_city($data);
			$this->session->set_flashdata('success','City has been added successfully');
			redirect(base_url('admin/location/city'));
		}
		else{
			$data['title'] = 'Add City';
			$data['countries'] = $this->common_model->get_countries_list();
			$data['view'] = 'admin/location/city_add';
			$this->load->view('admin/layout', $data);
		}
	}

	//-----------------------------------------------------
	public function city_edit($id=0)
	{
		if($this->input->post()){
			$this->form_validation->set_rules('city', 'city', 'trim|required');
			$this->form_validation->set_rules('country', 'country', 'trim|required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

			if ($this->form_validation->run() === FALSE) {
				
				$data['countries'] 	= $this->common_model->get_countries_list($id);
				$data['view'] 		= 'admin/location/city_edit';
				$this->load->view('admin/layout', $data);
				return;
			}

			$data = array(
				'name' 			=> ucfirst($this->input->post('city')),
				'slug' 			=> make_slug(array($this->input->post('city'),$this->input->post('country'))),
				'country_id' 	=> $this->input->post('country'),
			);
			$data = $this->security->xss_clean($data);
			$result = $this->location_model->edit_city($data, $id);
			$this->session->set_flashdata('success','City has been updated successfully');
			redirect(base_url('admin/location/city'));
		}
		else{
			$data['title'] 		= 'Update City';
			$data['countries'] 	= $this->common_model->get_countries_list($id);
			$data['city'] 		= $this->location_model->get_city_by_id($id);
			$data['view'] 		= 'admin/location/city_edit';
			$this->load->view('admin/layout', $data);
		}
	}

	//-----------------------------------------------------
	public function city_del($id = 0)
	{
		$this->db->delete('rac_cities', array('id' => $id));
		$this->session->set_flashdata('success', 'City has been Deleted Successfully!');
		redirect(base_url('admin/location/city'));
	}

}

?>
