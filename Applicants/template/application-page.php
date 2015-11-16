<?php
/**
 * Template Name: Application Page Template
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
	<div class="section-single-2" style="padding-top: 0">
		<div class="w-container" role="main">
			<div class="w-row row">
				<div class="w-col w-col-8">
					<p>Please fill up all the necessary fields. Items that are marked with <span class="magenta">*</span> is required.</p>
					<br>
					<br>
					<div id="page-<?php the_ID(); ?>" class="app-form-wrapper">
						<?php  echo do_shortcode('[contact-form-7 id="56" title="Application"]'); ?>
					</div>
					
				</div>
				<?php get_sidebar(); ?>
			</div>
		</div><!-- #content -->
	</div><!-- #primary -->


<?php get_footer(); ?>
