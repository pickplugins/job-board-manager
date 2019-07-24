<?php

/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

class class_job_bm_shortcodes_dashboard{
	
    public function __construct(){
		
		add_shortcode( 'job_bm_dashboard', array( $this, 'job_bm_dashboard' ) );	

		add_filter('job_bm_dashboard_account', array( $this, 'my_account_html' ));
	    add_filter('job_bm_dashboard_account_edit', array( $this, 'edit_account_html' ));
		add_filter('job_bm_dashboard_my_jobs', array( $this, 'my_jobs_html' ));



   		}
		
		
		
	
	function my_account_html(){
		
		return do_shortcode('[job_bm_account]');
		
		}	

	function my_jobs_html(){
		
		return do_shortcode('[job_bm_my_jobs]');
		
		}		
		
	function dashboard_tabs(){
		
		$tabs['account'] =array(
            'title'=>__('Account', 'job-board-manager'),
            'html'=>apply_filters('job_bm_dashboard_account',''),

        );

								
		$tabs['my_jobs'] =array(
            'title'=>__('My Jobs', 'job-board-manager'),
            'html'=>apply_filters('job_bm_dashboard_my_jobs',''),

        );

		return apply_filters('job_bm_dashboard_tabs',$tabs);					

		
    }


	public function job_bm_dashboard($atts, $content = null ) {
			$atts = shortcode_atts(
				array(
		
					'id' => 'flat',
					), $atts);
		
		ob_start();

		$job_bm_login_enable = get_option('job_bm_login_enable');
		$job_bm_registration_enable = get_option('job_bm_registration_enable');
		$job_bm_account_page_id = get_option('job_bm_account_page_id');
		$job_bm_account_page_url = get_permalink($job_bm_account_page_id);		
		
		
        ?>
        <div class="job-bm-dashboard">
        <?php
		
		
		if (is_user_logged_in() ):
		
		$dashboard_tabs = $this->dashboard_tabs();
		

        ?>
        <ul class="navs">
        <?php

		foreach($dashboard_tabs as $tabs_key=>$tabs){
			
			$title = $tabs['title'];
			$html = $tabs['html'];			
			
			
			?>
            <li>
                <a href="<?php echo $job_bm_account_page_url; ?>?tabs=<?php echo $tabs_key; ?>">
                <?php echo $title; ?>
                </a>
            
            </li>
            <?php
			
			
			
			}
		?>
        </ul>
        <?php
		
		
		
		
		
        ?>
        <div class="navs-content">
        <?php
     
	 	if(!empty($_GET['tabs'])){
			$current_tabs = sanitize_text_field($_GET['tabs']);
			
			//echo '<pre>'.var_export($current_tabs, true).'</pre>';
			
			}
		else{
			$current_tabs = 'account';
			
			}
	 	
		
		foreach($dashboard_tabs as $tabs_key=>$tabs){
			
			$title = $tabs['title'];
			$html = $tabs['html'];			
			
			if($current_tabs==$tabs_key):
			
			?>
            <div class="<?php echo $tabs_key; ?>">
            <?php echo $html; ?>
            </div>
            <?php
			
			endif;
			
			
			}
		?>
        </div>
        <?php		
		
		
		
		
		
		
		
		
		
		
		
		
		else:

            ?>
            <div class="job-bm-my-account">
            <?php

			if($job_bm_registration_enable=='yes'){

				echo '<div class="register">';
				echo '<h3>'.__('Register', 'job-board-manager').'</h3>';
				echo do_shortcode('[job_bm_registration_form]');
				echo '</div>';

			}
			if($job_bm_login_enable=='yes'){

				echo '<div class="login">';
				echo '<h3>'.__('Login', 'job-board-manager').'</h3>';


				$args = array(
					'echo'           => true,
					'remember'       => true,
					//'redirect'       => ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'],
					'form_id'        => 'loginform',
					'id_username'    => 'user_login',
					'id_password'    => 'user_pass',
					'id_remember'    => 'rememberme',
					'id_submit'      => 'wp-submit',
					'label_username' => __( 'Username or email address', 'job-board-manager' ),
					'label_password' => __( 'Password' , 'job-board-manager'),
					'label_remember' => __( 'Remember Me', 'job-board-manager' ),
					'label_log_in'   => __( 'Log In', 'job-board-manager' ),
					'value_username' => '',
					'value_remember' => false
				);

				wp_login_form($args);

				//echo ob_get_clean();
				echo '</div>';

			}

			?>
            </div>
			<?php
		endif;	
		
		?>
        </div>
        <?php
        wp_enqueue_style( 'font-awesome-5' );
        wp_enqueue_style( 'job-bm-dashboard' );


		return ob_get_clean();			
	}




		


		
			
			
			
			
			
	}
	
	new class_job_bm_shortcodes_dashboard();