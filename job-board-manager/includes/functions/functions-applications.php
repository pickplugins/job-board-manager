<?php
if ( ! defined('ABSPATH')) exit;  // if direct access





function job_bm_ajax_application_marked_hired() {

    $application_id = isset($_POST['application_id']) ? sanitize_text_field($_POST['application_id']) : '';

    $response = array();

    $application_hired = get_post_meta($application_id, 'application_hired', true);

    if($application_hired =='yes'){
        update_post_meta($application_id, 'application_hired','no');
        $response['hired'] = 'no';

        do_action('job_bm_application_hire','no', $application_id);



    }else{
        update_post_meta($application_id, 'application_hired','yes');
        $response['hired'] = 'yes';

        do_action('job_bm_application_hire','yes', $application_id);

    }

    echo json_encode($response);

    die();
}

add_action('wp_ajax_job_bm_ajax_application_marked_hired', 'job_bm_ajax_application_marked_hired');
//add_action('wp_ajax_nopriv_job_bm_ajax_delete_job_by_id', 'job_bm_ajax_delete_job_by_id');


function job_bm_ajax_application_marked_trash() {

    $application_id = isset($_POST['application_id']) ? sanitize_text_field($_POST['application_id']) : '';

    $response = array();

    $application_hired = get_post_meta($application_id, 'application_trash', true);

    if($application_hired =='yes'){
        update_post_meta($application_id, 'application_trash','no');
        $response['trash'] = 'no';

    }else{
        update_post_meta($application_id, 'application_trash','yes');
        $response['trash'] = 'yes';

    }

    echo json_encode($response);

    die();
}

add_action('wp_ajax_job_bm_ajax_application_marked_trash', 'job_bm_ajax_application_marked_trash');
//add_action('wp_ajax_nopriv_job_bm_ajax_delete_job_by_id', 'job_bm_ajax_delete_job_by_id');













