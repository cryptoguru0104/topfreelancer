<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Account_Model extends CI_Model{

	//-------------------------------------------------------
	// Update New password
	public function update_password($data,$user_id)
	{
		$query = $this->db->get_where('rac_users' , array('id' => $user_id));
		$result = $query->row_array();

		$validPassword = password_verify($data['old_password'], $result['password']);

		if ($validPassword) {
			$this->db->where('id',$user_id);
			$this->db->update('rac_users',array('password' => $data['password']));
			return true;
		}else{
			return false;
		}
		
	}

	//-------------------------------------------------------
	// Update New password
	public function update_email($data,$user_id)
	{
		$query = $this->db->get_where('rac_users' , array('id' => $user_id));
		$result = $query->row_array();

		if ($data['current_email'] == $result['email']) {
			$this->db->where('id',$user_id);
			$this->db->update('rac_users',array('email' => $data['new_email']));
			return true;
		}else{
			return false;
		}
		
	}

	//-------------------------------------------------------
	// Update New password
	public function update_user_info($data,$user_id)
	{
		$this->db->set($data);
		$this->db->where(array('id' => $user_id));
		$this->db->update('rac_users',$data);

		return true;		
	}

	//-------------------------------------------------------
	// Update New password
	public function update_business($data,$user_id)
	{
		$this->db->where('employer_id',$user_id);
		$this->db->update('rac_businesses', $data);
		return true;
		
	}

}

?>
