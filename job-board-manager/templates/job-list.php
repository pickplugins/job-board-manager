<?php
/*
* @Author 		PickPlugins
* Copyright: 	2016 PickPlugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

	$job_bm_job_login_page_id = get_option('job_bm_job_login_page_id');
	$job_bm_login_enable = get_option('job_bm_login_enable');	
	$job_bm_registration_enable = get_option('job_bm_registration_enable');

	$date_format = get_option( 'date_format' );

	?>
	<div class="job-list">
	<?php
	
	do_action('job_bm_action_before_job_list');
	

	$class_job_bm_functions = new class_job_bm_functions();
	$job_type_list = $class_job_bm_functions->job_type_list();
	$job_status_list = $class_job_bm_functions->job_status_list();	
	
	

	$job_bm_list_per_page = get_option('job_bm_list_per_page');
	$job_bm_hide_expired_job_inlist = get_option('job_bm_hide_expired_job_inlist');
	$job_bm_job_type_bg_color = get_option('job_bm_job_type_bg_color');	
	$job_bm_job_status_bg_color = get_option('job_bm_job_status_bg_color');	
	$job_bm_featured_bg_color = get_option('job_bm_featured_bg_color');		
		
	$job_bm_archive_page_id = get_option('job_bm_archive_page_id');
	$job_bm_archive_page_link = get_permalink($job_bm_archive_page_id);
	
	$permalink_structure = get_option('permalink_structure');
	
	
	$tax_query = array();
	$job_category = '';
	
	if(empty($permalink_structure)){
		
		$permalink_joint = '&';
		
		}
	else{
		$permalink_joint = '?';
		
		}
	 
	if(empty($job_bm_list_per_page)){
		$job_bm_list_per_page = 15;
		}
	
		if ( get_query_var('paged') ) {
		
			$paged = get_query_var('paged');
		
		} elseif ( get_query_var('page') ) {
		
			$paged = get_query_var('page');
		
		} else {
		
			$paged = 1;
		
		}


	if(!empty($_GET['keywords'])){
		
		$keywords = sanitize_text_field($_GET['keywords']);

		}
	else{
		$keywords = $keywords;
		}
	
	if(!empty($_GET['job_category'])){
		
			$job_category = sanitize_text_field($_GET['job_category']);
			
			//var_dump($job_category);
		
			$tax_query[] = array(
								'taxonomy' => 'job_category',
								'field'    => 'id',
								'terms'    => $job_category,
								//'operator'    => '',
								);
		}
	

	if(!empty($_GET['job_type'])){
		
		$job_type = sanitize_text_field($_GET['job_type']);
		$meta_keys = 'job_bm_job_type';
		$meta_keys = explode(',',$meta_keys);
		
		
		}
		
	elseif(!empty($_GET['job_status'])){
		
		$job_status = sanitize_text_field($_GET['job_status']);
		$meta_keys = 'job_bm_job_status';
		$meta_keys = explode(',',$meta_keys);

		}		
	elseif(!empty($_GET['expire_date'])){
		
		$expire_date = sanitize_text_field($_GET['expire_date']);
		$meta_keys = 'job_bm_expire_date';
		$meta_keys = explode(',',$meta_keys);

		}		
		
		
		
	else{
		
		$meta_keys = explode(',',$meta_keys);
		
		}


	

	foreach($meta_keys as $key){
		
		if($key=='job_bm_location'){
			$meta_query[] = array(
			
								'key' => $key,
								'value' => $location,
								'compare' => '=',
								
									);
			}
		elseif($key=='job_bm_job_status'){
			$meta_query[] = array(
			
								'key' => $key,
								'value' => $job_status,
								'compare' => '=',
								
									);
			}
			
		elseif($key=='job_bm_job_type'){
			$meta_query[] = array(
			
								'key' => $key,
								'value' => $job_type,
								'compare' => '=',
								
									);
			}			
			
		elseif($key=='job_bm_company_name'){
			$meta_query[] = array(
			
								'key' => $key,
								'value' => $company_name,
								'compare' => '=',
								
									);
			}			
			
		elseif($key=='job_bm_expire_date'){
			$meta_query[] = array(
			
								'key' => $key,
								'value' => $expire_date,
								'compare' => '=',
								
									);
			}
		else{
			$meta_query[] = array();
			
			}			
			
		
		}


	$wp_query = new WP_Query(
		array (
			'post_type' => 'job',
			'post_status' => 'publish',
			's' => $keywords,
			'orderby' => 'Date',
			'meta_query' => $meta_query,
			'tax_query' => $tax_query,			
			'order' => 'DESC',
			'posts_per_page' => $job_bm_list_per_page,
			'paged' => $paged,
			
			) );
	
	
	$job_list_grid_items = array(

		'clear'=>array('class'=>'clear','fa'=>'','title'=>''),
		'job_bm_job_type'=>array('class'=>'job_type','fa'=>'briefcase','title'=>__('Job Type','job-board-manager')),
		'job_bm_job_status'=>array('class'=>'job_status','fa'=>'eye','title'=>__('Job Status','job-board-manager')),
		'job_category'=>array('class'=>'job_category','fa'=>'dot-circle-o','title'=>__('Category','job-board-manager')),
		'job_bm_location'=>array('class'=>'location','fa'=>'map-marker','title'=>__('Location','job-board-manager')), // meta_key, meta css class, font awesome class
		'job_bm_company_name'=>array('class'=>'company_name','fa'=>'briefcase','title'=>__('Company name','job-board-manager')),
		'job_bm_total_vacancies'=>array('class'=>'total_vacancies','fa'=>'user-plus','title'=>__('Total Vacancies','job-board-manager')),
		'job_bm_expire_date'=>array('class'=>'expire_date','fa'=>'calendar-o','title'=>__('Expire Date','job-board-manager')),
	);
	
							
	$job_list_grid_items = apply_filters('job_bm_filters_job_list_grid_items', $job_list_grid_items);		
					
	
	
	echo '<div class="list-filter">';
	
	if(!empty($_GET['job_type'])){
			$job_type =sanitize_text_field( $_GET['job_type']);
			
			if(!empty($job_type_list[$job_type]))
			echo '<div class="filter">'.__('Job type:','job-board-manager').' '.$job_type_list[sanitize_text_field($_GET['job_type'])].'</div>';
		}
		
	if(!empty($_GET['job_status'])){
		
			echo '<div class="filter">'.__('Job status:','job-board-manager').' '.$job_status_list[sanitize_text_field($_GET['job_status'])].'</div>';
		}		
	
	if(!empty($_GET['expire_date'])){
		
			echo '<div class="filter">'.__('Expire date:','job-board-manager').' '.sanitize_text_field($_GET['expire_date']).'</div>';
		}	
	
	if(!empty($_GET['job_category'])){
		
			$job_category_data = get_term_by('id', sanitize_text_field($_GET['job_category']), 'job_category');
		
			//var_dump($job_category_data);
			echo '<div class="filter">'.__('Category:','job-board-manager').' '.$job_category_data->name.'</div>';
		}	
	
	
	
	echo '</div>'; // .list-filter
				
				
				
				
				
	if ( $wp_query->have_posts() ) :
	

	while ( $wp_query->have_posts() ) : $wp_query->the_post();	
	
	
	
	
	
	
	
	
	
	foreach($job_list_grid_items as $meta_key=>$grid_data){
			
			$meta_key_values[$meta_key] = get_post_meta(get_the_ID(),$meta_key, true);
		}
	
	$job_bm_featured = get_post_meta(get_the_ID(), 'job_bm_featured', true);	
	$job_bm_company_logo = get_post_meta(get_the_ID(),'job_bm_company_logo', true);

	
	if(($job_bm_featured=='yes') ){
		
		$featured_class = 'featured';
		}
	else{
		$featured_class = '';
		}
	
	echo '<div class="single '.$featured_class.'">';
	
	

	
	
	if(!empty($job_bm_company_logo)){
		echo '<div class="company_logo">';
		echo '<img src="'.$job_bm_company_logo.'" />';	
		echo '</div>';					
		}
	
	
	echo '<div title="" class="title"><a href="'.get_permalink().'">'.get_the_title().'</a></div>';
	
	

	
	//echo '<div class="clear"></div>';
	
	echo '<div class="meta-list">';
	
	
	echo apply_filters('job_list_item_start',''); // filter job_list_item_after		
	
	
	foreach($job_list_grid_items as $meta_key=>$grid_data){

		

		
			

		if($meta_key== 'job_bm_job_type'){
			
			if(!empty($meta_key_values[$meta_key])){

				echo '<div title="'.$grid_data['title'].'" class="job-meta '.$grid_data['class'].' '.$meta_key_values[$meta_key].'"><i class="fa fa-'.$grid_data['fa'].'"></i><a href="'.$job_bm_archive_page_link.$permalink_joint.'job_type='.$meta_key_values[$meta_key].'">'.$job_type_list[$meta_key_values[$meta_key]].'</a></div>';
				}

			}
			
		elseif($meta_key== 'job_bm_job_status'){
			
			if(!empty($meta_key_values[$meta_key])){
				echo '<div title="'.$grid_data['title'].'" class="job-meta '.$meta_key_values[$meta_key].' '.$grid_data['class'].'"><i class="fa fa-'.$grid_data['fa'].'"></i><a href="'.$job_bm_archive_page_link.$permalink_joint.'job_status='.$meta_key_values[$meta_key].'">'.$job_status_list[$meta_key_values[$meta_key]].'</a></div>';	
				
				}

			}	
			
		elseif($meta_key== 'job_category'){
			
			$category = get_the_terms(get_the_ID(), 'job_category');
			
			
				if(!empty($category)){
					//$html.=	'<span><i class="fa fa-folder-open"></i> <a href="'.$archive_page_url.'?category='.$category[0]->slug.'">'.$category[0]->name.'</a></span>';
						echo '<div title="'.$grid_data['title'].'" class="job-meta '.$meta_key_values[$meta_key].' '.$grid_data['class'].'"><i class="fa fa-'.$grid_data['fa'].'"></i><a href="'.$job_bm_archive_page_link.'?job_category='.$category[0]->term_id.'">'.$category[0]->name.'</a></div>';
					
					}



			}			
			
			
			
		elseif($meta_key== 'job_bm_expire_date'){
			
			echo '<div title="'.$grid_data['title'].'" class="job-meta '.$grid_data['class'].'"><i class="fa fa-'.$grid_data['fa'].'"></i><a href="'.$job_bm_archive_page_link.$permalink_joint.'expire_date='.$meta_key_values[$meta_key].'">'.date_i18n($date_format,strtotime($meta_key_values[$meta_key])).'</a></div>';
			
			
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
				echo '<div title="'.$grid_data['title'].'" class="job-meta '.$grid_data['class'].'"><i class="fa fa-'.$grid_data['fa'].'"></i><a href="'.$company_link.'">'.$meta_key_values[$meta_key].'</a></div>';
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
				echo '<div title="'.$grid_data['title'].'" class="job-meta '.$grid_data['class'].'"><i class="fa fa-'.$grid_data['fa'].'"></i><a href="'.$location_link.'">'.$meta_key_values[$meta_key].'</a></div>';
				}
			
			}	

					
		else{
			if(!empty($meta_key_values[$meta_key])){
				echo '<div title="'.$grid_data['title'].'" class="job-meta '.$grid_data['class'].'"><i class="fa fa-'.$grid_data['fa'].'"></i><a href="#">'.$meta_key_values[$meta_key].'</a></div>';
				}

			}
		
		
		}
		
	echo '</div>';	
	
	echo apply_filters('job_list_item_end',''); // filter job_list_item_after				
	echo '</div>'; // .single
	
	
	
	
	//Display nth items custom html
	$job_list_ads_positions = apply_filters('job_list_ads_positions', array());
	
	if(!empty($job_list_ads_positions))
	foreach($job_list_ads_positions as $position){
		
		if( $wp_query->current_post == $position ){
			
			echo apply_filters('job_list_nth_item_html',$position); 
			
			}
		}
	


	endwhile;
	
	
	
	echo '<div class="paginate">';
	$big = 999999999; // need an unlikely integer
	echo paginate_links( array(
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' => '?paged=%#%',
		'current' => max( 1, $paged ),
		'total' => $wp_query->max_num_pages
		) );

	echo '</div >';	
	
	
	wp_reset_query();
	else:
	
	echo __('No job found','job-board-manager');
	
	endif;		
		
				



	echo '<style type="text/css">'; 			
			
	echo '.job-list .single.featured{background:'.$job_bm_featured_bg_color.'}';			
		
	if(!empty($job_bm_job_type_bg_color)){
		foreach($job_bm_job_type_bg_color as $job_type_key=>$job_type_color){
			
			echo '.job-list .job_type.'.$job_type_key.'{background:'.$job_type_color.'}';			
			}
		}

	if(!empty($job_bm_job_status_bg_color)){
		foreach($job_bm_job_status_bg_color as $job_status_key=>$job_status_color){
			
			echo '.job-list .job_status.'.$job_status_key.'{background:'.$job_status_color.'}';			
			}		
		}		
			
	echo '</style>';






	do_action('job_bm_action_after_job_list');		
	?>
	</div>	