<?php
/*
* @Author 		PickPlugins
* Copyright: 	2015 PickPlugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

	$job_bm_salary_currency_option = get_option('job_bm_salary_currency');
	$job_bm_job_type_bg_color = get_option('job_bm_job_type_bg_color');	
	$job_bm_job_status_bg_color = get_option('job_bm_job_status_bg_color');	


	$class_job_bm_post_meta = new class_job_bm_post_meta();
	$job_meta_options = $class_job_bm_post_meta->job_meta_options();	
	
	
	$jobsingle_meta_items = array(
	'job_bm_job_type'=>array('class'=>'job_type','fa'=>'briefcase','title'=>'Job Type'),
	'job_bm_job_status'=>array('class'=>'job_status','fa'=>'','title'=>'Job Status'),															
	'job_bm_location'=>array('class'=>'location','fa'=>'map-marker','title'=>'Location'),
	'job_bm_company_name'=>array('class'=>'company_name','fa'=>'briefcase','title'=>'Company Name'),							
	'job_bm_total_vacancies'=>array('class'=>'total_vacancies','fa'=>'user-plus','title'=>'Total Vacancies'),								
	'job_bm_expire_date'=>array('class'=>'expire_date','fa'=>'calendar-o','title'=>'Expire Date'),
	);
	
	
	$job_level = apply_filters('job_bm_filters_job_level',array('entry_level'=>'Entry level','mid_level'=>'Mid level','top_level'=>'Top level','any'=>'Any',));
	
	$job_type = apply_filters('job_bm_filters_job_type',array('freelance'=>'Freelance','full-time'=>'Full Time','internship'=>'Internship','part-time'=>'Part Time','temporary'=>'Temporary'));
	
	$job_status = apply_filters('job_bm_filters_job_status',array('open'=>'Open','closed'=>'Closed','filled'=>'Filled','re-open'=>'Re-Open','expired'=>'Expired'));	
	
	foreach($job_meta_options as $options_tab=>$options){
		
		foreach($options as $option_key=>$option_data){
			
			$meta_key_values[$option_key] = get_post_meta($job_id, $option_key, true);
			${$option_key} = get_post_meta($job_id, $option_key, true);			
			//var_dump(${$option_key});
			}
		}
		
		
	$job_post_data = get_post($job_id);
	
	
	$job_bm_archive_page_id = get_option('job_bm_archive_page_id');
	$job_bm_archive_page_link = get_permalink($job_bm_archive_page_id);
	
	
	
	
	
	
	