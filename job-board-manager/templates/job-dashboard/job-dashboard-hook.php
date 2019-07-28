<?php
if ( ! defined('ABSPATH')) exit;  // if direct access 


add_action('job_bm_dashboard', 'job_bm_dashboard');

if(!function_exists('job_bm_dashboard')){
    function job_bm_dashboard(){

        if (is_user_logged_in() ):
            do_action('job_bm_dashboard_logged_in');
        else:
            do_action('job_bm_dashboard_logged_out');
        endif;


    }
}


add_action('job_bm_dashboard_logged_in', 'job_bm_dashboard_logged_in');

if(!function_exists('job_bm_dashboard_logged_in')){
    function job_bm_dashboard_logged_in(){

        $job_bm_redirect_logout = get_option('job_bm_redirect_logout');
        $job_bm_account_page_id = get_option('job_bm_account_page_id');
        $job_bm_account_page_url = get_permalink($job_bm_account_page_id);


        $tabs['account'] =array(
            'title'=>__('Account', 'job-board-manager'),
        );

        $tabs['my_jobs'] =array(
            'title'=>__('My jobs', 'job-board-manager'),
        );

        $tabs['my_applications'] =array(
            'title'=>__('My applications', 'job-board-manager'),
        );

        $tabs['applications'] =array(
            'title'=>__('Applications', 'job-board-manager'),
        );


        $tabs['logout'] =array(
            'title'=>__('Logout!', 'job-board-manager'),
            'link'=> wp_logout_url(get_permalink($job_bm_redirect_logout)),
        );

        $dashboard_tabs = apply_filters('job_bm_dashboard_tabs', $tabs);

        ?>
        <ul class="navs">
            <?php

            if(!empty($dashboard_tabs))
                foreach($dashboard_tabs as $tabs_key=>$tabs){

                    $title = isset($tabs['title']) ? $tabs['title'] : '';
                    $link = isset($tabs['link']) ? $tabs['link'] : $job_bm_account_page_url.'?tabs='.$tabs_key;


                    ?>
                    <li>
                        <a href="<?php echo $link; ?>">
                            <?php echo $title; ?>
                        </a>
                    </li>
                    <?php
                }
            ?>
        </ul>
        <div class="navs-content">
            <?php

            $current_tabs = isset($_GET['tabs']) ? sanitize_text_field($_GET['tabs']) : 'account';

            do_action('job_bm_dashboard_tabs_content_'.$current_tabs);
            ?>
        </div>
        <?php


    }
}



/* Display question title field */

add_action('job_bm_dashboard_tabs_content_account', 'job_bm_dashboard_tabs_content_account');

if(!function_exists('job_bm_dashboard_tabs_content_account')){
    function job_bm_dashboard_tabs_content_account(){

        if(is_user_logged_in()){

            global $current_user;

            ?>
            <div class="welcome">
                <?php echo sprintf(__('Welcome <strong>%s</strong>', 'job-board-manager'), $current_user->display_name); ?>
            </div>
            <?php

        }
    }
}



add_action('job_bm_dashboard_tabs_content_my_jobs', 'job_bm_dashboard_tabs_content_my_jobs');

if(!function_exists('job_bm_dashboard_tabs_content_my_jobs')){
    function job_bm_dashboard_tabs_content_my_jobs(){

        echo do_shortcode('[job_bm_my_jobs]');

    }
}





add_action('job_bm_dashboard_tabs_content_logout', 'job_bm_dashboard_tabs_content_logout');

if(!function_exists('job_bm_dashboard_tabs_content_logout')){
    function job_bm_dashboard_tabs_content_logout(){

        echo wp_logout_url();

    }
}


add_action('job_bm_dashboard_tabs_content_my_applications', 'job_bm_dashboard_tabs_content_my_applications');

if(!function_exists('job_bm_dashboard_tabs_content_my_applications')){
    function job_bm_dashboard_tabs_content_my_applications(){

        echo do_shortcode('[job_bm_my_applications]');

    }
}


add_action('job_bm_dashboard_tabs_content_applications', 'job_bm_dashboard_tabs_content_applications');

if(!function_exists('job_bm_dashboard_tabs_content_applications')){
    function job_bm_dashboard_tabs_content_applications(){

        echo do_shortcode('[job_bm_applications]');

    }
}



add_action('job_bm_dashboard_logged_out', 'job_bm_dashboard_logged_out');

if(!function_exists('job_bm_dashboard_logged_out')){
    function job_bm_dashboard_logged_out(){

        $job_bm_login_enable = get_option('job_bm_login_enable');
        $job_bm_registration_enable = get_option('job_bm_registration_enable');

        if($job_bm_registration_enable=='yes'){

            ?>
            <div class="register">
                <h3><?php echo __('Register', 'job-board-manager'); ?></h3>
                <?php echo do_shortcode('[job_bm_registration_form]'); ?>

            </div>
            <?php





        }


        if($job_bm_login_enable=='yes'){

            $job_bm_redirect_login = get_option('job_bm_redirect_login');
            $job_bm_redirect_login_url = get_permalink($job_bm_redirect_login);

            ?>
            <div class="login">
                <h3><?php echo __('Login', 'job-board-manager'); ?></h3>
            <?php

            $args = array(
                'echo'           => true,
                'remember'       => true,
                'redirect'       => $job_bm_redirect_login_url,
                'form_id'        => 'loginform',
                'id_username'    => 'user_login',
                'id_password'    => 'user_pass',
                'id_remember'    => 'rememberme',
                'id_submit'      => 'wp-submit',
                'label_username' => __( 'Username or email address', 'job-board-manager' ),
                'label_password' => __( 'Password' , 'job-board-manager'),
                'label_remember' => __( 'Remember Me', 'job-board-manager' ),
                'label_log_in'   => __( 'Log In', 'job-board-manager' ),
                'value_username' => '',
                'value_remember' => false
            );

            wp_login_form($args);

            //echo ob_get_clean();
            ?>
            </div>
            <?php

        }

    }
}








