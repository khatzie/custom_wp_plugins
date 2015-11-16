<?php
/*
Plugin Name: Clients
Description: Declares a plugin that will create a custom post type displaying clients
Author: Katherine Petalio
*/

add_action( 'init', 'clients' );

    function clients() {
        $labels = array(
            'name'               => _x( 'Clients', 'post type general name' ),
            'singular_name'      => _x( 'Clients', 'post type singular name' ),
            'add_new'            => __( 'Add New' ),
            'add_new_item'       => __( 'Add New Clients' ),
            'edit_item'          => __( 'Edit Clients' ),
            'new_item'           => __( 'New Clients' ),
            'all_items'          => __( 'All Clients' ),
            'view_item'          => __( 'View Clients' ),
            'search_items'       => __( 'Search Clients' ),
            'not_found'          => __( 'No clients found.' ),
            'not_found_in_trash' => __( 'No clients found in the Trash.' ), 
            'parent_item_colon'  => '',
            'menu_name'          => 'Clients'
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
        register_post_type( 'clients', $args );
        flush_rewrite_rules();
    }
/**
 * GET FEATURED IMAGE
 */
function get_featured_image_clients($post_ID) {  
    $post_thumbnail_id = get_post_thumbnail_id($post_ID);  
    if ($post_thumbnail_id) {
        $post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, 'featured_preview');  
        return $post_thumbnail_img[0];  
    }  
}
	
/**
 * Show Column Content for Custom Post Type Fortman Team
 */

add_action('manage_clients_posts_custom_column', 'columns_content_clients', 10, 2); 
 
 function clients_post_columns( $clients_columns ) {
    $columns = array (
        'cb' => '<input type="checkbox" />',
		'title' => __( 'Client Name' ),
        'image' => __( 'Client Logo' ),
		'url' => __( 'URL' ),
        'date' => __( 'Date' )
    );
    return $columns;
}

function columns_content_clients($column){
  global $post;

  switch ($column) {
    case "image":
		$post_featured_image = get_featured_image_clients($post_ID);
		if ( $post_featured_image ) {
            echo '<div style="background:url('.$post_featured_image.'); height: 64px; width: 64px; background-position: 50% 50%; background-size: cover"></div>';            
        } else {
            echo 'No preview available';
        }
	
	case "url":
		echo get_post_meta($post->ID, 'url', true);
		break;
  }
}
add_filter( 'manage_clients_posts_columns', 'clients_post_columns' );

function change_default_title_clients( $title ){
     $screen = get_current_screen();
     if  ( $screen->post_type == 'clients' ) {
          return 'Enter Logo Name Here';
     }
}
add_filter( 'enter_title_here', 'change_default_title_clients' );


