<?php
if ( ! defined('ABSPATH')) exit;  // if direct access

	$job_bm_job_login_page_id = get_option('job_bm_job_login_page_id');
	$job_bm_job_login_page_url = get_permalink($job_bm_job_login_page_id);
	$job_bm_login_enable = get_option('job_bm_login_enable');	
	$job_bm_registration_enable = get_option('job_bm_registration_enable');
    $job_bm_can_user_delete_application = get_option('job_bm_can_user_delete_application');



	$date_format = get_option( 'date_format' );



	?>

    <div class="nav-head"><?php echo __('My Application', 'job-board-manager'); ?></div>

	<div class="job-bm-my-jobs">
	<?php
	
	do_action('job_bm_my_applications_before');
	


	if ( is_user_logged_in() ){

		$userid = get_current_user_id();
		
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
				'orderby' => 'Date',
				'order' => 'DESC',
				'author' => $userid,
				'posts_per_page' => $job_bm_list_per_page,
				'paged' => $paged,
				
				) );
		

			
		echo '<div class="job-list">';

			
			
		$class_job_bm_functions = new class_job_bm_functions();

		$job_type_filters = $class_job_bm_functions->job_type_list();
		$job_level_filters = $class_job_bm_functions->job_level_list();
		$job_status_filters = $class_job_bm_functions->job_status_list(); 
	


		
		if ( $wp_query->have_posts() ) :
		while ( $wp_query->have_posts() ) : $wp_query->the_post();	

		    $application_id = get_the_ID();

			$job_title = get_the_title();
			$post_date = get_the_date('Y-m-d');

            $job_bm_am_job_id = get_post_meta($application_id, 'job_bm_am_job_id',true);



            $job_label = get_post_meta(get_the_ID(), 'job_bm_job_level',true);




			echo '<div class="single">';
			
			echo '<a title="'.__('Application ID.', 'job-board-manager').'" class="title" href="'.get_permalink().'">#'.$application_id.'</a>';

			?>
            <span class="post-date meta"><b><?php echo __('Job link:','job-board-manager'); ?></b> <a href="<?php echo get_permalink($job_bm_am_job_id); ?>"><?php echo get_the_title($job_bm_am_job_id); ?></a> </span>
            <?php

			echo '<span class="post-date meta"><b>'.__('Date:', 'job-board-manager').'</b> '.date_i18n($date_format,strtotime($post_date)).'</span>';


			


			


			echo '<div >';
			

			
			if($job_bm_can_user_delete_application == 'yes'){
				echo '<span job-id="'.get_the_ID().'" class="delete-job" href="" ><i class="fas fa-trash"></i> '.__('Delete', 'job-board-manager').'</span>';
				}
			
									

			echo '</div>';




			echo '</div>'; // .single
			endwhile;
			
			//echo '</table>'; 
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
	
			echo '</div>';
		
		}
	else{
		echo sprintf(__('Please <a href="%s">login</a> to see your application list.', 'job-board-manager' ), $job_bm_job_login_page_url );
		
		}

	do_action('job_bm_my_applications_after');
	?>
	</div>

    <?php

    $job_bm_pagination_bg_color = get_option('job_bm_pagination_bg_color');
    $job_bm_pagination_active_bg_color = get_option('job_bm_pagination_active_bg_color');
    $job_bm_pagination_text_color = get_option('job_bm_pagination_text_color');

    ?>

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

