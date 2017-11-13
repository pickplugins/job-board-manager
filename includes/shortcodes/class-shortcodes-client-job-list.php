<?php

/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

class class_job_bm_shortcodes_client_job_list{
	
    public function __construct(){
		
		add_shortcode( 'client_job_list', array( $this, 'client_job_list_display' ) );

   		}

	public function client_job_list_display($atts, $content = null ) {
		
		$atts = shortcode_atts(
			array(
				//'themes' => 'flat',
				'display_edit' => 'yes',
				'display_delete' => 'yes',										
				
				
																		
				), $atts);

		
		//$job_bm_themes = $atts['themes'];
		$display_edit = $atts['display_edit'];
		$display_delete = $atts['display_delete'];		
		

		ob_start();
		
		include( job_bm_plugin_dir . 'templates/client-job-list.php');

		return ob_get_clean();
		
		}
	
			
	}
	
new class_job_bm_shortcodes_client_job_list();