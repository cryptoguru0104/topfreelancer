<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Myjob_Model extends CI_Model{


	//-------------------------------------------------------
	// Count Applied Jobs
	public function count_all_applied_jobs()
	{
		$this->db->where('seeker_id', $this->session->userdata('user_id'));
		return $this->db->count_all('rac_seeker_applied_job');
	}

	//-------------------------------------------------------
	// Count Applied Jobs
	public function count_all_posted_jobs()
	{
		$this->db->where('business_id', $this->session->userdata('user_id'));
		return $this->db->count_all('rac_job_post');
	}

	//-------------------------------------------------------
	// Get Applied Jobs
	public function get_applied_jobs($limit, $offset, $user_id)
	{
		$this->db->select('*');
		$this->db->from('rac_seeker_applied_job');
		$this->db->join('rac_job_post', 'rac_seeker_applied_job.job_id = rac_job_post.id', 'left');
		$this->db->where('rac_seeker_applied_job.seeker_id', $user_id);
		$this->db->order_by('created_date','desc');
		$this->db->group_by('rac_seeker_applied_job.job_id');
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query->result_array();
	}

	//-------------------------------------------------------
	// Get Applied Jobs
	public function get_posted_jobs($limit, $offset, $user_id)
	{
		$this->db->select('*');
		$this->db->from('rac_job_post');
		$this->db->where('business_id', $user_id);
		$this->db->order_by('created_date','desc');
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query->result_array();
	}

	//-------------------------------------------------------
	// Get Matching Jobs
	public function get_matching_jobs($skills)
	{
		$this->db->select('*');
		$this->db->from('rac_job_post');
		$this->db->where('curdate() <  expiry_date');
		$this->db->where('publish_vacancy', 'active');


		if(!empty($skills)){
			$skills = explode(',', trim($skills));
			foreach($skills as $skill){
				$this->db->or_like('title', $skill);
				$this->db->or_like('skills', $skill);
			}
		}


		$this->db->order_by('created_date','desc');
		$this->db->group_by('title');
		$query = $this->db->get();
		return $query->result_array();
	}

	//----------------------------------------------------
	// Save Job 
	public function get_saved_jobs($user_id)
	{
		$this->db->select('rac_saved_jobs.job_id,
			rac_job_post.*');
		$this->db->from('rac_saved_jobs');
		$this->db->join('rac_job_post', 'rac_saved_jobs.job_id = rac_job_post.id', 'left');
		$this->db->where('rac_saved_jobs.seeker_id', $this->session->userdata('user_id'));
		$this->db->order_by('created_date','desc');
		$query = $this->db->get();
		return $query->result_array();
	}

	//----------------------------------------------------
	// Save Job 
	public function save_job($data)
	{
		$this->db->insert('rac_saved_jobs', $data);

		return true;
	}

	//----------------------------------------------------
	// Save Job 
	public function is_already_saved($data)
	{
		$query = $this->db->get_where('rac_saved_jobs', $data);
		if($query->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}


}

?>
