<?php

/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

class class_job_bm_post_meta{
	
	public function __construct(){

		//meta box action for "job"
		add_action('add_meta_boxes', array($this, 'meta_boxes_job'));
		add_action('save_post', array($this, 'meta_boxes_job_save'));

		//add_action('add_meta_boxes', array($this, 'meta_boxes_job_admin'));


		}

	
	public function job_meta_options_form(){
		
			global $post;
			//$job_bm_field_editor = get_option( 'job_bm_field_editor' );
			
			//$class_job_bm_functions = new class_job_bm_functions();			
			//$job_meta_options = $class_job_bm_functions->job_meta_options();
			//var_dump($job_meta_options);
			
			
			$class_job_bm_functions = new class_job_bm_functions();
			$post_type_input_fields = $class_job_bm_functions->post_type_input_fields();
			
			if(!empty($job_bm_field_editor)){
				
				$meta_fields = $job_bm_field_editor;
				}
			else{
				$meta_fields = $post_type_input_fields['meta_fields'];
				}
			
			
			$html = '';
			
			$html.= '<div class="para-settings job-bm-settings">';			

			$html_nav = '';
			$html_box = '';
					
			$i=1;
			foreach($meta_fields as $group_key=>$group_data){
				
				$group_title = $group_data['title'];
				$group_details = $group_data['details'];						
				$group_meta_fields = $group_data['meta_fields'];
				
			if($i==1){
				$html_nav.= '<li nav="'.$i.'" class="nav'.$i.' active">'.$group_title.'</li>';				
				}
			else{
				$html_nav.= '<li nav="'.$i.'" class="nav'.$i.'">'.$group_title.'</li>';
				}
				
				
			if($i==1){
				$html_box.= '<li style="display: block;" class="box'.$i.' tab-box active">';				
				}
			else{
				$html_box.= '<li style="display: none;" class="box'.$i.' tab-box">';
				}

				
			foreach($group_meta_fields as $option_key=>$field_data){
				
				
				$meta_key = $field_data['meta_key'];
				if(!empty($field_data['display'])){
					$display = $field_data['display'];
					}
				else{
					$display = 'yes';
					}
				
				if($display=='yes'){
					
					
					
				
				$option_value =  get_post_meta( $post->ID, $meta_key, true );
				//var_dump($option_value);
				
				
				if(empty($option_value)){
					$option_value = $field_data['input_values'];
					}
				
				

				
				$html_box.= '<div class="option-box '.$field_data['css_class'].'">';
				$html_box.= '<p class="option-title">'.$field_data['title'].'</p>';
				$html_box.= '<p class="option-info">'.$field_data['option_details'].'</p>';
				
				if($field_data['input_type'] == 'text'){
				$html_box.= '<input id="'.$option_key.'" type="text" placeholder="" name="'.$option_key.'" value="'.$option_value.'" /> ';					

					}
					
				elseif($field_data['input_type'] == 'hidden'){
					$html_box.= '<input id="'.$option_key.'" type="hidden" placeholder="" name="'.$option_key.'" value="'.$option_value.'" /> ';		
					
					}					
					
					
				elseif($field_data['input_type'] == 'textarea'){
					$html_box.= '<textarea id="'.$option_key.'" placeholder="" name="'.$option_key.'" >'.$option_value.'</textarea> ';
					
					}
					
					
				elseif($field_data['input_type'] == 'wp_editor'){
					
					
					ob_start();
					wp_editor( stripslashes($option_value), $option_key, $settings = array('textarea_name'=>$option_key,'media_buttons'=>false,'wpautop'=>true,'teeny'=>true,'editor_height'=>'150px', ) );				
					$editor_contents = ob_get_clean();
					
					$html_box.= $editor_contents;
					
					
					
					}					
					
					
					
				elseif($field_data['input_type'] == 'radio'){
					
					$input_args = $field_data['input_args'];
					
					foreach($input_args as $input_args_key=>$input_args_values){
						
						if($input_args_key == $option_value){
							$checked = 'checked';
							}
						else{
							$checked = '';
							}
							
						$html_box.= '<label><input class="'.$option_key.'" type="radio" '.$checked.' value="'.$input_args_key.'" name="'.$option_key.'"   >'.$input_args_values.'</label><br/>';
						}
					
					
					}
					
					
				elseif($field_data['input_type'] == 'select'){
					
					$input_args = $field_data['input_args'];
					$html_box.= '<select name="'.$option_key.'" >';
					foreach($input_args as $input_args_key=>$input_args_values){
						
						if($input_args_key == $option_value){
							$selected = 'selected';
							}
						else{
							$selected = '';
							}
						
						$html_box.= '<option '.$selected.' value="'.$input_args_key.'">'.$input_args_values.'</option>';

						}
					$html_box.= '</select>';
					
					}					
					

					
				elseif($field_data['input_type'] == 'checkbox'){
					
					$input_args = $field_data['input_args'];
					//var_dump($option_value);
					foreach($input_args as $input_args_key=>$input_args_values){


						//var_dump($input_args_key);
						
						if(in_array($input_args_key,$option_value)){
							$checked = 'checked';
							}
						else{
							$checked = '';
							}
						$html_box.= '<label><input '.$checked.' value="'.$input_args_key.'" name="'.$option_key.'[]"  type="checkbox" >'.$input_args_values.'</label><br/>';
						
						
						}
					
					
					}

					
					
				elseif($field_data['input_type'] == 'file'){
					
					$html_box.= '<input type="hidden" id="file_'.$option_key.'" name="'.$option_key.'" value="'.htmlentities($option_value).'" /><br />';
					
					$html_box.= '<input id="upload_button_'.$option_key.'" class="upload_button_'.$option_key.' button" type="button" value="Upload File" />';					
					
					//var_dump($option_value);
					
					if(is_serialized($option_value)){
						
						$option_value = unserialize($option_value);
						$option_value = $option_value[0];
						$option_value = wp_get_attachment_url($option_value);
						//var_dump($option_value);
						}

					
					$html_box.= '<br /><br /><div style="overflow:hidden;max-height:150px;max-width:150px;" class="logo-preview"><img width="100%" src="'.$option_value.'" /></div>';
					
					$html_box.= "
<script>
								jQuery(document).ready(function($){
	
									var custom_uploader; 
								 
									jQuery('#upload_button_".$option_key."').click(function(e) {
	
										e.preventDefault();
								 
										//If the uploader object has already been created, reopen the dialog
										if (custom_uploader) {
											custom_uploader.open();
											return;
										}
								
										//Extend the wp.media object
										custom_uploader = wp.media.frames.file_frame = wp.media({
											title: 'Choose File',
											button: {
												text: 'Choose File'
											},
											multiple: false
										});
								
										//When a file is selected, grab the URL and set it as the text field\'s value
										custom_uploader.on('select', function() {
											attachment = custom_uploader.state().get('selection').first().toJSON();
											
											//console.log(attachment);
											
											attachment_id = attachment.id;
											attachment_url = attachment.url;
											
											
											attachment_id_length = attachment_id.toString().length;
											
											


											$.ajax(
												{
											type: 'POST',
											context: this,
											url:job_bm_ajax.job_bm_ajaxurl,
											data: {'action': 'job_bm_ajax_post_id_serialize', 'attachment_id':attachment_id,},
											success: function(data)
													{	
														//alert(data);
														//$('#classified_maker_ads_thumbs').val(data);
														console.log(data);
														jQuery('#file_".$option_key."').val(data);
								
													}
												});	




											
											
											
											jQuery('.logo-preview img').attr('src',attachment_url);											
										});
								 
										//Open the uploader dialog
										custom_uploader.open();
								 
									});
									
									
								})
							</script>
					
					";					
					
					
					
					
					}		
					
					
										
					
								
				$html_box.= '</div>';
				

					
					
					
					
					}
				
				}
			$html_box.= '</li>';
			
			
			$i++;
			}
			
			
			$html.= '<ul class="tab-nav">';
			$html.= $html_nav;			
			$html.= '</ul>';
			$html.= '<ul class="box">';
			$html.= $html_box;
			$html.= '</ul>';
					
			$html.= apply_filters( 'job_bm_job_meta_scripts','');	
			
			$html.= '</div>';	
					
			return $html;
		}
	
	
	
	
	public function meta_boxes_job($post_type) {
			$post_types = array('job');
	 
			//limit meta box to certain post types
			if (in_array($post_type, $post_types)) {
				
				add_meta_box('job_metabox',__('job data', job_bm_textdomain), array($this, 'job_meta_box_function'), $post_type, 'normal', 'high');
			}
		}


	public function meta_boxes_job_admin($post_type) {
		$post_types = array('job');

		//limit meta box to certain post types
		if (in_array($post_type, $post_types)) {

			add_meta_box('job_admin_metabox',__('Job Admin', job_bm_textdomain), array($this, 'job_admin_meta_box_function'), $post_type, 'normal', 'high');
		}
	}



	public function job_meta_box_function($post) {
 
        // Add an nonce field so we can check for it later.
        wp_nonce_field('job_nonce_check', 'job_nonce_check_value');
 
        // Use get_post_meta to retrieve an existing value from the database.
       // $job_bm_data = get_post_meta($post -> ID, 'job_bm_data', true);
		//$class_job_bm_functions = new class_job_bm_functions();
		//$job_meta_options = $class_job_bm_functions->job_meta_options();
		
		//$job_bm_field_editor = get_option( 'job_bm_field_editor' );
		
		$class_job_bm_functions = new class_job_bm_functions();
		$post_type_input_fields = $class_job_bm_functions->post_type_input_fields();
		
		if(!empty($job_bm_field_editor)){
			
			$meta_fields = $job_bm_field_editor;
			}
		else{
			$meta_fields = $post_type_input_fields['meta_fields'];
			}
		
		foreach($meta_fields as $group_key=>$group_data){
					
				$group_meta_fields = $group_data['meta_fields'];

			foreach($group_meta_fields as $option_key=>$field_data){

				$meta_key = $field_data['meta_key'];
					if(!empty($field_data['display'])){
						$display = $field_data['display'];
						}
					else{
						$display = 'yes';
						}
				
				
				
				if($display=='yes'){
					
					${$meta_key} = get_post_meta($post -> ID, $meta_key, true);
					}
				}

			}
		

			
		//var_dump($job_bm_salary_currency);
        // Display the form, using the current value.
		
		?>
        <div class="job-bm-meta">
        
        <?php
		
		
        echo $this->job_meta_options_form(); 
		?>
        </div>
        
        
        <script>
		jQuery(document).ready(function($)
			{
				var job_bm_salary_type = $('.job_bm_salary_type:checked').val();
				
				if(job_bm_salary_type =='fixed'){
					
					$('.option-box.salary_fixed').fadeIn();
					}
				else if(job_bm_salary_type =='min-max'){
					
					
					$('.option-box.salary_min').fadeIn();
					$('.option-box.salary_max').fadeIn();					
					
					}
				
			})
		</script>
        
        
        
        
        
        <?php
		

		
		




   		}


	public function job_admin_meta_box_function($post) {

		// Add an nonce field so we can check for it later.
		wp_nonce_field('job_nonce_check', 'job_nonce_check_value');

		// Use get_post_meta to retrieve an existing value from the database.
		// $job_bm_data = get_post_meta($post -> ID, 'job_bm_data', true);
		//$class_job_bm_functions = new class_job_bm_functions();
		//$job_meta_options = $class_job_bm_functions->job_meta_options();

		//$job_bm_field_editor = get_option( 'job_bm_field_editor' );





		//var_dump($job_bm_salary_currency);
		// Display the form, using the current value.

		?>


		<?php








	}

	public function meta_boxes_job_save($post_id){
	 
			/*
			 * We need to verify this came from the our screen and with 
			 * proper authorization,
			 * because save_post can be triggered at other times.
			 */
	 
			// Check if our nonce is set.
			if (!isset($_POST['job_nonce_check_value']))
				return $post_id;
	 
			$nonce = $_POST['job_nonce_check_value'];
	 
			// Verify that the nonce is valid.
			if (!wp_verify_nonce($nonce, 'job_nonce_check'))
				return $post_id;
	 
			// If this is an autosave, our form has not been submitted,
			//     so we don't want to do anything.
			if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
				return $post_id;
	 
			// Check the user's permissions.
			if ('page' == $_POST['post_type']) {
	 
				if (!current_user_can('edit_page', $post_id))
					return $post_id;
	 
			} else {
	 
				if (!current_user_can('edit_post', $post_id))
					return $post_id;
			}
	 
			/* OK, its safe for us to save the data now. */
	 
			// Sanitize the user input.
			//$job_bm_data = stripslashes_deep($_POST['job_bm_data']);
	
			
			// Update the meta field.
			//update_post_meta($post_id, 'job_bm_data', $job_bm_data);
			//$class_job_bm_functions = new class_job_bm_functions();
			//$job_meta_options = $class_job_bm_functions->job_meta_options();
			
			
			//$job_bm_field_editor = get_option( 'job_bm_field_editor' );
			
			$class_job_bm_functions = new class_job_bm_functions();
			$post_type_input_fields = $class_job_bm_functions->post_type_input_fields();
			
			if(!empty($job_bm_field_editor)){
				
				$meta_fields = $job_bm_field_editor;
				}
			else{
				$meta_fields = $post_type_input_fields['meta_fields'];
				}
			
			
				
			foreach($meta_fields as $group_key=>$group_data){
						
				$group_meta_fields = $group_data['meta_fields'];
	
				foreach($group_meta_fields as $option_key=>$field_data){
	
					$meta_key = $field_data['meta_key'];
					if(!empty($field_data['display'])){
						$display = $field_data['display'];
						}
					else{
						$display = 'yes';
						}
					
					
					
					
					if($display=='yes'){
						
						${$meta_key} = stripslashes_deep($_POST[$meta_key]);
						update_post_meta($post_id, $meta_key, ${$meta_key});
						}
					}
	
				}
			
	
			
					
		}
	
	}


new class_job_bm_post_meta();