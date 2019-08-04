<?php
if ( ! defined('ABSPATH')) exit;  // if direct access


// Email notifications


function job_bm_application_hire_send_email($status, $application_id){

    $job_bm_logo_url = get_option('job_bm_logo_url');
    $job_bm_logo_url = wp_get_attachment_url($job_bm_logo_url);
    $site_url = get_bloginfo('url');
    $site_description = get_bloginfo('description');
    $site_name = get_bloginfo('name');

    global $current_user;


    $email_data = array();
    $class_job_bm_emails = new class_job_bm_emails();
    $job_bm_email_templates_data_default = $class_job_bm_emails->job_bm_email_templates_data();
    $job_bm_email_templates_data = get_option('job_bm_email_templates_data', $job_bm_email_templates_data_default);

    $application_data = get_post($application_id);

    $application_author_email = get_post_meta($application_id, 'job_bm_am_user_email', true);
    $job_id = get_post_meta($application_id, 'job_bm_am_job_id', true);
    $job_data = get_post($job_id);


    $vars = array(
        '{site_name}'=> $site_name,
        '{site_description}' => $site_description,
        '{site_url}' => $site_url,
        '{site_logo_url}' => $job_bm_logo_url,

        '{application_id}'  => $application_id,
        '{application_title}'  => $application_data->post_title,
        '{application_url}'  => get_permalink($application_id),
        '{application_edit_url}'  => get_admin_url().'post.php?post='.$application_id.'&action=edit',
        '{application_author_id}'  => $application_data->author_id,
        '{application_author_name}'  => $job_id,
        '{application_author_avatar}'  => get_avatar( $application_data->ID, 60 ),

        '{job_id}'  => $job_id,
        '{job_title}'  => $job_data->post_title,
        '{job_url}'  => get_permalink($job_id),
        '{job_edit_url}'  => get_admin_url().'post.php?post='.$job_id.'&action=edit',
        '{job_author_id}'  => $job_id,
        '{job_author_name}'  => $job_id,
        '{job_author_avatar}'  => get_avatar( $job_data->author_id, 60 ),
    );




    $enable = isset($job_bm_email_templates_data['application_hire']['enable']) ? $job_bm_email_templates_data['application_hire']['enable'] : 'no';
    $email_to = isset($job_bm_email_templates_data['application_hire']['email_to']) ? $job_bm_email_templates_data['application_hire']['email_to'] : '';
    $email_from_name = isset($job_bm_email_templates_data['application_hire']['email_from_name']) ? $job_bm_email_templates_data['application_hire']['email_from_name'] : '';
    $email_from = isset($job_bm_email_templates_data['application_hire']['email_from']) ? $job_bm_email_templates_data['application_hire']['email_from'] : '';
    $email_subject = isset($job_bm_email_templates_data['application_hire']['subject']) ? $job_bm_email_templates_data['application_hire']['subject'] : '';
    $email_html = isset($job_bm_email_templates_data['application_hire']['html']) ? $job_bm_email_templates_data['application_hire']['html'] : '';


    if($enable == 'yes'):

        $email_data['email_to'] =  $application_author_email;
        $email_data['email_bcc'] =  $email_to;
        $email_data['email_from'] = $email_from ;
        $email_data['email_from_name'] = $email_from_name;
        $email_data['subject'] = strtr($email_subject, $vars);
        $email_data['html'] = strtr($email_html, $vars);
        $email_data['attachments'] = array();


        $status = $class_job_bm_emails->job_bm_send_email($email_data);

    endif;


}

add_action('job_bm_application_hire', 'job_bm_application_hire_send_email', 99, 2);














function job_bm_application_post_comment_send_email($comment_id){

    $comment_data = get_comment($comment_id);
    $application_ID = $comment_data->comment_post_ID;
    $comment_author_email  = $comment_data->comment_author_email ;

    $job_id = get_post_meta($application_ID, 'job_bm_am_job_id', true);
    $job_contact_email = get_post_meta($job_id, 'job_bm_contact_email', true);


    $email_data = array();
    $class_job_bm_emails = new class_job_bm_emails();
    $job_bm_email_templates_data_default = $class_job_bm_emails->job_bm_email_templates_data();
    $job_bm_email_templates_data = get_option('job_bm_email_templates_data', $job_bm_email_templates_data_default);




    $enable = isset($job_bm_email_templates_data['application_new_comment']['enable']) ? $job_bm_email_templates_data['application_new_comment']['enable'] : 'no';
    $email_to = isset($job_bm_email_templates_data['application_new_comment']['email_to']) ? $job_bm_email_templates_data['application_new_comment']['email_to'] : '';

    $email_from_name = isset($job_bm_email_templates_data['application_new_comment']['email_from_name']) ? $job_bm_email_templates_data['application_new_comment']['email_from_name'] : '';
    $email_from = isset($job_bm_email_templates_data['application_new_comment']['email_from']) ? $job_bm_email_templates_data['application_new_comment']['email_from'] : '';
    $email_subject = isset($job_bm_email_templates_data['application_new_comment']['subject']) ? $job_bm_email_templates_data['application_new_comment']['subject'] : '';
    $email_html = isset($job_bm_email_templates_data['application_new_comment']['html']) ? $job_bm_email_templates_data['application_new_comment']['html'] : '';


    if($enable == 'yes'):

        $email_data['email_to'] =  $job_contact_email;
        $email_data['email_bcc'] =  $email_to;
        $email_data['email_from'] = $email_from ;
        $email_data['email_from_name'] = $email_from_name;
        $email_data['subject'] = $email_subject;
        $email_data['html'] = $email_html;
        $email_data['attachments'] = array();


        $status = $class_job_bm_emails->job_bm_send_email($email_data);

    endif;


}

add_action('job_bm_application_post_comment', 'job_bm_application_post_comment_send_email', 99);



function job_bm_application_rate_send_email($data_count, $application_id){

    $email_data = array();
    $class_job_bm_emails = new class_job_bm_emails();
    $job_bm_email_templates_data_default = $class_job_bm_emails->job_bm_email_templates_data();
    $job_bm_email_templates_data = get_option('job_bm_email_templates_data', $job_bm_email_templates_data_default);

    $application_author_email = get_post_meta($application_id, 'job_bm_am_user_email', true);

    $enable = isset($job_bm_email_templates_data['application_rate']['enable']) ? $job_bm_email_templates_data['application_rate']['enable'] : 'no';
    $email_to = isset($job_bm_email_templates_data['application_rate']['email_to']) ? $job_bm_email_templates_data['application_rate']['email_to'] : '';
    $email_from_name = isset($job_bm_email_templates_data['application_rate']['email_from_name']) ? $job_bm_email_templates_data['application_rate']['email_from_name'] : '';
    $email_from = isset($job_bm_email_templates_data['application_rate']['email_from']) ? $job_bm_email_templates_data['application_rate']['email_from'] : '';
    $email_subject = isset($job_bm_email_templates_data['application_rate']['subject']) ? $job_bm_email_templates_data['application_rate']['subject'] : '';
    $email_html = isset($job_bm_email_templates_data['application_rate']['html']) ? $job_bm_email_templates_data['application_rate']['html'] : '';


    if($enable == 'yes'):

        $email_data['email_to'] =  $application_author_email;
        $email_data['email_bcc'] =  $email_to;
        $email_data['email_from'] = $email_from ;
        $email_data['email_from_name'] = $email_from_name;
        $email_data['subject'] = $email_subject;
        $email_data['html'] = $email_html;
        $email_data['attachments'] = array();


        $status = $class_job_bm_emails->job_bm_send_email($email_data);

    endif;


}

add_action('job_bm_application_rate', 'job_bm_application_rate_send_email', 99, 2);



function job_bm_application_trash_send_email($status, $application_id){

    $email_data = array();
    $class_job_bm_emails = new class_job_bm_emails();
    $job_bm_email_templates_data_default = $class_job_bm_emails->job_bm_email_templates_data();
    $job_bm_email_templates_data = get_option('job_bm_email_templates_data', $job_bm_email_templates_data_default);

    $application_author_email = get_post_meta($application_id, 'job_bm_am_user_email', true);

    $enable = isset($job_bm_email_templates_data['application_trash']['enable']) ? $job_bm_email_templates_data['application_trash']['enable'] : 'no';
    $email_to = isset($job_bm_email_templates_data['application_trash']['email_to']) ? $job_bm_email_templates_data['application_trash']['email_to'] : '';
    $email_from_name = isset($job_bm_email_templates_data['application_trash']['email_from_name']) ? $job_bm_email_templates_data['application_trash']['email_from_name'] : '';
    $email_from = isset($job_bm_email_templates_data['application_trash']['email_from']) ? $job_bm_email_templates_data['application_trash']['email_from'] : '';
    $email_subject = isset($job_bm_email_templates_data['application_trash']['subject']) ? $job_bm_email_templates_data['application_trash']['subject'] : '';
    $email_html = isset($job_bm_email_templates_data['application_trash']['html']) ? $job_bm_email_templates_data['application_trash']['html'] : '';


    if($enable == 'yes'):

        $email_data['email_to'] =  $application_author_email;
        $email_data['email_bcc'] =  $email_to;
        $email_data['email_from'] = $email_from ;
        $email_data['email_from_name'] = $email_from_name;
        $email_data['subject'] = $email_subject;
        $email_data['html'] = $email_html;
        $email_data['attachments'] = array();


        $status = $class_job_bm_emails->job_bm_send_email($email_data);

    endif;


}

add_action('job_bm_application_trash', 'job_bm_application_trash_send_email', 99, 2);




function job_bm_job_edited_send_email($job_id, $post_data){

    $email_data = array();
    $class_job_bm_emails = new class_job_bm_emails();
    $job_bm_email_templates_data_default = $class_job_bm_emails->job_bm_email_templates_data();
    $job_bm_email_templates_data = get_option('job_bm_email_templates_data', $job_bm_email_templates_data_default);

    $job_bm_contact_email = get_post_meta($job_id, 'job_bm_contact_email', true);

    $enable = isset($job_bm_email_templates_data['job_edited']['enable']) ? $job_bm_email_templates_data['job_edited']['enable'] : 'no';
    $email_to = isset($job_bm_email_templates_data['job_edited']['email_to']) ? $job_bm_email_templates_data['job_edited']['email_to'] : '';
    $email_from_name = isset($job_bm_email_templates_data['job_edited']['email_from_name']) ? $job_bm_email_templates_data['job_edited']['email_from_name'] : '';
    $email_from = isset($job_bm_email_templates_data['job_edited']['email_from']) ? $job_bm_email_templates_data['job_edited']['email_from'] : '';
    $email_subject = isset($job_bm_email_templates_data['job_edited']['subject']) ? $job_bm_email_templates_data['job_edited']['subject'] : '';
    $email_html = isset($job_bm_email_templates_data['job_edited']['html']) ? $job_bm_email_templates_data['job_edited']['html'] : '';


    if($enable == 'yes'):

        $email_data['email_to'] =  $job_bm_contact_email;
        $email_data['email_bcc'] =  $email_to;
        $email_data['email_from'] = $email_from ;
        $email_data['email_from_name'] = $email_from_name;
        $email_data['subject'] = $email_subject;
        $email_data['html'] = $email_html;
        $email_data['attachments'] = array();


        $status = $class_job_bm_emails->job_bm_send_email($email_data);

    endif;


}

add_action('job_bm_job_edited', 'job_bm_job_edited_send_email', 99, 2);



function job_bm_job_submitted_send_email($job_id, $post_data){

    $email_data = array();
    $class_job_bm_emails = new class_job_bm_emails();
    $job_bm_email_templates_data_default = $class_job_bm_emails->job_bm_email_templates_data();
    $job_bm_email_templates_data = get_option('job_bm_email_templates_data', $job_bm_email_templates_data_default);

    $admin_email = get_option('admin_email');

    $enable = isset($job_bm_email_templates_data['job_submitted']['enable']) ? $job_bm_email_templates_data['job_submitted']['enable'] : 'no';
    $email_to = isset($job_bm_email_templates_data['job_submitted']['email_to']) ? $job_bm_email_templates_data['job_submitted']['email_to'] : '';
    $email_from_name = isset($job_bm_email_templates_data['job_submitted']['email_from_name']) ? $job_bm_email_templates_data['job_submitted']['email_from_name'] : '';
    $email_from = isset($job_bm_email_templates_data['job_submitted']['email_from']) ? $job_bm_email_templates_data['job_submitted']['email_from'] : '';
    $email_subject = isset($job_bm_email_templates_data['job_submitted']['subject']) ? $job_bm_email_templates_data['job_submitted']['subject'] : '';
    $email_html = isset($job_bm_email_templates_data['job_submitted']['html']) ? $job_bm_email_templates_data['job_submitted']['html'] : '';


    if($enable == 'yes'):

        $email_data['email_to'] =  $admin_email;
        $email_data['email_bcc'] =  $email_to;
        $email_data['email_from'] = $email_from ;
        $email_data['email_from_name'] = $email_from_name;
        $email_data['subject'] = $email_subject;
        $email_data['html'] = $email_html;
        $email_data['attachments'] = array();


        $status = $class_job_bm_emails->job_bm_send_email($email_data);

    endif;


}

add_action('job_bm_job_submitted', 'job_bm_job_submitted_send_email', 99, 2);



function job_bm_job_published_send_email($job_id){

    $job_bm_logo_url = get_option('job_bm_logo_url');
    $job_bm_logo_url = wp_get_attachment_url($job_bm_logo_url);
    $site_url = get_bloginfo('url');
    $site_description = get_bloginfo('description');
    $site_name = get_bloginfo('name');
    $job_data = get_post($job_id);


    $email_data = array();
    $class_job_bm_emails = new class_job_bm_emails();
    $job_bm_email_templates_data_default = $class_job_bm_emails->job_bm_email_templates_data();
    $job_bm_email_templates_data = get_option('job_bm_email_templates_data', $job_bm_email_templates_data_default);

    $job_bm_contact_email = get_post_meta($job_id, 'job_bm_contact_email', true);


    $vars = array(
        '{site_name}'=> $site_name,
        '{site_description}' => $site_description,
        '{site_url}' => $site_url,
        '{site_logo_url}' => $job_bm_logo_url,

        '{job_id}'  => $job_id,
        '{job_title}'  => $job_data->post_title,
        '{job_url}'  => get_permalink($job_id),
        '{job_edit_url}'  => get_admin_url().'post.php?post='.$job_id.'&action=edit',
        '{job_author_id}'  => $job_id,
        '{job_author_name}'  => $job_id,
        '{job_author_avatar}'  => get_avatar( $job_data->author_id, 60 ),
    );







    $enable = isset($job_bm_email_templates_data['job_submitted']['enable']) ? $job_bm_email_templates_data['job_submitted']['enable'] : 'no';
    $email_to = isset($job_bm_email_templates_data['job_submitted']['email_to']) ? $job_bm_email_templates_data['job_submitted']['email_to'] : '';
    $email_from_name = isset($job_bm_email_templates_data['job_submitted']['email_from_name']) ? $job_bm_email_templates_data['job_submitted']['email_from_name'] : '';
    $email_from = isset($job_bm_email_templates_data['job_submitted']['email_from']) ? $job_bm_email_templates_data['job_submitted']['email_from'] : '';
    $email_subject = isset($job_bm_email_templates_data['job_submitted']['subject']) ? $job_bm_email_templates_data['job_submitted']['subject'] : '';
    $email_html = isset($job_bm_email_templates_data['job_submitted']['html']) ? $job_bm_email_templates_data['job_submitted']['html'] : '';


    if($enable == 'yes'):

        $email_data['email_to'] =  $job_bm_contact_email;
        $email_data['email_bcc'] =  $email_to;
        $email_data['email_from'] = $email_from ;
        $email_data['email_from_name'] = $email_from_name;
        $email_data['subject'] = strtr($email_subject, $vars);
        $email_data['html'] = strtr($email_html, $vars);
        $email_data['attachments'] = array();


        $status = $class_job_bm_emails->job_bm_send_email($email_data);

    endif;


}

add_action(  'publish_job',  'job_bm_job_published_send_email');






function job_bm_job_featured_send_email($job_id){

    $job_bm_logo_url = get_option('job_bm_logo_url');
    $job_bm_logo_url = wp_get_attachment_url($job_bm_logo_url);
    $site_url = get_bloginfo('url');
    $site_description = get_bloginfo('description');
    $site_name = get_bloginfo('name');
    $job_data = get_post($job_id);

    $email_data = array();
    $class_job_bm_emails = new class_job_bm_emails();
    $job_bm_email_templates_data_default = $class_job_bm_emails->job_bm_email_templates_data();
    $job_bm_email_templates_data = get_option('job_bm_email_templates_data', $job_bm_email_templates_data_default);

    $job_bm_contact_email = get_post_meta($job_id, 'job_bm_contact_email', true);
    $job_bm_featured = get_post_meta($job_id, 'job_bm_featured', true);

    $vars = array(
        '{site_name}'=> $site_name,
        '{site_description}' => $site_description,
        '{site_url}' => $site_url,
        '{site_logo_url}' => $job_bm_logo_url,

        '{job_id}'  => $job_id,
        '{job_title}'  => $job_data->post_title,
        '{job_url}'  => get_permalink($job_id),
        '{job_edit_url}'  => get_admin_url().'post.php?post='.$job_id.'&action=edit',
        '{job_author_id}'  => $job_id,
        '{job_author_name}'  => $job_id,
        '{job_author_avatar}'  => get_avatar( $job_data->author_id, 60 ),
    );


    $enable = isset($job_bm_email_templates_data['job_featured']['enable']) ? $job_bm_email_templates_data['job_featured']['enable'] : 'no';
    $email_to = isset($job_bm_email_templates_data['job_featured']['email_to']) ? $job_bm_email_templates_data['job_featured']['email_to'] : '';
    $email_from_name = isset($job_bm_email_templates_data['job_featured']['email_from_name']) ? $job_bm_email_templates_data['job_featured']['email_from_name'] : '';
    $email_from = isset($job_bm_email_templates_data['job_featured']['email_from']) ? $job_bm_email_templates_data['job_featured']['email_from'] : '';
    $email_subject = isset($job_bm_email_templates_data['job_featured']['subject']) ? $job_bm_email_templates_data['job_featured']['subject'] : '';
    $email_html = isset($job_bm_email_templates_data['job_featured']['html']) ? $job_bm_email_templates_data['job_featured']['html'] : '';


    if($enable == 'yes' && $job_bm_featured == 'yes'):

        $email_data['email_to'] =  $job_bm_contact_email;
        $email_data['email_bcc'] =  $email_to;
        $email_data['email_from'] = $email_from ;
        $email_data['email_from_name'] = $email_from_name;
        $email_data['subject'] = strtr($email_subject, $vars);
        $email_data['html'] = strtr($email_html, $vars);
        $email_data['attachments'] = array();


        $status = $class_job_bm_emails->job_bm_send_email($email_data);

    endif;


}

add_action(  'publish_job',  'job_bm_job_featured_send_email');





















