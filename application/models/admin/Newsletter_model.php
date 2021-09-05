<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Newsletter_model extends CI_Model
{

    //get all subscribers
    public function get_all_subscribers()
    {
        $this->db->order_by('created_at');
        $query = $this->db->get('rac_subscribers');
        return $query->result_array();
    }

    //
    public function get_subscribers($ids)
    {
        $this->db->select('*');
        
        if($ids != 'all')
        {
            $this->db->where_in('id',explode(',',$ids));
        }

        $query = $this->db->get('rac_subscribers');
        $result = $query->result_array();
        return array_column($result, 'email');
    }
}
