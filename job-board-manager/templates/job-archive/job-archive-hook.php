<?php
if ( ! defined('ABSPATH')) exit;  // if direct access 


add_action('job_bm_job_archive_loop', 'job_bm_job_archive_loop_items');

if(!function_exists('job_bm_job_archive_loop_items')):
    function job_bm_job_archive_loop_items($job_id){


        $class_job_bm_functions = new class_job_bm_functions();


        $salary_type_list = $class_job_bm_functions->salary_type_list();
        $job_status_list = $class_job_bm_functions->job_status_list();
        $job_type_list = $class_job_bm_functions->job_type_list();
        $job_level_list = $class_job_bm_functions->job_level_list();


        $job_bm_default_company_logo = get_option('job_bm_default_company_logo');

        $job_bm_job_type = get_post_meta($job_id, 'job_bm_job_type', true);
        $job_bm_job_status = get_post_meta($job_id, 'job_bm_job_status', true);

        $job_bm_location = get_post_meta($job_id, 'job_bm_location', true);

        $job_bm_featured = get_post_meta(get_the_ID(), 'job_bm_featured', true);
        $job_bm_company_logo = get_post_meta(get_the_ID(),'job_bm_company_logo', true);

        $featured_class = ($job_bm_featured=='yes') ? 'featured' :'';
        $category = get_the_terms($job_id, 'job_category');


        ?>
        <div class="single <?php echo $featured_class; ?>">

            <?php

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
            <div class="company_logo">
                <img src="<?php echo $job_bm_company_logo; ?>" />
            </div>

            <div title="" class="title"><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></div>

            <div class="clear"></div>
            <div class="job-meta">

                <?php if($job_bm_featured =='yes'):?>
                    <span class="post-date meta-item featured"><i class="far fa-star"></i>  <?php echo __('Featured'); ?></span>
                <?php endif; ?>

                <span class="meta-item job_type <?php echo $job_bm_job_type; ?>"><i class="fas
                fa-briefcase"></i>  <?php echo
                    $job_type_list[$job_bm_job_type]; ?></span>

                <span class="post-date meta-item job_status <?php echo $job_bm_job_status; ?>"><i class="fas
            fa-traffic-light"></i> <?php echo $job_status_list[$job_bm_job_status]; ?></span>


                <span class="post-date meta-item"><i class="fas fa-map-marker-alt"></i>  <?php echo $job_bm_location; ?></span>

                <span class="post-date meta-item"><i class="far fa-calendar-alt"></i> <?php echo sprintf(__('Posted %s ago','job-board-manager'), human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) )?></span>

                <?php

                if(!empty($category[0]->name)):
                    ?>

<!--                    <span class="post-date meta-item"><i class="fas fa-code-branch"></i> --><?php //echo sprintf(__('Posted on %s','job-board-manager'), '<a href="#">'.$category[0]->name.'</a>' )?><!--</span>-->

                <?php
                endif;

                ?>


            </div>

        </div>
        <?php



    }
endif;