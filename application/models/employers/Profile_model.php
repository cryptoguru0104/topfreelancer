<?php
class Profile_Model extends CI_Model{

	public function business_info($data){
		$this->db->insert('rac_business_info',$data);
		return true;
	}


	public function get_employer_by_id($e_id){
		$query = $this->db->get_where('rac_businesses', array('id' => $e_id));
		return $result = $query->row_array();
	}


	public function edit_business_info($data,$e_id){
		$this->db->where('employer_id',$e_id);
		$this->db->update('rac_business_info',$data);
		return true;
	}


	public function update_employer($data,$e_id){
		$this->db->where('id',$e_id);
		$this->db->update('rac_businesses',$data);
		return true;
	}


	public function get_info_by_id($e_id){
		$query = $this->db->get_where('rac_business_info', array('employer_id' => $e_id ));
		return $result = $query->row_array();
	}



	public function update_password($data,$e_id){
		$query = $this->db->get_where('rac_businesses' , array('id' => $e_id));
		$result = $query->row_array();

		if ($result['password'] == $data['old_password']) {
			$this->db->where('id',$e_id);
			$this->db->update('rac_businesses',array('password' => $data['password']));
			return true;
		}else{
			return false;
		}
		
	}
}
?>
