<?php		
class Employer_Model extends CI_Model
{	
	public function __construct()
	{
		parent::__construct();
	}
	//-----------------------------------------------------
	function get_all_employers()
    {
		$wh =array();

		if($this->session->userdata('employer_search_from')!='')
			$wh[]=" `updated_date` >= '".date('Y-m-d', strtotime($this->session->userdata('employer_search_from')))."'";

		if($this->session->userdata('employer_search_to')!='')
			$wh[]=" `updated_date` <= '".date('Y-m-d', strtotime($this->session->userdata('employer_search_to')))."'";
		
		$this->db->select('*');
		$this->db->join('rac_users','rac_users.id = rac_businesses.employer_id','left');
		//$this->db->order_by('rac_businesses.id','desc');
		$this->db->get('rac_businesses');
		

		$SQL = $this->db->last_query();
		
		if(count($wh)>0)
		{
			$WHERE = implode(' and ',$wh);
			return $this->datatable->LoadJson($SQL,$WHERE);
		}
		else
		{
			return $this->datatable->LoadJson($SQL);
		}
    }

	//---------------------------------------------------
	// Get user detial by ID
	public function get_employer_by_id($id){
		$query = $this->db->get_where('rac_businesses', array('id' => $id));
		return $result = $query->row_array();
	}

	//----------------------------------------------------------------------
	// registration
	public function insert_employers($data)
	{
		$this->db->insert('rac_businesses',$data);
		$last_id = $this->db->insert_id();
		return  $last_id;
	}

	//----------------------------------------------------------------------
	// Insert business
	public function insert_business($data)
	{
		$this->db->insert('rac_businesses',$data);
		$last_id = $this->db->insert_id();
		return  $last_id;
	}

	//---------------------------------------------------
	// Edit user Record
	public function update_employer($data, $id){
		$this->db->where('id', $id);
		$this->db->update('rac_businesses', $data);
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


			
}
?>
