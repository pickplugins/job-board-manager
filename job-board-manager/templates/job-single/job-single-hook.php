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
        $job_bm_login_required_on_apply = get_option('job_bm_login_required_on_apply', 'yes');
        $job_bm_job_login_page_id = get_option('job_bm_job_login_page_id');
        $job_bm_job_login_page_url = get_permalink($job_bm_job_login_page_id);


        $job_id = get_the_id();


        $application_method_id = isset($_POST['application_method']) ? sanitize_text_field($_POST['application_method']) : '';

        //var_dump($application_method_id);

        ?>
        <div class="job-apply">
            <h2><?php echo __('Apply for job','job-board-manager'); ?></h2>


            <div class="apply-methods">

                <?php

                $apply_method_list = $class_job_bm_functions->apply_method_list();



                if(!empty($job_bm_apply_methods)):

                    $active_id = 9999;
                    $i = 0;
                    foreach ($job_bm_apply_methods as $method):



                        if(($application_method_id == $method)){
                            $active_id = $i;
                        }

                        $method_name = isset($apply_method_list[$method]) ? $apply_method_list[$method] : '';

                        //echo '<pre>'.var_export($active_id, true).'</pre>';

                        ?>
                        <div class="method-header <?php //echo $header_active_class; ?>"><div class="method-name"><?php echo $method_name; ?></div></div>
                        <div class="method-form ">

                            <?php

                            if(!is_user_logged_in() && $job_bm_login_required_on_apply =='yes'){

                                $login_required = apply_filters('job_bm_application_login_required_text', sprintf(__('Please <a href="%s">login</a> to submit application','job-board-manager'), $job_bm_job_login_page_url));
                                echo $login_required;

                            }else{
                                do_action('job_bm_apply_method_form_'.$method, $job_id);
                            }



                            ?>

                        </div>
                        <?php


                        $i++;
                    endforeach;
                endif;


                ?>


            </div>




        </div>

        <script>
            jQuery( function($) {
                $( ".apply-methods" ).accordion({
                    active: <?php echo $active_id; ?>,
                    collapsible: true,
                    icons : false,
                });
            } );
        </script>


        <div class="clear"></div>
        <?php


    }
}





add_action('job_bm_apply_method_form_direct_email','job_bm_apply_method_form_direct_email');

function job_bm_apply_method_form_direct_email($job_id){

    $job_bm_apply_enable_recaptcha		= get_option('job_bm_apply_enable_recaptcha');
    $job_bm_reCAPTCHA_site_key		        = get_option('job_bm_reCAPTCHA_site_key');
    if ( is_user_logged_in() ) {
        $user_id = get_current_user_id();
    } else {
        $user_id = 0;
    }

    $class_job_bm_applications = new class_job_bm_applications();

    if(!empty($_POST)){

        //var_dump($_POST);


        $error = new WP_Error();

        if(empty($_POST['applicant_name'])){

            $error->add( 'applicant_name', __( '<strong>ERROR</strong>: Applicant name is empty.', 'job-board-manager' ) );
        }

        if(empty($_POST['application_email'])){

            $error->add( 'application_email', __( '<strong>ERROR</strong>: Email is empty.', 'job-board-manager' ) );
        }

        if(!is_email($_POST['application_email'])){

            $error->add( 'application_email', __( '<strong>ERROR</strong>: '.sanitize_email($_POST['application_email']).' is not valid email address.', 'job-board-manager' ) );
        }



        if($job_bm_apply_enable_recaptcha == 'yes' && empty($_POST['g-recaptcha-response'])){

            $error->add( 'recaptcha', __( '<strong>ERROR</strong>: reCaptcha test failed', 'job-board-manager' ) );
        }

        $errors = apply_filters( 'job_bm_application_submit_errors', $error, $_POST );


        if ( !$error->has_errors() ) {

            $applicant_name = isset($_POST['applicant_name']) ? sanitize_text_field($_POST['applicant_name']) : "";
            $email = isset($_POST['application_email']) ? sanitize_text_field($_POST['application_email']) : "";
            $post_content = isset($_POST['applicant_name']) ? sanitize_text_field($_POST['applicant_name']) : "";
            $application_method = isset($_POST['application_method']) ? sanitize_text_field($_POST['application_method']) : "";


            $has_applied = $class_job_bm_applications->has_applied($job_id, $email);

            //var_dump($has_applied);


            if(!$has_applied){
                $application_ID = wp_insert_post(
                    array(
                        'post_title'    => '',
                        'post_content'  => $post_content,
                        'post_status'   => 'publish',
                        'post_type'   	=> 'application',
                        'post_author'   => $user_id,
                    )
                );

                update_post_meta($application_ID, 'job_bm_am_user_email', $email);
                update_post_meta($application_ID, 'job_bm_am_job_id', $job_id);
                update_post_meta($application_ID, 'job_bm_am_apply_method', $application_method);



                do_action('job_bm_application_submitted', $application_ID, $_POST);

                ?>
                <div class="success">Your application has sent.</div>
                <?php

            }else{
                ?>
                <div class="errors">
                    <div class="job-bm-error">You already applied.</div>
                </div>

                <?php
            }









        }
        else{

            $error_messages = $error->get_error_messages();

            ?>
            <div class="errors">
                <?php

                if(!empty($error_messages))
                    foreach ($error_messages as $message){
                        ?>
                        <div class="job-bm-error"><?php echo $message; ?></div>
                        <?php
                    }
                ?>
            </div>
            <?php
        }

    }


    $applicant_name = isset($_POST['applicant_name']) ? sanitize_text_field($_POST['applicant_name']) : "";
    $email = isset($_POST['application_email']) ? sanitize_text_field($_POST['application_email']) : "";


    ?>
    <form method="post" action="#" class="apply-method-form">

        <input type="hidden" name="application_method" value="direct_email">

        <div class="form-field-wrap">
            <div class="field-title">Your name</div>
            <div class="field-input">
                <input placeholder="" type="text" value="<?php echo $applicant_name; ?>" name="applicant_name">
                <p class="field-details">Write your name</p>
            </div>
        </div>

        <div class="form-field-wrap">
            <div class="field-title">Your email</div>
            <div class="field-input">
                <input placeholder="" type="text" value="<?php echo $email; ?>" name="application_email">
                <p class="field-details">Write your name</p>
            </div>
        </div>

        <?php
        if($job_bm_apply_enable_recaptcha == 'yes'):
            ?>
            <div class="form-field-wrap">
                <div class="field-title"></div>
                <div class="field-input">
                    <div class="g-recaptcha" data-sitekey="<?php echo $job_bm_reCAPTCHA_site_key; ?>"></div>
                    <script src="https://www.google.com/recaptcha/api.js"></script>
                    <p class="field-details"><?php esc_html_e('Please prove you are human.','job-board-manager'); ?></p>

                </div>
            </div>
            <?php
        endif;
        ?>



        <?php wp_nonce_field( 'job_bm_application_nonce','job_bm_application_nonce' ); ?>

        <div class="form-field-wrap">
            <div class="field-title"></div>
            <div class="field-input">
                <input placeholder="" type="submit"  name="Submit">
                <p class="field-details"></p>
            </div>
        </div>




    </form>
    <?php

}


add_action('job_bm_apply_method_form_saved_cv','job_bm_apply_method_form_saved_cv');

function job_bm_apply_method_form_saved_cv($job_id){

    ?>
    <form method="post" action="#" class="apply-method-form">

        <input type="hidden" name="application_method" value="saved_cv">


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



add_action('job_bm_apply_method_form_upload_cv','job_bm_apply_method_form_upload_cv');

function job_bm_apply_method_form_upload_cv($job_id){

    ?>
    <form method="post" action="#" class="apply-method-form">

        <input type="hidden" name="application_method" value="upload_cv">


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