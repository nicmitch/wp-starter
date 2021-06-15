<?php
/*
    Page hero:
		- use page featured image as hero image with fallback to a global field
		- no text
*/
function get_page_hero($section_id = 'hero'){

	// Handle hero image with global fallback (default)
	if(get_post_thumbnail_id() != ""){
		$hero_image_src = reset(wp_get_attachment_image_src(get_post_thumbnail_id(), 'heroslide'));
	}else{
		$hero_image_src = get_field('default_contents_hero_image', 'option')['sizes']['heroslide'];
	}

	return array(
		'section_id' => $section_id,
		'image_src' => $hero_image_src,
		'image_alt' => get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true)
	);
}


/*
	block-simple-hero
*/

function get_simple_hero(){
    //$hero_image_field = get_field("hero_image");

    return array(
        "image" => get_field("hero_image")['sizes']['hero'],
        "image_mobile" => get_field("hero_image_mobile")['sizes']['hero_mobile'],
        "title" => get_field("hero_title"),
        "text" => get_field("hero_text"),
        "link_url" => get_field("hero_link_url"),
        "link_text" => get_field("hero_link_text"),
        "is_active" => get_field('hero_is_active'),
        "height" => get_field("hero_height") ? get_field("hero_height") : "default"
    );
}




/*
	block-slideshow-fixed
	block-slideshow-fluid
*/
/*
function get_slideshow(){
	$slides = array();

    if(have_rows('slideshow_slides')){
        while(have_rows('slideshow_slides')){
            the_row();
            $slide = array();
            $slide['image'] = get_sub_field('slideshow_image');
            $slide['image'] = $slide['image']['sizes']['slideshow'];
            //$slide['image'] = $slide['image']['sizes']['hero'];
            $slide['title'] = get_sub_field('slideshow_title');
            $slide['text'] = get_sub_field('slideshow_text');

            $slide['button_url'] = get_sub_field('slideshow_button_url');
            $slide['button_text'] = get_sub_field('slideshow_button_text');
            $slides[] = $slide;
        }
    }

    return $slides;
}
*/



/*
    block-grid-blocks
*/
/*
function get_grid_blocks($page_id){
    $blocks = array();
    while(have_rows('prices_examples_repeater', $page_id)){
        the_row();
        $block_image_field = get_sub_field('prices_examples_image');
        $block_image = array(
            'src' => $block_image_field["sizes"]["block-grid"],
            'lightboxsrc' => $block_image_field["sizes"]["lightbox"],
            'alt' => $block_image_field["alt"]
        );

        $blocks[] = array(
            'image' => $block_image,
            'infos' => array(
                array(
                    'label' => 'Caratteristiche',
                    'value' => get_sub_field('prices_examples_features'),
                ),
                array(
                    'label' => 'Quantità',
                    'value' => get_sub_field('prices_examples_quantities'),
                ),
                array(
                    'label' => 'Prezzo',
                    'value' => get_sub_field('prices_examples_price'),
                )
            )
        );
    }

    return $blocks;
}
*/



/*
  Breadcrumbs utility function
*/
/*
function _get_breadcrumb() {

  $delimiter = '<span>&bull;</span>';
  $home = get_bloginfo("name");
  $before = '<span class="current">';
  $after = '</span>';

  if ( !is_home() && !is_front_page() || is_paged() ) {

    echo '<div id="breadcrumb">';

    global $post;
    $homeLink = get_bloginfo('url');
    echo '<a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';

    if ( is_category() ) {
      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
      if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
      echo $before . single_cat_title('', false) . $after;

    } elseif ( is_day() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('d') . $after;

    } elseif ( is_month() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('F') . $after;

    } elseif ( is_year() ) {
      echo $before . get_the_time('Y') . $after;

    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
        echo $before . get_the_title() . $after;
      } else {
        $cat = get_the_category(); $cat = $cat[0];
        echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
        echo $before . get_the_title() . $after;
      }

    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
      $post_type = get_post_type_object(get_post_type());
      echo $before . $post_type->labels->singular_name . $after;

    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
      echo $before . get_the_title() . $after;

    } elseif ( is_page() && !$post->post_parent ) {
      echo $before . get_the_title() . $after;

    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
      echo $before . get_the_title() . $after;

    } elseif ( is_search() ) {
      echo $before . get_search_query() . $after;

    } elseif ( is_tag() ) {
      echo $before . single_tag_title('', false) . $after;

    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $before . $userdata->display_name . $after;

    } elseif ( is_404() ) {
      echo $before . 'Error 404' . $after;
    }

    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('Page') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }

    echo '</div>';

  }
}
*/
