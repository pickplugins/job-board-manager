<?php
/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 
	

add_action('job_bm_settings_tabs_content_archive', 'job_bm_settings_tabs_content_archive');

if(!function_exists('job_bm_settings_tabs_content_archive')) {
    function job_bm_settings_tabs_content_archive($tab){

        $settings_tabs_field = new settings_tabs_field();

        $job_bm_list_per_page = get_option('job_bm_list_per_page');
        $job_bm_pagination_bg_color = get_option('job_bm_pagination_bg_color');
        $job_bm_pagination_active_bg_color = get_option('job_bm_pagination_active_bg_color');
        $job_bm_pagination_text_color = get_option('job_bm_pagination_text_color');



        ?>
        <div class="section">
            <div class="section-title"><?php echo __('Archive settings', 'job-board-manager'); ?></div>
            <p class="description section-description"><?php echo __('Choose option for archive.', 'job-board-manager'); ?></p>

            <?php

            $args = array(
                'id'		=> 'job_bm_list_per_page',
                //'parent'		=> 'post_grid_meta_options',
                'title'		=> __('Job per page','job-board-manager'),
                'details'	=> __('Set custom number of job per page on job archive','job-board-manager'),
                'type'		=> 'text',
                'value'		=> $job_bm_list_per_page,
                'default'		=> '',
                'placeholder'		=> '',
            );

            $settings_tabs_field->generate_field($args);


            $args = array(
                'id'		=> 'job_bm_pagination_bg_color',
                //'parent'		=> 'post_grid_meta_options',
                'title'		=> __('Pagination background color','job-board-manager'),
                'details'	=> __('Choose pagination custom background color.','job-board-manager'),
                'type'		=> 'colorpicker',
                'value'		=> $job_bm_pagination_bg_color,
                'default'		=> '#656565',
                'placeholder'		=> '',
            );

            $settings_tabs_field->generate_field($args);

            $args = array(
                'id'		=> 'job_bm_pagination_active_bg_color',
                //'parent'		=> 'post_grid_meta_options',
                'title'		=> __('Pagination active background color','job-board-manager'),
                'details'	=> __('Choose pagination active custom background color.','job-board-manager'),
                'type'		=> 'colorpicker',
                'value'		=> $job_bm_pagination_active_bg_color,
                'default'		=> '#949494',
                'placeholder'		=> '',
            );

            $settings_tabs_field->generate_field($args);


            $args = array(
                'id'		=> 'job_bm_pagination_text_color',
                //'parent'		=> 'post_grid_meta_options',
                'title'		=> __('Pagination text color','job-board-manager'),
                'details'	=> __('Choose pagination custom text color.','job-board-manager'),
                'type'		=> 'colorpicker',
                'value'		=> $job_bm_pagination_text_color,
                'default'		=> '#ffffff',
                'placeholder'		=> '',
            );

            $settings_tabs_field->generate_field($args);








            ?>


        </div>
    <?php


    }
}






add_action('job_bm_settings_tabs_content_pages', 'job_bm_settings_tabs_content_pages');

if(!function_exists('job_bm_settings_tabs_content_pages')) {
    function job_bm_settings_tabs_content_pages($tab){

        $settings_tabs_field = new settings_tabs_field();


        $job_bm_archive_page_id = get_option('job_bm_archive_page_id');
        $job_bm_job_submit_page_id = get_option('job_bm_job_submit_page_id');
        $job_bm_job_edit_page_id = get_option('job_bm_job_edit_page_id');
        $job_bm_job_login_page_id = get_option('job_bm_job_login_page_id');
        $job_bm_salary_currency = get_option('job_bm_salary_currency');




        ?>
        <div class="section">
            <div class="section-title"><?php echo __('Pages settings', 'job-board-manager'); ?></div>
            <p class="description section-description"><?php echo __('Choose option for pages.', 'job-board-manager'); ?></p>

            <?php

            $args = array(
                'id'		=> 'job_bm_job_login_page_id',
                //'parent'		=> 'post_grid_meta_options',
                'title'		=> __('Dashboard page','job-board-manager'),
                'details'	=> __('Choose the page for dashboard page, where the shortcode <code>[job_bm_dashboard]</code> used.','job-board-manager'),
                'type'		=> 'select',
                //'multiple'		=> true,
                'value'		=> $job_bm_job_login_page_id,
                'default'		=> '',
                'args'		=> job_bm_page_list_id(),
            );

            $settings_tabs_field->generate_field($args);


            $args = array(
                'id'		=> 'job_bm_archive_page_id',
                //'parent'		=> 'post_grid_meta_options',
                'title'		=> __('Job archive page','job-board-manager'),
                'details'	=> __('Choose the page for job archive page, where the shortcode <code>[job_list]</code> used.','job-board-manager'),
                'type'		=> 'select',
                //'multiple'		=> true,
                'value'		=> $job_bm_archive_page_id,
                'default'		=> '',
                'args'		=> job_bm_page_list_id(),
            );

            $settings_tabs_field->generate_field($args);

            $args = array(
                'id'		=> 'job_bm_job_submit_page_id',
                //'parent'		=> 'post_grid_meta_options',
                'title'		=> __('Job submission page','job-board-manager'),
                'details'	=> __('Choose the page for job submission page, where the shortcode <code>[job_submit_form]</code> used.','job-board-manager'),
                'type'		=> 'select',
                //'multiple'		=> true,
                'value'		=> $job_bm_job_submit_page_id,
                'default'		=> '',
                'args'		=> job_bm_page_list_id(),
            );

            $settings_tabs_field->generate_field($args);


            $args = array(
                'id'		=> 'job_bm_job_edit_page_id',
                //'parent'		=> 'post_grid_meta_options',
                'title'		=> __('Job edit page','job-board-manager'),
                'details'	=> __('Choose the page for job edit page, where the shortcode <code>[job_bm_job_edit]</code> used.','job-board-manager'),
                'type'		=> 'select',
                //'multiple'		=> true,
                'value'		=> $job_bm_job_edit_page_id,
                'default'		=> '',
                'args'		=> job_bm_page_list_id(),
            );

            $settings_tabs_field->generate_field($args);


            $args = array(
                'id'		=> 'job_bm_salary_currency',
                //'parent'		=> 'post_grid_meta_options',
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




add_action('job_bm_settings_tabs_content_job_submit', 'job_bm_settings_tabs_content_job_submit');

if(!function_exists('job_bm_settings_tabs_content_job_submit')) {
    function job_bm_settings_tabs_content_job_submit($tab){

        $settings_tabs_field = new settings_tabs_field();





        $job_bm_account_required_post_job = get_option('job_bm_account_required_post_job');
        $job_bm_reCAPTCHA_enable = get_option('job_bm_reCAPTCHA_enable');
        $job_bm_reCAPTCHA_site_key = get_option('job_bm_reCAPTCHA_site_key');
        $job_bm_reCAPTCHA_secret_key = get_option('job_bm_reCAPTCHA_secret_key');
        $job_bm_submitted_job_status = get_option('job_bm_submitted_job_status');
        $job_bm_redirect_preview_link = get_option('job_bm_redirect_preview_link');
        $job_bm_notify_email_job_submit = get_option('job_bm_notify_email_job_submit');
        $job_bm_notify_email_job_publish = get_option('job_bm_notify_email_job_publish');




        ?>
        <div class="section">
            <div class="section-title"><?php echo __('Job posting settings', 'job-board-manager'); ?></div>
            <p class="description section-description"><?php echo __('Choose option for posting.', 'job-board-manager'); ?></p>

            <?php

            $args = array(
                'id'		=> 'job_bm_account_required_post_job',
                //'parent'		=> 'post_grid_meta_options',
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
                'id'		=> 'job_bm_reCAPTCHA_enable',
                //'parent'		=> 'post_grid_meta_options',
                'title'		=> __('reCAPTCHA enable','job-board-manager'),
                'details'	=> __('Enable reCAPTCHA to protect spam.','job-board-manager'),
                'type'		=> 'select',
                //'multiple'		=> true,
                'value'		=> $job_bm_reCAPTCHA_enable,
                'default'		=> '',
                'args'		=> array( 'yes'=>__('Yes','job-board-manager'), 'no'=>__('No','job-board-manager'),),
            );

            $settings_tabs_field->generate_field($args);



            $args = array(
                'id'		=> 'job_bm_reCAPTCHA_site_key',
                //'parent'		=> 'post_grid_meta_options',
                'title'		=> __('reCAPTCHA site key','job-board-manager'),
                'details'	=> __('reCAPTCHA site key, please go <a href="https://www.google.com/recaptcha">google.com/reCAPTCHA</a> and register your site to get site key.','job-board-manager'),
                'type'		=> 'text',
                //'multiple'		=> true,
                'value'		=> $job_bm_reCAPTCHA_site_key,
                'default'		=> '',
            );

            $settings_tabs_field->generate_field($args);


            $args = array(
                'id'		=> 'job_bm_reCAPTCHA_secret_key',
                //'parent'		=> 'post_grid_meta_options',
                'title'		=> __('reCAPTCHA secret key','job-board-manager'),
                'details'	=> __('reCAPTCHA secret key, please go <a href="https://www.google.com/recaptcha">google.com/reCAPTCHA</a> and register your site to get site key.','job-board-manager'),
                'type'		=> 'text',
                //'multiple'		=> true,
                'value'		=> $job_bm_reCAPTCHA_secret_key,
                'default'		=> '',
            );

            $settings_tabs_field->generate_field($args);


            $args = array(
                'id'		=> 'job_bm_submitted_job_status',
                //'parent'		=> 'post_grid_meta_options',
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
                'id'		=> 'job_bm_notify_email_job_submit',
                //'parent'		=> 'post_grid_meta_options',
                'title'		=> __('Notify email on job submit','job-board-manager'),
                'details'	=> __('Notify admin when new job submitted.','job-board-manager'),
                'type'		=> 'select',
                //'multiple'		=> true,
                'value'		=> $job_bm_notify_email_job_submit,
                'default'		=> '',
                'args'		=> array( 'yes'=>__('Yes','job-board-manager'), 'no'=>__('No','job-board-manager'),),
            );

            $settings_tabs_field->generate_field($args);


            $args = array(
                'id'		=> 'job_bm_notify_email_job_publish',
                //'parent'		=> 'post_grid_meta_options',
                'title'		=> __('Notify email on job published','job-board-manager'),
                'details'	=> __('Notify email to admin when new job published.','job-board-manager'),
                'type'		=> 'select',
                //'multiple'		=> true,
                'value'		=> $job_bm_notify_email_job_publish,
                'default'		=> 'no',
                'args'		=> array( 'no'=>__('No','job-board-manager'), 'yes'=>__('Yes','job-board-manager'), ),
            );

            $settings_tabs_field->generate_field($args);







            $page_list = job_bm_page_list_id();
            //$page_list = array_merge($page_list, array('job_preview'=>'Job Preview'));

            $page_list['job_preview'] = __('-- Job Preview --');
            $page_list['job_link'] = __('-- Job Link --');

            $args = array(
                'id'		=> 'job_bm_redirect_preview_link',
                //'parent'		=> 'post_grid_meta_options',
                'title'		=> __('Redirect after job submit','job-board-manager'),
                'details'	=> __('Redirect other link after job submitted','job-board-manager'),
                'type'		=> 'select',
                //'multiple'		=> true,
                'value'		=> $job_bm_redirect_preview_link,
                'default'		=> '',
                'args'		=> $page_list,
            );

            $settings_tabs_field->generate_field($args);









            ?>


        </div>
        <?php


    }
}



add_action('job_bm_settings_tabs_content_job_edit', 'job_bm_settings_tabs_content_job_edit');

if(!function_exists('job_bm_settings_tabs_content_job_edit')) {
    function job_bm_settings_tabs_content_job_edit($tab){

        $settings_tabs_field = new settings_tabs_field();


        $job_bm_can_user_edit_published_jobs = get_option('job_bm_can_user_edit_published_jobs');
        $job_bm_edited_job_status = get_option('job_bm_edited_job_status');
        $job_bm_edited_redirect_link = get_option('job_bm_edited_redirect_link');
        $job_bm_job_edit_notify_email = get_option('job_bm_job_edit_notify_email');



        ?>
        <div class="section">
            <div class="section-title"><?php echo __('Job edit settings', 'job-board-manager'); ?></div>
            <p class="description section-description"><?php echo __('Customize the job edit.', 'job-board-manager'); ?></p>

            <?php


            $args = array(
                'id'		=> 'job_bm_can_user_edit_published_jobs',
                //'parent'		=> 'post_grid_meta_options',
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
                'id'		=> 'job_bm_edited_job_status',
                //'parent'		=> 'post_grid_meta_options',
                'title'		=> __('Edited job status','job-board-manager'),
                'details'	=> __('Choose job status for newly edited jobs.','job-board-manager'),
                'type'		=> 'select',
                //'multiple'		=> true,
                'value'		=> $job_bm_edited_job_status,
                'default'		=> '',
                'args'		=> array( 'draft'=>__('Draft','job-board-manager'), 'pending'=>__('Pending','job-board-manager'), 'publish'=>__('Published','job-board-manager'), 'private'=>__('Private','job-board-manager'), 'trash'=>__('Trash','job-board-manager')),
            );

            $settings_tabs_field->generate_field($args);


            $page_list = job_bm_page_list_id();
            //$page_list = array_merge($page_list, array('job_preview'=>'Job Preview'));

            $page_list['job_preview'] = __('-- Job Preview --');
            $page_list['job_link'] = __('-- Job Link --');


            $args = array(
                'id'		=> 'job_bm_edited_redirect_link',
                //'parent'		=> 'post_grid_meta_options',
                'title'		=> __('Redirect after job edit','job-board-manager'),
                'details'	=> __('Redirect other link after job edited','job-board-manager'),
                'type'		=> 'select',
                //'multiple'		=> true,
                'value'		=> $job_bm_edited_redirect_link,
                'default'		=> '',
                'args'		=> $page_list,
            );

            $settings_tabs_field->generate_field($args);


            $args = array(
                'id'		=> 'job_bm_job_edit_notify_email',
                //'parent'		=> 'post_grid_meta_options',
                'title'		=> __('Notify email on job edited','job-board-manager'),
                'details'	=> __('Notify admin when new job edited.','job-board-manager'),
                'type'		=> 'select',
                //'multiple'		=> true,
                'value'		=> $job_bm_job_edit_notify_email,
                'default'		=> '',
                'args'		=> array( 'yes'=>__('Yes','job-board-manager'), 'no'=>__('No','job-board-manager'),),
            );

            $settings_tabs_field->generate_field($args);


            ?>

        </div>
        <?php



    }
}


add_action('job_bm_settings_tabs_content_dashboard', 'job_bm_settings_tabs_content_dashboard');

if(!function_exists('job_bm_settings_tabs_content_dashboard')) {
    function job_bm_settings_tabs_content_dashboard($tab){

        $settings_tabs_field = new settings_tabs_field();


        $job_bm_redirect_login = get_option('job_bm_redirect_login');
        $job_bm_redirect_logout = get_option('job_bm_redirect_logout');
        $job_bm_registration_enable = get_option('job_bm_registration_enable');
        $job_bm_login_enable = get_option('job_bm_login_enable');
        $job_bm_can_user_delete_jobs = get_option('job_bm_can_user_delete_jobs');
        $job_bm_can_user_delete_application = get_option('job_bm_can_user_delete_application');


        $page_list = job_bm_page_list_id();
        //$page_list = array_merge($page_list, array('job_preview'=>'Job Preview'));

        ?>
        <div class="section">
            <div class="section-title"><?php echo __('Dashboard settings', 'job-board-manager'); ?></div>
            <p class="description section-description"><?php echo __('Customize the dashboard.', 'job-board-manager'); ?></p>

            <?php




            $args = array(
                'id'		=> 'job_bm_redirect_login',
                //'parent'		=> 'post_grid_meta_options',
                'title'		=> __('Redirect after login','job-board-manager'),
                'details'	=> __('Redirect other link after logged.','job-board-manager'),
                'type'		=> 'select',
                //'multiple'		=> true,
                'value'		=> $job_bm_redirect_login,
                'default'		=> '',
                'args'		=> $page_list,
            );

            $settings_tabs_field->generate_field($args);


            $args = array(
                'id'		=> 'job_bm_redirect_logout',
                //'parent'		=> 'post_grid_meta_options',
                'title'		=> __('Redirect after logged out','job-board-manager'),
                'details'	=> __('Redirect other link after logged out.','job-board-manager'),
                'type'		=> 'select',
                //'multiple'		=> true,
                'value'		=> $job_bm_redirect_logout,
                'default'		=> '',
                'args'		=> $page_list,
            );

            $settings_tabs_field->generate_field($args);




            $args = array(
                'id'		=> 'job_bm_registration_enable',
                //'parent'		=> 'post_grid_meta_options',
                'title'		=> __('Registration enable','job-board-manager'),
                'details'	=> __('Registration enable on dashboard page.','job-board-manager'),
                'type'		=> 'select',
                //'multiple'		=> true,
                'value'		=> $job_bm_registration_enable,
                'default'		=> '',
                'args'		=> array( 'yes'=>__('Yes','job-board-manager'), 'no'=>__('No','job-board-manager'),),
            );

            $settings_tabs_field->generate_field($args);


            $args = array(
                'id'		=> 'job_bm_login_enable',
                //'parent'		=> 'post_grid_meta_options',
                'title'		=> __('Login enable','job-board-manager'),
                'details'	=> __('Login enable on dashboard page.','job-board-manager'),
                'type'		=> 'select',
                //'multiple'		=> true,
                'value'		=> $job_bm_login_enable,
                'default'		=> '',
                'args'		=> array( 'yes'=>__('Yes','job-board-manager'), 'no'=>__('No','job-board-manager'),),
            );

            $settings_tabs_field->generate_field($args);

            $args = array(
                'id'		=> 'job_bm_can_user_delete_jobs',
                //'parent'		=> 'post_grid_meta_options',
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
                //'parent'		=> 'post_grid_meta_options',
                'title'		=> __('Allow delete application','job-board-manager'),
                'details'	=> __('Allow user delete their own application','job-board-manager'),
                'type'		=> 'select',
                //'multiple'		=> true,
                'value'		=> $job_bm_can_user_delete_application,
                'default'		=> '',
                'args'		=> array( 'yes'=>__('Yes','job-board-manager'), 'no'=>__('No','job-board-manager'),),
            );

            $settings_tabs_field->generate_field($args);




            ?>

        </div>
        <?php











    }
}




add_action('job_bm_settings_tabs_content_email', 'job_bm_settings_tabs_content_email');

if(!function_exists('job_bm_settings_tabs_content_email')) {
    function job_bm_settings_tabs_content_email($tab){

        $settings_tabs_field = new settings_tabs_field();


        $job_bm_logo_url = get_option('job_bm_logo_url');
        $job_bm_from_email = get_option('job_bm_from_email');






        ?>
        <div class="section">
            <div class="section-title"><?php echo __('Email settings', 'job-board-manager'); ?></div>
            <p class="description section-description"><?php echo __('Customize email settings.', 'job-board-manager'); ?></p>

            <?php

            $args = array(
                'id'		=> 'job_bm_logo_url',
                //'parent'		=> 'post_grid_meta_options',
                'title'		=> __('Email logo','job-board-manager'),
                'details'	=> __('Email logo URL to display on mail.','job-board-manager'),
                'type'		=> 'media',
                'value'		=> $job_bm_logo_url,
                'default'		=> '',
                'placeholder'		=> '',
            );

            $settings_tabs_field->generate_field($args);



            $args = array(
                'id'		=> 'job_bm_from_email',
                //'parent'		=> 'post_grid_meta_options',
                'title'		=> __('From email address','job-board-manager'),
                'details'	=> __('Write from email address.','job-board-manager'),
                'type'		=> 'text',
                //'multiple'		=> true,
                'value'		=> $job_bm_from_email,
                'default'		=> '',
            );

            $settings_tabs_field->generate_field($args);



            $job_bm_email_templates_data = get_option( 'job_bm_email_templates_data' );

            if(empty($job_bm_email_templates_data)){

                $class_job_bm_emails = new class_job_bm_emails();
                $templates_data = $class_job_bm_emails->job_bm_email_templates_data();


            }
            else{


                $class_job_bm_emails = new class_job_bm_emails();
                $templates_data = $class_job_bm_emails->job_bm_email_templates_data();

                $templates_data =array_merge($templates_data, $job_bm_email_templates_data);

            }

            $html = '';

            ob_start();





            $html.= '<div class="templates_editor expandable">';
            foreach($templates_data as $key=>$templates){

                if(!empty($templates['email_to'])){
                    $email_to = $templates['email_to'];
                }
                else{
                    $email_to = '';
                }

                if(!empty($templates['email_from'])){
                    $email_from = $templates['email_from'];
                }
                else{
                    $email_from = '';
                }


                if(!empty($templates['email_from_name'])){
                    $email_from_name = $templates['email_from_name'];
                }
                else{

                    //$site_name = get_bloginfo('name');
                    $email_from_name = '';
                }


                if(!empty($templates['enable'])){
                    $enable = $templates['enable'];
                }
                else{
                    $enable = '';
                }



                if(!empty($templates['description'])){
                    $description = $templates['description'];
                }
                else{
                    $description = '';
                }




                $html.= '<div class="item template '.$key.'">';
                $html.= '<div class="header">'.$templates['name'].'</div>';
                $html.= '<input type="hidden" name="job_bm_email_templates_data['.$key.'][name]" value="'.$templates['name'].'" />';

                $html.= '<div class="options">';

                $html.= '<div class="description">'.$description.'</div><br/><br/>';


                $html.= '<label>'.__('Enable ?', 'job-board-manager').'<br/>';	// .options
                $html.= '<select name="job_bm_email_templates_data['.$key.'][enable]" >';

                if($enable=='yes'){

                    $html.= '<option selected  value="yes" >Yes</option>';
                }
                else{
                    $html.= '<option value="yes" >Yes</option>';
                }

                if($enable=='no'){

                    $html.= '<option selected value="no" >No</option>';
                }
                else{
                    $html.= '<option value="no" >No</option>';
                }
                $html.= '</select>';
                $html.= '</label><br /><br />';



                $html.= '<label>'.__('Email To:', 'job-board-manager').'<br/>';	// .options
                $html.= '<input placeholder="hello_1@hello.com,hello_2@hello.com" type="text" name="job_bm_email_templates_data['.$key.'][email_to]" value="'.$email_to.'" />';	// .options
                $html.= '</label><br /><br />';


                $html.= '<label>'.__('Email from name:', 'job-board-manager').'<br/>';	// .options
                $html.= '<input placeholder="hello_1@hello.com" type="text" name="job_bm_email_templates_data['.$key.'][email_from_name]" value="'.$email_from_name.'" />';	// .options
                $html.= '</label><br /><br />';

                $html.= '<label>'.__('Email from:', 'job-board-manager').'<br/>';	// .options
                $html.= '<input placeholder="hello_1@hello.com" type="text" name="job_bm_email_templates_data['.$key.'][email_from]" value="'.$email_from.'" />';	// .options
                $html.= '</label><br /><br />';






                $html.= '<label>'.__('Email Subject:','job-board-manager').'<br/>';	// .options
                $html.= '<input type="text" name="job_bm_email_templates_data['.$key.'][subject]" value="'.$templates['subject'].'" />';	// .options
                $html.= '</label>';


                ob_start();
                wp_editor( $templates['html'], $key, $settings = array('textarea_name'=>'job_bm_email_templates_data['.$key.'][html]','media_buttons'=>false,'wpautop'=>true,'teeny'=>true,'editor_height'=>'400px', ) );
                $editor_contents = ob_get_clean();

                $html.= '<br/><label>'.__('Email Body:','job-board-manager').'<br/>';	// .options
                $html.= $editor_contents;
                $html.= '</label>';

                $html.= '</div>';	// .options
                $html.= '</div>'; //.items


            }

            $html.= '</div>';



            echo $html;

            $html = ob_get_clean();




            $args = array(
                'id'		=> 'job_bm_email_templates',
                //'parent'		=> 'post_grid_meta_options',
                'title'		=> __('Email templates','job-board-manager'),
                'details'	=> __('Customize email templates.','job-board-manager'),
                'type'		=> 'custom_html',
                //'multiple'		=> true,
                'html'		=> $html,
            );

            $settings_tabs_field->generate_field($args);




            ?>


        </div>
        <?php


    }
}






add_action('job_bm_settings_tabs_content_style', 'job_bm_settings_tabs_content_style');

if(!function_exists('job_bm_settings_tabs_content_style')) {
    function job_bm_settings_tabs_content_style($tab){

        $settings_tabs_field = new settings_tabs_field();
        $class_job_bm_functions = new class_job_bm_functions();




        $job_bm_featured_bg_color = get_option('job_bm_featured_bg_color');
        $job_bm_job_type_bg_color = get_option('job_bm_job_type_bg_color');
        $job_bm_job_type_text_color = get_option('job_bm_job_type_text_color');
        $job_bm_job_status_bg_color = get_option('job_bm_job_status_bg_color');
        $job_bm_job_status_text_color = get_option('job_bm_job_status_text_color');







        ?>
        <div class="section">
            <div class="section-title"><?php echo __('Style settings', 'job-board-manager'); ?></div>
            <p class="description section-description"><?php echo __('Customize the style.', 'job-board-manager'); ?></p>

            <?php

            $args = array(
                'id'		=> 'job_bm_featured_bg_color',
                //'parent'		=> 'post_grid_meta_options',
                'title'		=> __('Featured job background color','job-board-manager'),
                'details'	=> __('Choose custom background color featured job.','job-board-manager'),
                'type'		=> 'colorpicker',
                'value'		=> $job_bm_featured_bg_color,
                'default'		=> '#fff8bf',
                'placeholder'		=> '',
            );

            $settings_tabs_field->generate_field($args);



            $args = array(
                'id'		=> 'job_bm_job_type_bg_color',
                //'parent'		=> 'post_grid_meta_options',
                'title'		=> __('Job type background color','job-board-manager'),
                'details'	=> __('Job types area background color.','job-board-manager'),
                'type'		=> 'colorpicker_multi',
                'value'		=> $job_bm_job_type_bg_color,
                'args'		=> $class_job_bm_functions->job_type_bg_color(),

            );

            $settings_tabs_field->generate_field($args);

            $args = array(
                'id'		=> 'job_bm_job_type_text_color',
                //'parent'		=> 'post_grid_meta_options',
                'title'		=> __('Job type text color','job-board-manager'),
                'details'	=> __('Job types area text color.','job-board-manager'),
                'type'		=> 'colorpicker_multi',
                'value'		=> $job_bm_job_type_text_color,
                'args'		=> $class_job_bm_functions->job_type_text_color(),

            );

            $settings_tabs_field->generate_field($args);



            $args = array(
                'id'		=> 'job_bm_job_status_bg_color',
                //'parent'		=> 'post_grid_meta_options',
                'title'		=> __('Job status background color','job-board-manager'),
                'details'	=> __('Job status area background color.','job-board-manager'),
                'type'		=> 'colorpicker_multi',
                'value'		=> $job_bm_job_status_bg_color,
                'args'		=> $class_job_bm_functions->job_status_bg_color(),

            );

            $settings_tabs_field->generate_field($args);


            $args = array(
                'id'		=> 'job_bm_job_status_text_color',
                //'parent'		=> 'post_grid_meta_options',
                'title'		=> __('Job status text color','job-board-manager'),
                'details'	=> __('Job status area text color.','job-board-manager'),
                'type'		=> 'colorpicker_multi',
                'value'		=> $job_bm_job_status_text_color,
                'args'		=> $class_job_bm_functions->job_status_text_color(),

            );

            $settings_tabs_field->generate_field($args);



            ?>


        </div>
        <?php


    }
}













add_action('job_bm_settings_tabs_content_expiry', 'job_bm_settings_tabs_content_expiry');

if(!function_exists('job_bm_settings_tabs_content_expiry')) {
    function job_bm_settings_tabs_content_expiry($tab){

        $settings_tabs_field = new settings_tabs_field();
        $class_job_bm_functions = new class_job_bm_functions();




        $job_bm_enable_expiry = get_option('job_bm_enable_expiry');
        $job_bm_experied_jobs_post_status = get_option('job_bm_experied_jobs_post_status');
        $job_bm_experied_check_recurrance = get_option('job_bm_experied_check_recurrance');
        $job_bm_job_expiry_days = get_option('job_bm_job_expiry_days');






        ?>
        <div class="section">
            <div class="section-title"><?php echo __('Job expire settings', 'job-board-manager'); ?></div>
            <p class="description section-description"><?php echo __('Customize job expire settings.', 'job-board-manager'); ?></p>

            <?php

            $args = array(
                'id'		=> 'job_bm_enable_expiry',
                //'parent'		=> 'post_grid_meta_options',
                'title'		=> __('Enable job expiry','job-board-manager'),
                'details'	=> __('You can enable or disable job expiry.','job-board-manager'),
                'type'		=> 'select',
                //'multiple'		=> true,
                'value'		=> $job_bm_enable_expiry,
                'default'		=> 'no',
                'args'		=> array( 'no'=>__('No','job-board-manager'), 'yes'=>__('Yes','job-board-manager'), ),
            );

            $settings_tabs_field->generate_field($args);


            $args = array(
                'id'		=> 'job_bm_experied_jobs_post_status',
                //'parent'		=> 'post_grid_meta_options',
                'title'		=> __('Expired jobs status','job-board-manager'),
                'details'	=> __('Set post status for expired jobs.','job-board-manager'),
                'type'		=> 'select',
                //'multiple'		=> true,
                'value'		=> $job_bm_experied_jobs_post_status,
                'default'		=> 'trash',
                'args'		=> array('publish'=>__('Publish', 'job-board-manager'), 'draft'=>__('Draft', 'job-board-manager'), 'pending'=>__('Pending', 'job-board-manager'),'private'=>__('Private', 'job-board-manager'), 'trash'=>__('Trash', 'job-board-manager')),
            );

            $settings_tabs_field->generate_field($args);


            $args = array(
                'id'		=> 'job_bm_experied_check_recurrance',
                //'parent'		=> 'post_grid_meta_options',
                'title'		=> __('Expired check recurrence','job-board-manager'),
                'details'	=> __('Set recurrence for checking expired jobs.','job-board-manager'),
                'type'		=> 'select',
                //'multiple'		=> true,
                'value'		=> $job_bm_experied_check_recurrance,
                'default'		=> 'daily',
                'args'		=> array('hourly'=>__('Hourly', 'job-board-manager'), 'twicedaily'=>__('Twicedaily', 'job-board-manager'), 'daily'=>__('Daily', 'job-board-manager')),
            );

            $settings_tabs_field->generate_field($args);


            $args = array(
                'id'		=> 'job_bm_job_expiry_days',
                //'parent'		=> 'post_grid_meta_options',
                'title'		=> __('Expire days','job-board-manager'),
                'details'	=> __('Set custom value for expire in.','job-board-manager'),
                'type'		=> 'text',
                //'multiple'		=> true,
                'value'		=> $job_bm_job_expiry_days,
                'default'		=> '30',
            );

            $settings_tabs_field->generate_field($args);




            ?>


        </div>
        <?php


    }
}



add_action('job_bm_settings_tabs_content_applications', 'job_bm_settings_tabs_content_applications');

if(!function_exists('job_bm_settings_tabs_content_applications')) {
    function job_bm_settings_tabs_content_applications($tab){

        $settings_tabs_field = new settings_tabs_field();
        $class_job_bm_functions = new class_job_bm_functions();
        $apply_method_list = $class_job_bm_functions->apply_method_list();


        $job_bm_application_methods = get_option('job_bm_application_methods');
        $job_bm_login_required_on_apply = get_option('job_bm_login_required_on_apply');
        $job_bm_apply_enable_recaptcha = get_option('job_bm_apply_enable_recaptcha');







        ?>
        <div class="section">
            <div class="section-title"><?php echo __('Job expire settings', 'job-board-manager'); ?></div>
            <p class="description section-description"><?php echo __('Customize job expire settings.', 'job-board-manager'); ?></p>

            <?php

            $args = array(
                'id'		=> 'job_bm_login_required_on_apply',
                //'parent'		=> 'post_grid_meta_options',
                'title'		=> __('Login required for application','job-board-manager'),
                'details'	=> __('Login is required or not for submit application.','job-board-manager'),
                'type'		=> 'select',
                //'multiple'		=> true,
                'value'		=> $job_bm_login_required_on_apply,
                'default'		=> 'yes',
                'args'		=> array( 'no'=>__('No','job-board-manager'), 'yes'=>__('Yes','job-board-manager'), ),
            );

            $settings_tabs_field->generate_field($args);

            $args = array(
                'id'		=> 'job_bm_apply_enable_recaptcha',
                //'parent'		=> 'post_grid_meta_options',
                'title'		=> __('Enable recaptcha','job-board-manager'),
                'details'	=> __('Enable recaptcha on submit application.','job-board-manager'),
                'type'		=> 'select',
                //'multiple'		=> true,
                'value'		=> $job_bm_apply_enable_recaptcha,
                'default'		=> 'yes',
                'args'		=> array( 'no'=>__('No','job-board-manager'), 'yes'=>__('Yes','job-board-manager'), ),
            );

            $settings_tabs_field->generate_field($args);


            $args = array(
                'id'		=> 'job_bm_application_methods',
                //'parent'		=> 'post_grid_meta_options',
                'title'		=> __('Apply method','job-board-manager'),
                'details'	=> __('Choose aplication method on job post.','job-board-manager'),
                'type'		=> 'select',
                'multiple'		=> true,
                'value'		=> $job_bm_application_methods,
                'default'		=> array('none'),
                'args'		=> $apply_method_list,
            );

            $settings_tabs_field->generate_field($args);

            ?>


        </div>
        <?php


    }
}
