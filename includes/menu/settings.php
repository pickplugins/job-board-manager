<?php	


/*
* @Author 		PickPlugins
* Copyright: 	2015 PickPlugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 



class class_job_bm_settings_page  {
	
	
    public function __construct(){

		//add_action( 'admin_menu', array( $this, 'admin_menu' ), 12 );
    }
	
	
	
	public function apply_method_list(){

		$class_job_bm_functions = new class_job_bm_functions();
		$apply_method_list = $class_job_bm_functions->apply_method_list();		

		return $apply_method_list;

		}

	
	
	public function job_bm_settings_options($options = array()){


			$class_job_bm_functions = new class_job_bm_functions();
			
			$job_bm_list_user_role = $class_job_bm_functions->job_bm_list_user_role();



						
			$section_options = array(
			
							'job_bm_list_per_page'=>array(
									'css_class'=>'list_per_page',					
									'title'=>__('Post per page',job_bm_textdomain),
									'option_details'=>__('Job list post per page',job_bm_textdomain),						
									'input_type'=>'text', // text, radio, checkbox, select, 
									'input_values'=>'20', // could be array
									),
									
								'job_bm_list_excerpt_display'=>array(
									'css_class'=>'excerpt_display',					
									'title'=>__('Excerpt display',job_bm_textdomain),
									'option_details'=>__('Display short content form following',job_bm_textdomain),						
									'input_type'=>'select', // text, radio, checkbox, select, 
									'input_values'=>'from_content', // could be array
									'input_args'=> array( 'from_content'=>__('From Content',job_bm_textdomain), 'short_content'=>__('Short Content',job_bm_textdomain),),
									),
									
								'job_bm_list_excerpt_word_count'=>array(
									'css_class'=>'excerpt_word_count',					
									'title'=>__('Excerpt word count',job_bm_textdomain),
									'option_details'=>__('Excerpt display word count',job_bm_textdomain),						
									'input_type'=>'text', // text, radio, checkbox, select, 
									'input_values'=>'20', // could be array
									
									),									
									
								'job_bm_list_archive_more_style'=>array(
									'css_class'=>'job_bm_list_archive_more_style',					
									'title'=>__('Archive load style',job_bm_textdomain),
									'option_details'=>__('Set load more style ajax or pagination',job_bm_textdomain),						
									'input_type'=>'select', // text, radio, checkbox, select, 
									'input_values'=>'pagination', // could be array
									'input_args'=> array( 'pagination'=>__('Pagination',job_bm_textdomain), 'ajax'=>__('Load more',job_bm_textdomain),),
									
									),									
									
									
									
									
									
																	
									
/*

								'job_bm_listing_duration'=>array(
									'css_class'=>'listing_duration',					
									'title'=>'Listing Duration',
									'option_details'=>'Listing Duration, job will experied automatically after this days',						
									'input_type'=>'text', // text, radio, checkbox, select, 
									'input_values'=>'30', // could be array
									),

*/
											
			
			);	
						
						
			$options['<i class="fa fa-cogs"></i> '.__('Options',job_bm_textdomain)] = apply_filters( 'job_bm_settings_section_options', $section_options );
						
						

			
			$section_options = array(
								'job_bm_archive_page_id'=>array(
									'css_class'=>'archive_page_id',					
									'title'=>__('Archive page',job_bm_textdomain),
									'option_details'=>__('Archive page job list page where placed the short-code [job_list])',job_bm_textdomain),						
									'input_type'=>'select', // text, radio, checkbox, select, 
									'input_values'=>'', // could be array
									'input_args'=>job_bm_page_list_id(), // could be array									
									),
								'job_bm_job_submit_page_id'=>array(
									'css_class'=>'job_submit_page_id',					
									'title'=>__('Job submit page',job_bm_textdomain),
									'option_details'=>__('Job submission page id',job_bm_textdomain),						
									'input_type'=>'select', // text, radio, checkbox, select, 
									'input_values'=>'', // could be array
									'input_args'=>job_bm_page_list_id(), // could be array									
									),
									
								'job_bm_job_edit_page_id'=>array(
									'css_class'=>'job_edit_page_id',					
									'title'=>__('Job edit page',job_bm_textdomain),
									'option_details'=>__('Job edit page id',job_bm_textdomain),						
									'input_type'=>'select', // text, radio, checkbox, select, 
									'input_values'=>'', // could be array
									'input_args'=>job_bm_page_list_id(), // could be array									
									),									
									
									
								'job_bm_job_login_page_id'=>array(
									'css_class'=>'job_login_page_id',					
									'title'=>__('My account page',job_bm_textdomain),
									'option_details'=>__('My account page id',job_bm_textdomain),						
									'input_type'=>'select', // text, radio, checkbox, select, 
									'input_values'=>'', // could be array
									'input_args'=>job_bm_page_list_id(), // could be array									
									),	
									
									
								'job_bm_registration_enable'=>array(
									'css_class'=>'registration_enable',					
									'title'=>__('Registration enable ?',job_bm_textdomain),
									'option_details'=>__('Registration enable on my account page ',job_bm_textdomain),						
									'input_type'=>'select', // text, radio, checkbox, select, 
									'input_values'=>'yes', // could be array
									'input_args'=> array( 'yes'=>__('Yes',job_bm_textdomain), 'no'=>__('No',job_bm_textdomain),),
									),
									
									
								'job_bm_login_enable'=>array(
									'css_class'=>'login_enable',					
									'title'=>__('Login enable ?',job_bm_textdomain),
									'option_details'=>__('Login enable on my account page ',job_bm_textdomain),						
									'input_type'=>'select', // text, radio, checkbox, select, 
									'input_values'=>'yes', // could be array
									'input_args'=> array( 'yes'=>__('Yes',job_bm_textdomain), 'no'=>__('No',job_bm_textdomain),),
									),
									
									
									
									
									
									
			
			);
			
			$options['<i class="fa fa-file-powerpoint-o"></i> '.__('Pages',job_bm_textdomain)] = apply_filters( 'job_bm_settings_section_pages', $section_options );
	
			
			$section_options = array(
			
								'job_bm_account_required_post_job'=>array(
									'css_class'=>'account_required_post_job',					
									'title'=>__('Account required ?',job_bm_textdomain),
									'option_details'=>__('Account required to post job.',job_bm_textdomain),						
									'input_type'=>'select', // text, radio, checkbox, select, 
									'input_values'=>'yes', // could be array
									'input_args'=> array( 'yes'=>__('Yes',job_bm_textdomain), 'no'=>__('No',job_bm_textdomain),),
									),
			
			
								'job_bm_reCAPTCHA_enable'=>array(
									'css_class'=>'reCAPTCHA_enable',					
									'title'=>__('reCAPTCHA enable ?',job_bm_textdomain),
									'option_details'=>__('Enable reCAPTCHA to protect spam.',job_bm_textdomain),					
									'input_type'=>'select', // text, radio, checkbox, select,
									'input_values'=> 'no', // could be array
									'input_args'=> array( 'no'=>__('No',job_bm_textdomain), 'yes'=>__('Yes',job_bm_textdomain),), // could be array
									),			
			
								'job_bm_reCAPTCHA_site_key'=>array(
									'css_class'=>'reCAPTCHA_site_key',					
									'title'=>__('reCAPTCHA site key',job_bm_textdomain),
									'option_details'=>__('reCAPTCHA site key, please go <a href="https://www.google.com/recaptcha">google.com/reCAPTCHA</a> and register your site to get site key.',job_bm_textdomain),						
									'input_type'=>'text', // text, radio, checkbox, select, 
									'input_values'=> '', // could be array
									),		
									
								'job_bm_reCAPTCHA_secret_key'=>array(
									'css_class'=>'reCAPTCHA_secret_key',					
									'title'=>__('reCAPTCHA secret key',job_bm_textdomain),
									'option_details'=>__('reCAPTCHA secret key, please go <a href="https://www.google.com/recaptcha">google.com/reCAPTCHA</a> and register your site to get secret key.',job_bm_textdomain),						
									'input_type'=>'text', // text, radio, checkbox, select, 
									'input_values'=> '', // could be array
									),									
			
								'job_bm_submitted_job_status'=>array(
									'css_class'=>'submitted_job_status',					
									'title'=>__('New submitted job status ?',job_bm_textdomain),
									'option_details'=>__('Submitted job status',job_bm_textdomain),						
									'input_type'=>'select', // text, radio, checkbox, select, 
									'input_values'=> 'pending', // could be array
									'input_args'=> array( 'draft'=>__('Draft',job_bm_textdomain), 'pending'=>__('Pending',job_bm_textdomain), 'publish'=>__('Published',job_bm_textdomain), 'private'=>__('Private',job_bm_textdomain), 'trash'=>__('Trash',job_bm_textdomain)),
									),						
/*

								'job_bm_employer_account_role'=>array(
									'css_class'=>'employer_account_role',					
									'title'=>'Employer Account Role ?',
									'option_details'=>'Employer Account Role',						
									'input_type'=>'select', // text, radio, checkbox, select, 
									'input_values'=> array('employer'=>'Employer'), // could be array
									'input_args'=> $job_bm_list_user_role,
									),									
									
								'job_bm_applicant_account_role'=>array(
									'css_class'=>'applicant_account_role',					
									'title'=>'Applicant Account Role ?',
									'option_details'=>'Applicant Account Role',						
									'input_type'=>'select', // text, radio, checkbox, select, 
									'input_values'=> array('applicant'=>'applicant'), // could be array
									'input_args'=> $job_bm_list_user_role,
									),
*/

								'job_bm_salary_currency'=>array(
									'css_class'=>'salary_currency',					
									'title'=>__('Salary currency ?',job_bm_textdomain),
									'option_details'=>__('Salary currency display on job page.',job_bm_textdomain),						
									'input_type'=>'text', // text, radio, checkbox, select, 
									'input_values'=> '$', // could be array
									),
									
									
								'job_bm_apply_method'=>array(
									'css_class'=>'apply_method',					
									'title'=>__('Apply method ?',job_bm_textdomain),
									'option_details'=>__('Enable apply methods',job_bm_textdomain),						
									'input_type'=>'checkbox', // text, radio, checkbox, select, 
									'input_values'=> array('direct_email'), // could be array
									'input_args'=> $this->apply_method_list(),
									),
									
									
								'job_bm_can_user_delete_jobs'=>array(
									'css_class'=>'can_user_delete_jobs',					
									'title'=>__('Can user delete jobs ?',job_bm_textdomain),
									'option_details'=>__('Can user delete their own jobs',job_bm_textdomain),						
									'input_type'=>'select', // text, radio, checkbox, select, 
									'input_values'=> array('yes'), // could be array
									'input_args'=> array( 'no'=>__('No',job_bm_textdomain), 'yes'=>__('Yes',job_bm_textdomain),), // could be array
									),									
									
									
								'job_bm_can_user_edit_published_jobs'=>array(
									'css_class'=>'can_user_edit_published_jobs',					
									'title'=>__('Can user edit jobs ?',job_bm_textdomain),
									'option_details'=>__('Can user edit published jobs',job_bm_textdomain),						
									'input_type'=>'select', // text, radio, checkbox, select, 
									'input_values'=> 'yes', // could be array
									'input_args'=> array( 'no'=>__('No',job_bm_textdomain), 'yes'=>__('Yes',job_bm_textdomain),), // could be array
									),									
									
								'job_bm_redirect_preview_link'=>array(
									'css_class'=>'redirect_preview_link',					
									'title'=>__('Redirect preview link after job submit ?',job_bm_textdomain),
									'option_details'=>__('User can see the job preview after submitted.',job_bm_textdomain),						
									'input_type'=>'select', // text, radio, checkbox, select, 
									'input_values'=> 'yes', // could be array
									'input_args'=> array('no'=>__('No',job_bm_textdomain),'yes'=>__('Yes',job_bm_textdomain)),
									),			
									
								'job_bm_submission_type'=>array(
									'css_class'=>'submission_type',					
									'title'=>__('Submission type ?',job_bm_textdomain),
									'option_details'=>__('Submission type.',job_bm_textdomain),						
									'input_type'=>'select', // text, radio, checkbox, select, 
									'input_values'=> 'yes', // could be array
									'input_args'=> array('step'=>__('Step by step',job_bm_textdomain),'accordion'=>__('Accordion',job_bm_textdomain)),
									),										
									
									
									
									
			
			
			);
			
			$options['<i class="fa fa-suitcase"></i> '.__('Job Post',job_bm_textdomain)] = apply_filters( 'job_bm_settings_section_job_post', $section_options );



			$section_options = array(
			
								'job_bm_logo_url'=>array(
									'css_class'=>'email_logo_url',					
									'title'=>__('Email logo URL',job_bm_textdomain),
									'option_details'=>__('Email logo URL to display on mail.',job_bm_textdomain),						
									'input_type'=>'file', // text, radio, checkbox, select, 
									'input_values'=>job_bm_plugin_url.'assets/admin/images/email-logo.png', // could be array
									),
									
								'job_bm_from_email'=>array(
									'css_class'=>'from_email',					
									'title'=>__('From email',job_bm_textdomain),
									'option_details'=>__('From email address',job_bm_textdomain),						
									'input_type'=>'text', // text, radio, checkbox, select, 
									'input_values'=>get_option('admin_email'), // could be array
									),	
			
								'job_bm_notify_email_job_submit'=>array(
									'css_class'=>'notify_email_job_submit',					
									'title'=>__('Notify email new job submit ?',job_bm_textdomain),
									'option_details'=>__('Notify admin when new job submitted',job_bm_textdomain),						
									'input_type'=>'select', // text, radio, checkbox, select, 
									'input_values'=> 'yes', // could be array
									'input_args'=> array('yes'=>__('Yes',job_bm_textdomain),'no'=>__('No',job_bm_textdomain)),
									),
									
								'job_bm_notify_email_job_publish'=>array(
									'css_class'=>'notify_email_job_publish',					
									'title'=>__('Notify email new job publish ?',job_bm_textdomain),
									'option_details'=>__('Notify email to admin when new job published.',job_bm_textdomain),						
									'input_type'=>'select', // text, radio, checkbox, select, 
									'input_values'=> 'yes', // could be array
									'input_args'=> array('yes'=>__('Yes',job_bm_textdomain),'no'=>__('No',job_bm_textdomain)),
									),
									
								
									

																
								);
						
			
			$options['<i class="fa fa-bell-o"></i> '.__('Notification',job_bm_textdomain)] = apply_filters( 'job_bm_settings_section_notification', $section_options );

			
			$section_options = array(
								'job_bm_featured_bg_color'=>array(
									'css_class'=>'featured_bg_color',					
									'title'=>__('Featured job background color ?',job_bm_textdomain),
									'option_details'=>__('Featured job area background color.',job_bm_textdomain),						
									'input_type'=>'text', // text, radio, checkbox, select, 
									'input_values'=> '#fff8bf', // could be array
									),
								
								'job_bm_job_type_bg_color'=>array(
									'css_class'=>'job_type_bg_color',					
									'title'=>__('Job type background color ?',job_bm_textdomain),
									'option_details'=>__('Job types area background color',job_bm_textdomain),						
									'input_type'=>'text-multi', // text, radio, checkbox, select, 
									'input_values'=> '', // could be array
									'input_args'=> $class_job_bm_functions->job_type_bg_color(),
									),
									
								'job_bm_job_status_bg_color'=>array(
									'css_class'=>'job_status_bg_color',					
									'title'=>__('Job status background color ?',job_bm_textdomain),
									'option_details'=>__('Job status area background color',job_bm_textdomain),						
									'input_type'=>'text-multi', // text, radio, checkbox, select, 
									'input_values'=> '', // could be array
									'input_args'=> $class_job_bm_functions->job_status_bg_color(),
									),
			
			);
			
			
			$options['<i class="fa fa-diamond"></i> '.__('Style',job_bm_textdomain)] = apply_filters( 'job_bm_settings_section_style', $section_options );
			
			
			
			
			$options = apply_filters( 'job_bm_settings_options', $options );


			
			return $options;
		
		}
	
	
	public function job_bm_settings_options_form(){
		
			global $post;
			
			$job_bm_settings_options = $this->job_bm_settings_options();
			//var_dump($job_settings_options);
			$html = '';
			
			$html.= '<div class="para-settings job-bm-admin">';			

			$html_nav = '';
			$html_box = '';
					
			$i=1;
			foreach($job_bm_settings_options as $key=>$options){
			if($i==1){
				$html_nav.= '<li nav="'.$i.'" class="nav'.$i.' active">'.$key.'</li>';				
				}
			else{
				$html_nav.= '<li nav="'.$i.'" class="nav'.$i.'">'.$key.'</li>';
				}
				
				
			if($i==1){
				$html_box.= '<li style="display: block;" class="box'.$i.' tab-box active">';				
				}
			else{
				$html_box.= '<li style="display: none;" class="box'.$i.' tab-box">';
				}

				
			foreach($options as $option_key=>$option_info){

				//$option_value =  get_post_meta( $post->ID, $option_key, true );
				$option_value =  get_option( $option_key );				
				//var_dump($option_value);
				
				
				if(empty($option_value)){
					$option_value = $option_info['input_values'];
					}
				
				if(!empty($option_info['css_class'])){
						$css_class =	$option_info['css_class'];
						
						
					}
				else{
						$css_class = '';
						
						
					}
				
				$html_box.= '<div class="option-box '.$css_class.'">';
				
				$html_box.= '<p class="option-title">'.$option_info['title'].'</p>';
				$html_box.= '<p class="option-info">'.$option_info['option_details'].'</p>';
				
				if($option_info['input_type'] == 'text'){
				$html_box.= '<input type="text" placeholder="" name="'.$option_key.'" value="'.$option_value.'" /> ';					

					}
					
					
				elseif($option_info['input_type'] == 'text-multi'){
					
					$input_args = $option_info['input_args'];

									
					foreach($input_args as $input_args_key=>$input_args_values){
						
						if(empty($option_value[$input_args_key])){
							$option_value[$input_args_key] = $input_args[$input_args_key];
							}
							
							
						$html_box.= '<label>'.ucfirst($input_args_key).'<br/><input class="job-bm-color" type="text" placeholder="" name="'.$option_key.'['.$input_args_key.']" value="'.$option_value[$input_args_key].'" /></label><br/>';	
						}
				
								

					}					
					
					
					
				elseif($option_info['input_type'] == 'textarea'){
					$html_box.= '<textarea placeholder="" name="'.$option_key.'" >'.$option_value.'</textarea> ';
					
					}
					
					
					
					
				elseif($option_info['input_type'] == 'radio'){
					
					$input_args = $option_info['input_args'];
					
					foreach($input_args as $input_args_key=>$input_args_values){
						
						if($input_args_key == $option_value){
							$checked = 'checked';
							}
						else{
							$checked = '';
							}
							
						$html_box.= '<label><input class="'.$option_key.'" type="radio" '.$checked.' value="'.$input_args_key.'" name="'.$option_key.'"   >'.$input_args_values.'</label><br/>';
						}
					
					
					}
					
					
				elseif($option_info['input_type'] == 'select'){
					
					$input_args = $option_info['input_args'];
					$html_box.= '<select name="'.$option_key.'" >';
					foreach($input_args as $input_args_key=>$input_args_values){
						
						if($input_args_key == $option_value){
							$selected = 'selected';
							}
						else{
							$selected = '';
							}
						
						$html_box.= '<option '.$selected.' value="'.$input_args_key.'">'.$input_args_values.'</option>';

						}
					$html_box.= '</select>';
					
					}					
					
				
				
				elseif($option_info['input_type'] == 'selectmultiple'){
					
					$input_args = $option_info['input_args'];
					$html_box.= '<select multiple="multiple" size="6" name="'.$option_key.'[]" >';

					foreach($input_args as $input_args_key=>$input_args_values){
						
							if(in_array($input_args_key,$option_value)){
								$selected = 'selected';
								}
							else{
								$selected = '';
								}

						
						$html_box.= '<option '.$selected.' value="'.$input_args_key.'">'.$input_args_values.'</option>';

						}
					$html_box.= '</select>';
					
					}				
					
					
					
					
					
					
					
				elseif($option_info['input_type'] == 'checkbox'){
					
					$input_args = $option_info['input_args'];
					
					foreach($input_args as $input_args_key=>$input_args_values){
						
						
						if(empty($option_value[$input_args_key])){
							$checked = '';
							}
						else{
							$checked = 'checked';
							}
						$html_box.= '<label><input '.$checked.' value="'.$input_args_key.'" name="'.$option_key.'['.$input_args_key.']"  type="checkbox" >'.$input_args_values.'</label><br/>';
						
						
						}
					
					
					}
					
				elseif($option_info['input_type'] == 'file'){
					
					$html_box.= '<input type="text" id="file_'.$option_key.'" name="'.$option_key.'" value="'.$option_value.'" /><br />';
					
					$html_box.= '<input id="upload_button_'.$option_key.'" class="upload_button_'.$option_key.' button" type="button" value="Upload File" />';					
					
					$html_box.= '<br /><br /><div style="overflow:hidden;max-height:150px;max-width:150px;" class="logo-preview"><img style=" width:100%;" src="'.$option_value.'" /></div>';
					
					$html_box.= '
<script>
								jQuery(document).ready(function($){
	
									var custom_uploader; 
								 
									jQuery("#upload_button_'.$option_key.'").click(function(e) {
	
										e.preventDefault();
								 
										//If the uploader object has already been created, reopen the dialog
										if (custom_uploader) {
											custom_uploader.open();
											return;
										}
								
										//Extend the wp.media object
										custom_uploader = wp.media.frames.file_frame = wp.media({
											title: "Choose File",
											button: {
												text: "Choose File"
											},
											multiple: false
										});
								
										//When a file is selected, grab the URL and set it as the text field\'s value
										custom_uploader.on("select", function() {
											attachment = custom_uploader.state().get("selection").first().toJSON();
											jQuery("#file_'.$option_key.'").val(attachment.url);
											jQuery(".logo-preview img").attr("src",attachment.url);											
										});
								 
										//Open the uploader dialog
										custom_uploader.open();
								 
									});
									
									
								})
							</script>
					
					';					
					
					
					
					
					}		
					
					
										
					
								
				$html_box.= '</div>';
				
				}
			$html_box.= '</li>';
			
			
			$i++;
			}
			
			
			$html.= '<ul class="tab-nav">';
			$html.= $html_nav;			
			$html.= '</ul>';
			$html.= '<ul class="box">';
			$html.= $html_box;
			$html.= '</ul>';		
			
			
			
			$html.= '</div>';			
			return $html;
		}
	
	
	
}

new class_job_bm_settings_page();







if(empty($_POST['job_bm_hidden']))
	{


		$class_job_bm_settings_page = new class_job_bm_settings_page();
		
			$job_bm_settings_options = $class_job_bm_settings_page->job_bm_settings_options();
			
			foreach($job_bm_settings_options as $options_tab=>$options){
				
				foreach($options as $option_key=>$option_data){
					
					${$option_key} = get_option( $option_key );
		
					//var_dump($option_key);
					}
				}






	}
else
	{	
		if($_POST['job_bm_hidden'] == 'Y') {
			//Form data sent

	
			$class_job_bm_settings_page = new class_job_bm_settings_page();
			
			$job_bm_settings_options = $class_job_bm_settings_page->job_bm_settings_options();
			
			foreach($job_bm_settings_options as $options_tab=>$options){
				
				foreach($options as $option_key=>$option_data){

					if(!empty($_POST[$option_key])){
						${$option_key} = stripslashes_deep($_POST[$option_key]);
						update_option($option_key, ${$option_key});
						}
					else{
						${$option_key} = array();
						update_option($option_key, ${$option_key});
						
						}


					//var_dump($option_key);
					
					}
				}
	
	
	
	

			?>
			<div class="updated"><p><strong><?php _e('Changes Saved.', job_bm_textdomain ); ?></strong></p></div>
	
			<?php
			} 
	}
	
	

	
	
?>





<div class="wrap">

	<div id="icon-tools" class="icon32"><br></div><?php echo "<h2>".__(job_bm_plugin_name.' Settings', job_bm_textdomain)."</h2>";?>
		<form  method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
	<input type="hidden" name="job_bm_hidden" value="Y">
        <?php settings_fields( 'job_bm_plugin_options' );
				do_settings_sections( 'job_bm_plugin_options' );
			
			
	$class_job_bm_settings_page = new class_job_bm_settings_page();
        echo $class_job_bm_settings_page->job_bm_settings_options_form(); 
	
			
			
		?>

    






<p class="submit">
                    <input class="button button-primary" type="submit" name="Submit" value="<?php _e('Save Changes',job_bm_textdomain ); ?>" />
                </p>
		</form>


</div>
