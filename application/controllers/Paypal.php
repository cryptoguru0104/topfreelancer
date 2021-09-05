<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paypal extends Main_Controller 
{

     function  __construct(){

        parent::__construct();

        $this->load->helper('email_helper');

        $this->load->library('paypal_lib');

        $this->load->model('payment_model');

     }

     //--------------------------------------------------------------------

     function success(){

     	if(emp_id())

     		$emp_id = emp_id();

     	else

     		$emp_id = 0;

     	if(user_id())

     		$user_id = user_id();

     	else

     		$user_id = 0;

		$message = "<h1>Paypal variables</h1>";

	    $payment_data = array(

	    	'payment_method' => 'paypal',

	    	'txn_id' => $_POST['txn_id'],

	    	'employer_id' => $emp_id,

	    	'user_id' => $user_id,

	    	'currency' => $_POST['mc_currency'],

	    	'payment_amount' => $_POST['payment_gross'],

	    	'payer_email' => $_POST['payer_email'],

	    	'payment_status' => $_POST['payment_status'],

	    	'purchased_plan' => $_POST['item_number'],

	    	'payment_date' => $_POST["payment_date"],

	    );

	   	$payment_id = $this->payment_model->insert_payment($payment_data);

	    $no_of_days = get_package_days($_POST['item_number']);

	    $buyer_data = array(

	    	'payment_id' => $payment_id,

	    	'employer_id' => $emp_id,

	    	'user_id' => $user_id,

	    	'package_id' =>  $_POST['item_number'],

	    	'expire_date' => add_days_to_date($no_of_days),

	    	'buy_date' => $_POST["payment_date"],

	    );

	   	if(emp_id()){

	   		$this->payment_model->deactive_emp_prev_package(); // deactive the employer prev package on buying new package

	   		$this->payment_model->insert_buyer_package($buyer_data);

	    	redirect(base_url('employers/dashboard'));

	    }

	    if(user_id()){

	    	// sending invoice to user

	    	$user_info = get_user_by_id(user_id());


	    	$this->payment_model->deactive_user_prev_package(); // deactive the employer prev package on buying new package

	    	$this->payment_model->insert_buyer_package($buyer_data);

	    	redirect(base_url('user/dashboard'));

	    }
     }


     //--------------------------------------------------------------------

     function cancel()

     {

     	if(emp_id())

			redirect(base_url('employers'));

		if(user_id())

			redirect(base_url('user'));

     }

     

     //--------------------------------------------------------------------
     function ipn()
     {
     	/* CHECK THESE 4 THINGS BEFORE PROCESSING THE TRANSACTION, HANDLE THEM AS YOU WISH

		  1. Make sure that business email returned is your business email

		  2. Make sure that the transaction�s payment status is �completed�

		  3. Make sure there are no duplicate txn_id

		  4. Make sure the payment amount matches what you charge for items. (Defeat Price-Jacking) */

     	// Paypal posts the transaction data
        $paypal_info = $this->input->post();
        
        if(!empty($paypal_info)){
            // Validate and get the ipn response
            $ipn_check = $this->paypal_lib->validate_ipn($paypal_info);

            // Check whether the transaction is valid
            if($ipn_check){

                $to = 'codeglamour1@gmail.com';
				$subject = 'Paypal Notification | Jobpostingplatform';
				$message = print_r($_POST, true);

				$email = sendEmail($from='', $to, $subject, $message , $file = '' , $cc = '');

				if($email == true){
					echo 'success';
				}
				else{
					echo $email;
				}
            }
        }
    }

}

?>

