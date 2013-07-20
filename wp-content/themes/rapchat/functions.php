<?php
/*
Author: Eddie Machado
URL: htp://themble.com/bones/
*/
//This theme is built using Bones as a base and adding Foundation 3 by ZURB. All custom functions will be placed at the top of the document, with the Bones functions below.//

//ADD FOUNDATION 3 JAVASCRIPTS AND STYLES//
function responsive_scripts_basic()  
{  
    //register scripts for our theme  
    wp_register_script('foundation-mod', get_template_directory_uri() . '/library/js/modernizr.foundation.js', array( 'jquery' ), true );  
    wp_register_script('foundation-main', get_template_directory_uri() . '/library/js/foundation.min.js', true );  
 
    wp_register_script('foundation-slider', get_template_directory_uri() . '/library/js/jquery.foundation.orbit.js', true );
    wp_register_script('foundation-buttons', get_template_directory_uri() . '/library/js/jquery.foundation.buttons.js', true );
    wp_register_script('foundation-forms', get_template_directory_uri() . '/library/js/jquery.foundation.forms.js', true );
    wp_register_script('foundation-alerts', get_template_directory_uri() . '/library/js/jquery.foundation.alerts.js', true );
    wp_register_script('foundation-accordion', get_template_directory_uri() . '/library/js/jquery.foundation.accordion.js', true );
    wp_register_script('foundation-clearing', get_template_directory_uri() . '/library/js/jquery.foundation.clearing.js', true );
    wp_register_script('foundation-tabs', get_template_directory_uri() . '/library/js/jquery.foundation.tabs.js', true );
    wp_register_script('foundation-navigation', get_template_directory_uri() . '/library/js/jquery.foundation.navigation.js', true );
    wp_register_script('foundation-mediaquery', get_template_directory_uri() . '/library/js/jquery.foundation.mediaQueryToggle.js', true );

    wp_enqueue_script( 'foundation-mod' );  
    wp_enqueue_script( 'foundation-main' );  

    wp_enqueue_script( 'foundation-slider' ); 
    wp_enqueue_script( 'foundation-buttons' ); 
    wp_enqueue_script( 'foundation-forms' );
    wp_enqueue_script( 'foundation-alerts' );
    wp_enqueue_script( 'foundation-accordion' );
    wp_enqueue_script( 'foundation-clearing' );
    wp_enqueue_script( 'foundation-tabs' );
    wp_enqueue_script( 'foundation-navigation' );
    wp_enqueue_script( 'foundation-mediaquery' );

}  
add_action( 'wp_enqueue_scripts', 'responsive_scripts_basic', 5 );  

function responsive_styles()  
{  
    wp_register_style( 'foundation-style', get_template_directory_uri() . '/css/foundation.css', array(), 'all' );  
    wp_register_style( 'foundation-appstyle', get_template_directory_uri() . '/css/app.css', array(), 'all');  
	wp_register_style( 'custom-style', get_template_directory_uri() . '/css/rapchat.css', array(), 'all');  
	wp_enqueue_style( 'custom-style');
    wp_enqueue_style( 'foundation-style' );  
    wp_enqueue_style( 'foundation-appstyle' );  
}  
add_action( 'wp_enqueue_scripts', 'responsive_styles' ); 

// Custom WordPress Admin Styles
	function admin_css() {
	    wp_enqueue_style( 'admin_css', get_template_directory_uri() . '/css/admin.css' );
	}
	add_action('admin_print_styles', 'admin_css' );

function my_login_logo() { ?>
    <style type="text/css">
        body.login div#login h1 a {
            background-image: url(<?php echo get_bloginfo( 'template_directory' ) ?>/images/RapChat-logo.png);
            padding-bottom: 30px;margin-left:50px;background-size:100%;width:230px;height:250px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' ); 

//REMOVE ADMIN MENU ITEMS
function modify_admin_menus(){
	
	remove_menu_page('edit.php'); // Posts
   // remove_menu_page('edit.php?post_type=page'); // Pages
   // remove_menu_page('edit-comments.php'); // Comments
	
	
	remove_submenu_page('themes.php','themes.php');
	
}
add_action( 'admin_menu', 'modify_admin_menus' ); 

//FUNCTION TO LIMIT POST SIZE WITH <PHP ECHO CONTENT(LENGTH)> WITHIN A LOOP
function excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }	
  $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
  return $excerpt;
}
 
function content($limit) {
  $content = explode(' ', get_the_content(), $limit);
  if (count($content)>=$limit) {
    array_pop($content);
    $content = implode(" ",$content).'...';
  } else {
    $content = implode(" ",$content);
  }	
  $content = preg_replace('/\[.+\]/','', $content);
  $content = apply_filters('the_content', $content); 
  $content = str_replace(']]>', ']]&gt;', $content);
  return $content;
}

//SHORTCODES
function green( $atts, $content = null ) {  
    return '<span class="green">'.$content.'</span>';  
}  
add_shortcode("green","green");

//MAIN AJAX FUNCTION
//Setup the AJAX function and callback
add_action('wp_ajax_choose_page', 'choose_page_callback');
//Define The actual AJAX request
function ajax_handle_request(){
    switch($_REQUEST['fn']){
        case 'aboutpageFunction':
        	//Output is set to our loop function below
            $output = ajax_get_page_about($_REQUEST['pageName']);
            break;        
        default:
            $output = 'We&apos;re sorry. An error occured while processing your request. Please try again later.';
            break;
    }

        echo $output;
        //AJAX must die!
        die();
}


//Add actions for this request with or without admin privilidges
add_action('wp_ajax_nopriv_ajax_request', 'ajax_handle_request');
add_action('wp_ajax_ajax_request', 'ajax_handle_request');

//MENTORS AJAX LOOP
//Using the AJAX requested info below to loop in Mentors
function ajax_get_page_about($pageName){
	//cut the URL off of our page name
	$thisName = substr($pageName, 20);
	//blog is a different template, do a test
	if ($thisName !== 'blog'){
			query_posts(array('showposts' => 100, 'post_type' => 'launchpage', 'name' => $thisName, 'post_status' => 'publish'));
	    	if (have_posts()) : while (have_posts()) : the_post();
	    	$name = get_the_title(); 
	    	$content = get_the_content();
	    	endwhile;endif;wp_reset_query();
		//Return the output
		return '<h1>'.$name.'</h1>'.$content;
		}
	else{
		query_posts(array('showposts' => 5, 'post_type' => 'blog','post_status' => 'publish'));
	    	if (have_posts()) : while (have_posts()) : the_post();
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
			$permalink = get_permalink();
			$article = content(100).'<a id="read-more" href="'.$permalink.'">Read More</a>';
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
			return '<div id="content-shifter"><h1>'.Blog.'</h1>'.$output.'</div>';
	}	
	die();
}

/************* INCLUDE NEEDED FILES ***************/

/*
1. library/bones.php
    - head cleanup (remove rsd, uri links, junk css, ect)
	- enqueueing scripts & styles
	- theme support functions
    - custom menu output & fallbacks
	- related post function
	- page-navi function
	- removing <p> from around images
	- customizing the post excerpt
	- custom google+ integration
	- adding custom fields to user profiles
*/
require_once('library/bones.php'); // if you remove this, bones will break
/*
3. library/admin.php
    - removing some default WordPress dashboard widgets
    - an example custom dashboard widget
    - adding custom login css
    - changing text in footer of admin
*/
// require_once('library/admin.php'); // this comes turned off by default
/*
4. library/translation/translation.php
    - adding support for other languages
*/
// require_once('library/translation/translation.php'); // this comes turned off by default

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'bones-thumb-600', 600, 150, true );
add_image_size( 'bones-thumb-300', 300, 100, true );
/* 
to add more sizes, simply copy a line from above 
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 300 sized image, 
we would use the function:
<?php the_post_thumbnail( 'bones-thumb-300' ); ?>
for the 600 x 100 image:
<?php the_post_thumbnail( 'bones-thumb-600' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function bones_register_sidebars() {
    register_sidebar(array(
    	'id' => 'sidebar1',
    	'name' => __('Sidebar 1', 'bonestheme'),
    	'description' => __('The first (primary) sidebar.', 'bonestheme'),
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h4 class="widgettitle">',
    	'after_title' => '</h4>',
    ));
    
    /* 
    to add more sidebars or widgetized areas, just copy
    and edit the above sidebar code. In order to call 
    your new sidebar just use the following code:
    
    Just change the name to whatever your new
    sidebar's id is, for example:
    
    register_sidebar(array(
    	'id' => 'sidebar2',
    	'name' => __('Sidebar 2', 'bonestheme'),
    	'description' => __('The second (secondary) sidebar.', 'bonestheme'),
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h4 class="widgettitle">',
    	'after_title' => '</h4>',
    ));
    
    To call the sidebar in your template, you can just copy
    the sidebar.php file and rename it to your sidebar's name.
    So using the above example, it would be:
    sidebar-sidebar2.php
    
    */
} // don't remove this bracket!

/************* COMMENT LAYOUT *********************/
		
// Comment Layout
function bones_comments($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?>>
		<article id="comment-<?php comment_ID(); ?>" class="clearfix">
			<header class="comment-author vcard">
			    <?php 
			    /*
			        this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
			        echo get_avatar($comment,$size='32',$default='<path_to_url>' );
			    */ 
			    ?>
			    <!-- custom gravatar call -->
			    <?php
			    	// create variable
			    	$bgauthemail = get_comment_author_email();
			    ?>
			    <img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5($bgauthemail); ?>?s=32" class="load-gravatar avatar avatar-48 photo" height="32" width="32" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
			    <!-- end custom gravatar call -->
				<?php printf(__('<cite class="fn">%s</cite>', 'bonestheme'), get_comment_author_link()) ?>
				<time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__('F jS, Y', 'bonestheme')); ?> </a></time>
				<?php edit_comment_link(__('(Edit)', 'bonestheme'),'  ','') ?>
			</header>
			<?php if ($comment->comment_approved == '0') : ?>
       			<div class="alert info">
          			<p><?php _e('Your comment is awaiting moderation.', 'bonestheme') ?></p>
          		</div>
			<?php endif; ?>
			<section class="comment_content clearfix">
				<?php comment_text() ?>
			</section>
			<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		</article>
    <!-- </li> is added by WordPress automatically -->
<?php
} // don't remove this bracket!

/************* SEARCH FORM LAYOUT *****************/

// Search Form
function bones_wpsearch($form) {
    $form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
    <label class="screen-reader-text" for="s">' . __('Search for:', 'bonestheme') . '</label>
    <input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="'.esc_attr__('Search the Site...','bonestheme').'" />
    <input type="submit" id="searchsubmit" value="'. esc_attr__('Search') .'" />
    </form>';
    return $form;
} // don't remove this bracket!


?>
