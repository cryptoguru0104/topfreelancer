<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_model extends CI_Model{

	// Get Employers Transactions
	public function get_all_payments()
	{
		$query = $this->db->get('rac_payments');
		return $query->result_array();
	}
	
}

?>
