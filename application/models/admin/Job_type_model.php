<?php
class Job_type_Model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	//-----------------------------------------------------
	function get_all_job_type()
    {
		return $this->db->get('rac_job_type')->result_array();
    }

    function add_job_type($data)
    {
    	$this->db->insert('rac_job_type',$data);
    	return true;
    }

	//---------------------------------------------------
	// Get type detial by ID
	public function get_job_type_by_id($id){
		$query = $this->db->get_where('rac_job_type', array('id' => $id));
		return $result = $query->row_array();
	}

	//---------------------------------------------------
	// Edit type 
	public function edit_job_type($data, $id){
		$this->db->where('id', $id);
		$this->db->update('rac_job_type', $data);
		return true;
	}
}
?>
