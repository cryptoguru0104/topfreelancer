<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Packages extends Main_Controller {



	public function __construct()

	{

		parent::__construct();

		$this->rbac->check_emp_authentiction();	

		$this->load->library('paypal_lib');

		$this->load->model('employers/package_model', 'package_model');

		$this->load->model('payment_model');

	}



	//------------------------------------------------------------------------

	public function index()

	{	

		$data['packages'] = $this->package_model->get_all_pakages();



		$data['title'] = 'Packages';

		$data['layout'] = 'employers/packages/packages_list';

		$this->load->view('layout', $data);

	}



	//------------------------------------------------------------------------

	public function buy()

	{

		$package_id = $this->input->post('package_id');

		$package_detail = $this->package_model->get_package_by_id($package_id);



		if($package_detail['price'] == 0){

			$buyer_data = array(

	    	'employer_id' => emp_id(),

	    	'package_id' =>  $package_detail['id'],

	    	'expire_date' => add_days_to_date($package_detail['no_of_days']),

	    	'buy_date' => date('Y-m-d : h:m:s'),

	    	);



	    	if(emp_id()){

	    		// deactive the employer prev package

		   		$this->payment_model->deactive_emp_prev_package(); 

		   		// add new package

		   		$this->payment_model->insert_buyer_package($buyer_data);

		    	redirect(base_url('employers/dashboard'));

		    }

		    exit();

		}



		// Set variables for paypal form

        $returnURL = base_url().'paypal/success';

        $cancelURL = base_url().'paypal/cancel';

        $notifyURL = base_url().'paypal/ipn';

        

        

        // Add fields to paypal form

        $this->paypal_lib->add_field('return', $returnURL);

        $this->paypal_lib->add_field('cancel_return', $cancelURL);

        $this->paypal_lib->add_field('notify_url', $notifyURL);

        $this->paypal_lib->add_field('item_name', $package_detail['title']);

        $this->paypal_lib->add_field('item_number',  $package_detail['id']);

        $this->paypal_lib->add_field('amount',  $package_detail['price']);

        $this->paypal_lib->add_field('payer_id',  emp_id());

        $this->paypal_lib->add_field('rm',  2);

        $this->paypal_lib->add_field('handling',  0);

        

        // Render paypal form

        $this->paypal_lib->paypal_auto_form();

	}



	//-------------------------------------------------------------------------------

	public function bought()

	{	

		$emp_id = $this->session->userdata('employer_id');



		$data['package_detail'] = $this->package_model->get_employer_packages($emp_id);

		$data['title'] = trans('packages');

		$data['layout'] = 'employers/packages/employer_packages_bought';

		$this->load->view('layout', $data);

	}



	public function order_confirmation()

	{

		$this->rbac->check_emp_authentiction();

		$package_id = $this->input->post('package_id');

		if($package_id == '')
		{
			redirect(base_url('employers'));
		}

		$data['package_detail'] = $this->package_model->get_package_by_id($package_id);

		$price = $data['package_detail']['price'];

		if($price == '0')
		{
			$this->session->set_flashdata('errors',trans('free_package_error'));
			redirect(base_url('employers/dashboard'));
		}

		$data['title'] = trans('order_confirmation');

		$data['layout'] = 'employers/packages/order_confirmation';

		$this->load->view('layout', $data);

	}



	public function pay_with_stripe()

	{

		/*

        4242424242424242 – Visa

        4000056655665556 – Visa (debit)

        5555555555554444 – Mastercard

        5200828282828210 – Mastercard (debit)

        378282246310005 – American Express

        6011111111111117 – Discover

        */

		$item_number = $this->input->post('item_number');

		$package_detail = $this->package_model->get_package_by_id($item_number);



		if($package_detail['price'] == 0){

			$buyer_data = array(

				'employer_id' => emp_id(),

				'package_id' =>  $package_detail['id'],

				'expire_date' => add_days_to_date($package_detail['no_of_days']),

				'buy_date' => date('Y-m-d : h:m:s')

			);



			if(emp_id()){

				// deactive the employer prev package

				$this->payment_model->deactive_emp_prev_package();

				// add new package

				$insert_buyer_pkg = $this->payment_model->insert_buyer_package($buyer_data);

				if(($insert_buyer_pkg)){

					$this->session->set_flashdata('success', 'Package updated successfully.');

				} else {

					$this->session->set_flashdata('errors', 'Error while updating pacakge in local database');

				}

				redirect(base_url('employers/dashboard'));

			}

			exit();

		}



		//check whether stripe token is not empty

		if(!empty($this->input->post('stripeToken')))

		{

			//get token, card and user info from the form

			$user_id = $this->session->userdata('user_id');

			$token  = $this->input->post('stripeToken');

			$name = $this->input->post('name');

			$email = $this->input->post('email');

			$card_num = $this->input->post('card-number');

			$card_cvc = $this->input->post('card-cvc');

			$card_exp_month = $this->input->post('card-expiry-month');

			$card_exp_year = $this->input->post('card-expiry-year');



			//include Stripe PHP library

			require_once APPPATH."third_party/stripe/init.php";



			//set api key

			$this->CI =& get_instance();

			$stripe_secret_key = $this->CI->general_settings['stripe_secret_key'];

			$stripe_publish_key = $this->CI->general_settings['stripe_publish_key'];

			$stripe = array(

				"secret_key"      => $stripe_secret_key,

				"publishable_key" => $stripe_publish_key

			);



			\Stripe\Stripe::setApiKey($stripe['secret_key']);



			//add customer to stripe

			$customer = \Stripe\Customer::create(array(

				'email' => $email,

				'source'  => $token

			));



			//item information



			$item_price = $this->input->post('item_price');

			// $domain_list = $this->input->post('domain_list');

			$currency = "USD";



			//charge a credit or a debit card

			$charge = \Stripe\Charge::create(array(

				'customer' => $customer->id,

				'amount'   => $item_price,

				'currency' => $currency,

				'description' => $item_number,

				'metadata' => array(

					'item_id' => $item_number

				)

			));



			//retrieve charge details

			$chargeJson = $charge->jsonSerialize();



			//check whether the charge is successful

			if($chargeJson['amount_refunded'] == 0 && empty($chargeJson['failure_code']) && $chargeJson['paid'] == 1 && $chargeJson['captured'] == 1)

			{

				//order details

				$amount = $chargeJson['amount'];

				$balance_transaction = $chargeJson['balance_transaction'];

				$currency = $chargeJson['currency'];

				$status = $chargeJson['status'];

				$date = date("Y-m-d H:i:s");



				// Save payment data into DB



				if(emp_id())

					$emp_id = emp_id();

				else

					$emp_id = 0;



				if(user_id())

					$user_id = user_id();

				else

					$user_id = 0;



				$payment_data = array(

					'payment_method' => 'stripe',

					'txn_id' => $balance_transaction,

					'employer_id' => $emp_id,

					'user_id' => $user_id,

					'currency' => strtoupper($currency),

					'payment_amount' => $amount,

					'payer_email' => $email,

					'payment_status' => $status,

					'purchased_plan' => $item_number,

					'payment_date' => $date,

				);



				$payment_id = $this->payment_model->insert_payment($payment_data);

				$no_of_days = get_package_days($item_number);



				$buyer_data = array(

					'payment_id' => $payment_id,

					'employer_id' => $emp_id,

					'user_id' => $user_id,

					'package_id' =>  $item_number,

					'expire_date' => add_days_to_date($no_of_days),

					'buy_date' => $date,



				);



				if(emp_id()){

					$this->payment_model->deactive_emp_prev_package(); // deactive the employer prev package on buying new package

					$this->payment_model->insert_buyer_package($buyer_data);

					if(($payment_id) && $status == 'succeeded'){

						$this->session->set_flashdata('success', 'Payment has been paid successfully.');

					} else if ($status == 'succeeded'){

						$this->session->set_flashdata('errors', 'Payment paid. Error while saving payment data at local database');

					}

					redirect(base_url('employers/dashboard'));

				}



				if(user_id()){

					// sending invoice to user

					//$user_info = get_user_by_id(user_id());

					$this->payment_model->deactive_user_prev_package(); // deactive the employer prev package on buying new package

					$this->payment_model->insert_buyer_package($buyer_data);

					redirect(base_url('user/dashboard'));

				}

			}

			else

			{

				$package_id = $this->input->post('item_number');

				$this->session->set_flashdata('errors', 'Invalid Token');

				redirect(base_url('employers', 'refresh'));

			}

		} else {

			echo 'invalid stripe token';exit;

		}

	}



}// endClass

