<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';

// setting route for admin
$route['admin'] = 'admin/auth';

// Admin Locations
$route['admin/location/country/add'] = 'admin/location/country_add';
$route['admin/location/country/edit/(:num)'] = 'admin/location/country_edit/$1';
$route['admin/location/country/del/(:num)'] = 'admin/location/country_del/$1';
$route['admin/location/city/add'] = 'admin/location/city_add';
$route['admin/location/city/edit/(:num)'] = 'admin/location/city_edit/$1';
$route['admin/location/city/del/(:num)'] = 'admin/location/city_del/$1';

// setting route for job page
$route['jobs'] = 'jobs/index';
$route['jobs/(:num)'] = 'jobs/index/$1';

// setting route for myjob page
$route['myjobs'] 				= 'myjobs/index';
$route['myjobs/new-vacancy'] 	= 'job/index';
$route['myjobs/(:num)'] 		= 'myjobs/index/$1';
$route['myjobs/posteed/(:num)'] 		= 'myjobs/posted/$1';

// setting route for job detail page
$route['jobs/(:num)/(:any)'] = 'jobs/job_detail/$1/$2';

// setting route for freelancers
$route['freelancer2']            = 'freelancer/index';
$route['freelancer/(:num)']     = 'freelancer/index/$1';

// setting route for freelancer detail page
$route['freelancer/(:num)/(:any)'] = 'freelancer/freelancer_detail/$1/$2';

// setting route for businesses
$route['business/(:any)'] = 'business/detail/$1';

// setting route for jobs by category, industry & location
$route['jobs-by-category'] = 'jobs/jobs_by_category';
$route['jobs-by-industry'] = 'jobs/jobs_by_industry';
$route['jobs-by-location'] = 'jobs/jobs_by_location';

// setting blog category
$route['admin/blog/category/add'] = 'admin/blog/category_add';
$route['admin/blog/category/edit/(:num)'] = 'admin/blog/category_edit/$1';
$route['admin/blog/category/del/(:num)'] = 'admin/blog/category_del/$1';

//econsultant
$route['econsultation']       = 'econsultation/index';
$route['econsultant-booking'] = 'profile/eConsultantBooking';

//favorites
$route['favorite-freelancers']       = 'freelancer/get_favorite_freelancers';
$route['econsultant-booking'] = 'profile/eConsultantBooking';

$route['employers/dashboard'] = 'employers/account/dashboard';
$route['freelancer-data'] = 'freelancer/get_freelancer_detail';
$route['job-data'] = 'job/get_job_details';

// seting for contact us page
$route['contact'] = 'home/contact';

$route['invite-friend'] = 'home/inviteFriend';

$route['p/(:any)'] = 'home/any/$1';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
