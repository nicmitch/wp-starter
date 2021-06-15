<?php
/*
add_filter( 'woocommerce_add_to_cart_redirect', 'woo__set_last_product_added_to_cart_upon_redirect', 10, 2 );
add_action( 'woocommerce_ajax_added_to_cart',   'woo__set_last_product_added_to_cart_upon_ajax_redirect' );
//add_action( 'woocommerce_after_cart',           'woo__inject_add_to_cart_redirect_event', 10, 2 );

function woo__set_last_product_added_to_cart_upon_redirect(){
  print_r('ciaomerda');
}
*/
//add_action('wp_footer','custom_jquery_add_to_cart_script');
function custom_jquery_add_to_cart_script(){
    
        ?>
            <script type="text/javascript">
                // Ready state
                (function($){ 
                    $( document.body ).on( 'updated_cart_totals', function(e){
                        console.log('EVENT: update cart', e);
                    });

                    $( document.body ).on( 'added_to_cart', function(){
                        console.log('EVENT: added_to_cart');
                    });

                    $( document.body ).on( 'removed_from_cart', function(){
                        console.log('EVENT: removed_from_cart');
                    });

                })(jQuery); // "jQuery" Working with WP (added the $ alias as argument)
            </script>
        <?php
}


//add_action( "wp_footer", "nic_thank_you_script", 10, 1 );
function nic_thank_you_script( $order_id ) {
    
    if(is_checkout() && !empty( is_wc_endpoint_url('order-received')) ){
    ?>

    <script type="text/javascript">
        console.log('ciao order-reveived');
    </script>
            <?php
    }else 
    if(is_checkout() && empty( is_wc_endpoint_url('order-received'))){ ?>
        
    <script type="text/javascript">
        console.log('ciao checkout init');
    </script>

    <?php }
}