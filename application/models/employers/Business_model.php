<?php  defined('BASEPATH') OR exit('No direct script access allowed');
class Business_Model extends CI_Model{

	//----------------------------------------------------------------------
	// Get business info
	public function business_info($data)
	{
		$this->db->insert('rac_business_info',$data);
		return true;
	}

	//----------------------------------------------------------------------
	// Get business by ID
	public function get_business_info_by_id($emp_id)
	{
		$query = $this->db->get_where('rac_businesses', array( 'employer_id' => $emp_id));
		return $result = $query->row_array();
	}

	//----------------------------------------------------------------------
	// Update Business
	public function update_business_info($data, $comp_id, $emp_id)
	{
		$this->db->where('id',$comp_id);
		$this->db->where('employer_id',$emp_id);
		$this->db->update('rac_businesses',$data);
		echo $this->db->last_query();
		return true;
	}

	//----------------------------------------------------------------------
	// Update Employer
	public function update_employer($data,$e_id)
	{
		$this->db->where('id',$e_id);
		$this->db->update('rac_businesses',$data);
		return true;
	}

	//----------------------------------------------------------------------
	// Get business info
	public function get_info_by_id($e_id)
	{
		$query = $this->db->get_where('rac_business_info', array('employer_id' => $e_id ));
		return $result = $query->row_array();
	}
		
} // endClass
?>
