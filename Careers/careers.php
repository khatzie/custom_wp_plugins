<?php
/*
Plugin Name: Careers
Description: Declares a plugin that will create a custom post type displaying careers
Version: 1.0
Author: Katherine Petalio
*/

add_action( 'init', 'careers' );

    function careers() {
        $labels = array(
            'name'               => _x( 'Careers', 'post type general name' ),
            'singular_name'      => _x( 'Careers', 'post type singular name' ),
            'add_new'            => __( 'Add New' ),
            'add_new_item'       => __( 'Add New Careers' ),
            'edit_item'          => __( 'Edit Careers' ),
            'new_item'           => __( 'New Careers' ),
            'all_items'          => __( 'All Careers' ),
            'view_item'          => __( 'View Careers' ),
            'search_items'       => __( 'Search Careers' ),
            'not_found'          => __( 'No careers found.' ),
            'not_found_in_trash' => __( 'No careers found in the Trash.' ), 
            'parent_item_colon'  => '',
            'menu_name'          => 'Careers'
        );
        $args = array(
            'labels'        => $labels,
            'public' => true,
            'publicly_queryable' => true,
			'taxonomies' => array( 'departments'),
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_nav_menus' => false,
            'capability_type' => 'post',
            'supports'      => array( 'title', 'editor', 'thumbnail' ),
            'hierarchical' => true
        );
        register_post_type( 'careers', $args );
        flush_rewrite_rules();
    }

	function departments_taxonomy() {  
		register_taxonomy(  
			'departments',  //The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces). 
			'careers',   //post type name
			array(  
				'hierarchical' => true, 
				'labels' => array(
					'name' => __( 'Departments' ),
					'singular_name' => __( 'Departments' ),
					'add_new_item' => 'Add New Department',
					'edit_item' => 'Edit Department',
					'new_item' => 'New Department',
					'search_items' => 'Search Department',
					'not_found' => 'No Department found',
					'not_found_in_trash' => 'No Department found in trash',
				),
				'query_var' => true,
				'rewrite' => array(
					'slug' => 'departments' // This controls the base slug that will display before each term
				)
			)  
		);  
	}  
	add_action( 'init', 'departments_taxonomy');
/**
 * GET FEATURED IMAGE
 */
function get_featured_image_careers($post_ID) {  
    $post_thumbnail_id = get_post_thumbnail_id($post_ID);  
    if ($post_thumbnail_id) {
        $post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, 'featured_preview');  
        return $post_thumbnail_img[0];  
    }  
}
	
/**
 * Show Column Content for Custom Post Type Fortman Team
 */

add_action('manage_careers_posts_custom_column', 'columns_content_careers', 10, 2); 
 
 function careers_post_columns( $talents_columns ) {
    $columns = array (
        'cb' => '<input type="checkbox" />',
        'title' => __( 'Job Title' ),
		'departments' => __( 'Department' ),
		'closingdate' => __( 'Closing Date' ),
        'date' => __( 'Date' )
    );
    return $columns;
}

function columns_content_careers($column){
  global $post;

  switch ($column) {
    case "departments":
		echo get_the_term_list($post->ID,'departments','',', ','');
		break;
	
	case "closingdate":
		echo get_post_meta($post->ID, 'closing_date', true);
		break;
  }
}
add_filter( 'manage_careers_posts_columns', 'careers_post_columns' );

function change_default_title_careers( $title ){
     $screen = get_current_screen();
     if  ( $screen->post_type == 'careers' ) {
          return 'Enter Job Title/ Position Here';
     }
}
add_filter( 'enter_title_here', 'change_default_title_careers' );


