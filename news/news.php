<?php
/*
Plugin Name: Chikyu No Arikikata News
Description: Declares a plugin that will create a custom post type displaying News.
Version: 1.0
Author: Katherine Petalio
*/

	add_action( 'init', 'news' );

    function news() {
        $labels = array(
            'name'               => _x( 'News', 'post type general name' ),
            'singular_name'      => _x( 'News', 'post type singular name' ),
            'add_new'            => __( 'Add New' ),
            'add_new_item'       => __( 'Add New News' ),
            'edit_item'          => __( 'Edit News' ),
            'new_item'           => __( 'New News' ),
            'all_items'          => __( 'All News' ),
            'view_item'          => __( 'View News' ),
            'search_items'       => __( 'Search News' ),
            'not_found'          => __( 'No news found.' ),
            'not_found_in_trash' => __( 'No news found in the Trash.' ), 
            'parent_item_colon'  => '',
            'menu_name'          => 'News'
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
        register_post_type( 'news', $args );
        flush_rewrite_rules();
    }
?>
