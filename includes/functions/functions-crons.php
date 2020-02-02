<?php
if ( ! defined('ABSPATH')) exit;  // if direct access

function job_bm_expired_check_plugin() {

    $active_plugins = get_option('active_plugins');

    $class = 'notice notice-error';
    $message = __( 'This plugin <b style="text-decoration: underline">Job Board Manager - Expired check</b> no longer need, please deactivate. functionality added <b style="text-decoration: underline">Job Board Manager</b> itself.', 'sample-text-domain' );

    if(in_array( 'job-board-manager-expired-check/job-board-manager-expired-check.php', (array) $active_plugins ) ){
        printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), ( $message ) );
    }



}
add_action( 'admin_notices', 'job_bm_expired_check_plugin' );



add_action('job_bm_cron_expired_check', 'job_bm_cron_daily_expired_check');

if(!function_exists('job_bm_cron_daily_expired_check')):
function job_bm_cron_daily_expired_check() {

    global $wpdb;

    $experied_jobs_status 	= get_option(  'job_bm_experied_jobs_post_status');
    $experied_jobs_status 	= empty( $experied_jobs_status ) ? 'publish' : $experied_jobs_status;
    $job_expiry_days 		= get_option(  'job_bm_job_expiry_days');
    $job_expiry_days 		= empty( $job_expiry_days ) ? '30' : $job_expiry_days;

    $experied_jobs = get_posts( array(
        'posts_per_page' => 100,
        'post_type' => 'job',
        'meta_query' => array(
            array(
                'key' => 'job_bm_job_status',
                'value' => 'expired',
                'compare' => '!=',
            ),
            array(
                'key' => 'job_bm_expire_date',
                'value' => date('Y-m-d'),
                'compare' => '<',
                'type' => 'DATE',
            ),
        ),
    ) );

    foreach( $experied_jobs as $job ){

        update_post_meta( $job->ID, "job_bm_job_status", "expired" );
        $wpdb->update( $wpdb->posts, array( "post_status" => $experied_jobs_status ), array( 'ID' => $job->ID ) );
    }
}

endif;