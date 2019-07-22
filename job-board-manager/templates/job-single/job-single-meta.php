<?php
/*
* @Author 		PickPlugins
* Copyright: 	2015 PickPlugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

	$class_job_bm_functions = new class_job_bm_functions();
	
	$job_type_list = $class_job_bm_functions->job_type_list();
	$job_status_list = $class_job_bm_functions->job_status_list();	
	$job_single_meta_items = $class_job_bm_functions->job_single_meta_items();	

	$job_bm_archive_page_id = get_option('job_bm_archive_page_id');
	$job_bm_archive_page_link = get_permalink($job_bm_archive_page_id);
	$permalink_structure = get_option('permalink_structure');	

	if(empty($permalink_structure)){
		
		$permalink_joint = '&';
		
		}
	else{
		$permalink_joint = '?';
		
		}


?>
<div class="job-metas">

<?php

	foreach($job_single_meta_items as $meta_key=>$item_data){
		
		if($meta_key== 'job_bm_job_type'){
			
			//var_dump('Hello');
			$job_bm_job_type = get_post_meta(get_the_ID(), $meta_key, true);
			
			if(!empty($job_bm_job_type) && !empty($job_type_list[$job_bm_job_type])){
				
				?>
                <div title="<?php echo $item_data['title']; ?>" class="job-meta job-bm-tooltip <?php echo $item_data['class'].' '.$job_bm_job_type; ?>"><i class="fa fa-<?php echo $item_data['fa']; ?>"></i> <a href="<?php echo $job_bm_archive_page_link.$permalink_joint.'job_type='.$job_bm_job_type; ?>"><?php echo $job_type_list[$job_bm_job_type]; ?></a></div>
				<?php

				
				}

			}
			
		elseif($meta_key== 'job_bm_job_status'){
			
			//var_dump('Hello');
			$job_bm_job_status = get_post_meta(get_the_ID(), $meta_key, true);
			
			if(!empty($job_bm_job_status)){
				
				?>
                <div title="<?php echo $item_data['title']; ?>" class="job-meta job-bm-tooltip <?php echo $item_data['class'].' '.$job_bm_job_status; ?>"> <a href="<?php echo $job_bm_archive_page_link.$permalink_joint.'job_status='.$job_bm_job_status; ?>"><?php echo $job_status_list[$job_bm_job_status]; ?></a></div>
				<?php

				
				}

			}			
			
			

		elseif($meta_key== 'job_bm_company_name'){

			//var_dump('Hello');
			$job_bm_company_name = get_post_meta(get_the_ID(), $meta_key, true);

			if(post_type_exists('company')){
				$company_data = get_page_by_title( $job_bm_company_name, 'OBJECT', 'company' );
				}
			else{
				$company_data = '';
				}


			if(!empty($company_data)){

				$company_link = get_post_permalink($company_data->ID);

				$job_bm_link_to_company_single_page = get_option('job_bm_link_to_company_single_page');


					if(empty($company_link) || $job_bm_link_to_company_single_page=='no'){

						$company_link = '#';

					}
				}
			else{

					$company_link = '#';
				}


			if(!empty($job_bm_company_name)){
				echo '<div title="'.$item_data['title'].'" class="job-meta job-bm-tooltip '.$item_data['class'].'"><i class="fa fa-'.$item_data['fa'].'"></i> <a href="'.$company_link.'">'.$job_bm_company_name.'</a></div>';
				}



			}







		elseif($meta_key== 'job_bm_location'){

			//var_dump('Hello');
			$job_bm_location = get_post_meta(get_the_ID(), $meta_key, true);

				if(!empty($job_bm_location)){


				if(post_type_exists('location')){
					$location_data = get_page_by_title( $job_bm_location, 'OBJECT', 'location' );
					}
				else{
					$location_data = '';
					}

				if(!empty($location_data)){

					$location_link = get_post_permalink($location_data->ID);
						if(empty($location_link)){

							$location_link = '#';

						}
					}
				else{

						$location_link = '#';
					}

				if(!empty($job_bm_location)){
					echo '<div title="'.$item_data['title'].'" class="job-meta job-bm-tooltip '.$item_data['class'].'"><i class="fa fa-'.$item_data['fa'].'"></i> <a href="'.$location_link.'">'.$job_bm_location.'</a></div>';
					}

				}


			}


        elseif($meta_key== 'job_bm_expire_date'){

			$meta_key_value = get_post_meta(get_the_ID(), $meta_key, true);

			//var_dump('Hello');

            $date = new DateTime($meta_key_value);
	        $date = $date->format('d M, Y');
			if(!empty($meta_key_value)){
				echo '<div title="'.$item_data['title'].'" class="job-meta job-bm-tooltip '.$item_data['class'].'"><i class="fa fa-'.$item_data['fa'].'"></i> <a href="#">'.$date.'</a></div>';
			}

		}


		else{
			
			$meta_key_value = get_post_meta(get_the_ID(), $meta_key, true);
			
			//var_dump('Hello');
			
			if(!empty($meta_key_value)){
				echo '<div title="'.$item_data['title'].'" class="job-meta job-bm-tooltip '.$item_data['class'].'"><i class="fa fa-'.$item_data['fa'].'"></i> <a href="#">'.$meta_key_value.'</a></div>';
				}

			}
			
			
			
		
		}


?>


</div>
