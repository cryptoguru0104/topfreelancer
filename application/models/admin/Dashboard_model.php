<?php
	class Dashboard_model extends CI_Model{

		public function get_all_users()
		{
			return $this->db->count_all('rac_users');
		}
		public function get_active_users()
		{
			$this->db->where('is_active', 1);
			return $this->db->count_all_results('rac_users');
		}
		public function get_deactive_users()
		{
			$this->db->where('is_active', 0);
			return $this->db->count_all_results('rac_users');
		}
		public function get_all_jobs()
		{
			$this->db->from('rac_job_post');
			$this->db->where('publish_vacancy', 'active');
			$this->db->where('curdate() <  expiry_date');
			return $this->db->count_all_results();
		}
		public function all_expired_jobs()
		{
			$this->db->from('rac_job_post');
			$this->db->where('publish_vacancy', 'active');
			$this->db->where('curdate() > expiry_date');
			return $this->db->count_all_results();
		}

		public function get_all_countries()
		{
			$this->db->select('country');
			$this->db->distinct('country');
			$query = $this->db->get('rac_users');
			return count($query->result()); 
		}

		public function get_latest_users()
		{
			$this->db->select('*')
			->from('rac_users as ru')
			->join('rac_user_profile as rup', 'ru.id = rup.user_id', 'LEFT')
			->order_by('ru.created_date','desc');
			$this->db->limit(10, 0);
			$query = $this->db->get();
			return $query->result_array();
		}

		public function get_latest_jobs()
		{
			$this->db->select('rac_job_post.*,rac_businesses.business_name');
			$this->db->join('rac_businesses','rac_businesses.id = rac_job_post.business_id');
			$this->db->from('rac_job_post');
			$this->db->order_by('rac_job_post.created_date','desc');
			$this->db->limit(10, 0);
			$query = $this->db->get();
			return $query->result_array();
		}
	}

?>
