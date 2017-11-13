<?php
/*
* @Author 		PickPlugins
* Copyright: 	2015 PickPlugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 


	$job_bm_archive_page_id = get_option('job_bm_archive_page_id');
	$job_bm_archive_page_url = get_permalink($job_bm_archive_page_id);


	$class_job_bm_functions = new class_job_bm_functions();
	$job_type_list = array_filter($class_job_bm_functions->job_type_list());
	
	
	if(!empty($_GET['job_type'])){
		
		$job_type = $_GET['job_type'];
		
		if(!is_array($job_type)){
			
			$job_type = array($job_type);
			
			}
		
		}
	
	
	//echo '<pre>'.var_export($job_type_list, true).'</pre>';
	
	?>

    <form class="search-input" method="get" action="<?php echo $job_bm_archive_page_url; ?>">
    
    <div class="option half">
    <input placeholder="<?php echo __('Keyword', job_bm_textdomain); ?>" name="keywords" type="search" value="<?php if(!empty($_GET['keywords'])) echo sanitize_text_field($_GET['keywords']) ?>" />
	
    </div>
    
    <div class="option half">

    <input placeholder="<?php echo __('Location', job_bm_textdomain); ?>" name="locations" type="search" value="<?php if(!empty($_GET['locations'])) echo sanitize_text_field($_GET['locations']) ?>" />    
    </div>    
    
    
    
    <div class="option">
    <?php 
    
	foreach($job_type_list as $job_type_key=>$job_type_name){
		
		if(!empty($job_type_key)):
		?>
        <label>
        	<input type="checkbox" <?php if( !empty($job_type) && in_array($job_type_key, $job_type) ) echo 'checked'; ?>  name="job_type[]" value="<?php echo $job_type_key; ?>" /> <?php echo $job_type_name; ?>
        </label>
        <?php
		endif;
		
		}
    
    
    ?>
    

    </div>
    
    <input type="submit" value="<?php echo __('Submit', job_bm_textdomain); ?>" />
    
    </form> <!-- .search-input -->


