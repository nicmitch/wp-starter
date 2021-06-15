<?php
/*
    Disable WordPress big image downscaling feature?

    WordPress 5.3 introduced big image downscaling feature
    that basically resizes the images above certain threshold during the upload.

    https://make.wordpress.org/core/2019/10/09/introducing-handling-of-big-images-in-wordpress-5-3/
    https://darkog.com/blog/how-to-disable-wordpress-5-3-image-downscaling-feature/
*/
// add_filter('big_image_size_threshold', '__return_false');



/*
  Hide admin bar?
*/
show_admin_bar(false);


////
//  Theme assets
////
add_action('wp_enqueue_scripts', function () {

  global $globals;

  wp_enqueue_style( 'theme/main.css', asset_path('css/main.min.css'), false, null);
  wp_enqueue_script( 'theme/main.js', asset_path('js/app.min.js'), ['jquery'], null, true);
}, 100);


////
//  Disable gutenberg style in Front
////
function wps_deregister_styles() {
  wp_dequeue_style( 'wp-block-library' );
}
add_action( 'wp_print_styles', 'wps_deregister_styles', 100 );


function disable_emojis() {
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  //remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  //remove_action( 'admin_print_styles', 'print_emoji_styles' );
  //remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  //remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
  //remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  //add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
  //add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
}
add_action( 'init', 'disable_emojis' );



//	Theme Activation function
// triggered on the request immediately following a theme switch.
function _johnnyword_on() {

	// Setup permalink with postname
    global $wp_rewrite;
    $wp_rewrite->set_permalink_structure('/%postname%/');
    $wp_rewrite->flush_rules();

}
add_action( 'after_switch_theme', '_johnnyword_on' );



//	Theme Inizialization function
//	Called during each page load, after the theme is initialized
function _johnnyword_setup() {

	// Enabled post thumbnail
	if ( function_exists( 'add_theme_support' ) ) {
		add_theme_support( 'post-thumbnails' );
	}

	// Enabled page Excerpt
	//add_post_type_support( 'page', 'excerpt' );
}
add_action( 'after_setup_theme', '_johnnyword_setup' );