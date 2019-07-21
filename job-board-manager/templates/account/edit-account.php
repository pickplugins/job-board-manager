<?php
/*
* @Author 		PickPlugins
* Copyright: 	2016 PickPlugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

	$class_job_bm_functions = new class_job_bm_functions();
	$account_tabs = $class_job_bm_functions->account_tabs();

	$job_bm_job_login_page_id = get_option('job_bm_job_login_page_id');
	$job_bm_login_enable = get_option('job_bm_login_enable');	
	$job_bm_registration_enable = get_option('job_bm_registration_enable');

	

	?>
	<div class="job-bm-edit-account">
	<?php
	

	
	
	if(is_user_logged_in()){

		
		global $current_user;
		
        ?>
        <div class="">Account edit</div>
        <?php


		}
	else{
		
			


		}


	?>
	</div>	