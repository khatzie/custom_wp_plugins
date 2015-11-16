<?php
/*
Plugin Name: WE Boracay Partners
Description: Declares a plugin that will create a custom post type displaying partners.
Version: 1.0
Author: Katherine Petalio
*/

add_action( 'init', 'partners' );

    function partners() {
        $labels = array(
            'name'               => _x( 'Partners', 'post type general name' ),
            'singular_name'      => _x( 'Partners', 'post type singular name' ),
            'add_new'            => __( 'Add New' ),
            'add_new_item'       => __( 'Add New Partners' ),
            'edit_item'          => __( 'Edit Partners' ),
            'new_item'           => __( 'New Partners' ),
            'all_items'          => __( 'All Partners' ),
            'view_item'          => __( 'View Partners' ),
            'search_items'       => __( 'Search Partners' ),
            'not_found'          => __( 'No partners found.' ),
            'not_found_in_trash' => __( 'No partners found in the Trash.' ), 
            'parent_item_colon'  => '',
            'menu_name'          => 'Partners'
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
        register_post_type( 'partners', $args );
        flush_rewrite_rules();
    }

/**
 * GET FEATURED IMAGE
 */
function get_featured_image_partners($post_ID) {  
    $post_thumbnail_id = get_post_thumbnail_id($post_ID);  
    if ($post_thumbnail_id) {
        $post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, 'featured_preview');  
        return $post_thumbnail_img[0];  
    }  
}
	
/**
 * Show Column Content for Custom Post Type Fortman Team
 */
function columns_content_partners($column_name, $post_ID) {
    if ( $column_name == 'partners_image' ) {
        $post_featured_image = get_featured_image($post_ID);
       
        if ( $post_featured_image ) {
            echo '<div style="background:url('.$post_featured_image.'); height: 64px; width: 64px; background-position: 50% 50%; background-size: cover"></div>';            
        } else {
            echo 'No preview available';
        }
    }
}
add_action('manage_partners_posts_custom_column', 'columns_content_partners', 10, 2); 
 
 function partners_post_columns( $talents_columns ) {
    $columns = array (
        'cb' => '<input type="checkbox" />',
        'partners_image' => __( 'Featured Image' ),
        'title' => __( 'Partners Name' ),
        'date' => __( 'Date' )
    );
    return $columns;
}
add_filter( 'manage_partners_posts_columns', 'partners_post_columns' );
?>