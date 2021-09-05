<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Common_model extends CI_Model 
{

	//-----------------------------------------------------
	//Get Degree
    function get_education($user_id)
    {
   	   $this->db->from('education');
	   $this->db->where('user_id',$user_id);
	   $query = $this->db->get();
	   return $query->result_array();
    }	

	//-------------------------------------------------------------
	// Experience
    function get_experience($user_id)
    {
   	   $this->db->from('experience');
	   $this->db->where('user_id',$user_id);
	   $query = $this->db->get();
	   return $query->result_array();
    }

    //-----------------------------------------------------------
    // Get Compnay record by ID
	function get_business($id=0)
	{
		if($id==0)
		{
			return  $this->db->select('id,name')->from('business')->where('active',1)->get()->result_array();	
		}
		else
		{
			return  $this->db->select('id,name')->from('business')->where('active',1)->where('id',$id)->get()->row_array();	
		}
	}

    //-----------------------------------------------
	// Get Blog Categories
    function get_blog_categories_list()
    {
   	   $this->db->from('rac_blog_categories');
   	   $this->db->order_by('name');
	   $query = $this->db->get();
	   return $query->result_array();
    }	

	//------------------------------------------------
	// Get Countries
	function get_countries_list($id=0)
	{
		if($id==0)
		{
			return  $this->db->get('rac_countries')->result_array();	
		}
		else
		{
			return  $this->db->select('*')->from('rac_countries')->where('id',$id)->get()->row_array();	
		}
	}	
	//------------------------------------------------
	// Get Degrees
	function get_educations_list($id=0)
	{
		if($id==0)
		{
			return  $this->db->get('rac_education')->result_array();	
		}
		else
		{
			return  $this->db->select('id,education')->from('rac_education')->where('id',$id)->get()->row_array();	
		}
	}	

	//------------------------------------------------
	// Get Cities
	function get_cities_list($id=0)
	{
		if($id==0){
			return  $this->db->get('rac_cities')->result_array();	
		}
		else{
			return  $this->db->select('id,city')->from('rac_cities')->where('id',$id)->get()->row_array();	
		}
	}	

	//------------------------------------------------
	// Get States
	function get_states_list($id=0)
	{
		if($id==0){
			return  $this->db->get('rac_states')->result_array();	
		}
		else{
			return  $this->db->select('id,s')->from('rac_cities')->where('id',$id)->get()->row_array();	
		}
	}	

	//------------------------------------------------
	// Get Nationality
	function get_nationality_dd($id=0)
	{
		if($id==0){
			return  $this->db->get('rac_nationality')->result_array();	
		}
		else{
			return  $this->db->select('id,nationality')->from('rac_nationality')->where('id',$id)->get()->row_array();	
		}
	}	

	//------------------------------------------------	
	// Get the Degree Status Dropdown
	public function get_education_list()
	{
		return $this->db->get('rac_education')->result_array();
	}
	
	//------------------------------------------------	
	// Get the Salary Offered Dropdown
	public function get_salary_list()
	{
		return $this->db->get('rac_expected_salary')->result_array();
	}

    // -----------------------------------------------------------------------------
    // Get Business Name by Employer ID
    function get_business_info($emp_id)
    {
		$this->db->from('rac_businesses');
		$this->db->where('employer_id',$emp_id);
		$query = $this->db->get();
		return $result = $query->row_array();
    }

} // endClass
?>
