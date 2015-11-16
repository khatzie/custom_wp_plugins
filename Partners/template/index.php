<?php
/**
 * The main template file
 *
 */

get_header(); ?>

<audio class="audio-player" controls style="visibility: hidden">
  <source src="<?php echo get_template_directory_uri(); ?>/images/ocean-waves-1.mp3" type="audio/mpeg">
  <source src="<?php echo get_template_directory_uri(); ?>/images/ocean-waves-1.mp3" type="audio/ogg">
  <embed height="50" width="100" src="<?php echo get_template_directory_uri(); ?>/images/ocean-waves-1.mp3">
</audio>
<?php
$banner_image = wp_get_attachment_url( get_post_thumbnail_id(114), 'full' );
$partner_image = wp_get_attachment_url( get_post_thumbnail_id(117), 'full' );
$twitter_image = wp_get_attachment_url( get_post_thumbnail_id(119), 'full' );
$contact_image = wp_get_attachment_url( get_post_thumbnail_id(125), 'full' );
?>
  <!-- Banner -->
  <div class="section sTop clearfix ">
    <section id="banner2" style="background: url(<?php echo $banner_image; ?>) no-repeat fixed 50% 0; display:block;">
      <!-- <div class="patteren"></div> -->
      <div class="container fadeInRightBig" data-delay="2500">
        <div class="center flash animated">
          <div id="carousel-example-generic" class="carousel slide vertical" data-ride="carousel"> 
            <div class="carousel-inner banner-detail ">
			  <?php 
				$id_home=114; 
				$post_home = get_post($id_home); 
				$content_home = apply_filters('the_content', $post_home->post_content); 
				echo $content_home;  
				?>
              </div>
            </div>
          </div>
        </div>
       <a href="#scroll" class="scroll "><span id="scroll"></span></a></div>
    </section>
  </div>
  <!-- Banner End --> 
  
  <!-- About Us -->
  <div class="section s1" >
    <section class="about" id="about">
      <div class="container">
        <div class="row">
          <div class="col-md-12 ">
            <div class="title animate fadeIn">
              <h1 class="light">About Us</h1>
              <br/>
			  <div style="margin:0 auto; padding:20px;">
				<img class="" src="<?php echo get_template_directory_uri(); ?>/images/WELogo.png" alt="logo">
			  </div>
            </div>
			<?php 
				$id_about=141; 
				$post_about = get_post($id_about); 
				$content_about = apply_filters('the_content', $post_about->post_content); 
				echo $content_about;  
				?>
          </div>
		  
          
        </div>
      </div>
    </section>
	<section class="sponsors">
      <!---<div class="patteren"></div>-->
      <div id="third" style="background: url(<?php echo $partner_image; ?>) 50% 0 ; background-size: cover; display:block; background-color:#fff;">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="space"></div>
              <h1 class="light">Our Partners</h1>
              <br/>
			  <?php 
				$id_partners=117; 
				$post_partner = get_post($id_partners); 
				$content_partner = apply_filters('the_content', $post_partner->post_content); 
				echo $content_partner;  
				?>
			  <br/>
			  
	          <div class="features">

			  <?php
				$index_partners = 0;
				$args_partners = array(
					'post_type' => 'partners',
					'post_status' => 'publish',
					'posts_per_page' => -1,
					'order' => 'ASC'
				);
				$the_partners = new WP_Query( $args_partners );
 
				// The Loop
				if ( $the_partners->have_posts() ) :
				while ( $the_partners->have_posts() ) : $the_partners->the_post();
				$index_partners++;
				?>
  	            <div class="<?php if($index_partners <= 2){ echo "col-md-6"; } else { echo "col-md-4"; }?> animate fadeIn" data-delay="500"> 
  					<?php
						if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
							$partners_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
						?>
							<a href="<?php the_field('website_url'); ?>"><img src="<?php echo $partners_image_url[0]; ?>"></a>
						<?php
						} 
						?>
					<h4 style="color:<?php the_field('title_color'); ?>;"><?php the_title(); ?></h4>
					<?php the_content(); ?>
  	            </div>
				<?php if($index_partners == 2){ ?>
					<div style="clear:both;"></div>
				<?php } ?>
				<?php
				endwhile;
				endif;

				?>		
	          </div>
			 
            </div>
			 <div style="height:50px;clear:both;">
			 </div>
          </div>
        </div>
      </div>
    </section>
    <!-- BEGIN TEAM CONTAINER -->
    
    <!-- END TEAM CONTAINER -->
  </div>
  <!-- Sponsors -->
  <div class="section s2">
    <section class="team" id="team">
    	<div class="container text-center">
        	<!-- BEGIN HEADING -->
            <div class="title animate fadeIn">
			  <h1 class="light">Our Services</h1>
			  <br>
			 <?php 
				$id_services=146; 
				$post_services = get_post($id_services); 
				$content_services = apply_filters('the_content', $post_services->post_content); 
				echo $content_services;  
				?>
            </div>
            <!-- END HEADING -->
            <div class="row" >
				<?php
				$args = array(
					'post_type' => 'services',
					'post_status' => 'publish',
					'posts_per_page' => -1,
					'order' => 'DESC'
				);
				$the_query = new WP_Query( $args );
 
				// The Loop
				if ( $the_query->have_posts() ) :
				while ( $the_query->have_posts() ) : $the_query->the_post();
				$index++;
				?>
                <div id="<?php if($index == 1){ echo "one"; } else if($index == 2){ echo "two"; }?>" class="services <?php if($index == 3){ echo "col-md-12"; }else{ echo "col-md-6"; } ?> animate <?php if($index%2==0){ echo "fadeInRightBig"; } else { echo "fadeInLeftBig"; }?>" data-delay="100">
                   <div class="team-sec team-sec1 dark-bg" id="service<?php echo $index; ?>">
						<?php
						if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
							$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
						?>
							<div class="member"><img src="<?php echo $large_image_url[0]; ?>" alt=""></div>
						<?php
						} 
						?>
                   		
                    	<div class="<?php if($index < 3){ echo "detail-left"; } ?>">
                        	<h4 <?php if($index == 3){ echo "style='font-size:20px; font-weight:600' "; } ?>><?php the_title(); ?></h4>
                            <?php the_content(); ?>
                            <!---<div class="social-icons">
                            	<a href="#." class="fb"><i class="fa fa-facebook"></i></a> <a href="#." class="tw"><i class="fa fa-twitter"></i></a>
                                <a href="#." class="it"><i class="fa fa-instagram"></i></a>
                            </div>--->
                        </div>
                   <div class="clearfix"></div>
                   </div>
                </div>
                <?php
				endwhile;
				endif;

				?>

           </div>
        </div>
    </section>
  </div>
  <!-- Sponsors End --> 
    <section class="testimonials">
      <!---<div class="patteren"></div>-->
      <div id="second" style="background: url(<?php echo $twitter_image; ?>); background-size: cover; display:block; background-color:#fff;">
        <div class="container"> <i class="fa fa-twitter"></i>
          <div class="twitter flash animated">
            <div id="carousel-example-generic2" class="carousel slide" data-ride="carousel"> 
              <!-- Indicators -->
              <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic2" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic2" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic2" data-slide-to="2"></li>
                <li data-target="#carousel-example-generic2" data-slide-to="3"></li>
              </ol>
              <div class="carousel-inner">
                <div class="item active">
                  <p>We’re right there with you and for you, from conceptualization to planning to rendering the event, down to the nitty gritty work so that you can enjoy your own event. <span class="date">2 Days ago</span></p>
                </div>
                <div class="item">
                  <p>We’re right there with you and for you, from conceptualization to planning to rendering the event, down to the nitty gritty work so that you can enjoy your own event.<span class="date">2 Days ago</span></p>
                </div>
                <div class="item">
                  <p>We’re right there with you and for you, from conceptualization to planning to rendering the event, down to the nitty gritty work so that you can enjoy your own event.<span class="date">2 Days ago</span></p>
                </div>
                <div class="item">
                  <p>We’re right there with you and for you, from conceptualization to planning to rendering the event, down to the nitty gritty work so that you can enjoy your own event.<span class="date">2 Days ago</span></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  <!-- Portfolio -->
  <div class="section s3">
   
    <section class="portfolio no-padding-bottom" id="portfolio" >
      <div class="container">
        <div class="title animate fadeIn">
          <h1 class="light">Our Work</h1>
          <br/>
          <h1 class="work-subhead">W.E. BORACAY is right there with you,<br> every step of the way.</h1><p></p>
          <p class="title-detail">We’re right there with you and for you, from conceptualization to planning to rendering the event, down to the nitty gritty work so that you can enjoy your own event.</p>
          <p class="title-detail">Check out our gallery for capabilities and sample works we’ve handled and helped become a smashing success!</p>
        </div>
      </div>
      <div  id="filters">
        <ul class="clearfix">
			<li><a class="active default-filter" href="#" data-filter="*">
            <h3>All</h3>
            </a></li>
		<?php 
			$args_terms = array(
				'hide_empty'	=>	0
			);
				
			$terms = get_terms('works_category', $args_terms);
			
			if ( !empty( $terms ) && !is_wp_error( $terms ) ) {
				$counter = 1;
				foreach ( $terms as $term ) { 
		?>
         
          <li><a href="#" class="fancybox" data-filter=".<?php echo $term->slug; ?>">
            <h3><?php echo $term->name; ?></h3>
            </a></li>
		<?php $counter++;
					}  // end of the loop.
				} 
		?>
        </ul>
      </div>
      <div id="portfolio-items-wrap">
			<?php
			$args = array(
				'post_type' => 'works',
				'post_status' => 'publish',
				'posts_per_page' => -1,
				'order' => 'DESC'
			);
			$the_query = new WP_Query( $args );

			// The Loop
			if ( $the_query->have_posts() ) :
				while ( $the_query->have_posts() ) : $the_query->the_post();
					$index++;
					//$cat = get_the_term($post->ID, 'works_category');
					$cat = get_the_category_custompost($post->ID, 'works_category');
					if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
						$thumb_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'works-thumb-home');
						$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
						$img = $thumb_image_url[0];
						$large = $large_image_url[0];
					}
			?>
					<div class="portfolio-item one-third column <?php echo $cat[0]->slug; ?>">
					  <div class="freshdesignweb">
						<div class="image_grid portfolio_4col">
						  <ul id="list" class="portfolio_list da-thumbs">
							<li>
							  <div class="slideUp"><img src="<?php if($img) {echo $img;}else{ echo get_template_directory_uri()."/images/portfolio1.jpg";} ?>" alt=""></div>
							  <article class="da-animate da-slideFromRight" style="display: block;"><a class="<?php if($cat[0]->slug == "photos"){ echo "fancybox photo-icon"; }else{ echo "fancybox-media video-icon"; }?>" href="<?php if($cat[0]->slug == "photos"){ if($large) {echo $large;}else{ echo get_template_directory_uri()."/images/port-large1.jpg";} } else { echo get_the_content(); } ?>" data-fancybox-group="gallery" title="<?php the_title(); ?>"> <i class="fa <?php if($cat[0]->slug == "photos"){ echo "fa-camera-retro"; }else{ echo "fa-video-camera"; }?>"></i>
								<h5><?php the_title(); ?><br/>
								  <span><?php the_field('event_date'); ?> * <?php the_field('location'); ?></span></h5>
								<span><?php echo $cat[0]->name; ?></span> </a></article>
							</li>
						  </ul>
						</div>
					  </div>
					</div>
			<?php
				endwhile;
			endif;
		?>
      </div>
    </section>
    <!---<section class="latest-pro" style="background:#444;">
      <div class="row">
        <div class="col-md-12">
          <div class=" animate fadeIn">
            <h2>Featured Work</h2>
            <p class="title-detail"></p>
          </div>
          <img class="devices animate bounceInUp" src="<?php echo get_template_directory_uri(); ?>/images/devices.png" alt="" > </div>
      </div>
    </section>--->

  </div>
  <!-- Portfolio End --> 
  
  <!-- Table -->
  <div class="section s4">
  </div>
  <!-- Table End --> 
  
  
  
  <!-- News & Events -->
  <section class="pressroom">
    <div class="container">
      <div class="row">
        <div class="title animate fadeIn">
          <h2>Events</h2>
          <p class="title-detail"></p>
        </div>
        <div class="space"></div>
		<?php
				$args = array(
					'post_type' => 'post',
					'post_status' => 'publish',
					'posts_per_page' => -1,
					'order' => 'DESC'
				);
				$the_query = new WP_Query( $args );
				$count = $the_query->post_count;
				// The Loop
				if ( $the_query->have_posts() ) :
				while ( $the_query->have_posts() ) : $the_query->the_post();
				$index2++;
	
						if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
							$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
							$img = $large_image_url[0];
						}
				
				if($index2 <= 3){		
				 if($index2%2==0):
				 ?>
				 <div class="com-sec">
					 <div class="press-img image res-image"><a href="<?php the_permalink(); ?>"><img class="animate fadeIn" src="<?php if($img) {echo $img;}else{ echo get_template_directory_uri()."/images/press-img2.jpg";} ?>" alt=""></a></div>
				  <div class="press-img image"><a href="<?php the_permalink(); ?>"><img class="animate fadeIn" src="<?php if($img) {echo $img;}else{ echo get_template_directory_uri()."/images/press-img2.jpg";} ?>" alt=""></a></div>
				  <div class="divider"><img src="<?php echo get_template_directory_uri(); ?>/images/timeline-divider.png" alt=""></div>
				  <div class="right-text  animate fadeIn"> <span class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>
					<div class="clear"></div>
					<span> <?php the_field('event_date'); ?></span>
					<p><?php the_excerpt(); ?></p>
					<a href="<?php the_permalink(); ?>">read more <?php echo $count; ?></a> </div>
				</div>
				<div class="clear"></div>
				 <?php
				 else:
				?>
				<div class="com-sec">
				<div class="press-img image res-image"><a href="<?php the_permalink(); ?>"><img class="animate fadeIn" src="<?php if($img) {echo $img;}else{ echo get_template_directory_uri()."/images/press-img2.jpg";} ?>" alt=""></a></div>
				  <div class="left-text animate fadeIn"> <span class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>
					<div class="clear"></div>
					<span><?php the_field('event_date'); ?></span>
					<p><?php the_excerpt(); ?></p>
					<a href="<?php the_permalink(); ?>">read more</a> </div>
				  <div class="divider"><img  src="<?php echo get_template_directory_uri(); ?>/images/timeline-divider.png" alt=""></div>
				  <div class="press-img image"><a href="<?php the_permalink(); ?>"><img class="animate fadeIn" src="<?php if($img) {echo $img;}else{ echo get_template_directory_uri()."/images/press-img2.jpg";} ?>" alt=""></a></div>
				</div>
				<div class="clear"></div>
				<?php
				endif;
				}
				else{
				?>
				<div id="moreEvents" style="display:none;">
					<?php
					if($index2%2==0):
				 ?>
				 <div class="com-sec">
					 <div class="press-img image res-image"><a href="<?php the_permalink(); ?>"><img class="animate fadeIn" src="<?php if($img) {echo $img;}else{ echo get_template_directory_uri()."/images/press-img2.jpg";} ?>" alt=""></a></div>
				  <div class="press-img image"><a href="<?php the_permalink(); ?>"><img class="animate fadeIn" src="<?php if($img) {echo $img;}else{ echo get_template_directory_uri()."/images/press-img2.jpg";} ?>" alt=""></a></div>
				  <div class="divider"><img src="<?php echo get_template_directory_uri(); ?>/images/timeline-divider.png" alt=""></div>
				  <div class="right-text  animate fadeIn"> <span class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>
					<div class="clear"></div>
					<span> <?php the_field('event_date'); ?></span>
					<p><?php the_excerpt(); ?></p>
					<a href="<?php the_permalink(); ?>">read more</a> </div>
				</div>
				<div class="clear"></div>
				 <?php
				 else:
				?>
				<div class="com-sec">
					<div class="press-img image res-image"><a href="<?php the_permalink(); ?>"><img class="animate fadeIn" src="<?php if($img) {echo $img;}else{ echo get_template_directory_uri()."/images/press-img2.jpg";} ?>" alt=""></a></div>
				  <div class="left-text animate fadeIn"> <span class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>
					<div class="clear"></div>
					<span><?php the_field('event_date'); ?></span>
					<p><?php the_excerpt(); ?></p>
					<a href="<?php the_permalink(); ?>">read more</a> </div>
				  <div class="divider"><img  src="<?php echo get_template_directory_uri(); ?>/images/timeline-divider.png" alt=""></div>
				  <div class="press-img image"><a href="<?php the_permalink(); ?>"><img class="animate fadeIn" src="<?php if($img) {echo $img;}else{ echo get_template_directory_uri()."/images/press-img2.jpg";} ?>" alt=""></a></div>
				</div>
				<div class="clear"></div>
				<?php
				endif;
					?>
				</div>
				<?php
				}
			endwhile;
			endif;
		?>
      </div>
	  <?php
		if($count > 3 ){
			echo '<div class="row" align="center">
					<button id="viewAll" name="hide">View All Events</button>
				  </div>';
		}
	  ?>
    </div>
  </section>
  
  <!-- End News & Events --> 
  
  <!-- contact us -->
  <div class="section s5">
    <section class="contact"> 
      <div id="fifth" style="background: url(<?php echo $contact_image; ?>) 50% 0; background-size: cover; display:block; background-color:#fff;">
        <div class="patteren"></div>
        <div class="container">
          <div class="title animate fadeIn">
            <h1 class="light">Contact Us</h1>
            <br/>
            <h1>Get in Touch with Us</h1>
            <p class="title-detail">Make your event truly a precious moment in time. Please feel free to contact us:</p>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form animate bounceInUp">
                <?php echo do_shortcode('[contact-form-7 id="22" title="Contact Us"]'); ?>
				<div class="row">
				<div class="col-md-6" style="color:#000;">
					<div style="text-align: left;">
						<strong>Address:</strong>
						<p>W.E. BORACAY <br>The Basement, Boracay Eco-Village Resort & Convention Center Brgy. Yapak Malay, Aklan, Philippines</p>
					</div>
					<div style="text-align: left;">
						<strong>Tel. No.:</strong>
						<p>(036)288-5826 / (036)288-4118</p>
					</div>
					<div style="text-align: left;">
						<strong>Fax:</strong>
						<p>(036)288-5825</p>
					</div>
					<div style="text-align: left;">
						<strong>Website:</strong>
						<p><a href="www.boracayconventioncenter.com">www.boracayconventioncenter.com</a><br><a href="www.boracayecovillage.net
"> www.boracayecovillage.net </a></p>
					</div>
				</div>
				<div class="col-md-6">
				<iframe width="100%" height="200" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps/ms?msa=0&amp;msid=217929383616015316427.0005004771b9b2281fee7&amp;hl=en&amp;ie=UTF8&amp;ll=11.969415,121.918657&amp;spn=0,0&amp;t=m&amp;output=embed"></iframe>
				</div>
				</div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="social">
            <h5>Connect with Us</h5>
            <a href="https://www.facebook.com/weboracay"  class="fb animate bounceIn" data-delay="1400" target="_blank"><i class="fa fa-facebook"></i></a> 
			<a href="https://twitter.com/weboracay" class="tw animate bounceIn" data-delay="1400" target="_blank"><i class="fa fa-twitter"></i></a> 
			<a href="http://weboracay.tumblr.com/" class="yt animate bounceIn" data-delay="1400" target="_blank"><i class="fa fa-tumblr"></i></a> 
			<a href="https://www.youtube.com/user/weboracay" class="db animate bounceIn" data-delay="1400" target="_blank"><i class="fa fa-youtube"></i></a> 
			<a href="https://www.flickr.com/photos/127999301@N04/" class="li animate bounceIn" data-delay="1400" target="_blank"><i class="fa fa-flickr"></i></a> 
			<a href="http://instagram.com/weboracay" class="li animate bounceIn" data-delay="1400" target="_blank"><i class="fa fa-instagram"></i></a> 
		</div>
          <div class="copyright"> <span >Copyright © 2014 WE Boracay. All rights reserved.</span>
			  <p></p>
           
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- contact us End --> 

<?php get_footer(); ?>