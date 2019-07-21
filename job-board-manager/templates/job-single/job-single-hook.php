<?php
/*
* @Author 		PickPlugins
* Copyright: 	2015 PickPlugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 


function get_custom_post_type_template($single_template) {
     global $post;

     if ($post->post_type == 'job') {
        
		$single_template = locate_template( "single-job.php" );
		if( ! $single_template ) {
			
			$single_template = job_bm_plugin_dir . 'templates/job-single/job-single.php';
		}
     }
     return $single_template;
}
//add_filter( 'single_template', 'get_custom_post_type_template' );




function job_bmpost_type_template_job($content) {

	global $post;

	if ($post->post_type == 'job'){

		ob_start();
		include(job_bm_plugin_dir . 'templates/job-single/job-single.php');
		return ob_get_clean();
	}
	else{
		return $content;
	}

}
add_filter( 'the_content', 'job_bmpost_type_template_job' );

//add_action( 'job_bm_action_single_job_main', 'job_bm_template_single_job_title', 10 );
add_action( 'job_bm_action_single_job_main', 'job_bm_template_single_job_meta', 10 );
add_action( 'job_bm_action_single_job_main', 'job_bm_template_single_job_sidebar', 20 );
add_action( 'job_bm_action_single_job_main', 'job_bm_template_single_job_description', 20 );	
add_action( 'job_bm_action_single_job_main', 'job_bm_template_single_job_css', 20 );

/*
add_action( 'job_bm_action_single_job_main', 'job_bm_template_single_job_meta_after', 10 );
function job_bm_template_single_job_meta_after() {
	
	$job_bm_archive_page_id = get_option('job_bm_archive_page_id');
	$job_bm_archive_page_url = get_permalink($job_bm_archive_page_id);	

	echo '<a href="'.$job_bm_archive_page_url.'">Back to List</a>';
	}
*/



if ( ! function_exists( 'job_bm_template_single_job_view' ) ) {
	function job_bm_template_single_job_view() {
		include( job_bm_plugin_dir. 'templates/job-single/job-single-view.php');
	}
}

if ( ! function_exists( 'job_bm_template_single_job_title' ) ) {
	function job_bm_template_single_job_title() {
		include( job_bm_plugin_dir. 'templates/job-single/job-single-title.php');
	}
}

if ( ! function_exists( 'job_bm_template_single_job_description' ) ) {
	function job_bm_template_single_job_description() {
		include( job_bm_plugin_dir. 'templates/job-single/job-single-description.php');
	}
}

if ( ! function_exists( 'job_bm_template_single_job_meta' ) ) {
	function job_bm_template_single_job_meta() {
		include( job_bm_plugin_dir. 'templates/job-single/job-single-meta.php');
	}
}

if ( ! function_exists( 'job_bm_template_single_job_sidebar' ) ) {
	function job_bm_template_single_job_sidebar() {
		include( job_bm_plugin_dir. 'templates/job-single/job-single-sidebar.php');
	}
}

if ( ! function_exists( 'job_bm_template_single_job_css' ) ) {
	function job_bm_template_single_job_css() {
		include( job_bm_plugin_dir. 'templates/job-single/job-single-css.php');
	}
}