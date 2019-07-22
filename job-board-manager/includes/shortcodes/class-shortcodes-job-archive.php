<?php

/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

class class_job_bm_shortcodes_job_archive{
	
    public function __construct(){
		
		add_shortcode( 'job_list', array( $this, 'job_bm_job_archive_display' ) );

   		}

	public function job_bm_job_archive_display($atts, $content = null ) {


		$atts = shortcode_atts(
			array(
				
				'keywords' => '',										
				'location' => '',
				'job_status' => '',
				'job_type' => '',	
				'company_name' => '',
				'display_search' => 'no', // yes, no								
													
				), $atts);

		
		//$job_bm_themes = $atts['themes'];
		$keywords = $atts['keywords'];
		$location = $atts['location'];
		$job_status = $atts['job_status'];			
		$job_type = $atts['job_type'];	
		$company_name = $atts['company_name'];
		$display_search = $atts['display_search'];		


		ob_start();
		
		include( job_bm_plugin_dir . 'templates/job-archive/job-archive.php');

        wp_enqueue_style('job_bm_job_archive');
        wp_enqueue_style('font-awesome-5');

		return ob_get_clean();
		
		}
	
			
	}
	
new class_job_bm_shortcodes_job_archive();