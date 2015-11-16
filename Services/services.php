<?php
/*
Plugin Name: WE Boracay Services
Description: Declares a plugin that will create a custom post type displaying services.
Version: 1.0
Author: Katherine Petalio
*/

add_action( 'init', 'services' );

    function services() {
        $labels = array(
            'name'               => _x( 'Services', 'post type general name' ),
            'singular_name'      => _x( 'Services', 'post type singular name' ),
            'add_new'            => __( 'Add New' ),
            'add_new_item'       => __( 'Add New Services' ),
            'edit_item'          => __( 'Edit Services' ),
            'new_item'           => __( 'New Services' ),
            'all_items'          => __( 'All Services' ),
            'view_item'          => __( 'View Services' ),
            'search_items'       => __( 'Search Services' ),
            'not_found'          => __( 'No services found.' ),
            'not_found_in_trash' => __( 'No services found in the Trash.' ), 
            'parent_item_colon'  => '',
            'menu_name'          => 'Services'
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
        register_post_type( 'services', $args );
        flush_rewrite_rules();
    }

/**
 * GET FEATURED IMAGE
 */
function get_featured_image_services($post_ID) {  
    $post_thumbnail_id = get_post_thumbnail_id($post_ID);  
    if ($post_thumbnail_id) {
        $post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, 'featured_preview');  
        return $post_thumbnail_img[0];  
    }  
}
	
/**
 * Show Column Content for Custom Post Type Fortman Team
 */
function columns_content_services($column_name, $post_ID) {
    if ( $column_name == 'services_image' ) {
        $post_featured_image = get_featured_image($post_ID);
       
        if ( $post_featured_image ) {
            echo '<div style="background:url('.$post_featured_image.'); height: 64px; width: 64px; background-position: 50% 50%; background-size: cover"></div>';            
        } else {
            echo 'No preview available';
        }
    }
}
add_action('manage_services_posts_custom_column', 'columns_content_services', 10, 2); 
 
 function services_post_columns( $talents_columns ) {
    $columns = array (
        'cb' => '<input type="checkbox" />',
        'title' => __( 'Services Name' ),
        'date' => __( 'Date' )
    );
    return $columns;
}
add_filter( 'manage_services_posts_columns', 'services_post_columns' );
?>