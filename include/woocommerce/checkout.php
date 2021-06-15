<?php

// Add Custom Field
add_action( 'woocommerce_after_checkout_billing_form', 'ginky_checkout_field' );
function ginky_checkout_field( $checkout ) {

    echo '<p id="ginky_checkout_field">';


    woocommerce_form_field( 'is_gift', array(
        'type'          => 'checkbox',
        'class'         => array('my-field-class form-row-wide'),
        'label'         => __('Is a Gift?', 'Ginky'),
        ), $checkout->get_value( 'is_gift' ));
        
        echo "<div class=\"gift_messagge__container hide\">";
            woocommerce_form_field( 'gift_message', array(
                'type'          => 'textarea',
                'class'         => array('my-field-class form-row-wide'),
                'label'         => __('Gift message', 'Ginky'),
                'placeholder'   => __('Add your custom gift message', 'Ginky'),
                ), $checkout->get_value( 'gift_message' ));
        echo "</div>";

    echo '</p>';

}


/**
 * Update the order meta with field value
 */
add_action( 'woocommerce_checkout_update_order_meta', 'ginky_checkout_field_update_order_meta' );
function ginky_checkout_field_update_order_meta( $order_id ) {
    if ( ! empty( $_POST['is_gift'] ) ) {
        update_post_meta( $order_id, 'is_gift', sanitize_text_field( $_POST['is_gift'] ) );
    }

    if ( ! empty( $_POST['gift_message'] ) ) {
        update_post_meta( $order_id, 'gift_message', sanitize_text_field( $_POST['gift_message'] ) );
    }
}

/**
 * Display field value on the order edit page
 */
add_action( 'woocommerce_admin_order_data_after_billing_address', 'ginky_checkout_field_display_admin_order_meta', 10, 1 );
function ginky_checkout_field_display_admin_order_meta($order){

    $is_gift = get_post_meta( $order->get_id(), 'is_gift', true );

    if($is_gift == true){
        echo '<p><strong>'.__('Is a Gift', 'Ginky').':</strong> si</p>';
        echo '<p><strong>'.__('Gift Message', 'Ginky').':</strong> ' . get_post_meta( $order->get_id(), 'gift_message', true ) . '</p>';
    }
}

/* To use: 
1. Add this snippet to your theme's functions.php file
2. Change the meta key names in the snippet
3. Create a custom field in the order post – e.g. key = "Tracking Code" value = abcdefg
4. When next updating the status, or during any other event which emails the user, they will see this field in their email
*/
add_filter('woocommerce_email_order_meta_keys', 'ginky_order_meta_keys');
function ginky_order_meta_keys( $keys ) {
     $keys[] = 'is_gift';
     $keys[] = 'gift_message';
     return $keys;
}