<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

$general_settings = get_general_settings();

// PayPal environment, Sandbox or Live
$config['sandbox'] = ($general_settings['paypal_sandbox'] == 1) ? TRUE : FALSE; // FALSE for live environment

// PayPal business email
$config['business'] = $general_settings['paypal_email'] ;

// What is the default currency?
$config['paypal_lib_currency_code'] = get_currency_short_code($general_settings['currency']);

// Where is the button located at?
$config['paypal_lib_button_path'] = 'assets/images/';

// If (and where) to log ipn response in a file
$config['paypal_lib_ipn_log'] = TRUE;
$config['paypal_lib_ipn_log_file'] = BASEPATH . 'logs/paypal_ipn.log';

?>

