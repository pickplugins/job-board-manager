<?php

/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

class class_job_bm_shortcodes_job_submit{
	
    public function __construct(){
		
		add_shortcode( 'job_submit_form', array( $this, 'job_bm_post_job_display' ) );

   		}

	public function job_bm_post_job_display($atts, $content = null ) {

		ob_start();
		include( job_bm_plugin_dir . 'templates/job-submit.php');

		return ob_get_clean();
		
		}
	
			
	}
	
new class_job_bm_shortcodes_job_submit();