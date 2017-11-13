<?php
/**
 * Setup Wizard Class
 *
 * Takes new users through some basic steps to setup their store.
 *
 * @author      WooThemes
 * @category    Admin
 * @package     WooCommerce/Admin
 * @version     2.6.0
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * qa_Admin_Setup_Wizard class.
 */
class job_bm_setup_wizard {


	public function __construct() {
		add_action( 'admin_notices', array( $this, 'qa_notice_setup_wizard') );
		add_action( 'admin_menu', array( $this, 'admin_menus' ) );
		add_action( 'admin_init', array( $this, 'setup_wizard' ) );
	}


	
	
	public function admin_menus() {
		add_dashboard_page( '', '', 'manage_options', 'job_bm_welcome', '' );
	}
	
	
	
	
	public function qa_notice_setup_wizard() {
		
		

		$notice_action = isset( $_GET['job_bm_welcome_hide'] ) ? $_GET['job_bm_welcome_hide'] : '';
		if( $notice_action == 'hide' ) {
			update_option('job_bm_welcome', 'skip' );
		}

		$job_bm_welcome = get_option( 'job_bm_welcome' );
		
		if(  empty($job_bm_welcome) ) {
			?>
			<div id="message" class="updated">
				<p><?php echo sprintf(__( '<strong>Welcome to %s</strong> &#8211; Please setup basic settings.', job_bm_textdomain ), job_bm_plugin_name); ?></p>
				<p class="submit">
					<a href="<?php echo esc_url( admin_url( 'admin.php?page=job_bm_welcome' ) ); ?>" class="button-primary"><?php _e( 'Run Wizard Setup', job_bm_textdomain ); ?></a> 
					<a class="button-secondary skip" href="<?php echo esc_url( wp_nonce_url( add_query_arg( 'job_bm_welcome_hide', 'hide' ), 'job_bm_welcome_nonce', '_job_bm_welcome_nonce' ) ); ?>"><?php _e( 'Skip Setup', job_bm_textdomain ); ?></a>
				</p>
			</div>
			<?php
		}
	}
	
	
	
	
	
	
	
	
	
	public function setup_options(){
		
		
		$options = array(
						
						'general'=> array(
							'title' => __('General', job_bm_textdomain),
							'options' => array(
											
								'job_bm_list_per_page' => array(
									
									'id'=>'job_bm_list_per_page',
									'css_class'=>'post_title',
									'required'=>'no', // (yes, no) is this field required.
									'placeholder'=>__('20',job_bm_textdomain),
									'title'=>__('Post per page ?', job_bm_textdomain),
									'option_details'=>__('Post per page on archive page', job_bm_textdomain),					
									'input_type'=>'text', // text, radio, checkbox, select,
									'input_values'=>'20', // could be array	
									),
										
										
								'job_bm_list_excerpt_word_count' => array(
									
									'id'=>'job_bm_list_excerpt_word_count',
									'css_class'=>'list_excerpt_word_count',
									'required'=>'no', // (yes, no) is this field required.
									'placeholder'=>__('30',job_bm_textdomain),
									'title'=>__('Excerpt word count ?', job_bm_textdomain),
									'option_details'=>__('Excerpt word count on archive page', job_bm_textdomain),					
									'input_type'=>'text', // text, radio, checkbox, select,
									'input_values'=>'30', // could be array	
									),										
										
										
								'job_bm_account_required_post_job' => array(
									
									'id'=>'job_bm_account_required_post_job',
									'css_class'=>'account_required_post_job',
									'required'=>'no', // (yes, no) is this field required.
									'placeholder'=>__('30',job_bm_textdomain),
									'title'=>__('Account required to post job ?', job_bm_textdomain),
									'option_details'=>__('Only logged-in user can post job', job_bm_textdomain),					
									'input_type'=>'select', // text, radio, checkbox, select,
									'input_values'=>array(''), // could be array
									'input_args'=>array('no'=>__('No', job_bm_textdomain), 'yes'=>__('Yes', job_bm_textdomain)  ), // could be array	
									),										
										
								'job_bm_submitted_job_status' => array(
									
									'id'=>'job_bm_submitted_job_status',
									'css_class'=>'job_bm_submitted_job_status',
									'required'=>'no', // (yes, no) is this field required.
									'placeholder'=>__('30',job_bm_textdomain),
									'title'=>__('New Submitted job status ?', job_bm_textdomain),
									'option_details'=>__('New submitted job status ?', job_bm_textdomain),					
									'input_type'=>'select', // text, radio, checkbox, select,
									'input_values'=>array(''), // could be array
									'input_args'=>array('pending'=>__('Pending', job_bm_textdomain), 'publish'=>__('Publish', job_bm_textdomain), 'private'=>__('Private', job_bm_textdomain), 'draft'=>__('Draft', job_bm_textdomain)  ), // could be array	
									),									
									
									
									
									
									
																
									
								),
														
								
							),
						
						'job_post'=> array(
							'title' => __('Job Post', job_bm_textdomain),
							'options' => array(
											
								'job_bm_salary_currency' => array(
									
									'id'=>'job_bm_salary_currency',
									'css_class'=>'job_bm_salary_currency',
									'required'=>'no', // (yes, no) is this field required.
									'placeholder'=>__('30',job_bm_textdomain),
									'title'=>__('Currency symbol ?', job_bm_textdomain),
									'option_details'=>__('Currency symbol ?', job_bm_textdomain),					
									'input_type'=>'text', // text, radio, checkbox, select,
									'input_values'=>'$', // could be array	
									),	
								)
							)	
						
						
						
						
						
						
						
						
						);
		
			return $options;
		}	
	
	
	
	public function setup_wizard() {
		if ( empty( $_GET['page'] ) || 'job_bm_welcome' !== $_GET['page'] ) return;
		
		wp_enqueue_style( 'job_bm_welcome', job_bm_plugin_url.'assets/admin/css/welcome.css' );
		wp_enqueue_script('job_bm_welcome', job_bm_plugin_url.'assets/admin/js/welcome.js', array('jquery') );
		wp_localize_script('job_bm_welcome', 'job_bm_ajax', array( 'job_bm_ajaxurl' => admin_url( 'admin-ajax.php')));
		//wp_enqueue_style( 'job_bm_welcome_2', job_bm_plugin_url.'assets/admin/css/welcome.css' );
		wp_enqueue_style('font-awesome.min', job_bm_plugin_url.'assets/global/css/font-awesome.min.css');
		ob_start();
		$this->setup_wizard_body();
		exit;
	}


	



	
	public function setup_wizard_body() {
		?>
		<!DOCTYPE html>
		<html <?php language_attributes(); ?>>
            <head>
                <meta name="viewport" content="width=device-width" />
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <title><?php _e( 'Job Board Manager &rsaquo; Setup Wizard', job_bm_textdomain ); ?></title>
                <?php 
				wp_print_scripts( 'job_bm_welcome' ); 
				do_action( 'admin_print_styles' );
				do_action( 'admin_head' );
				
				
				
				
		
				
				
				
				?>

               
                
                
            </head>
            <body class="job_bm_welcome wp-core-ui">
    
            	<div class="pp-admin welcome">  
    				<div class="header" style="background:rgba(0, 0, 0, 0) url(<?php echo job_bm_plugin_url.'assets/admin/images/banner-772x250.png'; ?>) no-repeat scroll 0 0 / 100% auto; ">
                    <span class="name">Job Board Manager Setup</span>
                    </div>
    
    				<?php 
					
					if(!empty($_GET['step'])){
						
						$step = sanitize_text_field($_GET['step']);
						
						$step_width = ($step*100)/4;
						
						
						}
					else{
						$step_width = 20;
						
						}
					
					
					?>
    
    
    				<div class="steps"><div style="width:<?php echo $step_width; ?>%" class="step "></div></div>
    
<?php

				
	if(!empty($_GET['step'])){
		
		$step = sanitize_text_field($_GET['step']);
		}
	else{
		
		$step = 0;
		
		}
		
		
	$class_job_bm_functions = new class_job_bm_functions();
	$create_pages = $class_job_bm_functions->create_pages();
		
		
		
		
		
		
	if(!empty($_POST['job_bm_hidden'])){

		if($step==1){
			
			update_option('job_bm_list_per_page', sanitize_text_field($_POST['job_bm_list_per_page']));
			update_option('job_bm_list_excerpt_word_count', sanitize_text_field($_POST['job_bm_list_excerpt_word_count']));			
			
			echo '<div class="updated"><p>'.__('Options saved', job_bm_textdomain ).'</p></div>';
			
			
			
			
			}
		elseif($step==2){
			
		foreach($create_pages as $pages){
			
				$userid = get_current_user_id();
				
				$page_title = sanitize_text_field($_POST[$pages['id']]['title']);
				$page_content = sanitize_text_field($_POST[$pages['id']]['shortcode']);			
				
				$page_args = array(
				  'post_title'    => $page_title,
				  'post_content'  => $page_content,
				  'post_status'   => 'publish',
				  'post_type'   => 'page',
				  'post_author'   => $userid,
				);

				$option = get_option($pages['id']);
				
				if(empty($option)){
					$page_id = wp_insert_post($page_args);
					update_option($pages['id'], $page_id);
					
					}
			}
			
			echo '<div class="updated"><p>'.__('Page created.', job_bm_textdomain ).'</p></div>';
			}
		
		elseif($step==3){
			
			update_option('job_bm_account_required_post_job', sanitize_text_field($_POST['job_bm_account_required_post_job']));
			update_option('job_bm_registration_enable', sanitize_text_field($_POST['job_bm_registration_enable']));
			update_option('job_bm_login_enable', sanitize_text_field($_POST['job_bm_login_enable']));
			
			//update_option('job_bm_welcome_done', true);			
			echo '<div class="updated"><p>'.__('Permissions saved.', job_bm_textdomain ).'</p></div>';
			}		

		elseif($step==4){
			
			update_option('job_bm_submitted_job_status', sanitize_text_field($_POST['job_bm_submitted_job_status']));
			update_option('job_bm_salary_currency', sanitize_text_field($_POST['job_bm_salary_currency']));
			
					
			echo '<div class="updated"><p>'.__('Job posting saved.', job_bm_textdomain ).'</p></div>';
			}		
		
		
		}	
		
		
		
		
		
		
	if($step==0){
		
		$url_parameter = '&step=1';
		$action_url = $_SERVER['REQUEST_URI'].'&step=1';
		$skip_button_url = $_SERVER['REQUEST_URI'].'&step=1';
		
		}
	elseif($step==1){
		
		$action_url = str_replace('step=1','step=2',$_SERVER['REQUEST_URI']);		
		$skip_button_url = str_replace('step=1','step=2',$_SERVER['REQUEST_URI']);
		
		}
	elseif($step==2){
		
		$action_url = str_replace('step=2','step=3',$_SERVER['REQUEST_URI']);		
		$skip_button_url = str_replace('step=2','step=3',$_SERVER['REQUEST_URI']);	
		
		}
	elseif($step==3){
		
		$action_url = str_replace('step=3','step=4',$_SERVER['REQUEST_URI']);		
		$skip_button_url = str_replace('step=3','step=4',$_SERVER['REQUEST_URI']);
		
		}	
	else{
		
		$action_url = $_SERVER['REQUEST_URI'].'';
		$skip_button_url = $_SERVER['REQUEST_URI'].'';
		
		}
		
	
		

?>
    
    
    
    
    
    
    
    
            
            <form  method="post" action="<?php echo str_replace( '%7E', '~', $action_url); ?>">
                <input type="hidden" name="job_bm_hidden" value="Y">
                <?php settings_fields( 'job_bm_plugin_options' );
                        do_settings_sections( 'job_bm_plugin_options' );
        
        

                

			
			if($step==0){
				
				$submit_button_text = __('Save options',job_bm_textdomain);
							
	
				echo '<h3 class="">'.__('General options', job_bm_textdomain).'</h3>';

				
				$job_bm_list_per_page = get_option('job_bm_list_per_page');
				if(empty($job_bm_list_per_page)){$job_bm_list_per_page = 25; }
				
				echo '<div class="option">';
				echo '<p class="title">Post per page ?</p>';				
				echo '<input type="text" name="job_bm_list_per_page" value="'.$job_bm_list_per_page.'" />';
				echo '</div>';				
				
				
				$job_bm_list_excerpt_word_count = get_option('job_bm_list_excerpt_word_count');
				if(empty($job_bm_list_excerpt_word_count)){$job_bm_list_excerpt_word_count = 25; }
				
				echo '<div class="option">';
				echo '<p class="title">Excerpt word count ?</p>';				
				echo '<input type="text" name="job_bm_list_excerpt_word_count" value="'.$job_bm_list_excerpt_word_count.'" />';
				echo '</div>';					
				
				}
			
			elseif($step==1){



				echo '<h3 class="">'.__('Create pages', job_bm_textdomain).'</h3>';



				$submit_button_text = __('Create pages',job_bm_textdomain);

				foreach($create_pages as $pages){
	
					echo '<div class="option">';
					echo '<p class="title">'.$pages['title'].'</p>';
					echo '<input type="text" name="'.$pages['id'].'[title]" value="'.$pages['title'].'" />';
					echo '<input type="hidden" name="'.$pages['id'].'[shortcode]" value="'.$pages['shortcode'].'" />';
					//echo '<input type="hidden" name="'.$pages['id']['title'].'" value="'.$pages['id'].'" />';								
					
					echo '</div>';
					
					
					
					
					}
				
				}
			
			
			
			elseif($step==2){



				echo '<h3 class="">'.__('Save permissions', job_bm_textdomain).'</h3>';







				$submit_button_text = __('Save permissions',job_bm_textdomain);
				
				echo '<div class="option">';
				echo '<p class="title">Account required to post job ?</p>';	
							
				
				$job_bm_account_required_post_job = get_option('job_bm_account_required_post_job');

							
				echo '<select name="job_bm_account_required_post_job">';
				
				if($job_bm_account_required_post_job=='yes'){
					echo '<option selected value="yes">Yes</option>';
					}
				else{
					echo '<option value="yes">Yes</option>';
					}
					
				if($job_bm_account_required_post_job=='no'){
					echo '<option selected value="no">No</option>';
					}
				else{
					echo '<option value="no">No</option>';
					}					

				echo '</select>';
								
				echo '</div>';	
				
				echo '<div class="option">';
				echo '<p class="title">Registration enable on my account page ?</p>';	
							
				echo '<select name="job_bm_registration_enable">';
				
				$job_bm_registration_enable = get_option('job_bm_registration_enable');
				
				
				if($job_bm_registration_enable=='yes'){
					echo '<option selected value="yes">Yes</option>';
					}
				else{
					echo '<option value="yes">Yes</option>';
					}
					
				if($job_bm_registration_enable=='no'){
					echo '<option selected value="no">No</option>';
					}
				else{
					echo '<option value="no">No</option>';
					}					

			
				echo '</select>';
								
				echo '</div>';					
				
				echo '<div class="option">';
				echo '<p class="title">Login enable on my account page ?</p>';	
							
				echo '<select name="job_bm_login_enable">';
				
				
				$job_bm_login_enable = get_option('job_bm_login_enable');
				
				
				if($job_bm_login_enable=='yes'){
					echo '<option selected value="yes">Yes</option>';
					}
				else{
					echo '<option value="yes">Yes</option>';
					}
					
				if($job_bm_login_enable=='no'){
					echo '<option selected value="no">No</option>';
					}
				else{
					echo '<option value="no">No</option>';
					}	
								
				echo '</select>';
								
				echo '</div>';					

				}			
			
			
			elseif($step==3){


				echo '<h3 class="">'.__('Job posting', job_bm_textdomain).'</h3>';





				$submit_button_text = __('Job posting',job_bm_textdomain);
				
				echo '<div class="option">';
				echo '<div class="title">New submitted job status ?</div>';	
							
				echo '<select name="job_bm_submitted_job_status">';
				echo '<option value="pending">Pending</option>';
				echo '<option value="publish">Publish</option>';
				echo '<option value="private">Private</option>';
				echo '<option value="draft">Draft</option>';												
				echo '</select>';
								
				echo '</div>';	
				
				echo '<div class="option">';
				echo '<div class="title">Currency symbol ?</div>';	
							
				$job_bm_salary_currency = get_option('job_bm_salary_currency');
				if(empty($job_bm_salary_currency)){$job_bm_salary_currency = '$';}
				
				echo '<input type="text" name="job_bm_salary_currency" value="'.$job_bm_salary_currency.'" />';
								
				echo '</div>';					

				}			
						
			
			
			else{
				$submit_button_text = __('Nothing to Save',job_bm_textdomain);
				
				echo '<div class="option">';
				echo '<div class="title">You are Awesome!</div>';	
				
				echo '<div class="subscribe"><i class="fa fa-wifi" aria-hidden="true"></i> Subscribe to us
				
				<span class="button job-bm-subscribe">Subscribe</span>
				
				<span class="message"></span>				
				<span class="note">We will collect following things: email, first name, last name.</span>
				</div>';
				
				
				
				
				echo '<a class="go-dashborad" href="'.admin_url().'">Go to Dashboard</a>';
								
				echo '</div>';	

				echo '<style type="text/css">';
				
				echo '.submit{display:none;}';
				echo '</style>';
				
				
				update_option('job_bm_welcome', 'yes');	
				}
			
				
				
				
                
                ?>


                
            <p class="submit">
                <input class="button button-primary" type="submit" name="Submit" value="<?php echo $submit_button_text; ?>" />
                <a  class="button button-primary"  href="<?php echo $skip_button_url; ?>">Skip</a>
            </p>
            </form>                  
                    
                    
				</div>
            </body>
		</html>
            
		<?php
	}



}

new job_bm_setup_wizard();
