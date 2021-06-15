<?php
/*
  Johnnyword theme-utility
*/

//
// Path utility functions
//
//function get_form_directory_uri(){  return get_template_directory_uri() . "/include/evo-form"; }
//function get_css_directory_uri(){   return get_template_directory_uri() . "/dist/styles"; }
//function get_images_directory_uri(){ return get_template_directory_uri() . "/dist/images"; }
//function get_js_directory_uri(){ return get_template_directory_uri() . "/dist/js"; }
//function get_bower_components_directory_uri(){ return get_template_directory_uri() . "/src/components"; }


function evo_get_page_meta(){
    global $johnny;

    if($johnny->mode == "WORDPRESS"){
      return array(
        'title' => wp_title('', false),
        'description' => get_post_meta(get_the_ID(), '_yoast_wpseo_metadesc', true)
      );
    }else{
      return array();
    }
}

/*
  Return assets Path based on /dist/assets.json

  es. asset_path(images/ajax-loader.gif)
*/
function asset_path($asset_path){

  $assets_dir_uri = get_template_directory_uri() . '/dist/';
  $assets_paths_file = get_template_directory() . '/dist/assets.json';

  $new_asset_path = $assets_dir_uri . $asset_path;

  if(file_exists($assets_paths_file)){

    $json_content = json_decode(file_get_contents($assets_paths_file), true);

    $new_asset_path = $json_content[$asset_path] ? $assets_dir_uri . $json_content[$asset_path] : $new_asset_path;

  }

  return $new_asset_path;

}


/*
  Excerpt
*/
// Excerpt: Get excerpt by post id
// Return manually edited excerpt if present,
// or wordpress auto computed excerpt form content
function evo_get_excerpt_by_post_id($post_id){
    $current_post = get_post($post_id);

    if($current_post->post_excerpt){
        return $current_post->post_excerpt;
    }else{
        setup_postdata($current_post);
        $current_excerpt = get_the_excerpt();
        wp_reset_postdata();
        return $current_excerpt;
    }
}


// Excerpt: limit length
function evo_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'evo_excerpt_length', 999);



/*
  Various utility functions
*/
function defaultAtts( $pairs, $atts) {
  $atts = (array)$atts;
  $out = array();
  foreach($pairs as $name => $default) {
    if ( array_key_exists($name, $atts) )
      $out[$name] = $atts[$name];
    else
      $out[$name] = $default;
  }
  return $out;
}




//  Low the priority of Yoast SEO
function evo_lower_wpseo_priority( $html ) {
    return 'low';
}
add_filter( 'wpseo_metabox_prio', 'evo_lower_wpseo_priority' );


function _get_img_in_acf_format( $imgID, $imgSizes = array('quad') ){


  foreach ($imgSizes as $imgSize) {

      $imgSrc = wp_get_attachment_image_src( $imgID, $imgSize );

      $imgs[$imgSize] = $imgSrc[0];
      $imgs[$imgSize.'-width'] = $imgSrc[1];
      $imgs[$imgSize.'-height'] = $imgSrc[2];

  }

  $imgAlt = get_post_meta( $imgID, '_wp_attachment_image_alt', true);

  $img = array(
      'sizes' => $imgs,
      'alt' => $imgAlt
  );

  return $img;

}

function _get_img_from_featured_img( $itemID, $imgSizes = array('quad') ){

    $imgs = array();
    $imgID = get_post_thumbnail_id( $itemID );

    // Se non c'è l'id provo con la lingua di default
    if( empty($imgID) && function_exists('icl_object_id') ){

        $postType = get_post_type($itemID);
        $newpostID = icl_object_id($itemID, $postType, true, ORIGINALPOSTLNG);

        $imgID = get_post_thumbnail_id( $newpostID );

    }

    $img = _get_img_in_acf_format( $imgID, $imgSizes );

    return $img;

}



/*
    Fix menu brake Crhome
*/
function chrome_fix() {
    if ( strpos( $_SERVER['HTTP_USER_AGENT'], 'Chrome' ) !== false ){
        wp_add_inline_style( 'wp-admin', '#adminmenu { transform: translateZ(0); }' );
    }
}
add_action('admin_enqueue_scripts', 'chrome_fix');



/*
    Embed wordpress embed in responsive-embed foundation wrapper
*/
function wrap_embed_with_div($html, $url, $attr) {
    return '<div class="responsive-embed widescreen">' . $html . '</div>';
}
add_filter('embed_oembed_html', 'wrap_embed_with_div', 10, 3);



/*
    Estimate post reading time
    returns a string with estimated number of minutes required to read content
*/
function get_post_reading_time($post_id, $words_per_minute = 200, $append = ' min. lettura') {
    $content = get_the_content(null, false, $post_id );
    $total_words = str_word_count( serialize($content) );
    $average_reading_time = ceil( $total_words / $words_per_minute);

    return strval($average_reading_time) . $append;
}



/*
    Remove p tag from images in wiysiwyg editor (content and acf field)
*/
function filter_ptags_on_images($content) {
    $content = preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
    return preg_replace('/<p>\s*(<iframe .*>*.<\/iframe>)\s*<\/p>/iU', '\1', $content);
}
add_filter('acf_the_content', 'filter_ptags_on_images');
add_filter('the_content', 'filter_ptags_on_images');


/*
If you need a category filter in backend for custom post type taxonomies
*/

//Dropdown in admin
/*add_action('restrict_manage_posts', 'evo_filter_post_type_by_taxonomy');
function evo_filter_post_type_by_taxonomy() {
	global $typenow;
  $post_type = ''; // insert to your post type
	$taxonomy  = ''; // insert to your taxonomy
	if ($typenow == $post_type) {
		$selected      = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
		$info_taxonomy = get_taxonomy($taxonomy);
		wp_dropdown_categories(array(
			'show_option_all' => sprintf( __( 'Mostra tutte %s', 'textdomain' ), $info_taxonomy->label ),
			'taxonomy'        => $taxonomy,
			'name'            => $taxonomy,
			'orderby'         => 'name',
			'selected'        => $selected,
			'show_count'      => true,
			'hide_empty'      => true,
		));
	};
}

// Filter posts by taxonomy in admin
add_filter('parse_query', 'evo_convert_id_to_term_in_query');
function evo_convert_id_to_term_in_query($query) {
	global $pagenow;
	$post_type = ''; // insert to your post type
	$taxonomy  = ''; // insert to your taxonomy
	$q_vars    = &$query->query_vars;
	if ( $pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0 ) {
		$term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
		$q_vars[$taxonomy] = $term->slug;
	}
}*/

function ginky_visible_future_box( $query ) {
if ( $query->is_post_type_archive('box') && $query->is_main_query() && !is_admin() ) {
    $query->set( 'post_status', array('publish', 'future') );
    $query->set( 'posts_per_page', -1 );
  }
}
add_action( 'pre_get_posts', 'ginky_visible_future_box' );