<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/page_model', 'page_model');
    }

    //---------------------------------------------------------------
    // All Pages
    public function index()
    {
        $data['pages'] = $this->page_model->get_all_pages();

        $data['title'] = 'Page List';
        $data['view'] = 'admin/pages/page_list';
        $this->load->view('admin/layout', $data);
    }

    //---------------------------------------------------------------
    // Add Page
    public function add()
    {
        if($this->input->post()){
            $this->form_validation->set_rules('title', 'title', 'trim|required');
            $this->form_validation->set_rules('description', 'description', 'trim|required');
            $this->form_validation->set_rules('keywords', 'keywords', 'trim|required');
            $this->form_validation->set_rules('content', 'content', 'trim|required');
            $this->form_validation->set_rules('sort_order', 'sort order', 'trim|required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

            if ($this->form_validation->run() === FALSE) {
                $data['view'] = 'admin/pages/page_add';
                $this->load->view('admin/layout', $data);
                return;
            }

            $slug = make_slug($this->input->post('title'));
            $data = array(
                'title' => ucfirst($this->input->post('title')),
                'slug' => $slug,
                'description' => $this->input->post('description'),
                'keywords' => $this->input->post('keywords'),
                'content' => $this->input->post('content'),
                'sort_order' => $this->input->post('sort_order'),
                'created_date' => date('Y-m-d : h:m:s')

            );
            $data = $this->security->xss_clean($data);
            $result = $this->page_model->add_page($data);
            $this->session->set_flashdata('success','page has been added successfully');
            redirect(base_url('admin/pages'));
        }
        else{
            $data['title'] = 'Add page';
            $data['view'] = 'admin/pages/page_add';
            $this->load->view('admin/layout', $data);
        }
    }


    //---------------------------------------------------------------
    // Edit Page
    public function edit($id)
    {

        if($this->input->post()){
            $this->form_validation->set_rules('title', 'title', 'trim|required');
            $this->form_validation->set_rules('description', 'description', 'trim|required');
            $this->form_validation->set_rules('keywords', 'keywords', 'trim|required');
            $this->form_validation->set_rules('content', 'content', 'trim|required');
            $this->form_validation->set_rules('sort_order', 'sort order', 'trim|required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

            if ($this->form_validation->run() === FALSE) {
                $data['view'] = 'admin/pages/page_edit';
                $this->load->view('admin/layout', $data);
                return;
            }

            $slug = make_slug($this->input->post('title'));
            $data = array(
                'title' => ucfirst($this->input->post('title')),
                'slug' => $slug,
                'description' => $this->input->post('description'),
                'keywords' => $this->input->post('keywords'),
                'content' => $this->input->post('content'),
                'sort_order' => $this->input->post('sort_order'),
                'created_date' => date('Y-m-d : h:m:s')

            );
            $data = $this->security->xss_clean($data);
            $result = $this->page_model->update_page($id, $data);
            $this->session->set_flashdata('success','Page has been updated successfully');
            redirect(base_url('admin/pages'));
        }
        else{
            $data['page'] = $this->page_model->get_page_by_id($id);

            $data['title'] = 'Add page';
            $data['view'] = 'admin/pages/page_edit';
            $this->load->view('admin/layout', $data);
        }
    }


    /**
     * Update Page Post
     */
    public function update_page_post()
    {
        //validate inputs
        $this->form_validation->set_rules('title', trans("title"), 'required|xss_clean|max_length[500]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            $this->session->set_flashdata('form_data', $this->page_model->input_values());
            redirect($this->agent->referrer());
        } else {
            //get id
            $id = $this->input->post('id', true);
            $redirect_url = $this->input->post('redirect_url', true);
            if ($this->page_model->update($id)) {
                //last id
                $last_id = $this->db->insert_id();
                //update slug
                $this->page_model->update_slug($last_id);

                $this->session->set_flashdata('success', trans("msg_updated"));

                if (!empty($redirect_url)) {
                    redirect($redirect_url);
                } else {
                    redirect(admin_url() . 'pages');
                }
            } else {
                $this->session->set_flashdata('form_data', $this->page_model->input_values());
                $this->session->set_flashdata('error', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }


    /**
     * Delete Page Post
     */
    public function delete_page_post()
    {
        $id = $this->input->post('id', true);

        $page = $this->page_model->get_page_by_id($id);

        if (!empty($page)) {
            if ($this->page_model->delete($id)) {
                $this->session->set_flashdata('success', trans("msg_page_deleted"));
            } else {
                $this->session->set_flashdata('error', trans("msg_error"));
            }
        }
    }


}