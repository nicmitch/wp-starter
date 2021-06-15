<?php
/*
function get_block_common_options(){
    $section_align_x = get_sub_field('section_align_x');
    $section_align_y = get_sub_field('section_align_y');

    $options = array(
        'section_id' => get_sub_field('section_id'),
        'pt' => get_sub_field('padding_top'),
        'pb' => get_sub_field('padding_bottom'),
        'wrap' => get_sub_field('wrap'),
        'text_align' => get_sub_field('text_align'),
        'section_align' => array($section_align_x, $section_align_y),
        'content_max_width' => get_sub_field( 'max_width' )
    );

    return $options;
}
*/



function flat_if_array($value){
    return is_array($value) ? $value[0] : $value;
}



function get_gallery_img_size($img_size, $columns = 2){

  if($columns < 2){
    $sizes = array(
      'rect-o' => 'rect-m',
      'rect-v' => 'rect-prod-v',
      'quad' => 'quad-m-cut',
    );
  }else
  if($columns > 2 && $columns < 4){
    $sizes = array(
      'rect-o' => 'rect-s',
      'rect-v' => 'rect-prod-v',
      'quad' => 'quad-s-cut',
    );
  }else{
    $sizes = array(
      'rect-o' => 'rect-s',
      'rect-v' => 'rect-prod-v',
      'quad' => 'quad-xs-cut',
    );
  }

  return $sizes[$img_size];

}



function get_flexible_contents(){
  global $twig;
  $output = array();

  if(have_rows('flexible_contents')){
      while(have_rows('flexible_contents')){
          the_row();

          $layout = get_row_layout();
          // $common_options = get_block_common_options();

          if($layout == 'hero_slider'){
                $block_data = array(
                    'block_type' => 'block-hero-slider'
                );

                $slides = get_sub_field('slides');
                foreach ($slides as $slide) {
                    $slide_data = array();
                    $slide_image = $slide['slide_image'];
                    $slide_data['image'] = $slide_image['sizes']['hero'];
                    $slide_data['title'] = $slide['slide_title'];
                    $slide_data['text'] = $slide['slide_text'];
                    $slide_data['link_url'] = $slide['slide_link_url'];
                    $slide_data['link_text'] = $slide['slide_link_text'];

                    $block_data['slides'][] = $slide_data;
                }

                $output[] = $block_data;


            }elseif($layout == 'hero'){
                $block_data = array(
                    'block_type' => 'block-hero'
                );

                $hero_image = get_sub_field('hero_image');
                $block_data['image'] = $hero_image['sizes']['hero'];
                $hero_image_mobile = get_sub_field('hero_image_mobile');
                $block_data['image_mobile'] = $hero_image_mobile['sizes']['hero_mobile'];
                $block_data['title'] = get_sub_field('hero_title');
                $block_data['text'] = get_sub_field('hero_text');
                $block_data['link_url'] = get_sub_field('hero_link_url');
                $block_data['link_text'] = get_sub_field('hero_link_text');
                $block_data['height'] = get_sub_field("hero_height") ? get_sub_field("hero_height") : "default";

                $output[] = $block_data;


            }elseif($layout == "gallery"){
                $block_data = array(
                    'block_type' => 'block-gallery',
                    'images' => get_sub_field('images')
                );

                $output[] = $block_data;


            }elseif($layout == "gallery_slider"){
                $block_data = array(
                    'block_type' => 'block-gallery-slider',
                    'images' => get_sub_field('images')
                );

                $output[] = $block_data;


            }elseif($layout == "gallery_thumbs"){
                $block_data = array(
                    'block_type' => 'block-gallery-thumbs',
                    'images' => get_sub_field('images')
                );
                $output[] = $block_data;


            }elseif( $layout == 'accordion' ){

            $block_data = array(
                'block_type' => 'block-accordion',
                'additional_class' => '',
                'items' => get_sub_field('panels'),
                'intro' => get_sub_field('intro'),
                'outro' => get_sub_field('outro'),
                'allow_all_closed' => get_sub_field('allow_all_closed'),
                'multi_expand' => get_sub_field('multi_expand'),
            );
            $output[] = $block_data;


        }elseif( $layout == 'block-text-image-v2' ){
            $block_data = array(
                'block_type' => 'block-text-image-v2',
                'content' => get_sub_field('content'),
                'image' => get_sub_field('image'),
                'image_position' => get_sub_field('image_position'),
                'image_layout' => get_sub_field('image_layout'),
                'pt' => get_sub_field('pt'),
                'pb' => get_sub_field('pb'),
            );
            $output[] = $block_data;


        }elseif( $layout == 'text_image' ){
            $block_data = array(
                'block_type' => 'block-text-image',
                'content' => get_sub_field('content'),
                'image' => get_sub_field('image'),
                'image_position' => get_sub_field('image_position'),
                'pt' => get_sub_field('pt'),
                'pb' => get_sub_field('pb'),
            );
            $output[] = $block_data;

        }elseif( $layout == 'block-video' ){
            $block_data = array(
                'block_type' => 'block-video',
                'video_type' => get_sub_field('video_type'),
                'pt' => get_sub_field('pt'),
                'pb' => get_sub_field('pb'),
                'embed' => get_sub_field('embed'),
                'intro' => get_sub_field('intro'),
                'video' => get_sub_field('video')
            );
            $output[] = $block_data;


        }elseif( $layout == 'map' ){

              $map_type = get_sub_field( 'map_type' );

              // Se è il tipo di mappa che usa un embed utilizzo questi campi
              if( $map_type['value'] == 'embed' ){

                  $output[] = array(
                      'block_type' => 'block-map-embed',
                      'embed' => get_sub_field( 'embed' ),
                      'wrap' => get_sub_field('wrap'),
                      'section_id' => get_sub_field('section_id'),
                      'pt' => get_sub_field('padding_top'),
                      'pb' => get_sub_field('padding_bottom')
                  );

              }else{

                  $markers = get_sub_field( 'markers' );

                  $map_id = "map" . rand(10,100);

                  $output[] = array(
                      'block_type' => 'block-google-maps',
                      'items' => $markers,
                      'wrap' => get_sub_field('wrap'),
                      'section_id' => get_sub_field('section_id'),
                      'map_id' => $map_id,
                      'pt' => get_sub_field('padding_top'),
                      'pb' => get_sub_field('padding_bottom')
                  );

                  if($markers){
                      // Valorizzo il parametro per l'inclusione dello script
                      global $globals;
                      $globals['google_maps_data'][] = array(
                        'map_id' => $map_id,
                        'markers' => $markers
                      );
                  }
              }
          } elseif($layout == "text"){
              $block_data = array(
                  'block_type' => 'block-text',
                  'text' => get_sub_field('text'),
                  'pt' => get_sub_field('pt'),
                'pb' => get_sub_field('pb'),
              );

              $output[] = $block_data;


          }
      }
  }

  return $output;
}
