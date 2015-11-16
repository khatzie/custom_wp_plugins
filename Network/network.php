<?php
/*
Plugin Name: Networks
Description: Declares a plugin that will create a custom post type displaying networks
Version: 1.0
Author: Katherine Petalio
*/

add_action( 'init', 'networks' );

    function networks() {
        $labels = array(
            'name'               => _x( 'Networks', 'post type general name' ),
            'singular_name'      => _x( 'Networks', 'post type singular name' ),
            'add_new'            => __( 'Add New' ),
            'add_new_item'       => __( 'Add New networks' ),
            'edit_item'          => __( 'Edit Networks' ),
            'new_item'           => __( 'New Networks' ),
            'all_items'          => __( 'All Networks' ),
            'view_item'          => __( 'View Networks' ),
            'search_items'       => __( 'Search Networks' ),
            'not_found'          => __( 'No networks found.' ),
            'not_found_in_trash' => __( 'No networks found in the Trash.' ), 
            'parent_item_colon'  => '',
            'menu_name'          => 'Networks'
        );
        $args = array(
            'labels'        => $labels,
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_nav_menus' => false,
            'capability_type' => 'post',
            'supports'      => array( 'title', 'editor', 'thumbnail' ),
            'hierarchical' => true
        );
        register_post_type( 'networks', $args );
        flush_rewrite_rules();
    }


/**
 * Show Column Content for Custom Post Type Fortman Team
 */

add_action('manage_networks_posts_custom_column', 'columns_content_networks', 10, 2); 
 
 function networks_post_columns( $talents_columns ) {
    $columns = array (
        'cb' => '<input type="checkbox" />',
        'title' => __( 'Branch Name' ),
		'address' => __( 'Address' ),
        'date' => __( 'Date' )
    );
    return $columns;
}

function columns_content_networks($column){
  global $post;

  switch ($column) {
    case "address":
		echo get_post_meta($post->ID, 'address', true);
		break;
  }
}
add_filter( 'manage_networks_posts_columns', 'networks_post_columns' );


