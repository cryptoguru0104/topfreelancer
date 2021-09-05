<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	// -----------------------------------------------------------------------------
    // Get General Setting
    if (!function_exists('get_general_settings')) {
        function get_general_settings()
        {
            $ci =& get_instance();
            $ci->load->model('admin/setting_model');
            return $ci->setting_model->get_general_settings();
        }
    }

    // -----------------------------------------------------------------------------
    //get recaptcha
    if (!function_exists('generate_recaptcha')) {
        function generate_recaptcha()
        {
            $ci =& get_instance();
            if ($ci->recaptcha_status) {
                $ci->load->library('recaptcha');
                echo '<div class="form-group mt-2">';
                echo $ci->recaptcha->getWidget();
                echo $ci->recaptcha->getScriptTag();
                echo ' </div>';
            }
        }
    }

    // -----------------------------------------------------------------------------
    // Footer Settings
    if (!function_exists('get_footer_settings')) {
        function get_footer_settings()
        {
            $ci =& get_instance();
            $ci->db->select('*');
            return $ci->db->get('rac_footer_settings')->result_array();
        }
    }

    // ----------------------------------------------------------------------------
     //print old form data
    if (!function_exists('old')) {
        function old($field)
        {
            $ci =& get_instance();
           // return html_escape($ci->session->flashdata('form_data')[$field]);
        }
    }

    // ------------------------------------------------------
    // get languages
    function get_site_languages()
    {
        $ci = & get_instance();
        return $ci->db->get('rac_site_languages')->result_array();
    }

    // ------------------------------
    // Get currency symbol by ID
    function get_currency_symbol($id)
    {
        $ci = & get_instance();
        $ci->db->select('symbol');
        $ci->db->where('id',$id);
        return $ci->db->get('rac_currency')->row_array()['symbol'];
    }

    // ------------------------------
    // Get currency symbol by ID
    function get_currency_short_code($id)
    {
        $ci = & get_instance();
        $ci->db->select('code');
        $ci->db->where('id',$id);
        return $ci->db->get('rac_currency')->row_array()['code'];
    }


    // ----------------------------------------------------------------------------
     // get User id
    function user_id()
    {
        $ci = & get_instance();
        return $ci->session->userdata('user_id');
    }

    // ----------------------------------------------------------------------------
    // get Employer id
    function emp_id()
    {
        $ci = & get_instance();
        return $ci->session->userdata('business_id');
    }

     // -----------------------------------------------------------------------------
    // get user profile by ID
    function get_user_profile($id)
    {
        $ci = & get_instance();
        return $ci->db->select('profile_picture')
        ->where('id',$id)
        ->get('rac_users')
        ->row_array()['profile_picture'];
    }

    // ----------------------------------------------------------------------------
    //get all pages
    function get_all_pages()
    {
        $ci = & get_instance();
        $ci->db->order_by('sort_order');
        $query = $ci->db->get('rac_pages');
        return $query->result_array();
    }

    // -----------------------------------------------------------------------------
    // Get Package Days
    function get_package_days($pkg_id)
    {
        $ci = & get_instance();
        return $ci->db->get_where('rac_packages', array('id' => $pkg_id))->row_array()['no_of_days'];
    }

    // -----------------------------------------------------------------------------
    // Get Package Name
    function get_pkg_name($pkg_id)
    {
        $ci = & get_instance();
        return $ci->db->get_where('rac_packages', array('id' => $pkg_id))->row_array()['title'];
    }

    // ------------------------------------------------------
    // get languages

    function get_languages_list()
    {
        $ci = & get_instance();
        return $ci->db->get('rac_languages')->result_array();
    }

    function get_language_levels()
    {
        return array(
        '' => trans('select_option'),
        '1' => 'Beginner',
        '2' => 'Intermediate',
        '3' => 'Expert',
      );
    }

    function get_experience_list($type)
    {
        $experience = [];
        $experience[''] = trans('select_experience');
        for ($i= 1; $i < 51 ; $i++) { 
            $experience[$i] = $i.' Years';
        }
        return $experience;
    }

    function get_time_period()
    {
        $travel = [];
		$travel[''] = 'select time period';
        for ($i= 1; $i < 105 ; $i++) { 
            $travel[$i] = $i.' Weeks';
        }
        return $travel;
    }

    function get_availability()
    {
        $travel = [];
		$travel[''] = trans('select_availability');
        for ($i= 1; $i < 8 ; $i++) { 
            $travel[$i] = $i.' Days/Week';
        }
        return $travel;
    }
	
    function get_language_name($id)
    {
        $ci = & get_instance();
        return $ci->db->get_where('rac_languages', array('lang_id' => $id))->row_array()['lang_name'];
    }

    function get_lang_proficiency_name($id)
    {
        if($id == '1')
            return 'Beginner';
        if($id == '2')
            return 'Intermediate';
        if($id == '3')
            return 'Expert';
    }

    function get_months_list()
    {
        return array(
        '' => 'Month',
        '1' => 'Jan',
        '2' => 'Feb',
        '3' => 'Mar',
        '4' => 'Apr',
        '5' => 'May',
        '6' => 'Jun',
        '7' => 'Jul',
        '8' => 'Aug',
        '9' => 'Sep',
        '10' => 'Oct',
        '11' => 'Nov',
        '12' => 'Dec',
      );
    }

    function get_years_list()
    {
        $years = [];
        $years[''] = 'Year';
        for ($i=0; $i < 50; $i++) { 
            $year = date('Y',strtotime('- '.$i.' years'));
            $years[$year] = $year;
        }
        return $years;
    }

    function get_nth_month($nth)
    {
        return date('M',strtotime($nth.' month'));
    }

    // -----------------------------------------------------------------------------
    // Get category name by id
    function get_category_name($id)
    {
    	$ci = & get_instance();
    	return $ci->db->get_where('rac_categories', array('id' => $id))->row_array()['name'];
    }

    // -----------------------------------------------------------------------------
    // Get category ID by title
    function get_category_id($category_name)
    {
        $ci = & get_instance();
        return $ci->db->get_where('rac_categories', array('slug' => $category_name))->row_array()['id'];
    }

    // -----------------------------------------------------------------------------
    // Get Workstation type
    function get_employment_type_list()
    {
        $ci = & get_instance();
        return $ci->db->get('rac_employment')->result_array();
    }

    // -----------------------------------------------------------------------------
    // Get country list
    function get_country_list()
    {
        $ci = & get_instance();
        return $ci->db->get('rac_countries')->result_array();
    }
	

    // -----------------------------------------------------------------------------
    // Get country name by ID
    function get_country_name($id)
    {
        $ci = & get_instance();
        return $ci->db->get_where('rac_countries', array('id' => $id))->row_array()['name'];
    }

    // -----------------------------------------------------------------------------
    // Get City ID by Name
    function get_country_id($title)
    {
        $ci = & get_instance();
        return $ci->db->get_where('rac_countries', array('slug' => $title))->row_array()['id'];
    }

    // -----------------------------------------------------------------------------
    // Get country slug
    function get_country_slug($id)
    {
        $ci = & get_instance();
        return $ci->db->get_where('rac_countries', array('id' => $id))->row_array()['slug'];
    }

    // -----------------------------------------------------------------------------
    // Get country's states
    function get_country_cities($country_id)
    {
        $ci = & get_instance();
        return $ci->db->select('*')->where('country_id',$country_id)->get('rac_cities')->result_array();
    }

    // -----------------------------------------------------------------------------
    // Get city name by ID
    function get_city_name($id)
    {
        $ci = & get_instance();
        return $ci->db->get_where('rac_cities', array('id' => $id))->row_array()['name'];
    }

    // -----------------------------------------------------------------------------
    // Get city ID by title
    function get_city_slug($id)
    {
        $ci = & get_instance();
        return $ci->db->get_where('rac_cities', array('id' => $id))->row_array()['slug'];
    }


    // -----------------------------------------------------------------------------
    // Get category by ID
    function get_category_slug($id)
    {
        $ci = & get_instance();
        return $ci->db->get_where('rac_categories', array('id' => $id))->row_array()['slug'];
    }

    // -----------------------------------------------------------------------------
    // Get City ID by Name
    function get_city_id($title)
    {
        $ci = & get_instance();
        return $ci->db->get_where('rac_cities', array('slug' => $title))->row_array()['id'];
    }

    // -----------------------------------------------------------------------------
    // Get Nationality by ID
    function get_nationality_name($id)
    {
    	$ci = & get_instance();
    	return $ci->db->get_where('rac_countries', array('id' => $id))->row_array()['country'];
    }

    // -----------------------------------------------------------------------------
    // Get Degree list
    function get_education_list()
    {
        $ci = & get_instance();
        return $ci->db->get('rac_education')->result_array();
    }

    // -----------------------------------------------------------------------------
    // Get job type list
    function get_job_type_list()
    {
        $ci = & get_instance();
        return $ci->db->get('rac_job_type')->result_array();
    }
    
    // -----------------------------------------------------------------------------
    // Get job detail
    function get_job_detail($id)
    {
        $ci = & get_instance();
        $ci->db->select('*');
        $ci->db->where('id',$id);
        return $ci->db->get('rac_job_post')->row_array();
    }

    // -----------------------------------------------------------------------------
    // Get job type list
    function get_job_title($id)
    {
        $ci = & get_instance();
        return $ci->db->get_where('rac_job_type',array('id' => $id))->row_array()['title'];
    }

    // -----------------------------------------------------------------------------
    // Get job type list
    function get_job_type_name($id)
    {
        $ci = & get_instance();
        return $ci->db->get_where('rac_job_type',array('id' => $id))->row_array()['type'];
    }

    // -----------------------------------------------------------------------------
    // Get Nationality by ID
    function get_employment_type($id)
    {
        $ci = & get_instance();
        return $ci->db->get_where('rac_employment', array('id' => $id))->row_array()['type'];
    }


    // -----------------------------------------------------------------------------
    // Get Degree Level by ID
    function get_education_level($id)
    {
        $ci = & get_instance();
        return $ci->db->get_where('rac_education', array('id' => $id))->row_array()['type'];
    }

    // -----------------------------------------------------------------------------
    // Get User Firsti Name
    function get_user_fname($user_id)
    {
        $ci = & get_instance();
        return $ci->db->get_where('rac_users', array('id' => $user_id))->row_array()['firstname'];
    }

    // -----------------------------------------------------------------------------
    // Get User Last Name
    function get_user_lname($user_id)
    {
        $ci = & get_instance();
        return $ci->db->get_where('rac_users', array('id' => $user_id))->row_array()['lastname'];
    }

    // -----------------------------------------------------------------------------
    // Get User Resume
    function get_user_resume($user_id)
    {
        $ci = & get_instance();
        return $ci->db->get_where('rac_users', array('id' => $user_id))->row_array()['resume'];
    }

    // -----------------------------------------------------------------------------
    // Get User Skills
    function get_user_skills($user_id)
    {
        $ci = & get_instance();
        return $ci->db->get_where('rac_users', array('id' => $user_id))->row_array()['skills'];
    }
    
    // -----------------------------------------------------------------------------
    // Get User Email
    function get_user_email($user_id)
    {
        $ci = & get_instance();
        return $ci->db->get_where('rac_users', array('id' => $user_id))->row_array()['email'];
    }

    // -----------------------------------------------------------------------------
    // Get User Phone
    function get_user_phone($user_id)
    {
        $ci = & get_instance();
        return $ci->db->get_where('rac_users', array('id' => $user_id))->row_array()['mobile_no'];
    }

    // -----------------------------------------------------------------------------
    // Get Business Name by Employer ID
    function get_business_id_by_employer($emp_id)
    {
        $ci = & get_instance();
        return $ci->db->get_where('rac_businesses', array('business_id' => $emp_id))->row_array()['id'];
    }

    // -----------------------------------------------------------------------------
    // Get Business ID by title
    function get_business_id($title)
    {
        $ci = & get_instance();
        return $ci->db->get_where('rac_businesses', array('business_slug' => $title))->row_array()['id'];
    }

     // -----------------------------------------------------------------------------
    // Get Business Name by id
    function get_business_name($id)
    {
        $ci = & get_instance();
        return $ci->db->get_where('rac_businesses', array('id' => $id))->row_array()['business_name'];
    }

    //  get blog categories
    function get_blog_categories_list()
    {
        $ci = & get_instance();
        return $ci->db->get('rac_blog_categories')->result_array();
    }

    //  get blog posted categories
    function get_blog_posted_categories_list()
    {
        $ci = & get_instance();
        $ci->db->select('
            rac_blog_posts.category_id,
            rac_blog_categories.id,
            rac_blog_categories.slug,
            rac_blog_categories.name
            ');
        $ci->db->join('rac_blog_posts','rac_blog_posts.category_id = rac_blog_categories.id');
        $ci->db->group_by('rac_blog_posts.category_id');
        return $ci->db->get('rac_blog_categories')->result_array();
    }

    // -----------------------------------------------------------------------------
    function get_blog_categories_name($id)
    {
        $ci = & get_instance();
        return $ci->db->get_where('rac_blog_categories', array('id' => $id))->row_array()['name'];
    }

    // -----------------------------------------------------------------------------
    function get_post_tags_by_id($post_id)
    {
        $ci = & get_instance();
        return $ci->db->select('*')
        ->where(array('post_id' => $post_id))
        ->get('rac_blog_tags')
        ->result_array();
    }

    // -----------------------------------------------------------------------------
    function get_tags_list()
    {
        $ci = & get_instance();
        return $ci->db->select('*')
        ->group_by('tag')
        ->get('rac_blog_tags')
        ->result_array();
    }

    // -----------------------------------------------------------------------------
    function get_recent_blog_post()
    {
        $ci = & get_instance();
        return $ci->db->select('*')
        ->order_by('created_at','desc')
        ->limit(4)
        ->get('rac_blog_posts')
        ->result_array();
    }

    // -----------------------------------------------------------------------------
    function get_next_post($current_post_id)
    {
        $ci = & get_instance();
        return $ci->db->select('*')
        ->where('id >',$current_post_id)
        ->limit(1)
        ->get('rac_blog_posts')
        ->row_array();
    }

    // -----------------------------------------------------------------------------
    function get_previous_post($current_post_id)
    {
         $ci = & get_instance();
        return $ci->db->select('*')
        ->where('id <',$current_post_id)
        ->limit(1)
        ->get('rac_blog_posts')
        ->row_array();
    }

   /**
    * Used to insert new row if a duplicate entry is encounter it performs an update
    * @param string $table table name as string
    * @param array $data associative array of data and columns
    * @return mixed 
    */
	function updateOnExist($table, $data)
	{
		 $ci = & get_instance();
		 $columns    = array();
		 $values     = array();
		 $upd_values = array();
		 foreach ($data as $key => $val) {
			 $columns[]    = $ci->db->escape_identifiers($key);
			 $val = $ci->db->escape($val);
			 $values[]     = $val;
			 $upd_values[] = $key.'='.$val;
		 }
		 $sql = "INSERT INTO ". $ci->db->dbprefix($table) ."(".implode(",", $columns).")values(".implode(', ', $values).")ON DUPLICATE KEY UPDATE".implode(",", $upd_values);
		 return $ci->db->query($sql);
 	} 

/**
 * Generic function which returns the translation of input label in currently loaded language of user
 * @param $string
 * @return mixed
 */
function trans($string)
{
    $ci =& get_instance();
    return $ci->lang->line($string);
}

?>
