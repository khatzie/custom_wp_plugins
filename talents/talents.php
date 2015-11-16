<?php
/*
Plugin Name: Flair Bureau Talents
Description: Declares a plugin that will create a custom post type displaying Talents.
Version: 1.0
Author: Katherine Petalio
*/

add_action( 'init', 'talents' );

    function talents() {
        $labels = array(
            'name'               => _x( 'Talents', 'post type general name' ),
            'singular_name'      => _x( 'Talents', 'post type singular name' ),
            'add_new'            => __( 'Add New' ),
            'add_new_item'       => __( 'Add New Talent' ),
            'edit_item'          => __( 'Edit Talent' ),
            'new_item'           => __( 'New Talent' ),
            'all_items'          => __( 'All Talents' ),
            'view_item'          => __( 'View Talents' ),
            'search_items'       => __( 'Search Talents' ),
            'not_found'          => __( 'No talenta found.' ),
            'not_found_in_trash' => __( 'No talents found in the Trash.' ), 
            'parent_item_colon'  => '',
            'menu_name'          => 'Talents'
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
        register_post_type( 'talents', $args );
        flush_rewrite_rules();
    }
	
	add_action( 'init', 'talents_taxonomies', 1 );
    
	function talents_taxonomies() {
		$labels = array(
			'name'              => _x( 'Categories', 'taxonomy general name' ),
			'singular_name'     => _x( 'Category', 'taxonomy singular name' ),
			'search_items'      => __( 'Search Categories' ),
			'all_items'         => __( 'All Categories' ),
			'edit_item'         => __( 'Edit Category' ), 
			'update_item'       => __( 'Update Category' ),
			'add_new_item'      => __( 'Add New Category' ),
			'new_item_name'     => __( 'New Category' ),
			'menu_name'         => __( 'Categories' ),
		);
		$args = array(
			'labels' => $labels,
			'hierarchical' => true,
			'show_ui' => true,
			'show_in_nav_menus' => false,
		);
		register_taxonomy( 'talents_category', 'talents', $args );
	}
	
	add_action( 'admin_init', 'add_post_gallery_so_14445904' );
	add_action( 'admin_head-post.php', 'print_scripts_so_14445904' );
	add_action( 'admin_head-post-new.php', 'print_scripts_so_14445904' );
	add_action( 'save_post', 'update_post_gallery_so_14445904', 10, 2 );

	/**
	 * Add custom Meta Box to Posts post type
	 */
	function add_post_gallery_so_14445904() 
	{
	    add_meta_box(
	        'post_gallery',
	        'Portfolio Images',
	        'post_gallery_options_so_14445904',
	        'talents',
	        'normal',
	        'core'
	    );
	}

	/**
	 * Print the Meta Box content
	 */
	function post_gallery_options_so_14445904() 
	{
	    global $post;
	    $gallery_data = get_post_meta( $post->ID, 'gallery_data', true );

	    // Use nonce for verification
	    wp_nonce_field( plugin_basename( __FILE__ ), 'noncename_so_14445904' );
	?>

	<div id="dynamic_form">

	    <div id="field_wrap">
	    <?php 
	    if ( isset( $gallery_data['image_url'] ) ) 
	    {
	        for( $i = 0; $i < count( $gallery_data['image_url'] ); $i++ ) 
	        {
	        ?>

	        <div class="field_row">

	          <div class="field_left">
	            <div class="form_field">
	              <label>Image URL</label>
	              <input type="text"
	                     class="meta_image_url"
	                     name="gallery[image_url][]"
	                     value="<?php esc_html_e( $gallery_data['image_url'][$i] ); ?>"
	              />
	            </div>
	            <div class="form_field">
	              <label>Description</label>
	              <input type="text"
	                     class="meta_image_desc"
	                     name="gallery[image_desc][]"
	                     value="<?php esc_html_e( $gallery_data['image_desc'][$i] ); ?>"
	              />
	            </div>
	          </div>

	          <div class="field_right image_wrap">
	            <img src="<?php esc_html_e( $gallery_data['image_url'][$i] ); ?>" height="48" width="48" />
	          </div>

	          <div class="field_right">
	            <input class="button" type="button" value="Choose File" onclick="add_image(this)" /><br />
	            <input class="button" type="button" value="Remove" onclick="remove_field(this)" />
	          </div>

	          <div class="clear" /></div> 
	        </div>
	        <?php
	        } // endif
	    } // endforeach
	    ?>
	    </div>

	    <div style="display:none" id="master-row">
	    <div class="field_row">
	        <div class="field_left">
	            <div class="form_field">
	                <label>Image URL</label>
	                <input class="meta_image_url" value="" type="text" name="gallery[image_url][]" />
	            </div>
	            <div class="form_field">
	                <label>Description</label>
	                <input class="meta_image_desc" value="" type="text" name="gallery[image_desc][]" />
	            </div>
	        </div>
	        <div class="field_right image_wrap">
	        </div> 
	        <div class="field_right"> 
	            <input type="button" class="button" value="Choose File" onclick="add_image(this)" />
	            <br />
	            <input class="button" type="button" value="Remove" onclick="remove_field(this)" /> 
	        </div>
	        <div class="clear"></div>
	    </div>
	    </div>

	    <div id="add_field_row">
	      <input class="button" type="button" value="Add Image" onclick="add_field_row();" />
	    </div>

	</div>

	  <?php
	}

	/**
	 * Print styles and scripts
	 */
	function print_scripts_so_14445904()
	{
	    // Check for correct post_type
	    global $post;
	    if( 'talents' != $post->post_type )
	        return;
	    ?>  
	    <style type="text/css">
	      .field_left {
	        float:left;
	      }

	      .field_right {
	        float:left;
	        margin-left:10px;
	      }

	      .clear {
	        clear:both;
	      }

	      #dynamic_form {
	        width:580px;
	      }

	      #dynamic_form input[type=text] {
	        width:300px;
	      }

	      #dynamic_form .field_row {
	        border:1px solid #999;
	        margin-bottom:10px;
	        padding:10px;
	      }

	      #dynamic_form label {
	        padding:0 6px;
	      }
	    </style>

	    <script type="text/javascript">
	        function add_image(obj) {
	            var parent=jQuery(obj).parent().parent('div.field_row');
	            var inputField = jQuery(parent).find("input.meta_image_url");

	            tb_show('', 'media-upload.php?TB_iframe=true');

	            window.send_to_editor = function(html) {
	                var url = jQuery(html).find('img').attr('src');
	                inputField.val(url);
	                jQuery(parent)
	                .find("div.image_wrap")
	                .html('<img src="'+url+'" height="48" width="48" />');

	                // inputField.closest('p').prev('.awdMetaImage').html('<img height=120 width=120 src="'+url+'"/><p>URL: '+ url + '</p>'); 

	                tb_remove();
	            };

	            return false;  
	        }

	        function remove_field(obj) {
	            var parent=jQuery(obj).parent().parent();
	            //console.log(parent)
	            parent.remove();
	        }

	        function add_field_row() {
	            var row = jQuery('#master-row').html();
	            jQuery(row).appendTo('#field_wrap');
	        }
	    </script>
	    <?php
	}

	/**
	 * Save post action, process fields
	 */
	function update_post_gallery_so_14445904( $post_id, $post_object ) 
	{
	    // Doing revision, exit earlier **can be removed**
	    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )  
	        return;

	    // Doing revision, exit earlier
	    if ( 'revision' == $post_object->post_type )
	        return;

	    // Verify authenticity
	    if ( !wp_verify_nonce( $_POST['noncename_so_14445904'], plugin_basename( __FILE__ ) ) )
	        return;

	    // Correct post type
	    if ( 'talents' != $_POST['post_type'] ) 
	        return;

	    if ( $_POST['gallery'] ) 
	    {
	        // Build array for saving post meta
	        $gallery_data = array();
	        for ($i = 0; $i < count( $_POST['gallery']['image_url'] ); $i++ ) 
	        {
	            if ( '' != $_POST['gallery']['image_url'][ $i ] ) 
	            {
	                $gallery_data['image_url'][]  = $_POST['gallery']['image_url'][ $i ];
	                $gallery_data['image_desc'][] = $_POST['gallery']['image_desc'][ $i ];
	            }
	        }

	        if ( $gallery_data ) 
	            update_post_meta( $post_id, 'gallery_data', $gallery_data );
	        else 
	            delete_post_meta( $post_id, 'gallery_data' );
	    } 
	    // Nothing received, all fields are empty, delete option
	    else 
	    {
	        delete_post_meta( $post_id, 'gallery_data' );
	    }
	}
	
/**
 * GET FEATURED IMAGE
 */
function get_featured_image($post_ID) {  
    $post_thumbnail_id = get_post_thumbnail_id($post_ID);  
    if ($post_thumbnail_id) {
        $post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, 'featured_preview');  
        return $post_thumbnail_img[0];  
    }  
}
	
/**
 * Show Column Content for Custom Post Type Fortman Team
 */
function columns_content_talents($column_name, $post_ID) {
    if ( $column_name == 'talent_image' ) {
        $post_featured_image = get_featured_image($post_ID);
       
        if ( $post_featured_image ) {
            echo '<div style="background:url('.$post_featured_image.'); height: 64px; width: 64px; background-position: 50% 50%; background-size: cover"></div>';            
        } else {
            echo 'No preview available';
        }
    } else if ( $column_name == 'talent-name' ) {
        $post_talent_name = get_field('talent_name', $post_ID);
        
        if ( $post_talent_name ) {
            echo $post_talent_name;
        } else {
            echo 'n/a';
        }
    } else if ( $column_name == 'expertise' ) {
        $expertise = get_field('expertise', $post_ID);
        
        if ( $expertise ) {
            echo $expertise;
        } else {
            echo 'n/a';
        }
    }
}
add_action('manage_talents_posts_custom_column', 'columns_content_talents', 10, 2); 
 
 function talents_post_columns( $talents_columns ) {
    $columns = array (
        'cb' => '<input type="checkbox" />',
        'talent_image' => __( 'Featured Image' ),
        'title' => __( 'Screen Name' ),
        'talent-name' => __( 'Talent Name' ),
        'taxonomy-talents_category' => __( 'Categories' ),
        //'games_and_sports' => __( 'Fields of Expertise' ),
        'date' => __( 'Date' )
    );
    return $columns;
}
add_filter( 'manage_talents_posts_columns', 'talents_post_columns' );
?>