<?php
	class Languages_model extends CI_Model{

		public function add_language($data){
			return $this->db->insert('rac_languages', $data);
		}

		// public function get_all_languages(){
		// 	$query = $this->db->get('rac_languages');
		// 	return $result = $query->result_array();
		// }

		//-----------------------------------------------------
		public function get_all_languages(){

			$wh =array();

			$query = $this->db->get('rac_languages');
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

		public function edit_language($data, $id){
			$this->db->where('lang_id', $id);
			$this->db->update('rac_languages', $data);
			return true;

		}

		public function get_language_by_id($id){
			$query = $this->db->get_where('rac_languages', array('lang_id' => $id));
			return $result = $query->row_array();
		}

		public function delete_language($id) {
			$this->db->delete('rac_languages', array('lang_id' => $id));
			return true;
		}

		public function set_default_language($id){
			$language = $this->get_language_by_id($id);
			$this->db->update('rac_general_settings', array('default_language' => $language['directory_name'])); // setting in General settings table

			$this->db->update('rac_languages', array('is_default' => 0)); // setting all previous to 0

			$this->db->where('id', $id);
			$this->db->update('rac_languages', array('is_default' => 1));
			return true;

		}


	}

?>	
