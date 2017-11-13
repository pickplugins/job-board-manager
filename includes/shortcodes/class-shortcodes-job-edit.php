<?php

/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

class class_job_bm_shortcodes_job_edit{
	
    public function __construct(){
		
		add_shortcode( 'job_bm_job_edit', array( $this, 'job_bm_job_edit_display' ) );

   		}

	public function job_bm_job_edit_display($atts, $content = null ) {

		ob_start();
		include( job_bm_plugin_dir . 'templates/job-edit.php');

		return ob_get_clean();
		
		}
	
			
	}
	
new class_job_bm_shortcodes_job_edit();