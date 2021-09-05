<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Job_Model extends CI_Model{

	//---------------------------------------------------
	// Count total jobs
	public function count_all_jobs()
	{
		$this->db->where('publish_vacancy', 'active');
		return $this->db->count_all('rac_job_post');
	}

	//---------------------------------------------------
	// Count total users
	public function count_all_search_result($search=null)
	{
		// search URI parameters
		unset($search['p']); //unset pagination parameter form search
		// if(!empty($search))
		// 	$this->db->where($search);

		if(!empty($search['title'])) {
			$search_text = explode('-', $search['title']);
			foreach($search_text as $item){
				$this->db->group_start();
				$this->db->or_like('skills', $item);
				$this->db->group_end();
			}
		}

		if(!empty($search['language'])) {
			$search_text = explode('-', $search['language']);
			foreach($search_text as $item){
				$this->db->group_start();
				$this->db->or_like('lang1', $item);
				$this->db->or_like('lang2', $item);
				$this->db->group_end();
			}
		}


		if(!empty($search['country'])) {
			$this->db->where('country',$search['country'] );
		}

		if(!empty($search['city']))
			$this->db->where('city',$search['city'] );

		if(!empty($search['nationality']))
			$this->db->where('nationality',$search['nationality'] );

		$this->db->where('publish_vacancy', 'active');

		if(!empty($search['sortby'])) {
			$this->db->order_by($search['sortby'],'desc');
		} else {
			$this->db->order_by('created_date','desc');
		}

		$this->db->group_by('id');

		$this->db->from('rac_job_post');
		return $this->db->count_all_results();
	}


	//---------------------------------------------------------------------------	
	// Get All Jobs
	public function get_all_jobs($limit, $offset, $search)
	{
		$this->db->select('*');
		$this->db->from('rac_job_post');
		// search URI parameters
		unset($search['p']); //unset pagination parameter form search
		
		if(!empty($search['title'])) {
			$search_text = explode('-', $search['title']);
			foreach($search_text as $item){
				$this->db->group_start();
				$this->db->or_like('skills', $item);
				$this->db->group_end();
			}
		}

		if(!empty($search['language'])) {
			$search_text = explode('-', $search['language']);
			foreach($search_text as $item){
				$this->db->group_start();
				$this->db->or_like('lang1', $item);
				$this->db->or_like('lang2', $item);
				$this->db->group_end();
			}
		}


		if(!empty($search['country'])) {
			$this->db->where('country',$search['country'] );
		}

		if(!empty($search['city']))
			$this->db->where('city',$search['city'] );

		if(!empty($search['nationality']))
			$this->db->where('nationality',$search['nationality'] );


		$this->db->where('publish_vacancy', 'active');
		$this->db->where('curdate() <  expiry_date');

		if(!empty($search['sortby'])) {
			$this->db->order_by($search['sortby'],'desc');
		} else {
			$this->db->order_by('created_date','desc');
		}

		$this->db->group_by('id');
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query->result_array();
	}

	//---------------------------------------------------------------------------	
	// Get Job detail by ID
	public function get_job_by_id($id)
	{
		$query = $this->db->get_where('rac_job_post', array('id' => $id));
		return $result = $query->row_array();
	}

	//---------------------------------------------------------------------------	
	// Get User Detail by ID
	public function get_user_by_id($id)
	{
		$query = $this->db->get_where('rac_users', array('id' => $id));
		return $result = $query->row_array();
	}

	//------------------------------------------------------------------
	// Check the already applied job application
	public function check_applied_application($seeker_id, $job_id)
	{
		$data = array(
			'seeker_id'=> $seeker_id,
			'job_id'=> $job_id
		);
		$query = $this->db->get_where('rac_seeker_applied_job', $data);
		if($query->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}

	//------------------------------------------------------------------
	// insert job application
	public function insert_job_application($user_id, $biz_id, $job_id, $cover_letter)
	{
		$data = array(
			'seeker_id'		=> $user_id,
			'job_id'		=> $job_id,
			'employer_id'	=> $biz_id,
			'cover_letter'	=> $cover_letter,
			'applied_date' 	=> date('Y-m-d : h:m:s')
		);
		$this->db->insert('rac_seeker_applied_job', $data);
		return true;
	}

	//----------------------------------------------------------------------
	// Post New Vacancy
	public function add_job($data)
	{
		$this->db->insert('rac_job_post',$data);
		return  $this->db->insert_id();
	}

	//----------------------------------------------------------------------
	// Post New Vacancy
	public function add_featured_job($data)
	{
		$this->db->insert('rac_job_post_featured',$data);
		echo $this->db->last_query();
		return true;
	}

	// //----------------------------------------------------------------------
	// // Get job by ID
	// public function get_job_by_id($job_id,$emp_id){
	// 	$query = $this->db->get_where('rac_job_post', array('id' => $job_id , 'employer_id' => $emp_id ));
	// 	return $result = $query->row_array();
	// }

	//----------------------------------------------------------------------
	// Edit Job
	public function edit_job($data,$job_id,$emp_id){
		$this->db->where('id',$job_id);
		$this->db->where('employer_id',$emp_id);
		$this->db->update('rac_job_post',$data);
		return true;
	}

} // endClass

?>
