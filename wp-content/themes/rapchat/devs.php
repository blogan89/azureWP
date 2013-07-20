<?php 
/*
Template Name: Developer Search
*/

get_header(); ?>

<div class="row logo">
	<div class="two columns"></div>
	<div class="eight columns" style="text-align:center;">
	 <a href="<?php echo home_url();?>"> <img src="<?php echo get_template_directory_uri(); ?>/images/RapChat-icon.png" alt="RapChat - The app for sharing your rap" title="RapChat - The app for sharing your rap"/></a>
	  <h1>RapChat</h1>
	  <h2>the app to share your rap</h2>
	</div>
	<div class="two columns"></div>
</div>
<div class="row">
<div class="twelve columns"><p class="desc">RapChat is looking to partner with some developers to help in the process of builing our app and tweaking it to a final state. If you are interested, please complete the form below.<br/> Our preferred candidates will have the following qualities:</p>
<ul style="list-style:disc;"><li>Skilled in iOS or Android programming languages</li><li>Experience with user login systems</li><li>Examples of past work</li><li>Live in or around Ohio</li></ul>
<p class="desc">You may also attach a resume to this form for reference. We will be contacting all potential candidates to begin the recruiting process.<br/>Thank you for your interest in RapChat</p>
</div>
<div class="twelve columns form"><?php echo do_shortcode('[contact-form-7 id="6" title="Developers"]');?></div>
</div>

		
<?php get_footer(); ?>
