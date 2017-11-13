<?php
/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 
	
	
	
	
function job_bm_dashboard_widgets_display(){
	
		$last_7_date = array();
	

	
	echo '
	
<script type="text/javascript">
jQuery(function () {
	//Better to construct options first and then pass it as a parameter
	var options = {
		height:200,
		title: {
			text: ""
		},
		
		
                animationEnabled: true,
		data: [
		{
			type: "column", //change it to line, area, column, pie, etc
			color: "#dddddd",
			dataPoints: [';
			
			
		for ($i=0; $i<7; $i++){
			
			$day = date("d", strtotime($i." days ago")); 	
			$month = date("m", strtotime($i." days ago"));	
			$year = date("Y", strtotime($i." days ago"));			
		
			$args = array(
				'post_type' => 'job',
				'post_status' => 'publish',
				'posts_per_page' => -1,
				'date_query' => array(
					array(
						'year'  => $year,
						'month' => $month,
						'day'   => $day,
					),
				),
			);
			$wp_query = new WP_Query( $args );
			//echo '{ x: '.($i+1).' , y: '.$wp_query->post_count.' },';
			echo '{ label: "'.$day.'/'.$month.'", y: '.$wp_query->found_posts.' },';			
			
			//var_dump();

		}
			
			
				

			echo ']
		}
		]
	};

	jQuery("#job-7-days").CanvasJSChart(options);

});
</script>
	
	
	';	
		
		
		
		
$start_memory = memory_get_usage();
//var_dump($start_memory);

//$foo =$wp_query;
//var_dump(memory_get_usage() - $start_memory);
		
//var_dump(sizeof($wp_query));
		
		
	
	echo '<p>'.__('Job posting last 7 days.',job_bm_textdomain).'</p>';
	
	echo '<div id="job-7-days" style="height: 300px; width: 100%;"></div>';
	
	
	}
	
	
// Function used in the action hook
function job_bm_dashboard_widgets() {
	wp_add_dashboard_widget('dashboard_widget', 'Job Board Manager', 'job_bm_dashboard_widgets_display');
}


add_action('wp_dashboard_setup', 'job_bm_dashboard_widgets' );
	

	
	
	
	
	
	
	
	

function job_bm_report_html_job_display(){
	
	if(!empty($_GET['range'])){
		$range = $_GET['range'];
		}
	else{
		$range = '7_day';
		}
	
	$html = '';
	
	$last_7_date = array();
	
	$html.= '
	<div class="range">';
	
	if($range=='year'){
		$html.= '<a class="active" href="'.admin_url().'edit.php?post_type=job&page=job_bm_reports&tab=job&range=year">Year</a>';
		}
	else{
		$html.= '<a href="'.admin_url().'edit.php?post_type=job&page=job_bm_reports&tab=job&range=year">Year</a>';
		}
	
	if($range=='last_month'){
		$html.= '<a class="active" href="'.admin_url().'edit.php?post_type=job&page=job_bm_reports&tab=job&range=last_month">Last Month</a>';
		}
	else{
		$html.= '<a href="'.admin_url().'edit.php?post_type=job&page=job_bm_reports&tab=job&range=last_month">Last Month</a>';
		}	
	
	
	if($range=='this_month'){
		$html.= '<a class="active"  href="'.admin_url().'edit.php?post_type=job&page=job_bm_reports&tab=job&range=this_month">This Month</a>';
		}
	else{
		$html.= '<a href="'.admin_url().'edit.php?post_type=job&page=job_bm_reports&tab=job&range=this_month">This Month</a>';
		}	
	
	if($range=='last_30_day'){
		$html.= '<a class="active" href="'.admin_url().'edit.php?post_type=job&page=job_bm_reports&tab=job&range=last_30_day">Last 30 Days</a>	';	
		}
	else{
		$html.= '<a href="'.admin_url().'edit.php?post_type=job&page=job_bm_reports&tab=job&range=last_30_day">Last 30 Days</a>	';	
		}	
	
	if($range=='7_day'){
		$html.= '<a class="active" href="'.admin_url().'edit.php?post_type=job&page=job_bm_reports&tab=job&range=7_day">Last 7 Days</a>';
		}
	else{
		$html.= '<a href="'.admin_url().'edit.php?post_type=job&page=job_bm_reports&tab=job&range=7_day">Last 7 Days</a>';
		}		
	
	if($range=='custom'){
		
			
		
		if(isset( $_GET['before'])){
			$before_date = $_GET['before'];	
			}
		else{
			$before_date = '';	
			}
			
		if(isset( $_GET['after'])){
			$after_date = $_GET['after'];	
			}
		else{
			$after_date = '';	
			}			
			
			
			
		
		$html.= '
		
		<form style="display:inline-block" method="GET" action="'.str_replace( '%7E', '~', $_SERVER['REQUEST_URI']).'">
			<input size="8" type="text" class="job_bm_date" name="after" value="'.$after_date.'" placeholder="First Date" />
			<input size="8" type="text" class="job_bm_date" name="before" value="'.$before_date.'" placeholder="Last Date" />
			<input type="hidden"  name="post_type" value="job" />
			<input type="hidden"  name="page" value="job_bm_reports" />			
			<input type="hidden"  name="tab" value="job" />	
			<input type="hidden"  name="range" value="custom" />						
			
			<input class="button" value="See" type="submit">
		</form>

		
		';
		}
	else{
		
		
		if(isset( $_GET['before'])){
			$before_date = $_GET['before'];	
			}
		else{
			$before_date = '';	
			}
			
		if(isset( $_GET['after'])){
			$after_date = $_GET['after'];	
			}
		else{
			$after_date = '';	
			}
		
		
		$html.= '
		
		<form style="display:inline-block" method="GET" action="'.str_replace( '%7E', '~', $_SERVER['REQUEST_URI']).'">
		'.__('Custom:',job_bm_textdomain).'
			<input size="8" type="text" class="job_bm_date" name="after" value="'.$after_date.'" placeholder="First Date" />
			<input size="8" type="text" class="job_bm_date" name="before" value="'.$before_date.'" placeholder="Last Date" />
			<input type="hidden"  name="post_type" value="job" />
			<input type="hidden"  name="page" value="job_bm_reports" />			
			<input type="hidden"  name="tab" value="job" />	
			<input type="hidden"  name="range" value="custom" />						
			
			<input class="button" value="'.__('Go',job_bm_textdomain).'" type="submit">
		</form>
		
		';
		}	
	
	
	
	
	
	
		
	
	
	$html.= '</div>
	';
	

	
	
	
	
	$html.= '
	
<script type="text/javascript">
jQuery(function () {
	//Better to construct options first and then pass it as a parameter
	var options_job = {
		height:200,
		title: {
			text: ""
		},
		
		
                animationEnabled: true,
		data: [
		{
			type: "column", //change it to line, area, column, pie, etc
			color: "#dddddd",
			dataPoints: [';
			
			
			
		if($range == '7_day'){
			
				for ($i=1; $i<=7; $i++){
					
					$day = date("d", strtotime($i." days ago")); 	
					$month = date("m", strtotime($i." days ago"));	
					$year = date("Y", strtotime($i." days ago"));			
				
					$args = array(
						'post_type' => 'job',
						'post_status' => 'publish',
						'posts_per_page' => -1,
						'date_query' => array(
							array(
								'year'  => $year,
								'month' => $month,
								'day'   => $day,
							),
						),
					);
					$wp_query = new WP_Query( $args );
					//echo '{ x: '.($i+1).' , y: '.$wp_query->post_count.' },';
					$html.=  '{ label: "'.$day.'/'.$month.'", y: '.$wp_query->found_posts.' },';			
					
					//var_dump();
		
				}
			
			}	
		elseif($range == 'last_30_day'){
			
				//$total_day = date('t');
			
				for ($i=1; $i<=30; $i++){
					
					$day = date("d", strtotime($i." days ago")); 	
					$month = date("m", strtotime($i." days ago"));	
					$year = date("Y", strtotime($i." days ago"));			
				
					$args = array(
						'post_type' => 'job',
						'post_status' => 'publish',
						'posts_per_page' => -1,
						'date_query' => array(
							array(
								'year'  => $year,
								'month' => $month,
								'day'   => $day,
							),
						),
					);
					$wp_query = new WP_Query( $args );
					//echo '{ x: '.($i+1).' , y: '.$wp_query->post_count.' },';
					$html.=  '{ label: "'.$day.'/'.$month.'", y: '.$wp_query->found_posts.' },';			
					
					//var_dump();
		
				}	
			
			
			}
		elseif($range == 'this_month'){
			
				$total_day = date('t');
			
				for ($i=1; $i<=$total_day; $i++){
					
					$day = $i; 	
					$month = date("m");	
					$year = date("Y");			
				
					$args = array(
						'post_type' => 'job',
						'post_status' => 'publish',
						'posts_per_page' => -1,
						'date_query' => array(
							array(
								'year'  => $year,
								'month' => $month,
								'day'   => $day,
							),
						),
					);
					$wp_query = new WP_Query( $args );
					//echo '{ x: '.($i+1).' , y: '.$wp_query->post_count.' },';
					$html.=  '{ label: "'.$day.'/'.$month.'", y: '.$wp_query->found_posts.' },';			
					
					//var_dump();
		
				}	
			
			
			}
		elseif($range == 'last_month'){
			
				//var_dump(date("t", strtotime("1 month ago")));
				
				$total_day = date("t", strtotime("1 month ago"));
			
				for ($i=1; $i<=$total_day; $i++){
					
					$day = $i; 	
					$month = date("m", strtotime("1 month ago"));	
					$year = date("Y");			
				
					$args = array(
						'post_type' => 'job',
						'post_status' => 'publish',
						'posts_per_page' => -1,
						'date_query' => array(
							array(
								'year'  => $year,
								'month' => $month,
								'day'   => $day,
							),
						),
					);
					$wp_query = new WP_Query( $args );
					//echo '{ x: '.($i+1).' , y: '.$wp_query->post_count.' },';
					$html.=  '{ label: "'.$day.'/'.$month.'", y: '.$wp_query->found_posts.' },';			
					
					//var_dump();
		
				}	
			
			}	
			
			
					
			
		elseif($range == 'year'){
			
				$current_month =  date("m");
			
			//var_dump(date("M", strtotime("1 month ago")));
			
				for ($i=1; $i<=$current_month; $i++){
					
						
					$month = $i;	
					$year = date("Y");			
				
					$args = array(
						'post_type' => 'job',
						'post_status' => 'publish',
						'posts_per_page' => -1,
						'date_query' => array(
							array(
								'year'  => $year,
								'month' => $month,
								//'day'   => $day,
							),
						),
					);
					$wp_query = new WP_Query( $args );
					//echo '{ x: '.($i+1).' , y: '.$wp_query->post_count.' },';
					$html.=  '{ label: "'.$month.'/'.$year.'", y: '.$wp_query->found_posts.' },';	
							
					wp_reset_query();
					//var_dump();
		
				}
			
			
			
			}	
			
			
		elseif($range == 'custom'){
			
				$current_month =  date("m");
			
				$after_date = $_GET['after'];
				$after = explode('-',$after_date);
				
				$after_y = $after[0];
				$after_m = $after[1];				
				$after_d = $after[2];				
				
				
				$before_date = $_GET['before'];	
				$before = explode('-',$before_date);
				$before_y = $before[0];
				$before_m = $before[1];				
				$before_d = $before[2];				
				
				
				
				$start    = new DateTime($after_date);
				$start->modify('first day of this month');
				$end      = new DateTime($before_date);
				$end->modify('first day of next month');
				$interval = DateInterval::createFromDateString('1 month');
				$period   = new DatePeriod($start, $interval, $end);
				
				$i = 0;
				foreach ($period as $dt) {
					
					$all_month_year[$i] = array($dt->format("Y"),$dt->format("m"));
					
					//echo $dt->format("Y-m") . "<br>\n";
					$i++;
				}
				
				
				
				//var_dump($all_month_year);	
			
			//var_dump(date("M", strtotime("1 month ago")));
			
			
			foreach($all_month_year as $month_year){
				
					$year = $month_year[0];
					$month = $month_year[1];
					
					$args = array(
						'post_type' => 'job',
						'post_status' => 'publish',
						'posts_per_page' => -1,
						'date_query' => array(
							array(
								'year'  => $year,
								'month' => $month,
								//'day'   => $day,
							)
						),
					);
					
					$wp_query = new WP_Query( $args );
					//echo '{ x: '.($i+1).' , y: '.$wp_query->post_count.' },';
					$html.=  '{ label: "'.$month.'/'.$year.'", y: '.$wp_query->found_posts.' },';
				
				
				
				
				
				}

			}			
			
			
			
			
						

			$html.=  ']
		}
		]
	};

	jQuery("#job-reports").CanvasJSChart(options_job);

});
</script>
	
	
	';		
	
	
	$html.=  '<div id="job-reports" style="height: 300px; width: 100%;"></div>';
	
	return $html;
	}
	
add_filter('job_bm_filters_report_html_job','job_bm_report_html_job_display');


























