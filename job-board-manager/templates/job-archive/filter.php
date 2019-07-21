<?php
/*
* @Author 		PickPlugins
* Copyright: 	2015 PickPlugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 


$job_type_list_html = '';
?>




<div class="list-filter">
<?php
	


if(!empty($_GET['keywords'])){
		$keywords = sanitize_text_field($_GET['keywords']);

		echo '<div class="filter">'.__('Keyword:', 'job-board-manager').' '.$keywords.'</div>';
	}


if(!empty($_GET['job_type'])){
	
		$job_type = stripslashes_deep( $_GET['job_type']);

		//var_dump($job_type);


		if(is_array($job_type)){
			$job_type_list_html = '';
			
			$job_type_count = count($job_type);
			$i = 1;
			foreach($job_type as $type){

				//var_dump($type);

				$job_type_list_html.= $job_type_list[sanitize_text_field($type)];
				
				
				if($job_type_count>$i)
				$job_type_list_html.= ', ';
				
				$i++;
				}
			
			}
		else{
			$job_type_list_html.= $job_type_list[sanitize_text_field($job_type)];
			
			}
		
		
		//var_dump($job_type_count);
		
		if(!empty($job_type_list_html))
		echo '<div class="filter">'.__('Job type:', 'job-board-manager').' '.$job_type_list_html.'</div>';
	}

if(!empty($_GET['job_status'])){
	
		echo '<div class="filter">'.__('Job status:', 'job-board-manager').' '.$job_status_list[sanitize_text_field($_GET['job_status'])].'</div>';
	}
if(!empty($_GET['locations'])){
	
		echo '<div class="filter">'.__('Location:', 'job-board-manager').' '.sanitize_text_field($_GET['locations']).'</div>';
	}
if(!empty($_GET['expire_date'])){
	
		echo '<div class="filter">'.__('Expire date:', 'job-board-manager').' '.sanitize_text_field($_GET['expire_date']).'</div>';
	}
if(!empty($_GET['job_cat'])){
	
		$job_category_data = get_term_by('slug', sanitize_text_field($_GET['job_cat']), 'job_category');
	
		//var_dump($job_category_data);
		if(!empty($job_category_data->name))
		echo '<div class="filter">'.__('Category:', 'job-board-manager').' '.$job_category_data->name.'</div>';
	}	



?>

</div> <!-- .list-filter -->