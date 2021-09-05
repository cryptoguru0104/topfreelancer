<?php
class Setting_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	//-----------------------------------------------------
	public function update_general_setting($data){
		$this->db->where('id', 1);
		$this->db->update('rac_general_settings', $data);
		return true;

	}

	//-----------------------------------------------------
	public function get_general_settings(){
		$this->db->where('id', 1);
        $query = $this->db->get('rac_general_settings');
        return $query->row_array();
	}

	// ---------------------------------------------------
	public function get_footer_settings()
	{
		return $this->db->get('rac_footer_settings')->result_array();
	}

	//----------------------------------------------------
	public function delete_footer_all_setting()
	{
		$this->db->where('id !=', NULL);
		$this->db->delete('rac_footer_settings');
		return true;
	}
	//-----------------------------------------------------
	public function update_footer_setting($data){
		$this->db->insert('rac_footer_settings',$data);
		return true;

	}

	/*--------------------------
	   Slider Settings
	--------------------------*/

	//----------------------------------------------------
	public function delete_sliders()
	{
		$this->db->where('id !=', NULL);
		$this->db->delete('rac_sliders');
		return true;
	}
	//-----------------------------------------------------
	public function update_sliders($data, $ids){

		$this->db->where('id', $ids);
		$this->db->update('rac_sliders', $data);

		return true;
	}	
	//-----------------------------------------------------
	public function insert_sliders($data){

		$this->db->insert('rac_sliders', $data);

		return true;
	}	


	/*--------------------------
	   Email Template Settings
	--------------------------*/

	function get_email_templates()
	{
		return $this->db->get('rac_email_templates')->result_array();
	}

	function update_email_template($data,$id)
	{
		$this->db->where('id', $id);
		$this->db->update('rac_email_templates', $data);
		return true;
	}

	function get_email_template_content_by_id($id)
	{
		return $this->db->get_where('rac_email_templates',array('id' => $id))->row_array();
	}

	function get_email_template_variables_by_id($id)
	{
		return $this->db->get_where('rac_email_template_variables',array('template_id' => $id))->result_array();
	}
	
}
?>
