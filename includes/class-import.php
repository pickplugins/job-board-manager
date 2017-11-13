<?php

/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

class class_job_bm_import {
	
	public function __construct(){

		//add_action('add_meta_boxes', array($this, 'meta_boxes_job'));
		//add_action('save_post', array($this, 'meta_boxes_job_save'));

		}
		

	public function job_bm_import_job_data($job_data){
		
			$taxonomy = $job_data['taxonomy'];			
			$taxonomy_terms = $job_data['taxonomy_terms'];	
				
			$job_bm_is_imported = $job_data['job_bm_is_imported'];
			$job_bm_import_source = $job_data['job_bm_import_source'];
			$job_bm_import_source_jobid = $job_data['job_bm_import_source_jobid'];
		
		
			$class_job_bm_functions = new class_job_bm_functions();			
			$post_type_input_fields = $class_job_bm_functions->post_type_input_fields();
		
		
			$meta_fields_data = $post_type_input_fields['meta_fields'];
		
			$job_info_meta = $meta_fields_data['job_info']['meta_fields'];
		
			$job_info_meta = array_merge($job_info_meta, 
											
										array(

												'job_bm_is_imported'=>array(
													'meta_key'=>'job_bm_is_imported',
													'css_class'=>'is_imported hidden',					
													'title'=>__('Is imported ?',job_bm_textdomain),
													'option_details'=>__('Is imported',job_bm_textdomain),						
													'input_type'=>'hidden', // text, radio, checkbox, select, 
													'input_values'=> 'no', // could be array
													),		
													
													
												'job_bm_import_source'=>array(
													'meta_key'=>'job_bm_import_source',
													'css_class'=>'import_source hidden',					
													'title'=>__('Import source ?',job_bm_textdomain),
													'option_details'=>__('Import source',job_bm_textdomain),						
													'input_type'=>'hidden', // text, radio, checkbox, select, 
													'input_values'=> '', // could be array
													),																	
																					
													
												'job_bm_import_source_jobid'=>array(
													'meta_key'=>'job_bm_import_source_jobid',
													'css_class'=>'import_source_jobid hidden',					
													'title'=>__('Import source jobid ?',job_bm_textdomain),
													'option_details'=>__('Import source jobid',job_bm_textdomain),						
													'input_type'=>'hidden', // text, radio, checkbox, select, 
													'input_values'=> '', // could be array
													),
										
										
											)
			
										);
			
		
		
			$meta_fields_data['job_info']['meta_fields'] = $job_info_meta;
		
		
		
		
			//var_dump($meta_fields_data);
		
		
		
		
			$meta_query[] = array(
									'key' => 'job_bm_import_source',
									'value' => $job_bm_import_source,
									'compare' => '=',
									
								);
								
			$meta_query[] = array(
									'key' => 'job_bm_import_source_jobid',
									'value' => $job_bm_import_source_jobid,
									'compare' => '=',
									
								);					
					
		
		
			$wp_query = new WP_Query(
				array (
					'post_type' => 'job',
					'post_status' => 'any',
					'meta_query' => $meta_query,
					'posts_per_page' => -1,
					) );
		
		
			if ( $wp_query->have_posts() ) :
			// No post insert.
			else:
		
		
		
			$job_bm_submitted_job_status = get_option('job_bm_submitted_job_status');
		
			if ( is_user_logged_in() ) 
				{
					$userid = get_current_user_id();
				}
			else{
					$userid = 1;
				}
		
			$post_title = sanitize_text_field($job_data['post_title']);
			$post_content = $job_data['post_content'];				
			
			$job_post = array(
			  'post_title'    => $post_title,
			  'post_content'  => $post_content,
			  'post_status'   => $job_bm_submitted_job_status,
			  'post_type'   => 'job',
			  'post_author'   => $userid,
			);
			
			// Insert the post into the database
			//wp_insert_post( $my_post );
			$job_ID = wp_insert_post($job_post);
		
			wp_set_post_terms( $job_ID, $taxonomy_terms, $taxonomy );
			

		
					
			$class_job_bm_error_log = new class_job_bm_error_log();
			

					foreach($meta_fields_data as $key=>$meta_fields_group){
						
						$meta_fields = $meta_fields_group['meta_fields'];
						
						foreach($meta_fields as $option_key=>$option_info){
							
							if(!empty($job_data[$option_key])){

								$option_value = $job_data[$option_key];
								$option_value = job_bm_sanitize_data($option_info['input_type'],$job_data[$option_key]);
								}
							else{
								
								$option_value = '';
								}

							
							$success = update_post_meta($job_ID, $option_key , $option_value);
							
							if($success){
								$error_log_data[] = array('type'=>'add_meta','status'=>'success','message'=> __(sprintf('%s - Job post meta added successful',$job_ID),job_bm_textdomain));
								}
							else{
								$error_log_data[] = array('type'=>'add_meta','status'=>'failed','message'=>__(sprintf('%s - Job post meta added failed',$job_ID),job_bm_textdomain));
								}
							
							//$class_job_bm_error_log->job_bm_error_data($error_log_data);
							
							}

						}

		
		endif;

		}

	}
	
//new class_job_bm_import();