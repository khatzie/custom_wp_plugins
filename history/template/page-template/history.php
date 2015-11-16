<?php
/**
 * Template Name: History Page Template with Sidebar
 *
 * Description: Boilerstrap loves the no-sidebar look as much as
 * you do. Use this page template to remove the sidebar from any page.
 *
 * Tip: to remove the sidebar from all posts and pages simply remove
 * any active widgets from the Main Sidebar area, and the sidebar will
 * disappear everywhere.
 *
 * @package WordPress
 * @subpackage Boilerstrap
 * @since Boilerstrap 1.0
 */

get_header(); ?>
<div class="row-fluid">
	<div class="span12">
		<div class="row-fluid">
			<div class="span9 pull-right">
				<div id="primary" class="site-content">
					<div id="content" role="main">
						<?php while ( have_posts() ) : the_post(); ?>
							<?php get_template_part( 'content', 'history' ); ?>
						<?php endwhile; // end of the loop. ?>

					</div><!-- #content -->
				</div><!-- #primary -->
			</div>
			
			<div class="span3 pull-left fit">
				<div class="sidebar">
					<?php get_sidebar(); ?>
				</div>
				<div class="sidebar">
					<?php get_sidebar('contactus'); ?>
				</div>
				<div class="sidebar" style="clear:both">
					<?php get_sidebar('careerswidget'); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>