<?php
if ( ! defined('ABSPATH')) exit;  // if direct access

class class_job_bm_emails{
	
	public function __construct(){


		}



		
		
	public function job_bm_send_email($email_data){
		

		
		$email_to = isset($email_data['email_to']) ? $email_data['email_to'] : '';
        $email_bcc = isset($email_data['email_bcc']) ? $email_data['email_bcc'] : '';

		$email_from = isset($email_data['email_from']) ? $email_data['email_from'] : get_option('admin_email');
		$email_from_name = isset($email_data['email_from_name']) ? $email_data['email_from_name'] : get_bloginfo('name');
		$subject = isset($email_data['subject']) ? $email_data['subject'] : '';
		$email_body = isset($email_data['html']) ? $email_data['html'] : '';
		$attachments = isset($email_data['attachments']) ? $email_data['attachments'] : '';
					

		$headers = array();
		$headers[] = "From: ".$email_from_name." <".$email_from.">";
		$headers[] = "MIME-Version: 1.0";
		$headers[] = "Content-Type: text/html; charset=UTF-8";
        if(!empty($email_bcc)){
            $headers[] = "Bcc: ".$email_bcc;
        }
        $headers = apply_filters('job_bm_mail_headers', $headers);

		$status = wp_mail($email_to, $subject, $email_body, $headers, $attachments);

        return $status;
		
		}	
		
		
		
		
		

	public function job_bm_email_templates_data(){
		
		$templates_data_html = array();
        $admin_email = get_option('admin_email');
        $site_name = get_bloginfo('name');


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
                'email_to'=>$admin_email,
                'email_from'=>$admin_email,
                'email_from_name'=> $site_name,
                'enable'=> 'yes',
            ),

            'application_new_comment'=>array(
                'name'=>__('Application new Comment', 'job-board-manager'),
                'description'=>__('Notification email for when new comment posted on application.', 'job-board-manager'),
                'subject'=>__('Comment on application - {site_url}', 'job-board-manager'),
                'html'=>$templates_data_html['application_new_comment'],
                'email_to'=>$admin_email,
                'email_from'=>$admin_email,
                'email_from_name'=> $site_name,
                'enable'=> 'yes',
            ),

            'application_not_hire'=>array(
                'name'=>__('Application hire removed', 'job-board-manager'),
                'description'=>__('Notification email for application hire removed.', 'job-board-manager'),
                'subject'=>__('Application hire removed - {site_url}', 'job-board-manager'),
                'html'=>$templates_data_html['application_not_hire'],
                'email_to'=>$admin_email,
                'email_from'=>$admin_email,
                'email_from_name'=> $site_name,
                'enable'=> 'yes',
            ),

            'application_rate'=>array(
                'name'=>__('Application rated', 'job-board-manager'),
                'description'=>__('Notification email for application rated.', 'job-board-manager'),
                'subject'=>__('Application rated - {site_url}', 'job-board-manager'),
                'html'=>$templates_data_html['application_rate'],
                'email_to'=>$admin_email,
                'email_from'=>$admin_email,
                'email_from_name'=> $site_name,
                'enable'=> 'yes',
            ),

            'application_submitted'=>array(
                'name'=>__('Application submitted', 'job-board-manager'),
                'description'=>__('Notification email for application submitted.', 'job-board-manager'),
                'subject'=>__('Application submitted - {site_url}', 'job-board-manager'),
                'html'=>$templates_data_html['application_submitted'],
                'email_to'=>$admin_email,
                'email_from'=>$admin_email,
                'email_from_name'=> $site_name,
                'enable'=> 'yes',
            ),


            'application_trash'=>array(
                'name'=>__('Application trashed', 'job-board-manager'),
                'description'=>__('Notification email for application trashed.', 'job-board-manager'),
                'subject'=>__('Application trashed - {site_url}', 'job-board-manager'),
                'html'=>$templates_data_html['application_trash'],
                'email_to'=>$admin_email,
                'email_from'=>$admin_email,
                'email_from_name'=> $site_name,
                'enable'=> 'yes',
            ),



            'job_edited'=>array(
                'name'=>__('Job edited', 'job-board-manager'),
                'description'=>__('Notification email for admin when user edited job.', 'job-board-manager'),
                'subject'=>__('Job Edited - {site_url}', 'job-board-manager'),
                'html'=>$templates_data_html['job_edited'],
                'email_to'=>$admin_email,
                'email_from'=>$admin_email,
                'email_from_name'=> $site_name,
                'enable'=> 'yes',
            ),


            'job_featured'=>array(
                'name'=>__('Job featured', 'job-board-manager'),
                'description'=>__('Notification email for admin featured a job.', 'job-board-manager'),
                'subject'=>__('Job featured - {site_url}', 'job-board-manager'),
                'html'=>$templates_data_html['job_featured'],
                'email_to'=>$admin_email,
                'email_from'=>$admin_email,
                'email_from_name'=> $site_name,
                'enable'=> 'yes',
            ),

            'job_published'=>array(
                'name'=>__('Job published', 'job-board-manager'),
                'description'=>__('Notification email for admin published a job.', 'job-board-manager'),
                'subject'=>__('Job published - {site_url}', 'job-board-manager'),
                'html'=>$templates_data_html['job_published'],
                'email_to'=>$admin_email,
                'email_from'=>$admin_email,
                'email_from_name'=> $site_name,
                'enable'=> 'yes',
            ),


            'job_submitted'=>array(
                'name'=>__('Job submitted', 'job-board-manager'),
                'description'=>__('Notification email for user submitted job.', 'job-board-manager'),
                'subject'=>__('Job Submitted - {site_url}', 'job-board-manager'),
                'html'=>$templates_data_html['job_submitted'],
                'email_to'=>$admin_email,
                'email_from'=>$admin_email,
                'email_from_name'=> $site_name,
                'enable'=> 'yes',
            ),

            'job_trash'=>array(
                'name'=>__('Job trashed', 'job-board-manager'),
                'description'=>__('Notification email for trash job.', 'job-board-manager'),
                'subject'=>__('Job trashed - {site_url}', 'job-board-manager'),
                'html'=>$templates_data_html['job_trash'],
                'email_to'=>$admin_email,
                'email_from'=>$admin_email,
                'email_from_name'=> $site_name,
                'enable'=> 'yes',
            ),
			
			

		);
		
		$templates_data = apply_filters('job_bm_email_templates_data', $templates_data);
		
		return $templates_data;

		}
		


	public function email_templates_parameters(){



        $parameters = array(

            'application_hire'=>array(
                'parameters'=> array(
                    '{site_url}'=>'Website Home URL',
                    '{site_description}'=>'Website tagline',
                    '{site_logo_url}'=>'Logo url',

                    '{application_id}'  => 'Application post ID',
                    '{application_title}'  => 'Application post title',
                    '{application_url}'  => 'Application post URL',
                    '{application_edit_url}'  => 'Application admin post edit URL',
                    '{application_author_id}'  => 'Application post author ID',
                    '{application_author_name}'  => 'Application post author name',

                    '{job_id}'  => 'Job ID',
                    '{job_title}'  => 'Job Title',
                    '{job_url}'  => 'Job post URL',
                    '{job_edit_url}'  => 'Job admin post edit URL',
                    '{job_author_id}'  => 'Job post author ID',
                    '{job_author_name}'  => 'Job post author name',

                    '{current_user_id}'  => 'Logged-in user ID',
                    '{current_user_name}'  => 'Logged-in user display name',
                    '{current_user_avatar}'  =>'Logged-in user avatar',
                ),

            ),

            'application_new_comment'=>array(

                'parameters'=> array(
                    '{site_url}'=>'Website Home URL',
                    '{site_description}'=>'Website tagline',
                    '{site_logo_url}'=>'Logo url',

                    '{application_id}'  => 'Application post ID',
                    '{application_title}'  => 'Application post title',
                    '{application_url}'  => 'Application post URL',
                    '{application_edit_url}'  => 'Application admin post edit URL',
                    '{application_author_id}'  => 'Application post author ID',
                    '{application_author_name}'  => 'Application post author name',

                    '{comment_id}'  => 'Comment ID',
                    '{comment_author_email}'  => 'Comment author email',
                    '{comment_content}'  => 'Comment content',

                    '{current_user_id}'  => 'Logged-in user ID',
                    '{current_user_name}'  => 'Logged-in user display name',
                    '{current_user_avatar}'  =>'Logged-in user avatar',
                ),
            ),

            'application_not_hire'=>array(

                'parameters'=> array(
                    '{site_url}'=>'Website Home URL',
                    '{site_description}'=>'Website tagline',
                    '{site_logo_url}'=>'Logo url',

                    '{application_id}'  => 'Application post ID',
                    '{application_title}'  => 'Application post title',
                    '{application_url}'  => 'Application post URL',
                    '{application_edit_url}'  => 'Application admin post edit URL',
                    '{application_author_id}'  => 'Application post author ID',
                    '{application_author_name}'  => 'Application post author name',

                    '{current_user_id}'  => 'Logged-in user ID',
                    '{current_user_name}'  => 'Logged-in user display name',
                    '{current_user_avatar}'  =>'Logged-in user avatar',
                ),
            ),

            'application_rate'=>array(

                'parameters'=> array(
                    '{site_url}'=>'Website Home URL',
                    '{site_description}'=>'Website tagline',
                    '{site_logo_url}'=>'Logo url',

                    '{application_id}'  => 'Application post ID',
                    '{application_title}'  => 'Application post title',
                    '{application_url}'  => 'Application post URL',
                    '{application_edit_url}'  => 'Application admin post edit URL',
                    '{application_author_id}'  => 'Application post author ID',
                    '{application_author_name}'  => 'Application post author name',

                    '{current_user_id}'  => 'Logged-in user ID',
                    '{current_user_name}'  => 'Logged-in user display name',
                    '{current_user_avatar}'  =>'Logged-in user avatar',
                ),
            ),

            'application_submitted'=>array(

                'parameters'=> array(
                    '{site_url}'=>'Website Home URL',
                    '{site_description}'=>'Website tagline',
                    '{site_logo_url}'=>'Logo url',

                    '{application_id}'  => 'Application post ID',
                    '{application_title}'  => 'Application post title',
                    '{application_url}'  => 'Application post URL',
                    '{application_edit_url}'  => 'Application admin post edit URL',
                    '{application_author_id}'  => 'Application post author ID',
                    '{application_author_name}'  => 'Application post author name',

                    '{current_user_id}'  => 'Logged-in user ID',
                    '{current_user_name}'  => 'Logged-in user display name',
                    '{current_user_avatar}'  =>'Logged-in user avatar',
                ),
            ),


            'application_trash'=>array(

                'parameters'=> array(
                    '{site_url}'=>'Website Home URL',
                    '{site_description}'=>'Website tagline',
                    '{site_logo_url}'=>'Logo url',

                    '{application_id}'  => 'Application post ID',
                    '{application_title}'  => 'Application post title',
                    '{application_url}'  => 'Application post URL',
                    '{application_edit_url}'  => 'Application admin post edit URL',
                    '{application_author_id}'  => 'Application post author ID',
                    '{application_author_name}'  => 'Application post author name',

                    '{current_user_id}'  => 'Logged-in user ID',
                    '{current_user_name}'  => 'Logged-in user display name',
                    '{current_user_avatar}'  =>'Logged-in user avatar',
                ),
            ),



            'job_edited'=>array(

                'parameters'=> array(
                    '{site_url}'=>'Website Home URL',
                    '{site_description}'=>'Website tagline',
                    '{site_logo_url}'=>'Logo url',

                    '{job_id}'  => 'Job ID',
                    '{job_title}'  => 'Job Title',
                    '{job_url}'  => 'Job post URL',
                    '{job_edit_url}'  => 'Job admin post edit URL',
                    '{job_author_id}'  => 'Job post author ID',
                    '{job_author_name}'  => 'Job post author name',

                    '{current_user_id}'  => 'Logged-in user ID',
                    '{current_user_name}'  => 'Logged-in user display name',
                    '{current_user_avatar}'  =>'Logged-in user avatar',
                ),
            ),


            'job_featured'=>array(

                'parameters'=> array(
                    '{site_url}'=>'Website Home URL',
                    '{site_description}'=>'Website tagline',
                    '{site_logo_url}'=>'Logo url',

                    '{job_id}'  => 'Job ID',
                    '{job_title}'  => 'Job Title',
                    '{job_url}'  => 'Job post URL',
                    '{job_edit_url}'  => 'Job admin post edit URL',
                    '{job_author_id}'  => 'Job post author ID',
                    '{job_author_name}'  => 'Job post author name',

                    '{current_user_id}'  => 'Logged-in user ID',
                    '{current_user_name}'  => 'Logged-in user display name',
                    '{current_user_avatar}'  =>'Logged-in user avatar',
                ),
            ),

            'job_published'=>array(

                'parameters'=> array(
                    '{site_url}'=>'Website Home URL',
                    '{site_description}'=>'Website tagline',
                    '{site_logo_url}'=>'Logo url',

                    '{job_id}'  => 'Job ID',
                    '{job_title}'  => 'Job Title',
                    '{job_url}'  => 'Job post URL',
                    '{job_edit_url}'  => 'Job admin post edit URL',
                    '{job_author_id}'  => 'Job post author ID',
                    '{job_author_name}'  => 'Job post author name',

                    '{current_user_id}'  => 'Logged-in user ID',
                    '{current_user_name}'  => 'Logged-in user display name',
                    '{current_user_avatar}'  =>'Logged-in user avatar',
                ),
            ),


            'job_submitted'=>array(

                'parameters'=> array(
                    '{site_url}'=>'Website Home URL',
                    '{site_description}'=>'Website tagline',
                    '{site_logo_url}'=>'Logo url',

                    '{job_id}'  => 'Job ID',
                    '{job_title}'  => 'Job Title',
                    '{job_url}'  => 'Job post URL',
                    '{job_edit_url}'  => 'Job admin post edit URL',
                    '{job_author_id}'  => 'Job post author ID',
                    '{job_author_name}'  => 'Job post author name',

                    '{current_user_id}'  => 'Logged-in user ID',
                    '{current_user_name}'  => 'Logged-in user display name',
                    '{current_user_avatar}'  =>'Logged-in user avatar',
                ),
            ),

            'job_trash'=>array(

                'parameters'=> array(
                    '{site_url}'=>'Website Home URL',
                    '{site_description}'=>'Website tagline',
                    '{site_logo_url}'=>'Logo url',

                    '{job_id}'  => 'Job ID',
                    '{job_title}'  => 'Job Title',
                    '{job_url}'  => 'Job post URL',
                    '{job_edit_url}'  => 'Job admin post edit URL',
                    '{job_author_id}'  => 'Job post author ID',
                    '{job_author_name}'  => 'Job post author name',

                    '{current_user_id}'  => 'Logged-in user ID',
                    '{current_user_name}'  => 'Logged-in user display name',
                    '{current_user_avatar}'  =>'Logged-in user avatar',
                ),
            ),



        );
		
												
			$parameters = apply_filters('job_bm_emails_templates_param',$parameters);
		
		
			return $parameters;
		
		}
		

	}
	
new class_job_bm_emails();