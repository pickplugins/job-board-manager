<?php

/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

class class_job_bm_shortcodes_applications{
	
    public function __construct(){
		
		add_shortcode( 'job_bm_applications', array( $this, 'job_bm_applications_display' ) );

   		}

	public function job_bm_applications_display($atts, $content = null ) {
		
		$atts = shortcode_atts(
			array(
				//'themes' => 'flat',
				'display_edit' => 'yes',
				'display_delete' => 'yes',
				), $atts);

		$display_edit = $atts['display_edit'];
		$display_delete = $atts['display_delete'];		
		

		ob_start();
		
		include( job_bm_plugin_dir . 'templates/applications/applications.php');

        wp_enqueue_script('job-bm-my-jobs');
        wp_enqueue_style('job-bm-applications');


        return ob_get_clean();
		
		}
	
			
	}
	
new class_job_bm_shortcodes_applications();