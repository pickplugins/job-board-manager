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

        include( job_bm_plugin_dir . 'templates/job-submit/job-submit-hook.php');

		ob_start();
		//include( job_bm_plugin_dir . 'templates/job-submit.php');
        include( job_bm_plugin_dir . 'templates/job-submit/job-submit.php');

        wp_enqueue_style('job-bm-job-submit');
        //wp_enqueue_script('plupload-all');
        wp_enqueue_script('job-bm-job-submit');
        wp_enqueue_media();
       // wp_enqueue_style('media');
       // wp_enqueue_style('media-upload');
        //wp_enqueue_script('media-upload');



		return ob_get_clean();
		
		}
	
			
	}
	
new class_job_bm_shortcodes_job_submit();