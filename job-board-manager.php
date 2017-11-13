<?php
/*
Plugin Name: Job Board Manager
Plugin URI: http://pickplugins.com
Description: Awesome Job Board Manager.
Version: 2.0.25
Author: pickplugins
Text Domain: job-board-manager
Author URI: http://pickplugins.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

class JobBoardManager{
	
	public function __construct(){
	
	define('job_bm_plugin_url', plugins_url('/', __FILE__)  );
	define('job_bm_plugin_dir', plugin_dir_path( __FILE__ ) );
	define('job_bm_wp_url', 'https://wordpress.org/plugins/job-board-manager/' );
	define('job_bm_wp_reviews', 'http://wordpress.org/support/view/plugin-reviews/job-board-manager' );
	define('job_bm_pro_url','http://www.pickplugins.com/item/job-board-manager-create-job-site-for-wordpress/' );
	define('job_bm_demo_url', 'www.pickplugins.com/demo/job-board-manager/' );
	define('job_bm_conatct_url', 'http://www.pickplugins.com/contact/' );
	define('job_bm_qa_url', 'http://www.pickplugins.com/questions/' );
	define('job_bm_plugin_name', 'Job Board Manager' );
	define('job_bm_plugin_version', '2.0.25' );
	define('job_bm_customer_type', 'free' );	 
	define('job_bm_share_url', 'https://wordpress.org/plugins/job-board-manager/' );
	//define('job_bm_tutorial_video_url', '//www.youtube.com/embed/Z-ZzJiyVNJ4?rel=0' );
	define('job_bm_textdomain', 'job-board-manager' );

	// Class
	require_once( plugin_dir_path( __FILE__ ) . 'includes/class-post-types.php');	
	require_once( plugin_dir_path( __FILE__ ) . 'includes/class-post-meta.php');	
	
	require_once( plugin_dir_path( __FILE__ ) . 'includes/class-functions.php');
	require_once( plugin_dir_path( __FILE__ ) . 'includes/class-roles.php');	
	require_once( plugin_dir_path( __FILE__ ) . 'includes/class-settings.php');
	require_once( plugin_dir_path( __FILE__ ) . 'includes/class-emails.php');
	require_once( plugin_dir_path( __FILE__ ) . 'includes/class-error-log.php');
	require_once( plugin_dir_path( __FILE__ ) . 'includes/class-import.php');

	// ShortCodes
	require_once( plugin_dir_path( __FILE__ ) . 'includes/shortcodes/class-shortcodes.php');	
	require_once( plugin_dir_path( __FILE__ ) . 'includes/shortcodes/class-shortcodes-job-submit.php');
	require_once( plugin_dir_path( __FILE__ ) . 'includes/shortcodes/class-shortcodes-job-edit.php');
	require_once( plugin_dir_path( __FILE__ ) . 'includes/shortcodes/class-shortcodes-account.php');
	require_once( plugin_dir_path( __FILE__ ) . 'includes/shortcodes/class-shortcodes-client-job-list.php');
	require_once( plugin_dir_path( __FILE__ ) . 'includes/shortcodes/class-shortcodes-job-list.php');
	require_once( plugin_dir_path( __FILE__ ) . 'includes/shortcodes/class-shortcodes-job-archive.php');
	require_once( plugin_dir_path( __FILE__ ) . 'includes/shortcodes/class-shortcodes-pending-publish.php');

	require_once( plugin_dir_path( __FILE__ ) . 'templates/account/my-account-hook.php');
	require_once( plugin_dir_path( __FILE__ ) . 'templates/job-submit-hook.php');
	require_once( plugin_dir_path( __FILE__ ) . 'templates/job-edit-hook.php');	
	require_once( plugin_dir_path( __FILE__ ) . 'templates/job-single-hook.php');

	require_once( plugin_dir_path( __FILE__ ) . 'includes/pickform/class-pickform.php');
	require_once( plugin_dir_path( __FILE__ ) . 'includes/pickform/class-pickform-creator.php');
	require_once( plugin_dir_path( __FILE__ ) . 'includes/pickform/class-pickformNew.php');	
	

	
	require_once( plugin_dir_path( __FILE__ ) . 'includes/functions/functions.php');
	require_once( plugin_dir_path( __FILE__ ) . 'includes/functions/functions-reports.php');
	
	require_once( plugin_dir_path( __FILE__ ) . 'includes/functions/account-registration.php');
	require_once( plugin_dir_path( __FILE__ ) . 'includes/functions/functions-emails.php');	
			
	require_once( job_bm_plugin_dir . 'includes/menu/welcome.php');
	
	// Function's
	//require_once( plugin_dir_path( __FILE__ ) . 'includes/functions/login-form.php');
	




	add_action( 'admin_enqueue_scripts', 'wp_enqueue_media' );
	add_action( 'wp_enqueue_scripts', array( $this, 'job_bm_front_scripts' ) );
	add_action( 'admin_enqueue_scripts', array( $this, 'job_bm_admin_scripts' ) );
	add_action( 'plugins_loaded', array( $this, 'job_bm_plugins_loaded_function' ));
	
	
	add_action( 'activated_plugin', array( $this, 'redirect_welcome' ));
	//add_action( 'activated_plugin', array( $this, 'redirect_welcome' ));	
	//add_action( 'admin_head', array( $this, 'remove_welcome_menu' ));	
	
	//session_start();
	register_activation_hook( __FILE__, array( $this, 'job_bm_activation' ) );
	add_filter('widget_text', 'do_shortcode');
	
	}
	
	public function job_bm_plugins_loaded_function() {
		
		load_plugin_textdomain( job_bm_textdomain , false, plugin_basename( dirname( __FILE__ ) ) . '/languages/' ); 
		
		// update_option( 'job_bm_check', "ddddddddddddd" );
	}
	
	

	
	public function redirect_welcome($plugin){

		$job_bm_welcome = get_option('job_bm_welcome');


		if( empty($job_bm_welcome) ) {
			if( $plugin == 'job-board-manager/job-board-manager.php' ) {
				wp_safe_redirect( admin_url( 'index.php?page=job_bm_welcome' ) );
				exit;
			}
		}
	}
	
	
	
	public function job_bm_activation() {


		$class_job_bm_post_types= new class_job_bm_post_types();
		$class_job_bm_post_types->job_bm_posttype_job();
		flush_rewrite_rules();
		
		// create demo job category
		$class_job_bm_post_types->job_bm_register_job_category();		
		
		$job_category_terms = get_terms( array(
			'taxonomy' => 'job_category',
			'hide_empty' => false,
		) );
		
		if(empty($job_category_terms)){
			
				wp_insert_term(
				  'General', // the term 
				  'job_category', // the taxonomy
				  array(
					'description'=> __('General jobs.', job_bm_textdomain),
					'slug' => 'general',
					//'parent'=> $parent_term_id
				  )
				);
		
			}



		
	}
	
	
	public function job_bm_install(){
		
		do_action( 'job_bm_action_install' );
		}		
		
	public function job_bm_uninstall(){
		
		do_action( 'job_bm_action_uninstall' );
		}		
		
	public function job_bm_deactivation(){
		
		do_action( 'job_bm_action_deactivation' );
		}
		
		
		
		
/*

	public function redirect_welcome($plugin){
		
		$job_bm_welcome_done = get_option('job_bm_welcome_done');
		
		if($job_bm_welcome_done != true){
			
				if($plugin=='job-board-manager/job-board-manager.php') {
					 wp_redirect(admin_url('index.php?page=job_bm_welcome'));
					 die();
				}
			
			}
		

		}
		
*/		
		
	public function remove_welcome_menu(){
		remove_submenu_page( 'edit.php?post_type=job', 'job_bm_welcome' );
	}
		
		
		

		
		
		
		
	public function job_bm_front_scripts(){
		
		wp_enqueue_script('jquery');
		
		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script('jquery-ui-accordion');
		wp_enqueue_script('jquery-ui-datepicker');
		
		wp_enqueue_script('job_bm_front_js', plugins_url( '/assets/front/js/scripts.js' , __FILE__ ) , array( 'jquery' ));
		wp_localize_script('job_bm_front_js', 'job_bm_ajax', array( 'job_bm_ajaxurl' => admin_url( 'admin-ajax.php')));
		
		wp_enqueue_script('job_bm_scripts-form', plugins_url( '/assets/front/js/scripts-form.js' , __FILE__ ) , array( 'jquery' ));	
			
		wp_enqueue_script('tooltipster.bundle.min', plugins_url( '/assets/front/js/tooltipster.bundle.min.js' , __FILE__ ) , array( 'jquery' ));
		wp_enqueue_style('tooltipster.bundle.min', job_bm_plugin_url.'assets/front/css/tooltipster.bundle.min.css');

		wp_enqueue_style('frontend-forms', job_bm_plugin_url.'assets/front/css/frontend-forms.css');

		wp_enqueue_style('job_bm_style', job_bm_plugin_url.'assets/front/css/style.css');
		wp_enqueue_style('job_bm_job_single', job_bm_plugin_url.'assets/front/css/job-single.css');		
		wp_enqueue_style('job_bm_account', job_bm_plugin_url.'assets/front/css/account.css');
		wp_enqueue_style('job_bm_job_list', job_bm_plugin_url.'assets/front/css/job-list.css');		
		
		
		wp_enqueue_style('font-awesome.min', job_bm_plugin_url.'assets/global/css/font-awesome.min.css');
		wp_enqueue_style('jquery-ui', job_bm_plugin_url.'assets/admin/css/jquery-ui.css');
		
		
		wp_enqueue_style('job-submit', job_bm_plugin_url.'assets/front/css/job-submit.css');
		wp_enqueue_style('pickform', job_bm_plugin_url.'assets/front/css/pickform.css');
				
		
		wp_enqueue_script('jquery.steps', plugins_url( 'assets/front/js/jquery.steps.js' , __FILE__ ) , array( 'jquery' ));	
					
		wp_enqueue_script('plupload-all');	
		}

	public function job_bm_admin_scripts(){
		
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-sortable');
		wp_enqueue_script('jquery-ui-datepicker');
		wp_enqueue_script('job_bm_admin_js', plugins_url( '/assets/admin/js/scripts.js' , __FILE__ ) , array( 'jquery' ));
		wp_localize_script('job_bm_admin_js', 'job_bm_ajax', array( 'job_bm_ajaxurl' => admin_url( 'admin-ajax.php')));
		
		wp_enqueue_script('jquery.steps', plugins_url( 'assets/front/js/jquery.steps.js' , __FILE__ ) , array( 'jquery' ));	
		
		wp_enqueue_style('job_bm_admin_style', job_bm_plugin_url.'assets/admin/css/style.css');
		wp_enqueue_style('jquery-ui', job_bm_plugin_url.'assets/admin/css/jquery-ui.css');

		wp_enqueue_style('font-awesome.min', job_bm_plugin_url.'assets/global/css/font-awesome.min.css');
		wp_enqueue_style('style-reports', job_bm_plugin_url.'assets/admin/css/style-reports.css');		
		
		//wp_enqueue_style('pp-admin-welcome', job_bm_plugin_url.'assets/admin/css/welcome.css');		
		
		//ParaAdmin
		wp_enqueue_style('ParaAdmin', job_bm_plugin_url.'assets/admin/ParaAdmin/css/ParaAdmin.css');		
		wp_enqueue_script('ParaAdmin', plugins_url( 'assets/admin/ParaAdmin/js/ParaAdmin.js' , __FILE__ ) , array( 'jquery' ));
		
		
		wp_enqueue_script('jquery.canvasjs.min', plugins_url( '/assets/global/js/jquery.canvasjs.min.js' , __FILE__ ) , array( 'jquery' ));		
		
		
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'job_bm_color_picker', plugins_url('/assets/admin/js/color-picker.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
		
		}
	
	
	
	
	}

new JobBoardManager();