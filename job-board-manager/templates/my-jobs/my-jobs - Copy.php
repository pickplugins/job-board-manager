<?php
if ( ! defined('ABSPATH')) exit;  // if direct access

$job_bm_pagination_bg_color         = get_option('job_bm_pagination_bg_color');
$job_bm_pagination_active_bg_color  = get_option('job_bm_pagination_active_bg_color');
$job_bm_pagination_text_color       = get_option('job_bm_pagination_text_color');
$job_bm_job_login_page_id           = get_option('job_bm_job_login_page_id');
$job_bm_job_login_page_url          = get_permalink($job_bm_job_login_page_id);
$job_bm_login_enable                = get_option('job_bm_login_enable');
$job_bm_registration_enable         = get_option('job_bm_registration_enable');
$date_format                        = get_option( 'date_format' );



?>
<div class="nav-head"><?php echo __('My Jobs', 'job-board-manager'); ?></div>
	<div class="job-bm-my-jobs">
	<?php
	do_action('job_bm_my_jobs_before');

	if ( is_user_logged_in() ){

		$userid                     = get_current_user_id();
		$job_bm_list_per_page       = get_option('job_bm_list_per_page');
		$job_bm_job_type_bg_color   = get_option('job_bm_job_type_bg_color');
		$job_bm_job_status_bg_color = get_option('job_bm_job_status_bg_color');	
		$job_bm_featured_bg_color   = get_option('job_bm_featured_bg_color');
		$job_bm_job_edit_page_id    = get_option('job_bm_job_edit_page_id');
		$job_bm_job_edit_page_url   = get_permalink($job_bm_job_edit_page_id);
        $job_bm_list_per_page       = !empty($job_bm_list_per_page) ? $job_bm_list_per_page : 10;


		
        if ( get_query_var('paged') ) {
            $paged = get_query_var('paged');
        } elseif ( get_query_var('page') ) {
            $paged = get_query_var('page');
        } else {
            $paged = 1;
        }
			
			
		$wp_query = new WP_Query(
			array (
				'post_type' => 'job',
				'orderby' => 'date',
				'order' => 'DESC',
				'author' => $userid,
				'posts_per_page' => $job_bm_list_per_page,
				'paged' => $paged,
            )
        );

		?>
        <div class="job-list">
        <?php

		$class_job_bm_functions = new class_job_bm_functions();
        $class_job_bm_applications = new class_job_bm_applications();

		$job_type_filters = $class_job_bm_functions->job_type_list();
		$job_level_filters = $class_job_bm_functions->job_level_list();
		$job_status_filters = $class_job_bm_functions->job_status_list(); 
	

		if ( $wp_query->have_posts() ) :
            while ( $wp_query->have_posts() ) : $wp_query->the_post();

                $job_id         = get_the_id();
                $job_title      = get_the_title();
                $post_date      = get_the_date('Y-m-d');
                $expiry_date    = get_post_meta(get_the_ID(), 'job_bm_expire_date',true);
                $publish_status = get_post_status(get_the_ID());
                $job_status     = get_post_meta(get_the_ID(), 'job_bm_job_status',true);
                $featured       = get_post_meta(get_the_ID(), 'job_bm_featured',true);
                $job_type       = get_post_meta(get_the_ID(), 'job_bm_job_type',true);
                $job_label = get_post_meta(get_the_ID(), 'job_bm_job_level',true);

                $application_count = $class_job_bm_applications->application_count_by_job_id($job_id);

                $featured = ($featured == 'yes') ? __('Yes', 'job-board-manager') : __('No', 'job-board-manager');



			?>
            <div class="single">
                <span title="<?php echo __('Job id.', 'job-board-manager'); ?>">#<?php echo get_the_ID(); ?></span> - <a title="<?php echo __('Job Title.', 'job-board-manager'); ?>" class="title" href="<?php echo get_permalink(); ?>"><?php echo $job_title; ?></a>
                <span class="post-date meta"><b><?php echo __('Published:', 'job-board-manager'); ?></b> <?php echo date_i18n($date_format,strtotime($post_date)); ?></span>
                <span class="publish-status meta"><b><?php echo __('Publish Status:', 'job-board-manager'); ?></b> <?php echo $publish_status; ?></span>
                <span class="featured meta"><b><?php echo __('Featured:', 'job-board-manager'); ?></b> <?php echo $featured; ?></span>
                <?php


                if(!empty($job_status_filters[$job_status])):
                    ?>
                    <span class="job-status meta"><b><?php echo __('Job Status:', 'job-board-manager'); ?></b> <?php echo $job_status_filters[$job_status]; ?></span>
                    <?php
                endif;




                if(!empty($job_type_filters[$job_type])):
                    ?>
                    <span class="type meta"><b><?php echo __('Job Type:', 'job-board-manager'); ?></b> <?php echo $job_type_filters[$job_type]; ?></span>
                    <?php
                endif;


                if(!empty($job_level_filters[$job_label])):
                    ?>
                    <span class="level meta"><b><?php echo __('Job Level:', 'job-board-manager'); ?></b> <?php echo $job_level_filters[$job_label]; ?></span>
                    <?php
                endif;

                ?>
                <span class="applications meta"><b><?php echo __('Applications:', 'job-board-manager'); ?></b> <a href="#"><?php echo $application_count; ?></a> </span>

                <div>
                <?php

                if($display_edit == 'yes'){
                    ?>
                    <a target="_blank" class="edit-link" href="<?php echo $job_bm_job_edit_page_url; ?>?job_id='.get_the_ID().'" ><i class="fas fa-pen"></i> <?php echo __('Edit', 'job-board-manager'); ?></a>
                    <?php
                }

                if($display_delete == 'yes'){
                    ?>
                    <span job-id="<?php echo get_the_ID(); ?>" class="delete-job" href="" ><i class="fas fa-trash"></i> <?php echo __('Delete', 'job-board-manager'); ?></span>
                    <?php
                }

                ?>
                </div>
            </div>
            <?php

			endwhile;
			
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
	
			wp_reset_query();
			
			else:

                echo sprintf(__('%s No job found posted by you.', 'job-board-manager'), '<i class="fa fa-exclamation-circle" aria-hidden="true"></i>');

			endif;
	

        ?>
        </div>
        <?php
	}
	else{
		echo sprintf(__('Please <a href="%s">login</a> to see your jobs.', 'job-board-manager' ), $job_bm_job_login_page_url );

	}

	do_action('job_bm_my_jobs_after');
	?>
	</div>



    <style type="text/css">
        .job-list .paginate .page-numbers.current{
            background: <?php echo $job_bm_pagination_active_bg_color; ?>;
            color: <?php echo $job_bm_pagination_text_color; ?> ;
        }
        .job-list .paginate a.page-numbers{
            background: <?php echo $job_bm_pagination_bg_color; ?>;
            color: <?php echo $job_bm_pagination_text_color; ?> ;
        }
    </style>

