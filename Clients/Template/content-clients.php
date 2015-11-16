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
			<br/> <br/>
			<div class="row-fluid">
			<?php
				$args = array(
					'post_type' => 'clients',
					'post_status' => 'publish',
					'posts_per_page' => -1,
					'order' => 'ASC'
				);
				$the_query = new WP_Query( $args );
 
				// The Loop
				$index = 0;
				if ( $the_query->have_posts() ) :
					while ( $the_query->have_posts() ) : $the_query->the_post();
					
					if($index%4 == 0){
						echo '</div>';
						echo '<div class="row-fluid">';
						
					}
				?>
					
					<div class="span3">
						<div class="clients-logo">
						<?php
						if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
							$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
						?>
								<a href="<?php the_field('url'); ?>"><img class="img-circle img-responsive" src="<?php echo $large_image_url[0]; ?>" alt="<?php the_title(); ?>"></a>
						<?php
						} 
						?>
						</div>
					</div>

				<?php
					$index++;
				endwhile;
			endif;
			?>
		</div><!-- .entry-content -->
		<footer class="entry-meta">
			<?php // edit_post_link( __( 'Edit', 'boilerstrap' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-meta -->
	</article><!-- #post -->
