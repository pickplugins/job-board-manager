<?php
if ( ! defined('ABSPATH')) exit;  // if direct access



function job_bmpost_type_template_job($content) {

	global $post;

	if ($post->post_type == 'job'){

		ob_start();
		include( job_bm_plugin_dir . 'templates/job-single/job-single.php');

        wp_enqueue_style('job_bm_job_single');
        wp_enqueue_style('font-awesome-5');
        wp_enqueue_script('jquery-ui-accordion');

		return ob_get_clean();
	}
	else{
		return $content;
	}

}
add_filter( 'the_content', 'job_bmpost_type_template_job' );











add_action( 'job_bm_single_job_main', 'job_bm_single_job_main_preview', 5 );
if ( ! function_exists( 'job_bm_single_job_main_preview' ) ) {
    function job_bm_single_job_main_preview(){

        if(is_preview()):
            ?>
            <div class="job-preview-notice"><?php echo __('This is preview of your job, please do not share link.','job-board-manager'); ?></div>
        <?php
        endif;

    }
}




add_action( 'job_bm_single_job_main', 'job_bm_single_job_main_meta_start', 10 );
if ( ! function_exists( 'job_bm_single_job_main_meta_start' ) ) {
    function job_bm_single_job_main_meta_start() {

        $post_id = get_the_id();

        $job_bm_location = get_post_meta($post_id, 'job_bm_location', true);
        $job_bm_featured = get_post_meta($post_id, 'job_bm_featured', true);
        $post_date = get_the_date();
        $post_id = get_the_id();
        $category = get_the_terms($post_id, 'job_category');
        ?>
        <div class="job-meta-top">

            <?php if($job_bm_featured =='yes'):?>
                <span class=" meta-item featured"><i class="far fa-star"></i>  <?php echo __('Featured','job-board-manager'); ?></span>
            <?php endif; ?>

            <span class="job-location meta-item"><i class="fas fa-map-marker-alt"></i>  <?php echo $job_bm_location; ?></span>

            <span class="job-post-date meta-item"><i class="far fa-calendar-alt"></i> <?php echo sprintf(__('Posted %s ago','job-board-manager'), human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) )?></span>

            <?php

            if(!empty($category[0]->name)):
                ?>

                <span class="job-category meta-item"><i class="fas fa-code-branch"></i> <?php echo sprintf(__('Posted on %s','job-board-manager'), '<a href="#">'.$category[0]->name.'</a>' )?></span>

            <?php
            endif;

            ?>


        </div>
        <?php


    }
}



add_action( 'job_bm_single_job_main', 'job_bm_template_single_job_description', 20 );

if ( ! function_exists( 'job_bm_template_single_job_description' ) ) {
	function job_bm_template_single_job_description() {

	    ?>
        <div class="single-job-details">
            <div itemprop="description" class="description"><?php echo wpautop(do_shortcode(get_the_content(get_the_id()))); ?></div>
        </div>
        <?php


	}
}





add_action( 'job_bm_single_job_main', 'job_bm_single_job_main_company', 20 );
if ( ! function_exists( 'job_bm_single_job_main_company' ) ) {
    function job_bm_single_job_main_company() {





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

        ?>
        <div class="job-meta-company">
            <h2><?php echo __('About Company','job-board-manager'); ?></h2>
            <div class="company-logo">
                <img src="<?php echo $job_bm_company_logo; ?>">
            </div>

            <?php if($job_bm_company_name):?>
            <div class="company-name"><?php echo $job_bm_company_name; ?></div>
            <?php endif; ?>

            <?php if($job_bm_address):?>
            <div class="company-address"><i class="fas fa-map-marked-alt"></i> <?php echo $job_bm_address; ?></div>
            <?php endif; ?>


            <?php if($job_bm_company_website):?>
            <div class="company-website"><i class="fas fa-link"></i> <a href="<?php echo $job_bm_company_website; ?>">Website</a> </div>
            <?php endif; ?>


        </div>
        <div class="clear"></div>
        <?php


    }
}






add_action( 'job_bm_single_job_main', 'job_bm_single_job_main_job_info', 30 );
if ( ! function_exists( 'job_bm_single_job_main_job_info' ) ) {
    function job_bm_single_job_main_job_info() {


        $class_job_bm_functions = new class_job_bm_functions();
        $salary_currency = get_option( 'job_bm_salary_currency');


        $salary_type_list = $class_job_bm_functions->salary_type_list();
        $job_status_list = $class_job_bm_functions->job_status_list();
        $job_type_list = $class_job_bm_functions->job_type_list();
        $job_level_list = $class_job_bm_functions->job_level_list();


        $post_id = get_the_id();

        $job_bm_total_vacancies = get_post_meta($post_id, 'job_bm_total_vacancies', true);
        $job_bm_job_level = get_post_meta($post_id, 'job_bm_job_level', true);
        $job_bm_job_type = get_post_meta($post_id, 'job_bm_job_type', true);
        $job_bm_years_experience = get_post_meta($post_id, 'job_bm_years_experience', true);
        $job_bm_salary_type = get_post_meta($post_id, 'job_bm_salary_type', true);

        $job_bm_salary_fixed = get_post_meta($post_id, 'job_bm_salary_fixed', true);
        $job_bm_salary_min = get_post_meta($post_id, 'job_bm_salary_min', true);
        $job_bm_salary_max = get_post_meta($post_id, 'job_bm_salary_max', true);

        $job_bm_salary_currency = get_post_meta($post_id, 'job_bm_salary_currency', true);
        $job_bm_job_status = get_post_meta($post_id, 'job_bm_job_status', true);


        $job_bm_salary_currency = !empty($job_bm_salary_currency) ? $job_bm_salary_currency : $salary_currency;

        $post_date = get_the_date();
        $post_id = get_the_id();
        $category = get_the_terms($post_id, 'job_category');
        ?>
        <div class="job-meta-info">
            <h2><?php echo __('Job Information','job-board-manager'); ?></h2>

            <?php if(isset($job_status_list[$job_bm_job_status])):?>
            <span class=" meta-item"><?php echo sprintf(__('%s Status: %s','job-board-manager'),'<i class="fas 
            fa-traffic-light"></i>', $job_status_list[$job_bm_job_status])?></span>
            <?php endif; ?>

            <?php if($job_bm_total_vacancies):?>
                <span class=" meta-item"><?php echo sprintf(__('%s No of vacancies: %s','job-board-manager'),'<i class="fas fa-user-friends"></i>', $job_bm_total_vacancies)?></span>
            <?php endif; ?>

            <?php if(isset($job_type_list[$job_bm_job_type])):?>
                <span class=" meta-item"><?php echo sprintf(__('%s Job type: %s','job-board-manager'),'<i class="fas fa-user-friends"></i>', $job_type_list[$job_bm_job_type])?></span>
            <?php endif; ?>

            <?php if(isset($job_level_list[$job_bm_job_level])):?>
                <span class=" meta-item"><?php echo sprintf(__('%s Job level: %s','job-board-manager'),'<i class="fas fa-users"></i>', $job_level_list[$job_bm_job_level])?></span>
            <?php endif; ?>

            <?php if($job_bm_years_experience):?>
                <span class=" meta-item"><?php echo sprintf(__('%s Years of experience: %s',
                        'job-board-manager'),'<i class="fas fa-crosshairs"></i>', $job_bm_years_experience)?></span>
            <?php endif; ?>

            <?php
            if($job_bm_salary_type == 'fixed'):
                $salary_html = $job_bm_salary_currency.$job_bm_salary_fixed;
            elseif($job_bm_salary_type == 'negotiable'):
                $salary_html = __('Negotiable', 'job-board-manager');
            elseif($job_bm_salary_type == 'min-max'):
                $salary_html = $job_bm_salary_currency.$job_bm_salary_min.' - '.$job_bm_salary_currency.$job_bm_salary_max;

            endif;

            ?>

            <?php if($job_bm_salary_fixed):?>
                <span class=" meta-item"><?php echo sprintf(__('%s Salary: %s','job-board-manager'),'<i class="fas fa-pizza-slice"></i>', $salary_html)?></span>
            <?php endif; ?>



        </div>
        <?php


    }
}





add_action( 'job_bm_single_job_main', 'job_bm_single_job_main_job_apply', 30 );
if ( ! function_exists( 'job_bm_single_job_main_job_apply' ) ) {
    function job_bm_single_job_main_job_apply() {

        $class_job_bm_functions = new class_job_bm_functions();

        $sections = array();
        $job_post_data = get_post(get_the_ID());
        $job_bm_contact_email = get_post_meta(get_the_ID(), 'job_bm_contact_email', true);
        $job_bm_job_status = get_post_meta(get_the_ID(), 'job_bm_job_status', true);
        $job_bm_apply_methods = get_option('job_bm_apply_method', array('direct_email'));


        $job_id = get_the_id();

        ?>
        <div class="job-apply">
            <h2><?php echo __('Apply for job','job-board-manager'); ?></h2>


            <div class="apply-methods">

                <?php

                $apply_method_list = $class_job_bm_functions->apply_method_list();



                if(!empty($job_bm_apply_methods)):
                    foreach ($job_bm_apply_methods as $method):

                        //echo '<pre>'.var_export($method, true).'</pre>';



                        $method_name = isset($apply_method_list[$method]) ? $apply_method_list[$method] : '';

                        ?>
                        <div class="method-header"><div class="method-name"><?php echo $method_name; ?></div></div>
                        <div class="method-form">

                            <?php
                            do_action('job_bm_apply_method_'.$method, $job_id);
                            ?>

                        </div>
                        <?php



                    endforeach;
                endif;


                ?>


            </div>




        </div>

        <script>
            jQuery( function($) {
                $( ".apply-methods" ).accordion({
                    active: 99999,
                    collapsible: true,
                    icons : false,
                });
            } );
        </script>


        <div class="clear"></div>
        <?php


    }
}





add_action('job_bm_apply_method_direct_email','job_bm_apply_method_direct_email');

function job_bm_apply_method_direct_email($job_id){

    ?>
    <form method="post" action="#" class="apply-method-form">

        <div class="form-field-wrap">
            <div class="field-title">Your name</div>
            <div class="field-input">
                <input placeholder="" type="text" value="" name="application_name">
                <p class="field-details">Write your name</p>
            </div>
        </div>

        <div class="form-field-wrap">
            <div class="field-title">Your email</div>
            <div class="field-input">
                <input placeholder="" type="text" value="" name="application_email">
                <p class="field-details">Write your name</p>
            </div>
        </div>



        <div class="form-field-wrap">
            <div class="field-title"></div>
            <div class="field-input">
                <input placeholder="" type="submit"  name="Submit">
                <p class="field-details">Write your name</p>
            </div>
        </div>



    </form>
    <?php

}


add_action('job_bm_apply_method_saved_cv','job_bm_apply_method_saved_cv');

function job_bm_apply_method_saved_cv($job_id){

    ?>
    <form method="post" action="#" class="apply-method-form">

        <div class="form-field-wrap">
            <div class="field-title">Your name</div>
            <div class="field-input">
                <input placeholder="" type="text" value="" name="application_name">
                <p class="field-details">Write your name</p>
            </div>
        </div>

        <div class="form-field-wrap">
            <div class="field-title">Your email</div>
            <div class="field-input">
                <input placeholder="" type="text" value="" name="application_email">
                <p class="field-details">Write your name</p>
            </div>
        </div>



        <div class="form-field-wrap">
            <div class="field-title"></div>
            <div class="field-input">
                <input placeholder="" type="submit"  name="Submit">
                <p class="field-details">Write your name</p>
            </div>
        </div>



    </form>
    <?php

}



add_action('job_bm_apply_method_upload_cv','job_bm_apply_method_upload_cv');

function job_bm_apply_method_upload_cv($job_id){

    ?>
    <form method="post" action="#" class="apply-method-form">

        <div class="form-field-wrap">
            <div class="field-title">Your name</div>
            <div class="field-input">
                <input placeholder="" type="text" value="" name="application_name">
                <p class="field-details">Write your name</p>
            </div>
        </div>

        <div class="form-field-wrap">
            <div class="field-title">Your email</div>
            <div class="field-input">
                <input placeholder="" type="text" value="" name="application_email">
                <p class="field-details">Write your name</p>
            </div>
        </div>



        <div class="form-field-wrap">
            <div class="field-title"></div>
            <div class="field-input">
                <input placeholder="" type="submit"  name="Submit">
                <p class="field-details">Write your name</p>
            </div>
        </div>



    </form>
    <?php

}















//add_action( 'job_bm_single_job_main', 'job_bm_template_single_job_css', 20 );

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