<?php
if ( ! defined('ABSPATH')) exit;  // if direct access






function job_bm_activation_update_email_templates(){

    $class_job_bm_emails = new class_job_bm_emails();
    $templates_data = $class_job_bm_emails->job_bm_email_templates_data();

    $job_bm_email_temp_data_update = get_option('job_bm_email_temp_data_update');

    if(!empty($job_bm_email_temp_data_update)){
        update_option('job_bm_email_templates_data', $templates_data);
        update_option('job_bm_email_temp_data_update', 'done');
    }
}

add_action('job_bm_activation', 'job_bm_activation_update_email_templates');











function job_ids_by_user($user_id=0){

    $user_id = !empty($user_id) ? $user_id : get_current_user_id();

    $job_ids = array();

    $wp_query = new WP_Query(
        array (
            'post_type' => 'job',
            'post_status' => 'publish',
            'orderby' => 'date',
            'order' => 'DESC',
            'author' => $user_id,
            'posts_per_page' => -1,
        )
    );


    if ( $wp_query->have_posts() ) :
        while ( $wp_query->have_posts() ) : $wp_query->the_post();
            $job_id = get_the_id();

            $job_ids[$job_id] = (int)$job_id;

        endwhile;

    endif;


    return $job_ids;
}















function job_bm_single_job_view_count(){

	if ( is_singular( 'job' )){
		$cookie_name = 'job_bm_view';
		$job_id = get_the_ID();
		$job_bm_view_count = (int) get_post_meta(get_the_ID(),'job_bm_view_count', true);
		update_post_meta(get_the_ID(), 'job_bm_view_count', ($job_bm_view_count+1));

/*
 *
 * 		if(isset($_COOKIE[$cookie_name.'_'.$job_id])){

		}
		else{
			// Update +1 view count
			setcookie( $cookie_name.'_'.$job_id, $job_id, time() + (86400 * 30)); // 86400 = 1 day
			update_post_meta(get_the_ID(), 'job_bm_view_count', ($job_bm_view_count+1));
		}
 *
 * */

	}

}

add_action('wp_head','job_bm_single_job_view_count');










	
	
	
	
	
function job_bm_ajax_post_id_serialize(){
	
		$attachment_id = sanitize_text_field($_POST['attachment_id']);

		echo serialize(array($attachment_id));
		die();
	}	
	
	
add_action('wp_ajax_job_bm_ajax_post_id_serialize', 'job_bm_ajax_post_id_serialize');
add_action('wp_ajax_nopriv_job_bm_ajax_post_id_serialize', 'job_bm_ajax_post_id_serialize');	
	
	


	
	
	
function job_bm_ajax_reset_email_templates_data(){
	
		$class_job_bm_emails = new class_job_bm_emails();
		$templates_data = $class_job_bm_emails->job_bm_email_templates_data();
	
		update_option('job_bm_email_templates_data', $templates_data);	
	
		die();
	}	
	
	
add_action('wp_ajax_job_bm_ajax_reset_email_templates_data', 'job_bm_ajax_reset_email_templates_data');
add_action('wp_ajax_nopriv_job_bm_ajax_reset_email_templates_data', 'job_bm_ajax_reset_email_templates_data');


	
	
	
	
	
add_filter( 'add_menu_classes', 'job_bm_show_pending_number');

if(!function_exists('job_bm_show_pending_number')){
    function job_bm_show_pending_number( $menu ) {
        $type = "job";
        $status = "pending";
        $num_posts = wp_count_posts( $type, 'readable' );
        $pending_count = 0;
        if ( !empty($num_posts->$status) )
            $pending_count = $num_posts->$status;

        // build string to match in $menu array
        if ($type == 'post') {
            $menu_str = 'edit.php';
            // support custom post types
        } else {
            $menu_str = 'edit.php?post_type=' . $type;
        }

        // loop through $menu items, find match, add indicator
        foreach( $menu as $menu_key => $menu_data ) {
            if( $menu_str != $menu_data[2] )
                continue;
            $menu[$menu_key][0] .= " <span class='update-plugins count-$pending_count'><span class='plugin-count'>" . number_format_i18n($pending_count) . '</span></span>';
        }
        return $menu;
    }

}

	
	
	
	


	
	

	
	
	
	
	
	function job_bm_ajax_delete_job_by_id() {
		
		$job_bm_can_user_delete_jobs = get_option('job_bm_can_user_delete_jobs');
		
		$html = '';
		
		
		if($job_bm_can_user_delete_jobs=='no'){
			
			$html.= '<i class="fa fa-exclamation-circle"></i> '.__('You are not authorized to delete this job.','job-board-manager');

			}
		else{
			
			$job_id = (int)sanitize_text_field($_POST['job_id']);
	
			$current_user_id = get_current_user_id();
			
			$post_data = get_post($job_id, ARRAY_A);
	
			$author_id = $post_data['post_author'];		
		
			if( $current_user_id == $author_id ){
				
				if(wp_trash_post($job_id)){
					$html.=	'<i class="fa fa-check"></i> '.__('Job Deleted.','job-board-manager');
					$response['is_deleted'] = 'yes';

					do_action('job_bm_job_trash', $job_id);

					}
				else{
					$html.=	'<i class="fa fa-exclamation-circle"></i> '.__('Something going wrong.','job-board-manager');
					$response['is_deleted'] = 'no';
					}
				}
				
			else{
				
				$html.=	'<i class="fa fa-exclamation-circle"></i> '.__('You are not authorized to delete this job.','job-board-manager');
				$response['is_deleted'] = 'no';
				}
			}

		$response['html'] = $html;

		echo json_encode($response);

		//echo $html;
		
		die();
		}

	add_action('wp_ajax_job_bm_ajax_delete_job_by_id', 'job_bm_ajax_delete_job_by_id');
	//add_action('wp_ajax_nopriv_job_bm_ajax_delete_job_by_id', 'job_bm_ajax_delete_job_by_id');

	

	
	
//add_action( 'init', 'job_bm_revoke_admin_access' );


function job_bm_revoke_admin_access() {
	
	if(is_user_logged_in()){
		
		$job_bm_hide_admin_bar_role = get_option('job_bm_hide_admin_bar_role');
		
		
		
		if(empty($job_bm_hide_admin_bar_role)){
			
			$job_bm_hide_admin_bar_role = array('none');
			}
		
		$current_user = wp_get_current_user();
		$user_role = $current_user->roles;
		
		
		$user_role = $user_role[0];
		//var_dump($user_role);
		//var_dump($job_bm_hide_admin_bar_role);
		
		if(in_array($user_role,$job_bm_hide_admin_bar_role) ){
				header( home_url() ); 
			}
		
		}

	
}
	
	
	
	
//add_action('after_setup_theme', 'job_bm_remove_admin_bar');

function job_bm_remove_admin_bar() {
	
	if(is_user_logged_in()){
		
		$job_bm_hide_admin_bar_role = get_option('job_bm_hide_admin_bar_role');
		
		if(empty($job_bm_hide_admin_bar_role)){
			
			$job_bm_hide_admin_bar_role = array('none');
			}
		
		
		$current_user = wp_get_current_user();
		$user_role = $current_user->roles;
		$user_role = $user_role[0];
		//var_dump($user_role);
		//var_dump($job_bm_hide_admin_bar_role);
		
		if(in_array($user_role,$job_bm_hide_admin_bar_role)){
			show_admin_bar(false);
	
			}
		
		}


}
	






function job_bm_list_user_roles(){

	global $wp_roles;
	$all_roles = $wp_roles->roles;

	foreach($all_roles as $role_key=>$role_data){
		
		$all_roles[$role_key] = $role_data['name'];
		}
		
	return array_merge( array('none'=>__('None','job-board-manager')),$all_roles);
	
	}


	

	
	
	
	
	function job_bm_page_list_id(){

			$wp_query = new WP_Query(
				array (
					'post_type' => 'page',
					'posts_per_page' => -1,
					) );
					
			$pages_ids = array();

            $pages_ids[''] = __('None','job-board-manager');

			if ( $wp_query->have_posts() ) :
			
	
			while ( $wp_query->have_posts() ) : $wp_query->the_post();
			
			$pages_ids[get_the_ID()] = get_the_title();
			
			
			endwhile;
			wp_reset_query();
			endif;
			
			
			return $pages_ids;
		
		}
	
	
	




	function job_bm_get_date(){	
	
			$gmt_offset = get_option('gmt_offset');
			$wpls_datetime = date('Y-m-d', strtotime('+'.$gmt_offset.' hour'));
			
			return $wpls_datetime;
		
		}




function job_bm_get_terms($taxonomy){


    if(!isset($taxonomy)){
			$taxonomy = 'job_category';
			}
		
		
		$args=array(
			
		  'orderby' => 'id',
		  'taxonomy' => $taxonomy,
		  'hide_empty' => false,
		  'parent'  => 0,
		  );
		
		$categories = get_categories($args);

			
		$html = '';
		
		if(!empty($categories)){
			
			foreach($categories as $category){
				
					$name = $category->name;
					$cat_ID = $category->cat_ID;	
				
					$terms[$cat_ID] = 	$name;	
					
					$args_child=array(
						
					  'orderby' => 'id',
					  'taxonomy' => $taxonomy,
					  'hide_empty' => false,
					  'parent'  => $cat_ID,
					  );
					
					$categories_child = get_categories($args_child);
					
					if(!empty($categories_child))
					foreach($categories_child as $category_child){
						
						$name_child = $category_child->name;
						$cat_ID_child = $category_child->cat_ID;	
						
						$terms[$cat_ID_child] = $name_child;
						
						}
					
					
					
					//$html.= '<li cat-id="'.$cat_ID.'"><i class="fa fa-check"></i> '.$name;
					//$html.= '</li>';
	
				}
			
			
			}
		else{
			$terms = array();
			}
		
		
		return $terms;

	}



function job_bm_get_terms_hierarchical($taxonomy){

		
		//$cat_id = (int)sanitize_text_field($_POST['cat_id']);
		if(!isset($taxonomy)){
			$taxonomy = 'job_category';
			}
		
		
		$args=array(
			
		  'orderby' => 'id',
		  'taxonomy' => $taxonomy,
		  'hide_empty' => false,
		  'parent'  => 0,
		  );
		
		$categories = get_categories($args);

			
		$html = '';
		
		if(!empty($categories)){
			
			foreach($categories as $category){
				
					$name = $category->name;
					$cat_ID = $category->cat_ID;	
				
					$terms[$cat_ID] = 	$name;	
					
					$args_child=array(
						
					  'orderby' => 'id',
					  'taxonomy' => $taxonomy,
					  'hide_empty' => false,
					  'parent'  => $cat_ID,
					  );
					
					$categories_child = get_categories($args_child);
					
					if(!empty($categories_child))
					foreach($categories_child as $category_child){
						
						$name_child = $category_child->name;
						$cat_ID_child = $category_child->cat_ID;	
						
						$terms[$cat_ID_child] = $name_child;
						
						}
					
					
					
					//$html.= '<li cat-id="'.$cat_ID.'"><i class="fa fa-check"></i> '.$name;
					//$html.= '</li>';
	
				}
			
			
			}
		else{
			$terms = array();
			}
		
		
		return $terms;

	}













function job_bm_get_child_cats(){

		$html = '';
		$cat_id = (int)sanitize_text_field($_POST['cat_id']);
		
		$taxonomy = 'job_category';
		
		$args=array(
		  'orderby' => 'name',
		  'order' => 'ASC',
		  'taxonomy' => $taxonomy,
		  'hide_empty' => false,
		  'child_of'  => $cat_id,
		  );
		
		$categories = get_categories($args);

		//var_dump();
		
		
		if(!empty($categories)){
			
			foreach($categories as $category){
				
				$name = $category->name;
				$cat_ID = $category->cat_ID;	
		
					$html.= '<li cat-id="'.$cat_ID.'"><i class="fa fa-check"></i> '.$name.'</li>';
	
				}
			
			}
		
		

		
		
		echo $html;
		
		
		die();
		
	}





add_action('wp_ajax_job_bm_get_child_cats', 'job_bm_get_child_cats');
add_action('wp_ajax_nopriv_job_bm_get_child_cats', 'job_bm_get_child_cats');



