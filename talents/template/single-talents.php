<?php
/**
 * The Template for displaying all single talents
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

	<div class="section-single-2">
		<div class="w-container">

			<?php while ( have_posts() ) : the_post(); ?>
			
				<div class="portfolio-tiitle in-left" style="color: #fff">Talents&nbsp;<i class="fa fa-chevron-right" style="color: rgb(255, 20, 147); font-size: 20px; margin-left: 5px; margin-right: 5px;"></i>&nbsp;Profile</div>
				<div class="subtext-portfolio single-only">
					<?php
					if(get_the_title() != '') {
						echo get_the_title();
					} else {
						echo get_field('talent_name');
					}
					?>
				</div>
				<div class="portfolio-line"></div>

				<?php get_template_part( 'content', 'talent' ); ?>

			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
		
		<?php
		$talents_category = return_post_taxonomies('talents_category');
		global $post;
		$args = array(
			'post_type'=> 'talents',
			'status' => 'publish',
			'post__not_in' => array($post->ID),
			'order'    => 'ASC',
			'tax_query' => array(
				array(
					'taxonomy' => 'talents_category',
					'field' => 'slug',
					'terms' => $talents_category
				)
			)
		);
		$wp_query = new WP_Query($args);
		if ( have_posts() ) : ?>
			<div class="logo-section single">
			  <div class="w-container">
				<div class="small-tittle more-talents-label"><i class="fa fa-chevron-circle-right" style="color: #ff1493; margin-right: 5px"></i>more talents from category by <span class="bold" style="font-weight: 700"><?php bloginfo('name'); ?></span></div>
				<div class="w-slider logo-slider" data-animation="cross" data-duration="500" data-delay="5000" data-autoplay="1" data-infinite="1">
				  <div class="w-slider-mask">
					<div class="w-slide">
					  <div class="w-row logo-row">
						<?php while ( have_posts() ) : the_post(); ?>
							<div class="w-col w-col-3">
							  <?php
							  $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
							  
							  if ( has_post_thumbnail() ) :
								$url = $thumb['0'];
							  else :
								$url = get_template_directory_uri() . '/images/mohula.png';
							  endif;
							  ?>
								<a class="logo<?php echo $post->ID; ?> single-talents-gallery" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"style="background-image:url(<?php echo $url; ?>)"></a>
							</div>
						<?php endwhile; ?>
					  </div>
					</div>
				  </div>
				</div>
			  </div>
			</div>
		<?php
		endif;
		wp_reset_query();
		?>
	</div><!-- #primary -->

<?php get_footer(); ?>