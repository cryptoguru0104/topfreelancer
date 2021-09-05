<?php  defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_Model extends CI_Model{

	//-------------------------------------------------------
	// Get User detail
	public function get_user_by_id($id)
	{	
		$this->db->select('*')
		->from('rac_users as ru')
		->join('rac_user_profile as rup', 'ru.id = rup.user_id', 'LEFT')
		->where(array('ru.id' => $id));
		$query = $this->db->get();
		return $result = $query->row_array();
	}

	public function get_booking_info($id)
	{	
		$this->db->select("*")
		->where('user_id',$id)
		->from('rac_booking_info');
		
		$query 		= $this->db->get();
		$rowcount 	= $query->result_array();

		return $rowcount;
	}

	public function get_econsultation_info($id)
	{	
		$this->db->select('*')
		->from('rac_users as ru')
		->join('rac_econsultation as rep', 'ru.id = rep.user_id', 'LEFT')
		->where(array('ru.id' => $id));
		$query = $this->db->get();
		return $result = $query->row_array();
	}

	//-------------------------------------------------------
	// Update user
	public function update_user($data, $data1, $id)
	{
		$this->db->select('*')
		->from('rac_user_profile as rup')
		->join('rac_users as ru', 'ru.id = rup.user_id', 'LEFT')
		->where(array('rup.user_id' => $id));
		$query = $this->db->get();
		$rowcount = $query->row_array();

		if ($rowcount['user_id'] == $id) {

			$this->db->where('id',$id);
			$this->db->update('rac_users', $data);

			$this->db->where('user_id',$id);
			$this->db->update('rac_user_profile', $data1);

		} else {

			$this->db->where('id',$id);
			$this->db->set($data);
			$this->db->update('rac_users', $data);

			$this->db->set($data1);
			$this->db->insert('rac_user_profile', $data1);
		}
	
		return true;
	}

	//-------------------------------------------------------
	// store data in econsultation table

	public function update_user_econsultation($data, $id){

		$this->db->select('rac_econsultation.user_id')
		->where('rac_econsultation.user_id',$id)
		->from('rac_econsultation');
		$query 		= $this->db->get();
		$rowcount 	= $query->row_array();
		if (isset($rowcount['user_id']) == $id) {
			$this->db->where('user_id',$id);
			$this->db->update('rac_econsultation', $data);
		} else {
			$this->db->set($data);
			$this->db->insert('rac_econsultation', $data);
		}
		return true;	
	}

	//-------------------------------------------------------
	// Get Applied Jobs
	public function update_education($data,$id)
	{
		$this->db->where('id',$id);
		$this->db->update('rac_seeker_education',$data);
		return true;
	}

	public function get_user_education($user_id)
	{
		$this->db->where('user_id',$user_id);
		return $this->db->get('rac_seeker_education')->result_array();
	}

	public function get_education_by_id($edu_id)
	{
		$this->db->where('id',$edu_id);
		return $this->db->get('rac_seeker_education')->row_array();
	}

	// LANGUAGE //

	public function add_user_language($data)
	{
		$this->db->insert('rac_seeker_languages',$data);
		return true;
	}

	//-------------------------------------------------------
	// Get Applied Jobs
	public function update_language($data,$id)
	{
		$this->db->where('id',$id);
		$this->db->update('rac_seeker_languages',$data);
		return true;
	}

	public function get_user_language($user_id)
	{
		$this->db->where('user_id',$user_id);
		return $this->db->get('rac_seeker_languages')->result_array();
	}

	public function get_language_by_id($lang_id)
	{
		$this->db->where('id',$lang_id);
		return $this->db->get('rac_seeker_languages')->row_array();
	}

	//-------------------------------------------------------
	// Update Skills
	public function update_skill($data,$id)
	{
		$this->db->where('id',$id);
		$this->db->insert('rac_seeker_skill',$data);
		return true;
	}

	//-------------------------------------------------------
	// Update Summery
	public function update_summary($data,$id)
	{
		$this->db->where('id',$id);
		$this->db->insert('rac_seeker_summary',$data);
		return true;
	}

	//-------------------------------------------------------
	// Update Language
	public function update_languages($data,$id)
	{
		$this->db->where('id',$id);
		$this->db->insert('rac_seeker_languages',$data);
		return true;
	}

	//-------------------------------------------------------
	// Checking Old password
	public function check_old_password($data,$id)
	{

		return 'working';
		/*$query = $this->db->get_where('rac_users' , array('id' => $id));
		$result = $query->row_array();

		echo $this->db->last_query();
		if ($result['password'] == $data['old_password']) {

			$this->db->where('id',$id);
			$this->db->update('rac_users',$data['password']);
			//return true;

		}else{
			//return false;
		}*/

	}

	//-------------------------------------------------------
	// Update New password
	public function update_password($data,$user_id)
	{
		$query = $this->db->get_where('rac_users' , array('id' => $user_id));
		$result = $query->row_array();

		if ($result['password'] == $data['old_password']) {
			$this->db->where('id',$user_id);
			$this->db->update('rac_users',array('password' => $data['password']));
			return true;
		}else{
			return false;
		}
		
	}


}// endClass
?>
