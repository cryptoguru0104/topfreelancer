<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Blog extends MY_Controller 
{ 
	function __construct()
	{
		parent::__construct();
		$this->load->model('admin/blog_model', 'blog_model');
		$this->load->helper('email_helper');
		$this->load->library('mailer');
		$this->load->library('datatable');
	}

	//------------------------------------------------
	public function index()
	{
		$this->session->unset_userdata('post_search_from');
		$this->session->unset_userdata('post_search_to');
		$this->session->unset_userdata('post_search_category');

		$data['categories'] = $this->common_model->get_blog_categories_list(); 

		$data['title'] = 'Posts List';
		$data['view']  = 'admin/blog/post_list';
		$this->load->view('admin/layout', $data);
	}

	//------------------------------------------------
	public function datatable_json()
	{				   				   
		$records = $this->blog_model->get_all_posts();
        $data = array();

        $i= 1;
        foreach ($records  as $row) 
		{
			$buttoncontroll = '<a class="btn btn-xs btn-success" href='.base_url("admin/blog/edit/".$row['id']).' title="View" > 
				 <i class="fa fa-eye"></i></a>&nbsp;&nbsp;

				  <a class="edit btn btn-xs btn-primary" href='.base_url("admin/blog/edit/".$row['id']).' title="Edit" > 
				 <i class="fa fa-edit"></i></a>&nbsp;&nbsp;

				 <a class="btn-delete btn btn-xs btn-danger" href='.base_url("admin/blog/del/".$row['id']).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> 
				 <i class="fa fa-trash-o"></i></a>';
			
			$data[]= array(
				$i++,
				'<img src="'.base_url($row['image_default']).'" width="50">',
				$row['title'],
				$row['keywords'],  
				get_blog_categories_name($row['category_id']),
				date_time($row['created_at']),
				$buttoncontroll
			);
        }

		$records['data'] = $data;
        
        echo json_encode($records);						   
	}

	//--------------------------------------------------
	public function search()
	{
		$this->session->set_userdata('post_search_from',$this->input->post('post_search_from'));
		$this->session->set_userdata('post_search_to',$this->input->post('post_search_to'));
		$this->session->set_userdata('post_search_category',$this->input->post('post_search_category'));
	}

	//---------------------------------------------------------------------------
	// Post New Vacancy 
	function post()
	{	
		$admin_id = $this->session->userdata('admin_id');
		
		$data['countries'] = $this->common_model->get_countries_list(); 

		if ($this->input->post('blog_post')) {
			$this->form_validation->set_rules('title','title','trim|required|min_length[3]');
			$this->form_validation->set_rules('content','Content','trim|required|min_length[3]');
			$this->form_validation->set_rules('category','category','trim|required');
			$this->form_validation->set_rules('tags','tags','trim|required');
			$this->form_validation->set_rules('keywords','keywords','trim|required');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors(),
				);

				$this->session->set_flashdata('error',$data['errors']);
				redirect(base_url('admin/blog/post'),'refresh');

			}
			else
			{
				$data = array(
					'title' => ucfirst($this->input->post('title')),
					'slug' => make_slug($this->input->post('title')),
					'content' => $this->input->post('content'),
					'keywords' => $this->input->post('keywords'),
					'category_id' => $this->input->post('category'),
					'created_at' => date('Y-m-d : h:m:s'),
				);

				// post image


				$path="assets/blog/";

				// check all mendatory files
				if(empty($_FILES['post_media']['name']))
				{
					$this->session->set_flashdata('error', 'Post Media field is mandatory');
					redirect(base_url('admin/blog/post'),'refresh');
				}

				// profile picture
				if(!empty($_FILES['post_media']['name']))
				{
					$result = $this->functions->file_insert($path, 'post_media', 'image', '1000000');
					if($result['status'] == 1){
						$data['image_default'] = $path.$result['msg'];
					}
					else
					{
						$this->session->set_flashdata('error', $result['msg']);
						redirect(base_url('admin/blog/post'),'refresh');
					}
				}

				$data = $this->security->xss_clean($data);

				$post_id = $this->blog_model->add_post($data);

				$tags = explode(',', $this->input->post('tags'));

				for ($i = 0; $i < count($tags); $i++) 
				{ 
					$tags_data = array(
						'post_id' => $post_id,
						'tag' => $tags[$i],
						'tag_slug' => make_slug($tags[$i]),
					);
					$tags_data = $this->security->xss_clean($tags_data);
					$this->blog_model->add_tags($tags_data);
				}

				if ($post_id){
					$this->session->set_flashdata('success','Congratulation! Post has been Listed successfully');
					redirect(base_url('admin/blog/'));
				}
				else{
					echo "failed";
				}
			}
		}
		else{
			$data['title'] = 'Blog Post';
			$data['view']  = 'admin/blog/post_add';
			$this->load->view('admin/layout', $data);
		}
	}
	
	//--------------------------------------------------------	
	// Edit Job
	public function edit($post_id=0)
	{		
		$data['categories'] = $this->common_model->get_blog_categories_list(); 

		if ($this->input->post('edit_post')) {
			$this->form_validation->set_rules('title','title','trim|required|min_length[3]');
			$this->form_validation->set_rules('content','Content','trim|required|min_length[3]');
			$this->form_validation->set_rules('category','category','trim|required');
			$this->form_validation->set_rules('tags','tags','trim|required');
			$this->form_validation->set_rules('keywords','keywords','trim|required');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors(),
				);

				$this->session->set_flashdata('error',$data['errors']);
				redirect(base_url('employers/blog/edit/'.$post_id),'refresh');

			}
			else{

				$data = array(
					'title' => ucfirst($this->input->post('title')),
					'slug' => make_slug($this->input->post('title')),
					'content' => $this->input->post('content'),
					'keywords' => $this->input->post('keywords'),
					'category_id' => $this->input->post('category'),
				);

				$path="assets/blog/";

				// check all mendatory files
				if(empty($_FILES['post_media']['name']))
				{
					$data['image_default'] = $this->input->post('old_media');
				}

				// profile picture
				if(!empty($_FILES['post_media']['name']))
				{
					unlink($this->input->post('old_media'));
					
					$result = $this->functions->file_insert($path, 'post_media', 'image', '1000000');
					if($result['status'] == 1){
						$data['image_default'] = $path.$result['msg'];
					}
					else
					{
						$this->session->set_flashdata('error', $result['msg']);
						redirect(base_url('admin/blog/post'),'refresh');
					}
				}

				$data = $this->security->xss_clean($data);
				$this->blog_model->edit_post($data,$post_id);

				$tags = explode(',', $this->input->post('tags'));

				$this->blog_model->delete_post_tags($post_id);
				
				for ($i = 0; $i < count($tags); $i++) 
				{ 
					$tags_data = array(
						'post_id' => $post_id,
						'tag' => $tags[$i],
						'tag_slug' => make_slug($tags[$i]),
					);

					$tags_data = $this->security->xss_clean($tags_data);
					$this->blog_model->add_tags($tags_data);
				}

				$this->session->set_flashdata('success','Congratulation! Post has been Updated successfully');
				redirect(base_url('admin/blog/'));
				
			}
		}
		else{
			$data['post_detail'] = $this->blog_model->get_post_by_id($post_id);

			$data['title'] = 'Edit Post';
			$data['view']  = 'admin/blog/post_edit';
			$this->load->view('admin/layout', $data);
		}  
	}

	//---------------------------------------------------------------------------------------
	// Delete the job
	public function del($id=0)
	{
		$this->db->where('id',$id);
		$this->db->delete('rac_blog_posts');

		$this->db->where('post_id',$id);
		$this->db->delete('rac_blog_tags');

		$this->session->set_flashdata('success','Congratulation! Post has been Deleted successfully');
		redirect(base_url('admin/blog'),'refresh');

	}

	/*------------------
	BLOG CATEGORY
	-------------------*/

	public function category()
	{
		$data['title'] = 'Category List';
		$data['view'] = 'admin/blog/category-list';
		$data['categories'] = $this->blog_model->get_all_categories();
		$this->load->view('admin/layout', $data);
	}

	//-----------------------------------------------------
	public function category_add()
	{
		if($this->input->post()){
			$this->form_validation->set_rules('category', 'Category', 'trim|is_unique[rac_blog_categories.name]|required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
			if ($this->form_validation->run() === FALSE) {
				$data['view'] = 'admin/blog/category_add';
				$this->load->view('admin/layout', $data);
				return;
			}

			$slug = make_slug($this->input->post('category'));
			$data = array(
				'name' => ucfirst($this->input->post('category')),
				'slug' => $slug
			);
			$data = $this->security->xss_clean($data);
			$result = $this->blog_model->add_category($data);
			$this->session->set_flashdata('success','category has been added successfully');
			redirect(base_url('admin/blog/category'));
		}
		else{
			$data['title'] = 'Add Category';
			$data['view'] = 'admin/blog/category_add';
			$this->load->view('admin/layout', $data);
		}
	}

	//-----------------------------------------------------
	public function category_edit($id=0)
	{
		if($this->input->post()){
			$this->form_validation->set_rules('category', 'Category', 'trim|required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
			if ($this->form_validation->run() === FALSE) {
				$data['view'] = 'admin/blog/category_edit';
				$this->load->view('admin/layout', $data);
				return;
			}

			$slug = make_slug($this->input->post('category'));
			$data = array(
				'name' => ucfirst($this->input->post('category')),
				'slug' => $slug
			);
			$data = $this->security->xss_clean($data);
			$result = $this->blog_model->edit_category($data, $id);
			$this->session->set_flashdata('success','category has been updated successfully');
			redirect(base_url('admin/blog/category'));
		}
		else{
			$data['title'] = 'Update Category';
			$data['category'] = $this->blog_model->get_category_by_id($id);
			$data['view'] = 'admin/blog/category_edit';
			$this->load->view('admin/layout', $data);
		}
	}

	//-----------------------------------------------------
	public function category_del($id = 0)
	{
		$this->db->delete('rac_blog_categories', array('id' => $id));
		$this->session->set_flashdata('success', 'category has been Deleted Successfully!');
		redirect(base_url('admin/blog/category'));
	}

}	

?>
