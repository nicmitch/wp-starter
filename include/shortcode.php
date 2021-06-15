<?php
/*
    Form shortcode
*/
function shortcode_form($atts = null) {
  global $johnny;
  if(!$johnny){
    $johnny = new Johnny();
  }
  $globals = $johnny->globals;
  $twig = $johnny->twigSetup();
  //$wp = $globals['tpx'];

  global $sitename;
  $sitename = empty($sitename) ? get_bloginfo('name') : $sitename;

  $a = defaultAtts( array(
      'subject' => "[$sitename] Richiesta informazioni dal sito",
      'submit_button_text' => "Invia richiesta",
      'recipient' => $globals["form_mail_recipient"],
      'recipient_bcc' => $globals["form_mail_recipient_bcc"],
      'mail_message_header' => $globals["form_mail_header"],
      'mail_message_footer' => $globals["form_mail_footer"],
      'section' => get_the_title(),
      'form_is_ajax' => 1,
      'form_type' => 'default',
      'form_action' => get_template_directory_uri() . '/include/evo-form/sendmail_wp.php',
      'id' => 'contact-form'
      
  ), $atts );

  return $twig->render(
      'components/form_' . $a['form_type'] . '.twig',
      array(
        'form_intro_content' => $globals['form_intro_content'],
          'subject' => $a['subject'],
          'submit_button_text' => $a['submit_button_text'],
          'recipient' => $a['recipient'],
          'recipient_bcc' => $a['recipient_bcc'],
          'section' => $a['section'],
          'sitename' => $sitename,
          'privacyUrl' => $globals["privacy_page_url"],
          'thankyouUrl' => $globals["form_thankyou"],
          'mail_message_header' => $a['mail_message_header'],
          'mail_message_footer' => $a['mail_message_footer'],
          'form_action' => $a['form_action'],
          // 'globals' => $globals,
          //'wp' => $wp,
          'form_privacy_message' => $globals['form_privacy_message'],
          'form_validation_error' => $globals['form_validation_error'],
          'form_thankyou_message' => $globals['form_thankyou_message'],
          'id' => $a['id'],
          'form_is_ajax' => $a['form_is_ajax'],
      )
  );

}
add_shortcode( 'form', 'shortcode_form');


function countdown_shortcode(){

  return countdown();

}
add_shortcode('countdown', 'countdown_shortcode');


function language_selector_fn($atts = array()){

  return language_selector($atts);

}
add_shortcode('language_selector', 'language_selector_fn');


function current_month_fn($atts = array()){

  // Estraggo il locale code
  $languages = apply_filters( 'wpml_active_languages', NULL );
  foreach($languages as $l) {
    if ($l['active']) { $locale = $l['default_locale']; break; }
  }

  // Setto il locale
  setlocale(LC_TIME, $locale);
  date_default_timezone_set('Europe/Rome');

  // Ritorno il mese
  return strftime( '%B', strtotime( '+1 month' ) );
}
add_shortcode('current_month', 'current_month_fn');


/*
    Gallery shortcode
*/
/*
function new_gallery($atts, $content = null){
  $johnny = new Johnny();
  $globals = $johnny->globals;
  $twig = $johnny->twigSetup();

  extract( shortcode_atts( array(
  'ids' => '',
  'size' => "thumbnail",
  'link' => "attachment",
  'columns' => 3,
  'type' => 'grid',
  'id' => ''
  ), $atts));

  $idsArr = explode(',', $ids);

  $imgs = array();

  foreach ($idsArr as $id) {

    $imgs[] = _get_img_in_acf_format( $id, array($size, 'large' ) );

  }

  $gallery_data = array(
    'items' => $imgs,
    'img_size' => $size,
    'type' => $type,
    'columns_number' => $columns,
    'lightbox' => $link == 'attachment' ? true : false,
    'gallery_id' => $id,
    'content_max_width' => 'no',
    'show_title' => false,
    'show_caption' => false
  );

  return $twig->render(
      'components/gallery.twig', $gallery_data
  );

}
remove_shortcode('gallery');
add_shortcode('gallery', 'new_gallery');
*/




/*
    Icon shortcode
*/
function evo_icon_in_content($atts = null){
    $a = defaultAtts( array(
        'icon' => ''
    ), $atts);

    if($a['icon'] != ''){
        return "<div class=\"icon-in-content\"><i class=\"fas fa-" . $a["icon"] . "\"></i></div>";
    }

    return '';

}
add_shortcode('icon', 'evo_icon_in_content');





/*
    Socials shortcode: print twig template
*/
function socials_shortcode($atts = null){

  $socials = array(
    array('fb', 'https://www.facebook.com/ginkybox'),
    array('ig', 'https://www.instagram.com/ginkybox/'),
    array('sf', 'https://open.spotify.com/playlist/2SY9B0TYJmxCjFPfgtU4S7'),
  );

  $url = get_template_directory() . '/template-parts/icons/icon-';
  
  $output = "";
  $output .= "<ul class=\"menu horizontal\">";
    foreach($socials as $social){

      $icon = asset_path('images/icon-'.$social[0].'.svg');

      $output .= "<li><a href=\"{$social[1]}\" target=\"_blank\" rel=\"noopener\"><img src=\"{$icon}\" width=\"22\" height=\"22\" alt=\"{$social[0]} social icon\"></a></li>";
    }
  $output .= "</ul>";

  echo $output;

}
add_shortcode('socials', 'socials_shortcode');



/*
    Shortocode that create a div with custom class
*/
function div_html($atts, $content = null) {
     
  extract( shortcode_atts( array(
      'class' => '',
  ), $atts ) );

  $class = $class ? " class=\"$class\"" : NULL;
   
  return "<div$class>$content</div>";
}
add_shortcode('div', 'div_html');
