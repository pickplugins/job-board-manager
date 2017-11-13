<?php
/*
* @Author 		PickPlugins
* Copyright: 	2015 PickPlugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 


//var_dump($job_bm_company_logo);
// a:1:{i:0;s:5:"12187";}

$job_bm_default_company_logo = get_option('job_bm_default_company_logo');



if(!empty($job_bm_company_logo)){
	
	if(is_serialized($job_bm_company_logo)){
		
		$job_bm_company_logo = unserialize($job_bm_company_logo);
		if(!empty($job_bm_company_logo[0])){
			$job_bm_company_logo = $job_bm_company_logo[0];
			$job_bm_company_logo = wp_get_attachment_url($job_bm_company_logo);
			}
		else{
			//$job_bm_company_logo = job_bm_plugin_url.'assets/admin/images/demo-logo.png';
			$job_bm_company_logo = $job_bm_default_company_logo;			
			
			}
		}
	
	}
else{
	//$job_bm_company_logo = job_bm_plugin_url.'assets/admin/images/demo-logo.png';
	$job_bm_company_logo = $job_bm_default_company_logo;	
	
	}
	
	echo '<div class="company_logo">';
	echo '<img src="'.$job_bm_company_logo.'" />';	
	echo '</div>';	
?>

