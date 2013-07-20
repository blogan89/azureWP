
<?php get_header(); ?>

<div class="row logo">
	<div class="two columns"></div>
	<div class="eight columns" style="text-align:center;">
	  <img src="<?php echo get_template_directory_uri(); ?>/images/RapChat-icon.png" alt="RapChat - The app for sharing your rap" title="RapChat - The app for sharing your rap"/>
	  <h1>RapChat</h1>
	  <h2>the app to share your rap</h2>
	</div>
	<div class="two columns"></div>
</div>
<div class="row">
<div class="six columns form"><?php echo do_shortcode('[contact-form-7 id="5" title="Join The Beta"]');?></div>
<div class="six columns"><p class="desc">Get ready to chat with your friends...RapChat, that is. We are launching our beta version and would like your help to test it.<br/> So sign up to be the first group for testing the new way to share with your friends.</p>
<p class="developers">Are you an app developer? <a href="/developers-wanted">Click here!</a></p>
</div>
</div>

		
<?php get_footer(); ?>
