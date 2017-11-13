<?php
/*
* @Author 		PickPlugins
* Copyright: 	2015 PickPlugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

	//$job_bm_field_editor = get_option( 'job_bm_field_editor' );
	$job_bm_can_user_edit_published_jobs = get_option('job_bm_can_user_edit_published_jobs');	
	$job_bm_reCAPTCHA_enable = get_option('job_bm_reCAPTCHA_enable');	
	$job_bm_job_login_page_id = get_option('job_bm_job_login_page_id');
	$login_page_url = get_permalink($job_bm_job_login_page_id);
	
	$job_bm_submission_type = get_option('job_bm_submission_type');

	if ( is_user_logged_in()  ) {
		
		if(!isset($_GET['job_id'])){
			
			echo '<i class="fa fa-exclamation-circle"></i> '.__('Invalid job id.', job_bm_textdomain);

			return;
			}
		
		if($job_bm_can_user_edit_published_jobs=='no'){
			
			echo '<i class="fa fa-exclamation-circle"></i> '.__('You are not authorized to edit this job.', job_bm_textdomain);
			return;
			}
		
		
		
		
			$userid = get_current_user_id();
			$job_id = sanitize_text_field($_GET['job_id']);
			
			// job poster auhtor id.
			$post_data = get_post($job_id, ARRAY_A);
			$author_id = (int)$post_data['post_author'];		
			
			// if match author ID & logged in user id then 
			if( $userid == $author_id) {

				$class_pickform = new class_pickform();
				
			
			
				$class_job_bm_functions = new class_job_bm_functions();
				$post_type_input_fields = $class_job_bm_functions->post_type_input_fields();
					
			
				
				$job_title = $post_type_input_fields['post_title'];	
				$job_content = $post_type_input_fields['post_content'];	
				$recaptcha = $post_type_input_fields['recaptcha'];		
				
				$post_taxonomies = $post_type_input_fields['post_taxonomies'];
				$job_category = $post_taxonomies['job_category'];
				
				
				//$meta_fields = $post_type_input_fields['meta_fields'];		
				
				if(!empty($job_bm_field_editor)){
					
					$meta_fields = $job_bm_field_editor;
					}
				else{
					$meta_fields = $post_type_input_fields['meta_fields'];
					}
				
				//var_dump($meta_fields);
					
				//var_dump($_POST);	
				
					
					
			
				
				
				
				
				// to change a session variable, just overwrite it
				//$_SESSION["favcolor"] = array("yelfffflow");
			
			//var_dump($_SESSION['job_bm_job_data']);
			
			
			
								
			?>
						
			
								
			
					
			
				<div class="job-submit pickform">
					<div class="validations">
					
					<?php
					
						if(!empty($_POST['_wpnonce'])){
							$nonce = $_POST['_wpnonce'];
							}
						else{
							$nonce = '';
							}
					
					
					if(wp_verify_nonce( $nonce, 'job_bm_edit' ) && isset($_POST['post_job_hidden'])){
						
						
						$validations = array();
						
						
						if(empty($_POST['post_title'])){
							
							 $validations['post_title'] = '';
							 echo '<div class="failed"><b><i class="fa fa-exclamation-circle" aria-hidden="true"></i> '.$job_title['title'].'</b> '.__('missing', job_bm_textdomain).'.</div>';
							}
						
						if(empty($_POST['post_content'])){
							
							 $validations['post_content'] = '';
							 echo '<div class="failed"><b><i class="fa fa-exclamation-circle" aria-hidden="true"></i> '.$job_content['title'].'</b> '.__('missing', job_bm_textdomain).'.</div>';
							}		
						
						if($job_bm_reCAPTCHA_enable=='yes'){
							if(empty($_POST['g-recaptcha-response'])){
								
								 $validations['recaptcha'] = '';
								 echo '<div class="failed"><b><i class="fa fa-exclamation-circle" aria-hidden="true"></i> '.$recaptcha['title'].'</b> '.__('missing', job_bm_textdomain).'.</div>';
								}
							
							}		
						
						if(empty($_POST['job_category'])){
							
							 $validations['job_category'] = '';
							 echo '<div class="failed"><b><i class="fa fa-exclamation-circle" aria-hidden="true"></i> '.$job_category['title'].'</b> '.__('missing', job_bm_textdomain).'.</div>';
							}				
						
						
						
					
								foreach($meta_fields as $fields){
									
									$fields = $fields['meta_fields'];
									
									foreach($fields as $key=>$field_data){
										
										$meta_key = $field_data['meta_key'];
										$meta_title = $field_data['title'];	
														
										if(isset($_POST[$meta_key]))
										 $valid = $class_pickform->validations($field_data, $_POST[$meta_key]);
										 
										 if(!empty( $valid)){
											 $validations[$meta_key] = $valid;
											 echo '<div class="failed"><b><i class="fa fa-exclamation-circle" aria-hidden="true"></i> '.$meta_title.'</b> '.$valid.'.</div>';
											 
											 }					 
										}
								}
						
						if(empty($validations)){
							
							
							
							// all data is filled.
							$job_title_val = $class_pickform->sanitizations($_POST['post_title'], 'text');
							$job_content_val = $class_pickform->sanitizations($_POST['post_content'], 'wp_editor');		
							$job_category_val = $class_pickform->sanitizations($_POST['job_category'], 'select_multi');	
							
							$job_post = array(
							  'ID'           => $job_id,
							  'post_title'    => $job_title_val,
							  'post_content'  => $job_content_val,

							);
							
							// Update the post into the database

							$is_update = wp_update_post($job_post);
							
							echo '<div class="success"><i class="fa fa-check"></i> '.__('Job update successfully.', job_bm_textdomain).'</div>';
							
							$taxonomy = 'job_category';
							
							wp_set_post_terms( $job_id, $job_category_val, $taxonomy );
							
							
							
							
								foreach($meta_fields as $group_key=>$group_data){
									
									$group_meta_fields = $group_data['meta_fields'];
									
									foreach($group_meta_fields as $key=>$field_data){
										$meta_key = $field_data['meta_key'];						
										$input_type = $field_data['input_type'];
										
										if(is_array( $_POST[$meta_key])){
											//$meta_value = $class_pickform->sanitizations($_POST[$meta_key], $input_type);
											
											$meta_value = serialize($_POST[$meta_key]);
											}
										else{
											$meta_value = $class_pickform->sanitizations($_POST[$meta_key], $input_type);
											}
										
										
										update_post_meta($job_id, $meta_key , $meta_value);
										
										//var_dump($field_data_new);
										}
								}
							
							
							
							
							
							
							}
						else{
							
							$job_title = array_merge($job_title, array('input_values'=>$class_pickform->sanitizations($_POST['post_title'], 'text')));
							$job_content = array_merge($job_content, array('input_values'=>$class_pickform->sanitizations($_POST['post_content'], 'wp_editor')));	
										
							$job_category = array_merge($job_category, array('input_values'=>$class_pickform->sanitizations($_POST['job_category'], 'select_multi')));					
							
							
							//var_dump($job_title);
							//var_dump($job_content);				
							//var_dump($job_category);					
							
								foreach($meta_fields as $group_key=>$group_data){
									
									$group_title = $group_data['title'];
									$group_details = $group_data['details'];						
									$group_meta_fields = $group_data['meta_fields'];						
									
									//$fields = $fields['meta_fields'];
									$meta_fields_new[$group_key]['title'] = $group_title;
									$meta_fields_new[$group_key]['details'] = $group_details;						
									
									foreach($group_meta_fields as $key=>$field_data){
										$meta_key = $field_data['meta_key'];
										$input_type = $field_data['input_type'];							
										
										if(!empty($_POST[$meta_key])){
											$meta_value = $class_pickform->sanitizations($_POST[$meta_key], $input_type);
											}
										else{
											$meta_value = '';
											}
										
										$meta_fields_new[$group_key]['meta_fields'][$key] =  array_merge($field_data, array('input_values'=>$meta_value));	
										
										//var_dump($field_data_new);
										}
								}
							
							//var_dump($field_data_new);
							//echo '<pre>'.var_export($meta_fields_new, true).'</pre>';
							
							if(!empty($meta_fields_new)){
								
								$meta_fields = $meta_fields_new;
								
								}
							
							
							}
							
						
						
						}
					
						else{
							
							$job_data = get_post($job_id, ARRAY_A);
							
						//	var_dump($job_data);
							
							$job_title = array_merge($job_title, array('input_values'=>$job_data['post_title']));
							$job_content = array_merge($job_content, array('input_values'=>$job_data['post_content']));	
									
								
							$job_category_id = wp_get_post_terms($job_id, 'job_category', array("fields" => "all"));;					
							//var_dump($job_category_id[0]->term_id);
							
							if(!empty($job_category_id[0])){
								$term_id = $job_category_id[0]->term_id;
								}
							else{
								$term_id  = '';
								}

							$job_category = array_merge($job_category, array('input_values'=>$term_id));
							
							//var_dump($job_title);
							//var_dump($job_content);				
							//var_dump($job_category);					
							
								foreach($meta_fields as $group_key=>$group_data){
									
									$group_title = $group_data['title'];
									$group_details = $group_data['details'];						
									$group_meta_fields = $group_data['meta_fields'];						
									
									//$fields = $fields['meta_fields'];
									$meta_fields_saved[$group_key]['title'] = $group_title;
									$meta_fields_saved[$group_key]['details'] = $group_details;						
									
									foreach($group_meta_fields as $key=>$field_data){
										$meta_key = $field_data['meta_key'];
										$input_type = $field_data['input_type'];							

										$meta_value = get_post_meta($job_id, $meta_key, true);											

										
										$meta_fields_saved[$group_key]['meta_fields'][$key] =  array_merge($field_data, array('input_values'=>$meta_value));	
										
										//var_dump($field_data_new);
										}
								}
							
							//var_dump($field_data_new);
							//echo '<pre>'.var_export($meta_fields_new, true).'</pre>';
							
							if(!empty($meta_fields_saved)){
								
								$meta_fields = $meta_fields_saved;
								
								}
							
							
							}		
					
			
					
					
					?>
					
					
					</div>
				<?php
			  
			
				 
			  
			  
				do_action('job_bm_action_before_job_submit');
				
				
			/*
			
						if($step ==1)	{
			
							$taxonomy = 'job_category';
							
							$args=array(
							  'orderby' => 'name',
							  'order' => 'ASC',
							  'taxonomy' => $taxonomy,
							  'hide_empty' => false,
							  'parent'  => 0,
							  );
							
							$categories = get_categories($args);
				
							
							
							
							echo '<div class="option">';
							echo '<div class="option-title">'.__('Select Category',job_bm_textdomain).'</div>';
							echo '<div class="option-details"></div>';
							
							
							//echo '<p>'.__('Select Category',job_bm_textdomain).'</p>';			
							
							echo '<ul class="job-cats">';			
							
							if(!empty($categories)){
								
								foreach($categories as $category){
									
									$name = $category->name;
									$cat_ID = $category->cat_ID;	
									
												
									echo '<li cat-id="'.$cat_ID.'">'.$name;
									echo ' <i class="fa fa-chevron-right"></i></li>';
				
									}
								
								
								}
							else{
								
									echo '<li ><i class="fa fa-exclamation-triangle"></i> '.__('No categories found.',job_bm_textdomain);
									echo '</li>';
								
								}
			
			
							echo '</ul>';	
										
							echo '<ul class="job-child-cats">';
							echo '</ul>';
							
							echo '</div>';
							echo '<a class="steps step-2" href="'.$job_submit_page_url.'?step=2">'.__('Next <i class="fa fa-angle-double-right"></i>',job_bm_textdomain).'</a>';	
							
							
							
							}
						elseif($step ==2){
							
							
							}
			
			*/

				?>

						<form enctype="multipart/form-data"   method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
						<input type="hidden" name="post_job_hidden" value="Y">
					
					<?php
					
						//var_dump($job_title);
					
						do_action('job_bm_action_job_submit_main');
						
						echo '<div class="option">';
						echo $class_pickform->field_set($job_title);
						
						echo '</div>';
						
						
						
						echo '<div class="option">';
						echo $class_pickform->field_set($job_content);
						
						echo '</div>';	
						
						
						echo '<div class="option">';
						echo $class_pickform->field_set($job_category);
						
						echo '</div>';				
						
						?>
						<div class="meta-fields">
						
						<?php
						
						//echo '<pre>'.var_export($meta_fields, true).'</pre>';
						
						//var_dump($meta_fields);
						foreach($meta_fields as $fields){

				
							
							if($job_bm_submission_type=='step'){
								
								echo '<div class="steps-title">'.$fields['title'].'</div>';
								
								echo '<div class="steps-body">';
								
								$fields = $fields['meta_fields'];
								
								foreach($fields as $key=>$field_data){
									//var_dump($field_data);
								?>
								<div class="option">
				
									
									<?php
									if(!empty($field_data['display'])){
										$display = $field_data['display'];
										}
									else{
										$display = 'yes';
										}
									
									
									
									if($display=='yes')
									echo $class_pickform->field_set($field_data);
									?>
				
								</div>
								<?php
									
									}
				
								echo '</div>';
								
								
								}
							elseif($job_bm_submission_type=='accordion'){
								
								
								echo '<div  class="steps-title">'.$fields['title'].'</div>';
								
								echo '<div class="steps-body">';
								
								$fields = $fields['meta_fields'];
								
								foreach($fields as $key=>$field_data){
									//var_dump($field_data);
								?>
								<div class="option">
				
									
									<?php
									if(!empty($field_data['display'])){
										$display = $field_data['display'];
										}
									else{
										$display = 'yes';
										}
									
									
									
									if($display=='yes')
									echo $class_pickform->field_set($field_data);
									?>
				
								</div>
								<?php
									
									}
				
								echo '</div>';
								
								
								}

							}
						
						?>
						
						
						</div>

			
						<div class="job-submit-button">
						
						<?php		
							
							
						if($job_bm_reCAPTCHA_enable=='yes'){
							
							echo '<div class="option">';
							echo $class_pickform->field_set($recaptcha);
							echo '</div>';
							
							}
							
							wp_nonce_field( 'job_bm_edit' );
						?>
							
				
							<input type="submit"  name="submit" value="<?php _e('Submit',job_bm_textdomain); ?>" />
				
						</div>
			
			
						</form>
					
					
					<?php
					
					do_action('job_bm_action_after_job_submit');
					
					if($job_bm_submission_type=='step'){
						
			?>
					   <script>
			jQuery(document).ready(function($){jQuery(".meta-fields").steps({ headerTag: ".steps-title", bodyTag: ".steps-body",transitionEffect: "slide",onFinished: function (event, currentIndex){jQuery('.job-submit-button').fadeIn(); },labels: {cancel: "<?php echo __('Cancel',job_bm_textdomain); ?>",current: "<?php echo __('current step:',job_bm_textdomain); ?>",pagination: "<?php echo __('Pagination',job_bm_textdomain); ?>",finish: "<?php echo __('Finish',job_bm_textdomain); ?>",next: "<?php echo __('Next',job_bm_textdomain); ?>",previous: "<?php echo __('Previous',job_bm_textdomain); ?>",loading: "<?php echo __('Loading ...',job_bm_textdomain); ?>"}}); });
					   </script>
			<?php
						
						}
						
							elseif($job_bm_submission_type=='accordion'){	
							
						echo '<script>
								jQuery(document).ready(function($)
								{
									
									$(".meta-fields").accordion({
										active: "",
										event: "click",
										animated: "swing",
										collapsible: true,
										heightStyle: "content",
										
										';
			
										echo '
			})
								})
			
								</script>';
								
								
							
							}	
					
					
					?>

                    
                    
				</div>
					
			<?php 






				
				
				}
			else{
				
				echo '<i class="fa fa-exclamation-circle"></i>'.sprintf(__('You are not authorized to edit this job, please go <a href="%s"><b>account page</b></a> to see your jobs.',job_bm_textdomain), $login_page_url);
				
				}
			
			
		}

	else{
		
		echo '<i class="fa fa-exclamation-circle"></i>'.sprintf(__('Please <a href="%s"><b>login</b></a> to edit this job.',job_bm_textdomain),$login_page_url);
		
		}



	



















        

		
		
