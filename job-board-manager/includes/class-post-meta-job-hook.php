<?php
if ( ! defined('ABSPATH')) exit;  // if direct access




add_action('job_bm_metabox_job_content_job_info','job_bm_metabox_job_content_job_info');


function job_bm_metabox_job_content_job_info($job_id){


    ?>
    <div class="section">
        <div class="section-title">Job Information</div>
        <p class="section-description"></p>
    </div>


    <?php


}







add_action('job_bm_metabox_job_content_job_info','job_bm_meta_box_job_total_vacancies');

function job_bm_meta_box_job_total_vacancies($job_id){

    $settings_tabs_field = new settings_tabs_field();

    $job_bm_total_vacancies = get_post_meta($job_id, 'job_bm_total_vacancies', true);

    $args = array(
        'id'		=> 'job_bm_total_vacancies',
        //'parent'		=> 'post_grid_meta_options',
        'title'		=> __('Total vacancies','job-board-manager'),
        'details'	=> __('Total number of vacancies','job-board-manager'),
        'type'		=> 'text',
        'value'		=> $job_bm_total_vacancies,
        'default'		=> '',
        'placeholder'		=> '',
    );

    $settings_tabs_field->generate_field($args);

}








add_action('job_bm_metabox_job_content_job_info','job_bm_meta_box_job_type');

function job_bm_meta_box_job_type($job_id){

    $settings_tabs_field = new settings_tabs_field();
    $class_job_bm_functions = new class_job_bm_functions();
    $job_type_list = $class_job_bm_functions->job_type_list();

    $job_bm_job_type = get_post_meta($job_id, 'job_bm_job_type', true);

    $args = array(
        'id'		=> 'job_bm_job_type',
        //'parent'		=> 'post_grid_meta_options',
        'title'		=> __('Job type','job-board-manager'),
        'details'	=> __('Select job type.','job-board-manager'),
        'type'		=> 'select',
        'value'		=> $job_bm_job_type,
        'default'		=> '',
        'args'		=> $job_type_list,
    );

    $settings_tabs_field->generate_field($args);

}



add_action('job_bm_metabox_job_content_job_info','job_bm_meta_box_job_level');

function job_bm_meta_box_job_level($job_id){

    $settings_tabs_field = new settings_tabs_field();
    $class_job_bm_functions = new class_job_bm_functions();
    $job_level_list = $class_job_bm_functions->job_level_list();

    $job_bm_job_level = get_post_meta($job_id, 'job_bm_job_level', true);

    $args = array(
        'id'		=> 'job_bm_job_level',
        //'parent'		=> 'post_grid_meta_options',
        'title'		=> __('Job level','job-board-manager'),
        'details'	=> __('Select job level.','job-board-manager'),
        'type'		=> 'select',
        'value'		=> $job_bm_job_level,
        'default'		=> '',
        'args'		=> $job_level_list,
    );

    $settings_tabs_field->generate_field($args);

}










add_action('job_bm_metabox_job_content_job_info','job_bm_meta_box_job_years_experience');

function job_bm_meta_box_job_years_experience($job_id){

    $settings_tabs_field = new settings_tabs_field();

    $job_bm_years_experience = get_post_meta($job_id, 'job_bm_years_experience', true);

    $args = array(
        'id'		=> 'job_bm_years_experience',
        //'parent'		=> 'post_grid_meta_options',
        'title'		=> __('Years of experience','job-board-manager'),
        'details'	=> __('Years of experience must have.','job-board-manager'),
        'type'		=> 'text',
        'value'		=> $job_bm_years_experience,
        'default'		=> '',
        'placeholder'		=> '',
    );

    $settings_tabs_field->generate_field($args);

}








add_action('job_bm_metabox_job_content_job_info','job_bm_meta_box_salary_type');

function job_bm_meta_box_salary_type($job_id){

    $settings_tabs_field = new settings_tabs_field();
    $class_job_bm_functions = new class_job_bm_functions();
    $salary_type_list = $class_job_bm_functions->salary_type_list();

    $job_bm_salary_type = get_post_meta($job_id, 'job_bm_salary_type', true);

    $args = array(
        'id'		=> 'job_bm_salary_type',
        //'parent'		=> 'post_grid_meta_options',
        'title'		=> __('Salary type','job-board-manager'),
        'details'	=> __('Select salary type.','job-board-manager'),
        'type'		=> 'select',
        'value'		=> $job_bm_salary_type,
        'default'		=> '',
        'args'		=> $salary_type_list,
    );

    $settings_tabs_field->generate_field($args);

}






add_action('job_bm_metabox_job_content_job_info','job_bm_meta_box_job_salary_fixed');

function job_bm_meta_box_job_salary_fixed($job_id){

    $settings_tabs_field = new settings_tabs_field();
    $job_bm_salary_fixed = get_post_meta($job_id, 'job_bm_salary_fixed', true);

    $args = array(
        'id'		=> 'job_bm_salary_fixed',
        //'parent'		=> 'post_grid_meta_options',
        'title'		=> __('Fixed salary','job-board-manager'),
        'details'	=> __('Salary fixed, ex: 1200','job-board-manager'),
        'type'		=> 'text',
        'value'		=> $job_bm_salary_fixed,
        'default'		=> '',
        'placeholder'		=> '',
    );

    $settings_tabs_field->generate_field($args);

}




add_action('job_bm_metabox_job_content_job_info','job_bm_meta_box_job_salary_min');

function job_bm_meta_box_job_salary_min($job_id){

    $settings_tabs_field = new settings_tabs_field();
    $job_bm_salary_min = get_post_meta($job_id, 'job_bm_salary_fixed', true);

    $args = array(
        'id'		=> 'job_bm_salary_min',
        //'parent'		=> 'post_grid_meta_options',
        'title'		=> __('Minimum salary','job-board-manager'),
        'details'	=> __('Minimum salary amount, ex: 5000','job-board-manager'),
        'type'		=> 'text',
        'value'		=> $job_bm_salary_min,
        'default'		=> '',
        'placeholder'		=> '',
    );

    $settings_tabs_field->generate_field($args);

}




add_action('job_bm_metabox_job_content_job_info','job_bm_meta_box_job_salary_max');

function job_bm_meta_box_job_salary_max($job_id){

    $settings_tabs_field = new settings_tabs_field();
    $job_bm_salary_max = get_post_meta($job_id, 'job_bm_salary_max', true);

    $args = array(
        'id'		=> 'job_bm_salary_max',
        //'parent'		=> 'post_grid_meta_options',
        'title'		=> __('Maximum salary','job-board-manager'),
        'details'	=> __('Maximum salary amount, ex: 1000','job-board-manager'),
        'type'		=> 'text',
        'value'		=> $job_bm_salary_max,
        'default'		=> '',
        'placeholder'		=> '',
    );

    $settings_tabs_field->generate_field($args);

}




add_action('job_bm_metabox_job_content_job_info','job_bm_meta_box_job_salary_currency');

function job_bm_meta_box_job_salary_currency($job_id){

    $settings_tabs_field = new settings_tabs_field();
    $job_bm_salary_currency = get_post_meta($job_id, 'job_bm_salary_currency', true);

    $args = array(
        'id'		=> 'job_bm_salary_currency',
        //'parent'		=> 'post_grid_meta_options',
        'title'		=> __('Salary currency','job-board-manager'),
        'details'	=> __('Write salary currency, ex: $','job-board-manager'),
        'type'		=> 'text',
        'value'		=> $job_bm_salary_currency,
        'default'		=> '',
        'placeholder'		=> '',
    );

    $settings_tabs_field->generate_field($args);

}


add_action('job_bm_metabox_job_content_job_info','job_bm_meta_box_job_contact_email');

function job_bm_meta_box_job_contact_email($job_id){

    $settings_tabs_field = new settings_tabs_field();
    $job_bm_contact_email = get_post_meta($job_id, 'job_bm_contact_email', true);

    $args = array(
        'id'		=> 'job_bm_contact_email',
        //'parent'		=> 'post_grid_meta_options',
        'title'		=> __('Salary currency','job-board-manager'),
        'details'	=> __('Write salary currency, ex: $','job-board-manager'),
        'type'		=> 'text',
        'value'		=> $job_bm_contact_email,
        'default'		=> '',
        'placeholder'		=> '',
    );

    $settings_tabs_field->generate_field($args);

}


add_action('job_bm_metabox_job_content_company_info','job_bm_metabox_job_content_company_info');

function job_bm_metabox_job_content_company_info($job_id){


    ?>
    <div class="section">
        <div class="section-title">Company Information</div>
        <p class="section-description"></p>
    </div>
    <?php

}










add_action('job_bm_meta_box_save_job','job_bm_meta_box_save_job');

function job_bm_meta_box_save_job($job_id){

    $job_bm_total_vacancies = isset($_POST['job_bm_total_vacancies']) ? sanitize_text_field($_POST['job_bm_total_vacancies']) : '';
    update_post_meta($job_id, 'job_bm_total_vacancies', $job_bm_total_vacancies);

    $job_bm_job_type = isset($_POST['job_bm_job_type']) ? sanitize_text_field($_POST['job_bm_job_type']) : '';
    update_post_meta($job_id, 'job_bm_job_type', $job_bm_job_type);

    $job_bm_job_level = isset($_POST['job_bm_job_level']) ? sanitize_text_field($_POST['job_bm_job_level']) : '';
    update_post_meta($job_id, 'job_bm_job_level', $job_bm_job_level);

    $job_bm_years_experience = isset($_POST['job_bm_years_experience']) ? sanitize_text_field($_POST['job_bm_years_experience']) : '';
    update_post_meta($job_id, 'job_bm_years_experience', $job_bm_years_experience);

    $job_bm_salary_type = isset($_POST['job_bm_salary_type']) ? sanitize_text_field($_POST['job_bm_salary_type']) : '';
    update_post_meta($job_id, 'job_bm_salary_type', $job_bm_salary_type);

    $job_bm_salary_fixed = isset($_POST['job_bm_salary_fixed']) ? sanitize_text_field($_POST['job_bm_salary_fixed']) : '';
    update_post_meta($job_id, 'job_bm_salary_fixed', $job_bm_salary_fixed);

    $job_bm_salary_min = isset($_POST['job_bm_salary_min']) ? sanitize_text_field($_POST['job_bm_salary_min']) : '';
    update_post_meta($job_id, 'job_bm_salary_min', $job_bm_salary_min);

    $job_bm_salary_max = isset($_POST['job_bm_salary_max']) ? sanitize_text_field($_POST['job_bm_salary_max']) : '';
    update_post_meta($job_id, 'job_bm_salary_max', $job_bm_salary_max);

    $job_bm_salary_currency = isset($_POST['job_bm_salary_max']) ? sanitize_text_field($_POST['job_bm_salary_currency']) : '';
    update_post_meta($job_id, 'job_bm_salary_currency', $job_bm_salary_currency);

    $job_bm_contact_email = isset($_POST['job_bm_salary_max']) ? sanitize_text_field($_POST['job_bm_contact_email']) : '';
    update_post_meta($job_id, 'job_bm_contact_email', $job_bm_contact_email);








}

