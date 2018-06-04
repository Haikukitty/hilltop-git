<?php 
/*
Plugin Name: Hilltop Custom Post Types and Taxonomy Advisory Board
Description: Hilltop-specific custom post-types and custom category taxonomies
Author: Mia Jordan
Version: 1.0
 */








if ( ! function_exists( 'board_taxonomy' ) ) {

// Register Custom Taxonomy
function board_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Board Categories', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Board Category', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Board Categories', 'text_domain' ),
		'all_items'                  => __( 'All Items', 'text_domain' ),
		'parent_item'                => __( 'Parent Item', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
		'new_item_name'              => __( 'New Item Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New Item', 'text_domain' ),
		'edit_item'                  => __( 'Edit Item', 'text_domain' ),
		'update_item'                => __( 'Update Item', 'text_domain' ),
		'view_item'                  => __( 'View Item', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Items', 'text_domain' ),
		'search_items'               => __( 'Search Items', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No items', 'text_domain' ),
		'items_list'                 => __( 'Items list', 'text_domain' ),
		'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'board_category', array( 'board' ), $args );

}
add_action( 'init', 'board_taxonomy', 0 );

}


/*-------------------------------------------------------------------------------------------*/
	/* Jobs Postings Post Type */
	/*-------------------------------------------------------------------------------------------*/
	class board {

		function board() {
			add_action('init',array($this,'create_post_type'));
		}

		function create_post_type() {
			$labels = array(
			    'name' => 'Advisory Board',
			    'singular_name' => 'Advisory Board Member',
			    'add_new' => 'Add Board Member',
			    'all_items' => 'All Board Members',
			    'add_new_item' => 'Add New Board Member',
			    'edit_item' => 'Edit Board Member',
			    'new_item' => 'New Board Member',
			    'view_item' => 'View Board Member',
			    'search_items' => 'Search Board Members',
			    'not_found' =>  'No Board Member found',
			    'not_found_in_trash' => 'No Board Members found in trash',
			    'parent_item_colon' => 'Parent Post:',
			    'menu_name' => 'Advisory Board'
			);
			$args = array(
				'labels' => $labels,
				'description' => "Advisory Board section",
				'public' => true,
				'exclude_from_search' => false,
				'publicly_queryable' => true,
				'show_ui' => true,
				'show_in_nav_menus' => false,
				'show_in_menu' => true,
				'show_in_admin_bar' => true,
				'menu_position' => 20,
				'menu_icon' => '/absolute/url/to/icon',
				'capability_type' => 'post',
				'hierarchical' => false,
				'supports' => array('title','editor','author','thumbnail','custom-fields','revisions'),
				'has_archive' => true,
				'rewrite' => false,
				'query_var' => true,
				'can_export' => true
			);
			register_post_type('board',$args);
		}
	}

	$board = new board();


												


?>