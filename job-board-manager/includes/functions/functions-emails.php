<?php
/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 
	
	
	

		
function job_bm_email_job_submitted($job_ID){
	
	$job_data = get_post($job_ID);
	$admin_email = get_option('admin_email');
	$job_bm_email_templates_data = get_option( 'job_bm_email_templates_data' );
	
	$site_name = get_bloginfo('name');
	$site_description = get_bloginfo('description');
	$site_url = get_bloginfo('url');
	$logo_url = get_option('job_bm_logo_url');	
	
	global $current_user;
	
	$vars = array(
		'{site_name}'=> $site_name,
		'{site_description}' => $site_description,
		'{site_url}' => $site_url,						
		'{site_logo_url}' => $logo_url,

		'{user_name}' => $current_user->display_name,						  
		'{user_avatar}' => get_avatar( $current_user->ID, 60 ),
						
		'{job_title}'  => $job_data->post_title,						  			
		'{job_url}'  => get_permalink($job_ID),
		'{job_edit_url}'  => get_admin_url().'post.php?post='.$job_ID.'&action=edit',
		'{job_id}'  => $job_ID,
		'{job_content}'  => $job_data->post_content,
	);

	
	if(empty($job_bm_email_templates_data)){
		
		$class_job_bm_emails = new class_job_bm_emails();
		$templates_data = $class_job_bm_emails->job_bm_email_templates_data();
		$job_bm_email_templates_data = $templates_data;
		
		}
	else{

		$class_job_bm_emails = new class_job_bm_emails();
		$templates_data = $class_job_bm_emails->job_bm_email_templates_data();

		$job_bm_email_templates_data =array_merge($templates_data, $job_bm_email_templates_data);
		
		}

	//$class_job_bm_emails = new class_job_bm_emails();
	//$job_bm_email_templates_data = $class_job_bm_emails->job_bm_email_templates_data();

	$email_body = strtr($job_bm_email_templates_data['new_job_submitted']['html'], $vars);
	$email_subject =strtr($job_bm_email_templates_data['new_job_submitted']['subject'], $vars);
	$email_to =strtr($job_bm_email_templates_data['new_job_submitted']['email_to'], $vars);		
	$email_from =strtr($job_bm_email_templates_data['new_job_submitted']['email_from'], $vars);	
	$email_from_name =strtr($job_bm_email_templates_data['new_job_submitted']['email_from_name'], $vars);				
	$enable =strtr($job_bm_email_templates_data['new_job_submitted']['enable'], $vars);		
	
	if($enable=='no'){ return; }
	
	
	if(empty($email_to)){
		$email_to = $admin_email;
		}
	
	if(empty($email_from)){
		$email_from = get_option('job_bm_from_email');
		}	

	if(empty($email_from_name)){
		$email_from_name = get_bloginfo('name');
		}	
		
		
	$headers = "";
	$headers .= "From: ".$email_from_name." <".$email_from."> \r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	
	
	
	wp_mail($email_to, $email_subject, $email_body, $headers);
	
	
	
	}



	
// here is action hook
add_action(  'publish_job',  'job_bm_email_job_published');
		
function job_bm_email_job_published($job_ID){
	
	$job_data = get_post($job_ID);
	
	//$post_author = $job_data->post_author;
	//$site_name = get_bloginfo('name');
	
	global $current_user;
	
		$vars = array(
			'{site_name}'=> get_bloginfo('name'),
			'{site_description}' => get_bloginfo('description'),
			'{site_url}' => get_bloginfo('url'),						
			'{site_logo_url}' => get_option('job_bm_logo_url'),
		  
			'{user_name}' => $current_user->display_name,						  
			'{user_avatar}' => get_avatar( $current_user->ID, 60 ),
			'{user_email}' => '',
										
			'{job_title}'  => $job_data->post_title,						  			
			'{job_url}'  => get_permalink($job_ID),
			'{job_edit_url}'  => get_admin_url().'post.php?post='.$job_ID.'&action=edit',						
			'{job_id}'  => $job_ID,
			'{job_content}'  => $job_data->post_content,												

		);
	
	
	
		
		$job_bm_email_templates_data = get_option( 'job_bm_email_templates_data' );
		
		
		if(empty($job_bm_email_templates_data)){
			
			$class_job_bm_emails = new class_job_bm_emails();
			$templates_data = $class_job_bm_emails->job_bm_email_templates_data();
			$job_bm_email_templates_data = $templates_data;
			
			}
		else{

			$class_job_bm_emails = new class_job_bm_emails();
			$templates_data = $class_job_bm_emails->job_bm_email_templates_data();

			$job_bm_email_templates_data =array_merge($templates_data, $job_bm_email_templates_data);
			
			}
	
		//$class_job_bm_emails = new class_job_bm_emails();
		//$job_bm_email_templates_data = $class_job_bm_emails->job_bm_email_templates_data();
	
		$email_body = strtr($job_bm_email_templates_data['new_job_published']['html'], $vars);
		$email_subject =strtr($job_bm_email_templates_data['new_job_published']['subject'], $vars);
		$email_to =strtr($job_bm_email_templates_data['new_job_published']['email_to'], $vars);		
		$email_from =strtr($job_bm_email_templates_data['new_job_published']['email_from'], $vars);			
		$enable =strtr($job_bm_email_templates_data['new_job_published']['enable'], $vars);	
		$email_from_name =strtr($job_bm_email_templates_data['new_job_published']['email_from_name'], $vars);		
		
		
		if($enable=='no'){ return; }
		
		if(empty($email_to)){
			$email_to = get_option('admin_email');
			}
		
		if(empty($email_from)){
			$email_from = get_option('job_bm_from_email');
			}		
	
		if(empty($email_from_name)){
			$email_from_name = get_bloginfo('name');
			}		
		
		
		$headers = "";
		$headers .= "From: ".$email_from_name." <".$email_from."> \r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		
		wp_mail($email_to, $email_subject, $email_body, $headers);
	
	
	
	}




	
// here is action hook
add_action(  'publish_job',  'job_bm_email_job_approved');
		
function job_bm_email_job_approved($job_ID){
	
	$job_data = get_post($job_ID);
	
	$post_author_id = $job_data->post_author;
	//$site_name = get_bloginfo('name');
	$author_obj = get_user_by('id', $post_author_id);
	
	$author_email = $author_obj->user_email;
	
	
	global $current_user;
	
		$vars = array(
			'{site_name}'=> get_bloginfo('name'),
			'{site_description}' => get_bloginfo('description'),
			'{site_url}' => get_bloginfo('url'),						
			'{site_logo_url}' => get_option('job_bm_logo_url'),
		  
			'{user_name}' => $current_user->display_name,						  
			'{user_avatar}' => get_avatar( $current_user->ID, 60 ),
			'{user_email}' => '',
										
			'{job_title}'  => $job_data->post_title,						  			
			'{job_url}'  => get_permalink($job_ID),
			'{job_edit_url}'  => get_admin_url().'post.php?post='.$job_ID.'&action=edit',						
			'{job_id}'  => $job_ID,
			'{job_content}'  => $job_data->post_content,												

		);
	
	
	
		
		$job_bm_email_templates_data = get_option( 'job_bm_email_templates_data' );
		
		
		if(empty($job_bm_email_templates_data)){
			
			$class_job_bm_emails = new class_job_bm_emails();
			$templates_data = $class_job_bm_emails->job_bm_email_templates_data();
			$job_bm_email_templates_data = $templates_data;
			
			}
		else{

			$class_job_bm_emails = new class_job_bm_emails();
			$templates_data = $class_job_bm_emails->job_bm_email_templates_data();

			$job_bm_email_templates_data =array_merge($templates_data, $job_bm_email_templates_data);
			
			}
	
		//$class_job_bm_emails = new class_job_bm_emails();
		//$job_bm_email_templates_data = $class_job_bm_emails->job_bm_email_templates_data();
	
		$email_body = strtr($job_bm_email_templates_data['new_job_approved']['html'], $vars);
		$email_subject =strtr($job_bm_email_templates_data['new_job_approved']['subject'], $vars);
		$email_to = strtr($job_bm_email_templates_data['new_job_approved']['email_to'], $vars);		
		$email_from =strtr($job_bm_email_templates_data['new_job_approved']['email_from'], $vars);			
		$enable =strtr($job_bm_email_templates_data['new_job_approved']['enable'], $vars);	
		$email_from_name =strtr($job_bm_email_templates_data['new_job_approved']['email_from_name'], $vars);		
		
		
		if($enable=='no'){ return; }
		
		if(empty($email_to)){
			$email_to = $author_email;
			}
		else{
			$email_to = $email_to.','.$author_email;
			}
		
		if(empty($email_from)){
			$email_from = get_option('job_bm_from_email');
			}		
	
		if(empty($email_from_name)){
			$email_from_name = get_bloginfo('name');
			}		
		
		
		$headers = "";
		$headers .= "From: ".$email_from_name." <".$email_from."> \r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		
		wp_mail($email_to, $email_subject, $email_body, $headers);
	
	
	
	}










