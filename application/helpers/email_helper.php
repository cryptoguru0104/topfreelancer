<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function sendEmail($from='', $to = '', $subject  = '', $body = '', $attachment = '', $cc = '')
{
	$controller =& get_instance();

	$controller->load->helper('path');

	// Configure email library

	$config = array();
	$config['useragent'] 		= "-";
	$config['useragent']        = "CodeIgniter";
	$config['mailpath'] 		= "/usr/bin/sendmail"; // or "/usr/sbin/sendmail"
	$config['protocol'] 		= "mail";
	$config['smtp_host'] 		= $controller->general_settings['smtp_host'];
	$config['smtp_port'] 		= $controller->general_settings['smtp_port'];
	$config['smtp_timeout'] 	= '90';
	$config['smtp_user'] 		= $controller->general_settings['smtp_user'];
	$config['smtp_pass'] 		= $controller->general_settings['smtp_pass'];
	$config['mailtype'] 		= 'html';
	$config['charset'] 			= 'utf-8';
	$config['newline'] 			= "\r\n";
	$config['wordwrap'] 		= TRUE;
	$config['_smtp_auth'] 		= TRUE;
	//$config['smtp_crypto'] 		= 'tls';

	$controller->load->library('email');

	$controller->email->initialize($config);
	$controller->email->set_newline("\r\n");
    
	if ($from != '') {
		$controller->email->from($controller->general_settings['email_from'], $controller->general_settings['application_name']);
	} else {
		$controller->email->to($from);
	}

	$controller->email->to($to);

	$controller->email->subject($subject);  

	$controller->email->message($body);

	if ($cc != '') {
		$controller->email->cc($cc);
	}

	if ($attachment != '') {
		$controller->email->attach(base_url() . "your_file_path" . $attachment);

	}

	if ($controller->email->send()) {
		return "success";
	} else {
		echo $controller->email->print_debugger();
		exit();
	}
}
	
?>
