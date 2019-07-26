<?php
if ( ! defined('ABSPATH')) exit;  // if direct access

class class_job_bm_post_meta{
	
	public function __construct(){

		//meta box action for "job"
		add_action('add_meta_boxes', array($this, 'job_bm_meta_box'));
		add_action('save_post', array($this, 'meta_boxes_job_save'));



		}

	

	
	
	
	public function job_bm_meta_box($post_type){

            add_meta_box('metabox-job-data',__('Job data', 'job-board-manager'), array($this, 'meta_box_job_data'), 'job', 'normal', 'high');
            add_meta_box('metabox-admin-action',__('Admin action', 'job-board-manager'), array($this, 'meta_box_job_admin_action'), 'job', 'side', 'high');

		}






	public function meta_box_job_data($post) {
 
        // Add an nonce field so we can check for it later.
        wp_nonce_field('job_nonce_check', 'job_nonce_check_value');
 
        // Use get_post_meta to retrieve an existing value from the database.
       // $job_bm_data = get_post_meta($post -> ID, 'job_bm_data', true);
		//$class_job_bm_functions = new class_job_bm_functions();
		//$job_meta_options = $class_job_bm_functions->job_meta_options();
		
		//$job_bm_field_editor = get_option( 'job_bm_field_editor' );
		
		$class_job_bm_functions = new class_job_bm_functions();

        $settings_tabs_field = new settings_tabs_field();


        $job_bm_total_vacancies = get_post_meta($post->ID, 'job_bm_total_vacancies', true);

        do_action('job_bm_metabox_job_data', $post);


   		}


	public function meta_box_job_admin_action($post) {

		// Add an nonce field so we can check for it later.
		wp_nonce_field('job_nonce_check', 'job_nonce_check_value');

		// Use get_post_meta to retrieve an existing value from the database.
		// $job_bm_data = get_post_meta($post -> ID, 'job_bm_data', true);

		$html_box = '';
		$class_job_bm_functions = new class_job_bm_functions();



        ?>

        <?php







	}

	public function meta_boxes_job_save($post_id){

        /*
         * We need to verify this came from the our screen and with
         * proper authorization,
         * because save_post can be triggered at other times.
         */

        // Check if our nonce is set.
        if (!isset($_POST['job_nonce_check_value']))
            return $post_id;

        $nonce = $_POST['job_nonce_check_value'];

        // Verify that the nonce is valid.
        if (!wp_verify_nonce($nonce, 'job_nonce_check'))
            return $post_id;

        // If this is an autosave, our form has not been submitted,
        //     so we don't want to do anything.
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            return $post_id;

        // Check the user's permissions.
        if ('page' == $_POST['post_type']) {

            if (!current_user_can('edit_page', $post_id))
                return $post_id;

        } else {

            if (!current_user_can('edit_post', $post_id))
                return $post_id;
        }

        /* OK, its safe for us to save the data now. */

        // Sanitize the user input.
        //$job_bm_data = stripslashes_deep($_POST['job_bm_data']);


        // Update the meta field.
        //update_post_meta($post_id, 'job_bm_data', $job_bm_data);
        //$class_job_bm_functions = new class_job_bm_functions();
        //$job_meta_options = $class_job_bm_functions->job_meta_options();


        //$job_bm_field_editor = get_option( 'job_bm_field_editor' );

        $class_job_bm_functions = new class_job_bm_functions();










			
					
		}
	
	}


new class_job_bm_post_meta();