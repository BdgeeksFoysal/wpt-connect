<?php

add_theme_support('nav-menus');
add_theme_support('post-thumbnails');
set_post_thumbnail_size( 290, 230, true );

if ( function_exists('register_nav_menus') ) {
	register_nav_menus(array(
		'header_menu' => 'menu in header',
	));
}


//including js and css files in the header for the theme
function include_my_js(){
	//including jquery script explicitly
	//wp_deregister_script("jquery"); 
	//wp_register_script("jquery", "//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js");
	wp_enqueue_script("jquery"); 
	
	//validation plugin for forms
	wp_register_script("mediaquery-script", get_template_directory_uri()."/js/mediaqueries.js");
	wp_enqueue_script("mediaquery-script"); 
	
	//easing plugin
	wp_register_script("easing-script", get_template_directory_uri()."/js/easing.js");
	wp_enqueue_script("easing-script"); 
	
	//plugins
	wp_register_script("plugin-script", get_template_directory_uri()."/js/plugins.js");
	wp_enqueue_script("plugin-script");
	
	//validation plugin for forms
	wp_register_script("validation-script", get_template_directory_uri()."/js/validate.min.js");
	wp_enqueue_script("validation-script"); 
	
	//cycle plugin for sliders
	wp_register_script("cycle-script", get_template_directory_uri()."/js/cycle.js");
	wp_enqueue_script("cycle-script");  
	
	//google maps api
	wp_register_script("google-maps-script", "https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false");
	wp_enqueue_script("google-maps-script");  
	
	//javascript codes for website
	wp_register_script("main-script", get_template_directory_uri()."/js/main.js");
	wp_enqueue_script("main-script"); 
	
	//only incule javascript codes for browsers less than ie 8
	/*if(preg_match('/(?i)msie [1-8]/',$_SERVER['HTTP_USER_AGENT'])){
		wp_register_script("iehack-script", get_template_directory_uri()."/js/ie-hacks.js");
		wp_enqueue_script("iehack-script"); 
	}else{
		// if IE>8 
	}*/

	wp_localize_script( 'main-script', 'Cfa_AJAX', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );

}
function include_my_css(){
	wp_enqueue_style('font-awesome-css', get_template_directory_uri()."/css/font-awesome.css");
	wp_enqueue_style('font-archivo-css', "http://fonts.googleapis.com/css?family=Archivo+Black");
	wp_enqueue_style('font-condiment-css', "http://fonts.googleapis.com/css?family=Condiment");
	wp_enqueue_style('font-noto-css', "http://fonts.googleapis.com/css?family=Noto+Serif:400,700italic,700,400italic");
	wp_enqueue_style('font-roboto-css', "http://fonts.googleapis.com/css?family=Roboto+Slab:700, 400");
}
	

function include_my_admin_css(){
	//wp_register_style("admin-styling", get_template_directory_uri()."/css/admin_panel_style.css");
	//wp_enqueue_style("admin-styling"); 
	
}
function include_my_admin_js(){
	//wp_register_script("admin-javascript", get_template_directory_uri()."/js/admin_javascript.js");
	//wp_enqueue_script("admin-javascript"); 
	
}

add_action( 'wp_enqueue_scripts', 'include_my_js');
add_action( 'wp_enqueue_scripts', 'include_my_css');

//add_action( 'admin_print_styles-post-new.php', 'include_my_admin_css');
//add_action( 'admin_print_styles-post.php', 'include_my_admin_css');
//add_action( 'admin_print_styles-post-new.php', 'include_my_admin_js');
//add_action( 'admin_print_styles-post.php', 'include_my_admin_js');

/*including js and css files for theme ends*/


add_action( 'wp_ajax_get_work', 'get_work_sc_cb' );
add_action( 'wp_ajax_nopriv_get_work', 'get_work_sc_cb' );

function get_work_sc_cb(){
	
	die();
}

require_once("inc/shortcodes.php");
require_once("inc/metabox/metaboxes.php");
?>