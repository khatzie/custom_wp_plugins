<?php
/**
 * The default template for displaying content talents
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <div class="w-row row">
	  <?php
	  	$images = get_post_meta(get_the_ID(), 'gallery_data', false);	
		$count = 0;
		foreach ($images as $image) {
		    $count = count($image['image_url']);
		}
	  ?>
		<!-- Image Slider Here -->
        <div class="w-col w-col-8">
          <div class="w-slider single-slider" data-animation="over" data-duration="500" data-infinite="1" data-hide-arrows="1"><!-- slider begin -->
            <div class="w-slider-mask w-con-slider">
				<?php
				if ($count == 0) {
					if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
						$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
						$featured_image_url = $large_image_url[0];
						$alt = '';
					} else {
						$featured_image_url = get_template_directory_uri().'/images/photo8.jpg';
						$alt = 'No image to display';
					}
				?>
						<div class="w-slide slide-1"><!-- slide 1 -->
							<img src="<?php echo $featured_image_url; ?>" alt="<?php echo $alt; ?>">
						</div>
				<?php
				} else {
					for($i = 0 ; $i < $count; $i++) {
				?>
						<div class="w-slide slide-1"><!-- slide 1 -->
							<?php 
							if($image['image_desc'][$i] != "") {
								echo '<div class="slider-text">'.$image['image_desc'][$i].'</div>'; // Caption
							}
							?>
							<img src="<?php echo $image['image_url'][$i]; ?>" alt="<?php echo $image['image_desc'][$i]; ?>">
						</div>
				<?php 
					}
				}
				?>
            </div>
            <div class="w-slider-arrow-left vertical">
              <div class="w-icon-slider-left arrow-slider"></div>
            </div>
            <div class="w-slider-arrow-right vertical">
              <div class="w-icon-slider-right arrow-slider"></div>
            </div>
            <div class="w-slider-nav w-round slide-nav"></div>
          </div>
          <p class="left p-margin left-white" style="margin-bottom: 0"><?php echo get_the_content(); ?></p>
        </div>
		
		
		<!-- About Talent Here -->
        <div class="w-col w-col-4 column-iphone">
          <div class="small-tittle small-tittle-white"><i class="fa fa-star" style="color: #ff1493; margin-right: 5px"></i>Personal Info</div>
          <p class="left p-margin left-white"><span class="darker m-right">Name:</span> <?php echo get_field('talent_name'); ?></p>
          <!--<div class="portfolio-line details"></div>
          <p class="left p-margin left-white"><span class="darker m-right">Birthdate:</span>&nbsp;<?php echo date('d F, Y', strtotime(get_field('birthdate'))); ?></p>-->
          <div class="portfolio-line details"></div>
          <p class="left p-margin left-white"><span class="darker m-right">Fields of Expertise:</span> <?php the_field('expertise'); ?></p>

		  <?php if (get_field('languages') != '') { ?>
		  <div class="portfolio-line details"></div>
          <p class="left p-margin left-white"><span class="darker m-right">Languages:</span> <?php the_field('languages'); ?></p>
		  <?php } ?>
		  
		  <?php if (get_field('height') != '') { ?>
		  <div class="portfolio-line details"></div>
          <p class="left p-margin left-white"><span class="darker m-right">Height:</span> <?php the_field('height'); ?></p>
		  <?php } ?>

		  <?php if (get_field('vital_statistics') != '') { ?>
		  <div class="portfolio-line details"></div>
          <p class="left p-margin left-white"><span class="darker m-right">Vital Statistics:</span> <?php the_field('vital_statistics'); ?></p>
		  <?php } ?>
		  
		  <?php if (get_field('rtw_size') != '') { ?>
		  <div class="portfolio-line details"></div>
		  <p class="left p-margin left-white"><span class="darker m-right">RTW:</span> <?php the_field('rtw_size'); ?></p>
		  <?php } ?>
		  
		  <?php if (get_field('shoe_size') != '') { ?>
		  <div class="portfolio-line details"></div>		  
		  <p class="left p-margin left-white"><span class="darker m-right">Shoes:</span> <?php the_field('shoe_size'); ?></p>
		  <?php } ?>
		  
		  <?php if (get_field('skin_complexion') != '') { ?>
		  <div class="portfolio-line details"></div>		  
		  <p class="left p-margin left-white"><span class="darker m-right">Skin Complexion:</span> <?php the_field('skin_complexion'); ?></p>
	      <?php } ?>
		  
		  <?php if (get_field('hair_color') != '') { ?>
		  <div class="portfolio-line details"></div>		  
		  <p class="left p-margin left-white"><span class="darker m-right">Hair:</span> <?php the_field('hair_color'); ?></p>
		  <?php } ?>
		  
		  <?php if (get_field('eye_color') != '') { ?>
		  <div class="portfolio-line details"></div>		  
		  <p class="left p-margin left-white"><span class="darker m-right">Eyes:</span> <?php the_field('eye_color'); ?></p>
		  <?php } ?>
		  
		  <?php if (get_field('games_and_sports') != '') { ?>
		  <div class="portfolio-line details"></div>		  
		  <p class="left p-margin left-white"><span class="darker m-right">Games and Sports:</span> <?php the_field('games_and_sports'); ?></p>
		  <?php } ?>
		  
		  <?php if (get_field('musical_instrument') != '') { ?>
		  <div class="portfolio-line details"></div>		  
		  <p class="left p-margin left-white"><span class="darker m-right">Musical Instruments:</span> <?php the_field('musical_instrument'); ?></p>
		  <?php } ?>
		  
		  <?php if (get_field('others') != '') { ?>
		  <div class="portfolio-line details"></div>		  
		  <p class="left p-margin left-white"><span class="darker m-right">Others:</span> <?php the_field('others'); ?></p>
		  <?php } ?>
		  
          <div class="small-tittle small-tittle-white"><i class="fa fa-bookmark" style="color: #ff1493; margin-right: 5px"></i>Talent Category</div>
          <p class="left talent-taxonomies">
		  <?php 
			if (get_the_terms($post->ID, 'talents_category')) :
				echo get_the_term_list($post->ID, 'talents_category','',', ','');
			else :
				echo 'Uncategorized';
			endif;
		  ?>
		  </p>
		  
		  <?php if (get_field('featured_videos') != '') { ?>
         <div class="small-tittle small-tittle-white"><i class="fa fa-youtube-play" style="color: #ff1493; margin-right: 5px"></i> Featured Videos</div>
		 <?php ob_start(); echo get_field('featured_videos'); ?>
		 <?php } ?>

		  
		  <!-- Social 
          <div class="share">
            <div class="w-widget w-widget-twitter">
              <iframe src="https://platform.twitter.com/widgets/tweet_button.html#url=<?php the_permalink(); ?>&amp;counturl=<?php the_permalink(); ?>&amp;text=Check%20out%20this%20talent&amp;count=horizontal&amp;size=m&amp;dnt=true" scrolling="no" frameborder="0" allowtransparency="true"
              style="border: none; overflow: hidden; width: 110px; height: 20px;"></iframe>
            </div>
            <div class="w-widget w-widget-facebook facebook-share">
              <iframe src="https://www.facebook.com/plugins/like.php?href=<?php the_permalink(); ?>&amp;layout=button_count&amp;action=like&amp;show_faces=true&amp;share=false" scrolling="no" frameborder="0" allowtransparency="true" style="border: none; overflow: hidden; width: 90px; height: 20px;"></iframe>
            </div>
          </div>-->
        </div>
		
      </div>
	</article><!-- #post -->