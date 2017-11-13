<?php	


/*
* @Author 		PickPlugins
* Copyright: 	2015 PickPlugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 



	
?>





<div class="wrap">

	<div id="icon-tools" class="icon32"><br></div><?php echo "<h2>".__(sprintf('%s - Help',job_bm_plugin_name), job_bm_textdomain)."</h2>";?>
    
    <div class="para-settings job-bm-admin">
    
   		<div class="option-box">
            <p class="option-title"><?php _e('Ask any question',job_bm_textdomain); ?></p>
            <p class="option-info">
            <?php _e('Please feel free to contact for any question, ask via our forum <a href="http://www.pickplugins.com/questions/">http://www.pickplugins.com/questions/</a>',job_bm_textdomain); ?>
            </p>
            
        </div>    
    
   		<div class="option-box">
            <p class="option-title"><?php _e('Watch video tutorial',job_bm_textdomain); ?></p>
            <p class="option-info"></p>
            
            <div class="tutorials expandable">
            <?php
            $class_job_bm_functions = new class_job_bm_functions();
			$tutorials =  $class_job_bm_functions->tutorials();
			
			foreach($tutorials as $tutorial){
				
				echo '<div class="items">';
				echo '<div class="header "><i class="fa fa-play"></i>&nbsp;&nbsp;'.$tutorial['title'].'</div>';
				echo '<div class="options"><iframe width="640" height="480" src="//www.youtube.com/embed/'.$tutorial['video_id'].'" frameborder="0" allowfullscreen></iframe></div>';				
				
				echo '</div>';				
				
				}
			
			?>

            </div>

        </div>
        
        
   		<div class="option-box">
            <p class="option-title"><?php _e('FAQ',job_bm_textdomain); ?></p>
            <p class="option-info"></p>
            
            <div class="faq">
            <?php
            $class_job_bm_functions = new class_job_bm_functions();
			$faq =  $class_job_bm_functions->faq();
			
			echo '<ul>';
			foreach($faq as $faq_data){
				echo '<li>';
				$title = $faq_data['title'];
				$items = $faq_data['items'];				
				
				echo '<span class="group-title">'.$title.'</span>';
				
					echo '<ul>';
					foreach($items as $item){
						
							echo '<li class="item">';
							echo '<a href="'.$item['answer_url'].'"><i class="fa fa-question-circle-o" aria-hidden="true"></i> '.$item['question'].'</a>';
						
							
							echo '</li>';	

					}		
					echo '</ul>';
			
				echo '</li>';
				}
				
				echo '</ul>';
			?>

            </div>

        </div>        
        
        
        
        
        
        
        
        
        
    
    </div>

</div>
