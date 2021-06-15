<?php

/*
	Images sizes
*/
function evo_setup_images_sizes() {
  add_image_size('thumbnail', 275, 170, true);

  /*
  add_image_size('hero', 1920, 0, false);
  add_image_size('hero_mobile', 1200, 1200, false);

  add_image_size('lightbox', 1600, 0, false);

  add_image_size('landscape_166_large', 1200, 450, true);
  add_image_size('landscape_166_medium', 600, 300, true);

  add_image_size('landscape_1610_large', 1200, 750, true);
  add_image_size('landscape_1610_medium', 600, 375, true);

  add_image_size('landscape_169_large', 1200, 675, true);
  add_image_size('landscape_169_medium', 600, 338, true);

  add_image_size('landscape_43_large', 1200, 900, true);
  add_image_size('landscape_43_medium', 600, 450, true);

  add_image_size('landscape_32_large', 1200, 800, true);
  add_image_size('landscape_32_medium', 600, 400, true);

  add_image_size('square_large', 1200, 1200, true);
  add_image_size('square_medium', 800, 800, true);

  add_image_size('portrait_43_medium', 450, 600, true);
  add_image_size('portrait_43_large', 900, 1200, true);
  */
}
add_action( 'after_setup_theme', 'evo_setup_images_sizes' );

function jhonny_custom_image_sizes( $sizes ) {
  return array_merge( $sizes, array(
    //Add your custom sizes here
    //'rect-s' => __( 'Rettangolo S' ),
  ) );
}
add_filter( 'image_size_names_choose','jhonny_custom_image_sizes' );






add_action('print_media_templates', function(){
?>
<script type="text/html" id="tmpl-custom-gallery-setting">

  <?php /*
    <label class="setting">
        <span><?php _e('Text'); ?></span>
        <input type="text" value="" data-setting="ds_text" style="float:left;">
    </label>
    */ ?>

    <label class="setting">
      <span>Tipologia</span>
      <select data-setting="type">
        <option value="grid">Grid</option>
        <option value="slider">Slider</option>
      </select>
    </label>

</script>

<script>

    jQuery(document).ready(function(){
        _.extend(wp.media.gallery.defaults, {
          type: 'grid',
          //ds_bool: false,
          //ds_text1: 'dummdideldei'
        });

        wp.media.view.Settings.Gallery = wp.media.view.Settings.Gallery.extend({
        template: function(view){
          return wp.media.template('gallery-settings')(view)
               + wp.media.template('custom-gallery-setting')(view);
        }
        });

    });

</script>
<?php

});
