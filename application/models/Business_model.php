<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Business_Model extends CI_Model{

	//----------------------------------------------------
	// Get all businesses
	public function get_businesses()
	{
		$this->db->select('*');
		$this->db->from('rac_businesses');
		$this->db->group_by('rac_businesses.id');
		$query = $this->db->get();
		return $query->result_array();
	}

	//----------------------------------------------------
	// Get all businesses
	public function get_business_detail($id)
	{
		$query = $this->db->get_where('rac_businesses', array('id' => $id));
		return $query->row_array();
	}

	//----------------------------------------------------
	// Get all businesses
	public function get_jobs_by_businesses($business_id)
	{
		$this->db->select('*');
		$this->db->from('rac_job_post');
		$this->db->where('business_id', $business_id);
		$this->db->where('publish_vacancy', 'active');
		$this->db->where('curdate() <  expiry_date');
		$this->db->order_by('created_date','desc');
		$query = $this->db->get();
		return $query->result_array();
	}

}

?>
