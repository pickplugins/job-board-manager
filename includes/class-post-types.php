<?php

/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

class class_job_bm_post_types{
	
	public function __construct(){
		
		add_action( 'init', array( $this, 'job_bm_posttype_job' ), 0 );
		add_action( 'init', array( $this, 'job_bm_register_job_category' ), 0 );
		add_action( 'init', array( $this, 'job_bm_register_job_tags' ), 0 );		
		
		
		}
	
	public function job_bm_posttype_job(){
		if ( post_type_exists( "job" ) )
		return;

		$singular  = __( 'Job', job_bm_textdomain );
		$plural    = __( 'Jobs', job_bm_textdomain );
	 
	 
		register_post_type( "job",
			apply_filters( "register_post_type_job", array(
				'labels' => array(
					'name' 					=> $plural,
					'singular_name' 		=> $singular,
					'menu_name'             => $singular,
					'all_items'             => sprintf( __( 'All %s', job_bm_textdomain ), $plural ),
					'add_new' 				=> sprintf( __( 'Add %s', job_bm_textdomain ), $singular ),
					'add_new_item' 			=> sprintf( __( 'Add %s', job_bm_textdomain ), $singular ),
					'edit' 					=> __( 'Edit', job_bm_textdomain ),
					'edit_item' 			=> sprintf( __( 'Edit %s', job_bm_textdomain ), $singular ),
					'new_item' 				=> sprintf( __( 'New %s', job_bm_textdomain ), $singular ),
					'view' 					=> sprintf( __( 'View %s', job_bm_textdomain ), $singular ),
					'view_item' 			=> sprintf( __( 'View %s', job_bm_textdomain ), $singular ),
					'search_items' 			=> sprintf( __( 'Search %s', job_bm_textdomain ), $plural ),
					'not_found' 			=> sprintf( __( 'No %s found', job_bm_textdomain ), $plural ),
					'not_found_in_trash' 	=> sprintf( __( 'No %s found in trash', job_bm_textdomain ), $plural ),
					'parent' 				=> sprintf( __( 'Parent %s', job_bm_textdomain ), $singular )
				),
				'description' => sprintf( __( 'This is where you can create and manage %s.', job_bm_textdomain ), $plural ),
				'public' 				=> true,
				'show_ui' 				=> true,
				'capability_type' 		=> 'post',
				'map_meta_cap'          => true,
				'publicly_queryable' 	=> true,
				'exclude_from_search' 	=> false,
				'hierarchical' 			=> false,
				'rewrite' 				=> true,
				'query_var' 			=> true,
				'supports' 				=> array('title','editor','custom-fields','author'),
				'show_in_nav_menus' 	=> false,
				'menu_icon' => 'dashicons-megaphone',
			) )
		); 
	 
	 
		}
		
		
		
		
		
		
		
		
	public function job_bm_register_job_category(){

			$singular  = __( 'Job Category', job_bm_textdomain );
			$plural    = __( 'Job Categories', job_bm_textdomain );
	 
			register_taxonomy( "job_category",
				apply_filters( 'register_taxonomy_job_category_object_type', array( 'job' ) ),
				apply_filters( 'register_taxonomy_job_category_args', array(
					'hierarchical' 			=> true,
					'show_admin_column' 	=> true,					
					'update_count_callback' => '_update_post_term_count',
					'label' 				=> $plural,
					'labels' => array(
						'name'              => $plural,
						'singular_name'     => $singular,
						'menu_name'         => ucwords( $plural ),
						'search_items'      => sprintf( __( 'Search %s', job_bm_textdomain ), $plural ),
						'all_items'         => sprintf( __( 'All %s', job_bm_textdomain ), $plural ),
						'parent_item'       => sprintf( __( 'Parent %s', job_bm_textdomain ), $singular ),
						'parent_item_colon' => sprintf( __( 'Parent %s:', job_bm_textdomain ), $singular ),
						'edit_item'         => sprintf( __( 'Edit %s', job_bm_textdomain ), $singular ),
						'update_item'       => sprintf( __( 'Update %s', job_bm_textdomain ), $singular ),
						'add_new_item'      => sprintf( __( 'Add New %s', job_bm_textdomain ), $singular ),
						'new_item_name'     => sprintf( __( 'New %s Name', job_bm_textdomain ),  $singular )
					),
					'show_ui' 				=> true,
					'public' 	     		=> true,
					'rewrite' => array(
						'slug' => 'job_category', // This controls the base slug that will display before each term
						'with_front' => false, // Don't display the category base before "/locations/"
						'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
				),
				) )
			);

		}	
		
		
		
		
	public function job_bm_register_job_tags(){

			$singular  = __( 'Job Tag', job_bm_textdomain );
			$plural    = __( 'Job Tags', job_bm_textdomain );
	 
			register_taxonomy( "job_tag",
				apply_filters( 'register_taxonomy_job_tag_object_type', array( 'job' ) ),
				apply_filters( 'register_taxonomy_job_tag_args', array(
					'hierarchical' 			=> false,
					'show_admin_column' 	=> true,					
					'update_count_callback' => '_update_post_term_count',
					'label' 				=> $plural,
					'labels' => array(
						'name'              => $plural,
						'singular_name'     => $singular,
						'menu_name'         => ucwords( $plural ),
						'search_items'      => sprintf( __( 'Search %s', job_bm_textdomain ), $plural ),
						'all_items'         => sprintf( __( 'All %s', job_bm_textdomain ), $plural ),
						'parent_item'       => sprintf( __( 'Parent %s', job_bm_textdomain ), $singular ),
						'parent_item_colon' => sprintf( __( 'Parent %s:', job_bm_textdomain ), $singular ),
						'edit_item'         => sprintf( __( 'Edit %s', job_bm_textdomain ), $singular ),
						'update_item'       => sprintf( __( 'Update %s', job_bm_textdomain ), $singular ),
						'add_new_item'      => sprintf( __( 'Add New %s', job_bm_textdomain ), $singular ),
						'new_item_name'     => sprintf( __( 'New %s Name', job_bm_textdomain ),  $singular )
					),
					'show_ui' 				=> true,
					'public' 	     		=> true,
					'rewrite' => array(
						'slug' => 'job_tag', // This controls the base slug that will display before each term
						'with_front' => false, // Don't display the category base before "/locations/"
						'hierarchical' => false // This will allow URL's like "/locations/boston/cambridge/"
				),
				) )
			);

		}
	
	}
	
	new class_job_bm_post_types();