<?php
/**
 * Plugin Name: Featured Works
 * Description: A plugin displaying my Featured Works
 * Version: 0.1
 * Author: Katherine Petalio
 * Author URI: kath
*/


add_action('init','featured_works');

function featured_works(){
	$labels = array(
            'name'               => _x( 'Featured Works', 'post type general name' ),
            'singular_name'      => _x( 'Featured Works', 'post type singular name' ),
            'add_new'            => __( 'Add New' ),
            'add_new_item'       => __( 'Add New Featured Works' ),
            'edit_item'          => __( 'Edit Featured Works' ),
            'new_item'           => __( 'New Featured Works' ),
            'all_items'          => __( 'All Featured Works' ),
            'view_item'          => __( 'View Featured Works' ),
            'search_items'       => __( 'Search Featured Works' ),
            'not_found'          => __( 'No works found.' ),
            'not_found_in_trash' => __( 'No works found in the Trash.' ), 
            'parent_item_colon'  => '',
            'menu_name'          => 'Featured Works'
        );
        $args = array(
            'labels'        => $labels,
            'public' => true,
            'publicly_queryable' => true,
            'has_archive' => false,
            'query_var' => true,
            'can_export' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_nav_menus' => false,
            'capability_type' => 'post',
            'exclude_from_search' => false,
            'supports'      => array( 'title', 'editor', 'thumbnail' ),
            'taxonomies' => array('featured_works_taxonomies', 'category', 'post_tag'),
            'hierarchical' => true
        );
        register_post_type( 'featured_works', $args );
        flush_rewrite_rules();
    }
	
add_action('init', 'my_custom_init');
function my_custom_init() {
		add_post_type_support( 'featured_works', 'excerpt' );
}

add_action( 'do_meta_boxes', 'featured_works_box' );

function featured_works_box() {
	$works_image_title = __( 'Featured Image' );

	remove_meta_box( 'postimagediv', 'featured_works', 'side' );
	
	add_meta_box( 'postimagediv', $works_image_title, 'post_thumbnail_meta_box', 'featured_works', 'side');

}

// GET FEATURED IMAGE  
function get_works_image($post_ID) {  
	$post_thumbnail_id = get_post_thumbnail_id($post_ID);  
	if ($post_thumbnail_id) {  
		$post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, 'featured_preview');  
		return $post_thumbnail_img[0];  
	}  
}

// CREATE TWO FUNCTIONS TO HANDLE THE COLUMN  
function ST4_columns_head_only_works($defaults) {
	$defaults['works_image'] = 'Featured Image';
	$defaults['tags'] = 'Tags';
	return $defaults;  
}  

function ST4_columns_content_only_works($column_name, $post_ID) {  
	if ($column_name == 'works_image') {  
		$post_featured_image = get_works_image($post_ID);  
		if ($post_featured_image) {  
			echo '<img src="'.$post_featured_image.'" height="100" width="100" />';              
		}
	}
}
add_filter('manage_featured_works_posts_columns', 'ST4_columns_head_only_works');  
add_action('manage_featured_works_posts_custom_column', 'ST4_columns_content_only_works', 10, 4);  
function works_post_columns( $works_columns ) {
        $works_columns = array (
            'cb' => '<input type="checkbox" />',   
            'title' => __( 'Project Name' ),
			'category' => __( 'Category'),
			'tags' => __( 'Tags' ),
			'works_image' => __( 'Featured Image' ),
			
        );
        return $works_columns;
    }
add_filter( 'manage_featured_works_posts_columns', 'works_post_columns' );


?>