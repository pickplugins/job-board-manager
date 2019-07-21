<?php

/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 


class class_job_bm_functions{
	
	public function __construct(){

		//add_action('add_meta_boxes', array($this, 'meta_boxes_job'));
		//add_action('save_post', array($this, 'meta_boxes_job_save'));

		}
	

	
	public function job_single_meta_items(){
		
		$job_single_meta_items = array(
								'job_bm_job_type'=>array('class'=>'job_type','fa'=>'briefcase','title'=>__('Job type', 'job-board-manager')),
								'job_bm_job_status'=>array('class'=>'job_status','fa'=>'','title'=>__('Job status', 'job-board-manager')),															
								'job_bm_location'=>array('class'=>'location','fa'=>'map-marker','title'=>__('Location', 'job-board-manager')),
								'job_bm_company_name'=>array('class'=>'company_name','fa'=>'briefcase','title'=>__('Company name', 'job-board-manager')),							
								'job_bm_total_vacancies'=>array('class'=>'total_vacancies','fa'=>'user-plus','title'=>__('Total vacancies', 'job-board-manager')),								
								'job_bm_expire_date'=>array('class'=>'expire_date','fa'=>'calendar-o','title'=>__('Expire date', 'job-board-manager')),
								'job_bm_view_count'=>array('class'=>'view_count','fa'=>'eye','title'=>__('View count', 'job-board-manager')),
								);
		
		
		$job_single_meta_items = apply_filters('job_single_meta_items', $job_single_meta_items);
		return $job_single_meta_items;
		
	}	
	
	
	
	
	
	
	
	
	
	
	public function job_type_list(){

		$job_type_list = array('full-time'=>__('Full Time', 'job-board-manager'), 'freelance'=>__('Freelance', 'job-board-manager'), 'internship'=>__('Internship', 'job-board-manager'),'part-time'=>__('Part Time', 'job-board-manager'),'temporary'=>__('Temporary', 'job-board-manager'));
		
		$job_type_list = apply_filters('job_bm_filters_job_type', $job_type_list);		

		return $job_type_list;

		}
		
		
	public function job_status_list(){

		$job_status_list = array('open'=>__('Open', 'job-board-manager'),'closed'=>__('Closed', 'job-board-manager'),'filled'=>__('Filled', 'job-board-manager'),'re-open'=>__('Re-Open', 'job-board-manager'),'expired'=>__('Expired', 'job-board-manager'));
		$job_status_list = apply_filters('job_bm_filters_job_status', $job_status_list);		

		return $job_status_list;

		}		
		
	
	public function job_level_list(){

		$job_level_list = array('any'=>__('Any', 'job-board-manager'),'entry_level'=>__('Entry level', 'job-board-manager'),'mid_level'=>__('Mid level', 'job-board-manager'),'top_level'=>__('Top level', 'job-board-manager'));
		$job_level_list = apply_filters('job_bm_filters_job_level', $job_level_list);		

		return $job_level_list;

		}	
	
	
	public function salary_type_list(){

		$salary_type_list = array('negotiable'=>__('Negotiable', 'job-board-manager'),'fixed'=>__('Fixed', 'job-board-manager'),'min-max'=>__('Salary range', 'job-board-manager'));
		$salary_type_list = apply_filters('job_bm_filters_salary_type', $salary_type_list);		

		return $salary_type_list;

		}	
	
	public function salary_range_list(){

		$salary_range_list = array( ''=>__('All', 'job-board-manager'), '1000-10000'=>__('1,000-10,000', 'job-board-manager') ,'10001-20000'=>__('10,001-20,000', 'job-board-manager') ,'20001-30000'=>__('20,001-30,000', 'job-board-manager') ,'30001-50000'=>__('30,001-50,000', 'job-board-manager') ,'50001-80000'=>__('50,001-80,000', 'job-board-manager'), '80001-100000'=>__('80,001-1,00,000', 'job-board-manager'));
		$salary_range_list = apply_filters('job_bm_filters_salary_range', $salary_range_list);		

		return $salary_range_list;

		}	
	
	
	

	public function apply_method_list(){

		$apply_method_list = array('none'=>__('None', 'job-board-manager'), 'direct_email'=>__('Direct Email', 'job-board-manager'));
		$apply_method_list = apply_filters('job_bm_filters_apply_method', $apply_method_list);		

		return $apply_method_list;

		}
	
	public function job_type_bg_color(){

		$job_type_color = array('freelance'=>'#46a6ff','full-time'=>'#2ec274','internship'=>'#a066ff','part-time'=>'#ffc24d','temporary'=>'#ff5741');
		$job_type_color = apply_filters('job_bm_filters_job_type_bg_color', $job_type_color);		

		return $job_type_color;

		}		
	
	public function job_status_bg_color(){

		$job_status_color = array('open'=>'#3ac170','closed'=>'#fa3218','filled'=>'#49a2ed','re-open'=>'#2fc2f9' ,'expired'=>'#ff4115');
		$job_status_color = apply_filters('job_bm_filters_job_status_bg_color', $job_status_color);		

		return $job_status_color;

		}	
	
	
	
	public function reports_tabs(){
		
		
		$reports_tabs = array(
					'job'=>array(
								'title'=>__('Jobs', 'job-board-manager'),
								'html'=>apply_filters('job_bm_filters_report_html_job', ''),
								),
					);
		
		$reports_tabs = apply_filters('job_bm_filters_reports_tabs', $reports_tabs);
		
		return $reports_tabs;
		
		
		
		}	
	
	
	public function account_tabs(){
		
		
		$account_tabs = array(
					'my_jobs'=>array(
								'title'=>__('My Jobs', 'job-board-manager'),
								'html'=>apply_filters('job_bm_filters_account_tab_my_jobs', ''),								
								
								),

					
					);
		
		$account_tabs = apply_filters('job_bm_filters_account_tabs', $account_tabs);
		
		return $account_tabs;
		
		
		
		}	
	
	
	

	
	
	public function tutorials(){

		$tutorials[] = array(
							'title'=>__('Job Board Manager - How to Install and Settings.', 'job-board-manager'),
							'video_id'=>'avfOO82Kz2g',
							'source'=>'youtube',
							);
							
		$tutorials[] = array(
							'title'=>__('Job Board Manager - Create a job.', 'job-board-manager'),
							'video_id'=>'KZygrlmNrE8',
							'source'=>'youtube',
							);							
							
		
		
		$tutorials = apply_filters('job_bm_filters_tutorials', $tutorials);		

		return $tutorials;

		}	
	
	
	public function faq(){



		$faq['core'] = array(
							'title'=>__('Core', 'job-board-manager'),
							'items'=>array(
							
											array(
												'question'=>__('Single job page showing 404 error', 'job-board-manager'),
												'answer_url'=>'https://goo.gl/uGLEWq',
					
												),
												
											array(
												'question'=>__('Single job page style broken, what should i do ?', 'job-board-manager'),
												'answer_url'=>'https://goo.gl/JXRQQl',
												),
												
											array(
												'question'=>__('How can i change slug for Job ?', 'job-board-manager'),
												'answer_url'=>'https://goo.gl/NsNqg3',
												),												

											array(
												'question'=>__('How can remove any tabs on job submission form ?', 'job-board-manager'),
												'answer_url'=>'https://goo.gl/ISsS8N',
												),	


											array(
												'question'=>__('Remove input fields on job submission form.', 'job-board-manager'),
												'answer_url'=>'https://goo.gl/WPdrEU',
												),	


											array(
												'question'=>__('How to add/remove job types', 'job-board-manager'),
												'answer_url'=>'https://goo.gl/S3mIW0',
												),	


											),

								
							);

					
		
		
		$faq = apply_filters('job_bm_filters_faq', $faq);		

		return $faq;

		}		
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	public function create_pages(){
		
		$page_data = array(
		
							array(
									'id'=>'job_bm_archive_page_id',		
									'title'=>__('Job Archive', 'job-board-manager'),
									'shortcode'=>'[job_list]',							
									
									),
							array(
									'id'=>'job_bm_job_submit_page_id',		
									'title'=>__('Job Submit', 'job-board-manager'),
									'shortcode'=>'[job_submit_form]',							
									
									),
									
							array(
									'id'=>'job_bm_job_edit_page_id',		
									'title'=>__('Job Edit', 'job-board-manager'),
									'shortcode'=>'[job_bm_job_edit]',							
									
									),									
									
							array(
									'id'=>'job_bm_job_login_page_id',
									'title'=>__('Job Dashboard', 'job-board-manager'),
									'shortcode'=>'[job_bm_dashboard] ',
									
									),						
					
		
		);
																					
							
			$page_data = apply_filters( 'job_bm_filter_create_pages', $page_data );
			
			return $page_data;			
		
		
		}


	public function post_type_input_fields_admin(){


		$input_fields['job_bm_job_status']=array(
			'meta_key'=>'job_bm_job_status',
			'css_class'=>'job_status',
			'required'=>'yes', // (yes, no) is this field required.
			'display'=>'yes', // (yes, no)
			'title'=>__('Job status', 'job-board-manager'),
			'option_details'=>__('Select job status.', 'job-board-manager'),
			'input_type'=>'select', // text, radio, checkbox, select,
			'input_values'=> '', // could be array
			'input_args'=> $this->job_status_list(),
		);

		$input_fields['job_bm_expire_date']=array(
			'meta_key'=>'job_bm_expire_date',
			'css_class'=>'expire_date',
			'required'=>'no', // (yes, no) is this field required.
			'display'=>'yes', // (yes, no)
			'title'=>__('Expiry date', 'job-board-manager'),
			'option_details'=>__('Job expiry date', 'job-board-manager'),
			'input_type'=>'text', // text, radio, checkbox, select,
			'input_values'=> job_bm_get_date(), // could be array
		);



		$input_fields['job_bm_featured']=array(
			'meta_key'=>'job_bm_featured',
			'css_class'=>'featured',
			'required'=>'no', // (yes, no) is this field required.
			'display'=>'yes', // (yes, no)
			'title'=>__('Featured job', 'job-board-manager'),
			'option_details'=>__('Want to get featured listing ?', 'job-board-manager'),
			'input_type'=>'select', // text, radio, checkbox, select,
			'input_values'=>'no', // could be array
			'input_args'=> array('no'=>__('No', 'job-board-manager'),'yes'=>__('Yes', 'job-board-manager')),
		);

		return $input_fields;

    }


	public function post_type_input_fields(){
		
		
		
		$input_fields['post_title'] = array(
														'meta_key'=>'post_title',
														'css_class'=>'post_title',
														'required'=>'yes', // (yes, no) is this field required.
														'placeholder'=>__('Write awesome title here', 'job-board-manager'),
														'title'=>__('Job Title', 'job-board-manager'),
														'option_details'=>__('Job title here', 'job-board-manager'),					
														'input_type'=>'text', // text, radio, checkbox, select,
														'input_values'=>'', // could be array
														//'field_args'=> array('size'=>'',),
														);
														
														
		$input_fields['post_content'] = array(
														'meta_key'=>'post_content',
														'css_class'=>'post_content',
														'required'=>'yes', // (yes, no) is this field required.
														//'placeholder'=>'',
														'title'=>__('Job Descriptions', 'job-board-manager'),
														'option_details'=>__('Write job descriptions here', 'job-board-manager'),					
														'input_type'=>'wp_editor', // text, radio, checkbox, select,
														'input_values'=>'', // could be array
														//'field_args'=> array('size'=>'',),
														);													
														
														
		
		
		$input_fields['post_thumbnail'] = array(
														'meta_key'=>'post_thumbnail',
														'css_class'=>'post_thumbnail',
														'required'=>'no', // (yes, no) is this field required.
														//'placeholder'=>'thumbnail',
														'title'=>__('Thumbnail', 'job-board-manager'),
														'option_details'=>__('Job Featured Image, uplaod single image only', 'job-board-manager'),					
														'input_type'=>'file', // text, radio, checkbox, select,
														'input_values'=>'', // could be array
														//'field_args'=> array('size'=>'',),
														);	
		
		
		
		
		$input_fields['post_taxonomies'] =	array(	
								
														'job_category'=>array(
															'meta_key'=>'job_category',
															'css_class'=>'job_category',
															'required'=>'no', // (yes, no) is this field required.
															'display'=>'yes', // (yes, no)															
															//'placeholder'=>'job_category',
															'title'=>__('Job Category', 'job-board-manager'),
															'option_details'=>__('Select Job Category.', 'job-board-manager'),					
															'input_type'=>'select', // text, radio, checkbox, select,
															'input_values'=>array(''), // could be array
															'input_args'=> job_bm_get_terms('job_category'), // job_bm_get_terms('ads_cat')
															
															),
								
/*

														array(
															'meta_key'=>'ads_tag',
															'css_class'=>'ads_tag',
															'placeholder'=>'ads_tag',
															'title'=>__('Job tags', 'job-board-manager'),
															'option_details'=>__('Choose Job Tags, you can select multiple.', 'job-board-manager'),					
															'input_type'=>'select_multi', // text, radio, checkbox, select,
															'input_values'=>array(''), // could be array
															'input_args'=> job_bm_get_terms('ads_tag'),
															//'field_args'=> array('size'=>'',),
															),

*/								

														);
		
		
		$input_fields['recaptcha'] = array(
														'meta_key'=>'recaptcha',
														'css_class'=>'recaptcha',
														'required'=>'yes', // (yes, no) is this field required.
														'display'=>'yes', // (yes, no)
														//'placeholder'=>'',
														'title'=>__('reCaptcha', 'job-board-manager'),
														'option_details'=>__('reCaptcha test.', 'job-board-manager'),					
														'input_type'=>'recaptcha', // text, radio, checkbox, select,
														'input_values'=>get_option('job_bm_reCAPTCHA_site_key'), // could be array
														//'field_args'=> array('size'=>'',),
														);
														
															
		
		
		$input_fields['meta_fields'] =	array(
										
										'company_info'=>array(
										
												'title'=>__('Company info', 'job-board-manager'),
												'details'=>__('Company Information details', 'job-board-manager'),
												'meta_fields'=> array(
												
																	'job_bm_company_name'=>array(
																		'meta_key'=>'job_bm_company_name',
																		'css_class'=>'company_name',
																		//'placeholder'=>__('Write Company Name Here.','job-board-manager'),
																		'required'=>'yes', // (yes, no) is this field required.
																		'display'=>'yes', // (yes, no)
																		'title'=>__('Company name', 'job-board-manager'),
																		'option_details'=>__('Company name, ex: Google Inc.', 'job-board-manager'),						
																		'input_type'=>'text', // text, radio, checkbox, select, 
																		'input_values'=>'', // could be array
																		),
																			
																	/* 'job_bm_display_company_name'=>array(
																		'meta_key'=>'job_bm_display_company_name',
																		'css_class'=>'display_company_name',	
																		//'placeholder'=>__('','job-board-manager'),
																		'required'=>'yes', // (yes, no) is this field required.	
																		'display'=>'yes', // (yes, no)	
																		'title'=>__('Display company name ?', 'job-board-manager'),
																		'option_details'=>__('Do you want to display company name', 'job-board-manager'),						
																		'input_type'=>'radio', // text, radio, checkbox, select, 
																		'input_values'=> 'yes', // could be array
																		'input_args'=> array('yes'=>__('Yes', 'job-board-manager'),'no'=>__('No', 'job-board-manager')),
																		), */
												
												
												
																	'job_bm_location'=>array(
																		'meta_key'=>'job_bm_location',
																		'css_class'=>'location',		
																		//'placeholder'=>__('','job-board-manager'),	
																		'required'=>'yes', // (yes, no) is this field required.		
																		'title'=>__('Location', 'job-board-manager'),
																		'display'=>'yes', // (yes, no)
																		'option_details'=>__('Job location, ex: California (City or States)', 'job-board-manager'),						
																		'input_type'=>'text', // text, radio, checkbox, select, 
																		'input_values'=>'', // could be array
																		),
																		
																	'job_bm_address'=>array(
																		'meta_key'=>'job_bm_address',
																		'css_class'=>'address',		
																		//'placeholder'=>__('','job-board-manager'),
																		'required'=>'yes', // (yes, no) is this field required.		
																		'display'=>'yes', // (yes, no)
																		'title'=>__('Address','job-board-manager'),
																		'option_details'=>__('Full address, ex: 1600 Amphitheatre Parkway, Mountain View, CA 94043', 'job-board-manager'),						
																		'input_type'=>'textarea', // text, radio, checkbox, select, 
																		'input_values'=>'', // could be array
																		),									
																		
																	/* 'job_bm_display_company_address'=>array(
																		'meta_key'=>'job_bm_display_company_address',
																		'css_class'=>'display_company_address',	
																		//'placeholder'=>__('','job-board-manager'),
																		'required'=>'no', // (yes, no) is this field required.	
																		'display'=>'yes', // (yes, no)		
																		'title'=>__('Display company address ?', 'job-board-manager'),
																		'option_details'=>__('Do you want to display company address', 'job-board-manager'),						
																		'input_type'=>'radio', // text, radio, checkbox, select, 
																		'input_values'=> 'yes', // could be array
																		'input_args'=> array('yes'=>__('Yes','job-board-manager'),'no'=>__('No','job-board-manager')),
																		), */
									
																							
																	'job_bm_company_website'=>array(
																		'meta_key'=>'job_bm_company_website',
																		'css_class'=>'company_website',	
																		//'placeholder'=>__('','job-board-manager'),	
																		'required'=>'no', // (yes, no) is this field required.	
																		'display'=>'yes', // (yes, no)		
																		'title'=>__('Company website', 'job-board-manager'),
																		'option_details'=>__('Company website, ex: http://example.com', 'job-board-manager'),						
																		'input_type'=>'text', // text, radio, checkbox, select, 
																		'input_values'=>'', // could be array
																		),

																	'job_bm_company_logo'=>array(
																		'meta_key'=>'job_bm_company_logo',
																		'css_class'=>'company_logo',	
																		//'placeholder'=>__('','job-board-manager'),	
																		'required'=>'no', // (yes, no) is this field required.	
																		'display'=>'yes', // (yes, no)		
																		'title'=>__('Company logo', 'job-board-manager'),
																		'option_details'=>__('Upload company logo.', 'job-board-manager'),						
																		'input_type'=>'file', // text, radio, checkbox, select, 
																		'input_values'=>'', // could be array
																		),

																		
																	'job_bm_job_link'=>array(
																		'meta_key'=>'job_bm_job_link',
																		'css_class'=>'job_link',	
																		//'placeholder'=>__('Job link on company website.','job-board-manager'),
																		'required'=>'no', // (yes, no) is this field required.		
																		'display'=>'yes', // (yes, no)	
																		'title'=>__('Job link', 'job-board-manager'),
																		'option_details'=>__('Job link at company website, ex: http://example.com/jobs/developer-wanted','job-board-manager'),					
																		'input_type'=>'text', // text, radio, checkbox, select,
																		'input_values'=>'', // could be array
																		
																		),

																	
																	),
										
												),
		
		
										'job_info'=>array(
										
												'title'=>__(' Job info', 'job-board-manager'),
												'details'=>__('Job Information details.', 'job-board-manager'),
												'meta_fields'=> array(
												
/*
												 *
 * 																	'job_bm_job_status'=>array(
																		'meta_key'=>'job_bm_job_status',
																		'css_class'=>'job_status',
																		'required'=>'yes', // (yes, no) is this field required.
																		'display'=>'yes', // (yes, no)
																		'title'=>__('Job status', 'job-board-manager'),
																		'option_details'=>__('Select job status.', 'job-board-manager'),
																		'input_type'=>'select', // text, radio, checkbox, select,
																		'input_values'=> '', // could be array
																		'input_args'=> $this->job_status_list(),
																		),
												 * */
												
																	/* 'job_bm_short_content'=>array(
																		'meta_key'=>'job_bm_short_content',
																		'css_class'=>'short_content',		
																		'required'=>'no', // (yes, no) is this field required.	
																		'display'=>'yes', // (yes, no)		
																		'title'=>__('Short content','job-board-manager'),
																		'option_details'=>__('Short job description write here.', 'job-board-manager'),						
																		'input_type'=>'wp_editor', // text, radio, checkbox, select, 
																		'input_values'=>'', // could be array
																		),
																		 */
																	/* 'job_bm_responsibilities'=>array(
																		'meta_key'=>'job_bm_responsibilities',
																		'css_class'=>'responsibilities',
																		'required'=>'no', // (yes, no) is this field required.
																		'display'=>'yes', // (yes, no)
																		'title'=>__('Job responsibilities', 'job-board-manager'),
																		'option_details'=>__('Responsibilities details.', 'job-board-manager'),						
																		'input_type'=>'wp_editor', // text, radio, checkbox, select, 
																		'input_values'=>'', // could be array
																		),
																		
																	'job_bm_education_requirements'=>array(
																		'meta_key'=>'job_bm_education_requirements',
																		'css_class'=>'education_requirements',	
																		'required'=>'no', // (yes, no) is this field required.
																		'display'=>'yes', // (yes, no)			
																		'title'=>__('Education requirements', 'job-board-manager'),
																		'option_details'=>__('Education requirements details.', 'job-board-manager'),						
																		'input_type'=>'wp_editor', // text, radio, checkbox, select, 
																		'input_values'=>'', // could be array
																		),
																		
																	'job_bm_experience_requirements'=>array(
																		'meta_key'=>'job_bm_experience_requirements',
																		'css_class'=>'experience_requirements',		
																		'required'=>'no', // (yes, no) is this field required.
																		'display'=>'yes', // (yes, no)		
																		'title'=>__('Experience requirements', 'job-board-manager'),
																		'option_details'=>__('Experience requirements details.', 'job-board-manager'),						
																		'input_type'=>'wp_editor', // text, radio, checkbox, select, 
																		'input_values'=>'', // could be array
																		),	
																		
																	'job_bm_skills_requirements'=>array(
																		'meta_key'=>'job_bm_skills_requirements',
																		'css_class'=>'skills_requirements',	
																		'required'=>'no', // (yes, no) is this field required.
																		'display'=>'yes', // (yes, no)			
																		'title'=>__('Skills requirements', 'job-board-manager'),
																		'option_details'=>__('Skills requirements details.', 'job-board-manager'),						
																		'input_type'=>'wp_editor', // text, radio, checkbox, select, 
																		'input_values'=>'', // could be array
																		),																									
																		
																	'job_bm_qualifications'=>array(
																		'meta_key'=>'job_bm_qualifications',
																		'css_class'=>'qualifications',	
																		'required'=>'no', // (yes, no) is this field required.
																		'display'=>'yes', // (yes, no)			
																		'title'=>__('Qualifications', 'job-board-manager'),
																		'option_details'=>__('Qualifications details.', 'job-board-manager'),						
																		'input_type'=>'wp_editor', // text, radio, checkbox, select, 
																		'input_values'=>'', // could be array
																		),										
																		 */
																		
																			
																	'job_bm_total_vacancies'=>array(
																		'meta_key'=>'job_bm_total_vacancies',
																		'css_class'=>'total_vacancies',	
																		'required'=>'no', // (yes, no) is this field required.
																		'display'=>'yes', // (yes, no)		
																		'title'=>__('No of vacancies', 'job-board-manager'),
																		'option_details'=>__('Total number of vacancies.', 'job-board-manager'),						
																		'input_type'=>'text', // text, radio, checkbox, select, 
																		'input_values'=>'3', // could be array
																		),			
												
/*
 * 																	'job_bm_expire_date'=>array(
																		'meta_key'=>'job_bm_expire_date',
																		'css_class'=>'expire_date',
																		'required'=>'no', // (yes, no) is this field required.
																		'display'=>'yes', // (yes, no)
																		'title'=>__('Expiry date', 'job-board-manager'),
																		'option_details'=>__('Job expiry date', 'job-board-manager'),
																		'input_type'=>'text', // text, radio, checkbox, select,
																		'input_values'=> job_bm_get_date(), // could be array
																		),*/
																		
/*

																	'job_bm_featured'=>array(
																		'meta_key'=>'job_bm_featured',
																		'css_class'=>'featured',
																		'required'=>'no', // (yes, no) is this field required.
																		'display'=>'yes', // (yes, no)
																		'title'=>__('Featured job', 'job-board-manager'),
																		'option_details'=>__('Want to get featured listing ?', 'job-board-manager'),
																		'input_type'=>'select', // text, radio, checkbox, select,
																		'input_values'=>'no', // could be array
																		'input_args'=> array('no'=>__('No', 'job-board-manager'),'yes'=>__('Yes', 'job-board-manager')),
																		),
																		*/
																		
																	'job_bm_job_type'=>array(
																		'meta_key'=>'job_bm_job_type',
																		'css_class'=>'job_type',	
																		'required'=>'no', // (yes, no) is this field required.
																		'display'=>'yes', // (yes, no)			
																		'title'=>__('Job type ?', 'job-board-manager'),
																		'option_details'=>__('Choose job type.', 'job-board-manager'),						
																		'input_type'=>'select', // text, radio, checkbox, select, 
																		'input_values'=> 'full-time', // could be array
																		'input_args'=> $this->job_type_list(),
																		),
																		
																	'job_bm_job_level'=>array(
																		'meta_key'=>'job_bm_job_level',
																		'css_class'=>'job_level',		
																		'required'=>'no', // (yes, no) is this field required.
																		'display'=>'yes', // (yes, no)	
																		'title'=>__('Job level ?', 'job-board-manager'),
																		'option_details'=>__('Choose job level', 'job-board-manager'),						
																		'input_type'=>'select', // text, radio, checkbox, select, 
																		'input_values'=> '', // could be array
																		'input_args'=> $this->job_level_list(),
																		),
																		
																	'job_bm_years_experience'=>array(
																		'meta_key'=>'job_bm_years_experience',
																		'css_class'=>'years_experience',	
																		'required'=>'no', // (yes, no) is this field required.
																		'display'=>'yes', // (yes, no)			
																		'title'=>__('Years of experience ?', 'job-board-manager'),
																		'option_details'=>__('Years of experience must have.', 'job-board-manager'),						
																		'input_type'=>'text', // text, radio, checkbox, select, 
																		'input_values'=> '2', // could be array
																		),
																		
																		
																	// Import Source	
																		
/*

																	array(
																		'meta_key'=>'job_bm_is_imported',
																		'css_class'=>'is_imported hidden',					
																		'title'=>__('Is imported ?','job-board-manager'),
																		'option_details'=>__('Is imported','job-board-manager'),						
																		'input_type'=>'hidden', // text, radio, checkbox, select, 
																		'input_values'=> 'no', // could be array
																		),		
																		
																		
																	array(
																		'meta_key'=>'job_bm_import_source',
																		'css_class'=>'import_source hidden',					
																		'title'=>__('Import source ?','job-board-manager'),
																		'option_details'=>__('Import source','job-board-manager'),						
																		'input_type'=>'hidden', // text, radio, checkbox, select, 
																		'input_values'=> '', // could be array
																		),																	
																										
																		
																	array(
																		'meta_key'=>'job_bm_import_source_jobid',
																		'css_class'=>'import_source_jobid hidden',					
																		'title'=>__('Import source jobid ?','job-board-manager'),
																		'option_details'=>__('Import source jobid','job-board-manager'),						
																		'input_type'=>'hidden', // text, radio, checkbox, select, 
																		'input_values'=> '', // could be array
																		),

*/		
																										
																										
																										
																	
																	
																	
																	)
															),
		
		
		
		
										'salary_info'=>array(
										
												'title'=>__('Salary info','job-board-manager'),
												'details'=>__('Salary Information details.', 'job-board-manager'),
												'meta_fields'=> array(
												
												
																	'job_bm_salary_type'=>array(
																		'meta_key'=>'job_bm_salary_type',
																		'css_class'=>'salary_type',			
																		'required'=>'yes', // (yes, no) is this field required.
																		'display'=>'yes', // (yes, no)
																		'title'=>__('Salary range ?', 'job-board-manager'),
																		'option_details'=>__('Salary range', 'job-board-manager'),						
																		'input_type'=>'radio', // text, radio, checkbox, select, 
																		'input_values'=> 'negotiable', // could be array
																		'input_args'=> $this->salary_type_list(),
																		),
									
																		
																	'job_bm_salary_fixed'=>array(
																		'meta_key'=>'job_bm_salary_fixed',
																		'css_class'=>'salary_fixed',		
																		'required'=>'no', // (yes, no) is this field required.
																		'display'=>'yes', // (yes, no)		
																		'title'=>__('Salary fixed ?', 'job-board-manager'),
																		'option_details'=>__('Salary fixed, ex: 1200', 'job-board-manager'),						
																		'input_type'=>'text', // text, radio, checkbox, select, 
																		'input_values'=> '', // could be array
																		),									
																		
																		
																	'job_bm_salary_min'=>array(
																		'meta_key'=>'job_bm_salary_min',
																		'css_class'=>'salary_min',		
																		'required'=>'no', // (yes, no) is this field required.
																		'display'=>'yes', // (yes, no)		
																		'title'=>__('Salary minimum ?', 'job-board-manager'),
																		'option_details'=>__('Salary minimum, ex: 100', 'job-board-manager'),						
																		'input_type'=>'text', // text, radio, checkbox, select, 
																		'input_values'=> '', // could be array
																		),																	
																		
																	'job_bm_salary_max'=>array(
																		'meta_key'=>'job_bm_salary_max',
																		'css_class'=>'salary_max',		
																		'required'=>'no', // (yes, no) is this field required.
																		'display'=>'yes', // (yes, no)		
																		'title'=>__('Salary maximum ?', 'job-board-manager'),
																		'option_details'=>__('Salary maximum, ex: 1000', 'job-board-manager'),						
																		'input_type'=>'text', // text, radio, checkbox, select, 
																		'input_values'=> '', // could be array
																		),
																		
																	'job_bm_salary_currency'=>array(
																		'meta_key'=>'job_bm_salary_currency',
																		'css_class'=>'salary_currency',		
																		'required'=>'no', // (yes, no) is this field required.
																		'display'=>'yes', // (yes, no)	
																		'title'=>__('Salary currency ?', 'job-board-manager'),
																		'option_details'=>__('Salary currency(Optional)', 'job-board-manager'),						
																		'input_type'=>'text', // text, radio, checkbox, select, 
																		'input_values'=> '', // could be array
																		),
																					
												
												
												
												
												
																	)
												
												
														),
		
		
										'application'=>array(
										
                                            'title'=>__('Application info', 'job-board-manager'),
                                            'details'=>__('Application Information details.', 'job-board-manager'),
                                            'meta_fields'=> array(


                                                'job_bm_how_to_apply'=>array(
                                                    'meta_key'=>'job_bm_how_to_apply',
                                                    'css_class'=>'how_to_apply',
                                                    'required'=>'yes', // (yes, no) is this field required.
                                                    'display'=>'yes', // (yes, no)
                                                    'title'=>__('How to apply ?', 'job-board-manager'),
                                                    'option_details'=>__('How to apply your job, instruction for applicant ?', 'job-board-manager'),
                                                    'input_type'=>'textarea', // text, radio, checkbox, select,
                                                    'input_values'=> '', // could be array
                                                    ),

                                                'job_bm_contact_email'=>array(
                                                    'meta_key'=>'job_bm_contact_email',
                                                    'css_class'=>'contact_email',
                                                    'required'=>'yes', // (yes, no) is this field required.
                                                    'display'=>'yes', // (yes, no)
                                                    'title'=>__('Contact email ?', 'job-board-manager'),
                                                    'option_details'=>__('Contact email','job-board-manager'),
                                                    'input_type'=>'text', // text, radio, checkbox, select,
                                                    'input_values'=> '', // could be array
                                                    ),
                                                )
                                            ),
                                        );


		
			$input_fields_all = apply_filters( 'job_bm_filter_job_input_fields', $input_fields );

			

			return $input_fields_all;
		
		
	}
	


	
	
	
	
	
	public function settings_fields(){
		
		
		$input_fields =	array(
										
							'general_options'=>array(
							
									'title'=>__('Options', 'job-board-manager'),
									'details'=>__('General options.', 'job-board-manager'),
									'options'=> array(
									
														'job_bm_list_per_page'=>array(
															'option_id'=>'job_bm_list_per_page',
															'css_class'=>'list_per_page',
															//'placeholder'=>__('Write Company Name Here.','job-board-manager'),
															'required'=>'yes', // (yes, no) is this field required.
															'display'=>'yes', // (yes, no)
															'title'=>__('Post Per Page', 'job-board-manager'),
															'option_details'=>__('Job list post per page.', 'job-board-manager'),						
															'input_type'=>'text', // text, radio, checkbox, select, 
															'input_values'=>'', // could be array
															),
															
															
														'job_bm_list_excerpt_display'=>array(
															'option_id'=>'job_bm_list_excerpt_display',
															'css_class'=>'excerpt_display',
															//'placeholder'=>__('Write Company Name Here.','job-board-manager'),
															'required'=>'yes', // (yes, no) is this field required.
															'display'=>'yes', // (yes, no)
															'title'=>__('Excerpt display', 'job-board-manager'),
															'option_details'=>__('Display short content form following.', 'job-board-manager'),						
															'input_type'=>'select', // text, radio, checkbox, select, 
															'input_values'=>'from_content', // could be array
															'input_args'=> array( 'from_content'=>__('From Content', 'job-board-manager'), 'short_content'=>__('Short Content', 'job-board-manager'),),
															),	
																													
														'job_bm_list_excerpt_word_count'=>array(
															'option_id'=>'job_bm_list_excerpt_word_count',
															'css_class'=>'excerpt_word_count',
															//'placeholder'=>__('Write Company Name Here.','job-board-manager'),
															'required'=>'yes', // (yes, no) is this field required.
															'display'=>'yes', // (yes, no)
															'title'=>__('Excerpt Word Count', 'job-board-manager'),
															'option_details'=>__('Excerpt display word count.', 'job-board-manager'),						
															'input_type'=>'text', // text, radio, checkbox, select, 
															'input_values'=>'20', // could be array
															),															
															
															
															
															
															
										)
								),
								
								

								
								
							'pages'=>array(
							
									'title'=>__('pages', 'job-board-manager'),
									'details'=>__('Options for pages.', 'job-board-manager'),
									'options'=> array(
									
									
									
									
														'job_bm_archive_page_id'=>array(
															'option_id'=>'job_bm_archive_page_id',
															'css_class'=>'archive_page_id',
															//'placeholder'=>__('Write Company Name Here.','job-board-manager'),
															'required'=>'yes', // (yes, no) is this field required.
															'display'=>'yes', // (yes, no)
															'title'=>__('Archive Page', 'job-board-manager'),
															'option_details'=>__('Archive page job list page where placed the short-code [job_list].', 'job-board-manager'),						
															'input_type'=>'select', // text, radio, checkbox, select, 
															'input_values'=>'yes', // could be array
															'input_args'=> job_bm_page_list_id(),
															),									
									
														'job_bm_job_submit_page_id'=>array(
															'option_id'=>'job_bm_job_submit_page_id',
															'css_class'=>'job_submit_page_id',
															//'placeholder'=>__('Write Company Name Here.','job-board-manager'),
															'required'=>'yes', // (yes, no) is this field required.
															'display'=>'yes', // (yes, no)
															'title'=>__('Job Submit Page', 'job-board-manager'),
															'option_details'=>__('Job submission page id.', 'job-board-manager'),						
															'input_type'=>'select', // text, radio, checkbox, select, 
															'input_values'=>'yes', // could be array
															'input_args'=> job_bm_page_list_id(),
															),									
									
														'job_bm_job_edit_page_id'=>array(
															'option_id'=>'job_bm_job_edit_page_id',
															'css_class'=>'job_edit_page_id',
															//'placeholder'=>__('Write Company Name Here.','job-board-manager'),
															'required'=>'yes', // (yes, no) is this field required.
															'display'=>'yes', // (yes, no)
															'title'=>__('Job Edit Page', 'job-board-manager'),
															'option_details'=>__('Job edit page id.', 'job-board-manager'),						
															'input_type'=>'select', // text, radio, checkbox, select, 
															'input_values'=>'yes', // could be array
															'input_args'=> job_bm_page_list_id(),
															),										
									
									
														'job_bm_job_login_page_id'=>array(
															'option_id'=>'job_bm_job_login_page_id',
															'css_class'=>'job_login_page_id',
															//'placeholder'=>__('Write Company Name Here.','job-board-manager'),
															'required'=>'yes', // (yes, no) is this field required.
															'display'=>'yes', // (yes, no)
															'title'=>__('My Account Page', 'job-board-manager'),
															'option_details'=>__('My account page id.', 'job-board-manager'),						
															'input_type'=>'select', // text, radio, checkbox, select, 
															'input_values'=>'yes', // could be array
															'input_args'=> job_bm_page_list_id(),
															),										
																		
									
														'job_bm_registration_enable'=>array(
															'option_id'=>'job_bm_registration_enable',
															'css_class'=>'job_login_page_id',
															//'placeholder'=>__('Write Company Name Here.','job-board-manager'),
															'required'=>'yes', // (yes, no) is this field required.
															'display'=>'yes', // (yes, no)
															'title'=>__('Registration enable ?', 'job-board-manager'),
															'option_details'=>__('Registration enable on my account page.', 'job-board-manager'),						
															'input_type'=>'select', // text, radio, checkbox, select, 
															'input_values'=>'yes', // could be array
															'input_args'=> job_bm_page_list_id(),
															),									
									
									
														'job_bm_login_enable'=>array(
															'option_id'=>'job_bm_login_enable',
															'css_class'=>'login_enable',
															//'placeholder'=>__('Write Company Name Here.','job-board-manager'),
															'required'=>'yes', // (yes, no) is this field required.
															'display'=>'yes', // (yes, no)
															'title'=>__('Login enable ?', 'job-board-manager'),
															'option_details'=>__('Login enable on my account page.', 'job-board-manager'),						
															'input_type'=>'select', // text, radio, checkbox, select, 
															'input_values'=>'yes', // could be array
															'input_args'=>  array( 'yes'=>__('Yes', 'job-board-manager'), 'no'=>__('No', 'job-board-manager'),),
															),									
				
															
															
										)
								),								
																
								
								
							'job_post'=>array(
							
									'title'=>__('Job Post', 'job-board-manager'),
									'details'=>__('Options for Job Post.', 'job-board-manager'),
									'options'=> array(

														'job_bm_account_required_post_job'=>array(
															'option_id'=>'job_bm_account_required_post_job',
															'css_class'=>'account_required_post_job',
															//'placeholder'=>__('Write Company Name Here.','job-board-manager'),
															'required'=>'yes', // (yes, no) is this field required.
															'display'=>'yes', // (yes, no)
															'title'=>__('Account Required ?', 'job-board-manager'),
															'option_details'=>__('Account required to post job.', 'job-board-manager'),						
															'input_type'=>'select', // text, radio, checkbox, select, 
															'input_values'=>'yes', // could be array
															'input_args'=> array( 'yes'=>__('Yes', 'job-board-manager'), 'no'=>__('No', 'job-board-manager'),),
															),
															
															
														'job_bm_reCAPTCHA_enable'=>array(
															'option_id'=>'job_bm_reCAPTCHA_enable',
															'css_class'=>'reCAPTCHA_enable',
															//'placeholder'=>__('Write Company Name Here.','job-board-manager'),
															'required'=>'yes', // (yes, no) is this field required.
															'display'=>'yes', // (yes, no)
															'title'=>__('reCAPTCHA enable ?', 'job-board-manager'),
															'option_details'=>__('Enable reCAPTCHA to protect spam.', 'job-board-manager'),						
															'input_type'=>'select', // text, radio, checkbox, select, 
															'input_values'=>'no', // could be array
															'input_args'=> array( 'no'=>__('No', 'job-board-manager'), 'yes'=>__('Yes', 'job-board-manager'),), // could be array
															),	
																													
														'job_bm_reCAPTCHA_site_key'=>array(
															'option_id'=>'job_bm_reCAPTCHA_site_key',
															'css_class'=>'reCAPTCHA_site_key',
															//'placeholder'=>__('Write Company Name Here.','job-board-manager'),
															'required'=>'yes', // (yes, no) is this field required.
															'display'=>'yes', // (yes, no)
															'title'=>__('reCAPTCHA site key', 'job-board-manager'),
															'option_details'=>__('reCAPTCHA site key, please go <a href="https://www.google.com/recaptcha">google.com/reCAPTCHA</a> and register your site to get site key.', 'job-board-manager'),						
															'input_type'=>'text', // text, radio, checkbox, select, 
															'input_values'=>'20', // could be array
															),	
															
														'job_bm_reCAPTCHA_secret_key'=>array(
															'option_id'=>'job_bm_reCAPTCHA_secret_key',
															'css_class'=>'reCAPTCHA_site_key',
															//'placeholder'=>__('Write Company Name Here.','job-board-manager'),
															'required'=>'yes', // (yes, no) is this field required.
															'display'=>'yes', // (yes, no)
															'title'=>__('reCAPTCHA secret key', 'job-board-manager'),
															'option_details'=>__('reCAPTCHA secret key, please go <a href="https://www.google.com/recaptcha">google.com/reCAPTCHA</a> and register your site to get secret key.', 'job-board-manager'),						
															'input_type'=>'text', // text, radio, checkbox, select, 
															'input_values'=>'20', // could be array
															),																
															
														'job_bm_submitted_job_status'=>array(
															'option_id'=>'job_bm_submitted_job_status',
															'css_class'=>'submitted_job_status',
															//'placeholder'=>__('Write Company Name Here.','job-board-manager'),
															'required'=>'yes', // (yes, no) is this field required.
															'display'=>'yes', // (yes, no)
															'title'=>__('New Submitted Job Status ?', 'job-board-manager'),
															'option_details'=>__('Submitted job status.', 'job-board-manager'),						
															'input_type'=>'select', // text, radio, checkbox, select, 
															'input_values'=>'pending', // could be array
															'input_args'=> array( 'draft'=>__('Draft', 'job-board-manager'), 'pending'=>__('Pending', 'job-board-manager'), 'publish'=>__('Published', 'job-board-manager'), 'private'=>__('Private', 'job-board-manager'), 'trash'=>__('Trash', 'job-board-manager')),
															),															
															
																
														'job_bm_salary_currency'=>array(
															'option_id'=>'job_bm_salary_currency',
															'css_class'=>'salary_currency',
															'placeholder'=>__('$', 'job-board-manager'),
															'required'=>'yes', // (yes, no) is this field required.
															'display'=>'yes', // (yes, no)
															'title'=>__('Salary currency ?', 'job-board-manager'),
															'option_details'=>__('Salary currency display on job page.', 'job-board-manager'),						
															'input_type'=>'text', // text, radio, checkbox, select, 
															'input_values'=>'$', // could be array
															),																
																
																
														'job_bm_apply_method'=>array(
															'option_id'=>'job_bm_apply_method',
															'css_class'=>'apply_method',
															//'placeholder'=>__('Write Company Name Here.','job-board-manager'),
															'required'=>'yes', // (yes, no) is this field required.
															'display'=>'yes', // (yes, no)
															'title'=>__('Apply Method ?', 'job-board-manager'),
															'option_details'=>__('Enable apply methods.', 'job-board-manager'),						
															'input_type'=>'checkbox', // text, radio, checkbox, select, 
															'input_values'=>array('direct_email'), // could be array
															'input_args'=> $this->apply_method_list(),
															),																
																
																
														'job_bm_can_user_delete_jobs'=>array(
															'option_id'=>'job_bm_can_user_delete_jobs',
															'css_class'=>'can_user_delete_jobs',
															//'placeholder'=>__('Write Company Name Here.','job-board-manager'),
															'required'=>'yes', // (yes, no) is this field required.
															'display'=>'yes', // (yes, no)
															'title'=>__('Can user delete jobs ?', 'job-board-manager'),
															'option_details'=>__('Can user delete their own jobs.', 'job-board-manager'),						
															'input_type'=>'select', // text, radio, checkbox, select, 
															'input_values'=>'yes', // could be array
															'input_args'=>  array( 'no'=>__('No', 'job-board-manager'), 'yes'=>__('Yes', 'job-board-manager'),),
															),																
																
																
														'job_bm_can_user_edit_published_jobs'=>array(
															'option_id'=>'job_bm_can_user_edit_published_jobs',
															'css_class'=>'can_user_edit_published_jobs',
															//'placeholder'=>__('Write Company Name Here.','job-board-manager'),
															'required'=>'yes', // (yes, no) is this field required.
															'display'=>'yes', // (yes, no)
															'title'=>__('Can user edit published jobs ?', 'job-board-manager'),
															'option_details'=>__('Can user edit published jobs.', 'job-board-manager'),						
															'input_type'=>'select', // text, radio, checkbox, select, 
															'input_values'=>'yes', // could be array
															'input_args'=>  array( 'no'=>__('No', 'job-board-manager'), 'yes'=>__('Yes', 'job-board-manager'),),
															),																
																
																
														'job_bm_display_preview_after_submit'=>array(
															'option_id'=>'job_bm_display_preview_after_submit',
															'css_class'=>'display_preview_after_submit',
															//'placeholder'=>__('Write Company Name Here.','job-board-manager'),
															'required'=>'yes', // (yes, no) is this field required.
															'display'=>'yes', // (yes, no)
															'title'=>__('Display preview after submitted job ?', 'job-board-manager'),
															'option_details'=>__('User can see the job preview after submitted.', 'job-board-manager'),						
															'input_type'=>'select', // text, radio, checkbox, select, 
															'input_values'=>'yes', // could be array
															'input_args'=>  array( 'no'=>__('No', 'job-board-manager'), 'yes'=>__('Yes', 'job-board-manager'),),
															),		
																
																
																													
															
															
															
															
															
										)
								),								
																
								
							
								
							'notification'=>array(
							
									'title'=>__('Notification', 'job-board-manager'),
									'details'=>__('Options for Notification.', 'job-board-manager'),
									'options'=> array(

														'job_bm_logo_url'=>array(
															'option_id'=>'job_bm_logo_url',
															'css_class'=>'email_logo_url',
															//'placeholder'=>__('Write Company Name Here.','job-board-manager'),
															'required'=>'yes', // (yes, no) is this field required.
															'display'=>'yes', // (yes, no)
															'title'=>__('Email Logo URL', 'job-board-manager'),
															'option_details'=>__('Email logo URL to display on mail.', 'job-board-manager'),						
															'input_type'=>'file', // text, radio, checkbox, select, 
															'input_values'=>job_bm_plugin_url.'assets/admin/images/email-logo.png', // could be array
															
															),
															
																
														'job_bm_from_email'=>array(
															'option_id'=>'job_bm_from_email',
															'css_class'=>'from_email',
															'placeholder'=>'',
															'required'=>'yes', // (yes, no) is this field required.
															'display'=>'yes', // (yes, no)
															'title'=>__('From Email', 'job-board-manager'),
															'option_details'=>__('From Email Address.', 'job-board-manager'),						
															'input_type'=>'text', // text, radio, checkbox, select, 
															'input_values'=>get_option('admin_email'), // could be array
															),																
																
																
															
																
																
														'job_bm_notify_email_job_submit'=>array(
															'option_id'=>'job_bm_notify_email_job_submit',
															'css_class'=>'notify_email_job_submit',
															//'placeholder'=>__('Write Company Name Here.','job-board-manager'),
															'required'=>'yes', // (yes, no) is this field required.
															'display'=>'yes', // (yes, no)
															'title'=>__('Notify admin new job submit ?', 'job-board-manager'),
															'option_details'=>__('Notify admin when new job submitted.', 'job-board-manager'),						
															'input_type'=>'select', // text, radio, checkbox, select, 
															'input_values'=>'yes', // could be array
															'input_args'=>  array( 'no'=>__('No', 'job-board-manager'), 'yes'=>__('Yes', 'job-board-manager'),),
															),																
																
																
														'job_bm_notify_email_job_publish'=>array(
															'option_id'=>'job_bm_notify_email_job_publish',
															'css_class'=>'notify_email_job_publish',
															//'placeholder'=>__('Write Company Name Here.','job-board-manager'),
															'required'=>'yes', // (yes, no) is this field required.
															'display'=>'yes', // (yes, no)
															'title'=>__('Notify email new job publish ?', 'job-board-manager'),
															'option_details'=>__('Notify email to admin when new job published.', 'job-board-manager'),						
															'input_type'=>'select', // text, radio, checkbox, select, 
															'input_values'=>'yes', // could be array
															'input_args'=>  array( 'no'=>__('No', 'job-board-manager'), 'yes'=>__('Yes', 'job-board-manager'),),
															),																
			
															
										)
								),	
								
								
								
								
						
								
							'style'=>array(
							
									'title'=>__('Style', 'job-board-manager'),
									'details'=>__('Options for style.', 'job-board-manager'),
									'options'=> array(

														'job_bm_featured_bg_color'=>array(
															'option_id'=>'job_bm_featured_bg_color',
															'css_class'=>'featured_bg_color',
															//'placeholder'=>__('Write Company Name Here.','job-board-manager'),
															'required'=>'yes', // (yes, no) is this field required.
															'display'=>'yes', // (yes, no)
															'title'=>__('Featured Job Background Color ?', 'job-board-manager'),
															'option_details'=>__('Featured job area background color.', 'job-board-manager'),						
															'input_type'=>'text', // text, radio, checkbox, select, 
															'input_values'=>'#fff8bf', // could be array
															
															),
															

														'job_bm_job_type_bg_color'=>array(
															'option_id'=>'job_bm_job_type_bg_color',
															'css_class'=>'job_type_bg_color',
															//'placeholder'=>__('Write Company Name Here.','job-board-manager'),
															'required'=>'yes', // (yes, no) is this field required.
															'display'=>'yes', // (yes, no)
															'title'=>__('Job Type Background Color ?', 'job-board-manager'),
															'option_details'=>__('Job types area background color.', 'job-board-manager'),						
															'input_type'=>'text-multi', // text, radio, checkbox, select, 
															'input_values'=> $this->job_type_bg_color(), // could be array
															
															),
																															
														'job_bm_job_status_bg_color'=>array(
															'option_id'=>'job_bm_job_status_bg_color',
															'css_class'=>'job_status_bg_color',
															//'placeholder'=>__('Write Company Name Here.','job-board-manager'),
															'required'=>'yes', // (yes, no) is this field required.
															'display'=>'yes', // (yes, no)
															'title'=>__('Job Status Background Color ?', 'job-board-manager'),
															'option_details'=>__('Job status area background color.', 'job-board-manager'),						
															'input_type'=>'text-multi', // text, radio, checkbox, select, 
															'input_values'=> $this->job_status_bg_color(), // could be array
															
															),															
														
															
										)
								),	
								
																
								
								
								
								
															
																	
								
							);

		
		
		
		
		}
	
	

		
	
	public function job_bm_share_plugin()
		{
			
			?>
<iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwordpress.org%2Fplugins%2Fresumes-builder%2F&amp;width&amp;layout=standard&amp;action=like&amp;show_faces=true&amp;share=true&amp;height=80&amp;appId=652982311485932" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:80px;" allowTransparency="true"></iframe>
            
            <br />
            <!-- Place this tag in your head or just before your close body tag. -->
            <script src="https://apis.google.com/js/platform.js" async defer></script>
            
            <!-- Place this tag where you want the +1 button to render. -->
            <div class="g-plusone" data-size="medium" data-annotation="inline" data-width="300" data-href="<?php echo job_bm_share_url; ?>"></div>
            
            <br />
            <br />
            <a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo job_bm_share_url; ?>" data-text="<?php echo job_bm_plugin_name; ?>" data-via="ParaTheme" data-hashtags="WordPress">Tweet</a>
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>



            <?php

		}
		
		
	
	public function job_bm_list_user_role(){
		
		global $wp_roles;
		$roles = $wp_roles->get_names();
		return $roles;
		}	
		
		
	
	}
	
	new class_job_bm_functions();