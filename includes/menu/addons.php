<?php	


/*
* @Author 		PickPlugins
* Copyright: 	2015 PickPlugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 



class class_job_bm_addons_page  {
	
	
    public function __construct(){


    }
	
	
	public function job_bm_addons_data($addons_data = array()){
		
		$addons_data_new = array(
							

			'expired-check'=>array(	'title'=>'Expired check',
										'version'=>'1.0.0',
										'price'=>'0',
										'content'=>' Job Board Manager add-on for check expired job. ',										
										'item_link'=>'https://wordpress.org/plugins/job-board-manager-expired-check/',
										'thumb'=>job_bm_plugin_url.'includes/menu/images/expired-check.png',							
			),	

			'widgets'=>array(	'title'=>'Widgets',
										'version'=>'1.0.0',
										'price'=>'0',
										'content'=>'Widgets for Job Board Manager.',										
										'item_link'=>'https://wordpress.org/plugins/job-board-manager-widgets/',
										'thumb'=>job_bm_plugin_url.'includes/menu/images/widgets.png',							
			),
			
			'breadcrumb'=>array(	'title'=>'Breadcrumb',
										'version'=>'1.0.0',
										'price'=>'0',
										'content'=>'Breadcrumb for Job Board Manager.',										
										'item_link'=>'https://wordpress.org/plugins/job-board-manager-breadcrumb/',
										'thumb'=>job_bm_plugin_url.'includes/menu/images/breadcrumb.png',						
			),
			
							
			'company-profile'=>array(	'title'=>'Company Profile',
										'version'=>'1.0.0',
										'price'=>'15',
										'content'=>'Addon for creating company profile.',										
										'item_link'=>'http://www.pickplugins.com/item/job-board-manager-company-profile/',
										'thumb'=>job_bm_plugin_url.'includes/menu/images/company-profile.png',							
			),
			
			'locations'=>array(	'title'=>'Locations',
										'version'=>'1.0.0',
										'price'=>'15',
										'content'=>'Awesome location single page and display job list under any location via single page.',										
										'item_link'=>'http://www.pickplugins.com/item/job-board-manager-locations/',
										'thumb'=>job_bm_plugin_url.'includes/menu/images/locations.png',							
			),			



						
			'saved-jobs'=>array(	'title'=>'Saved Jobs',
										'version'=>'1.0.0',
										'price'=>'15',
										'content'=>'Allow visitors to save job link as bookmarks to thier account.',										
										'item_link'=>'http://www.pickplugins.com/item/job-board-manager-saved-jobs/',
										'thumb'=>job_bm_plugin_url.'includes/menu/images/saved-jobs.png',							
			),	
			
		
			
			'application-manager'=>array('title'=>'Application Manager',
										'version'=>'1.0.0',
										'price'=>'19',
										'content'=>'Manage application for every job.',										
										'item_link'=>'http://www.pickplugins.com/item/job-board-manager-application-manager/',
										'thumb'=>job_bm_plugin_url.'includes/menu/images/application-manager.png',							
			),				
			
			'stats'=>array(	'title'=>'Stats',
										'version'=>'1.0.0',
										'price'=>'10',
										'content'=>'Display job stats.',										
										'item_link'=>'http://www.pickplugins.com/item/job-board-manager-stats/',
										'thumb'=>job_bm_plugin_url.'includes/menu/images/stats.png',							
			),
			
			'categories'=>array(	'title'=>'Categories',
										'version'=>'1.0.0',
										'price'=>'15',
										'content'=>'Display Job Categories.',										
										'item_link'=>'http://www.pickplugins.com/item/job-board-manager-categories/',
										'thumb'=>job_bm_plugin_url.'includes/menu/images/categories.png',							
			),			
			
			'paid-listing'=>array(	'title'=>'Paid Listing',
										'version'=>'1.0.0',
										'price'=>'19',
										'content'=>'Get paid by listing jobs via WooCommerce.',										
										'item_link'=>'http://www.pickplugins.com/item/job-board-manager-woocommerce-paid-listing/',
										'thumb'=>job_bm_plugin_url.'includes/menu/images/paid-listing.png',							
			),				
			
			
			'job-list-ads'=>array(	'title'=>'Job List Ads',
										'version'=>'1.0.0',
										'price'=>'10',
										'content'=>'Display ads/custom html content inside job list.',										
										'item_link'=>'http://www.pickplugins.com/item/job-board-manager-job-list-ads/',
										'thumb'=>job_bm_plugin_url.'includes/menu/images/job-list-ads.png',							
			),				
						
			
			'search'=>array(	'title'=>'Search & Filter',
										'version'=>'1.0.0',
										'price'=>'19',
										'content'=>'Search & filter job by different input.',										
										'item_link'=>'http://www.pickplugins.com/item/job-board-manager-search/',
										'thumb'=>job_bm_plugin_url.'includes/menu/images/search.png',							
			),
			
			'job-feed'=>array(	'title'=>'Job Feed',
										'version'=>'1.0.0',
										'price'=>'25',
										'content'=>'Display jobs by followed companies, like social feed, once you follow any company job published from these company will display as like social feed.',										
										'item_link'=>'http://www.pickplugins.com/item/job-board-manager-job-feed/',
										'thumb'=>job_bm_plugin_url.'includes/menu/images/job-feed.png',							
			),			
						
			'report-job'=>array(	'title'=>'Report Job',
										'version'=>'1.0.1',
										'price'=>'12',
										'content'=>'add functionality to report/flag/moderate  a job.',										
										'item_link'=>'http://www.pickplugins.com/item/job-board-manager-report-job/',
										'thumb'=>job_bm_plugin_url.'includes/menu/images/report-job.png',							
			),							
						
			'related-jobs'=>array(	'title'=>'Related Jobs',
										'version'=>'1.0.1',
										'price'=>'12',
										'content'=>'Display related jobs under single job page.',										
										'item_link'=>'http://www.pickplugins.com/item/job-board-manager-report-job/',
										'thumb'=>job_bm_plugin_url.'includes/menu/images/related-jobs.png',							
			),								
				
						

		);
		
		$addons_data = array_merge($addons_data_new,$addons_data);
		
		$addons_data = apply_filters('job_bm_filters_addons_data', $addons_data);
		
		return $addons_data;
		
		
		}
	
	public function job_bm_addons_list_html(){
		
		$html = '';
		
		$addons_data = $this->job_bm_addons_data();
		
		foreach($addons_data as $key=>$values){
			
			$html.= '<div class="single '.$key.'">';
			$html.= '<div class="thumb"><a href="'.$values['item_link'].'"><img src="'.$values['thumb'].'" /></a></div>';			
			$html.= '<div class="title"><a href="'.$values['item_link'].'">'.$values['title'].'</a></div>';
			$html.= '<div class="content">'.$values['content'].'</div>';						
			$html.= '<div class="meta version"><b>'.__('Version:',job_bm_textdomain).'</b> '.$values['version'].'</div>';
			
			if($values['price']==0){
				
				$price = 'Free';
				}
			else{
				$price = '$'.$values['price'];
				
				}		
			$html.= '<div class="meta price"><b>'.__('Price:',job_bm_textdomain).'</b> '.$price.'</div>';							
			$html.= '<div class="meta download"><a href="'.$values['item_link'].'">'.__('Download',job_bm_textdomain).'</a></div>';				
			
			
			
			$html.= '</div>';
			
		
			
			}
		
		$html.= '';		
		
		return $html;
		}

	
	
	
}

//new class_job_bm_addons_page();


	
?>





<div class="wrap">

	<div id="icon-tools" class="icon32"><br></div><?php echo "<h2>".__(job_bm_plugin_name.' - Addons', job_bm_textdomain)."</h2>";?>
	<div class="job-bm-addons">
    
    <?php
    
	$class_job_bm_addons_page = new class_job_bm_addons_page();
	
	echo $class_job_bm_addons_page->job_bm_addons_list_html();
	
	
	?>
    </div>


</div>
