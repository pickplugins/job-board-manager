<?php

/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

class class_job_bm_emails{
	
	public function __construct(){

		//add_action('add_meta_boxes', array($this, 'meta_boxes_job'));
		//add_action('save_post', array($this, 'meta_boxes_job_save'));

		}
		
		
		
	public function job_bm_send_email($email_data){
		
		//$to_email='', $email_subject='', $email_body='', $attachments=''
		
		
		$email_to = $email_data['email_to'];	
		$email_from = $email_data['email_from'];			
		$email_from_name = $email_data['email_from_name'];
		$subject = $email_data['subject'];
		$email_body = $email_data['html'];		
		$email_subject = $email_data['subject'];			
		$enable = $email_data['enable'];
		$attachments = $email_data['attachments'];		
					
		
		
		//$job_bm_from_email = get_option('job_bm_from_email');
		//$site_name = get_bloginfo('name');

		$headers = "";
		$headers .= "From: ".$email_from_name." ".$email_from." \r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

		$status = wp_mail($email_to, $subject, $email_body, $headers, $attachments);
		
		return $status;
		
		}	
		
		
		
		
		

	public function job_bm_email_templates_data(){
		
		$templates_data_html = array();
		
		include( 'emails-templates-part/new_job_submitted.php');	
		include( 'emails-templates-part/new_job_published.php');
		include( 'emails-templates-part/new_job_approved.php');		
					
		
		$templates_data = array(
							
			'new_job_submitted'=>array(	'name'=>__('New Job Submitted', job_bm_textdomain),
										'description'=>__('Notification email for admin when user submitted job.', job_bm_textdomain),			
										'subject'=>__('New Job Submitted - {site_url}', job_bm_textdomain),
										'html'=>$templates_data_html['new_job_submitted'],
										'email_to'=>get_option('admin_email'),
										'email_from'=>get_option('admin_email'),
										'email_from_name'=> get_bloginfo('name'),																		
										'enable'=> 'yes',										
									),
									
			'new_job_published'=>array(	'name'=>__('New Job Published', job_bm_textdomain),
										'description'=>__('Notification email for admin when someone published job.', job_bm_textdomain),
										'subject'=>__('New Job Published - {site_url}', job_bm_textdomain),
										'html'=>$templates_data_html['new_job_published'],
										'email_to'=>get_option('admin_email'),
										'email_from'=>get_option('admin_email'),
										'email_from_name'=> get_bloginfo('name'),										
										'enable'=> 'yes',
									),									
			
			'new_job_approved'=>array(	'name'=>__('New Job Approved', job_bm_textdomain),
										'description'=>__('Notification email for job poster when admin published job.', job_bm_textdomain),
										'subject'=>__('New Job Approved - {site_url}',job_bm_textdomain),
										'html'=>$templates_data_html['new_job_approved'],
										'email_to'=>'',
										'email_from'=>get_option('admin_email'),
										'email_from_name'=> get_bloginfo('name'),										
										'enable'=> 'yes',
						
									),				
			
			
			
			
			
			
			

		);
		
		$templates_data = apply_filters('job_bm_filters_email_templates_data', $templates_data);
		
		return $templates_data;

		}
		


	public function job_bm_email_templates_parameters(){
		
		
			$parameters['site_parameter'] = array(
												'title'=>__('Site Parameters', job_bm_textdomain),
												'parameters'=>array('{site_name}','{site_description}','{site_url}','{site_logo_url}'),										
												);
												
			$parameters['user_parameter'] = array(
												'title'=>__('Users Parameters', job_bm_textdomain),
												'parameters'=>array('{user_name}','{user_avatar}','{user_email}'),										
												);	
												
			$parameters['job_parameter'] = array(
												'title'=>__('Job Parameters', job_bm_textdomain),
												'parameters'=>array('{job_id}','{job_edit_url}','{job_title}','{job_shortcontent}','{job_url}'),										
												);										
																					
			$parameters['job_application'] = array(
												'title'=>__('Job application', job_bm_textdomain),
												'parameters'=>array('{appliction_content}','{appliction_url}'),										
												);																
		
												
			$parameters = apply_filters('job_bm_emails_templates_parameters',$parameters);
		
		
			return $parameters;
		
		}
		

	}
	
new class_job_bm_emails();