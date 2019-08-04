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

    $application_trash = get_post_meta($application_id, 'application_trash', true);




    if($application_trash =='yes'){
        delete_post_meta($application_id, 'application_trash');
        $response['trash'] = 'no';

        do_action('job_bm_application_trash','no', $application_id);


    }else{
        update_post_meta($application_id, 'application_trash','yes');
        $response['trash'] = 'yes';

        do_action('job_bm_application_trash','yes', $application_id);


    }

    echo json_encode($response);

    die();
}

add_action('wp_ajax_job_bm_ajax_application_marked_trash', 'job_bm_ajax_application_marked_trash');
//add_action('wp_ajax_nopriv_job_bm_ajax_delete_job_by_id', 'job_bm_ajax_delete_job_by_id');





function job_bm_ajax_application_rate() {

    $application_id = isset($_POST['application_id']) ? (int)sanitize_text_field($_POST['application_id']) : '';
    $data_count = isset($_POST['data_count']) ? (int)sanitize_text_field($_POST['data_count']) : '';

    $response = array();


    update_post_meta($application_id, 'application_rating', $data_count);

    do_action('job_bm_application_rate', $data_count, $application_id);


    $response['star_rate'] = $data_count;

    echo json_encode($response);

    die();
}

add_action('wp_ajax_job_bm_ajax_application_rate', 'job_bm_ajax_application_rate');
//add_action('wp_ajax_nopriv_job_bm_ajax_delete_job_by_id', 'job_bm_ajax_delete_job_by_id');



