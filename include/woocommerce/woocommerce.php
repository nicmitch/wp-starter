<?php

function mytheme_add_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );

@include 'woocommerce-events.php';
@include 'checkout.php';

/**
 * Set WooCommerce image dimensions upon theme activation
*/
// Remove each style one by one
add_filter( 'woocommerce_enqueue_styles', 'jk_dequeue_styles' );
function jk_dequeue_styles( $enqueue_styles ) {
	unset( $enqueue_styles['woocommerce-general'] );	// Remove the gloss
	unset( $enqueue_styles['woocommerce-layout'] );		// Remove the layout
	//unset( $enqueue_styles['woocommerce-smallscreen'] );	// Remove the smallscreen optimisation
	return $enqueue_styles;
}

function disable_woocommerce_block_editor_styles() {
  wp_deregister_style( 'wc-block-editor' );
  wp_deregister_style( 'wc-block-style' );
}
add_action( 'enqueue_block_assets', 'disable_woocommerce_block_editor_styles', 1, 1 );


// Disable single product page
function single_product_redirect( $query ) {
	
	if( $query->is_main_query() && !is_admin() && $query->get('post_type') == 'product' || 
		$query->is_main_query() && !is_admin() && $query->is_post_type_archive( 'product' ) || 
		$query->is_main_query() && !is_admin() && $query->get('post_id') == wc_get_page_id( 'shop' ) ){
		// send them to home page
		//wp_redirect( get_permalink( wc_get_page_id( 'shop' ) ) );
		wp_redirect( get_bloginfo( 'url' ) );
		exit();
		return $query;
	}
	return $query;
}
add_action('pre_get_posts', 'single_product_redirect');