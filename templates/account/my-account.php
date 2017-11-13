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
	<div class="job-bm-my-account">
	<?php
	
	do_action('job_bm_action_before_account');
	
	
	if(is_user_logged_in()){

		
		global $current_user;
		
		echo '<div class="welcome">'.__('Welcome', job_bm_textdomain).' <b>'.$current_user->display_name.'</b>! <a href="'.wp_logout_url(get_permalink($job_bm_job_login_page_id)).'">'.__('Logout',job_bm_textdomain).'</a>';
		
		
		//echo do_shortcode('[client_job_list]');
		
		echo '</div>';	

		}
	else{
		
			
		if($job_bm_registration_enable=='yes'){
			
			echo '<div class="register">';
			echo '<h3>'.__('Register', job_bm_textdomain).'</h3>';	
			echo do_shortcode('[job_bm_registration_form]');
			echo '</div>';
			
			}

		if($job_bm_login_enable=='yes'){
			
			echo '<div class="login">';
			echo '<h3>'.__('Login', job_bm_textdomain).'</h3>';	
			
			
			$args = array(
				'echo'           => true,
				'remember'       => true,
				//'redirect'       => ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'],
				'form_id'        => 'loginform',
				'id_username'    => 'user_login',
				'id_password'    => 'user_pass',
				'id_remember'    => 'rememberme',
				'id_submit'      => 'wp-submit',
				'label_username' => __( 'Username or email address', job_bm_textdomain ),
				'label_password' => __( 'Password' , job_bm_textdomain),
				'label_remember' => __( 'Remember Me', job_bm_textdomain ),
				'label_log_in'   => __( 'Log In', job_bm_textdomain ),
				'value_username' => '',
				'value_remember' => false
			);

			wp_login_form($args);
			
			//echo ob_get_clean();
			echo '</div>';
			
			}

		}

		do_action('job_bm_action_after_account');		
	?>
	</div>	