<?php
class Job_Model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	//-----------------------------------------------------
	function GetAll()
    {
		$wh =array();
		
		if($this->session->userdata('job_search_location')!= '')
			$wh[]=" rac_job_post.country = '".$this->session->userdata('job_search_location')."'";
		if($this->session->userdata('job_search_nationality')!= '')
			$wh[]=" rac_job_post.nationality = '".$this->session->userdata('job_search_nationality')."'";
		if($this->session->userdata('job_search_from') != '')
			$wh[]=" rac_job_post.created_date >= '".date('Y-m-d', strtotime($this->session->userdata('job_search_from')))."'";
		if($this->session->userdata('job_search_to') != '')
			$wh[]=" rac_job_post.created_date <= '".date('Y-m-d', strtotime($this->session->userdata('job_search_to')))."'";
			
		$SQL ='SELECT
				rac_job_post.*, 
				Count(rac_seeker_applied_job.seeker_id) as cand_applied, 
				SUM(CASE WHEN rac_seeker_applied_job.is_shortlisted > 0 THEN 1 ELSE 0 END) as total_shortlisted,
				SUM(CASE WHEN rac_seeker_applied_job.is_interviewed > 0 THEN 1 ELSE 0 END) as total_interviewed
				FROM
				  rac_job_post left Join  rac_seeker_applied_job 
				  On rac_seeker_applied_job.job_id = rac_job_post.id';  
				  	
		$GROUP_BY =' GROUP BY rac_job_post.id ';  

		if(count($wh)>0)
		{
			$WHERE = implode(' and ',$wh);
			return $this->datatable->LoadJson($SQL,$WHERE,$GROUP_BY);
		}
		else
		{
			return $this->datatable->LoadJson($SQL,'',$GROUP_BY);
		}
    }
	
	//---------------------------------------------------------------------
	// Add new Job
	function add_job($data)
	{
		$this->db->insert('rac_job_post', $data);
		return $this->db->insert_id();
	}

	//----------------------------------------------------------------------
	// Edit Job
	public function edit_job($data,$job_id,$admin_id){
		$this->db->where('id',$job_id);
		$this->db->update('rac_job_post',$data);
		return true;
	}
	
	//----------------------------------------------------------------------
	// Get job by ID
	public function get_job_by_id($job_id,$admin_id){
		$query = $this->db->get_where('rac_job_post', array('id' => $job_id ));
		return $result = $query->row_array();
	}

	//----------------------------------------------------------------------
	// Get All Businesses
	public function get_all_businesses()
	{
		$this->db->select('*');
		$this->db->from('rac_businesses');
		$this->db->order_by("updated_date", "DESC");
		$query = $this->db->get();
		$module = array();
		if ($query->num_rows() > 0) 
		{
			$module = $query->result_array();
		}
		return $module;
	}

} //endClass
?>
