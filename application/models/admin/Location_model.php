<?php
class Location_Model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	//-----------------------------------------------------
	public function get_all_countries(){

		$wh =array();

		$query = $this->db->get('rac_countries');
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

	//-----------------------------------------------------
	public function get_all_states(){

		$wh =array();

		$query = $this->db->get('rac_states');
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

	//-----------------------------------------------------
	public function get_all_cities(){

		$wh =array();

		$query = $this->db->get('rac_cities');
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


	//-----------------------------------------------------
	public function add_country($data){

		$result = $this->db->insert('rac_countries', $data);
        return $this->db->insert_id();	
	}

	//-----------------------------------------------------
	public function add_city($data){

		$result = $this->db->insert('rac_cities', $data);
        return true;	
	}

	//-----------------------------------------------------
	public function edit_country($data, $id){

		$this->db->where('id', $id);
		$this->db->update('rac_countries', $data);
		return true;

	}

	//-----------------------------------------------------
	public function edit_state($data, $id){

		$this->db->where('id', $id);
		$this->db->update('rac_states', $data);
		return true;

	}

	//-----------------------------------------------------
	public function edit_city($data, $id){

		$this->db->where('id', $id);
		$this->db->update('rac_cities', $data);
		return true;

	}

	//-----------------------------------------------------
	public function get_country_by_id($id){

		$query = $this->db->get_where('rac_countries', array('id' => $id));
		return $result = $query->row_array();
	}

	//-----------------------------------------------------
	public function get_state_by_id($id){

		$query = $this->db->get_where('rac_states', array('id' => $id));
		return $result = $query->row_array();
	}

	//-----------------------------------------------------
	public function get_city_by_id($id){

		$query = $this->db->get_where('rac_cities', array('id' => $id));
		return $result = $query->row_array();
	}
	
}
?>
