<?php
/**
 * Template for Talents Taxonomy
 */

get_header(); ?>
<?php
$post = get_post(get_the_ID()); 
$content = strip_tags(apply_filters('the_content', $post->post_content)); 
$term_id = get_queried_object()->term_id;
$taxonomy = "talents_category";
$term = get_term( $term_id, $taxonomy );
$name = $term->name;
$current_link = get_permalink(get_the_ID());

$get_header = get_field('header_banner_image','talents_category_' . $term->term_id);

if ($get_header != '') {
	$style = ' style= "background-image:url('.$get_header.')"';
}
?>
  <section class="section-single-4"<?php echo $style; ?>>
    <div class="w-container">
      <div class="portfolio-tiitle in-left single-four" data-ix="fade-out-left">Talents</div>
      <div class="subtext-portfolio four_single" data-ix="fade-out-left-2"><?php echo $name; ?> category</div>
    </div>
  </section>
	<div class="section-single-four"><!-- begin gallery -->
		<div class="w-container container-single">
		
		  <div class="w-row row-gall">
			<?php
			if ( have_posts() ) : 
			?>
			<?php $counter = 1; ?>
			<?php while ( have_posts() ) : the_post(); ?>
			<?php
				$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
				  if ( has_post_thumbnail() ) :
					$url = $thumb['0'];
				  else :
					$url = get_template_directory_uri() . '/images/gallery1.jpg';
				  endif;
			  ?>
				<div class="w-col w-col-4 column-gallery" data-ix="pop-up-<?php echo $counter; // Max 25 animations ?>" style="margin-bottom: 10px">
				  <a class="w-inline-block talents-gallery" href="<?php the_permalink(); ?>" style="background-image:url(<?php echo $url ?>)">
					<div class="galler-overlay">
						<div class="text-gallery" style="font-size: 16px; text-transform: uppercase">
							<strong>
							<?php
							if(get_the_title() != '') {
								echo get_the_title();
							} else {
								echo get_field('talent_name');
							}
							?>
							</strong>
						</div>
						<div class="text-gallery" style="font-size: 12px; top: 60%">
						<?php 
							$expertise = str_replace(', ',',',get_field('expertise'));
							echo str_replace(',','&nbsp;-&nbsp;',$expertise); 
						?>
						</div>
					</div>
				  </a>
				</div>
			<?php $counter++; ?>
			<?php endwhile; // end of the loop.
			else :
				echo '<p>No talents to display for this category.</p>';
			endif;
			wp_reset_query();
			?>
		  </div>
		  
		</div>
		
		<!-- Self footer area -->

		  <footer class="section">
			<div class="footer" id="footer">
			  <div class="w-container">
				<div class="social-div in-footer">
				  <a class="w-inline-block social fa fa-twitter" href="#"></a>
				  <a class="w-inline-block social fa fa-facebook" href="#"></a>
				  <a class="w-inline-block social fa fa-flickr" href="#"></a>
				</div>
				<div class="footer_copyright"><span><?php echo get_bloginfo('name'); ?></span>&nbsp;&copy;&nbsp;copyright <?php echo date('Y'); ?></div>
			  </div>
			</div>
		  </footer><!-- end footer -->
		
	</div><!-- end gallery -->

<?php get_footer(); ?>