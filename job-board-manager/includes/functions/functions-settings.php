<?php
/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 
	

add_action('job_bm_settings_tabs_content_general', 'job_bm_settings_tabs_content_general');

if(!function_exists('job_bm_settings_tabs_content_general')) {
    function job_bm_settings_tabs_content_general($tab){

    $settings_tabs_field = new settings_tabs_field();
    $custom_css = '';


    ?>
    <div class="section">
        <div class="section-title">General settings</div>
        <p class="description section-description">Choose some basic setting to get started.</p>

        <?php

        $args = array(
            'id'		=> 'custom_css',
            'parent' => 'testimonial_options',
            'title'		=> __('Custom CSS','testimonial'),
            'details'	=> __('Add your own CSS..','testimonial'),
            'type'		=> 'scripts_css',
            'value'		=> $custom_css,
            'default'		=> '.testimonial-container #testimonial-133{}&#10; ',
        );

        $settings_tabs_field->generate_field($args);









        ?>


    </div>
    <?php


    }

    }