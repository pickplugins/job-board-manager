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
		
		

	$query_args = array (
        'post_type' => 'job',
        'post_status' => 'publish',
        //'s' => $keywords,
        'orderby' => 'Date',
        //'meta_query' => $meta_query,
        //'tax_query' => $tax_query,
        'order' => 'DESC',
        'posts_per_page' => $job_bm_list_per_page,
        'paged' => $paged,

    );


    $query_args = apply_filters('job_bm_job_archive_query_args',$query_args);



	$wp_query = new WP_Query($query_args);

	?>
	<div class="job-list">
	<?php

    do_action('job_bm_job_archive_before');

	if ( $wp_query->have_posts() ) :
	while ( $wp_query->have_posts() ) : $wp_query->the_post();	
	
	$job_id = get_the_ID();

        do_action('job_bm_job_archive_loop', $job_id);


	endwhile;
        do_action('job_bm_job_archive_after');


        wp_reset_query();
	else:
	
        do_action('job_bm_job_archive_loop_no_post');

    endif;
		

	
	?>
        <style type="text/css">
    <?php
			
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
			

	
	
		
	?>
        </style>
	</div>	