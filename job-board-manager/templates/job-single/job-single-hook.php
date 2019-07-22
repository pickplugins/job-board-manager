<?php
if ( ! defined('ABSPATH')) exit;  // if direct access



function job_bmpost_type_template_job($content) {

	global $post;

	if ($post->post_type == 'job'){

		ob_start();
		include( job_bm_plugin_dir . 'templates/job-single/job-single.php');

        wp_enqueue_style('job_bm_job_single');
        wp_enqueue_style('font-awesome-5');

		return ob_get_clean();
	}
	else{
		return $content;
	}

}
add_filter( 'the_content', 'job_bmpost_type_template_job' );








add_action( 'job_bm_action_single_job_main', 'job_bm_single_job_main_meta_start', 10 );
if ( ! function_exists( 'job_bm_single_job_main_meta_start' ) ) {
    function job_bm_single_job_main_meta_start() {

        ?>
        <div class="job-meta-top">
            <?php

            do_action('job_bm_single_job_meta_top');

            ?>
        </div>
        <?php


    }
}








add_action( 'job_bm_single_job_meta_top', 'job_bm_single_job_meta_top_location', 20 );

if ( ! function_exists( 'job_bm_single_job_meta_top_location' ) ) {
    function job_bm_single_job_meta_top_location() {

        $post_id = get_the_id();

        $job_bm_location = get_post_meta($post_id, 'job_bm_location', true);

        ?>

        <span class="post-date meta-item"><i class="fas fa-map-marker-alt"></i>  <?php echo $job_bm_location; ?></span>

        <?php


    }
}




add_action( 'job_bm_single_job_meta_top', 'job_bm_single_job_meta_top_post_date', 20 );

if ( ! function_exists( 'job_bm_single_job_meta_top_post_date' ) ) {
    function job_bm_single_job_meta_top_post_date() {

        $post_date = get_the_date();

        ?>

        <span class="post-date meta-item"><i class="far fa-calendar-alt"></i> <?php echo sprintf(__('Posted %s ago','job-board-manager'), human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) )?></span>

        <?php


    }
}


add_action( 'job_bm_single_job_meta_top', 'job_bm_single_job_meta_top_category', 20 );

if ( ! function_exists( 'job_bm_single_job_meta_top_category' ) ) {
    function job_bm_single_job_meta_top_category() {

        $post_id = get_the_id();
        $category = get_the_terms($post_id, 'job_category');

        if(!empty($category[0]->name)):
            ?>

            <span class="post-date meta-item"><i class="fas fa-code-branch"></i> <?php echo sprintf(__('Posted on %s','job-board-manager'), '<a href="#">'.$category[0]->name.'</a>' )?></span>

        <?php
        endif;




    }
}






add_action( 'job_bm_action_single_job_main', 'job_bm_template_single_job_description', 20 );

if ( ! function_exists( 'job_bm_template_single_job_description' ) ) {
	function job_bm_template_single_job_description() {

	    ?>
        <div class="single-job-details">
            <div itemprop="description" class="description"><?php echo wpautop(do_shortcode(get_the_content(get_the_id()))); ?></div>
        </div>
        <?php


	}
}





add_action( 'job_bm_action_single_job_main', 'job_bm_single_job_main_company', 300 );
if ( ! function_exists( 'job_bm_single_job_main_company' ) ) {
    function job_bm_single_job_main_company() {

        ?>
        <div class="job-meta-company">
            <?php

            do_action('job_bm_single_job_company');

            ?>
        </div>
        <?php


    }
}



add_action( 'job_bm_single_job_company', 'job_bm_single_job_company_title', 20 );

if ( ! function_exists( 'job_bm_single_job_company_title' ) ) {
    function job_bm_single_job_company_title() {

        ?>

        <h2>About Company</h2>

        <?php


    }
}


add_action( 'job_bm_single_job_company', 'job_bm_single_job_company_logo', 20 );

if ( ! function_exists( 'job_bm_single_job_company_logo' ) ) {
    function job_bm_single_job_company_logo() {

        $job_bm_address = get_post_meta(get_the_ID(), 'job_bm_address', true);
        $job_bm_company_name = get_post_meta(get_the_ID(), 'job_bm_company_name', true);
        $job_bm_company_logo = get_post_meta(get_the_ID(), 'job_bm_company_logo', true);
        $job_bm_company_website = get_post_meta(get_the_ID(), 'job_bm_company_website', true);


        $job_bm_default_company_logo = get_option('job_bm_default_company_logo');
        if(!empty($job_bm_company_logo)){

            if(is_serialized($job_bm_company_logo)){

                $job_bm_company_logo = unserialize($job_bm_company_logo);
                if(!empty($job_bm_company_logo[0])){
                    $job_bm_company_logo = $job_bm_company_logo[0];
                    $job_bm_company_logo = wp_get_attachment_url($job_bm_company_logo);
                }
                else{
                    $job_bm_company_logo = $job_bm_default_company_logo;
                }
            }

        }
        else{
            $job_bm_company_logo = $job_bm_default_company_logo;
        }


        //var_dump($job_bm_company_logo);

        ?>

        <div class="company-logo">
            <img src="<?php echo $job_bm_company_logo; ?>">
        </div>

        <div class="company-name"><?php echo $job_bm_company_name; ?></div>
        <div class="company-address"><i class="fas fa-map-marked-alt"></i> <?php echo $job_bm_address; ?></div>
        <div class="company-website"><i class="fas fa-link"></i> <a href="<?php echo $job_bm_company_website; ?>">Website</a> </div>
        <?php


    }
}



//add_action( 'job_bm_action_single_job_main', 'job_bm_template_single_job_sidebar', 20 );
if ( ! function_exists( 'job_bm_template_single_job_sidebar' ) ) {
	function job_bm_template_single_job_sidebar() {
		include( job_bm_plugin_dir. 'templates/job-single/job-single-sidebar.php');
	}
}


add_action( 'job_bm_action_single_job_main', 'job_bm_template_single_job_css', 20 );

if ( ! function_exists( 'job_bm_template_single_job_css' ) ) {
	function job_bm_template_single_job_css() {

        $job_bm_job_type_bg_color = get_option('job_bm_job_type_bg_color');
        $job_bm_job_status_bg_color = get_option('job_bm_job_status_bg_color');

        echo '<style type="text/css">';

        if(!empty($job_bm_job_type_bg_color)){
            foreach($job_bm_job_type_bg_color as $job_type_key=>$job_type_color){

                echo '.job-single .job_type.'.$job_type_key.'{background:'.$job_type_color.'}';
            }
        }

        if(!empty($job_bm_job_status_bg_color)){
            foreach($job_bm_job_status_bg_color as $job_status_key=>$job_status_color){

                echo '.job-single .job_status.'.$job_status_key.'{background:'.$job_status_color.'}';
            }
        }
        echo '</style>';

	}
}