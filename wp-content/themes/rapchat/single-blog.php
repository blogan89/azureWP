
<?php get_header(); ?>


<div id="main-container" style="background-image:url(<?php echo get_template_directory_uri();?>/images/main-bg.jpg);">
		<a id="logo" href="<?php echo home_url();?>"><img src="<?php echo get_template_directory_uri();?>/images/RapChat-logo.png" title="RapChat - the app to share your rap" alt="RapChat Logo"></a>
			<div id="content-frame">
				<a id="close-out" href="#">X</a>
			<div id="mask">
				<div id="content">
			<?php if (have_posts()) : while (have_posts()) : the_post();
	    	$title = get_the_title();
	    	$ID = get_the_ID();
	    	$sourceURL = get_custom_field('blog_source');
			$author = get_custom_field('blog_extauth');
				//author test
				if ($author == ""){$authorInfo = 'Posted by: '.get_the_author();}
				else{$authorInfo = 'Orignial Author: '.$author.' <a href="'.$sourceURL.'" target="_blank">(Source)</a>';}
			$date = get_the_time('F jS, Y');
			$category = get_the_category_list();
			$imageURL = get_custom_field('blog_image');
				//image test
				if ($imageURL == ""){$image = "";}
				else{
					$image = '<img src="'.$imageURL.'" alt="'.$title.' - Featured Image" class="featured-image" />';
					}
			$article = get_the_content();
			$output .= '
			<article class="blog">
			<h2 class="article-title">'.$title.'</h2>
		<ul class="meta">
			<li>Posted: '.$date.'</li>
			<li>'.$authorInfo.'</li>
			<li>Category: '.$category.'</li>
		</ul>
		'.$image.'
		'.apply_filters('the_content', $article).'
		
		</article>';
			endwhile;endif;wp_reset_query();
			//Return the output
			echo '<div id="content-shifter"><h1>'.Blog.'</h1>'.$output.'</div>';
			?>
				</div>
			</div>
			</div>

<script type="text/javascript">
     jQuery(document).ready(function($) {
	     $('#content-frame').fadeIn(1200); 
	      	
	     $('a#close-out').click(function(){
      		$('#content-frame').fadeOut();
      		$('ul#left-links li.active').removeClass("active");
      		return false;});
	    
	    
	   /* $('ul#left-links li a').click(function(){
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
      });*/
      
      $('#content-frame #content #mask article #read-more').click(function(){alert ('woah!');return false;});

	//ALERT CALL FOR TESTING $('ul#test-links li').click(function(){alert('Check, 1 2');});      

    });
</script>
<?php get_footer(); ?>

