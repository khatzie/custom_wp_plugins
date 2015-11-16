<?php
get_header(); ?>
<div id="first" class="story home-bg" data-speed="8" data-type="background">
<div class="main-container">
<div class="home" >
<div class="intro-name wow slideInLeft animated" data-wow-delay="1s"><span class="iam">I AM</span> <header><h1 class="name">KATHERINE PETALIO.</h1></header> </div>
<div class="my-image"><img src="<?php echo get_template_directory_uri(); ?>/images/me.jpg" width="1048px" alt="Katherine Petalio"></div>
<div class="intro wow slideInDown animated entry-content" data-wow-delay="1s"><?php bloginfo( 'description' ); ?></div>
<div class="btn-container"><a href="#second" class="smoothScroll"><button class="start-tour-btn">EXPLORE</button></a></div>
</div>
</div>
</div>
<div id="second" class="story grey-bg" data-speed="4" data-type="background">
<div class="main-container" id="featured-works">
<div class="title grey wow slideInLeft animated" data-wow-offset="200">MY FEATURED WORKS</div>
<div id="mainwrapper">
<ul class="projects-list">
<?php
$args = array(
'post_type' => 'featured_works',
'paged' => $paged,
'post_status' => 'publish',
'orderby' =>  'date',
'order' => 'DESC'
);
$wp_query = new WP_Query($args);
$ctr = 0;
?>
<?php if (have_posts()) : ?>
<?php while(have_posts()): the_post(); $ctr = $ctr + 1; $myTags = "";?>
<li>
<div id="box-6" class="box wow flipInX animated" data-wow-delay="0.2s" >
<?php
if( class_exists( 'kdMultipleFeaturedImages' ) ) {
	kd_mfi_the_featured_image( 'featured-image-2', 'featured_works' );
}
?>
<span class="caption scale-caption">
<h3 class="project-title"><?php the_title(); ?></h3>
<p class="short-desc"><?php echo get_the_excerpt(); ?></p>
<div class="tags"><div class="icon-tags"> </div> <div class="tags-text">
<?php $posttags = get_the_tags(); if ($posttags) { foreach($posttags as $tag) { $myTags = $myTags."".$tag->name . ', '; } echo chop($myTags, ", "); } ?>
</div></div>
<button class="details-btn" id="trigger-overlay<?php echo $ctr; ?>" name="<?php echo $ctr; ?>"> </button>
</span>
</div>
</li>
<?php endwhile;?>
<?php endif; ?>
</ul>
</div>
</div>
</div>
<div id="third" class="story white-bg" data-speed="6" data-type="background" data-offsetY="250">
<div class="main-container" id="coding">
<div class="title pink wow rollIn animated">CODING & UI's</div>
<div class="camera_wrap camera_magenta_skin" id="camera_wrap_2">
<div data-thumb="<?php echo get_template_directory_uri(); ?>/images/validation.jpg" data-src="<?php echo get_template_directory_uri(); ?>/images/validation.jpg" >
<div class="camera_caption fadeFromBottom">
<div class="ui-details">
<p class="ui-title">Simple Form Validation</p>
<p class="ui-desc">This are the common fields used in a form. Its my own code created from scratch I used Javascript for this validation. You can freely modify my code if you want. This validation works in IE, Chrome, and Mozilla I haven't tried in Opera and other browser, but I think it will work.</p>
<p class="ui-desc">Validation sometimes may depend on your website needs or your client request. </p>
<div class="button-container">
<a href="http://demos.katherinepetalio.url.ph/validation/" target="_blank"><button class="demo-btn"></button></a>
<a href="UI/downloads.php?path=archive/&download=validation.js"><button class="download-btn"></button></a>
</div>
</div>
</div>
</div>
<div data-thumb="<?php echo get_template_directory_uri(); ?>/images/dragdrop.jpg" data-src="<?php echo get_template_directory_uri(); ?>/images/dragdrop.jpg" class="codingUI">
<div class="camera_caption fadeFromBottom">
<div class="ui-details">
<p class="ui-title">Drag and Drop, Autosave Database</p>
<p class="ui-desc">A drag and drop UI used JQUERY UI, PHP, and MySQL Database. This simple program autosave the position of the item once you drag it in a certain position. This is not my own code I just made some sort of modification need in my project. This drag and drop works in IE, Chrome, and Mozilla but the auto save function doesn't work in IE. For the database table it only needs three(3) important fields id, title, and position.</p>
<div class="button-container">
<a href="http://demos.katherinepetalio.url.ph/dragdrop/" target="_blank"><button class="demo-btn"></button></a>
<a href="UI/downloads.php?path=archive/&download=drag-drop.rar"><button class="download-btn"></button></a>
</div>
</div>
</div>
</div>
</div>
<div class="camera_wrap camera_magenta_skin" id="camera_wrap_3" style="display: none;">
<div data-thumb="<?php echo get_template_directory_uri(); ?>/images/validation-js2.png" data-src="<?php echo get_template_directory_uri(); ?>/images/validation-js2.png" >
<div class="camera_caption fadeFromBottom">
<div class="ui-details">
<p class="ui-title">Simple Form Validation</p>
<p class="ui-desc">This are the common fields used in a form. Its my own code created from scratch I used Javascript for this validation. You can freely modify my code if you want. This validation works in IE, Chrome, and Mozilla I haven't tried in Opera and other browser, but I think it will work.</p>
<p class="ui-desc">Validation sometimes may depend on your website needs or your client request. </p>
<div class="button-container">
<a href="http://demos.katherinepetalio.url.ph/validation/" target="_blank"><button class="demo-btn"></button></a>
<a href="UI/downloads.php?path=archive/&download=validation.js"><button class="download-btn"></button></a>
</div>
</div>
</div>
</div>
<div data-thumb="<?php echo get_template_directory_uri(); ?>/images/dragdrop2.png" data-src="<?php echo get_template_directory_uri(); ?>/images/dragdrop2.png" class="codingUI">
<div class="camera_caption fadeFromBottom">
<div class="ui-details">
<p class="ui-title">Drag and Drop, Autosave Database</p>
<p class="ui-desc">A drag and drop UI used JQUERY UI, PHP, and MySQL Database. This simple program autosave the position of the item once you drag it in a certain position. This is not my own code I just made some sort of modification need in my project. This drag and drop works in IE, Chrome, and Mozilla but the auto save function doesn't work in IE. For the database table it only needs three(3) important fields id, title, and position.</p>
<div class="button-container">
<a href="http://demos.katherinepetalio.url.ph/dragdrop/" target="_blank"><button class="demo-btn"></button></a>
<a href="UI/downloads.php?path=archive/&download=drag-drop.rar"><button class="download-btn"></button></a>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div id="fourth" class="story aboutme" data-speed="8" data-type="background">
<div class="main-container" id="about-me">
<div class="title white wow slideInDown animated">A LITTLE ABOUT ME</div>
<div class="projects">
<div class="about-me">
<div class="my-pix wow flipInX animated" ><img src="<?php echo get_template_directory_uri(); ?>/images/ako.png" width="254px" height="260px" alt="Katherine Petalio"></div>
<p class="wow slideInRight animated">I was born in my home town at Camarines Sur, Philippines, Bicol Region. I’m presently residing at Manila, Philippines. I have my Bachelor’s degree in Information Techonology at Camarines Sur Polytechnic College. I’m currently working as a Web Developer, and an iOS Developer at Web Outsourcing Gateway Inc. I love the current company that I’m working with, they give me the opportunity to explore and enhance my skills. </p>
<p class="wow slideInRight animated">I make coding as my past time I’d like to think possibilities that I could put a website into, it’s where my passion lies. I also read blogs related in web development and other program that I’m engaged with.</p>
</div>
<div class="quote wow pulse" data-wow-duration="1s" data-wow-delay="0.6s">“ If you love what your doing, you will always find a way to motivate and improve. ”</div>
</div>
</div>
</div>
<div id="sixth" class="story grey-bg" data-speed="4" data-type="background">
<div class="main-container" id="contact">
<div class="title grey wow fadeInRight animated" data-wow-offset="300">REACH ME THROUGH</div>
<div class="intro-email wow bounceInLeft animated" data-wow-offset="300">You can send me an email at</div>
<div class="my-email wow slideInRight animated"><a href="mailto:katherine.petalio@gmail.com">katherine.petalio@gmail.com</a></div>
<div class="intro-social wow slideInLeft" data-wow-duration="0.2s">Feel free to follow me on</div>
<div align="center" class="socal-container">
<ul class="social">
<li><a href="https://www.facebook.com/katherinepetalio"><div class="fb wow flipInX animated" data-wow-delay="0.4s"> </div></a></li>
<li><a href="http://www.behance.net/khatz0406"><div class="behance wow flipInX animated" data-wow-delay="0.6s"> </div></a>
<li><a href="http://www.linkedin.com/in/katherinepetalio"><div class="linkedin wow flipInX animated" data-wow-delay="0.8s"> </div></a></li>
<li><a href="https://instagram.com/khatz0908"><div class="instagram wow flipInX animated" data-wow-delay="1s"> </div></a></li>
<li><a href="https://twitter.com/khier19"><div class="twitter wow flipInX animated" data-wow-delay="1.2s"> </div></a></li>
<li><a href="https://plus.google.com/112397717322942657658"><div class="google wow flipInX animated" data-wow-delay="1.4s"> </div></a></li>
</ul>
</div>
</div>
</div>
<?php get_footer(); ?>