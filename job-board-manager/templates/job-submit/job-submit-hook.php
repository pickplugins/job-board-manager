<?php
if ( ! defined('ABSPATH')) exit;  // if direct access 


/* Display question title field */

add_action('job_bm_job_submit_form', 'job_bm_job_submit_form_title', 0);

function job_bm_job_submit_form_title(){

    $post_title = isset($_POST['post_title']) ? sanitize_text_field($_POST['post_title']) : "";

    ?>
    <div class="form-field-wrap">
        <div class="field-title"><?php esc_html_e('Job title','question-answer'); ?></div>
        <div class="field-input">
            <input placeholder="" type="text" value="<?php echo $post_title; ?>" name="post_title">
            <p class="field-details"><?php esc_html_e('Write your job title','question-answer');
            ?></p>
        </div>
    </div>
    <?php
}


/* Display question details input field*/

add_action('job_bm_job_submit_form', 'job_bm_job_submit_form_content', 10);

function job_bm_job_submit_form_content(){

    $field_id = 'post_content';
    $allowed_html = apply_filters('qa_question_submit_allowed_html_tags', array());
    $post_content = isset($_POST['post_content']) ? wp_kses($_POST['post_content'], $allowed_html) : "";


    ?>
    <div class="form-field-wrap">
        <div class="field-title"><?php esc_html_e('Job description','question-answer'); ?></div>
        <div class="field-input">
            <?php
            ob_start();
            wp_editor( $post_content, $field_id, $settings = array('textarea_name'=>$field_id,
                'media_buttons'=>false,'wpautop'=>true,'editor_height'=>'200px', ) );
            echo ob_get_clean();

            ?>

            <p class="field-details"><?php esc_html_e('Write your job details.','question-answer'); ?></p>

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
        <div class="field-title"><?php esc_html_e('Job category','question-answer'); ?></div>
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
            <p class="field-details"><?php esc_html_e('Select question category.','question-answer'); ?></p>

        </div>
    </div>
    <?php
}






add_action('job_bm_job_submit_form', 'job_bm_job_submit_form_job_info', 30);


function job_bm_job_submit_form_job_info(){


    ?>
    <div class="form-field-wrap ">
        <div class="field-separator">Job Information</div>
    </div>
    <?php
}











/* Display vacancies input field  */

add_action('job_bm_job_submit_form', 'job_bm_job_submit_form_total_vacancies', 30);


function job_bm_job_submit_form_total_vacancies(){

    $job_bm_total_vacancies = isset($_POST['job_bm_total_vacancies']) ? sanitize_text_field($_POST['job_bm_total_vacancies']) : "";

    ?>
    <div class="form-field-wrap">
        <div class="field-title"><?php esc_html_e('Total vacancies','question-answer'); ?></div>
        <div class="field-input">
            <input placeholder="3" type="text" value="<?php echo $job_bm_total_vacancies; ?>" name="job_bm_total_vacancies">
            <p class="field-details"><?php esc_html_e('Total number of vacancies','question-answer');
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
        <div class="field-title"><?php esc_html_e('Job type','question-answer'); ?></div>
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
            <p class="field-details"><?php esc_html_e('Select job type.','question-answer'); ?></p>

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
        <div class="field-title"><?php esc_html_e('Job level','question-answer'); ?></div>
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
            <p class="field-details"><?php esc_html_e('Select job level.','question-answer'); ?></p>

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
        <div class="field-title"><?php esc_html_e('Years of experience','question-answer'); ?></div>
        <div class="field-input">
            <input placeholder="5" type="text" value="<?php echo $job_bm_years_experience; ?>" name="job_bm_years_experience">
            <p class="field-details"><?php esc_html_e('Years of experience must have.','question-answer');
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
        <div class="field-title"><?php esc_html_e('Salary type','question-answer'); ?></div>
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
            <p class="field-details"><?php esc_html_e('Select salary type.','question-answer'); ?></p>

        </div>
    </div>
    <?php
}






add_action('job_bm_job_submit_form', 'job_bm_job_submit_form_salary_fixed', 30);


function job_bm_job_submit_form_salary_fixed(){

    $job_bm_salary_fixed = isset($_POST['job_bm_salary_fixed']) ? sanitize_text_field($_POST['job_bm_salary_fixed']) : "";

    ?>
    <div class="form-field-wrap salary_fixed">
        <div class="field-title"><?php esc_html_e('Fixed salary','question-answer'); ?></div>
        <div class="field-input">
            <input placeholder="50000" type="text" value="<?php echo $job_bm_salary_fixed; ?>" name="job_bm_salary_fixed">
            <p class="field-details"><?php esc_html_e('Salary fixed, ex: 1200','question-answer');
                ?></p>
        </div>
    </div>
    <?php
}

add_action('job_bm_job_submit_form', 'job_bm_job_submit_form_salary_min', 30);


function job_bm_job_submit_form_salary_min(){

    $job_bm_salary_min = isset($_POST['job_bm_salary_min']) ? sanitize_text_field($_POST['job_bm_salary_min']) : "";

    ?>
    <div class="form-field-wrap salary_min">
        <div class="field-title"><?php esc_html_e('Minimum salary','question-answer'); ?></div>
        <div class="field-input">
            <input placeholder="5000" type="text" value="<?php echo $job_bm_salary_min; ?>" name="job_bm_salary_min">
            <p class="field-details"><?php esc_html_e('Minimum salary amount, ex: 5000','question-answer');
                ?></p>
        </div>
    </div>
    <?php
}



add_action('job_bm_job_submit_form', 'job_bm_job_submit_form_salary_max', 30);


function job_bm_job_submit_form_salary_max(){

    $job_bm_salary_max = isset($_POST['job_bm_salary_max']) ? sanitize_text_field($_POST['job_bm_salary_max']) : "";

    ?>
    <div class="form-field-wrap salary_max">
        <div class="field-title"><?php esc_html_e('Maximum salary','question-answer'); ?></div>
        <div class="field-input">
            <input placeholder="10000" type="text" value="<?php echo $job_bm_salary_max; ?>" name="job_bm_salary_max">
            <p class="field-details"><?php esc_html_e('Maximum salary amount, ex: 1000','question-answer');
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
        <div class="field-title"><?php esc_html_e('Contact email','question-answer'); ?></div>
        <div class="field-input">
            <input placeholder="contact@company.com" type="email" value="<?php echo $job_bm_contact_email; ?>" name="job_bm_contact_email">
            <p class="field-details"><?php esc_html_e('Write your contact email','question-answer');
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
        <div class="field-title"><?php esc_html_e('Company name','question-answer'); ?></div>
        <div class="field-input">
            <input placeholder="Google Inc" type="text" value="<?php echo $job_bm_company_name; ?>" name="job_bm_company_name">
            <p class="field-details"><?php esc_html_e('Write your company name','question-answer');
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
        <div class="field-title"><?php esc_html_e('Location','question-answer'); ?></div>
        <div class="field-input">
            <input placeholder="Mountain View" type="text" value="<?php echo $job_bm_location; ?>" name="job_bm_location">
            <p class="field-details"><?php esc_html_e('Write company location','question-answer');
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
        <div class="field-title"><?php esc_html_e('Address','question-answer'); ?></div>
        <div class="field-input">
            <input placeholder="1600 Amphitheatre Parkway, Mountain View, CA" type="text" value="<?php echo $job_bm_address; ?>" name="job_bm_address">
            <p class="field-details"><?php esc_html_e('Write company address','question-answer');
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
        <div class="field-title"><?php esc_html_e('Company website','question-answer'); ?></div>
        <div class="field-input">
            <input placeholder="http://domain.com" type="text" value="<?php echo $job_bm_company_website; ?>" name="job_bm_company_website">
            <p class="field-details"><?php esc_html_e('Write company website','question-answer');
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
        <div class="field-title"><?php esc_html_e('Company logo','question-answer'); ?></div>
        <div class="field-input">



            <div class="media-preview-wrap" style="">
                <img class="media-preview" src="<?php echo $job_bm_company_logo; ?>" style="width:100%;box-shadow: none;"/>
            </div>

            <input placeholder="" type="text" value="<?php echo $job_bm_company_logo; ?>" name="job_bm_company_logo">
            <span class="media-upload " id=""><?php echo __('Upload','pickplugins-options-framework');?></span>
<!--            <span class="media-clear" id="">--><?php //echo __('Clear','pickplugins-options-framework');?><!--</span>-->

            <p class="field-details"><?php esc_html_e('Upload company logo','question-answer');
                ?></p>
        </div>
    </div>
    <?php
}














/* Display tags input fields */

//add_action('job_bm_job_submit_form', 'job_bm_job_submit_form_tags', 50);

function job_bm_job_submit_form_tags(){

    $question_tags = isset($_POST['question_tags']) ? sanitize_text_field($_POST['question_tags']) : "";


    ?>
    <div class="form-field-wrap">
        <div class="field-title"><?php esc_html_e('Question tags','question-answer'); ?></div>
        <div class="field-input">
            <input type="text" value="<?php echo esc_attr($question_tags); ?>" name="question_tags">
            <p class="field-details"><?php esc_html_e('Put some tags here, use comma( , ) to separate.', 'question-answer'); ?></p>
        </div>
    </div>
    <?php
}




/* display reCaptcha */

//add_action('job_bm_job_submit_form', 'job_bm_job_submit_form_recaptcha', 60);

function job_bm_job_submit_form_recaptcha(){

    $qa_reCAPTCHA_enable_question		= get_option('qa_reCAPTCHA_enable_question');
    $qa_reCAPTCHA_site_key		        = get_option('qa_reCAPTCHA_site_key');

    if($qa_reCAPTCHA_enable_question != 'yes'){
        return;
    }

    ?>
    <div class="form-field-wrap">
        <div class="field-title"></div>
        <div class="field-input">

            <div class="g-recaptcha" data-sitekey="<?php echo $qa_reCAPTCHA_site_key; ?>"></div>
            <script src="https://www.google.com/recaptcha/api.js"></script>

            <p class="field-details"><?php esc_html_e('Please prove you are human.','question-answer'); ?></p>

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

            <?php wp_nonce_field( 'qa_q_submit_nonce','qa_q_submit_nonce' ); ?>

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
            <input type="submit"  name="submit" value="<?php _e('Submit', 'question-answer'); ?>" />
        </div>
    </div>
    <?php
}





/* Process the submitted data  */

add_action('job_bm_job_submit_data', 'job_bm_job_submit_data');

function job_bm_job_submit_data($post_data){

    $qa_reCAPTCHA_enable_question		= get_option('qa_reCAPTCHA_enable_question');
    $qa_account_required_post_question 	= get_option('qa_account_required_post_question', 'yes');
    $qa_question_login_page_id 			= get_option('qa_question_login_page_id');
    $login_page_url 					= get_permalink($qa_question_login_page_id);
    $qa_page_myaccount 			        = get_option('qa_page_myaccount', '' );
    $qa_submitted_post_status 			= get_option('qa_submitted_question_status', 'pending' );
    $qa_enable_poll                     = get_option('qa_enable_poll', 'no');

    $qa_page_myaccount_url = !empty($qa_page_myaccount) ? get_permalink($qa_page_myaccount) : wp_login_url($_SERVER['REQUEST_URI']);

    if ( is_user_logged_in() ) {
        $user_id = get_current_user_id();
    } else {
        $user_id = 0;
    }

    $error = new WP_Error();




    if(empty($post_data['post_title'])){

        $error->add( 'post_title', __( '<strong>ERROR</strong>: Job title is empty.', 'question-answer' ) );
    }

    if(empty($post_data['post_content'])){

        $error->add( 'post_content', __( '<strong>ERROR</strong>: Job details is empty.', 'question-answer' ) );
    }

    if(empty($post_data['job_bm_total_vacancies'])){

        $error->add( 'job_bm_total_vacancies', __( '<strong>ERROR</strong>: Total vacancies is empty.', 'question-answer' ) );
    }

    if(empty($post_data['job_bm_contact_email'])){

        $error->add( 'job_bm_contact_email', __( '<strong>ERROR</strong>: Contact email is empty.', 'question-answer' ) );
    }

    if(empty($post_data['job_bm_company_name'])){

        $error->add( 'job_bm_company_name', __( '<strong>ERROR</strong>: Company name is empty.', 'question-answer' ) );
    }

    if(empty($post_data['job_bm_location'])){

        $error->add( 'job_bm_location', __( '<strong>ERROR</strong>: Location is empty.', 'question-answer' ) );
    }


    if(empty($post_data['job_bm_address'])){

        $error->add( 'job_bm_address', __( '<strong>ERROR</strong>: Address is empty.', 'question-answer' ) );
    }

    if(empty($post_data['job_bm_company_logo'])){

        $error->add( 'job_bm_company_logo', __( '<strong>ERROR</strong>: Company logo is empty.', 'question-answer' ) );
    }

    if(empty($post_data['g-recaptcha-response']) && $qa_reCAPTCHA_enable_question =='yes'){

        $error->add( 'g-recaptcha-response', __( '<strong>ERROR</strong>: reCaptcha test failed.', 'question-answer' ) );
    }

    if($qa_account_required_post_question=='yes' && !$user_id){

        $error->add( 'login',  sprintf (__('<strong>ERROR</strong>: Please <a target="_blank" href="%s">login</a> to submit question.',
            'question-answer'), $qa_page_myaccount_url ));
    }

    if(! isset( $_POST['qa_q_submit_nonce'] )
        || ! wp_verify_nonce( $_POST['qa_q_submit_nonce'], 'qa_q_submit_nonce' ) ){

        $error->add( '_wpnonce', __( '<strong>ERROR</strong>: security test failed.', 'question-answer' ) );
    }



    $errors = apply_filters( 'qa_question_submit_errors', $error, $post_data );






    if ( !$error->has_errors() ) {

        $allowed_html = array();

        $post_title = isset($post_data['post_title']) ? $post_data['post_title'] :'';
        $post_content = isset($post_data['post_content']) ? wp_kses($post_data['post_content'], $allowed_html) : "";

        $post_status = isset($post_data['post_status']) ? $post_data['post_status'] :'';


        $job_ID = wp_insert_post(
            array(
                'post_title'    => $post_title,
                'post_content'  => $post_content,
                'post_status'   => !empty($post_status) ? 'private' : $qa_submitted_post_status,
                'post_type'   	=> 'job',
                'post_author'   => $user_id,
            )
        );

        do_action('job_bm_job_submitted', $job_ID, $post_data);


    }
    else{

        $error_messages = $error->get_error_messages();

        ?>
        <div class="errors">
            <?php

            if(!empty($error_messages))
            foreach ($error_messages as $message){
                ?>
                <div class="error"><?php echo $message; ?></div>
                <?php
            }
            ?>
        </div>
        <?php
    }
}





