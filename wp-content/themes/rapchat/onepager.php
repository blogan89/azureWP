<?php
/*
Template Name: Front Page
*/
?>

<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); 
	
	$bg = get_custom_field('home_bg');
	
?>
	<div id="main-container" style="background-image:url(<?php echo $bg;?>);">
		<a id="logo" href="<?php echo home_url();?>"><img src="<?php echo get_template_directory_uri();?>/images/RapChat-logo.png" title="RapChat - the app to share your rap" alt="RapChat Logo"></a>
			
			<div id="content-frame">
			<h1>About Us</h1>
			<h2>We Are RapChat</h2>
			<p>With the application in the development phase, Rapchat is building up buzz around the release of an app that will connect two major trends in today&apos;s world: rap music and social apps that allow interaction. Rapchat will give people a new, unique way to send messages back and forth with one another by rapping.</p> 
			<p>RapChat LLC is a company that exists to provide an application that will give people a new way to express themselves while interacting with others.  Rapchat recently won first place in the Athens Start Up Weekend contest and has put all winnings towards development.  Links provided below to articles that covered the weekend.</p> 
			</div>
		
		<footer id="footer">
			<ul id="left-links">
				<li><a href="#">About</a></li>
				<li><a href="#">Blog</a></li>
				<li><a href="#">Jobs</a></li>
				<li><a href="#">Contact</a></li>
			</ul>
			<span>&copy; <?php echo date('Y'); ?> RapChat, LLC.</span>
		</footer>
	</div>

<?php endwhile;endif;?>

<script type="text/javascript">
     jQuery(document).ready(function($) {


    });
</script>

</body>
</html>


