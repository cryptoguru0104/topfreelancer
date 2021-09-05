<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends Main_Controller{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('blog_model');
	}

	//----------------------------------------------------------------------------------
	// All Businesses
	public function index()
	{
		$data['posts'] = $this->blog_model->get_all_posts();
		
		$data['title'] = trans('label_blog');
		$data['meta_description'] = 'your meta description here';
		$data['keywords'] = 'meta tags here';
		
		$data['layout'] = 'blog/home';
		$this->load->view('layout', $data);
	}

	//----------------------------------------------------------------------------------
	// Post Detail
	public function post($title = NULL)
	{
		$data['post'] = $this->blog_model->get_post_detail_by_title($title);

		$data['title'] = $data['post']["title"]; 
		$data['meta_description'] = 'your meta description here';
		$data['keywords'] = $data['post']["keywords"];

		$data['layout'] = 'blog/post_detail';
		$this->load->view('layout', $data);
	}

	public function tag($tag_slug)
	{
		$data['posts'] = $this->blog_model->get_all_post_by_tag($tag_slug);

		$data['title'] = $data['posts'][0]['tag']; 
		$data['meta_description'] = 'your meta description here';
		$data['keywords'] = 'meta tags here';
		
		$data['layout'] = 'blog/post_by_tag';
		$this->load->view('layout', $data);
	}

	public function category($cat_slug)
	{
		$data['posts'] = $this->blog_model->get_all_post_by_category($cat_slug);
		$data['title'] = $data['posts'][0]['name']; 
		$data['meta_description'] = 'your meta description here';
		$data['keywords'] = 'meta tags here';
		
		$data['layout'] = 'blog/post_by_tag';
		$this->load->view('layout', $data);
	}

	public function search()
	{
		if($_GET['title'])
		{
			$title = make_slug($_GET['title']);

			$data['posts'] = $this->blog_model->get_all_post_like_title($title);

			$data['title'] = $_GET['title']; 
			$data['meta_description'] = 'your meta description here';
			$data['keywords'] = 'meta tags here';
			
			$data['layout'] = 'blog/home';
			$this->load->view('layout', $data);

		}
		else
		{
			redirect('blog');
		}
	}

}

?> 
