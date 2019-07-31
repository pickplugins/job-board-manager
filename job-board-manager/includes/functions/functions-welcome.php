<?php
/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 
	

add_action('job_bm_welcome_tabs_content_start', 'job_bm_welcome_tabs_content_start');

if(!function_exists('job_bm_welcome_tabs_content_start')) {
    function job_bm_welcome_tabs_content_start($tab){

        $settings_tabs_field = new settings_tabs_field();

        $job_bm_list_per_page = get_option('job_bm_list_per_page');
        $job_bm_pagination_bg_color = get_option('job_bm_pagination_bg_color');
        $job_bm_pagination_active_bg_color = get_option('job_bm_pagination_active_bg_color');
        $job_bm_pagination_text_color = get_option('job_bm_pagination_text_color');



        ?>

        <h2>Welcome to Job Board Manager Setup</h2>
        <p>Thanks for choosing Job Board Manager for your job site, Please go step by step and choose some options to get started.</p>
        <p>If you have any issue during setup please contact us for help and you can post on our forum by creating support tickets.</p>
        <p><a class="button" href="#">Create Ticket</a></p>

        <p>We spend thousand hours to build this plugin for you, continuously updating, fixing bugs, add new features, creating add-ons, solving user issues and many more. we do live by creating plugin like Job Board Manager, we hope your wise feedback and reviews on plugin page. </p>
        <p>  <a class="button" href="#">Write a reviews</a></p>
    <?php


    }
}



add_action('job_bm_welcome_tabs_content_general', 'job_bm_welcome_tabs_content_general');

if(!function_exists('job_bm_welcome_tabs_content_general')) {
    function job_bm_welcome_tabs_content_general($tab){

        $settings_tabs_field = new settings_tabs_field();
        $class_job_bm_functions = new class_job_bm_functions();
        $apply_method_list = $class_job_bm_functions->apply_method_list();

        $job_bm_list_per_page = get_option('job_bm_list_per_page');
        $job_bm_account_required_post_job = get_option('job_bm_account_required_post_job');
        $job_bm_submitted_job_status = get_option('job_bm_submitted_job_status');
        $job_bm_can_user_edit_published_jobs = get_option('job_bm_can_user_edit_published_jobs');
        $job_bm_can_user_delete_jobs = get_option('job_bm_can_user_delete_jobs');
        $job_bm_can_user_delete_application = get_option('job_bm_can_user_delete_application');
        $job_bm_application_methods = get_option('job_bm_application_methods');
        $job_bm_salary_currency = get_option('job_bm_salary_currency');



        ?>
        <div class="section">
            <div class="section-title"><?php echo __('General settings', 'job-board-manager'); ?></div>
            <p class="description section-description"><?php echo __('Choose some general option.', 'job-board-manager'); ?></p>

            <?php

            $args = array(
                'id'		=> 'job_bm_list_per_page',
                //'parent'		=> '',
                'title'		=> __('Job per page','job-board-manager'),
                'details'	=> __('Set custom number of job per page on job archive','job-board-manager'),
                'type'		=> 'text',
                'value'		=> $job_bm_list_per_page,
                'default'		=> '',
                'placeholder'		=> '',
            );

            $settings_tabs_field->generate_field($args);


            $args = array(
                'id'		=> 'job_bm_account_required_post_job',
                //'parent'		=> '',
                'title'		=> __('Account required','job-board-manager'),
                'details'	=> __('Account required to post job.','job-board-manager'),
                'type'		=> 'select',
                //'multiple'		=> true,
                'value'		=> $job_bm_account_required_post_job,
                'default'		=> '',
                'args'		=> array( 'yes'=>__('Yes','job-board-manager'), 'no'=>__('No','job-board-manager'),),
            );

            $settings_tabs_field->generate_field($args);


            $args = array(
                'id'		=> 'job_bm_submitted_job_status',
                //'parent'		=> '',
                'title'		=> __('Submitted job status','job-board-manager'),
                'details'	=> __('Choose job status for newly submitted jobs.','job-board-manager'),
                'type'		=> 'select',
                //'multiple'		=> true,
                'value'		=> $job_bm_submitted_job_status,
                'default'		=> '',
                'args'		=> array( 'draft'=>__('Draft','job-board-manager'), 'pending'=>__('Pending','job-board-manager'), 'publish'=>__('Published','job-board-manager'), 'private'=>__('Private','job-board-manager'), 'trash'=>__('Trash','job-board-manager')),
            );

            $settings_tabs_field->generate_field($args);

            $args = array(
                'id'		=> 'job_bm_can_user_edit_published_jobs',
                //'parent'		=> '',
                'title'		=> __('Allow edit jobs','job-board-manager'),
                'details'	=> __('Allow user edit their own jobs','job-board-manager'),
                'type'		=> 'select',
                //'multiple'		=> true,
                'value'		=> $job_bm_can_user_edit_published_jobs,
                'default'		=> 'no',
                'args'		=> array( 'no'=>__('No','job-board-manager'), 'yes'=>__('Yes','job-board-manager'), ),
            );

            $settings_tabs_field->generate_field($args);


            $args = array(
                'id'		=> 'job_bm_can_user_delete_jobs',
                //'parent'		=> '',
                'title'		=> __('Allow delete jobs','job-board-manager'),
                'details'	=> __('Allow user delete their own jobs','job-board-manager'),
                'type'		=> 'select',
                //'multiple'		=> true,
                'value'		=> $job_bm_can_user_delete_jobs,
                'default'		=> '',
                'args'		=> array( 'yes'=>__('Yes','job-board-manager'), 'no'=>__('No','job-board-manager'),),
            );

            $settings_tabs_field->generate_field($args);


            $args = array(
                'id'		=> 'job_bm_can_user_delete_application',
                //'parent'		=> '',
                'title'		=> __('Allow delete application','job-board-manager'),
                'details'	=> __('Allow user delete their own application','job-board-manager'),
                'type'		=> 'select',
                //'multiple'		=> true,
                'value'		=> $job_bm_can_user_delete_application,
                'default'		=> '',
                'args'		=> array( 'yes'=>__('Yes','job-board-manager'), 'no'=>__('No','job-board-manager'),),
            );

            $settings_tabs_field->generate_field($args);


            $args = array(
                'id'		=> 'job_bm_application_methods',
                //'parent'		=> '',
                'title'		=> __('Application methods','job-board-manager'),
                'details'	=> __('Choose application method on job post.','job-board-manager'),
                'type'		=> 'select',
                'multiple'		=> true,
                'value'		=> $job_bm_application_methods,
                'default'		=> array('none'),
                'args'		=> $apply_method_list,
            );

            $settings_tabs_field->generate_field($args);

            $args = array(
                'id'		=> 'job_bm_salary_currency',
                //'parent'		=> '',
                'title'		=> __('Salary currency','job-board-manager'),
                'details'	=> __('Salary currency display on job page.','job-board-manager'),
                'type'		=> 'text',
                //'multiple'		=> true,
                'value'		=> $job_bm_salary_currency,
                'default'		=> '',
            );

            $settings_tabs_field->generate_field($args);

            ?>


        </div>
        <?php


    }
}




add_action('job_bm_welcome_tabs_content_create_pages', 'job_bm_welcome_tabs_content_create_pages');

if(!function_exists('job_bm_welcome_tabs_content_create_pages')) {
    function job_bm_welcome_tabs_content_create_pages($tab){

        $settings_tabs_field = new settings_tabs_field();

        $job_bm_archive_page_id = get_option('job_bm_archive_page_id');
        $job_bm_job_submit_page_id = get_option('job_bm_job_submit_page_id');
        $job_bm_job_edit_page_id = get_option('job_bm_job_edit_page_id');
        $job_bm_job_login_page_id = get_option('job_bm_job_login_page_id');


        $page_list = job_bm_page_list_id();

        $page_list = array_merge($page_list, array('create_new'=> '-- Create new page --'))


        ?>
        <div class="section">
            <div class="section-title"><?php echo __('Create pages', 'job-board-manager'); ?></div>
            <p class="description section-description"><?php echo __('You can create some basic pages or choose from existing. please choose <b>-- Create new page --</b> to create.', 'job-board-manager'); ?></p>

            <?php


            $args = array(
                'id'		=> 'job_bm_job_login_page_id',
                //'parent'		=> '',
                'title'		=> __('Dashboard page','job-board-manager'),
                'details'	=> __('Choose the page for dashboard page, where the shortcode <code>[job_bm_dashboard]</code> used.','job-board-manager'),
                'type'		=> 'select',
                //'multiple'		=> true,
                'value'		=> $job_bm_job_login_page_id,
                'default'		=> '',
                'args'		=> $page_list,
            );

            $settings_tabs_field->generate_field($args);


            $args = array(
                'id'		=> 'job_bm_archive_page_id',
                //'parent'		=> '',
                'title'		=> __('Job archive page','job-board-manager'),
                'details'	=> __('Choose the page for job archive page, where the shortcode <code>[job_bm_archive]</code> used.','job-board-manager'),
                'type'		=> 'select',
                //'multiple'		=> true,
                'value'		=> $job_bm_archive_page_id,
                'default'		=> '',
                'args'		=> $page_list,
            );

            $settings_tabs_field->generate_field($args);

            $args = array(
                'id'		=> 'job_bm_job_submit_page_id',
                //'parent'		=> '',
                'title'		=> __('Job submission page','job-board-manager'),
                'details'	=> __('Choose the page for job submission page, where the shortcode <code>[job_submit_form]</code> used.','job-board-manager'),
                'type'		=> 'select',
                //'multiple'		=> true,
                'value'		=> $job_bm_job_submit_page_id,
                'default'		=> '',
                'args'		=> $page_list,
            );

            $settings_tabs_field->generate_field($args);


            $args = array(
                'id'		=> 'job_bm_job_edit_page_id',
                //'parent'		=> '',
                'title'		=> __('Job edit page','job-board-manager'),
                'details'	=> __('Choose the page for job edit page, where the shortcode <code>[job_bm_job_edit]</code> used.','job-board-manager'),
                'type'		=> 'select',
                //'multiple'		=> true,
                'value'		=> $job_bm_job_edit_page_id,
                'default'		=> '',
                'args'		=> $page_list,
            );

            $settings_tabs_field->generate_field($args);






            ?>


        </div>
        <?php


    }
}






add_action('job_bm_welcome_tabs_content_done', 'job_bm_welcome_tabs_content_done');

if(!function_exists('job_bm_welcome_tabs_content_done')) {
    function job_bm_welcome_tabs_content_done($tab){

        $settings_tabs_field = new settings_tabs_field();




        $page_list = job_bm_page_list_id();

        $page_list = array_merge($page_list, array('create_new'=> '-- Create new page --'))


        ?>
        <div class="section">

            <h3 style="text-align: center" class="">Click to save settings.</h3>
            <p style="text-align: center">You can review settings by clicking next and previous button</p>
            <div class="submit-wrap">
                <?php wp_nonce_field( 'job_bm_nonce' ); ?>
                <input class="button" type="submit" name="Submit" value="<?php _e('Save Settings','job-board-manager' ); ?>" />
            </div>


        </div>
        <?php


    }
}

