<?php
if ( ! defined('ABSPATH')) exit;  // if direct access





function job_bm_ajax_application_marked_hired() {

    $current_user_id = get_current_user_id();
    $application_id = isset($_POST['application_id']) ? sanitize_text_field($_POST['application_id']) : '';
    $job_id = (int)get_post_meta($application_id, 'job_bm_am_job_id', true);

    $job_data = get_post($job_id);
    $job_author_id = (int) $job_data->post_author;


    $response = array();

    $application_hired = get_post_meta($application_id, 'application_hired', true);

    if($current_user_id == $job_author_id ){

        if($application_hired =='yes'){
            update_post_meta($application_id, 'application_hired','no');
            $response['hired'] = 'no';
            $response['message'] = __('Application not hired','job-board-manager');

            do_action('job_bm_application_hire','no', $application_id);

        }else{
            update_post_meta($application_id, 'application_hired','yes');
            $response['hired'] = 'yes';
            $response['message'] = __('Application hired','job-board-manager');

            do_action('job_bm_application_hire','yes', $application_id);
        }


    }else{
        $response['hired'] = 'no';
        $response['message'] = __('You are not authorized to do this.','job-board-manager');


    }




    echo json_encode($response);

    die();
}

add_action('wp_ajax_job_bm_ajax_application_marked_hired', 'job_bm_ajax_application_marked_hired');
//add_action('wp_ajax_nopriv_job_bm_ajax_delete_job_by_id', 'job_bm_ajax_delete_job_by_id');


function job_bm_ajax_application_marked_trash() {

    $current_user_id = (int) get_current_user_id();

    $application_id = isset($_POST['application_id']) ? sanitize_text_field($_POST['application_id']) : '';
    $application_data = get_post($application_id);
    $application_author_id = (int) $application_data->post_author;

    $job_id = (int)get_post_meta($application_id, 'job_bm_am_job_id', true);
    $job_data = get_post($job_id);
    $job_author_id = (int) $job_data->post_author;


    $response = array();

    $application_trash = get_post_meta($application_id, 'application_trash', true);


    if(($current_user_id == $application_author_id )|| ($current_user_id == $job_author_id) ){

        if($application_trash =='yes'){
            delete_post_meta($application_id, 'application_trash');
            $response['trash'] = 'no';
            $response['message'] = __('Application not trashed.','job-board-manager');

            do_action('job_bm_application_trash','no', $application_id);


        }else{
            update_post_meta($application_id, 'application_trash','yes');
            $response['trash'] = 'yes';
            $response['message'] = __('Application trashed.','job-board-manager');

            do_action('job_bm_application_trash','yes', $application_id);
        }
    }else{
        $response['trash'] = 'no';
        $response['message'] = __('You are not authorized to do this.','job-board-manager');

    }



    echo json_encode($response);

    die();
}

add_action('wp_ajax_job_bm_ajax_application_marked_trash', 'job_bm_ajax_application_marked_trash');
//add_action('wp_ajax_nopriv_job_bm_ajax_delete_job_by_id', 'job_bm_ajax_delete_job_by_id');





function job_bm_ajax_application_rate() {

    $current_user_id = (int) get_current_user_id();

    $application_id = isset($_POST['application_id']) ? sanitize_text_field($_POST['application_id']) : '';
    $application_data = get_post($application_id);
    $application_author_id = (int) $application_data->post_author;

    $job_id = (int)get_post_meta($application_id, 'job_bm_am_job_id', true);
    $job_data = get_post($job_id);
    $job_author_id = (int) $job_data->post_author;



    $data_count = isset($_POST['data_count']) ? (int)sanitize_text_field($_POST['data_count']) : '';

    $response = array();

    if($current_user_id == $job_author_id ){
        update_post_meta($application_id, 'application_rating', $data_count);
        do_action('job_bm_application_rate', $data_count, $application_id);
        $response['star_rate'] = $data_count;
        $response['message'] = __('Rate successful.','job-board-manager');

    }else{
        $response['star_rate'] = 0;

        $response['message'] = __('You cant rate this application.','job-board-manager');
    }





    echo json_encode($response);

    die();
}

add_action('wp_ajax_job_bm_ajax_application_rate', 'job_bm_ajax_application_rate');
//add_action('wp_ajax_nopriv_job_bm_ajax_delete_job_by_id', 'job_bm_ajax_delete_job_by_id');



