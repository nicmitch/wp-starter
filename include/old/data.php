<?php
/*
    Fields defined as acf global fields in WordPress
*/
$wordpress_acf_global_fields = array(
    'logo_header',
    'logo_footer_variant',
    'logo_footer',
    'logo_mail',
    'socials',
    'icons',
    'family_icon',
    'privacy_page',

    'cookies_banner_show',
    'cookies_text',
    'cookies_button_label',

    'gmapapikey',
    'gauacode',
    'gascriptcode',
    'extra_header_code',
    'extra_footer_code',
    'extra_body_top_code',

    'form_intro_content',
    'form_mail_sender',
    'form_mail_recipient',
    'form_mail_recipient_bcc',
    'form_validation_error',
    'form_thankyou_message',
    'form_thankyou',
    'form_privacy_message',
    'form_sendmail_error',
    'form_mail_header',
    'form_mail_footer',
    'form_mail_color',
    'form_newsletter_action',

    'smtp_enabled',
    'smtp_server',
    'smtp_port',
    'smtp_authentication',
    'smtp_username',
    'smtp_password',
    'smtp_secure',
    

    'footer_title',
    'footer_contents',
    'footer_bottom_items',
    'credits'
);

//var_dump($wordpress_acf_global_fields['logo_header']);



/*
    Base data
*/
$data = array(
    'baseurl_css' => get_template_directory_uri() . "/dist/styles",
    'baseurl_js' => get_template_directory_uri() . "/dist/scripts",
    'baseurl_images' => get_template_directory_uri() . "/dist/images",
    'baseurl_fonts' => get_template_directory_uri() . "/dist/fonts"
);



/*
    Header data
*/
$data['sitename'] = get_bloginfo('name');
$data['page_lang'] = get_bloginfo('language');
$data['favicon_url'] = "images/favicon.png";
$data['logo_url'] = "koala1.png";

// Loaded via wp enqueue scripts
$data['cssfiles'] = false;
//'styles/main.css'

// Loaded via wp enqueue scripts
$data['jsfiles'] = false;
//'scripts/main.js'

$data['extra_header'] = "";
$data['body_classes'] = get_body_class('no-js');


/*
    Retrieve all acf global fields defined above
*/
foreach($wordpress_acf_global_fields as $field){
    $data[$field] = get_acf_global_option($field);
}



/*
    Various data
*/
$data['privacy_page_url'] = $data['privacy_page'] ? get_permalink($data['privacy_page']) : '';
$data['template_url'] = get_template_directory_uri();
$data['footer_ajaxUrl'] = admin_url('admin-ajax.php');
$data['google_maps_api_key'] = false;
$data['google_maps_data'] = false;

$data['languages_data'] = get_language_data();


return $data;
