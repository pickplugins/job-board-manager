<?php	


/*
* @Author 		PickPlugins
* Copyright: 	2015 PickPlugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

$class_job_bm_functions = new class_job_bm_functions();

$reports_tabs = $class_job_bm_functions->reports_tabs();

	
?>
<div class="wrap job-bm-admin">

	<div id="icon-tools" class="icon32"><br></div><?php echo "<h2>".__(sprintf('%s - Reports',job_bm_plugin_name), job_bm_textdomain)."</h2>";?>
    
    <div class="reports para-settings">
    
    	<ul class="tab-nav">
		<?php
		if(!empty($_GET['tab'])){
			$current_tab = $_GET['tab'];
			}
		else{
			$current_tab = 'job';
			}
		
		
		
        $i=1;
		foreach($reports_tabs as $key=>$tab){
			

			
			if($current_tab==$key){
				echo '<li class="nav'.$i.' '.$key.' active" nav="'.$i.'">';
				echo '<a href="'.admin_url().'edit.php?post_type=job&page=job_bm_reports&tab='.$key.'">'.$tab['title'].'</a>';
				echo '</li>';
				
				}
			else{
				
				echo '<li class="nav'.$i.'" nav="'.$i.'">';
				echo '<a href="'.admin_url().'edit.php?post_type=job&page=job_bm_reports&tab='.$key.'">'.$tab['title'].'</a>';
				echo '</li>';
				}
			
			
			
			
			$i++;
			}
		?>
    	</ul>
    
    	<ul class="box">
		<?php
        $i=1;
		foreach($reports_tabs as $key=>$tab){
			
			if($current_tab==$key){
				echo '<li class="box'.$i.' '.$key.' tab-box active" style="display: block;" >';
				echo $tab['html'];
				echo '</li>';
				
				}
			else{
				
				echo '<li class="box'.$i.' tab-box" style="display: none;" >';
				echo $tab['html'];
				echo '</li>';
				}
			
			

			
			
			
			
			$i++;
			}
		?>
    	</ul>    
    
    </div>
    

</div>
