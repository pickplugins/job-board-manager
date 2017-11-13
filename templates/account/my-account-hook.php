<?php
/*
* @Author 		PickPlugins
* Copyright: 	2016 PickPlugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

function job_bm_action_after_account_client_job_list(){
	
	if(is_user_logged_in()){
		
		echo do_shortcode('[client_job_list]');
		
		}
	
	}
	
add_action('job_bm_action_after_account','job_bm_action_after_account_client_job_list');