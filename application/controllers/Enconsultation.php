<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Econsultant extends Main_Controller{

    public function __construct()
	{
		parent::__construct();
		
	}
    public function index()
	   {
    //     $offset = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
	// 	$url= base_url("econsultation/");
	// 	$config = $this->functions->pagination_config($url,$count,$this->per_page_record);
	// 	$config['uri_segment'] = 2;		
	// 	$this->pagination->initialize($config);

		//$data['layout'] = 'econsultant/econsultant_page';

		$this->load->view('econsultant/econsultant_page');
    }
}
?>