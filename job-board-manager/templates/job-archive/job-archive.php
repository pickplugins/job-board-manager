<?php
/*
* @Author 		PickPlugins
* Copyright: 	2016 PickPlugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

	$job_bm_job_login_page_id = get_option('job_bm_job_login_page_id');
	$job_bm_login_enable = get_option('job_bm_login_enable');	
	$job_bm_registration_enable = get_option('job_bm_registration_enable');
	$date_format = get_option( 'date_format' );
	$job_bm_list_per_page = get_option('job_bm_list_per_page');
	$job_bm_list_excerpt_word_count = get_option('job_bm_list_excerpt_word_count');	
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
	
	$meta_query = array();
	$tax_query = array();
	$job_category = '';
	
	if(empty($permalink_structure)){ $permalink_joint = '&'; }
	else{ $permalink_joint = '?'; }
	 
	if(empty($job_bm_list_per_page)){$job_bm_list_per_page = 10; }
	
	if ( get_query_var('paged') ) {$paged = get_query_var('paged');} 
	elseif ( get_query_var('page') ) {$paged = get_query_var('page');} 
	else {$paged = 1;}




	if(empty($keywords) && !empty($_GET['keywords'])){
		
		$keywords = sanitize_text_field($_GET['keywords']);

		}



	if( empty($location) && !empty($_GET['locations'])){

		$meta_query[] = array(
		
							'key' => 'job_bm_location',
							'value' => sanitize_text_field($_GET['locations']),
							'compare' => '=',
							
							);
		}
	else{
		
		if(!empty($location))
		$meta_query[] = array(
		
							'key' => 'job_bm_location',
							'value' => sanitize_text_field($location),
							'compare' => '=',
							
							);
		
		}





	if( empty($company_name) && !empty($_GET['company_name'])){

		$meta_query[] = array(
		
							'key' => 'job_bm_company_name',
							'value' => sanitize_text_field($_GET['company_name']),
							'compare' => '=',
							
							);
		
		}
	else{
		
		if(!empty($company_name))
		$meta_query[] = array(
		
							'key' => 'job_bm_company_name',
							'value' => sanitize_text_field($company_name),
							'compare' => '=',
							
							);		
							
		}





	
	if(!empty($_GET['job_cat'])){
		
			$job_category = sanitize_text_field($_GET['job_cat']);
			
			//var_dump($job_category);
		
			$tax_query[] = array(
								'taxonomy' => 'job_category',
								'field'    => 'slug',
								'terms'    => $job_category,
								//'operator'    => '',
								);
		}

	
	
	

	
	if( empty($job_type) && !empty($_GET['job_type'])){
		
		$meta_query_job_type = array();

		if(is_array($_GET['job_type'])){
			
			foreach($_GET['job_type'] as $type){
				
				$meta_query_job_type[] = array(
				
									'key' => 'job_bm_job_type',
									'value' => sanitize_text_field($type),
									'compare' => '=',
									
									);			
				} 
			
			$meta_query = array_merge(array('relation' => 'OR'), $meta_query_job_type);

			}
		else{
				$meta_query[] = array(
				
									'key' => 'job_bm_job_type',
									'value' => sanitize_text_field($_GET['job_type']),
									'compare' => '=',
									
									);
			}
		}
	
	else{
		if(!empty($job_type))
		$meta_query[] = array(
		
							'key' => 'job_bm_job_type',
							'value' => sanitize_text_field($job_type),
							'compare' => '=',
							
							);
		}	
	
	
	
	if(empty($job_status) && !empty($_GET['job_status'])){

		$meta_query[] = array(
		
							'key' => 'job_bm_job_status',
							'value' => sanitize_text_field($_GET['job_status']),
							'compare' => '=',
							
								);
		
		}	
	else{
		
		if(!empty($job_status))
		$meta_query[] = array(
		
							'key' => 'job_bm_job_status',
							'value' => sanitize_text_field($job_status),
							'compare' => '=',
							
								);		
		}
		
		
		
		
		
		
		
	if(!empty($_GET['expire_date'])){

		$meta_query[] = array(
		
							'key' => 'job_bm_expire_date',
							'value' => sanitize_text_field($_GET['expire_date']),
							'compare' => '=',
							
								);
		
		}		
		
		
	

	//echo '<pre>'.var_export($meta_query, true).'</pre>';	
	
	
	
/*


	if(!empty($_GET['job_type'])){
		
		$job_type = sanitize_text_field($_GET['job_type']);
		$meta_keys = 'job_bm_job_type';
		$meta_keys = explode(',',$meta_keys);
		
		//echo '<pre>'.var_export($_GET['job_type'], true).'</pre>';
		
		
		
		}
		
	elseif(!empty($_GET['job_status'])){
		
		$job_status = sanitize_text_field($_GET['job_status']);
		$meta_keys = 'job_bm_job_status';
		$meta_keys = explode(',',$meta_keys);

		}		
	elseif(!empty($_GET['expire_date'])){
		
		$expire_date = sanitize_text_field($_GET['expire_date']);
		$meta_keys = 'job_bm_expire_date';
		$meta_keys = explode(',',$meta_keys);

		}		
		
		
		
	else{
		
		$meta_keys = explode(',',$meta_keys);
		
		}


	

	foreach($meta_keys as $key){
		
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
		else{
			$meta_query[] = array();
			
			}			
			
		
		}


*/


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
			
			) );
	
	
	$job_list_grid_items = array(
/*

		'job_bm_company_logo'=>array('class'=>'company_logo','fa'=>'','title'=>''),
		'title'=>array('class'=>'title','fa'=>'title','title'=>''),
		'job_bm_short_content'=>array('class'=>'short_content','fa'=>'','title'=>__('Short Description','job-board-manager')),

*/							
		'clear'=>array('class'=>'clear','fa'=>'','title'=>''),
		'job_bm_job_type'=>array('class'=>'job_type','fa'=>'briefcase','title'=>__('Job Type','job-board-manager')),
		'job_bm_job_status'=>array('class'=>'job_status','fa'=>'eye','title'=>__('Job Status','job-board-manager')),
		'job_cat'=>array('class'=>'job_cat','fa'=>'dot-circle-o','title'=>__('Category','job-board-manager')),
		'job_bm_location'=>array('class'=>'location','fa'=>'map-marker','title'=>__('Location','job-board-manager')), // meta_key, meta css class, font awesome class
		'job_bm_company_name'=>array('class'=>'company_name','fa'=>'briefcase','title'=>__('Company name','job-board-manager')),
		'job_bm_total_vacancies'=>array('class'=>'total_vacancies','fa'=>'user-plus','title'=>__('Total Vacancies','job-board-manager')),
		'job_bm_expire_date'=>array('class'=>'expire_date','fa'=>'calendar-o','title'=>__('Expire Date','job-board-manager')),
		'job_bm_view_count'=>array('class'=>'view_count','fa'=>'eye','title'=>__('View count','job-board-manager')),
	);
	
							
	$job_list_grid_items = apply_filters('job_bm_filters_job_list_grid_items', $job_list_grid_items);		
					
	
	?>
	<div class="job-list">
    
    
    
    
    
	<?php
	//if($display_search == 'yes'){
		include( job_bm_plugin_dir . 'templates/job-archive/search.php');
	//	}
	
	
	
	do_action('job_bm_action_before_job_list');

	//include('job-archive/filter.php');
	include( job_bm_plugin_dir . 'templates/job-archive/filter.php');
		
	if ( $wp_query->have_posts() ) :
	while ( $wp_query->have_posts() ) : $wp_query->the_post();	
	
	$job_id = get_the_ID();
	
	
	$job_bm_featured = get_post_meta(get_the_ID(), 'job_bm_featured', true);	
	$job_bm_company_logo = get_post_meta(get_the_ID(),'job_bm_company_logo', true);
	$job_bm_short_content = get_post_meta(get_the_ID(),'job_bm_short_content', true);

	foreach($job_list_grid_items as $meta_key=>$grid_data){
		$meta_key_values[$meta_key] = get_post_meta(get_the_ID(),$meta_key, true);
		}

	
	if($job_bm_featured=='yes' ){
		
		$featured_class = 'featured';
		}
	else{
		$featured_class = '';
		}
	
	echo '<div class="single '.$featured_class.'">';
	include( job_bm_plugin_dir . 'templates/job-archive/logo.php');
	include( job_bm_plugin_dir . 'templates/job-archive/title.php');
	include( job_bm_plugin_dir . 'templates/job-archive/excerpt.php');	
	include( job_bm_plugin_dir . 'templates/job-archive/meta.php');
	echo '</div>'; // .single

	//Display nth items custom html
	$job_list_ads_positions = apply_filters('job_list_ads_positions', array());
	
	if(!empty($job_list_ads_positions))
	foreach($job_list_ads_positions as $position){
		
		if( $wp_query->current_post == $position ){
			
			echo apply_filters('job_list_nth_item_html',$position); 
			
			}
		}
	


	endwhile;
	
	
	include( job_bm_plugin_dir . 'templates/job-archive/pagination.php');	

	
	
	wp_reset_query();
	else:
	
	echo __('No job found', 'job-board-manager');
	
	endif;		
		
	do_action('job_bm_action_after_job_list');	
	
	
	echo '<style type="text/css">'; 			
			
	echo '.job-list .single.featured{background:'.$job_bm_featured_bg_color.'}';			
		
	if(!empty($job_bm_job_type_bg_color)){
		foreach($job_bm_job_type_bg_color as $job_type_key=>$job_type_color){
			
			echo '.job-list .job_type.'.$job_type_key.'{background:'.$job_type_color.'}';			
			}
		}

	if(!empty($job_bm_job_status_bg_color)){
		foreach($job_bm_job_status_bg_color as $job_status_key=>$job_status_color){
			
			echo '.job-list .job_status.'.$job_status_key.'{background:'.$job_status_color.'}';			
			}		
		}		
			
	echo '</style>';
	
	
		
	?>
	</div>	