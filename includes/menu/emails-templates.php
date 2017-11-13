<?php	


/*
* @Author 		PickPlugins
* Copyright: 	2015 PickPlugins.com


*/

if ( ! defined('ABSPATH')) exit;  // if direct access 



class class_job_bm_emails_templates  {
	
	
    public function __construct(){
		
		echo $this->job_bm_templates_settings_display();
		
    }
	
	
	
	public function job_bm_templates_editor(){
		
			$job_bm_email_templates_data = get_option( 'job_bm_email_templates_data' );
			
			if(empty($job_bm_email_templates_data)){
				
				$class_job_bm_emails = new class_job_bm_emails();
				$templates_data = $class_job_bm_emails->job_bm_email_templates_data();
				
				
				}
			else{

				
				$class_job_bm_emails = new class_job_bm_emails();
				$templates_data = $class_job_bm_emails->job_bm_email_templates_data();
				
				$templates_data =array_merge($templates_data, $job_bm_email_templates_data);
				
				}
			
			//echo '<pre>'.var_export($templates_data).'</pre>';
		
			$html = '';
			
			//$templates_data = $this->job_bm_email_templates_data();
		
			$html.= '<div class="templates_editor expandable">';		
			foreach($templates_data as $key=>$templates){
				
				if(!empty($templates['email_to'])){
					$email_to = $templates['email_to'];
					}
				else{
					$email_to = '';
					}
				
				if(!empty($templates['email_from'])){
					$email_from = $templates['email_from'];
					}
				else{
					$email_from = '';
					}				
				
				
				if(!empty($templates['email_from_name'])){
					$email_from_name = $templates['email_from_name'];
					}
				else{
					
					//$site_name = get_bloginfo('name');
					$email_from_name = '';
					}					
				
				
				if(!empty($templates['enable'])){
					$enable = $templates['enable'];
					}
				else{
					$enable = '';
					}				
				
				
				
				if(!empty($templates['description'])){
					$description = $templates['description'];
					}
				else{
					$description = '';
					}				
				
				
				
				
				$html.= '<div class="items template '.$key.'">';
				$html.= '<div class="header"><span class="remove"><i class="fa fa-times"></i></span>'.$templates['name'].'</div>';
				$html.= '<input type="hidden" name="job_bm_email_templates_data['.$key.'][name]" value="'.$templates['name'].'" />';				
									
				$html.= '<div class="options">';
				
				$html.= '<div class="description">'.$description.'</div><br/><br/>';				
				
				
				$html.= '<label>'.__('Enable ?', job_bm_textdomain).'<br/>';	// .options			
				$html.= '<select name="job_bm_email_templates_data['.$key.'][enable]" >';
				
				if($enable=='yes'){
					
					$html.= '<option selected  value="yes" >Yes</option>';
					}
				else{
					$html.= '<option value="yes" >Yes</option>';
					}
					
				if($enable=='no'){
					
					$html.= '<option selected value="no" >No</option>';		
					}
				else{
					$html.= '<option value="no" >No</option>';		
					}					
				$html.= '</select>';
				$html.= '</label><br /><br />';	
				
				
					
				$html.= '<label>'.__('Email To:', job_bm_textdomain).'<br/>';	// .options				
				$html.= '<input placeholder="hello_1@hello.com,hello_2@hello.com" type="text" name="job_bm_email_templates_data['.$key.'][email_to]" value="'.$email_to.'" />';	// .options	
				$html.= '</label><br /><br />';		

		
				$html.= '<label>'.__('Email from name:', job_bm_textdomain).'<br/>';	// .options				
				$html.= '<input placeholder="hello_1@hello.com" type="text" name="job_bm_email_templates_data['.$key.'][email_from_name]" value="'.$email_from_name.'" />';	// .options	
				$html.= '</label><br /><br />';			
		
				$html.= '<label>'.__('Email from:', job_bm_textdomain).'<br/>';	// .options				
				$html.= '<input placeholder="hello_1@hello.com" type="text" name="job_bm_email_templates_data['.$key.'][email_from]" value="'.$email_from.'" />';	// .options	
				$html.= '</label><br /><br />';			
		
		
		
		
				
				
				$html.= '<label>'.__('Email Subject:',job_bm_textdomain).'<br/>';	// .options				
				$html.= '<input type="text" name="job_bm_email_templates_data['.$key.'][subject]" value="'.$templates['subject'].'" />';	// .options	
				$html.= '</label>';					
						
						
				ob_start();
				wp_editor( $templates['html'], $key, $settings = array('textarea_name'=>'job_bm_email_templates_data['.$key.'][html]','media_buttons'=>false,'wpautop'=>true,'teeny'=>true,'editor_height'=>'400px', ) );				
				$editor_contents = ob_get_clean();
			
				$html.= '<br/><label>'.__('Email Body:',job_bm_textdomain).'<br/>';	// .options				
				$html.= $editor_contents;
				$html.= '</label>';		

				$html.= '</div>';	// .options			
				$html.= '</div>'; //.items

				
				}
		
		$html.= '</div>';	
		
		return $html;
		}
		
		
	
	
	
	public function job_bm_templates_settings_display(){
		
		$html = '';
		
		if(empty($_POST['job_bm_hidden']))
			{
				$job_bm_email_templates_data = get_option( 'job_bm_email_templates_data' );				

				
							
			}
		else{
			if($_POST['job_bm_hidden'] == 'Y'){
				
				
				$job_bm_email_templates_data = stripslashes_deep($_POST['job_bm_email_templates_data']);
				update_option('job_bm_email_templates_data', $job_bm_email_templates_data);				
		
			
				$html.= '<div class="updated"><p><strong>'.__('Changes Saved.', job_bm_textdomain ).'</strong></p></div>';	
				}
			}
		
		
		
		
		
		
		
		
		
		
		
		$html.= '<div class="wrap">';	
		$html.= '<div id="icon-tools" class="icon32"><br></div><h2>'.__(job_bm_plugin_name.' - Emails Templates', job_bm_textdomain).'</h2>';	
		
		
		
		$html.= '<form  method="post" action="'.str_replace( '%7E', '~', $_SERVER['REQUEST_URI']).'">';		
		$html.= '<input type="hidden" name="job_bm_hidden" value="Y">';			

		$html.= '<div class="para-settings job-bm-emails-templates">';
		
		$html.= $this->job_bm_templates_editor();
		
		$html.= '<p class="submit">
                    <input class="button button-primary" type="submit" name="Submit" value="'.__('Save Changes',job_bm_textdomain ).'" />
                    <input class="reset-email-templates button" type="button" value="'.__('Reset',job_bm_textdomain ).'" />					
					
                    					
                </p>';
		$html.= '</form>';


		$class_job_bm_emails = new class_job_bm_emails();
		$parameters = $class_job_bm_emails->job_bm_email_templates_parameters();

		$html.= '<div class="parameters"><ul>';			
		
		foreach($parameters as $key=>$parameter){
			
			$html.='<li><br /><b>'.$parameter['title'].'</b>';
			foreach($parameter['parameters'] as $parameter_name){
				$html.='<li>'.$parameter_name;			
				$html.='</li>';
				}
			
			$html.='</li>';
			
			}
			
		$html.= '</ul>';		
		$html.= '</div></div></div>';			
			
			
		return $html;	
			
			
		
		}
	
	
	
	
	
	
	
	
	
	
}

new class_job_bm_emails_templates();


