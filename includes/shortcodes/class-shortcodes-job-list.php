<?php

/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

class class_job_bm_shortcodes_job_list{
	
    public function __construct(){
		
		//add_shortcode( 'job_list', array( $this, 'job_bm_job_list_display' ) );

   		}

	public function job_bm_job_list_display($atts, $content = null ) {


		$atts = shortcode_atts(
			array(
				//'themes' => 'flat',
				'meta_keys' => '',
				'keywords' => '',										
				'location' => '',
				'job_status' => '',
				'job_type' => '',
				'company_name' => '',
				
																		
				), $atts);

		
		//$job_bm_themes = $atts['themes'];
		$keywords = $atts['keywords'];
		$meta_keys = $atts['meta_keys'];
		$location = $atts['location'];
		$job_status = $atts['job_status'];
		$job_type = $atts['job_type'];
		$company_name = $atts['company_name'];


		ob_start();
		
		include( job_bm_plugin_dir . 'templates/job-list.php');

		return ob_get_clean();
		
		}
	
			
	}
	
new class_job_bm_shortcodes_job_list();