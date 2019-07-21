<?php

/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

class class_job_bm_shortcodes_edit_account{
	
    public function __construct(){
		
		add_shortcode( 'job_bm_edit_account', array( $this, 'edit_account_display' ) );

   		}

	public function edit_account_display($atts, $content = null ) {

		ob_start();
		
		include( job_bm_plugin_dir . 'templates/account/edit-account.php');

		return ob_get_clean();
		
		}
	
			
	}
	
new class_job_bm_shortcodes_edit_account();