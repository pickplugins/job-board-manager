<?php
/*
* @Author 		PickPlugins
* Copyright: 	2015 PickPlugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

//global $post;
//var_dump(($post));


if($job_bm_list_excerpt_display=='from_content'){

	$the_excerpt = wp_trim_words(get_the_content($job_id), $job_bm_list_excerpt_word_count);


	if(!empty($the_excerpt)){
		echo '<div title="" class="short_content">'.$the_excerpt.'</div>';
		}
	else{
		echo '<div title="" class="short_content">&nbsp;</div>';
		}

	}
elseif($job_bm_list_excerpt_display=='short_content'){

	if(!empty($job_bm_short_content)){
		echo '<div title="" class="short_content">'.wp_trim_words($job_bm_short_content, $job_bm_list_excerpt_word_count).'</div>';
		}
	else{
		echo '<div title="" class="short_content">&nbsp;</div>';
		}
	}
else{

	$the_excerpt = wp_trim_words(get_the_content($job_id), $job_bm_list_excerpt_word_count);


	if(!empty($the_excerpt)){
		echo '<div title="" class="short_content">'.$the_excerpt.'</div>';
		}
	else{
		echo '<div title="" class="short_content">&nbsp;</div>';
		}
	}

