<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Newsletter extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/newsletter_model', 'newsletter_model');
        $this->load->helper('email');
    }

    /*-----------------------
        Email to Subcribers
    ------------------------*/

    //---------------------------------------------------------------
    //
    public function index()
    {
        if($this->input->post('submit'))
        {
            
            $this->form_validation->set_rules('title', 'Subject', 'trim|required');
            $this->form_validation->set_rules('content', 'Content', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                $data = array(
                    'errors' => validation_errors()
                );

                $this->session->set_flashdata('errors', $data['errors']);
                redirect(base_url('admin/newsletter'),'refresh');
            }
            else
            {
                $subscribers = $this->newsletter_model->get_subscribers($this->input->post('recipients'));
                
				$body = $this->input->post('content');
				$subject  = $this->input->post('title');

                foreach ($subscribers as $subscriber) {
                    
                    $this->mailer->send_newsletter($subscriber,$subject,$body);

                }

                $this->session->set_flashdata('success', 'Newsletter sent successfully');
                redirect(base_url('admin/newsletter'),'refresh');
            }
        }
        else
        {
            $data['title'] = 'Send Email to Subscribers';
            $data['view'] = 'admin/newsletter/subscriber_list';
            $this->load->view('admin/layout',$data);
        }
    }

    //---------------------------------------------
    public function subscribers_datatable_json(){

            $records['data'] = $this->newsletter_model->get_all_subscribers();
            
            $data = array();

            foreach ($records['data']  as $row) 
            {  
                $data[]= array(
                    '<input type="checkbox" class="subscriber-checkbox" value="'.$row['id'].'">',
                    $row['email'],
                    date_time($row['created_at']),    
                    '<a title="Delete" class="btn-delete btn btn-sm btn-danger" onclick="return confirm(are you sure to delete?)" href="'.base_url('admin/newsletter/del_subscriber/'.$row['id']).'" > <i class="fa fa-trash"></i></a>'
                );
            }

            $records['data'] = $data;
            
            echo json_encode($records);                        
    }

    //---------------------------------------------------------------
    //
    public function email_preview()
    {
        if($this->input->post('content'))
        {
            $data['content'] = $this->input->post('content');
            $data['head'] = $this->input->post('head');
            $data['title'] = 'Send Email to Subscribers';
            echo $this->load->view('admin/newsletter/email_preview', $data,true);
        }
    }

    //-------------------------------------------------------
    public function del_subscriber($id = 0)
    {
        $this->db->delete('rac_subscribers', array('id' => $id));
        $this->session->set_flashdata('success', 'Subscriber has been deleted successfully!');
        redirect(base_url('admin/newsletter'));
    }

}
