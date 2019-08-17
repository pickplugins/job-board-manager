<?php
if ( ! defined('ABSPATH')) exit;  // if direct access 







add_action('job_bm_job_archive_loop_before', 'job_bm_job_archive_before_search');

if(!function_exists('job_bm_job_archive_before_search')){
    function job_bm_job_archive_before_search($wp_query){


        $job_bm_archive_page_id = get_option('job_bm_archive_page_id');
        $job_bm_archive_page_url = get_permalink($job_bm_archive_page_id);


        $class_job_bm_functions = new class_job_bm_functions();
        $job_type_list = array_filter($class_job_bm_functions->job_type_list());


        if(!empty($_GET['job_type'])){

            $job_type = stripslashes_deep($_GET['job_type']);

            if(!is_array($job_type)){

                $job_type = array($job_type);

            }

        }


        //echo '<pre>'.var_export($job_type_list, true).'</pre>';

        ?>

        <form class="search-input" method="get" action="<?php echo $job_bm_archive_page_url; ?>">

            <div class="option half">
                <input placeholder="<?php echo __('Keyword', 'job-board-manager'); ?>" name="keywords" type="search" value="<?php if(!empty($_GET['keywords'])) echo sanitize_text_field($_GET['keywords']) ?>" />

            </div>

            <div class="option half">

                <input placeholder="<?php echo __('Location', 'job-board-manager'); ?>" name="locations" type="search" value="<?php if(!empty($_GET['locations'])) echo sanitize_text_field($_GET['locations']) ?>" />
            </div>



            <div class="option">
                <?php

                foreach($job_type_list as $job_type_key=>$job_type_name){

                    if(!empty($job_type_key)):
                        ?>
                        <label>
                            <input type="checkbox" <?php if( !empty($job_type) && in_array($job_type_key, $job_type) ) echo 'checked'; ?>  name="job_type[]" value="<?php echo $job_type_key; ?>" /> <?php echo $job_type_name; ?>
                        </label>
                    <?php
                    endif;

                }


                ?>


            </div>

            <input type="submit" value="<?php echo __('Submit', 'job-board-manager'); ?>" />

        </form> <!-- .search-input -->
        <?php

    }
}







add_action('job_bm_job_archive_loop', 'job_bm_job_archive_loop_items');

if(!function_exists('job_bm_job_archive_loop_items')):
    function job_bm_job_archive_loop_items($job_id){


        $class_job_bm_functions = new class_job_bm_functions();


        $salary_type_list = $class_job_bm_functions->salary_type_list();
        $job_status_list = $class_job_bm_functions->job_status_list();
        $job_type_list = $class_job_bm_functions->job_type_list();
        $job_level_list = $class_job_bm_functions->job_level_list();

        $job_bm_company_name = get_post_meta(get_the_ID(), 'job_bm_company_name', true);

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

            <?php if(!empty($job_bm_location)): ?>
            <div class="company-name"><?php echo apply_filters('job_bm_job_archive_loop_item_company', $job_bm_company_name); ?></div>
            <?php endif; ?>

            <div class="clear"></div>
            <div class="job-meta">

                <?php if(isset($job_type_list[$job_bm_job_type])):?>
                <span class="meta-item job_type <?php echo $job_bm_job_type; ?>"><i class="fas
                fa-briefcase"></i>  <?php echo
                    $job_type_list[$job_bm_job_type]; ?></span>
                <?php endif; ?>

                <?php if(isset($job_status_list[$job_bm_job_status])):?>
                <span class=" meta-item job_status <?php echo $job_bm_job_status; ?>"><i class="fas
            fa-traffic-light"></i> <?php echo $job_status_list[$job_bm_job_status]; ?></span>
                <?php endif; ?>


                <?php if(!empty($job_bm_location)): ?>
                <span class="job-location meta-item"><i class="fas fa-map-marker-alt"></i> <?php echo apply_filters('job_bm_job_archive_loop_item_location', $job_bm_location); ?></span>
                <?php endif; ?>

                <span class="job-post-date meta-item"><i class="far fa-calendar-alt"></i> <?php echo sprintf(__('Posted %s ago','job-board-manager'), human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) )?></span>

                <?php

                if(!empty($category[0]->name)):
                    ?>

<!--                    <span class=" meta-item"><i class="fas fa-code-branch"></i> --><?php //echo sprintf(__('Posted on %s','job-board-manager'), '<a href="#">'.$category[0]->name.'</a>' )?><!--</span>-->

                <?php
                endif;

                ?>


            </div>

        </div>
        <?php



    }
endif;







add_action('job_bm_job_archive_loop_after', 'job_bm_job_archive_after_pagination',1,90);

if(!function_exists('job_bm_job_archive_after_pagination')){
    function job_bm_job_archive_after_pagination($wp_query){

        if ( get_query_var('paged') ) {$paged = get_query_var('paged');}
        elseif ( get_query_var('page') ) {$paged = get_query_var('page');}
        else {$paged = 1;}

        //global $wp_query;
        //var_dump($wp_query->max_num_pages);

        ?>
        <div class="paginate">
        <?php
        $big = 999999999; // need an unlikely integer
        echo paginate_links( array(
            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format' => '?paged=%#%',
            'current' => max( 1, $paged ),
            'total' => $wp_query->max_num_pages
        ) );

        ?>
        </div>
        <?php

    }
}




add_action('job_bm_job_archive_loop_after', 'job_bm_job_archive_after_style',1,90);

if(!function_exists('job_bm_job_archive_after_style')){
    function job_bm_job_archive_after_style($wp_query){

        $job_bm_featured_bg_color = get_option('job_bm_featured_bg_color');
        $job_bm_job_type_bg_color = get_option('job_bm_job_type_bg_color');
        $job_bm_job_type_text_color = get_option('job_bm_job_type_text_color');
        $job_bm_job_status_bg_color = get_option('job_bm_job_status_bg_color');
        $job_bm_job_status_text_color = get_option('job_bm_job_status_text_color');

        $job_bm_pagination_bg_color = get_option('job_bm_pagination_bg_color');
        $job_bm_pagination_active_bg_color = get_option('job_bm_pagination_active_bg_color');
        $job_bm_pagination_text_color = get_option('job_bm_pagination_text_color');


        ?>
        <style type="text/css">
            <?php

            echo '.job-list .single.featured{background:'.$job_bm_featured_bg_color.'}';

            if(!empty($job_bm_job_type_bg_color)){
                foreach($job_bm_job_type_bg_color as $job_type_key=>$job_type_color){

                    echo '.job-list .job_type.'.$job_type_key.'{background:'.$job_type_color.'}';
                }
            }

            if(!empty($job_bm_job_type_text_color)){
                foreach($job_bm_job_type_text_color as $job_type_key=>$job_type_color){

                    echo '.job-list .job_type.'.$job_type_key.'{color:'.$job_type_color.'}';
                }
            }



            if(!empty($job_bm_job_status_bg_color)){
                foreach($job_bm_job_status_bg_color as $job_status_key=>$job_status_color){
                    echo '.job-list .job_status.'.$job_status_key.'{background:'.$job_status_color.'}';
                }
            }

            if(!empty($job_bm_job_status_text_color)){
                foreach($job_bm_job_status_text_color as $job_status_key=>$job_status_color){
                    echo '.job-list .job_status.'.$job_status_key.'{color:'.$job_status_color.'}';
                }
            }





            ?>

            .job-list .paginate .page-numbers.current{
                background: <?php echo $job_bm_pagination_active_bg_color; ?>;
                color: <?php echo $job_bm_pagination_text_color; ?> ;
            }
            .job-list .paginate a.page-numbers{
                background: <?php echo $job_bm_pagination_bg_color; ?>;
                color: <?php echo $job_bm_pagination_text_color; ?> ;
            }

        </style>
        <?php

    }
}








