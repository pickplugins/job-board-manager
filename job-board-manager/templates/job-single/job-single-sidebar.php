<?php
/*
* @Author 		PickPlugins
* Copyright: 	2015 PickPlugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

	//$class_job_bm_post_meta = new class_job_bm_post_meta();
	//$job_meta_options = $class_job_bm_post_meta->job_meta_options();
	
	$class_job_bm_functions = new class_job_bm_functions();

	
	$salary_type_list = $class_job_bm_functions->salary_type_list();	
	$job_status_list = $class_job_bm_functions->job_status_list();	
	$job_type_list = $class_job_bm_functions->job_type_list();	
	$job_level_list = $class_job_bm_functions->job_level_list();	
	
	$job_bm_company_name = get_post_meta(get_the_ID(), 'job_bm_company_name', true);	
	$job_bm_display_company_address = get_post_meta(get_the_ID(), 'job_bm_display_company_address', true);
	$job_bm_salary_type = get_post_meta(get_the_ID(), 'job_bm_salary_type', true);	
	$job_bm_contact_email = get_post_meta(get_the_ID(), 'job_bm_contact_email', true);			
	$job_bm_job_status = get_post_meta(get_the_ID(), 'job_bm_job_status', true);
	$job_bm_salary_min = get_post_meta(get_the_ID(), 'job_bm_salary_min', true);
	$job_bm_salary_max = get_post_meta(get_the_ID(), 'job_bm_salary_max', true);
	$job_bm_salary_fixed = get_post_meta(get_the_ID(), 'job_bm_salary_fixed', true);
    $job_bm_salary_currency = get_post_meta(get_the_ID(), 'job_bm_salary_currency', true);
	$job_bm_total_vacancies = get_post_meta(get_the_ID(), 'job_bm_total_vacancies', true);		
	$job_bm_expire_date = get_post_meta(get_the_ID(), 'job_bm_expire_date', true);	
	$job_bm_job_level = get_post_meta(get_the_ID(), 'job_bm_job_level', true);	
	$job_bm_years_experience = get_post_meta(get_the_ID(), 'job_bm_years_experience', true);
	$job_bm_job_type = get_post_meta(get_the_ID(), 'job_bm_job_type', true);
	$job_bm_how_to_apply = get_post_meta(get_the_ID(), 'job_bm_how_to_apply', true);		
	$job_bm_company_logo = get_post_meta(get_the_ID(), 'job_bm_company_logo', true);	
	$job_bm_location = get_post_meta(get_the_ID(), 'job_bm_location', true);	
	$job_bm_address = get_post_meta(get_the_ID(), 'job_bm_address', true);	
	$job_bm_company_website = get_post_meta(get_the_ID(), 'job_bm_company_website', true);
		
		
	
	
	$job_post_data = get_post(get_the_ID());
	
	$job_bm_default_company_logo = get_option('job_bm_default_company_logo');

	$html_about_company = '';
	

		$html_about_company .= '<div class="side-meta company_name">';
		
		if(!empty($job_bm_company_logo)){
			
			if(is_serialized($job_bm_company_logo)){
				
				$job_bm_company_logo = unserialize($job_bm_company_logo);
				if(!empty($job_bm_company_logo[0])){
					$job_bm_company_logo = $job_bm_company_logo[0];
					$job_bm_company_logo = wp_get_attachment_url($job_bm_company_logo);
					}
				else{
					$job_bm_company_logo = $job_bm_default_company_logo;
					}
				}
					
			}
		else{
			$job_bm_company_logo = $job_bm_default_company_logo;
			}
		
		
		if(!empty($job_bm_company_logo))
		$html_about_company .= '<img src="'.$job_bm_company_logo.'" />';	
	
			
		$html_about_company .= $job_bm_company_name;			
		$html_about_company .= '</div>';		
		
		
		//$html_about_company .= '<div class="clear"></div>';
		
	if(!empty($job_bm_location)){
		$html_about_company .= '<div itemprop="jobLocation" itemscope itemtype="http://schema.org/Place"  class="side-meta location"><i class="fa fa-map-marker"></i> '.$job_bm_location.'</div>';
		}

		
	
		
	if($job_bm_display_company_address == 'yes'){
		
		if(!empty($job_bm_address))
		$html_about_company .= '<div  class="side-meta address"><i class="fa fa-home"></i> '.$job_bm_address.'</div>';
		}	
		
		if(!empty($job_bm_company_website))
		$html_about_company .= '<div class="side-meta website"><i class="fa fa-link"></i> <a href="'.$job_bm_company_website.'"> '.__('Website','job-board-manager').'</a></div>';
		
		if(!empty($job_bm_job_link))
		$html_about_company .= '<div class="side-meta website"><i class="fa fa-hand-o-right"></i> <a href="'.$job_bm_job_link.'"> '.__('Job Link','job-board-manager').'</a></div>';



	$sections['about_company'] = array(
						'title'=>__('About Company', 'job-board-manager'),
						'html'=> $html_about_company,						
						
						);
						
						
	$job_info = '';
	
	
	//var_dump($job_status);
	if(!empty($job_bm_job_status))
	$job_info .= '<div class="side-meta"><i class="fa fa-paper-plane-o"></i> '.__('Job Status: ', 'job-board-manager').$job_status_list[$job_bm_job_status].'</div>';
	
	if(!empty($job_bm_total_vacancies))
	$job_info .= '<div class="side-meta"><i class="fa fa-users"></i> '.__('No of Vacancies: ', 'job-board-manager').$job_bm_total_vacancies.'</div>';
	
	
	$job_info .= '<div class="side-meta"><i class="fa fa-calendar-plus-o"></i> '.__('Date Posted: ', 'job-board-manager').get_the_date().'</div>';
	
	if(!empty($job_bm_expire_date)){
		
		$job_bm_expire_date = new DateTime($job_bm_expire_date);
		
		$job_bm_expire_date = $job_bm_expire_date->format('F d, Y');
		
		$job_info .= '<div class="side-meta"><i class="fa fa-exclamation-triangle"></i> '.__('Expiry Date: ','job-board-manager').$job_bm_expire_date.'</div>';
		}
	
	
	if(!empty($job_bm_job_type) && !empty($job_type_list[$job_bm_job_type]))
	$job_info .= '<div itemprop="employmentType" class="side-meta"><i class="fa fa-taxi"></i> '.__('Job Type: ','job-board-manager').$job_type_list[$job_bm_job_type].'</div>';
	
	if(!empty($job_bm_job_level))
	$job_info .= '<div class="side-meta"><i class="fa fa-signal"></i> '.__('Job Level: ','job-board-manager').$job_level_list[$job_bm_job_level].'</div>';
	
	if(!empty($job_bm_years_experience))
	$job_info .= '<div class="side-meta"><i class="fa fa-bolt"></i> '.__('Years of Experience: ','job-board-manager').$job_bm_years_experience.'</div>';
						
						
	$sections['job_info'] = array(
						'title'=>__('Job Info','job-board-manager'),
						'html'=>$job_info,						
						
						);						
						
						
						
						
						
	$salary_info = '';


	if(empty($job_bm_salary_currency)){
		$job_bm_salary_currency = get_option('job_bm_salary_currency', '$');
		
		}

	if(!empty($salary_type_list[$job_bm_salary_type])){
		$salary_info .= '<div class="side-meta">'.__('Salary Type: ','job-board-manager').$salary_type_list[$job_bm_salary_type].'</div>';
		}
	

	
	if($job_bm_salary_type=='fixed'){
		
		$salary_info .= '<div itemprop="baseSalary" class="side-meta">'.__('Salary: ','job-board-manager').$job_bm_salary_currency.ucfirst($job_bm_salary_fixed).'</div>';
		
		}
	elseif($job_bm_salary_type=='min-max'){
		

		$salary_info .= '<div itemprop="baseSalary" class="side-meta">'.__('Salary: ','job-board-manager').$job_bm_salary_currency.$job_bm_salary_min.'-'.$job_bm_salary_currency.$job_bm_salary_max.'</div>';
		
		}	
						
				
						
	$sections['salary_info'] = array(
						'title'=>__('Salary Info','job-board-manager'),
						'html'=> $salary_info,						
						
						);							
						
						
						
						
	$html_apply_method = '';				
						
	if(!empty($job_bm_how_to_apply)){
		//$html_apply_method .= '<div class="side-meta"><i class="fa fa-trophy"></i> '.__('How to Apply ?<br> ','job-board-manager').$job_bm_how_to_apply.'</div>';
		
		}

	$apply_method_html['direct_email'] = '<div class="side-meta"><i class="fa fa-envelope-o"></i> '.__('Apply via email :','job-board-manager').'<a class="apply-job" href="mailto:'.$job_bm_contact_email.'?subject='.$job_post_data->post_title.'">Send Email</a></div>';


	
	$apply_method_html = apply_filters('job_bm_filters_apply_method_html',$apply_method_html);
	
	
	$job_bm_apply_method = get_option('job_bm_apply_method');
	
	if(empty($job_bm_apply_method)){
		
		$job_bm_apply_method = array('direct_email');
		
		}
	
	
	if(!empty($job_bm_apply_method)){
		
		foreach($job_bm_apply_method as $key=>$method){
				
			if(!empty($apply_method_html[$method]))
				$html_apply_method .= $apply_method_html[$method];

			}
		
		}
						
		
	$apply_allowed_job_status = array('open','re-open');
	$apply_not_allowed_job_status = apply_filters('job_bm_filters_apply_allowed_job_status',$apply_allowed_job_status);	
			
						
	if(!in_array($job_bm_job_status, $apply_not_allowed_job_status)){ 
		
		if(!empty($job_status_list[$job_bm_job_status]))
		$html_apply_method = '<i class="fa fa-exclamation-triangle"></i> This job already <b>'.$job_status_list[$job_bm_job_status].'</b>, <br> Application not allowed this job status.';
		
		}			
				
						
	$sections['apply_methods'] = array(
						'title'=>__('Apply on this job','job-board-manager'),
						'html'=> $html_apply_method,						
						);						
						
						
		
			
	$social_share_html['facebook'] ='<a class="facebook share-button" href="https://www.facebook.com/sharer/sharer.php?u='.get_permalink(get_the_ID()).'&t="><i class="fa fa-facebook"></i></a>';
	
	$social_share_html['twitter'] = '<a class="twitter share-button" href="https://twitter.com/intent/tweet?url='.get_permalink(get_the_ID()).'&text='.get_the_title(get_the_ID()).'"><i class="fa fa-twitter"></i></a>';
	
	$social_share_html['googleplus'] = '<a class="google-plus share-button" href="https://plus.google.com/share?url='.get_permalink(get_the_ID()).'"><i class="fa fa-google-plus"></i></a>';			
						
		
	$social_share_html = apply_filters('job_bm_filter_social_share_html',$social_share_html);

	$html_share_job= '';

	$html_share_job.= '<div class="social-share">';

	foreach($social_share_html as $key=>$html){
		
			$html_share_job.= $html;
		
		
		}
	
	$html_share_job.= '</div>';
						
//	$sections['share_job'] = array(
//						'title'=>__('Share this job','job-board-manager'),
//						'html'=> $html_share_job,
//
//						);
						
						
						
						
						
						
						
	$sections = apply_filters('job_bm_filter_sidebar_sections',$sections);				







?>

<div class="single-job-sidebar">
	<div class="inner">
	<?php
    
		if(!empty($sections))
        foreach($sections as $section){
            echo '<div class="section">';
            echo '<div class="title">'.$section['title'].'</div>';
            echo $section['html'];
            echo '</div>';	// .section	
            
            }
    
    ?>
	</div>

</div>