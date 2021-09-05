<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_model extends CI_Model{

	// insert Payment
	public function insert_payment($data)
	{
		$this->db->insert('rac_payments',$data);
		$last_id = $this->db->insert_id();
		return  $last_id;
	}

	// insert buyer package details
	public function insert_buyer_package($data)
	{
		$this->db->insert('rac_packages_bought',$data);
		return true;
	}

	// Get Employers Transactions
	public function get_employer_transactions()
	{
		$query = $this->db->get_where('rac_payments', array('employer_id' => emp_id()));

		return $query->result_array();
	}

	// Get Employers Transactions
	public function get_agency_transactions()
	{
		$query = $this->db->get_where('rac_payments', array('agency_id' => agency_id()));

		return $query->result_array();
	}

	// Deactive Prev Package
	public function deactive_emp_prev_package()
	{
		$this->db->where('employer_id', emp_id());
		$this->db->update('rac_packages_bought', array('is_active' => 0));
		return true;

	}

	
	// Deactive Prev Package
	public function deactive_agency_prev_package()
	{
		$this->db->where('agency_id', agency_id());
		$this->db->update('rac_packages_bought', array('is_active' => 0));
		return true;

	}



	
}

?>
