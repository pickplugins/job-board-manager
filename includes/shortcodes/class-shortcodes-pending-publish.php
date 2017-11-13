<?php

/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

class class_job_bm_shortcodes_job_post_status{
	
    public function __construct(){
		
		add_shortcode( 'job_bm_post_status', array( $this, 'job_bm_post_status' ) );

   		}

	public function job_bm_post_status($atts, $content = null ) {


		$atts = shortcode_atts(
			array(
				'posts_per_page' => 20,
				'status_from' => 'pending',				
				'status_to' => 'publish',			
				
																		
				), $atts);

		
		$posts_per_page = $atts['posts_per_page'];
		$status_from = $atts['status_from'];		
		$status_to = $atts['status_to'];			


		$wp_query = new WP_Query(
			array (
				'post_type' => 'job',
				'post_status' => $status_from,
				'orderby' => 'Date',
				'order' => 'DESC',
				'posts_per_page' =>$posts_per_page,
	
				
				) );
			
			$html= '';
			$html.= '<ul>';	
		if ( $wp_query->have_posts() ) :
		while ( $wp_query->have_posts() ) : $wp_query->the_post();	
				
		//wp_publish_post(get_the_ID());	
				
				
		// Update post 37
		  $my_post = array(
				'ID'           => get_the_ID(),
				'post_status' => $status_to,
		  );
		
		// Update the post into the database
		  wp_update_post( $my_post );
				
				
				
				
				
		$html.= '<li>'.$status_to.' - '.get_the_title().'</li>';		
				
		endwhile;
		
		$html.= '</ul>';	

		wp_reset_query();
		else:
		
		echo __('No job found',job_bm_textdomain);	
		
		endif;		
			
		return $html;
		
		}
	
			
	}
	
new class_job_bm_shortcodes_job_post_status();