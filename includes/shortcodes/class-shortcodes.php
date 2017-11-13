<?php

/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

class class_job_bm_shortcodes{
	
    public function __construct(){
		
		//add_shortcode( 'job_list', array( $this, 'job_bm_job_list_display' ) );
			

   		}
		
		

	public function job_bm_job_list_display($atts, $content = null ) {
			$atts = shortcode_atts(
				array(
					'themes' => 'flat',
					'meta_keys' => '',
					'keywords' => '',										
					'location' => '',
					'job_status' => '',
					'job_type' => '',	
					'company_name' => '',					
					
																			
					), $atts);
	
			$html = '';
			$job_bm_themes = $atts['themes'];
			$keywords = $atts['keywords'];			
			$meta_keys = $atts['meta_keys'];			
			$location = $atts['location'];			
			$job_status = $atts['job_status'];			
			$job_type = $atts['job_type'];	
			$company_name = $atts['company_name'];			
			
						
			//$job_bm_themes = get_post_meta( $post_id, 'job_bm_themes', true );
			//$job_bm_license_key = get_option('job_bm_license_key');
			
/*
			if(empty($job_bm_license_key))
				{
					return '<b>"'.job_bm_plugin_name.'" Error:</b> Please activate your license.';
				}

*/
			
			$class_job_bm_functions = new class_job_bm_functions();
			$job_bm_joblist_themes_dir = $class_job_bm_functions->job_bm_joblist_themes_dir();
			$job_bm_joblist_themes_url = $class_job_bm_functions->job_bm_joblist_themes_url();

			
			
			echo '<link  type="text/css" media="all" rel="stylesheet"  href="'.$job_bm_joblist_themes_url[$job_bm_themes].'/style.css" >';				

			include $job_bm_joblist_themes_dir[$job_bm_themes].'/index.php';				

			return $html;
	
	
		}
		

		
			
			
			
			
	}
	
	new class_job_bm_shortcodes();