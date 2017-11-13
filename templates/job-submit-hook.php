<?php
/*
* @Author 		PickPlugins
* Copyright: 	2015 PickPlugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 



function job_bm_action_before_job_submit_set_session(){
	
	$class_job_bm_functions = new class_job_bm_functions();
	$post_type_input_fields = $class_job_bm_functions->post_type_input_fields();
	
	
	$post_taxonomies = $post_type_input_fields['post_taxonomies'];
	$job_category = $post_taxonomies['job_category'];
	
	$job_title = $post_type_input_fields['post_title'];	
	$job_content = $post_type_input_fields['post_content'];	
	
	$meta_fields = $post_type_input_fields['meta_fields'];
	
	
	
	//var_dump($_POST['post_title']);
	//var_dump($_POST['post_title']);
	//var_dump($_POST['post_content']);	
	
	
	foreach($meta_fields as $meta_field){
		
		$meta_fields = $meta_field['meta_fields'];
		
		foreach($meta_fields as $field){
			
			$meta_key = $field['meta_key'];
			
			//var_dump($_POST{$meta_key});

			
			}
		
		
		
		}
	
	
	//var_dump($meta_fields);
	
	if(!empty($_POST)){
		
	$_SESSION["job_bm_job_data"] = array(
	
										'post_title'=>$_POST['post_title'],
										'post_content'=>$_POST['post_content'],										
										'job_category'=>$_POST['job_category'],
										'meta_fields'=>$meta_fields,																						

										
										);
		
		}
		
		

		//var_dump($_POST['post_title']);
	
	//var_dump($_POST);
	}
	
	
//add_action('job_bm_action_before_job_submit','job_bm_action_before_job_submit_set_session');