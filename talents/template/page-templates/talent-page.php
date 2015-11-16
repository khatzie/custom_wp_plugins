<?php
/**
 * Template Name: Talent Page Template
 *
 * Description: A page template that provides a key component of WordPress as a CMS
 * by meeting the need for a carefully crafted introductory page. The front page template
 * in Twenty Twelve consists of a page content area for adding text, images, video --
 * anything you'd like -- followed by front-page-only widgets in one or two columns.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>
<?php
$post = get_post(get_the_ID()); 
$content = strip_tags(apply_filters('the_content', $post->post_content)); 

if (has_post_thumbnail( $post->ID ) ):
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
	$style = ' style= "background-image:url('.$image[0].')"';
endif;
?>
  <section class="section-single-4"<?php echo $style; ?>>
    <div class="w-container">
      <div class="portfolio-tiitle in-left single-four" data-ix="fade-out-left"><?php the_title(); ?></div>
      <div class="subtext-portfolio four_single" data-ix="fade-out-left-2"><?php echo $content; ?></div>
    </div>
  </section>
	<div class="section-single-four"><!-- begin gallery -->
		<div class="w-container container-single">
		
		  <div class="w-row row-gall">
			<?php
			$args = array(
				'post_type' => 'talents',
				'post_status' => 'publish',
				'orderby'	=> 'title',
				'order' => 'ASC'
			);
			$the_query = new WP_Query( $args );
			
			if ( $the_query->have_posts() ) :
			?>
			<?php $counter = 1; ?>
			<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
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
				  <a class="w-inline-block social fa fa-twitter" href="https://twitter.com/flairbureau"></a>
				  <a class="w-inline-block social fa fa-facebook" href="https://www.facebook.com/flairbureau"></a>
				  <a class="w-inline-block social fa fa-flickr" href="https://www.flickr.com/photos/127070126@N04/"></a>
				  <a class="w-inline-block social fa fa-tumblr" href="http://flairtalentbureau.tumblr.com/"></a>
				  <a class="w-inline-block social fa fa-youtube" href="https://www.youtube.com/user/flairbureau"></a>
				</div>
				<div class="footer_copyright"><span><?php echo get_bloginfo('name'); ?></span>&nbsp;&copy;&nbsp;copyright <?php echo date('Y'); ?></div>
			  </div>
			</div>
		  </footer><!-- end footer -->
		
	</div><!-- end gallery -->

<?php get_footer(); ?>