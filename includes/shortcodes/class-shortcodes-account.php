<?php

/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

class class_job_bm_shortcodes_job_account{
	
    public function __construct(){
		
		add_shortcode( 'job_bm_my_account', array( $this, 'job_bm_account_display' ) );

   		}

	public function job_bm_account_display($atts, $content = null ) {

		ob_start();
		
		include( job_bm_plugin_dir . 'templates/account/my-account.php');

		return ob_get_clean();
		
		}
	
			
	}
	
new class_job_bm_shortcodes_job_account();