<?php
	class Education_model extends CI_Model{

		public function add_education($data){
			return $this->db->insert('rac_education', $data);
		}

		public function get_all_education(){
			$query = $this->db->get('rac_education');
			return $result = $query->result_array();
		}

		public function edit_education($data, $id){
			$this->db->where('id', $id);
			$this->db->update('rac_education', $data);
			return true;

		}

		public function get_education_by_id($id){
			$query = $this->db->get_where('rac_education', array('id' => $id));
			return $result = $query->row_array();
		}

	}

?>	
