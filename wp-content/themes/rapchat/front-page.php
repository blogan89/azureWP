
<?php get_header(); ?>


<div id="main-container" style="background-image:url(<?php echo get_template_directory_uri();?>/images/main-bg.jpg);">
		<a id="logo" href="<?php echo home_url();?>"><img src="<?php echo get_template_directory_uri();?>/images/RapChat-logo.png" title="RapChat - the app to share your rap" alt="RapChat Logo"></a>
			<?php $args = array( 'post_type' => 'launchpage', 'post__in' => array(34) );
			$wp_query = new WP_Query($args);

			if (have_posts()) : while (have_posts()) : the_post();
			?>
			<div id="content-frame">
				<a id="close-out" href="#">X</a>
			<div id="mask">
				<div id="content">
				<?php //OUR FUN AJAX STUFF PRINTS HERE. DEFAULT INFO BELOW (ABOUT US)\\ ?>
				</div>
			</div>
			</div>

			<?php endwhile;endif;?>

<script type="text/javascript">
     jQuery(document).ready(function($) {
	      	
	     $('a#close-out').click(function(){
      		$('#content-frame').fadeOut();
      		$('ul#left-links li.active').removeClass("active");
      		return false;});
	    
	    
	    $('ul#left-links li a').click(function(){
       		//Handle the button state indicator
       		$('ul#left-links li.active').removeClass("active");
       		$(this).parent().addClass("active");
       		//Fade the content
       		$('#content').fadeOut(100);
       		//Our AJAX call
       		$.ajax({
	       		url: '/wp-admin/admin-ajax.php',
	       		type: 'GET',
	       		data: {action: 'ajax_request', fn: 'aboutpageFunction', pageName : $(this).prop('href')},
	       		dataType: 'html',
	       		success: function(data){$('#content-frame').show();$('#content').html(data).fadeIn(800);}
	       		});
       	 return false;
      });

	//ALERT CALL FOR TESTING $('ul#test-links li').click(function(){alert('Check, 1 2');});      

    });
</script>

<?php get_footer(); ?>

