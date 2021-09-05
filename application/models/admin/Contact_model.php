<?php
class Contact_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	//-------------------------------------------------
	public function get_contact_form_details()
	{
		$this->db->select('*');
		$this->db->order_by('id','desc');
		return $this->db->get('rac_contact_us')->result_array();
	}

}
?>
