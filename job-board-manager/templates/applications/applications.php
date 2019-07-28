<?php
if ( ! defined('ABSPATH')) exit;  // if direct access

	$job_bm_job_login_page_id = get_option('job_bm_job_login_page_id');
	$job_bm_job_login_page_url = get_permalink($job_bm_job_login_page_id);
	$job_bm_login_enable = get_option('job_bm_login_enable');	
	$job_bm_registration_enable = get_option('job_bm_registration_enable');
    $job_bm_can_user_delete_application = get_option('job_bm_can_user_delete_application');



	$date_format = get_option( 'date_format' );
    $userid = get_current_user_id();

    //var_dump($_SERVER);


	?>

    <div class="nav-head"><?php echo __('Applications', 'job-board-manager'); ?></div>

	<div class="job-bm-application-list">


<!--        <form class="application-search" method="get" action="--><?php //echo $_SERVER['HTTP_REFERER'];?><!--">-->
<!---->
<!--            --><?php
//
//
//            $wp_query = new WP_Query(
//                array (
//                    'post_type' => 'job',
//                    'orderby' => 'date',
//                    'order' => 'DESC',
//                    'author' => $userid,
//                    'posts_per_page' => 10,
//
//                ) );
//
//            ?>
<!---->
<!--            <div class="">-->
<!--                <select name="job_id">-->
<!--                    <option value="">Select job</option>-->
<!---->
<!---->
<!--                    --><?php
//
//                    if ( $wp_query->have_posts() ) :
//
//                        while ( $wp_query->have_posts() ) : $wp_query->the_post();
//
//                            $job_id = get_the_id();
//
//                            ?>
<!--                            <option value="--><?php //echo $job_id; ?><!--">--><?php //echo get_the_title(); ?><!--</option>-->
<!--                        --><?php
//
//                        endwhile;
//
//                        wp_reset_query();
//
//                    else:
//
//
//                    endif;
//
//                    ?>
<!---->
<!---->
<!--                </select>-->
<!--            </div>-->
<!---->
<!--            <div>-->
<!--                <label><input name="hired" type="checkbox"> Hired</label>-->
<!--            </div>-->
<!---->
<!--            <div>-->
<!--                <label><input name="trashed" type="checkbox"> Trashed</label>-->
<!--            </div>-->
<!---->
<!--            <div>-->
<!--                <select name="star_count">-->
<!--                    <option value="">Star Count</option>-->
<!--                    <option value="1">1</option>-->
<!--                    <option value="2">2</option>-->
<!--                    <option value="3">3</option>-->
<!--                    <option value="4">4</option>-->
<!--                    <option value="5">5</option>-->
<!---->
<!---->
<!---->
<!--                </select>-->
<!--            </div>-->
<!---->
<!---->
<!--            <input type="submit" value="Submit">-->
<!---->
<!--        </form>-->
        <?php




	if ( is_user_logged_in() ){


		
		$job_bm_list_per_page = get_option('job_bm_list_per_page');
		$job_bm_job_type_bg_color = get_option('job_bm_job_type_bg_color');	
		$job_bm_job_status_bg_color = get_option('job_bm_job_status_bg_color');	
		$job_bm_featured_bg_color = get_option('job_bm_featured_bg_color');	
		$job_bm_job_edit_page_id = get_option('job_bm_job_edit_page_id');			
		
		$job_bm_job_edit_page_url = get_permalink($job_bm_job_edit_page_id);
		
		
		if(empty($job_bm_list_per_page)){
			$job_bm_list_per_page = 10;
			}
		
			if ( get_query_var('paged') ) {
			
				$paged = get_query_var('paged');
			
			} elseif ( get_query_var('page') ) {
			
				$paged = get_query_var('page');
			
			} else {
			
				$paged = 1;
			}
			
			
		$wp_query = new WP_Query(
			array (
				'post_type' => 'application',
				'orderby' => 'date',
				'order' => 'DESC',
				'author' => $userid,
				'posts_per_page' => $job_bm_list_per_page,
				'paged' => $paged,
				
				) );
		

			
		?>
        <div class="application-list">
        <?php

			
			
		$class_job_bm_functions = new class_job_bm_functions();

		$job_type_filters = $class_job_bm_functions->job_type_list();
		$job_level_filters = $class_job_bm_functions->job_level_list();
		$job_status_filters = $class_job_bm_functions->job_status_list(); 
	


		
		if ( $wp_query->have_posts() ) :
		while ( $wp_query->have_posts() ) : $wp_query->the_post();	

		    $application_id = get_the_ID();

			$job_title = get_the_title();
			$post_date = get_the_date('Y-m-d');

			$content = get_the_content();

            $user_id = get_post_meta($application_id, 'user_id', true);
            $applicant_name = get_post_meta($application_id, 'applicant_name', true);

            $job_bm_am_user_email = get_post_meta($application_id, 'job_bm_am_user_email', true);
            $job_bm_am_job_id = get_post_meta($application_id, 'job_bm_am_job_id', true);
            $job_bm_am_apply_method = get_post_meta($application_id, 'job_bm_am_apply_method', true);
            $job_bm_am_attachment = get_post_meta($application_id, 'job_bm_am_attachment', true);
            $job_bm_am_resume_id = get_post_meta($application_id, 'job_bm_am_resume_id', true);

            $applicant_name = !empty($applicant_name) ? $applicant_name : __('Anonymous','job-board-manager');


            $job_label = get_post_meta(get_the_ID(), 'job_bm_job_level',true);


            ?>
            <div class="application-card">
                <div class="card-top">
                    <span class="application-link" title="<?php echo __('Application ID.', 'job-board-manager'); ?>" class="" >#<?php echo $application_id; ?></span>
                    <div class="application-action">
                        <span class="hired"><i class="fas fa-medal"></i></span>
                        <span class="trash"><i class="far fa-trash-alt"></i></span>
                        <span class="comments"><i class="far fa-comments"></i></span>
                    </div>


                    <div class="application-rate">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>

                </div>

                <div class="card-body">
                    <div class="applicant-content"><?php echo $content; ?></div>
                    <div class="applicant-name"><i class="fas fa-user-graduate"></i> <?php echo $applicant_name; ?></div>
                    <div class="applicant-assets">

                        <?php if(!empty($job_bm_am_user_email)):?>
                        <div class="applicant-email"><i class="far fa-envelope"></i> <a href="mailto:<?php echo $job_bm_am_user_email; ?>">Email</a> </div>
                        <?php endif; ?>

                        <?php if(!empty($job_bm_am_attachment)):?>
                        <div class="applicant-attachment"><i class="fas fa-paperclip"></i> <a href="<?php echo $job_bm_am_attachment; ?>">Attachment</a> </div>
                        <?php endif; ?>

                        <?php if(!empty($job_bm_am_resume_id)):?>
                        <div class="applicant-resume"><i class="far fa-address-card"></i> <a href="<?php echo get_permalink($job_bm_am_resume_id); ?>">Resume</a> </div>
                        <?php endif; ?>

                    </div>




                </div>
                <div class="card-bottom">
                    <span class="post-date"><i class="far fa-calendar-alt"></i> <?php echo date_i18n($date_format,strtotime($post_date)); ?></span>
                    <a class="job-link" title="Job link" href="<?php echo get_permalink($job_bm_am_job_id); ?>"><i class="fas fa-external-link-square-alt"></i> <?php echo get_the_title($job_bm_am_job_id); ?></a>
                </div>

            </div>








                <?php

			endwhile;
			
			echo '<div class="paginate">';
			$big = 999999999; // need an unlikely integer
			echo paginate_links( array(
				'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format' => '?paged=%#%',
				'current' => max( 1, $paged ),
				'total' => $wp_query->max_num_pages
				) );

			echo '</div >';
	
			wp_reset_query();
			
			else:
			
			echo '<i class="fa fa-exclamation-circle" aria-hidden="true"></i> '.__('No job found posted by you.', 'job-board-manager');
			
			endif;
	

		
		}
	else{
		echo sprintf(__('Please <a href="%s">login</a> to see your application list.', 'job-board-manager' ), $job_bm_job_login_page_url );
		
		}

	?>





    </div>

        <?php

        $job_bm_pagination_bg_color = get_option('job_bm_pagination_bg_color');
        $job_bm_pagination_active_bg_color = get_option('job_bm_pagination_active_bg_color');
        $job_bm_pagination_text_color = get_option('job_bm_pagination_text_color');

        ?>

        <style type="text/css">
            .job-bm-application-list .paginate .page-numbers.current{
                background: <?php echo $job_bm_pagination_active_bg_color; ?>;
                color: <?php echo $job_bm_pagination_text_color; ?> ;
            }
            .job-bm-application-list .paginate a.page-numbers{
                background: <?php echo $job_bm_pagination_bg_color; ?>;
                color: <?php echo $job_bm_pagination_text_color; ?> ;
            }
        </style>