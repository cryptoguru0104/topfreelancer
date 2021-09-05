<?php  defined('BASEPATH') OR exit('No direct script access allowed');

class Applicant_Model extends CI_Model{

	//---------------------------------------------------
	// Count candidates who had applied job
	public function count_total_applicants($job_id)
	{
		$this->db->select('rac_seeker_applied_job.id, 
			rac_seeker_applied_job.job_id,
			rac_seeker_applied_job.applied_date as apply_date, 
			rac_users.firstname, 
			rac_users.lastname, 
			rac_users.email, 
			rac_users.category,
			rac_users.city,   
			rac_users.country, 
			rac_users.resume,
			rac_seeker_applied_job.*');
		$this->db->from('rac_seeker_applied_job');
		$this->db->join('rac_users','rac_users.id = rac_seeker_applied_job.seeker_id','left');
		$this->db->where(' rac_seeker_applied_job.job_id',$job_id); 
		$this->db->order_by("rac_seeker_applied_job.applied_date", "DESC");

		return $this->db->count_all_results();
		
	}

	//----------------------------------------------------------------------
	// Get candidates who had applied job
	public function get_applicants($job_id, $limit, $offset)
	{

		$this->db->select('rac_seeker_applied_job.id, 
			rac_seeker_applied_job.job_id,
			rac_seeker_applied_job.applied_date as apply_date, 
			rac_users.firstname, 
			rac_users.lastname, 
			rac_users.email, 
			rac_users.category,
			rac_users.city,   
			rac_users.country, 
			rac_users.resume,
			rac_seeker_applied_job.*');
		$this->db->from('rac_seeker_applied_job');
		$this->db->join('rac_users','rac_users.id = rac_seeker_applied_job.seeker_id','left');
		$this->db->where(' rac_seeker_applied_job.job_id',$job_id); 
		$this->db->order_by("rac_seeker_applied_job.applied_date", "DESC");
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		$module = array();
		if ($query->num_rows() > 0) 
		{
			$module = $query->result_array();
		}
		return $module;
	}

	//----------------------------------------------------------------------
	// Get Shortlisted candidates
	public function count_shortlisted_applicants($job_id)
	{
		$this->db->select('rac_seeker_applied_job.id, 
			rac_seeker_applied_job.applied_date as apply_date,
			rac_users.firstname, rac_users.lastname,
			rac_users.email,
			rac_users.city,
			rac_users.country,
			rac_users.category,
			rac_users.current_salary,
			rac_users.resume,
			rac_seeker_applied_job.*');
		$this->db->from('rac_seeker_applied_job');
		$this->db->join('rac_users','rac_users.id = rac_seeker_applied_job.seeker_id','left');
		$this->db->where(' rac_seeker_applied_job.job_id',$job_id); 
		$this->db->where(' rac_seeker_applied_job.is_shortlisted',1); 
		$this->db->order_by("rac_seeker_applied_job.applied_date", "DESC");

		return $this->db->count_all_results();
	}

	//----------------------------------------------------------------------
	// Get Shortlisted candidates
	public function get_shortlisted_applicants($job_id, $limit, $offset)
	{
		$this->db->select('rac_seeker_applied_job.id, 
			rac_seeker_applied_job.applied_date as apply_date,
			rac_users.firstname, rac_users.lastname,
			rac_users.email,
			rac_users.city,
			rac_users.country,
			rac_users.category,
			rac_users.current_salary,
			rac_users.resume,
			rac_seeker_applied_job.*');
		$this->db->from('rac_seeker_applied_job');
		$this->db->join('rac_users','rac_users.id = rac_seeker_applied_job.seeker_id','left');
		$this->db->where(' rac_seeker_applied_job.job_id',$job_id); 
		$this->db->where(' rac_seeker_applied_job.is_shortlisted',1); 
		$this->db->order_by("rac_seeker_applied_job.applied_date", "DESC");
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		$module = array();
		if ($query->num_rows() > 0) 
		{
			$module = $query->result_array();
		}
		return $module;
	}

	//----------------------------------------------------------------------
	// Interviewed Applicants
	public function get_interviewed_applicants($job_id)
	{
		$this->db->select('rac_seeker_applied_job.id,
		 	rac_seeker_applied_job.applied_date as apply_date,
		 	rac_users.firstname, 
		 	rac_users.lastname, 
		 	rac_users.email, 
		 	rac_users.city, 
		 	rac_users.category,
		 	rac_users.resume,
		 	rac_seeker_applied_job.*');
		$this->db->from('rac_seeker_applied_job');
		$this->db->join('rac_users','rac_users.id = rac_seeker_applied_job.seeker_id','left');
		$this->db->where(' rac_seeker_applied_job.job_id',$job_id); 
		$this->db->where(' rac_seeker_applied_job.is_interviewed',1); 
		$this->db->order_by("rac_seeker_applied_job.applied_date", "DESC");
		$query = $this->db->get();
		$module = array();
		if ($query->num_rows() > 0) 
		{
			$module = $query->result_array();
		}
		return $module;
	}

	//----------------------------------------------------------------------
	// Shortlist
	public function do_shortlist($id)
	{
		$this->db->where('id', $id);
		$this->db->update('rac_seeker_applied_job', array('is_shortlisted' => 1));
		return true;
	}
	
	//------------------------------------------------------------
	// Short listed candidate email
	public function get_applied_candidate_email($job_id)
	{
	    $this->db->select('rac_seeker_applied_job.seeker_id,rac_users.email');
	    $this->db->join('rac_users','rac_users.id = rac_seeker_applied_job.seeker_id');
	    $this->db->where('rac_seeker_applied_job.id', $job_id);
		return $this->db->get('rac_seeker_applied_job')->row_array()['email'];
	}


	}//end class

?>
