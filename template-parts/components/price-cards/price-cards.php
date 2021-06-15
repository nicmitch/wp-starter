<?php

function price_cards($products){

    //$button_label = __('Subscribe now', 'Ginky');
    $button_label = __('Order now', 'Ginky');

    ob_start(); ?>
    <div class="swiper-container price-cards">
        <div class="swiper-wrapper">
        
        <?php foreach($products as $product){ 

            $product_obj = wc_get_product( $product->ID );
            $product_label = get_field('prod_label', $product);
        ?>
            <div class="swiper-slide">
                <div class="price-cards__item">
                    <?php if($product_label){ ?>
                        <div class="price-cards__label">
                            <div class="price-cards__label-text">
                                <?php echo $product_label; ?>
                            </div>
                            <div class="price-cards__label-bg">
                                <img src="<?php echo asset_path('images/label.svg'); ?>" width="70" height="70" alt="Label bg">
                            </div>
                        </div>
                    <?php } ?>
                    <small><?php echo get_field('prod_nicename', $product); ?></small>
                    <h3><?php echo get_field('prod_shortname', $product); ?></h3>
                    <?php echo apply_filters( 'the_content', $product->post_content ); ?>

                    <div class="price-cards__price"><?php echo $product_obj->get_price(); ?> <span><?php echo get_woocommerce_currency_symbol() ?></span></div>
                    <div class="price-cards__details"><?php echo $product->post_excerpt; ?></div>
                    <div class="price-cards__action">
                        <a href="<?php echo wc_get_cart_url('url'); ?>?add-to-cart=<?php echo $product->ID; ?>" class="button"><?php echo $button_label; ?></a>
                    </div>
                </div>
            </div>
        <?php } ?>
        </div>
    </div>

<?php
    return ob_get_clean();
}