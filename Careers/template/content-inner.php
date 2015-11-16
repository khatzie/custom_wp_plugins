<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package WordPress
 * @subpackage Boilerstrap
 * @since Boilerstrap 1.0
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<h1 class="entry-title"><?php the_title(); ?></h1>
		</header>
		<div class="entry-content">
			<?php the_content(); ?>
			<?php
				if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
					$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
				?>
					<img src="<?php echo $large_image_url[0]; ?>" alt="">
				<?php
				} 
			?>
			
			<?php
				$slug = $post->post_name ;
				if($slug == 'careers'):
					echo "<hr>";
					$args = array(
								'post_type' => 'careers',
								'post_status' => 'publish',
								'posts_per_page' => -1,
								'post_parent' => $parents[0],
								'order' => 'DESC'
							);
					$careers = new WP_Query( $args );
					if ( $careers->have_posts() ) :
					while ( $careers->have_posts() ) : $careers->the_post();
					$category = get_the_category(); 
					$id = get_the_ID();
					?>
					<div class="careers">
						<div class="career-title"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></div>
						<div class="career-department"><?php echo get_the_term_list($id, 'departments'); ?> </div>
						<div class="career-date">Closing Date: <em><?php the_field('closing_date'); ?> </em> </div>
						<div class="career-contents"><?php the_excerpt(); ?></div>
						<div><a class="btn btn-primary more" href="<?php echo get_permalink(); ?>"">Read More</a></div>
					</div>
					<hr>
					<?php
					endwhile;
					endif;
					wp_reset_query();
				endif;
			?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'boilerstrap' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
		<footer class="entry-meta">
			<?php edit_post_link( __( 'Edit', 'boilerstrap' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-meta -->
	</article><!-- #post -->
