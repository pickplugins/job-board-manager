<?php
/*
* @Author 		PickPlugins
* Copyright: 	2015 PickPlugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 



$archive_more_style = get_option( 'job_bm_list_archive_more_style', 'pagination' );


if( $archive_more_style == 'pagination' ) {

	echo '<div class="paginate">';
	$big = 999999999; // need an unlikely integer
	echo paginate_links( array(
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		
		'format' => '?paged=%#%',
		'current' => max( 1, $paged ),
		'total' => $wp_query->max_num_pages
		) );

	echo '</div >';	

}

if( $archive_more_style == 'ajax' ) {


	echo '<div class="paginate">';
	echo '<div paged=2 class="paginate-ajax">';
	echo __( 'Load more', job_bm_textdomain ).' <i class="fa fa-eercast" aria-hidden="true"></i>';
	echo '</div></div>';	

}



