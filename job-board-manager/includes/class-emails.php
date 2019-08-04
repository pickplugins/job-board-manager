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
		
		include( job_bm_plugin_dir.'templates/emails-templates/application_hire.php');
        include( job_bm_plugin_dir.'templates/emails-templates/application_new_comment.php');
        include( job_bm_plugin_dir.'templates/emails-templates/application_not_hire.php');
        include( job_bm_plugin_dir.'templates/emails-templates/application_rate.php');
        include( job_bm_plugin_dir.'templates/emails-templates/application_submitted.php');
        include( job_bm_plugin_dir.'templates/emails-templates/application_trash.php');
        include( job_bm_plugin_dir.'templates/emails-templates/job_edited.php');
        include( job_bm_plugin_dir.'templates/emails-templates/job_featured.php');
        include( job_bm_plugin_dir.'templates/emails-templates/job_published.php');
        include( job_bm_plugin_dir.'templates/emails-templates/job_submitted.php');
        include( job_bm_plugin_dir.'templates/emails-templates/job_trash.php');





		
		$templates_data = array(

            'application_hire'=>array(
                'name'=>__('Application hire', 'job-board-manager'),
                'description'=>__('Notification email for when application hired.', 'job-board-manager'),
                'subject'=>__('Your application hired - {site_url}', 'job-board-manager'),
                'html'=>$templates_data_html['application_hire'],
                'email_to'=>get_option('admin_email'),
                'email_from'=>get_option('admin_email'),
                'email_from_name'=> get_bloginfo('name'),
                'enable'=> 'yes',
            ),

            'application_new_comment'=>array(
                'name'=>__('New comment on application', 'job-board-manager'),
                'description'=>__('Notification email for when new comment posted on application.', 'job-board-manager'),
                'subject'=>__('New comment on application - {site_url}', 'job-board-manager'),
                'html'=>$templates_data_html['application_new_comment'],
                'email_to'=>get_option('admin_email'),
                'email_from'=>get_option('admin_email'),
                'email_from_name'=> get_bloginfo('name'),
                'enable'=> 'yes',
            ),

            'application_not_hire'=>array(
                'name'=>__('Your application hire removed', 'job-board-manager'),
                'description'=>__('Notification email for application hire removed.', 'job-board-manager'),
                'subject'=>__('Application hire removed - {site_url}', 'job-board-manager'),
                'html'=>$templates_data_html['application_not_hire'],
                'email_to'=>get_option('admin_email'),
                'email_from'=>get_option('admin_email'),
                'email_from_name'=> get_bloginfo('name'),
                'enable'=> 'yes',
            ),

            'application_rate'=>array(
                'name'=>__('Your application rated', 'job-board-manager'),
                'description'=>__('Notification email for application rated.', 'job-board-manager'),
                'subject'=>__('Application rated - {site_url}', 'job-board-manager'),
                'html'=>$templates_data_html['application_rate'],
                'email_to'=>get_option('admin_email'),
                'email_from'=>get_option('admin_email'),
                'email_from_name'=> get_bloginfo('name'),
                'enable'=> 'yes',
            ),

            'application_submitted'=>array(
                'name'=>__('Application submitted', 'job-board-manager'),
                'description'=>__('Notification email for application submitted.', 'job-board-manager'),
                'subject'=>__('Application submitted - {site_url}', 'job-board-manager'),
                'html'=>$templates_data_html['application_submitted'],
                'email_to'=>get_option('admin_email'),
                'email_from'=>get_option('admin_email'),
                'email_from_name'=> get_bloginfo('name'),
                'enable'=> 'yes',
            ),


            'application_trash'=>array(
                'name'=>__('Application trashed', 'job-board-manager'),
                'description'=>__('Notification email for application trashed.', 'job-board-manager'),
                'subject'=>__('Application trashed - {site_url}', 'job-board-manager'),
                'html'=>$templates_data_html['application_trash'],
                'email_to'=>get_option('admin_email'),
                'email_from'=>get_option('admin_email'),
                'email_from_name'=> get_bloginfo('name'),
                'enable'=> 'yes',
            ),



            'job_edited'=>array(
                'name'=>__('Job Edited', 'job-board-manager'),
                'description'=>__('Notification email for admin when user edited job.', 'job-board-manager'),
                'subject'=>__('Job Edited - {site_url}', 'job-board-manager'),
                'html'=>$templates_data_html['job_edited'],
                'email_to'=>get_option('admin_email'),
                'email_from'=>get_option('admin_email'),
                'email_from_name'=> get_bloginfo('name'),
                'enable'=> 'yes',
            ),


            'job_featured'=>array(
                'name'=>__('Job featured', 'job-board-manager'),
                'description'=>__('Notification email for admin featured a job.', 'job-board-manager'),
                'subject'=>__('Job featured - {site_url}', 'job-board-manager'),
                'html'=>$templates_data_html['job_featured'],
                'email_to'=>get_option('admin_email'),
                'email_from'=>get_option('admin_email'),
                'email_from_name'=> get_bloginfo('name'),
                'enable'=> 'yes',
            ),

            'job_published'=>array(
                'name'=>__('Job published', 'job-board-manager'),
                'description'=>__('Notification email for admin published a job.', 'job-board-manager'),
                'subject'=>__('Job published - {site_url}', 'job-board-manager'),
                'html'=>$templates_data_html['job_published'],
                'email_to'=>get_option('admin_email'),
                'email_from'=>get_option('admin_email'),
                'email_from_name'=> get_bloginfo('name'),
                'enable'=> 'yes',
            ),


            'job_submitted'=>array(
                'name'=>__('New Job Submitted', 'job-board-manager'),
                'description'=>__('Notification email for user submitted job.', 'job-board-manager'),
                'subject'=>__('New Job Submitted - {site_url}', 'job-board-manager'),
                'html'=>$templates_data_html['job_submitted'],
                'email_to'=>get_option('admin_email'),
                'email_from'=>get_option('admin_email'),
                'email_from_name'=> get_bloginfo('name'),
                'enable'=> 'yes',
            ),

            'job_trash'=>array(
                'name'=>__('New Job trashed', 'job-board-manager'),
                'description'=>__('Notification email for trash job.', 'job-board-manager'),
                'subject'=>__('Job trashed - {site_url}', 'job-board-manager'),
                'html'=>$templates_data_html['job_trash'],
                'email_to'=>get_option('admin_email'),
                'email_from'=>get_option('admin_email'),
                'email_from_name'=> get_bloginfo('name'),
                'enable'=> 'yes',
            ),
			
			

		);
		
		$templates_data = apply_filters('job_bm_email_templates_data', $templates_data);
		
		return $templates_data;

		}
		


	public function job_bm_email_templates_parameters(){
		
		
			$parameters['site_parameter'] = array(
												'title'=>__('Site Parameters', 'job-board-manager'),
												'parameters'=>array('{site_name}','{site_description}','{site_url}','{site_logo_url}'),										
												);
												
			$parameters['user_parameter'] = array(
												'title'=>__('Users Parameters', 'job-board-manager'),
												'parameters'=>array('{user_name}','{user_avatar}','{user_email}'),										
												);	
												
			$parameters['job_parameter'] = array(
												'title'=>__('Job Parameters', 'job-board-manager'),
												'parameters'=>array('{job_id}','{job_edit_url}','{job_title}','{job_shortcontent}','{job_url}'),										
												);										
																					
			$parameters['job_application'] = array(
												'title'=>__('Job application', 'job-board-manager'),
												'parameters'=>array('{appliction_content}','{appliction_url}'),										
												);																
		
												
			$parameters = apply_filters('job_bm_emails_templates_param',$parameters);
		
		
			return $parameters;
		
		}
		

	}
	
new class_job_bm_emails();