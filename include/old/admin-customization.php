<?php
/*
    Remove comments from admin
*/
function evo_remove_menus(){
  remove_menu_page('edit-comments.php');
}
add_action( 'admin_menu', 'evo_remove_menus' );


/*
    Add infos in admin footer
*/
function remove_footer_admin () {
	echo 'Designed & Developed by <a href="http://www.evostudios.it/" target="_blank">EVO Studios</a></p>';
}
add_filter('admin_footer_text', 'remove_footer_admin');



function annointed_admin_bar_remove() {
  global $wp_admin_bar;

  // Remove their stuff
  $wp_admin_bar->remove_menu('wp-logo');
  
}
add_action('wp_before_admin_bar_render', 'annointed_admin_bar_remove', 0);


////
// Registers an editor stylesheet for the current theme.
////
function jhonny_theme_add_editor_styles() {
    add_editor_style( asset_path( 'css/editor-styles.min.css' ) );
}
add_action( 'after_setup_theme', 'jhonny_theme_add_editor_styles' );


////
// Aggiungo la possibilità di dare una classe agli elementi
////
function my_mce_buttons_2( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}
add_filter('mce_buttons_2', 'my_mce_buttons_2');

////
// Callback function to filter the MCE settings
////
function my_mce_before_init_insert_formats( $init_array ) {
    // Define the style_formats array
    $style_formats = array(
        /*
        array(
            'title' => 'Come h1',
            'selector' => 'h1,h2,h3,h4,h5',
            'classes' => 'h1'
        ),
        array(
            'title' => 'Bottone Arancio',
            'selector' => 'a',
            'classes' => 'button primary'
        ),
        array(
          'title' => 'Testo Rosa',
          'inline' => 'span',
          'classes' => 'txt-color--brand',
        ),
        array(
            'title' => 'Testo sfumato',
            'inline' => 'span',
            'selector' => '',
            'classes' => 'text--gradient',
            'wrapper' => false,
        ),
        array(
            'title' => 'Pre titolo',
            'selector' => 'p,h1,h2,h3,h4,h5',
            'classes' => 'title--pre'
        ),
        */
    );
    // Insert the array, JSON ENCODED, into 'style_formats'
    $init_array['style_formats'] = json_encode( $style_formats );

    return $init_array;

}
add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' );


/*
// STILI LOGO LOGIN
function _swiftTheme_logo() { ?>
    <style type="text/css">
        .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/login-logo.png);
            background-size: 100% auto;
            margin-bottom: 0px;
        }
    </style>
<?php }

// Cambia L'url sul link del logo della login
function _swiftTheme_logo_url() {
    return home_url();
}

// Cambia il title sul link del logo della login
function _swiftTheme_logo_url_title() {
    return get_bloginfo('name');
}
add_action( 'login_enqueue_scripts', '_swiftTheme_logo' );
add_filter( 'login_headerurl', '_swiftTheme_logo_url' );
add_filter( 'login_headertitle', '_swiftTheme_logo_url_title' );
*/
