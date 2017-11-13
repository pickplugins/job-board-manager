<?php
/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 
	

function job_bm_ajax_paginate_load_more(){
	
	$paged 			= $_POST['paged'];
	$meta_keys 		= $_POST['meta_keys'];
	$location 		= $_POST['location'];
	$company_name 	= $_POST['company_name'];
	$keywords 		= $_POST['keywords'];
	$job_type 		= $_POST['job_type'];
	$job_status		= $_POST['job_status'];
	
	
	$job_bm_job_login_page_id = get_option('job_bm_job_login_page_id');
	$job_bm_login_enable = get_option('job_bm_login_enable');	
	$job_bm_registration_enable = get_option('job_bm_registration_enable');
	$date_format = get_option( 'date_format' );
	$job_bm_list_per_page = get_option('job_bm_list_per_page');
	$job_bm_list_excerpt_display = get_option('job_bm_list_excerpt_display');
	$job_bm_hide_expired_job_inlist = get_option('job_bm_hide_expired_job_inlist');	
	$job_bm_job_type_bg_color = get_option('job_bm_job_type_bg_color');	
	$job_bm_job_status_bg_color = get_option('job_bm_job_status_bg_color');	
	$job_bm_featured_bg_color = get_option('job_bm_featured_bg_color');			
	$job_bm_archive_page_id = get_option('job_bm_archive_page_id');
	$job_bm_archive_page_link = get_permalink($job_bm_archive_page_id);
	$permalink_structure = get_option('permalink_structure');
	
	
	$class_job_bm_functions = new class_job_bm_functions();
	$job_type_list = $class_job_bm_functions->job_type_list();
	$job_status_list = $class_job_bm_functions->job_status_list();	

	$tax_query = array();
	$job_category = '';
	
	if(empty($permalink_structure)){ $permalink_joint = '&'; }
	else{ $permalink_joint = '?'; }
	 
	if(empty($job_bm_list_per_page)){$job_bm_list_per_page = 10; }
	
	
	if(!empty($_POST['job_cat'])){
		
		$job_category = $_POST['job_cat'];
		$tax_query[] = array(
			'taxonomy' => 'job_category',
			'field'    => 'slug',
			'terms'    => $job_category,
		);
	}
	

	if(!empty($_POST['job_type'])){
		
		$job_type = $_POST['job_type'];
		$meta_keys = 'job_bm_job_type';
		$meta_keys = explode(',',$meta_keys);
	
	} elseif(!empty($_POST['job_status'])) {
		
		$job_status = $_POST['job_status'];
		$meta_keys = 'job_bm_job_status';
		$meta_keys = explode(',',$meta_keys);

	} elseif(!empty($_POST['expire_date'])) {
		
		$expire_date = $_POST['expire_date'];
		$meta_keys = 'job_bm_expire_date';
		$meta_keys = explode(',',$meta_keys);
	
	} else $meta_keys = explode(',',$meta_keys);
		
	
	
	foreach($meta_keys as $key) {
		
		if($key=='job_bm_location'){
			$meta_query[] = array(
				'key' => $key,
				'value' => $location,
				'compare' => '=',
			);
		}
		elseif($key=='job_bm_job_status'){
			$meta_query[] = array(
				'key' => $key,
				'value' => $job_status,
				'compare' => '=',
			);
		}
		elseif($key=='job_bm_job_type'){
			$meta_query[] = array(
				'key' => $key,
				'value' => $job_type,
				'compare' => '=',
			);
		}			
		elseif($key=='job_bm_company_name'){
			$meta_query[] = array(
				'key' => $key,
				'value' => $company_name,
				'compare' => '=',
			);
		}			
		elseif($key=='job_bm_expire_date'){
			$meta_query[] = array(
				'key' => $key,
				'value' => $expire_date,
				'compare' => '=',
			);
		}
		else $meta_query[] = array();
	}

	$wp_query = new WP_Query(
		array (
			'post_type' => 'job',
			'post_status' => 'publish',
			's' => $keywords,
			'orderby' => 'Date',
			'meta_query' => $meta_query,
			'tax_query' => $tax_query,			
			'order' => 'DESC',
			'posts_per_page' => $job_bm_list_per_page,
			'paged' => $paged,
			
			) 
	);
	
	//echo '<pre>'; print_r( $wp_query ); echo '</pre>';
	
	$job_list_grid_items = array(
					
		'clear'=>array('class'=>'clear','fa'=>'','title'=>''),
		'job_bm_job_type'=>array('class'=>'job_type','fa'=>'briefcase','title'=>__('Job Type',job_bm_textdomain)),
		'job_bm_job_status'=>array('class'=>'job_status','fa'=>'eye','title'=>__('Job Status',job_bm_textdomain)),	
		'job_cat'=>array('class'=>'job_cat','fa'=>'dot-circle-o','title'=>__('Category',job_bm_textdomain)),																	
		'job_bm_location'=>array('class'=>'location','fa'=>'map-marker','title'=>__('Location',job_bm_textdomain)),
		'job_bm_company_name'=>array('class'=>'company_name','fa'=>'briefcase','title'=>__('Company name',job_bm_textdomain)),							
		'job_bm_total_vacancies'=>array('class'=>'total_vacancies','fa'=>'user-plus','title'=>__('Total Vacancies',job_bm_textdomain)),								
		'job_bm_expire_date'=>array('class'=>'expire_date','fa'=>'calendar-o','title'=>__('Expire Date',job_bm_textdomain)),																
	);
							
	$job_list_grid_items = apply_filters('job_bm_filters_job_list_grid_items', $job_list_grid_items);		
					
	
	
	if ( $wp_query->have_posts() ) :
	while ( $wp_query->have_posts() ) : $wp_query->the_post();	
	
		$job_id = get_the_ID();
	
		$job_bm_featured = get_post_meta(get_the_ID(), 'job_bm_featured', true);	
		$job_bm_company_logo = get_post_meta(get_the_ID(),'job_bm_company_logo', true);
		$job_bm_short_content = get_post_meta(get_the_ID(),'job_bm_short_content', true);
	
		foreach($job_list_grid_items as $meta_key=>$grid_data){
			$meta_key_values[$meta_key] = get_post_meta(get_the_ID(),$meta_key, true);
		}
	
		
		if(($job_bm_featured=='yes') ) $featured_class = 'featured';
		else $featured_class = '';
		
		echo '<div class="single '.$featured_class.'" id="paged-'.$paged.'">';
		include( job_bm_plugin_dir . 'templates/job-arhive/logo.php');
		include( job_bm_plugin_dir . 'templates/job-arhive/title.php');
		include( job_bm_plugin_dir . 'templates/job-arhive/excerpt.php');	
		include( job_bm_plugin_dir . 'templates/job-arhive/meta.php');
		echo '</div>';
	
	/*
	
		$job_list_ads_positions = apply_filters('job_list_ads_positions', array());
		
		if(!empty($job_list_ads_positions)) {
			foreach($job_list_ads_positions as $position){
				if( $wp_query->current_post == $position ) echo apply_filters('job_list_nth_item_html',$position); 
			}
		}
	
	*/
	
	
	endwhile;
	wp_reset_query();
	
	else:
	
	//echo 'No post';
	
	
	endif;

	die();
}	
	
add_action('wp_ajax_job_bm_ajax_paginate_load_more', 'job_bm_ajax_paginate_load_more');
add_action('wp_ajax_nopriv_job_bm_ajax_paginate_load_more', 'job_bm_ajax_paginate_load_more');	
	
	
	
	
	
	
	
	
function job_bm_ajax_post_id_serialize(){
	
		$attachment_id = $_POST['attachment_id'];

		echo serialize(array($attachment_id));
		die();
	}	
	
	
add_action('wp_ajax_job_bm_ajax_post_id_serialize', 'job_bm_ajax_post_id_serialize');
add_action('wp_ajax_nopriv_job_bm_ajax_post_id_serialize', 'job_bm_ajax_post_id_serialize');	
	
	
	
function job_bm_ajax_welcome_subscribe_email(){
	
	if(current_user_can('manage_options')){
		
		$current_user = wp_get_current_user();
	
		$firstname = $current_user->user_firstname;
		$lastname = $current_user->user_lastname;	
		$user_email = $current_user->user_email;		
	

		define('PICKPLUGINS_SERVER_URL', 'http://www.pickplugins.com/subscribe/'); 


        $api_params = array(
            'action'		=> 'subscribe',		
            'firstname'		=> $firstname,
            'lastname'		=> $lastname,
            'user_email'	=> $user_email,			
			
        );

        // Send query to the license manager server
        $query = esc_url_raw(add_query_arg($api_params, PICKPLUGINS_SERVER_URL));
        $response = wp_remote_get($query, array('timeout' => 20, 'sslverify' => false));



        // Check for error in the response
        if (is_wp_error($response)){
            echo "Unexpected Error! The query returned with an error.";
        }
        
        // License data.
        $license_data = json_decode(wp_remote_retrieve_body($response));
	
		$message = $license_data->message;
		$status = $license_data->status;		
		
		echo $message;
		
		}
	


	
	die();
	}
	
	
	
add_action('wp_ajax_job_bm_ajax_welcome_subscribe_email', 'job_bm_ajax_welcome_subscribe_email');	
	
	
	
	
	
	
/*


function get_post_athuro_id(){
	
	$post_7 = get_post( 1 ); 
	$post_author = $post_7->post_author;
	
	$author_obj = get_user_by('id', $post_author);
	
	$author_email = $author_obj->user_email;
	
	//$author_email = $post_7->user_email;
	
	var_dump($author_email);
	
	}
add_shortcode('get_post_athuro_id','get_post_athuro_id');

*/
	
	
	
	
function job_bm_ajax_reset_email_templates_data(){
	
		$class_job_bm_emails = new class_job_bm_emails();
		$templates_data = $class_job_bm_emails->job_bm_email_templates_data();
	
		update_option('job_bm_email_templates_data', $templates_data);	
	
		die();
	}	
	
	
add_action('wp_ajax_job_bm_ajax_reset_email_templates_data', 'job_bm_ajax_reset_email_templates_data');
add_action('wp_ajax_nopriv_job_bm_ajax_reset_email_templates_data', 'job_bm_ajax_reset_email_templates_data');

function job_bm_ajax_delete_attachment(){

		
		$attach_id = (int)$_POST['attach_id'];
		
		if(is_user_logged_in()){
	
			$current_user_id = get_current_user_id();
			$post_data = get_post($attach_id, ARRAY_A);

			$author_id = $post_data['post_author'];
			
			if( $current_user_id == $author_id ) {
				
				
				$cookie_name = 'classified_maker_ads_thumbs';
				
					if(isset($_COOKIE[$cookie_name])){
						
						$attach_ids = $_COOKIE[$cookie_name]; 
						$attach_ids = explode(',',$attach_ids);
						
						if(($key = array_search($attach_id, $attach_ids)) !== false) {
						unset($attach_ids[$key]);
						$cookie_value = implode(',',$attach_ids);
						setcookie($cookie_name, $cookie_value, time() + (86400 * 30), '/');
						
						$html =  $cookie_value;
						}
						
						
					}
				
				
				
				
				wp_delete_attachment( $attach_id );
				
				
				
				
				
				
				}
			else{
				
				$html = __('You are not authorized',classified_maker_textdomain);
				}
			
			
			}



		echo $html;
		
		
		die();
		
	}


add_action('wp_ajax_job_bm_ajax_delete_attachment', 'job_bm_ajax_delete_attachment');
add_action('wp_ajax_nopriv_job_bm_ajax_delete_attachment', 'job_bm_ajax_delete_attachment');


	
	
	
	
	
add_filter( 'add_menu_classes', 'show_pending_number');
function show_pending_number( $menu ) {
    $type = "job";
    $status = "pending";
    $num_posts = wp_count_posts( $type, 'readable' );
    $pending_count = 0;
    if ( !empty($num_posts->$status) )
        $pending_count = $num_posts->$status;

    // build string to match in $menu array
    if ($type == 'post') {
        $menu_str = 'edit.php';
    // support custom post types
    } else {
        $menu_str = 'edit.php?post_type=' . $type;
    }

    // loop through $menu items, find match, add indicator
    foreach( $menu as $menu_key => $menu_data ) {
        if( $menu_str != $menu_data[2] )
            continue;
        $menu[$menu_key][0] .= " <span class='update-plugins count-$pending_count'><span class='plugin-count'>" . number_format_i18n($pending_count) . '</span></span>';
    }
    return $menu;
}
	
	
	
	
	
function job_bm_filter_sidebar_sections($sections){
	
	unset($sections['apply_methods']);
					
	$html_apply_method = '';				
						
	$job_bm_how_to_apply = get_post_meta(get_the_ID(),'job_bm_how_to_apply', true);				
						
	if(!empty($job_bm_how_to_apply)){
		$html_apply_method .= '<div class="side-meta"><i class="fa fa-trophy"></i> '.__('How to Apply ?<br> ',job_bm_textdomain).$job_bm_how_to_apply.'</div>';
		
		}

	$apply_method_html['direct_email'] = '<div class="side-meta"><i class="fa fa-envelope-o"></i> '.__('Apply via email :',job_bm_textdomain).'<a class="apply-job" href="mailto:'.$job_bm_contact_email.'?subject='.get_the_title().'">Send Email</a></div>';


	
	$apply_method_html = apply_filters('job_bm_filters_apply_method_html',$apply_method_html);
	
	
	$job_bm_apply_method = get_option('job_bm_apply_method');
	
	if(empty($job_bm_apply_method)){
		
		$job_bm_apply_method = array('direct_email');
	}
	
	
	if(!empty($job_bm_apply_method)){
		
		foreach($job_bm_apply_method as $key=>$method){
				
			if(!empty($apply_method_html[$method]))
				$html_apply_method .= $apply_method_html[$method];

			}
		
		}
		
	$apply_allowed_job_status = array('open','re-open');
	$apply_not_allowed_job_status = apply_filters('job_bm_filters_apply_allowed_job_status',$apply_allowed_job_status);	
			
						
	if(!in_array($job_bm_job_status, $apply_not_allowed_job_status)){ 
		
		if(!empty($job_status_list[$job_bm_job_status]))
		$html_apply_method = '<i class="fa fa-exclamation-triangle"></i> This job already <b>'.$job_status_list[$job_bm_job_status].'</b>, <br> Application not allowed this job status.';
		
		}			
				
						
	$sections['apply_methods'] = array(
						'title'=>__('Apply on this job',job_bm_textdomain),
						'html'=> $html_apply_method,						
						);						
						
						

	return $sections;
	
	}

//add_filter('job_bm_filter_sidebar_sections','job_bm_filter_sidebar_sections');
	

	
	
	
/*


function job_bm_filters_job_type_extra($job_type){
    
    $job_type_new = array('scholarship'=>'Scholarship');
    $job_type = array_merge($job_type,$job_type_new);
    
    return $job_type;
        
    }
add_filter('job_bm_filters_job_type','job_bm_filters_job_type_extra');
	
	
	
function job_bm_filters_job_type_bg_color_extra($job_status_color){
    
    $job_status_color_new = array('scholarship'=>'#40cec9');
    $job_status_color = array_merge($job_status_color,$job_status_color_new);
    
    return $job_status_color;
        
    }
add_filter('job_bm_filters_job_type_bg_color','job_bm_filters_job_type_bg_color_extra');	















function job_bm_filter_job_input_fields_extra($input_fields){
    

	$meta_fields = $input_fields['meta_fields'];
	
	// Add new fields in company tab , default meta group is company_info, job_info, salary_info, application
	
	$company_info = $meta_fields['company_info']['meta_fields'];

    $company_field_extra[] = array(
									'meta_key'=>'job_bm_company_extra',
									'css_class'=>'company_extra',
									'placeholder'=>__('Write Company Name Extra.',job_bm_textdomain),					
									'title'=>__('Company Extra',job_bm_textdomain),
									'option_details'=>__('Company Extra, ex: Google Inc.',job_bm_textdomain),						
									'input_type'=>'text', // text, radio, checkbox, select, 
									'input_values'=>'', // could be array
									);
			
									
	$company_info = array_merge($company_info, $company_field_extra);						
	
	$input_fields['meta_fields']['company_info']['meta_fields'] = 	$company_info;

									
	return $input_fields;
        
    }

add_filter('job_bm_filter_job_input_fields','job_bm_filter_job_input_fields_extra');


*/

add_shortcode('job_bm_ajax_update_fields','job_bm_ajax_update_fields');


	
	function job_bm_ajax_update_fields() {
		
		$class_job_bm_functions = new class_job_bm_functions();
		$post_type_input_fields = $class_job_bm_functions->post_type_input_fields();
		//echo '<pre>'.var_export($post_type_input_fields['meta_fields'], true).'</pre>';;
		
		
		$meta_fields = $post_type_input_fields['meta_fields'];
		///echo '<pre>'.var_export($meta_fields, true).'</pre>';;
		
		$job_bm_field_editor = get_option( 'job_bm_field_editor' );
		//echo '<pre>'.var_export($job_bm_field_editor, true).'</pre>';
		
		
		foreach($meta_fields as $group_key=>$fields_group){
			
			$meta_fields = $fields_group['meta_fields'];
			$title =$fields_group['title']; 		
			$details =$fields_group['details'];	
			
			$meta_fields_new[$group_key]['title'] = $title;
			$meta_fields_new[$group_key]['details'] = $details;
			$meta_fields_new[$group_key]['meta_fields'] =array_merge($meta_fields, $job_bm_field_editor[$group_key]['meta_fields']);						
			
			
			
			//$meta_fields_new[$group_key]= array_merge($meta_fields, $job_bm_field_editor[$group_key]['meta_fields']);
			
			
			//echo '<pre>'.var_export($meta_fields, true).'</pre>';
			//echo '<pre>'.var_export($job_bm_field_editor[$group_key]['meta_fields'], true).'</pre>';			
						
			}
		
		
		//echo '<pre>'.var_export($meta_fields_new, true).'</pre>';
	
		
		update_option('job_bm_field_editor', $meta_fields_new);
		
		echo '<i class="fa fa-check"></i> '.__('Update Done',job_bm_textdomain);
		
		die();
		}
	
	
	add_action('wp_ajax_job_bm_ajax_update_fields', 'job_bm_ajax_update_fields');
	add_action('wp_ajax_nopriv_job_bm_ajax_update_fields', 'job_bm_ajax_update_fields');		
	
	
	
	function job_bm_ajax_reset_fields() {
		
		$class_job_bm_functions = new class_job_bm_functions();
		$post_type_input_fields = $class_job_bm_functions->post_type_input_fields();
		
		$meta_fields = $post_type_input_fields['meta_fields'];
		
		update_option('job_bm_field_editor', $meta_fields);
		
		//echo 'Reset Done';
		echo '<i class="fa fa-check"></i> '.__('Reset Done',job_bm_textdomain);
		die();
		}
	
	
	add_action('wp_ajax_job_bm_ajax_reset_fields', 'job_bm_ajax_reset_fields');
	add_action('wp_ajax_nopriv_job_bm_ajax_reset_fields', 'job_bm_ajax_reset_fields');	
	
	
	
	
	
	
	function job_bm_ajax_delete_job_by_id() {
		
		$job_bm_can_user_delete_jobs = get_option('job_bm_can_user_delete_jobs');
		
		$html = '';
		
		
		if($job_bm_can_user_delete_jobs=='no'){
			
			$html.= '<i class="fa fa-exclamation-circle"></i> '.__('You are not authorized to delete this job.',job_bm_textdomain);

			}
		else{
			
			$job_id = (int)$_POST['job_id'];
	
			$current_user_id = get_current_user_id();
			
			$post_data = get_post($job_id, ARRAY_A);
	
			$author_id = $post_data['post_author'];		
		
			if( $current_user_id == $author_id ) {
				
				if(wp_delete_post($job_id)){
					$html.=	'<i class="fa fa-check"></i> '.__('Job Deleted.',job_bm_textdomain);
					}
				else{
					$html.=	'<i class="fa fa-exclamation-circle"></i> '.__('Something going wrong.',job_bm_textdomain);
					}
				}
				
			else{
				
				$html.=	'<i class="fa fa-exclamation-circle"></i> '.__('You are not authorized to delete this job.',job_bm_textdomain);
				}
			}
			
		
		
		
		

		
		echo $html;
		
		die();
		}

	add_action('wp_ajax_job_bm_ajax_delete_job_by_id', 'job_bm_ajax_delete_job_by_id');
	add_action('wp_ajax_nopriv_job_bm_ajax_delete_job_by_id', 'job_bm_ajax_delete_job_by_id');

	
	
	
	
	
	

add_action('wp_ajax_photo_gallery_upload', function(){

  check_ajax_referer('photo-upload');

  // you can use WP's wp_handle_upload() function:
		$file = $_FILES['async-upload'];

		$status = wp_handle_upload($file, array('action' => 'photo_gallery_upload'));

		$file_loc = $status['file'];
		$file_name = basename($status['name']);
		$file_type = wp_check_filetype($file_name);
	
		$attachment = array(
			'post_mime_type' => $status['type'],
			'post_title' => preg_replace('/\.[^.]+$/', '', basename($file['name'])),
			'post_content' => '',
			'post_status' => 'inherit'
		);
	
		$attach_id = wp_insert_attachment($attachment, $file_loc);
		$attach_data = wp_generate_attachment_metadata($attach_id, $file_loc);
		wp_update_attachment_metadata($attach_id, $attach_data);
		//echo $attach_id;
	
		$attach_title = get_the_title($attach_id);
	
		$html['attach_url'] = wp_get_attachment_url($attach_id);
		$html['attach_id'] = $attach_id;
		$html['attach_title'] = get_the_title($attach_id);	
	
		$response = array(
							'status'=>'ok',
							'html'=>$html,
							
							
							);
	
		echo json_encode($response);

  exit;
});

	
	
	

















	
	
	
//add_action( 'init', 'job_bm_revoke_admin_access' );


function job_bm_revoke_admin_access() {
	
	if(is_user_logged_in()){
		
		$job_bm_hide_admin_bar_role = get_option('job_bm_hide_admin_bar_role');
		
		
		
		if(empty($job_bm_hide_admin_bar_role)){
			
			$job_bm_hide_admin_bar_role = array('none');
			}
		
		$current_user = wp_get_current_user();
		$user_role = $current_user->roles;
		
		
		$user_role = $user_role[0];
		//var_dump($user_role);
		//var_dump($job_bm_hide_admin_bar_role);
		
		if(in_array($user_role,$job_bm_hide_admin_bar_role) ){
				header( home_url() ); 
			}
		
		}

	
}
	
	
	
	
//add_action('after_setup_theme', 'job_bm_remove_admin_bar');

function job_bm_remove_admin_bar() {
	
	if(is_user_logged_in()){
		
		$job_bm_hide_admin_bar_role = get_option('job_bm_hide_admin_bar_role');
		
		if(empty($job_bm_hide_admin_bar_role)){
			
			$job_bm_hide_admin_bar_role = array('none');
			}
		
		
		$current_user = wp_get_current_user();
		$user_role = $current_user->roles;
		$user_role = $user_role[0];
		//var_dump($user_role);
		//var_dump($job_bm_hide_admin_bar_role);
		
		if(in_array($user_role,$job_bm_hide_admin_bar_role)){
			show_admin_bar(false);
	
			}
		
		}


}
	






function job_bm_list_user_roles(){

	global $wp_roles;
	$all_roles = $wp_roles->roles;

	foreach($all_roles as $role_key=>$role_data){
		
		$all_roles[$role_key] = $role_data['name'];
		}
		
	return array_merge( array('none'=>__('None',job_bm_textdomain)),$all_roles);
	
	}









/*

function job_bm_job_single_content($content){
	
	
	if ( is_singular( 'job' ) ) {
		$content = '';
		$content.= do_shortcode('[job_single job_id="'.get_the_ID().'"]');				
		}
	
	
	
	return $content;
	
	}

add_filter('the_content','job_bm_job_single_content');


*/


	
	
function job_bm_sanitize_data($input_type, $input_values){

	if($input_type=='text' or $input_type=='textarea' or $input_type=='select' or $input_type=='radio' ){
		
		$input_values = sanitize_text_field($input_values);
		}
	elseif($input_type=='file'){
		
		$input_values = esc_url($input_values);
		}
	else{
		
		$input_values = $input_values;
		}	

	return $input_values;
	}
	
	
	
	
	function job_bm_page_list_id()
		{	
			$wp_query = new WP_Query(
				array (
					'post_type' => 'page',
					'posts_per_page' => -1,
					) );
					
			$pages_ids = array();
					
			if ( $wp_query->have_posts() ) :
			
	
			while ( $wp_query->have_posts() ) : $wp_query->the_post();
			
			$pages_ids[get_the_ID()] = get_the_title();
			
			
			endwhile;
			wp_reset_query();
			endif;
			
			
			return $pages_ids;
		
		}
	
	
	




	function job_bm_get_date(){	
	
			$gmt_offset = get_option('gmt_offset');
			$wpls_datetime = date('Y-m-d', strtotime('+'.$gmt_offset.' hour'));
			
			return $wpls_datetime;
		
		}


/*### Extend job meta options sample ###*/


/*

function job_list_item_start_extra($content=''){
	

	$content = '<br >Hello<br >';


	return $content;
		
	}

*/






function job_bm_get_terms($taxonomy){

		
		//$cat_id = (int)$_POST['cat_id'];
		if(!isset($taxonomy)){
			$taxonomy = 'job_category';
			}
		
		
		$args=array(
			
		  'orderby' => 'id',
		  'taxonomy' => $taxonomy,
		  'hide_empty' => false,
		  'parent'  => 0,
		  );
		
		$categories = get_categories($args);

			
		$html = '';
		
		if(!empty($categories)){
			
			foreach($categories as $category){
				
					$name = $category->name;
					$cat_ID = $category->cat_ID;	
				
					$terms[$cat_ID] = 	$name;	
					
					$args_child=array(
						
					  'orderby' => 'id',
					  'taxonomy' => $taxonomy,
					  'hide_empty' => false,
					  'parent'  => $cat_ID,
					  );
					
					$categories_child = get_categories($args_child);
					
					if(!empty($categories_child))
					foreach($categories_child as $category_child){
						
						$name_child = $category_child->name;
						$cat_ID_child = $category_child->cat_ID;	
						
						$terms[$cat_ID_child] = $name_child;
						
						}
					
					
					
					//$html.= '<li cat-id="'.$cat_ID.'"><i class="fa fa-check"></i> '.$name;
					//$html.= '</li>';
	
				}
			
			
			}
		else{
			$terms = array();
			}
		
		
		return $terms;

	}



function job_bm_get_terms_hierarchical($taxonomy){

		
		//$cat_id = (int)$_POST['cat_id'];
		if(!isset($taxonomy)){
			$taxonomy = 'job_category';
			}
		
		
		$args=array(
			
		  'orderby' => 'id',
		  'taxonomy' => $taxonomy,
		  'hide_empty' => false,
		  'parent'  => 0,
		  );
		
		$categories = get_categories($args);

			
		$html = '';
		
		if(!empty($categories)){
			
			foreach($categories as $category){
				
					$name = $category->name;
					$cat_ID = $category->cat_ID;	
				
					$terms[$cat_ID] = 	$name;	
					
					$args_child=array(
						
					  'orderby' => 'id',
					  'taxonomy' => $taxonomy,
					  'hide_empty' => false,
					  'parent'  => $cat_ID,
					  );
					
					$categories_child = get_categories($args_child);
					
					if(!empty($categories_child))
					foreach($categories_child as $category_child){
						
						$name_child = $category_child->name;
						$cat_ID_child = $category_child->cat_ID;	
						
						$terms[$cat_ID_child] = $name_child;
						
						}
					
					
					
					//$html.= '<li cat-id="'.$cat_ID.'"><i class="fa fa-check"></i> '.$name;
					//$html.= '</li>';
	
				}
			
			
			}
		else{
			$terms = array();
			}
		
		
		return $terms;

	}













function job_bm_get_child_cats(){

		$html = '';
		$cat_id = (int)$_POST['cat_id'];
		
		$taxonomy = 'job_category';
		
		$args=array(
		  'orderby' => 'name',
		  'order' => 'ASC',
		  'taxonomy' => $taxonomy,
		  'hide_empty' => false,
		  'child_of'  => $cat_id,
		  );
		
		$categories = get_categories($args);

		//var_dump();
		
		
		if(!empty($categories)){
			
			foreach($categories as $category){
				
				$name = $category->name;
				$cat_ID = $category->cat_ID;	
		
					$html.= '<li cat-id="'.$cat_ID.'"><i class="fa fa-check"></i> '.$name.'</li>';
	
				}
			
			}
		
		

		
		
		echo $html;
		
		
		die();
		
	}





add_action('wp_ajax_job_bm_get_child_cats', 'job_bm_get_child_cats');
add_action('wp_ajax_nopriv_job_bm_get_child_cats', 'job_bm_get_child_cats');











