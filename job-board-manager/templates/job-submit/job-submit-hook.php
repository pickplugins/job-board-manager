<?php
if ( ! defined('ABSPATH')) exit;  // if direct access 


/* Display question title field */

add_action('job_bm_job_submit_form', 'job_bm_job_submit_form_title', 0);

function job_bm_job_submit_form_title(){

    $post_title = isset($_POST['post_title']) ? sanitize_text_field($_POST['post_title']) : "";

    ?>
    <div class="form-field-wrap">
        <div class="field-title"><?php esc_html_e('Job title','job-board-manager'); ?></div>
        <div class="field-input">
            <input placeholder="" type="text" value="<?php echo $post_title; ?>" name="post_title">
            <p class="field-details"><?php esc_html_e('Write your job title','job-board-manager');
            ?></p>
        </div>
    </div>
    <?php
}


/* Display question details input field*/

add_action('job_bm_job_submit_form', 'job_bm_job_submit_form_content', 10);

function job_bm_job_submit_form_content(){

    $field_id = 'post_content';
    $allowed_html = apply_filters('job_bm_job_submit_allowed_html_tags', array());
    $post_content = isset($_POST['post_content']) ? wp_kses($_POST['post_content'], $allowed_html) : "";


    ?>
    <div class="form-field-wrap">
        <div class="field-title"><?php esc_html_e('Job description','job-board-manager'); ?></div>
        <div class="field-input">
            <?php
            ob_start();
            wp_editor( $post_content, $field_id, $settings = array('textarea_name'=>$field_id,
                'media_buttons'=>false,'wpautop'=>true,'editor_height'=>'200px', ) );
            echo ob_get_clean();

            ?>

            <p class="field-details"><?php esc_html_e('Write your job details.','job-board-manager'); ?></p>

        </div>
    </div>
    <?php
}




/* Display category input field  */

add_action('job_bm_job_submit_form', 'job_bm_job_submit_form_categories', 20);

function job_bm_job_submit_form_categories(){

    $job_category = isset($_POST['job_category']) ? sanitize_text_field($_POST['job_category']) : "";

    $categories = get_terms( array(
        'taxonomy' => 'job_category',
        'hide_empty' => false,
    ) );

    $terms = array();

    //var_dump($categories);



    if(!empty($categories)) {
        foreach ($categories as $category) {

            $name = $category->name;
            $cat_ID = $category->term_id;
            $terms[$cat_ID] = $name;
        }
    }

    ?>
    <div class="form-field-wrap">
        <div class="field-title"><?php esc_html_e('Job category','job-board-manager'); ?></div>
        <div class="field-input">
            <select name="job_category" >
                <?php
                if(!empty($terms)):
                    foreach ($terms as $term_id => $term_name){

                        $selected = ($job_category == $term_id) ? 'selected' : '';

                        ?>
                        <option <?php echo $selected; ?> value="<?php echo esc_attr($term_id); ?>"><?php echo esc_html
                            ($term_name); ?></option>
                        <?php
                    }
                endif;
                ?>
            </select>
            <p class="field-details"><?php esc_html_e('Select question category.','job-board-manager'); ?></p>

        </div>
    </div>
    <?php
}






add_action('job_bm_job_submit_form', 'job_bm_job_submit_form_job_info_title', 30);


function job_bm_job_submit_form_job_info_title(){


    ?>
    <div class="form-field-wrap ">
        <div class="field-separator"><?php echo __('Job Information','job-board-manager'); ?></div>
    </div>
    <?php
}











/* Display vacancies input field  */

add_action('job_bm_job_submit_form', 'job_bm_job_submit_form_total_vacancies', 30);


function job_bm_job_submit_form_total_vacancies(){

    $job_bm_total_vacancies = isset($_POST['job_bm_total_vacancies']) ? sanitize_text_field($_POST['job_bm_total_vacancies']) : "";

    ?>
    <div class="form-field-wrap">
        <div class="field-title"><?php esc_html_e('Total vacancies','job-board-manager'); ?></div>
        <div class="field-input">
            <input placeholder="3" type="text" value="<?php echo $job_bm_total_vacancies; ?>" name="job_bm_total_vacancies">
            <p class="field-details"><?php esc_html_e('Total number of vacancies','job-board-manager');
                ?></p>
        </div>
    </div>
    <?php
}



/* Display job_type input field  */

add_action('job_bm_job_submit_form', 'job_bm_job_submit_form_job_type', 30);

function job_bm_job_submit_form_job_type(){

    $class_job_bm_functions = new class_job_bm_functions();
    $job_type_list = $class_job_bm_functions->job_type_list();

    $job_bm_job_type = isset($_POST['job_bm_job_type']) ? sanitize_text_field($_POST['job_bm_job_type']) : "";


    ?>
    <div class="form-field-wrap">
        <div class="field-title"><?php esc_html_e('Job type','job-board-manager'); ?></div>
        <div class="field-input">
            <select name="job_bm_job_type" >
                <?php
                if(!empty($job_type_list)):
                    foreach ($job_type_list as $job_type => $job_type_name){

                        $selected = ($job_bm_job_type == $job_type) ? 'selected' : '';

                        ?>
                        <option <?php echo $selected; ?> value="<?php echo esc_attr($job_type); ?>"><?php echo esc_html
                            ($job_type_name); ?></option>
                        <?php
                    }
                endif;
                ?>
            </select>
            <p class="field-details"><?php esc_html_e('Select job type.','job-board-manager'); ?></p>

        </div>
    </div>
    <?php
}



/* Display job_type input field  */

add_action('job_bm_job_submit_form', 'job_bm_job_submit_form_job_level', 30);

function job_bm_job_submit_form_job_level(){

    $class_job_bm_functions = new class_job_bm_functions();
    $job_level_list = $class_job_bm_functions->job_level_list();

    $job_bm_job_level = isset($_POST['job_bm_job_level']) ? sanitize_text_field($_POST['job_bm_job_level']) : "";


    ?>
    <div class="form-field-wrap">
        <div class="field-title"><?php esc_html_e('Job level','job-board-manager'); ?></div>
        <div class="field-input">
            <select name="job_bm_job_level" >
                <?php
                if(!empty($job_level_list)):
                    foreach ($job_level_list as $job_level => $job_level_name){

                        $selected = ($job_bm_job_level == $job_level) ? 'selected' : '';

                        ?>
                        <option <?php echo $selected; ?> value="<?php echo esc_attr($job_level); ?>"><?php echo esc_html
                            ($job_level_name); ?></option>
                        <?php
                    }
                endif;
                ?>
            </select>
            <p class="field-details"><?php esc_html_e('Select job level.','job-board-manager'); ?></p>

        </div>
    </div>
    <?php
}





/* Display years_experience input field  */

add_action('job_bm_job_submit_form', 'job_bm_job_submit_form_years_experience', 30);

function job_bm_job_submit_form_years_experience(){

    $job_bm_years_experience = isset($_POST['job_bm_years_experience']) ? sanitize_text_field($_POST['job_bm_years_experience']) : "";

    ?>
    <div class="form-field-wrap">
        <div class="field-title"><?php esc_html_e('Years of experience','job-board-manager'); ?></div>
        <div class="field-input">
            <input placeholder="5" type="text" value="<?php echo $job_bm_years_experience; ?>" name="job_bm_years_experience">
            <p class="field-details"><?php esc_html_e('Years of experience must have.','job-board-manager');
                ?></p>
        </div>
    </div>
    <?php
}






/* Display job_type input field  */

add_action('job_bm_job_submit_form', 'job_bm_job_submit_form_salary_type', 30);

function job_bm_job_submit_form_salary_type(){

    $class_job_bm_functions = new class_job_bm_functions();
    $salary_type_list = $class_job_bm_functions->salary_type_list();

    $job_bm_salary_type = isset($_POST['job_bm_salary_type']) ? sanitize_text_field($_POST['job_bm_salary_type']) : "";


    ?>
    <div class="form-field-wrap">
        <div class="field-title"><?php esc_html_e('Salary type','job-board-manager'); ?></div>
        <div class="field-input">
            <select name="job_bm_salary_type" >
                <?php
                if(!empty($salary_type_list)):
                    foreach ($salary_type_list as $salary_type => $salary_type_name){

                        $selected = ($job_bm_salary_type == $salary_type) ? 'selected' : '';

                        ?>
                        <option <?php echo $selected; ?> value="<?php echo esc_attr($salary_type); ?>"><?php echo esc_html
                            ($salary_type_name); ?></option>
                        <?php
                    }
                endif;
                ?>
            </select>
            <p class="field-details"><?php esc_html_e('Select salary type.','job-board-manager'); ?></p>

        </div>
    </div>
    <?php
}






add_action('job_bm_job_submit_form', 'job_bm_job_submit_form_salary_fixed', 30);

function job_bm_job_submit_form_salary_fixed(){

    $job_bm_salary_fixed = isset($_POST['job_bm_salary_fixed']) ? sanitize_text_field($_POST['job_bm_salary_fixed']) : "";
    $job_bm_salary_type = isset($_POST['job_bm_salary_type']) ? sanitize_text_field($_POST['job_bm_salary_type']) : "";

    ?>
    <div class="form-field-wrap salary_fixed" <?php if($job_bm_salary_type =='fixed'): ?> style="display: block" <?php endif; ?>>
        <div class="field-title"><?php esc_html_e('Fixed salary','job-board-manager'); ?></div>
        <div class="field-input">
            <input placeholder="50000" type="text" value="<?php echo $job_bm_salary_fixed; ?>" name="job_bm_salary_fixed">
            <p class="field-details"><?php esc_html_e('Salary fixed, ex: 1200','job-board-manager');
                ?></p>
        </div>
    </div>
    <?php
}

add_action('job_bm_job_submit_form', 'job_bm_job_submit_form_salary_min', 30);


function job_bm_job_submit_form_salary_min(){

    $job_bm_salary_min = isset($_POST['job_bm_salary_min']) ? sanitize_text_field($_POST['job_bm_salary_min']) : "";
    $job_bm_salary_type = isset($_POST['job_bm_salary_type']) ? sanitize_text_field($_POST['job_bm_salary_type']) : "";

    ?>
    <div class="form-field-wrap salary_min" <?php if($job_bm_salary_type =='min-max'): ?> style="display: block" <?php endif; ?>>
        <div class="field-title"><?php esc_html_e('Minimum salary','job-board-manager'); ?></div>
        <div class="field-input">
            <input placeholder="5000" type="text" value="<?php echo $job_bm_salary_min; ?>" name="job_bm_salary_min">
            <p class="field-details"><?php esc_html_e('Minimum salary amount, ex: 5000','job-board-manager');
                ?></p>
        </div>
    </div>
    <?php
}



add_action('job_bm_job_submit_form', 'job_bm_job_submit_form_salary_max', 30);

function job_bm_job_submit_form_salary_max(){

    $job_bm_salary_max = isset($_POST['job_bm_salary_max']) ? sanitize_text_field($_POST['job_bm_salary_max']) : "";
    $job_bm_salary_type = isset($_POST['job_bm_salary_type']) ? sanitize_text_field($_POST['job_bm_salary_type']) : "";

    ?>
    <div class="form-field-wrap salary_max" <?php if($job_bm_salary_type =='min-max'): ?> style="display: block" <?php endif; ?>>
        <div class="field-title"><?php esc_html_e('Maximum salary','job-board-manager'); ?></div>
        <div class="field-input">
            <input placeholder="10000" type="text" value="<?php echo $job_bm_salary_max; ?>" name="job_bm_salary_max">
            <p class="field-details"><?php esc_html_e('Maximum salary amount, ex: 1000','job-board-manager');
                ?></p>
        </div>
    </div>
    <?php
}


add_action('job_bm_job_submit_form', 'job_bm_job_submit_form_contact_email', 30);


function job_bm_job_submit_form_contact_email(){

    $job_bm_contact_email = isset($_POST['job_bm_contact_email']) ? sanitize_text_field($_POST['job_bm_contact_email']) : "";

    ?>
    <div class="form-field-wrap">
        <div class="field-title"><?php esc_html_e('Contact email','job-board-manager'); ?></div>
        <div class="field-input">
            <input placeholder="contact@company.com" type="email" value="<?php echo $job_bm_contact_email; ?>" name="job_bm_contact_email">
            <p class="field-details"><?php esc_html_e('Write your contact email','job-board-manager');
                ?></p>
        </div>
    </div>
    <?php
}


add_action('job_bm_job_submit_form', 'job_bm_job_submit_form_company_info', 40);


function job_bm_job_submit_form_company_info(){


    ?>
    <div class="form-field-wrap ">
        <div class="field-separator">Company Information</div>
    </div>
    <?php
}







add_action('job_bm_job_submit_form', 'job_bm_job_submit_form_company_name', 45);


function job_bm_job_submit_form_company_name(){

    $job_bm_company_name = isset($_POST['job_bm_company_name']) ? sanitize_text_field($_POST['job_bm_company_name']) : "";

    ?>
    <div class="form-field-wrap">
        <div class="field-title"><?php esc_html_e('Company name','job-board-manager'); ?></div>
        <div class="field-input">
            <input placeholder="Google Inc" type="text" value="<?php echo $job_bm_company_name; ?>" name="job_bm_company_name">
            <p class="field-details"><?php esc_html_e('Write your company name','job-board-manager');
                ?></p>
        </div>
    </div>
    <?php
}



add_action('job_bm_job_submit_form', 'job_bm_job_submit_form_location', 45);

function job_bm_job_submit_form_location(){

    $job_bm_location = isset($_POST['job_bm_location']) ? sanitize_text_field($_POST['job_bm_location']) : "";

    ?>
    <div class="form-field-wrap">
        <div class="field-title"><?php esc_html_e('Location','job-board-manager'); ?></div>
        <div class="field-input">
            <input placeholder="Mountain View" type="text" value="<?php echo $job_bm_location; ?>" name="job_bm_location">
            <p class="field-details"><?php esc_html_e('Write company location','job-board-manager');
                ?></p>
        </div>
    </div>
    <?php
}



add_action('job_bm_job_submit_form', 'job_bm_job_submit_form_address', 45);
function job_bm_job_submit_form_address(){

    $job_bm_address = isset($_POST['job_bm_address']) ? sanitize_text_field($_POST['job_bm_address']) : "";

    ?>
    <div class="form-field-wrap">
        <div class="field-title"><?php esc_html_e('Address','job-board-manager'); ?></div>
        <div class="field-input">
            <input placeholder="1600 Amphitheatre Parkway, Mountain View, CA" type="text" value="<?php echo $job_bm_address; ?>" name="job_bm_address">
            <p class="field-details"><?php esc_html_e('Write company address','job-board-manager');
                ?></p>
        </div>
    </div>
    <?php
}




add_action('job_bm_job_submit_form', 'job_bm_job_submit_form_company_website', 45);
function job_bm_job_submit_form_company_website(){

    $job_bm_company_website = isset($_POST['job_bm_company_website']) ? sanitize_text_field($_POST['job_bm_company_website']) : "";

    ?>
    <div class="form-field-wrap">
        <div class="field-title"><?php esc_html_e('Company website','job-board-manager'); ?></div>
        <div class="field-input">
            <input placeholder="http://domain.com" type="text" value="<?php echo $job_bm_company_website; ?>" name="job_bm_company_website">
            <p class="field-details"><?php esc_html_e('Write company website','job-board-manager');
                ?></p>
        </div>
    </div>
    <?php
}




add_action('job_bm_job_submit_form', 'job_bm_job_submit_form_company_logo', 45);
function job_bm_job_submit_form_company_logo(){

    $job_bm_company_logo = isset($_POST['job_bm_company_logo']) ? sanitize_text_field($_POST['job_bm_company_logo']) : job_bm_plugin_url."assets/front/images/placeholder.png";

    ?>
    <div class="form-field-wrap ">
        <div class="field-title"><?php esc_html_e('Company logo','job-board-manager'); ?></div>
        <div class="field-input">
            <div class="media-preview-wrap" style="">
                <img class="media-preview" src="<?php echo $job_bm_company_logo; ?>" style="width:100%;box-shadow: none;"/>
            </div>

            <input placeholder="" type="text" value="<?php echo $job_bm_company_logo; ?>" name="job_bm_company_logo">
            <span class="media-upload " id=""><?php echo __('Upload','job-board-manager');?></span>
<!--            <span class="media-clear" id="">--><?php //echo __('Clear','job-board-manager');?><!--</span>-->

            <p class="field-details"><?php esc_html_e('Upload company logo','job-board-manager');
                ?></p>
        </div>
    </div>
    <?php
}




/* display reCaptcha */

add_action('job_bm_job_submit_form', 'job_bm_job_submit_form_recaptcha', 60);

function job_bm_job_submit_form_recaptcha(){

    $job_bm_reCAPTCHA_enable		= get_option('job_bm_reCAPTCHA_enable');
    $job_bm_reCAPTCHA_site_key		        = get_option('job_bm_reCAPTCHA_site_key');

    if($job_bm_reCAPTCHA_enable != 'yes'){
        return;
    }

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
}


/* Display nonce  */

add_action('job_bm_job_submit_form', 'job_bm_job_submit_form_nonce' );

function job_bm_job_submit_form_nonce(){

    ?>
    <div class="form-field-wrap">
        <div class="field-title"></div>
        <div class="field-input">

            <?php wp_nonce_field( 'job_bm_job_submit_nonce','job_bm_job_submit_nonce' ); ?>

        </div>
    </div>
    <?php
}


/* Display submit button */

add_action('job_bm_job_submit_form', 'job_bm_job_submit_form_submit', 90);

function job_bm_job_submit_form_submit(){

    ?>
    <div class="form-field-wrap">
        <div class="field-title"></div>
        <div class="field-input">
            <input type="submit"  name="submit" value="<?php _e('Submit', 'job-board-manager'); ?>" />
        </div>
    </div>
    <?php
}





/* Process the submitted data  */

add_action('job_bm_job_submit_data', 'job_bm_job_submit_data');

function job_bm_job_submit_data($post_data){

    $job_bm_reCAPTCHA_enable		    = get_option('job_bm_reCAPTCHA_enable');
    $job_bm_account_required_post_job 	= get_option('job_bm_account_required_post_job', 'yes');
    $job_bm_submitted_job_status 		= get_option('job_bm_submitted_job_status', 'pending' );
    $job_bm_job_login_page_id           = get_option('job_bm_job_login_page_id');
    $dashboard_page_url                 = get_permalink($job_bm_job_login_page_id);


    if ( is_user_logged_in() ) {
        $user_id = get_current_user_id();
    } else {
        $user_id = 0;
    }

    $error = new WP_Error();




    if(empty($post_data['post_title'])){

        $error->add( 'post_title', __( '<strong>ERROR</strong>: Job title is empty.', 'job-board-manager' ) );
    }

    if(empty($post_data['post_content'])){

        $error->add( 'post_content', __( '<strong>ERROR</strong>: Job details is empty.', 'job-board-manager' ) );
    }

    if(empty($post_data['job_bm_total_vacancies'])){

        $error->add( 'job_bm_total_vacancies', __( '<strong>ERROR</strong>: Total vacancies is empty.', 'job-board-manager' ) );
    }


    if(($post_data['job_bm_salary_type'] == 'fixed')){
        if(empty($post_data['job_bm_salary_fixed'])){
            $error->add( 'job_bm_salary_fixed', __( '<strong>ERROR</strong>: Salary fixed is empty.', 'job-board-manager' ) );
        }
    }

    if(($post_data['job_bm_salary_type'] == 'min-max')){
        if(empty($post_data['job_bm_salary_min'])){
            $error->add( 'job_bm_salary_min', __( '<strong>ERROR</strong>: Salary minimum is empty.', 'job-board-manager' ) );
        }

        if(empty($post_data['job_bm_salary_max'])){
            $error->add( 'job_bm_salary_max', __( '<strong>ERROR</strong>: Salary maximum is empty.', 'job-board-manager' ) );
        }

    }





    if(empty($post_data['job_bm_contact_email'])){

        $error->add( 'job_bm_contact_email', __( '<strong>ERROR</strong>: Contact email is empty.', 'job-board-manager' ) );
    }

    if(empty($post_data['job_bm_company_name'])){

        $error->add( 'job_bm_company_name', __( '<strong>ERROR</strong>: Company name is empty.', 'job-board-manager' ) );
    }

    if(empty($post_data['job_bm_location'])){

        $error->add( 'job_bm_location', __( '<strong>ERROR</strong>: Location is empty.', 'job-board-manager' ) );
    }


    if(empty($post_data['job_bm_address'])){

        $error->add( 'job_bm_address', __( '<strong>ERROR</strong>: Address is empty.', 'job-board-manager' ) );
    }

    if(empty($post_data['job_bm_company_logo'])){

        $error->add( 'job_bm_company_logo', __( '<strong>ERROR</strong>: Company logo is empty.', 'job-board-manager' ) );
    }

    if(empty($post_data['g-recaptcha-response']) && $job_bm_reCAPTCHA_enable =='yes'){

        $error->add( 'g-recaptcha-response', __( '<strong>ERROR</strong>: reCaptcha test failed.', 'job-board-manager' ) );
    }

    if($job_bm_account_required_post_job == 'yes' && !is_user_logged_in()){

        $error->add( 'login',  sprintf (__('<strong>ERROR</strong>: Please <a target="_blank" href="%s">login</a> to submit question.',
            'job-board-manager'), $dashboard_page_url ));
    }

    if(! isset( $_POST['job_bm_job_submit_nonce'] ) || ! wp_verify_nonce( $_POST['job_bm_job_submit_nonce'], 'job_bm_job_submit_nonce' ) ){

        $error->add( '_wpnonce', __( '<strong>ERROR</strong>: security test failed.', 'job-board-manager' ) );
    }



    $errors = apply_filters( 'job_bm_job_submit_errors', $error, $post_data );






    if ( !$error->has_errors() ) {

        $allowed_html = array();

        $post_title = isset($post_data['post_title']) ? $post_data['post_title'] :'';
        $post_content = isset($post_data['post_content']) ? wp_kses($post_data['post_content'], $allowed_html) : "";

        $post_status = isset($post_data['post_status']) ? $post_data['post_status'] :'';


        $job_ID = wp_insert_post(
            array(
                'post_title'    => $post_title,
                'post_content'  => $post_content,
                'post_status'   => $job_bm_submitted_job_status,
                'post_type'   	=> 'job',
                'post_author'   => $user_id,
            )
        );

        do_action('job_bm_job_submitted', $job_ID, $post_data);

        job_bm_email_job_submitted($job_ID);

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


/* Display save data after submitted question */

add_action('job_bm_job_submitted', 'job_bm_job_submitted_save_data', 90, 2);

function job_bm_job_submitted_save_data($job_ID, $post_data){

    $user_id = get_current_user_id();

    $job_category = isset($post_data['job_category']) ? sanitize_text_field($post_data['job_category']) : "";
    $job_bm_total_vacancies = isset($post_data['job_bm_total_vacancies']) ? sanitize_text_field($post_data['job_bm_total_vacancies']) : "";
    $job_bm_job_type = isset($post_data['job_bm_job_type']) ? sanitize_text_field($post_data['job_bm_job_type']) : "";
    $job_bm_job_level = isset($post_data['job_bm_job_level']) ? sanitize_text_field($post_data['job_bm_job_level']) : "";
    $job_bm_years_experience = isset($post_data['job_bm_years_experience']) ? sanitize_text_field($post_data['job_bm_years_experience']) : "";
    $job_bm_salary_type = isset($post_data['job_bm_salary_type']) ? sanitize_text_field($post_data['job_bm_salary_type']) : "";
    $job_bm_salary_fixed = isset($post_data['job_bm_salary_fixed']) ? sanitize_text_field($post_data['job_bm_salary_fixed']) : "";
    $job_bm_salary_min = isset($post_data['job_bm_salary_min']) ? sanitize_text_field($post_data['job_bm_salary_min']) : "";
    $job_bm_salary_max = isset($post_data['job_bm_salary_max']) ? sanitize_text_field($post_data['job_bm_salary_max']) : "";
    $job_bm_contact_email = isset($post_data['job_bm_contact_email']) ? sanitize_text_field($post_data['job_bm_contact_email']) : "";
    $job_bm_company_name = isset($post_data['job_bm_company_name']) ? sanitize_text_field($post_data['job_bm_company_name']) : "";
    $job_bm_location = isset($post_data['job_bm_location']) ? sanitize_text_field($post_data['job_bm_location']) : "";
    $job_bm_address = isset($post_data['job_bm_address']) ? sanitize_text_field($post_data['job_bm_address']) : "";
    $job_bm_company_logo = isset($post_data['job_bm_company_logo']) ? sanitize_text_field($post_data['job_bm_company_logo']) : "";




    wp_set_post_terms( $job_ID, $job_category, 'job_category' );


    update_post_meta($job_ID, 'job_bm_total_vacancies', $job_bm_total_vacancies);
    update_post_meta($job_ID, 'job_bm_job_type', $job_bm_job_type);
    update_post_meta($job_ID, 'job_bm_job_level', $job_bm_job_level);
    update_post_meta($job_ID, 'job_bm_years_experience', $job_bm_years_experience);
    update_post_meta($job_ID, 'job_bm_salary_type', $job_bm_salary_type);
    update_post_meta($job_ID, 'job_bm_salary_fixed', $job_bm_salary_fixed);
    update_post_meta($job_ID, 'job_bm_salary_min', $job_bm_salary_min);
    update_post_meta($job_ID, 'job_bm_salary_max', $job_bm_salary_max);
    update_post_meta($job_ID, 'job_bm_contact_email', $job_bm_contact_email);

    update_post_meta($job_ID, 'job_bm_company_name', $job_bm_company_name);
    update_post_meta($job_ID, 'job_bm_location', $job_bm_location);
    update_post_meta($job_ID, 'job_bm_address', $job_bm_address);
    update_post_meta($job_ID, 'job_bm_company_logo', $job_bm_company_logo);




}






/* Display success message after submitted question */

add_action('job_bm_job_submitted', 'job_bm_job_submitted_message', 80, 2);

function job_bm_job_submitted_message($job_ID, $post_data){

    ?>
    <div class="job-submitted success">
        <?php echo apply_filters('job_bm_job_submitted_thank_you', _e('Thanks for submit your job, we will review soon.', 'job-board-manager')); ?>
    </div>
    <?php


}







add_action('job_bm_job_submitted', 'job_bm_job_submitted_redirect', 99999, 2);

function job_bm_job_submitted_redirect($job_ID, $post_data){

    $job_bm_redirect_preview_link 	= get_option('job_bm_redirect_preview_link');




    if(!empty($job_bm_redirect_preview_link)):

        if($job_bm_redirect_preview_link =='job_preview'){
            $redirect_page_url = get_preview_post_link($job_ID);
        }else{
            $job_bm_job_login_page_id 	= get_option('job_bm_job_login_page_id');
            $redirect_page_url 					= get_permalink($job_bm_job_login_page_id);
        }

        ?>
        <script>
            jQuery(document).ready(function($) {
                window.location.href = '<?php echo $redirect_page_url; ?>';
            })
        </script>
    <?php

    endif;



//    if ( wp_safe_redirect($redirect_page_url) ) {
//        exit;
//    }


}



















