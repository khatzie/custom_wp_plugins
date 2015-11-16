<?php
/*
Plugin Name: History
Description: Declares a plugin that will create a custom post type displaying history
Version: 1.0
Author: Katherine Petalio
*/

add_action( 'init', 'history' );

    function history() {
        $labels = array(
            'name'               => _x( 'History', 'post type general name' ),
            'singular_name'      => _x( 'History', 'post type singular name' ),
            'add_new'            => __( 'Add New' ),
            'add_new_item'       => __( 'Add New History' ),
            'edit_item'          => __( 'Edit History' ),
            'new_item'           => __( 'New History' ),
            'all_items'          => __( 'All History' ),
            'view_item'          => __( 'View History' ),
            'search_items'       => __( 'Search History' ),
            'not_found'          => __( 'No history found.' ),
            'not_found_in_trash' => __( 'No history found in the Trash.' ), 
            'parent_item_colon'  => '',
            'menu_name'          => 'History'
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
        register_post_type( 'history', $args );
        flush_rewrite_rules();
    }

/**
 * GET FEATURED IMAGE
 */
function get_featured_image_history($post_ID) {  
    $post_thumbnail_id = get_post_thumbnail_id($post_ID);  
    if ($post_thumbnail_id) {
        $post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, 'featured_preview');  
        return $post_thumbnail_img[0];  
    }  
}
	
/**
 * Show Column Content for Custom Post Type Fortman Team
 */
function columns_content_history($column_name, $post_ID) {
    if ( $column_name == 'history_image' ) {
        $post_featured_image = get_featured_image($post_ID);
       
        if ( $post_featured_image ) {
            echo '<div style="background:url('.$post_featured_image.'); height: 64px; width: 64px; background-position: 50% 50%; background-size: cover"></div>';            
        } else {
            echo 'No preview available';
        }
    }
}
add_action('manage_history_posts_custom_column', 'columns_content_history', 10, 2); 
 
 function history_post_columns( $talents_columns ) {
    $columns = array (
        'cb' => '<input type="checkbox" />',
        'title' => __( 'History Year' ),
        'date' => __( 'Date' )
    );
    return $columns;
}
add_filter( 'manage_history_posts_columns', 'history_post_columns' );

function change_default_title( $title ){
     $screen = get_current_screen();
     if  ( $screen->post_type == 'history' ) {
          return 'Enter Year Here';
     }
}
add_filter( 'enter_title_here', 'change_default_title' );