<?php
/*
* @Author 		PickPlugins
* Copyright: 	2015 PickPlugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 




	$cookie_name = 'job_bm_view';
	$job_id = get_the_ID();
	$job_bm_view_count = get_post_meta(get_the_ID(),'job_bm_view_count', true);
	
	
	if(isset($_COOKIE[$cookie_name.'_'.$job_id])){
		
			//var_dump($_COOKIE[$cookie_name.'_'.$q_id]);
			//var_dump($job_bm_view_count);		
			
		}
	else{
			//var_dump('No');
		
			setcookie( $cookie_name.'_'.$job_id, $job_id, time() + (86400 * 30)); // 86400 = 1 day
			
			update_post_meta(get_the_ID(), 'job_bm_view_count', ($job_bm_view_count+1));
		}



		get_header();

		do_action('job_bm_action_before_single_job');

		while ( have_posts() ) : the_post(); 
		?>
        <div itemscope itemtype="http://schema.org/JobPosting" id="job-<?php the_ID(); ?>" <?php post_class('job-single entry-content'); ?>>
        
		<?php do_action('job_bm_action_single_job_main'); ?>
        
		<div class="clear"></div>
        </div>
		<?php
		endwhile;
        do_action('job_bm_action_after_single_job');

		get_footer();
		
