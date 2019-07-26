<?php
/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 





function job_bm_single_job_view_count(){

	if ( is_singular( 'job' )){
		$cookie_name = 'job_bm_view';
		$job_id = get_the_ID();
		$job_bm_view_count = (int) get_post_meta(get_the_ID(),'job_bm_view_count', true);
		update_post_meta(get_the_ID(), 'job_bm_view_count', ($job_bm_view_count+1));

/*
 *
 * 		if(isset($_COOKIE[$cookie_name.'_'.$job_id])){

		}
		else{
			// Update +1 view count
			setcookie( $cookie_name.'_'.$job_id, $job_id, time() + (86400 * 30)); // 86400 = 1 day
			update_post_meta(get_the_ID(), 'job_bm_view_count', ($job_bm_view_count+1));
		}
 *
 * */

	}

}

add_action('wp_head','job_bm_single_job_view_count');









function job_bm_ajax_paginate_load_more(){
	
	$paged 			= sanitize_text_field($_POST['paged']);
	$meta_keys 		= sanitize_text_field($_POST['meta_keys']);
	$location 		= sanitize_text_field($_POST['location']);
	$company_name 	= sanitize_text_field($_POST['company_name']);
	$keywords 		= sanitize_text_field($_POST['keywords']);
	$job_type 		= sanitize_text_field($_POST['job_type']);
	$job_status		= sanitize_text_field($_POST['job_status']);
	
	
	$job_bm_job_login_page_id = get_option('job_bm_job_login_page_id');
	$job_bm_login_enable = get_option('job_bm_login_enable');
	$job_bm_registration_enable = get_option('job_bm_registration_enable');
	$date_format = get_option( 'date_format' );
	$job_bm_list_per_page = get_option('job_bm_list_per_page');
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
		
		$job_category = sanitize_text_field($_POST['job_cat']);
		$tax_query[] = array(
			'taxonomy' => 'job_category',
			'field'    => 'slug',
			'terms'    => $job_category,
		);
	}
	

	if(!empty($_POST['job_type'])){
		
		$job_type = sanitize_text_field($_POST['job_type']);
		$meta_keys = 'job_bm_job_type';
		$meta_keys = explode(',',$meta_keys);
	
	} elseif(!empty($_POST['job_status'])) {
		
		$job_status = sanitize_text_field($_POST['job_status']);
		$meta_keys = 'job_bm_job_status';
		$meta_keys = explode(',',$meta_keys);

	} elseif(!empty($_POST['expire_date'])) {
		
		$expire_date = sanitize_text_field($_POST['expire_date']);
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
		'job_bm_job_type'=>array('class'=>'job_type','fa'=>'briefcase','title'=>__('Job Type','job-board-manager')),
		'job_bm_job_status'=>array('class'=>'job_status','fa'=>'eye','title'=>__('Job Status','job-board-manager')),	
		'job_cat'=>array('class'=>'job_cat','fa'=>'dot-circle-o','title'=>__('Category','job-board-manager')),																	
		'job_bm_location'=>array('class'=>'location','fa'=>'map-marker','title'=>__('Location','job-board-manager')),
		'job_bm_company_name'=>array('class'=>'company_name','fa'=>'briefcase','title'=>__('Company name','job-board-manager')),							
		'job_bm_total_vacancies'=>array('class'=>'total_vacancies','fa'=>'user-plus','title'=>__('Total Vacancies','job-board-manager')),								
		'job_bm_expire_date'=>array('class'=>'expire_date','fa'=>'calendar-o','title'=>__('Expire Date','job-board-manager')),																
	);
							
	$job_list_grid_items = apply_filters('job_bm_filters_job_list_grid_items', $job_list_grid_items);		
					
	
	
	if ( $wp_query->have_posts() ) :
	while ( $wp_query->have_posts() ) : $wp_query->the_post();	
	
		$job_id = get_the_ID();
	
		$job_bm_featured = get_post_meta(get_the_ID(), 'job_bm_featured', true);	
		$job_bm_company_logo = get_post_meta(get_the_ID(),'job_bm_company_logo', true);

		foreach($job_list_grid_items as $meta_key=>$grid_data){
			$meta_key_values[$meta_key] = get_post_meta(get_the_ID(),$meta_key, true);
		}

		//var_dump($job_id);
		
		if(($job_bm_featured=='yes') ) $featured_class = 'featured';
		else $featured_class = '';
		
		echo '<div class="single '.$featured_class.'" id="paged-'.$paged.'">';
		$job_bm_default_company_logo = get_option('job_bm_default_company_logo');



		if(!empty($job_bm_company_logo)){

			if(is_serialized($job_bm_company_logo)){

				$job_bm_company_logo = unserialize($job_bm_company_logo);
				if(!empty($job_bm_company_logo[0])){
					$job_bm_company_logo = $job_bm_company_logo[0];
					$job_bm_company_logo = wp_get_attachment_url($job_bm_company_logo);
				}
				else{
					//$job_bm_company_logo = job_bm_plugin_url.'assets/admin/images/demo-logo.png';
					$job_bm_company_logo = $job_bm_default_company_logo;

				}
			}

		}
		else{
			//$job_bm_company_logo = job_bm_plugin_url.'assets/admin/images/demo-logo.png';
			$job_bm_company_logo = $job_bm_default_company_logo;

		}

		echo '<div class="company_logo">';
		echo '<img src="'.$job_bm_company_logo.'" />';
		echo '</div>';
		echo '<div title="" class="title"><a href="'.get_permalink().'">'.get_the_title().'</a></div>';


		echo '<div class="meta-list">';


		echo apply_filters('job_list_item_start',''); // filter job_list_item_after


		foreach($job_list_grid_items as $meta_key=>$grid_data){


			if($meta_key== 'job_bm_job_type'){

				if(!empty($meta_key_values[$meta_key]) && !empty($job_type_list[$meta_key_values[$meta_key]])){

					echo '<div  title="'.$grid_data['title'].'" class="job-meta  '.$grid_data['class'].' '.$meta_key_values[$meta_key].'"><i class="fa fa-'.$grid_data['fa'].'"></i><a href="'.$job_bm_archive_page_link.$permalink_joint.'job_type='.$meta_key_values[$meta_key].'">'.$job_type_list[$meta_key_values[$meta_key]].'</a></div>';
				}

			}

			elseif($meta_key== 'job_bm_job_status'){

				if(!empty($meta_key_values[$meta_key])){
					echo '<div title="'.$grid_data['title'].'" class="job-meta  '.$meta_key_values[$meta_key].' '.$grid_data['class'].'"><i class="fa fa-'.$grid_data['fa'].'"></i><a href="'.$job_bm_archive_page_link.$permalink_joint.'job_status='.$meta_key_values[$meta_key].'">'.$job_status_list[$meta_key_values[$meta_key]].'</a></div>';

				}

			}

			elseif($meta_key== 'job_cat'){

				$category = get_the_terms(get_the_ID(), 'job_category');

				//var_dump($category);

				if(!empty($category)){
					//$html.=	'<span><i class="fa fa-folder-open"></i> <a href="'.$archive_page_url.'?category='.$category[0]->slug.'">'.$category[0]->name.'</a></span>';
					echo '<div title="'.$grid_data['title'].'" class="job-meta  '.$meta_key_values[$meta_key].' '.$grid_data['class'].'"><i class="fa fa-'.$grid_data['fa'].'"></i><a href="'.$job_bm_archive_page_link.'?job_cat='.$category[0]->slug.'">'.$category[0]->name.'</a></div>';

				}



			}



			elseif($meta_key== 'job_bm_expire_date'){

				echo '<div title="'.$grid_data['title'].'" class="job-meta  '.$grid_data['class'].'"><i class="fa fa-'.$grid_data['fa'].'"></i><a href="'.$job_bm_archive_page_link.$permalink_joint.'expire_date='.$meta_key_values[$meta_key].'">'.date_i18n($date_format,strtotime($meta_key_values[$meta_key])).'</a></div>';


			}

			elseif($meta_key== 'job_bm_company_name'){

				if(post_type_exists('company')){
					$company_data = get_page_by_title( $meta_key_values[$meta_key], 'OBJECT', 'company' );
				}
				else{
					$company_data = '';
				}



				if(!empty($company_data)){

					$company_link = get_post_permalink($company_data->ID);

					$job_bm_link_to_company_archive_page = get_option('job_bm_link_to_company_archive_page');

					//var_dump($job_bm_link_to_company_archive_page);


					if(empty($company_link) || $job_bm_link_to_company_archive_page=='no'){

						$company_link = '#';
					}
				}
				else{

					$company_link = '#';
				}

				if(!empty($meta_key_values[$meta_key])){
					echo '<div title="'.$grid_data['title'].'" class="job-meta  '.$grid_data['class'].'"><i class="fa fa-'.$grid_data['fa'].'"></i><a href="'.$company_link.'">'.$meta_key_values[$meta_key].'</a></div>';
				}
			}

			elseif($meta_key== 'job_bm_location'){

				if(post_type_exists('location')){
					$location_data = get_page_by_title( $meta_key_values[$meta_key], 'OBJECT', 'location' );
				}
				else{
					$location_data = '';
				}

				//$location_data = get_page_by_title( $meta_key_values[$meta_key], 'OBJECT', 'location' );

				if(!empty($location_data)){

					$location_link = get_post_permalink($location_data->ID);
					if(empty($location_link)){

						$location_link = '#';

					}
				}
				else{

					$location_link = '#';
				}


				if(!empty($meta_key_values[$meta_key])){
					echo '<div title="'.$grid_data['title'].'" class="job-meta  '.$grid_data['class'].'"><i class="fa fa-'.$grid_data['fa'].'"></i><a href="'.$location_link.'">'.$meta_key_values[$meta_key].'</a></div>';
				}

			}


			else{
				if(!empty($meta_key_values[$meta_key])){
					echo '<div title="'.$grid_data['title'].'" class="job-meta  '.$grid_data['class'].'"><i class="fa fa-'.$grid_data['fa'].'"></i><a href="#">'.$meta_key_values[$meta_key].'</a></div>';
				}

			}


		}

		echo apply_filters('job_list_item_end',''); // filter job_list_item_after

		echo '</div>';

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
	
		$attachment_id = sanitize_text_field($_POST['attachment_id']);

		echo serialize(array($attachment_id));
		die();
	}	
	
	
add_action('wp_ajax_job_bm_ajax_post_id_serialize', 'job_bm_ajax_post_id_serialize');
add_action('wp_ajax_nopriv_job_bm_ajax_post_id_serialize', 'job_bm_ajax_post_id_serialize');	
	
	


	
	
	
function job_bm_ajax_reset_email_templates_data(){
	
		$class_job_bm_emails = new class_job_bm_emails();
		$templates_data = $class_job_bm_emails->job_bm_email_templates_data();
	
		update_option('job_bm_email_templates_data', $templates_data);	
	
		die();
	}	
	
	
add_action('wp_ajax_job_bm_ajax_reset_email_templates_data', 'job_bm_ajax_reset_email_templates_data');
add_action('wp_ajax_nopriv_job_bm_ajax_reset_email_templates_data', 'job_bm_ajax_reset_email_templates_data');


	
	
	
	
	
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
	
	
	
	


	
	

	
	
	
	
	
	function job_bm_ajax_delete_job_by_id() {
		
		$job_bm_can_user_delete_jobs = get_option('job_bm_can_user_delete_jobs');
		
		$html = '';
		
		
		if($job_bm_can_user_delete_jobs=='no'){
			
			$html.= '<i class="fa fa-exclamation-circle"></i> '.__('You are not authorized to delete this job.','job-board-manager');

			}
		else{
			
			$job_id = (int)sanitize_text_field($_POST['job_id']);
	
			$current_user_id = get_current_user_id();
			
			$post_data = get_post($job_id, ARRAY_A);
	
			$author_id = $post_data['post_author'];		
		
			if( $current_user_id == $author_id ){
				
				if(wp_delete_post($job_id)){
					$html.=	'<i class="fa fa-check"></i> '.__('Job Deleted.','job-board-manager');
					$response['is_deleted'] = 'yes';
					}
				else{
					$html.=	'<i class="fa fa-exclamation-circle"></i> '.__('Something going wrong.','job-board-manager');
					$response['is_deleted'] = 'no';
					}
				}
				
			else{
				
				$html.=	'<i class="fa fa-exclamation-circle"></i> '.__('You are not authorized to delete this job.','job-board-manager');
				$response['is_deleted'] = 'no';
				}
			}

		$response['html'] = $html;

		echo json_encode($response);

		//echo $html;
		
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
		
	return array_merge( array('none'=>__('None','job-board-manager')),$all_roles);
	
	}


	
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

            $pages_ids[''] = __('None','job-board-manager');

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

		
		//$cat_id = (int)sanitize_text_field($_POST['cat_id']);
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

		
		//$cat_id = (int)sanitize_text_field($_POST['cat_id']);
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
		$cat_id = (int)sanitize_text_field($_POST['cat_id']);
		
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



