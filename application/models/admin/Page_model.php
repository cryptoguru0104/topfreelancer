<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page_model extends CI_Model
{

    //add page
    public function add_page($data)
    {
        return $this->db->insert('rac_pages', $data);
    }

    //update page
    public function update_page($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('rac_pages', $data);
    }

    //get all rac_pages
    public function get_all_pages()
    {
        $this->db->order_by('sort_order');
        $query = $this->db->get('rac_pages');
        return $query->result_array();
    }

    //get page by id
    public function get_page_by_id($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('rac_pages');
        return $query->row_array();
    }

    //delete page
    public function delete($id)
    {
        $page = $this->get_page_by_id($id);
        if (!empty($page)) {

            $this->db->where('id', $id);
            return $this->db->delete('rac_pages');
        }
        return false;
    }
}
