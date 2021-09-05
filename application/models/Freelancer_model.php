<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Freelancer_Model extends CI_Model{

	//----------------------------------------------------
	// Get all freelancers
	public function get_freelancers()
	{
		$this->db->select('*')
		->from('rac_users as ru')
		->join('rac_user_profile as rup', 'ru.id = rup.user_id', 'LEFT')
		->group_by('ru.id');
		$query = $this->db->get();
		return $result = $query->result();
	}

	//----------------------------------------------------
	// Get all freelancers
	public function get_jobs_by_freelancers($freelancer_id)
	{
		$this->db->select('*');
		$this->db->from('rac_job_post');
		$this->db->where('freelancer_id', $freelancer_id);
		$this->db->where('is_active', '1');
		$this->db->where('curdate() <  expiry_date');
		$this->db->order_by('created_date','desc');
		$query = $this->db->get();
		return $query->result_array();
	}

	//---------------------------------------------------
	// Count total Users
	public function count_all_freelancers()
	{
		$this->db->where('is_active', '1');
		return $this->db->count_all('rac_users');
	}
	
	//---------------------------------------------------
	// Count total users
	public function count_all_search_result($search=null)
	{

		$this->db->select('*')
			->from('rac_users as ru')
			->join('rac_user_profile as rup', 'ru.id = rup.user_id', 'LEFT');

		// search URI parameters
		unset($search['p']); //unset pagination parameter form search

		// search URI parameters
		if(!empty($search['kws'])){
			$search_text = explode('-', $search['kws']);
			foreach($search_text as $item){
				$this->db->group_start();
				$this->db->or_like('ru.firstname', $item);
				$this->db->or_like('ru.lastname', $item);
				$this->db->or_like('ru.description', $item);
				$this->db->group_end();
			}
		}

		if(!empty($search['language'])){
			$search_text = explode('-', $search['language']);
			foreach($search_text as $item){
				$this->db->group_start();
				$this->db->or_like('rup.lang1', $item);
				$this->db->or_like('rup.lang2', $item);
				$this->db->group_end();
			}
		}

		if(!empty($search['country']))
			$this->db->where('ru.country', $search['country']);

		if(!empty($search['city']))
			$this->db->where('ru.city', $search['city']);

		if(!empty($search['nationality']))
			$this->db->where('rup.nationality', $search['nationality']);

		$this->db->where('ru.is_active', '1');
		
		if(!empty($search['sortby'])){
			$this->db->order_by('rup.'.$search['sortby'],'asc');
		} else {
			$this->db->order_by('ru.created_date','asc');
		}

		// $this->db->from('rac_users as ru')
		// ->join('rac_user_profile as rup', 'ru.id = rup.user_id', 'LEFT');
		//->group_by('ru.id');
		return $this->db->count_all_results();
	}

	//---------------------------------------------------------------------------	
	// Get All Jobs
	public function get_all_freelancers($limit, $offset, $search)
	{
		$this->db->select('*')
			->from('rac_users as ru')
			->join('rac_user_profile as rup', 'ru.id = rup.user_id', 'LEFT');
			//->group_by('ru.id');
		
		// search URI parameters
		unset($search['p']); //unset pagination parameter form search

		// search URI parameters
		if(!empty($search['kws'])){
			$search_text = explode('-', $search['kws']);
			foreach($search_text as $item){
				$this->db->group_start();
				$this->db->or_like('ru.firstname', $item);
				$this->db->or_like('ru.lastname', $item);
				$this->db->or_like('ru.description', $item);
				$this->db->group_end();
			}
		}

		if(!empty($search['language'])){
			$search_text = explode('-', $search['language']);
			foreach($search_text as $item){
				$this->db->group_start();
				$this->db->or_like('rup.lang1', $item);
				$this->db->or_like('rup.lang2', $item);
				$this->db->group_end();
			}
		}

		if(!empty($search['country']))
			$this->db->where('ru.country', $search['country']);

		if(!empty($search['city']))
			$this->db->where('ru.city', $search['city']);

		if(!empty($search['nationality']))
			$this->db->where('rup.nationality', $search['nationality']);
		

		$this->db->where('ru.is_active', '1');

		if(!empty($search['sortby'])){
			$this->db->order_by('rup.'.$search['sortby'],'asc');
		} else {
			$this->db->order_by('ru.created_date','asc');
		}
		
		$this->db->group_by('ru.id');
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query->result_array();
	}

	//-------------------------------------------------------------------	
    // Save Freelancer Contact
	public function contactFreelancer($data)
	{
		$this->db->insert('rac_contact_freelancer',$data);
		return true;
	}

	public function favoriteFreelancers($user_id)
	{
		$this->db->select('*');
		$this->db->from('rac_favorite_freelancers as rff');
		$this->db->join('rac_users as ru', 'ru.id = rff.freelancer_id', 'LEFT');
		$this->db->join('rac_user_profile as rup','rff.freelancer_id = rup.id', 'LEFT');
		$query = $this->db->get();

		return $query->result_array();
	}
	//----------------------------------------------------
	// Save Freelancers 
	public function save_freelancer($data)
	{
		$this->db->insert('rac_favorite_freelancers', $data);

		return true;
	}

	//----------------------------------------------------
	// Already Saved Freelancers 
	public function is_already_saved($data)
	{
		$query = $this->db->get_where('rac_favorite_freelancers', $data);
		if($query->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}

}

?>
