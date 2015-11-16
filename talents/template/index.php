<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 */
get_header();?>

  <!-- ABOUT SECTION -->
  <?php
  $about_us_image = wp_get_attachment_url( get_post_thumbnail_id(214), 'full' );
  ?>
  <section class="about-section parallax-section" id="about" style="background-image: url(<?php echo $about_us_image; ?>)">
    <div class="w-container about-container">
      <h2 data-ix="scroll-fade-out-20" class="h-white">about us</h2>
      <div class="hero-line" data-ix="scroll-fade-out-21"></div>
      <div class="subtex" data-ix="scroll-fade-out-22">We are your one-stop shop for talents who exhibit a flair for greatness.</div>
	  <div class="maintex" data-ix="scroll-fade-out-23">
		  <!--<img src="<?php echo get_template_directory_uri(); ?>/images/responsive.jpg" alt="responsive.jpg"
		  data-ix="scroll-fade-out-23">-->
			<!--<p><strong>Flair Talent Bureau</strong> is a talent booking and management agency that prides itself in continually discovering the freshest faces, the brightest talents, and the most versatile artists in every generation, cutting across the different audience spectrums and target markets.</p>-->
			
			<p><strong>Flair Talent Bureau</strong> is a talent hub of models, artists, speakers and unique performers for a wide variety of work. Drawing from a brimming pool of either fresh or seasoned, promising or proven talents, Flair thrives on its ability to provide who and what you need for your events, commercial shoots, print, audio and motion picture requirements, or marketing requisites.</p>

			<!--<p>We meticulously handpick from our pool of up-and-coming and seasoned talents to carefully select the models, artists, speakers, and performers that will best match what you need for your events, commercial shoots, movies, and print ad commitments.</p>-->
			
			<p>Flair is a talent management and booking agency that prides itself in continually discovering exciting finds, developing bright talents and working with versatile artists from different genres and generations, catering across a broad range of audience spectrum.</p>

			<p>Book a talent with us today. Drop us a line at <a href="#contact">info@flairbureau.com</a> and let us work on what you need.</p>
		  <div class="hero-column" style="padding: 20px 0">
			<!--<a class="button hero btn-hero-about" href="<?php echo site_url(); ?>/#talents">our talents</a>-->
		  </div>
	  </div>
    </div>
  </section><!-- end about section -->
  
  
  <!-- SERVICE SECTION -->
  <section class="service-section" id="what-we-do">
    <div class="w-container">
      <h2 data-ix="scroll-fade-out-20" class="h-white">what we do</h2>
      <div class="hero-line" data-ix="scroll-fade-out-21"></div>
	  <div class="maintex" data-ix="scroll-fade-out-23">
		<p>
		Flair Talent Bureau (FTB) develops and casts talents for commercial arts and sciences. We spot people with unique and valuable talents for TV, runway, events, commercial shoots, movies and print. We negotiate deals on behalf of clients and find work for our talents.
		</p>
		<p>
		Flair is always active in searching for new faces and fresh talents to be part of our agency. If you think you’ve got what it takes, contact us and let’s explore possibilities.
		</p>
		<div class="hero-column" style="padding: 40px 0 0">
			<a class="button hero btn-hero-about" href="<?php echo site_url(); ?>/#talents">our talents</a>
		</div>
	  </div>
    </div>
  </section><!-- end service section -->
	
	
  <!-- color line -->
  <div class="color-line">
    <div class="w-row line-row">
      <div class="w-col w-col-2 color-one"></div>
      <div class="w-col w-col-2 color-two"></div>
      <div class="w-col w-col-2 color-three"></div>
      <div class="w-col w-col-2 color-five"></div>
      <div class="w-col w-col-2 color-four"></div>
      <div class="w-col w-col-2 color-six"></div>
    </div>
  </div><!-- end color line div -->

  <!-- TALENT SECTION -->
  <section class="work-section" id="talents">
    <div class="w-row w-hidden-medium work-row">
		<?php
		$args = array(
			'hide_empty'	=>	0,
			'number'	=>	7
		);
		
		$terms = get_terms('talents_category', $args);
		
		$count_terms = wp_count_terms('talents_category');
		
		$counter = 0;
		
		 if ( !empty( $terms ) && !is_wp_error( $terms ) ) {
			?>
			<div class="w-col w-col-3 portfolio-row">
				<a class="w-inline-block portfolio-photo portfolio-1" href="#" style="background-color: #000000; background-image: none"><span class="default-category-box"><?php //echo boldText(get_bloginfo('name'), array('Flair')); ?><img src="<?php echo get_template_directory_uri(); ?>/images/talent_logo.jpg" width="300"></span></a>
			</div>
			<?php
			 foreach ( $terms as $term ) {
			   $counter++;
			   $url = get_field('talent_category_image','talents_category_' . $term->term_id);
			   $term_link = get_term_link( $term );
			   ?>
			    <div class="w-col w-col-3 portfolio-row view_talents" title="<?php echo $term->slug; ?>">
					<a class="w-inline-block portfolio-photo portfolio-1" href="#<?php echo $term->slug; ?>" style="background-image:url(<?php echo $url; ?>)">
						<div class="portfolio-photo-overlay">
							<div class="portfolio-tittle" data-ix="scroll-fade-out<?php if($counter > 1){ echo "-".$counter; } ?>">
								<?php echo $term->name; ?>
							</div>
							<div class="portfolio-subtittle" data-ix="scroll-fade-out-<?php $counter++; echo $counter; ?>">
								<?php echo bloginfo('name'); ?>
							</div>
						</div>
					</a>
			   </div>
			   <?php
			 }  // end of the loop.
		 }
		 
		 if ($count_terms < 7) {
			$toAdd = 7 - $count_terms;
			for($i = 0; $i < $toAdd; $i++) { ?>
				<div class="w-col w-col-3 portfolio-row">
					<a class="w-inline-block portfolio-photo portfolio-1" href="#">
					  <div class="portfolio-photo-overlay">
						<div class="portfolio-tittle" data-ix="scroll-fade-out<?php if($counter > 1){ $counter++; echo "-".$counter; } ?>">coming soon</div>
						<div class="portfolio-subtittle" data-ix="scroll-fade-out-<?php $counter++; echo $counter; ?>"><?php echo bloginfo('name'); ?></div>
					  </div>
					</a>
				</div>
			<?php
			}
		 }
		?>
    </div>
  </section><!-- end work section -->
  <?php
	// For Displaying Talents From Category
	$args = array(
		'hide_empty'	=>	0,
	);
  	$talents_cat = get_terms('talents_category', $args);
	
	foreach($talents_cat as $talent) {
		if($talent->name != "Coming Soon"){
			
			?>
		    <!--category talents-->
		    <section class="work-section talents-list" id="<?php echo $talent->slug; ?>" style="display:none;">
		      <div class="w-row w-hidden-medium work-row">
		  		<div class="w-col w-col-3 portfolio-row">
		  			<a class="w-inline-block portfolio-photo portfolio-1" href="#" style="background-color: <?php echo get_field('background_color','talents_category_' . $talent->term_id); ?>; background-image: none; filter: none; -webkit-filter: none;"><span style="color: <?php echo get_field('foreground_color','talents_category_' . $talent->term_id); ?>;" class="default-category-box default-category-selection"><strong><?php echo $talent->name; ?></strong></span></a>
		  		</div>
		  		<?php
		  		$args = array(
		  			'post_type' => 'talents',
		  			'post_status' => 'publish',
		  			'order' => 'DESC',
		  			'tax_query' => array(
		  					array(
		  						'taxonomy' => 'talents_category',
		  						'field' => 'slug',
		  						'terms' => $talent->slug
		  					)
		  				)
		  		);
		  		$the_query = new WP_Query( $args );
 
		  		// The Loop
		  		if ( $the_query->have_posts() ) :
		  		while ( $the_query->have_posts() ) : $the_query->the_post();
		  			$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
		  		 		if ( has_post_thumbnail() ) :
		  				 	$url = $thumb['0'];
		  		 		else :
		  					$url = get_template_directory_uri() . '/images/gallery1.jpg';
		  		 	    endif;
		  			?>
			
		  			   <div class="w-col w-col-3 portfolio-row">
		  					<a class="w-inline-block portfolio-photo portfolio-1" href="<?php the_permalink(); ?>" style="background-image:url(<?php echo $url; ?>)">
		  						<div class="portfolio-photo-overlay">
		  							<div class="portfolio-tittle" data-ix="scroll-fade-out">
		  								<?php
		  								if(get_the_title() != '') {
		  									echo get_the_title();
		  								} else {
		  									echo get_field('talent_name');
		  								}
		  								?>
		  							</div>
		  							<div class="portfolio-subtittle" data-ix="scroll-fade-out-<?php $counter++; echo $counter; ?>">
		  								<?php 
		  									$expertise = str_replace(', ',',',get_field('expertise'));
		  									echo str_replace(',','&nbsp;-&nbsp;',$expertise); 
		  								?>
		  							</div>
		  						</div>
		  					</a>
		  			   </div>
		  			   <?php
		  		   endwhile;
		  		   endif;
		  		   wp_reset_postdata();
		  		 ?>
		      </div>
		    </section><!-- end work section -->
			<?php
		}
	}
	//end
  ?>

  <!--end category talents-->
  
  <!-- IMPORTANT: TABLET WORK COLUMNS -->
  <div class="w-row w-hidden-main w-hidden-small w-hidden-tiny row-tablet">
	<?php
		$args = array(
			'hide_empty'	=>	0,
			'number'	=>	7
		);
		
		$terms = get_terms('talents_category', $args);
		
		$count_terms = wp_count_terms('talents_category');
		
		$counter = 0;
		
		if ( !empty( $terms ) && !is_wp_error( $terms ) ){ ?>
			<!-- Display Default Box -->
			<div class="w-col w-col-6 portfolio-tablet portfoio-1" style="background-color: #000000; background-image: none">
				<a href="#" style="text-decoration: none"><span class="default-category-box"><?php //echo boldText(get_bloginfo('name'), array('Flair')); ?><img src="<?php echo get_template_directory_uri(); ?>/images/talent_logo.jpg" width="300"></span></a>
			</div>
			<?php
			 foreach ( $terms as $term ) {
			   $counter++;
			   $url = get_field('talent_category_image','talents_category_' . $term->term_id);
			   $term_link = get_term_link( $term ); 
			   ?>
				<div class="w-col w-col-6 portfolio-tablet portfoio-1 view_talents_tablet" title="<?php echo $term->slug; ?>" style="background-image:url(<?php echo $url; ?>); background-size: cover;">
					<a href="#tablet_<?php echo $term->slug; ?>">
					  <div class="portfolio-photo-overlay">
						<div class="portfolio-tittle" data-ix="scroll-fade-out<?php if($counter > 1){ echo "-".$counter; } ?>">
							<?php echo $term->name; ?>
						</div>
						<div class="portfolio-subtittle" data-ix="scroll-fade-out-<?php $counter++; echo $counter; ?>">
							<?php echo bloginfo('name'); ?>
						</div>
					  </div>
					</a>
				</div>
			<?php
			}  // end of the loop.
		}
		
		if ($count_terms < 7) {
			$toAdd = 7 - $count_terms;
			for($i = 0; $i < $toAdd; $i++) { ?>
				<div class="w-col w-col-6 portfolio-tablet portfoio-1">
				  <div class="portfolio-photo-overlay">
					<div class="portfolio-tittle" data-ix="scroll-fade-out<?php if($counter > 1){ $counter++; echo "-".$counter; } ?>">coming soon</div>
					<div class="portfolio-subtittle" data-ix="scroll-fade-out-<?php $counter++; echo $counter; ?>"><?php echo bloginfo('name'); ?></div>
				  </div>
				</div>
			<?php
			}
		}
	?>
  </div><!-- end tablet work -->
  <?php
  // For Displaying Talents From Category in Tablet Mode
	$args = array(
		'hide_empty'	=>	0,
	);
  	$talents_cat = get_terms('talents_category', $args);
	
	foreach($talents_cat as $talent) {
		if($talent->name != "Coming Soon"){
		?>
		<section id="tablet_<?php echo $talent->slug; ?>" class="work-section tablet-talents-list" style="display: none">
		  <div class="w-row w-hidden-main  w-hidden-small w-hidden-tiny row-tablet">
				<!-- Display Default Box -->
				<div class="w-col w-col-6 portfolio-tablet portfoio-1" style="background-color: <?php echo get_field('background_color','talents_category_' . $talent->term_id); ?>; background-image: none; filter: none; -webkit-filter: none;">
					<a href="#" style="text-decoration: none"><span style="color: <?php echo get_field('foreground_color','talents_category_' . $talent->term_id); ?>;" class="default-category-box default-category-selection"><strong><?php echo $talent->name; ?></strong></span></a>
				</div>
				<?php
		  		$args = array(
		  			'post_type' => 'talents',
		  			'post_status' => 'publish',
		  			'order' => 'DESC',
		  			'tax_query' => array(
		  					array(
		  						'taxonomy' => 'talents_category',
		  						'field' => 'slug',
		  						'terms' => $talent->slug
		  					)
		  				)
		  		);
		  		$the_query = new WP_Query( $args );
 
		  		// The Loop
		  		if ( $the_query->have_posts() ) :
					while ( $the_query->have_posts() ) : $the_query->the_post();
						$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
							if ( has_post_thumbnail() ) :
								$url = $thumb['0'];
							else :
								$url = get_template_directory_uri() . '/images/gallery1.jpg';
							endif;
						?>
						<div class="w-col w-col-6 portfolio-tablet portfoio-1 view_talents_tablet" title="<?php echo $term->slug; ?>" style="background-image:url(<?php echo $url; ?>); background-size: cover;">
							<a href="<?php the_permalink(); ?>">
							  <div class="portfolio-photo-overlay">
								<div class="portfolio-tittle" data-ix="scroll-fade-out<?php if($counter > 1){ echo "-".$counter; } ?>">
		  								<?php
		  								if(get_the_title() != '') {
		  									echo get_the_title();
		  								} else {
		  									echo get_field('talent_name');
		  								}
		  								?>
								</div>
								<div class="portfolio-subtittle" data-ix="scroll-fade-out-<?php $counter++; echo $counter; ?>">
									<?php 
										$expertise = str_replace(', ',',',get_field('expertise'));
										echo str_replace(',','&nbsp;-&nbsp;',$expertise); 
									?>
								</div>
							  </div>
							</a>
						</div>
					   <?php
					endwhile;
			    endif;
			    wp_reset_postdata();
			 ?>
		  </div>
		</section>
		<?php
		}
	}
  ?>
  
  
  <!-- HERO SECTION View More talents-->
  <section class="hero-section">
    <div class="w-container">
      <div class="w-row">
        <div class="w-col w-col-4 hero-column">
          <div class="line-hero"></div>
          <div class="line-hero"></div>
        </div>
        <div class="w-col w-col-4 hero-column"><a class="more-from-talent button hero" href="<?php echo site_url(); ?>/talents/">view all talents</a>
        </div>
        <div class="w-col w-col-4">
          <div class="line-hero"></div>
          <div class="line-hero"></div>
        </div>
      </div>
    </div><!-- end hero work -->
  </section>
  
  <!-- FEATURES SECTION -->
  <section class="retina-section" id="features">
    <div class="w-container container">
	<h2 class="h-white" data-ix="scroll-fade-out-20">Features</h2>
	<div class="hero-line" data-ix="scroll-fade-out-21"></div>
    <div class="w-container features-container">
		<?php
		$args = array(
			'post_type' => 'post',
			//'posts_per_page' => 2
		);
		$wp_query = new WP_Query($args);
		
		$features_count = $wp_query->post_count;

		if (have_posts()) : $counter= 1; ?>
			<?php while (have_posts()) : the_post(); ?>
			<?php 
				$get_featured_thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
				$featured_thumb = $get_featured_thumb[0];
			
				if ($counter == 1) {
					$add_top = 'top';
				} else {
					$add_top = '';
				}
				
				if ($counter > 1) {
					$add_separator = '<div class="divder" data-ix="scroll-line-from-left-2" style="background-color: #1f1f1f"></div>';
				} else {
					$add_separator = '';
				}
				
				if ($counter == $features_count) {
					$add_style = ' style="margin-bottom: 100px"';
				} else {
					$add_style = '';
				}
				
				$content = get_the_content();
				$content = apply_filters('the_content', $content);
				$content = str_replace(']]>', ']]&gt;', $content);
				
				echo $add_separator;
			?>
			  <div class="w-row features-row <?php echo $add_top ?>"<?php echo $add_style; ?>>
				<?php if ($counter % 2 != 1) { ?>
				<div class="w-col w-col-7">
				  <img class="ipad" style="margin-bottom: 20px" src="<?php echo $featured_thumb; ?>" width="750" alt="" data-ix="scroll-fade-from-right">
				</div>
				<?php } ?>
				<div class="w-col w-col-5 col" data-ix="scroll-fade-from-left">
				  <h2 class="lft h2-features"><?php the_title(); ?></h2>
				  <div class="hero-line left"></div>
				  <div class="left features-content-left"><?php echo shortenString(strip_tags($content, '<p>'), 300); ?></div>
				  <div class="div-left"><a class="button black btn-hero-about" href="<?php the_permalink(); ?>">Read More</a>
				  </div>
				</div>
				<?php if ($counter % 2 == 1) { ?>
				<div class="w-col w-col-7">
				  <img class="ipad" src="<?php echo $featured_thumb; ?>" width="750" alt="" data-ix="scroll-fade-from-right">
				</div>
				<?php } ?>
			  </div>
			  <?php $counter++; ?>
			  <?php endwhile; ?> 
		<?php
		else :
		?>
		  <div class="w-row features-row top">
			<div class="w-col w-col-5 col" data-ix="scroll-fade-from-left">
			  <h2 class="lft h2-features">Photoshoot 2014</h2>
			  <div class="hero-line left"></div>
			  <p class="left">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare.</p>
			  <div class="div-left"><a class="button black btn-hero-about" href="#">Read More</a>
			  </div>
			</div>
			<div class="w-col w-col-7">
			  <img class="ipad" src="<?php echo get_template_directory_uri(); ?>/images/ipad.jpg" width="750" alt="ipad.jpg" data-ix="scroll-fade-from-right">
			</div>
		  </div>
		  
		  <div class="divder" data-ix="scroll-line-from-left-2" style="background-color: #1f1f1f"></div>
		  
		  <div class="w-row features-row">
			<div class="w-col w-col-7">
			  <img class="macbook" src="<?php echo get_template_directory_uri(); ?>/images/laptop.jpg" width="540" alt="laptop.jpg" data-ix="scroll-fade-from-left">
			</div>
			<div class="w-col w-col-5 col" data-ix="scroll-fade-from-right">
			  <h2 class="lft h2-features">Model Search</h2>
			  <div class="hero-line left"></div>
			  <p class="left">Consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare, eros dolor interdum nulla.</p>
			  <div class="div-left"><a class="button black btn-hero-about" href="#">Read More</a>
			  </div>
			</div>
		  </div>
		<?php
		endif;
		wp_reset_query();
		?>
    </div>
  </section><!-- end features section -->
  
  <!-- color line -->
  <div class="color-line">
    <div class="w-row line-row">
      <div class="w-col w-col-2 color-one"></div>
      <div class="w-col w-col-2 color-two"></div>
      <div class="w-col w-col-2 color-three"></div>
      <div class="w-col w-col-2 color-five"></div>
      <div class="w-col w-col-2 color-four"></div>
      <div class="w-col w-col-2 color-six"></div>
    </div>
  </div><!-- end color line div -->
  
  
  <!-- GET IN TOUCH SECTION -->
  <section class="touch-section">
    <div class="w-container container">
      <h2 class="h2-testimonials" data-ix="scroll-fade-out-20">let's get social</h2>
      <div class="hero-line" data-ix="scroll-fade-out-21"></div>
      <div class="w-row connetcted-row">
        <div class="w-col w-col-2 column-connected team-column" data-ix="scroll-fade-from-bottom">
          <a href="https://twitter.com/flairbureau" target="_blank"><div class="connect fa fa-twitter"></div></a>
          <div class="connected-name">twitter</div>
          <div class="connected-subtext">Get Latest Updates</div>
        </div>
        <div class="w-col w-col-2 column-connected team-column" data-ix="scroll-fade-from-bottom-2">
          <a href="https://www.facebook.com/flairbureau" target="_blank"><div class="connect fa fa-facebook"></div></a>
          <div class="connected-name">facebook</div>
          <div class="connected-subtext">Like and Follow us</div>
        </div>
        <div class="w-col w-col-2 column-connected team-column" data-ix="scroll-fade-from-bottom-3">
          <a href="https://www.flickr.com/photos/127070126@N04/" target="_blank"><div class="connect fa fa-flickr"></div></a>
          <div class="connected-name">Flickr</div>
          <div class="connected-subtext">See our Photos</div>
        </div>
        <div class="w-col w-col-2 column-connected team-column" data-ix="scroll-fade-from-bottom-4">
          <a href="http://flairtalentbureau.tumblr.com/" target="_blank"><div class="connect fa fa-tumblr"></div></a>
          <div class="connected-name">Tumblr</div>
          <div class="connected-subtext">Explore our Blog</div>
        </div>
        <div class="w-col w-col-2 column-connected" data-ix="scroll-fade-from-bottom-5">
          <a href="https://www.youtube.com/user/flairbureau" target="_blank"><div class="connect fa fa-youtube"></div></a>
          <div class="connected-name">Youtube</div>
          <div class="connected-subtext">Visit our channel</div>
        </div>
      </div>
    </div>
  </section><!-- end logo section -->
  

  <!-- HERO SECTION -->
  <section class="hero-section">
    <div class="w-container">
      <div class="w-row">
        <div class="w-col w-col-4 hero-column">
          <div class="line-hero"></div>
          <div class="line-hero"></div>
        </div>
        <div class="w-col w-col-4 hero-column"><a class="button hero" href="<?php echo site_url(); ?>/application/">submit an application</a>
        </div>
        <div class="w-col w-col-4">
          <div class="line-hero"></div>
          <div class="line-hero"></div>
        </div>
      </div>
    </div><!-- end hero work -->
  </section>
 
  <!-- CONTACT SECTION -->
  <section class="contact-section" id="contact">
    <div class="w-container">
      <h2 data-ix="scroll-fade-out-20">CONTACT US</h2>
      <div class="hero-line" data-ix="scroll-fade-out-21"></div>
      <div class="w-row row form">
        <div class="w-col w-col-8">
            <!---<form class="form" id="email-form" method="POST" name="email-form" data-name="Email Form" data-ix="scroll-fade-from-left">
              <label class="field-label" for="name">Your Name*</label>
              <input class="w-input text-field" id="name" type="text" name="name" data-name="Name" required>
              <label class="field-label" for="email">Email Address*</label>
              <input class="w-input text-field" id="email" type="email" name="email" data-name="Email" required>
              <label class="field-label" for="subject">Subject</label>
              <input class="w-input text-field" id="subject" type="text" name="subject" data-name="Subject">
              <label class="field-label" for="text-area">Your Message*</label>
              <textarea class="w-input text-area" id="text-area" name="message" required data-name="Text Area"></textarea>
			  <input type="hidden" id="toEmail" name="toEmail" value="<?php echo get_option('admin_email'); ?>">
              <button class="w-button submit-button" type="submit">Submit Message</button>
            </form>
            <div id="result"></div>-->
            <!--div class="success-message">
              <p class="seuccses">Thank you! Your submission has been received!</p>
            </div>
            <div class="error-message">
              <p class="from">Oops! Something went wrong while submitting the form :(</p>
            </div-->
			<?php echo do_shortcode('[contact-form-7 id="69" title="Contact Us"]'); ?>
        </div>
        <div class="w-col w-col-4 column-work" data-ix="scroll-fade-from-right" style="margin-top: 0">
          <div class="small-tittle"><?php bloginfo('name'); ?></div>
          <p class="left"><span class="darker">Phone:</span> +632 4136436
            <br><span class="darker">Email:</span>&nbsp;info@flairbureau.com
            <br><span class="darker">Address:</span> 4th Floor Doña Segunda Building, Kamuning Road, Quezon City, Philippines</p>
          <div class="small-tittle">Work hours</div>
          <p class="left"><span class="darker">Monday - Friday:</span> 10:00am - 6:00pm
            <br><span class="darker">Saturday:</span> by appointment
            <br><span class="darker">Sunday:</span> closed</p>
			<div style="display: block; height: auto; max-height: 245px; overflow: hidden; position: relative; z-index: 3;">
				<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script><div style="overflow:hidden;height:245px;width:300px;"><div id="gmap_canvas" style="height:245px;width:300px;"></div><style>#gmap_canvas img{max-width:none!important;background:none!important}</style><a class="google-map-code" href="http://www.mapsembed.com/pixum-gutschein/" id="get-map-data">http://www.mapsembed.com/pixum-gutschein/</a></div><script type="text/javascript"> function init_map(){var myOptions = {zoom:13,center:new google.maps.LatLng(14.62949691516036,121.04224298891609),mapTypeId: google.maps.MapTypeId.ROADMAP};map = new google.maps.Map(document.getElementById("gmap_canvas"), myOptions);marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(14.62949691516036, 121.04224298891609)});infowindow = new google.maps.InfoWindow({content:"<b>Flair Talent Bureau</b><br/>4th Floor Do&ntilde;a Segunda Building, Kamuning Road,<br/> Quezon City, Philippines, Phone: +63 2 413 6436" });google.maps.event.addListener(marker, "click", function(){infowindow.open(map,marker);});}google.maps.event.addDomListener(window, 'load', init_map);</script>
			</div><!-- end locate us on map now div -->
        </div>
      </div>
    </div>
  </section><!-- end contact section -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>