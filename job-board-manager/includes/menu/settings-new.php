<?php	
if ( ! defined('ABSPATH')) exit;  // if direct access



$testimonial_settings_tab = array();


$testimonial_settings_tab[] = array(
    'id' => 'general',
    'title' => __('<i class="fas fa-laptop-code"></i> General','testimonial'),
    'priority' => 1,
    'active' => true,
);

$testimonial_settings_tab[] = array(
    'id' => 'pages',
    'title' => __('<i class="far fa-copy"></i> Pages','testimonial'),
    'priority' => 2,
    'active' => false,
);

$testimonial_settings_tab[] = array(
    'id' => 'job_submit',
    'title' => __('<i class="fas fa-pencil-ruler"></i> Job Submit','testimonial'),
    'priority' => 3,
    'active' => false,
);

$testimonial_settings_tab[] = array(
    'id' => 'job_edit',
    'title' => __('<i class="fas fa-pencil-alt"></i> Job Edit','testimonial'),
    'priority' => 4,
    'active' => false,
);

$testimonial_settings_tab[] = array(
    'id' => 'dashboard',
    'title' => __('<i class="fas fa-tachometer-alt"></i> Dashboard','testimonial'),
    'priority' => 5,
    'active' => false,
);


$testimonial_settings_tab[] = array(
    'id' => 'email',
    'title' => __('<i class="far fa-envelope"></i> Email','testimonial'),
    'priority' => 6,
    'active' => false,
);

$testimonial_settings_tab[] = array(
    'id' => 'style',
    'title' => __('<i class="fas fa-palette"></i> Style','testimonial'),
    'priority' => 7,
    'active' => false,
);

$testimonial_settings_tab[] = array(
    'id' => 'expiry',
    'title' => __('<i class="fas fa-calendar-alt"></i> Expiry','testimonial'),
    'priority' => 8,
    'active' => false,
);



$testimonial_settings_tabs = apply_filters('job_bm_settings_tabs', $testimonial_settings_tab);


$tabs_sorted = array();
foreach ($testimonial_settings_tabs as $page_key => $tab) $tabs_sorted[$page_key] = isset( $tab['priority'] ) ? $tab['priority'] : 0;
array_multisort($tabs_sorted, SORT_ASC, $testimonial_settings_tabs);
	
?>





<div class="wrap">

	<div id="icon-tools" class="icon32"><br></div><?php echo "<h2>".__(job_bm_plugin_name.' Settings', 'job-board-manager')."</h2>";?>
		<form  method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
	        <input type="hidden" name="job_bm_hidden" value="Y">



            <?php


            if(!empty($_POST['job_bm_hidden'])){

                $nonce = sanitize_text_field($_POST['_wpnonce']);

                if(wp_verify_nonce( $nonce, 'job_bm_nonce' ) && $_POST['job_bm_hidden'] == 'Y') {

                    $job_bm_list_per_page = isset($_POST['job_bm_list_per_page']) ?  sanitize_text_field($_POST['job_bm_list_per_page']) : '';
                    $job_bm_list_archive_more_style = isset($_POST['job_bm_list_archive_more_style']) ?  sanitize_text_field($_POST['job_bm_list_archive_more_style']) : '';
                    $job_bm_salary_currency = isset($_POST['job_bm_salary_currency']) ?  sanitize_text_field($_POST['job_bm_salary_currency']) : '';
                    $job_bm_can_user_delete_jobs = isset($_POST['job_bm_can_user_delete_jobs']) ?  sanitize_text_field($_POST['job_bm_can_user_delete_jobs']) : '';
                    $job_bm_can_user_edit_published_jobs = isset($_POST['job_bm_can_user_edit_published_jobs']) ?  sanitize_text_field($_POST['job_bm_can_user_edit_published_jobs']) : '';
                    $job_bm_job_login_page_id = isset($_POST['job_bm_job_login_page_id']) ?  sanitize_text_field($_POST['job_bm_job_login_page_id']) : '';
                    $job_bm_archive_page_id = isset($_POST['job_bm_archive_page_id']) ?  sanitize_text_field($_POST['job_bm_archive_page_id']) : '';
                    $job_bm_job_submit_page_id = isset($_POST['job_bm_job_submit_page_id']) ?  sanitize_text_field($_POST['job_bm_job_submit_page_id']) : '';
                    $job_bm_job_edit_page_id = isset($_POST['job_bm_job_edit_page_id']) ?  sanitize_text_field($_POST['job_bm_job_edit_page_id']) : '';
                    $job_bm_registration_enable = isset($_POST['job_bm_registration_enable']) ?  sanitize_text_field($_POST['job_bm_registration_enable']) : '';
                    $job_bm_login_enable = isset($_POST['job_bm_login_enable']) ?  sanitize_text_field($_POST['job_bm_login_enable']) : '';
                    $job_bm_account_required_post_job = isset($_POST['job_bm_account_required_post_job']) ?  sanitize_text_field($_POST['job_bm_account_required_post_job']) : '';
                    $job_bm_reCAPTCHA_enable = isset($_POST['job_bm_reCAPTCHA_enable']) ?  sanitize_text_field($_POST['job_bm_reCAPTCHA_enable']) : '';
                    $job_bm_reCAPTCHA_site_key = isset($_POST['job_bm_reCAPTCHA_site_key']) ?  sanitize_text_field($_POST['job_bm_reCAPTCHA_site_key']) : '';
                    $job_bm_reCAPTCHA_secret_key = isset($_POST['job_bm_reCAPTCHA_secret_key']) ?  sanitize_text_field($_POST['job_bm_reCAPTCHA_secret_key']) : '';
                    $job_bm_submitted_job_status = isset($_POST['job_bm_submitted_job_status']) ?  sanitize_text_field($_POST['job_bm_submitted_job_status']) : '';
                    $job_bm_notify_email_job_submit = isset($_POST['job_bm_notify_email_job_submit']) ?  sanitize_text_field($_POST['job_bm_notify_email_job_submit']) : '';
                    $job_bm_notify_email_job_publish = isset($_POST['job_bm_notify_email_job_publish']) ?  sanitize_text_field($_POST['job_bm_notify_email_job_publish']) : '';
                    $job_bm_apply_method = isset($_POST['job_bm_apply_method']) ?  stripslashes_deep($_POST['job_bm_apply_method']) : array('none');
                    $job_bm_redirect_preview_link = isset($_POST['job_bm_redirect_preview_link']) ?  sanitize_text_field($_POST['job_bm_redirect_preview_link']) : '';
                    $job_bm_edited_job_status = isset($_POST['job_bm_edited_job_status']) ?  sanitize_text_field($_POST['job_bm_edited_job_status']) : '';
                    $job_bm_edited_redirect_link = isset($_POST['job_bm_edited_redirect_link']) ?  sanitize_text_field($_POST['job_bm_edited_redirect_link']) : '';
                    $job_bm_job_edit_notify_email = isset($_POST['job_bm_job_edit_notify_email']) ?  sanitize_text_field($_POST['job_bm_job_edit_notify_email']) : '';


                    $job_bm_redirect_login = isset($_POST['job_bm_redirect_login']) ?  sanitize_text_field($_POST['job_bm_redirect_login']) : '';
                    $job_bm_redirect_logout = isset($_POST['job_bm_redirect_logout']) ?  sanitize_text_field($_POST['job_bm_redirect_logout']) : '';



                    $job_bm_logo_url = isset($_POST['job_bm_logo_url']) ?  sanitize_text_field($_POST['job_bm_logo_url']) : '';
                    $job_bm_from_email = isset($_POST['job_bm_from_email']) ?  sanitize_text_field($_POST['job_bm_from_email']) : '';
                    $job_bm_featured_bg_color = isset($_POST['job_bm_featured_bg_color']) ?  sanitize_text_field($_POST['job_bm_featured_bg_color']) : '';
                    $job_bm_job_type_bg_color = isset($_POST['job_bm_job_type_bg_color']) ?  stripslashes_deep($_POST['job_bm_job_type_bg_color']) : array();
                    $job_bm_job_type_text_color = isset($_POST['job_bm_job_type_text_color']) ?  stripslashes_deep($_POST['job_bm_job_type_text_color']) : array();

                    $job_bm_job_status_bg_color = isset($_POST['job_bm_job_status_bg_color']) ?  stripslashes_deep($_POST['job_bm_job_status_bg_color']) : array();
                    $job_bm_job_status_text_color = isset($_POST['job_bm_job_status_text_color']) ?  stripslashes_deep($_POST['job_bm_job_status_text_color']) : array();

                    $job_bm_email_templates_data = isset($_POST['job_bm_email_templates_data']) ?  stripslashes_deep($_POST['job_bm_email_templates_data']) : array();






                    update_option('job_bm_list_per_page', $job_bm_list_per_page);
                    update_option('job_bm_list_archive_more_style', $job_bm_list_archive_more_style);
                    update_option('job_bm_salary_currency', $job_bm_salary_currency);
                    update_option('job_bm_can_user_delete_jobs', $job_bm_can_user_delete_jobs);
                    update_option('job_bm_can_user_edit_published_jobs', $job_bm_can_user_edit_published_jobs);
                    update_option('job_bm_job_login_page_id', $job_bm_job_login_page_id);
                    update_option('job_bm_archive_page_id', $job_bm_archive_page_id);
                    update_option('job_bm_job_submit_page_id', $job_bm_job_submit_page_id);
                    update_option('job_bm_job_edit_page_id', $job_bm_job_edit_page_id);
                    update_option('job_bm_login_enable', $job_bm_login_enable);
                    update_option('job_bm_account_required_post_job', $job_bm_account_required_post_job);
                    update_option('job_bm_reCAPTCHA_enable', $job_bm_reCAPTCHA_enable);
                    update_option('job_bm_reCAPTCHA_site_key', $job_bm_reCAPTCHA_site_key);
                    update_option('job_bm_reCAPTCHA_secret_key', $job_bm_reCAPTCHA_secret_key);
                    update_option('job_bm_submitted_job_status', $job_bm_submitted_job_status);
                    update_option('job_bm_notify_email_job_submit', $job_bm_notify_email_job_submit);
                    update_option('job_bm_notify_email_job_publish', $job_bm_notify_email_job_publish);
                    update_option('job_bm_apply_method', $job_bm_apply_method);
                    update_option('job_bm_redirect_preview_link', $job_bm_redirect_preview_link);
                    update_option('job_bm_edited_job_status', $job_bm_edited_job_status);
                    update_option('job_bm_edited_redirect_link', $job_bm_edited_redirect_link);
                    update_option('job_bm_job_edit_notify_email', $job_bm_job_edit_notify_email);

                    update_option('job_bm_redirect_login', $job_bm_redirect_login);
                    update_option('job_bm_redirect_logout', $job_bm_redirect_logout);



                    update_option('job_bm_logo_url', $job_bm_logo_url);
                    update_option('job_bm_from_email', $job_bm_from_email);
                    update_option('job_bm_featured_bg_color', $job_bm_featured_bg_color);
                    update_option('job_bm_job_type_bg_color', $job_bm_job_type_bg_color);
                    update_option('job_bm_job_type_text_color', $job_bm_job_type_text_color);

                    update_option('job_bm_job_status_bg_color', $job_bm_job_status_bg_color);
                    update_option('job_bm_job_status_text_color', $job_bm_job_status_text_color);

                    update_option('job_bm_email_templates_data', $job_bm_email_templates_data);





                    ?>
                    <div class="updated notice  is-dismissible"><p><strong><?php _e('Changes Saved.', 'woocommerce-products-slider' ); ?></strong></p></div>

                    <?php
                }
            }


            ?>














            <div class="settings-tabs vertical">
                <ul class="tab-navs">
                    <?php
                    foreach ($testimonial_settings_tabs as $tab){
                        $id = $tab['id'];
                        $title = $tab['title'];
                        $active = $tab['active'];
                        $data_visible = isset($tab['data_visible']) ? $tab['data_visible'] : '';
                        $hidden = isset($tab['hidden']) ? $tab['hidden'] : false;
                        ?>
                        <li <?php if(!empty($data_visible)):  ?> data_visible="<?php echo $data_visible; ?>" <?php endif; ?> class="tab-nav <?php if($hidden) echo 'hidden';?> <?php if($active) echo 'active';?>" data-id="<?php echo $id; ?>"><?php echo $title; ?></li>
                        <?php
                    }
                    ?>
                </ul>
                <?php
                foreach ($testimonial_settings_tabs as $tab){
                    $id = $tab['id'];
                    $title = $tab['title'];
                    $active = $tab['active'];


                    ?>

                    <div class="tab-content <?php if($active) echo 'active';?>" id="<?php echo $id; ?>">
                        <?php
                        do_action('job_bm_settings_tabs_content_'.$id, $tab);
                        ?>
                    </div>
                    <?php
                }
                ?>
            </div>
            <div class="clear clearfix"></div>



            <p class="submit">
                <?php wp_nonce_field( 'job_bm_nonce' ); ?>
                <input class="button button-primary" type="submit" name="Submit" value="<?php _e('Save Changes','job-board-manager' ); ?>" />
            </p>
		</form>


</div>
