<?php
/**
 * The Header for our theme.
 */
?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=9" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>
<?php
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) );

?>
</title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<script type="text/javascript">tmp_uri = "<?php echo get_template_directory_uri(); ?>";</script>

<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js" type="text/javascript"></script>
<![endif]-->
<?php
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	wp_head();
?>
</head>

<body <?php body_class(); ?>>
<div id="menu_section" class="group">
	<div class="main group">
		<figure class="headshot">
			<img alt="iraa's headshot" src="<?php echo get_template_directory_uri(); ?>/img/headshot.jpg?>">
		</figure>
		<div class="circle nav-item circle-1" data-to="welcome">
			<i class="icon-home icon-2x"></i>
		</div>
		<div class="circle nav-item circle-2" data-to="works">
			<i class="icon-briefcase icon-2x"></i>
		</div>
		<div class="circle nav-item circle-3" data-to="skills">
			<i class="icon-lightbulb icon-2x"></i>
		</div>
		<div class="circle nav-item circle-4" data-to="testimonials">
			<i class="icon-smile icon-2x"></i>
		</div>
		<div class="circle nav-item circle-5" data-to="contact">
			<i class="icon-envelope-alt icon-2x"></i>
		</div>
		<div class="circle nav-item circle-6" data-to="meet">
			<i class="icon-map-marker icon-2x"></i>
		</div>
	</div>

	<div class="circle nav-trigger">
		<i class="icon-reorder icon-2x"></i>
	</div>
</div>

<div id="work_preview" class="group"></div>

<div id="main_wrapper">
	<div class="top-line one"></div>
	<div class="top-line two"></div>

	<div id="content_wrapper" class="group">
