<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Blog_Model extends CI_Model{

	//----------------------------------------------------
	// Get all businesses
	public function get_all_posts()
	{
		$this->db->select('rac_blog_posts.*');
		$this->db->group_by('rac_blog_posts.id');
		$query = $this->db->get('rac_blog_posts');
		return $query->result_array();
	}

	//---------------------------------------------------
	// Count total user for pagination
	public function count_all_posts(){
		return $this->db->count_all('rac_blog_posts');
	}

	//---------------------------------------------------
	// Get all post for pagination
	public function get_all_posts_for_pagination($limit, $offset){
		$wh =array();	
		$this->db->order_by('created_at','desc');
		$this->db->limit($limit, $offset);

		if(count($wh)>0){
			$WHERE = implode(' and ',$wh);
			$query = $this->db->get_where('rac_blog_posts', $WHERE);
		}
		else{
			$query = $this->db->get('rac_blog_posts');
		}
		return $query->result_array();
	}

	//----------------------------------------------------
	// Get all
	public function get_post_detail_by_title($title)
	{
		$query = $this->db->get_where('rac_blog_posts', array('slug' => $title));
		return $query->row_array();
	}

	public function get_all_post_like_title($title)
	{
		$this->db->select('*');
		$this->db->where('slug',$title);
		$this->db->or_like('slug',$title);
		return $this->db->get('rac_blog_posts')->result_array();
	}

	public function get_all_post_by_tag($slug)
	{
		$this->db->select('rac_blog_posts.id as post,title,slug,content,image_default,rac_blog_tags.*');
		$this->db->join('rac_blog_tags','rac_blog_tags.post_id = rac_blog_posts.id');
		$this->db->where('rac_blog_tags.tag_slug',$slug);
		return $this->db->get('rac_blog_posts')->result_array();
	}

	public function get_all_post_by_category($slug)
	{
		$this->db->select('rac_blog_posts.id as post,
			rac_blog_posts.title,
			rac_blog_posts.slug,
			rac_blog_posts.content,
			rac_blog_posts.image_default,
			rac_blog_categories.id,
			rac_blog_categories.name,
			rac_blog_categories.slug as cat_slug
		');
		$this->db->join('rac_blog_categories','rac_blog_categories.id = rac_blog_posts.category_id','right');
		$this->db->where('rac_blog_categories.slug',$slug);
		return $this->db->get('rac_blog_posts')->result_array();
	}


}

?>
