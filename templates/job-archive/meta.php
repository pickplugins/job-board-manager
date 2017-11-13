<?php
/*
* @Author 		PickPlugins
* Copyright: 	2015 PickPlugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 




	
	echo '<div class="meta-list">';
	
	
	echo apply_filters('job_list_item_start',''); // filter job_list_item_after		
	
	
	foreach($job_list_grid_items as $meta_key=>$grid_data){
		
	/*
	
	if($meta_key== 'job_bm_company_logo'){
			


			if(!empty($meta_key_values[$meta_key])){
				echo '<div class="'.$grid_data['class'].'">';
				echo '<img src="'.$meta_key_values[$meta_key].'" />';	
				echo '</div>';					
				}

	
			
			
			}
		elseif($meta_key== 'title'){
			echo '<div title="'.$grid_data['title'].'" class="'.$grid_data['class'].'"><a href="'.get_permalink().'">'.get_the_title().'</a></div>';
			}

		elseif($meta_key== 'job_bm_short_content'){
			


			if($job_bm_list_excerpt_display=='from_content'){
				
				echo '<div title="'.$grid_data['title'].'" class="'.$grid_data['class'].'">'.get_the_excerpt().'</div>';
				}
			elseif($job_bm_list_excerpt_display=='short_content'){
				
				if(!empty($meta_key_values[$meta_key])){
					echo '<div title="'.$grid_data['title'].'" class="'.$grid_data['class'].'">'.$meta_key_values[$meta_key].'</div>';
					}
				}
			else{
				
				echo '<div title="'.$grid_data['title'].'" class="'.$grid_data['class'].'">'.get_the_excerpt().'</div>';
				}



			}

	
	*/
		

		
			

		if($meta_key== 'job_bm_job_type'){
			
			if(!empty($meta_key_values[$meta_key]) && !empty($job_type_list[$meta_key_values[$meta_key]])){

				echo '<div  title="'.$grid_data['title'].'" class="job-meta job-bm-tooltip '.$grid_data['class'].' '.$meta_key_values[$meta_key].'"><i class="fa fa-'.$grid_data['fa'].'"></i><a href="'.$job_bm_archive_page_link.$permalink_joint.'job_type='.$meta_key_values[$meta_key].'">'.$job_type_list[$meta_key_values[$meta_key]].'</a></div>';
				}

			}
			
		elseif($meta_key== 'job_bm_job_status'){
			
			if(!empty($meta_key_values[$meta_key])){
				echo '<div title="'.$grid_data['title'].'" class="job-meta job-bm-tooltip '.$meta_key_values[$meta_key].' '.$grid_data['class'].'"><i class="fa fa-'.$grid_data['fa'].'"></i><a href="'.$job_bm_archive_page_link.$permalink_joint.'job_status='.$meta_key_values[$meta_key].'">'.$job_status_list[$meta_key_values[$meta_key]].'</a></div>';	
				
				}

			}	
			
		elseif($meta_key== 'job_cat'){
			
			$category = get_the_terms(get_the_ID(), 'job_category');
			
			//var_dump($category);
			
				if(!empty($category)){
					//$html.=	'<span><i class="fa fa-folder-open"></i> <a href="'.$archive_page_url.'?category='.$category[0]->slug.'">'.$category[0]->name.'</a></span>';
						echo '<div title="'.$grid_data['title'].'" class="job-meta job-bm-tooltip '.$meta_key_values[$meta_key].' '.$grid_data['class'].'"><i class="fa fa-'.$grid_data['fa'].'"></i><a href="'.$job_bm_archive_page_link.'?job_cat='.$category[0]->slug.'">'.$category[0]->name.'</a></div>';
					
					}



			}			
			
			
			
		elseif($meta_key== 'job_bm_expire_date'){
			
			echo '<div title="'.$grid_data['title'].'" class="job-meta job-bm-tooltip '.$grid_data['class'].'"><i class="fa fa-'.$grid_data['fa'].'"></i><a href="'.$job_bm_archive_page_link.$permalink_joint.'expire_date='.$meta_key_values[$meta_key].'">'.date_i18n($date_format,strtotime($meta_key_values[$meta_key])).'</a></div>';
			
			
			}
			
		elseif($meta_key== 'job_bm_company_name'){
			
			if(post_type_exists('company')){
				$company_data = get_page_by_title( $meta_key_values[$meta_key], 'OBJECT', 'company' );
				}
			else{
				$company_data = '';
				}
			
			
			
			if(!empty($company_data)){
				
				$company_link = get_post_permalink($company_data->ID);
				
				$job_bm_link_to_company_archive_page = get_option('job_bm_link_to_company_archive_page');

				//var_dump($job_bm_link_to_company_archive_page);


					if(empty($company_link) || $job_bm_link_to_company_archive_page=='no'){
					
						$company_link = '#';
					}
				}
			else{
				
					$company_link = '#';
				}
			
			if(!empty($meta_key_values[$meta_key])){
				echo '<div title="'.$grid_data['title'].'" class="job-meta job-bm-tooltip '.$grid_data['class'].'"><i class="fa fa-'.$grid_data['fa'].'"></i><a href="'.$company_link.'">'.$meta_key_values[$meta_key].'</a></div>';
				}
			}			
		
		elseif($meta_key== 'job_bm_location'){
			
			if(post_type_exists('location')){
				$location_data = get_page_by_title( $meta_key_values[$meta_key], 'OBJECT', 'location' );
				}
			else{
				$location_data = '';
				}
			
			//$location_data = get_page_by_title( $meta_key_values[$meta_key], 'OBJECT', 'location' );
			
			if(!empty($location_data)){
				
				$location_link = get_post_permalink($location_data->ID);
					if(empty($location_link)){
					
						$location_link = '#';
						
					}
				}
			else{
				
					$location_link = '#';
				}

			
			if(!empty($meta_key_values[$meta_key])){
				echo '<div title="'.$grid_data['title'].'" class="job-meta job-bm-tooltip '.$grid_data['class'].'"><i class="fa fa-'.$grid_data['fa'].'"></i><a href="'.$location_link.'">'.$meta_key_values[$meta_key].'</a></div>';
				}
			
			}	

					
		else{
			if(!empty($meta_key_values[$meta_key])){
				echo '<div title="'.$grid_data['title'].'" class="job-meta job-bm-tooltip '.$grid_data['class'].'"><i class="fa fa-'.$grid_data['fa'].'"></i><a href="#">'.$meta_key_values[$meta_key].'</a></div>';
				}

			}
		
		
		}
		
	echo apply_filters('job_list_item_end',''); // filter job_list_item_after	
		
	echo '</div>';	
	
					

