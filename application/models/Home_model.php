<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home_Model extends CI_Model{

	//-------------------------------------------------------------------
    // Get all sliders
	public function get_sliders()
	{
		return $this->db->get('rac_sliders')->result_array();
	}
	//-------------------------------------------------------------------	
    // contant us 
	public function contact($data)
	{
		$this->db->insert('rac_contact_us',$data);
		return true;
	}

	//-------------------------------------------------------------------
	// Get jobs for home page
	public function get_jobs($limit, $offset)
	{
		$this->db->select('id, title, business_id, job_slug, job_type, description, country, city, created_date, industry');
		$this->db->from('rac_job_post');
		$this->db->where('publish_vacancy', 'active');
		$this->db->where('curdate() <  expiry_date');
		$this->db->order_by('created_date','desc');
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		//echo $this->db->last_query();exit;

		return $query->result_array();
	}

	//----------------------------------------------------
	// Get those citites who have jobs
	public function get_cities_with_jobs()
	{
		$this->db->select('city as name, COUNT(city) as total_jobs');
		$this->db->from('rac_job_post');
		$this->db->group_by('city');
		$query = $this->db->get();
		return $query->result_array();
	}

	//----------------------------------------------------
	// Get businesses logos having active job for home page
	public function get_businesses_having_active_jobs($limit)
	{
		$this->db->select('
			rac_job_post.business_id, 
			rac_job_post.publish_vacancy, 
			rac_businesses.business_slug, 
			rac_businesses.business_logo,
		');
		$this->db->join('rac_job_post','rac_job_post.business_id = rac_businesses.id');
		$this->db->where('rac_job_post.publish_vacancy','active');
		$this->db->limit($limit);
		$this->db->group_by('rac_businesses.business_slug');
		$this->db->from('rac_businesses');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_latest_blog_post()
	{
		$this->db->select('rac_blog_posts.*');
		$this->db->from('rac_blog_posts');
		$this->db->order_by('created_at','desc');
		$this->db->limit(3);
		$query = $this->db->get();
		return $query->result_array();
	}

	//get page
    public function get_page($slug)
    {
        $this->db->where('slug', $slug);
        $this->db->where('is_active', 1);
        $query = $this->db->get('rac_pages');
        return $query->row_array();
    }

    //-------------------------------------------------------------------
	// Get testimonials
	public function get_testimonials()
	{
		$this->db->select('*');
		$this->db->from('rac_testimonials');
		$this->db->order_by('is_default','desc');
		$this->db->where('status',1);
		$query = $this->db->get();
		return $query->result_array();

	}

	public function add_subscriber($data)
	{
		$this->db->where('email',$data['email']);
		$query = $this->db->get('rac_subscribers');

		if($query->num_rows() > 0)
		{
			return true;
		}
		else
		{
			$this->db->insert('rac_subscribers',$data);
			return true;
		}
	}

}

?>
