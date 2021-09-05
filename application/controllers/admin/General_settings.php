<?php defined('BASEPATH') OR exit('No direct script access allowed');

class General_settings extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/setting_model', 'setting_model');
		$this->load->library('functions');
	}

	//-------------------------------------------------------------------------
	// General Setting View
	public function index()
	{
		$data['general_settings'] = $this->setting_model->get_general_settings();

		$data['footer_settings'] = $this->setting_model->get_footer_settings();

		$data['title'] = 'General Setting';
		$data['view'] = 'admin/general_settings/setting';
		$this->load->view('admin/layout', $data);
	}

	//-------------------------------------------------------------------------
	public function add()
	{
		$data = array(
			'application_name' => $this->input->post('application_name'),
			'timezone' => $this->input->post('timezone'),
			'currency' => $this->input->post('currency'),
			'copyright' => $this->input->post('copyright'),
			'email_from' => $this->input->post('email_from'),
			'admin_email' => $this->input->post('admin_email'),
			'smtp_host' => $this->input->post('smtp_host'),
			'smtp_port' => $this->input->post('smtp_port'),
			'smtp_user' => $this->input->post('smtp_user'),
			'smtp_pass' => $this->input->post('smtp_pass'),
			'facebook_link' => $this->input->post('facebook_link'),
			'twitter_link' => $this->input->post('twitter_link'),
			'google_link' => $this->input->post('google_link'),
			'youtube_link' => $this->input->post('youtube_link'),
			'linkedin_link' => $this->input->post('linkedin_link'),
			'instagram_link' => $this->input->post('instagram_link'),
			'recaptcha_secret_key' => $this->input->post('recaptcha_secret_key'),
			'recaptcha_site_key' => $this->input->post('recaptcha_site_key'),
			'recaptcha_lang' => $this->input->post('recaptcha_lang'),
			'paypal_sandbox' => $this->input->post('paypal_sandbox'),
		    'paypal_sandbox_url' => $this->input->post('paypal_sandbox_url'),
		    'paypal_live_url' => $this->input->post('paypal_live_url'),
		    'paypal_email' => $this->input->post('paypal_email'),
			'paypal_client_id' => $this->input->post('client_id'),
			'paypal_status' => $this->input->post('paypal_status'),
			'stripe_secret_key' => $this->input->post('stripe_secret_key', true),
			'stripe_publish_key' => $this->input->post('stripe_publish_key', true),
			'created_date' => date('Y-m-d : h:m:s'),
			'updated_date' => date('Y-m-d : h:m:s')
		);

		$data = $this->security->xss_clean($data);
		$result = $this->setting_model->update_general_setting($data);

		if($result){
			// Footer Settings
			$footer_result = $this->add_footer_widget();
		}
		
		if($footer_result){
			$this->session->set_flashdata('success', 'Setting has been changed Successfully!');
			redirect(base_url('admin/general_settings'), 'refresh');
		}
	}

	//-------------------------------------------------------------------------
	// Add footer widget
	public function add_footer_widget()
	{
		$this->form_validation->set_rules('widget_field_title[]', 'Footer Widget Title', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('widget_field_content[]', 'Footer Widget Content', 'trim|required|min_length[3]');
		
		if ($this->form_validation->run() == FALSE) {
			$data = array(
				'errors' => validation_errors()
			);
			$this->session->set_flashdata('error', $data['errors']);
			redirect(base_url('admin/general_settings'),'refresh');
		}
		else
		{
			$total_widgets = count($this->input->post('widget_field_title[]'));

			$this->setting_model->delete_footer_all_setting();

			for ($i=0; $i < $total_widgets; $i++) { 
				$data = array(
					'title' => $this->input->post('widget_field_title['.$i.']'),
					'grid_column' => $this->input->post('widget_field_column['.$i.']'),
					'content' => $this->input->post('widget_field_content['.$i.']'),
				);
				$data = $this->security->xss_clean($data);
				$this->setting_model->update_footer_setting($data);
			}
			return true;
		}
	}

	/*--------------------------
	   Email Template Settings
	--------------------------*/

	// ------------------------------------------------------------
	public function email_templates()
	{
		if($this->input->post()){
			$this->form_validation->set_rules('subject', 'Email Subject', 'trim|required');
			$this->form_validation->set_rules('content', 'Email Body', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				echo validation_errors();
			}
			else{

				$id = $this->input->post('id');
				
				$data = array(
					'subject' => $this->input->post('subject'),
					'body' => $this->input->post('content'),
					'last_update' => date('Y-m-d H:i:s'),
				);
				$data = $this->security->xss_clean($data);
				$result = $this->setting_model->update_email_template($data, $id);
				if($result){
					echo "true";
				}
			}
		}
		else
		{
			$data['title'] = 'Email Templates';

			$data['templates'] = $this->setting_model->get_email_templates();

			$data['view'] = 'admin/general_settings/email_templates/templates_list';
			
			$this->load->view('admin/layout',$data);
		}
	}

	// ------------------------------------------------------------
	// Get Email Template & Related variables via Ajax by ID
	public function get_email_template_content_by_id()
	{
		$id = $this->input->post('template_id');

		$data['template'] = $this->setting_model->get_email_template_content_by_id($id);
		
		$variables = $this->setting_model->get_email_template_variables_by_id($id);

		$data['variables'] = implode(',',array_column($variables, 'variable_name'));

		echo json_encode($data);
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
            echo $this->load->view('admin/general_settings/email_templates/email_preview', $data,true);
        }
    }

}

?>	
