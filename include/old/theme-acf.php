<?php

// Dinamically save acf field group json
// https://www.advancedcustomfields.com/resources/local-json/
add_filter('acf/settings/save_json', 'johnny_acf_json_save_point');

function johnny_acf_json_save_point( $path ) {

  $path = get_stylesheet_directory() . '/include/acf-json';

  return $path;

}

// Dinamically load acf fields json
// https://www.advancedcustomfields.com/resources/local-json/
add_filter('acf/settings/load_json', 'johnny_acf_json_load_point');

function johnny_acf_json_load_point( $paths ) {

  unset($paths[0]);

  $paths[] = get_stylesheet_directory() . '/include/acf-json';

  return $paths;

}


// Create Options page with ACF Pro
if( function_exists('acf_add_options_page') ) {

  acf_add_options_page(array(
    'page_title'  => 'Contenuti globali',
    'menu_title'  => 'Contenuti globali',
    'menu_slug'   => 'evo-global-content',
    'capability'  => 'edit_posts',
    'redirect'    => false
  ));
}

// ACF utility function: check if a field group exists
function is_field_group_exists($value) {
    $exists = false;

    if( $field_groups = acf_get_field_groups() ) {
        foreach ($field_groups as $field_group) {
            if ($field_group['title'] == $value) {
                $exists = true;
            }
        }
    }

    return $exists;
}

// Check existance of certain required field groups
function showAdminMessages_acf(){
	$acf_message = array();
	$url = site_url()."/wp-admin/";

	if( is_plugin_active( 'advanced-custom-fields-pro/acf.php' ) ){

    /*
    // Consiglia import acf field mappa
		if( !is_field_group_exists('Mappa') ){
			$acf_message[] = 'Se il progetto necessita di mappa, ricordati di importare il gruppo di Fields "Mappa" (mappa.acf.json)';
		}
    */

    // Consiglia import acf global fields
		if( !is_field_group_exists('Contenuti globali') ){
			$acf_message[] = 'Attenzione: importa i "Contenuti globali" (global-contents-v2.acf.json)';
		}
	}


  // Mostra messaggi di avviso se presenti
	if(count($acf_message) > 0){
		echo '<div id="message" class="error">';
			foreach($acf_message as $message){
				echo '<p><strong>'.$message.'</strong></p>';
			}
		echo '</div>';
	}

}
add_action('admin_notices', 'showAdminMessages_acf');



// Utility function related to using ACF with WPML plugin installed (and multiple languages defined)
// Restituisce la lingua di default
function cl_acf_set_language() {
    return acf_get_setting('default_language');
}

// Restituisce il field in base alla lingua di default
function get_acf_global_option_default($name) {
  add_filter('acf/settings/current_language', 'cl_acf_set_language', 100);
  $option = get_field($name, 'option');
  remove_filter('acf/settings/current_language', 'cl_acf_set_language', 100);
  return $option;
}


// Restituisce il field globale e in caso non esista resituisce il default
function get_acf_global_option($name){
    $return_field = get_field($name, 'option');

    if(empty($return_field)){
        if ( function_exists('icl_object_id') ) {
            $return_field = get_acf_global_option_default($name);
        }
    }

    return $return_field;
}
