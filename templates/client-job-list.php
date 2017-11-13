<?php
/*
* @Author 		PickPlugins
* Copyright: 	2016 PickPlugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

	$job_bm_job_login_page_id = get_option('job_bm_job_login_page_id');
	$job_bm_job_login_page_url = get_permalink($job_bm_job_login_page_id);
	$job_bm_login_enable = get_option('job_bm_login_enable');	
	$job_bm_registration_enable = get_option('job_bm_registration_enable');
	
	$date_format = get_option( 'date_format' );
	

	?>
	<div class="client-job-list"">
	<?php
	
	do_action('job_bm_action_before_client_job_list');
	


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
				'post_type' => 'job',
				'orderby' => 'Date',
				'order' => 'DESC',
				'author' => $userid,
				'posts_per_page' => $job_bm_list_per_page,
				'paged' => $paged,
				
				) );
		
		echo '<h2>'.__('My Jobs', job_bm_textdomain).'</h2>';
			
		echo '<div class="client-job-list">';

			
			
		$class_job_bm_functions = new class_job_bm_functions();

		$job_type_filters = $class_job_bm_functions->job_type_list();
		$job_level_filters = $class_job_bm_functions->job_level_list();
		$job_status_filters = $class_job_bm_functions->job_status_list(); 
	


		
		if ( $wp_query->have_posts() ) :
		while ( $wp_query->have_posts() ) : $wp_query->the_post();	


			$job_title = get_the_title();
			$post_date = get_the_date('Y-m-d');
			$expiry_date = get_post_meta(get_the_ID(), 'job_bm_expire_date',true);
			$publish_status = get_post_status(get_the_ID());
			$job_status = get_post_meta(get_the_ID(), 'job_bm_job_status',true);
			$featured = get_post_meta(get_the_ID(), 'job_bm_featured',true);
			$job_type = get_post_meta(get_the_ID(), 'job_bm_job_type',true);
			
			
			
			
			$job_label = get_post_meta(get_the_ID(), 'job_bm_job_level',true);

			if($featured=='yes'){
				$featured = __('Yes', job_bm_textdomain);
				}
			else{
				$featured = __('No', job_bm_textdomain);
				}


			echo '<div class="single">';
			
			echo '<span title="'.__('Job id.', job_bm_textdomain).'">#'.get_the_ID().'</span> - <a title="'.__('Job Title.', job_bm_textdomain).'" class="title" href="'.get_permalink().'">'.$job_title.'</a>';
			
			echo '<div class="clear" ></div>';

			
			echo '<span class="post-date meta"><b>'.__('Published:', job_bm_textdomain).'</b> '.date_i18n($date_format,strtotime($post_date)).'</span>';	
			echo '<span class="expiry-date meta"><b>'.__('Expiry:', job_bm_textdomain).'</b> '.date_i18n($date_format,strtotime($expiry_date)).'</span>';			
			echo '<span class="publish-status meta"><b>'.__('Publish Status:', job_bm_textdomain).'</b> '.$publish_status.'</span>';
			
			if(!empty($job_status_filters[$job_status]))
			echo '<span class="job-status meta"><b>'.__('Job Status:', job_bm_textdomain).'</b> '.$job_status_filters[$job_status].'</span>';
			
			echo '<span class="featured meta"><b>'.__('Featured:', job_bm_textdomain).'</b> '.$featured.'</span>';
			
			if(!empty($job_type_filters[$job_type]))
			echo '<span class="type meta"><b>'.__('Job Type:', job_bm_textdomain).'</b> '.$job_type_filters[$job_type].'</span>';
			
			if(!empty($job_level_filters[$job_label]))
			echo '<span class="level meta"><b>'.__('Job Level:', job_bm_textdomain).'</b> '.$job_level_filters[$job_label].'</span>';

			echo '<div >';
			
			if($display_edit == 'yes'){
				echo '<a target="_blank" class="edit-link" href="'.$job_bm_job_edit_page_url.'?job_id='.get_the_ID().'" >'.__('Edit', job_bm_textdomain).'</a>';
				}
			
			if($display_delete == 'yes'){
				echo '<span job-id="'.get_the_ID().'" class="delete-job" href="" >'.__('Delete', job_bm_textdomain).'</span>';
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
			
			echo '<i class="fa fa-exclamation-circle" aria-hidden="true"></i> '.__('No job found posted by you.', job_bm_textdomain);
			
			endif;
	
			echo '</div>'; // .client-job-list
		
		}
	else{
		echo sprintf(__('Please <a href="%s">login</a> to see your job list.', job_bm_textdomain ), $job_bm_job_login_page_url );
		
		}



	

	do_action('job_bm_action_after_client_job_list');		
	?>
	</div>	