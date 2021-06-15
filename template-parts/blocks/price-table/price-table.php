<?php

// Create class attribute allowing for custom "className" and "align" values.
$className = 'price-table--';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

// Load values and assign defaults.
$intro = get_field('intro') ?: 'Introduzione...';
$products = get_field('products') ?: false;
?>
<div id="subscribe-block" class="price-table <?php echo esc_attr($className); ?> mt mb">
    <div class="row">
        <div class="column small-12">
            <?php echo $intro; ?>
            <div class="mt--025 mb--025">
                <?php echo countdown('big'); ?>
            </div>
        </div>
    </div>
        <?php echo price_cards($products); ?>

    <div class="row">
        <div class="column small-12">
            <div class="mt--05 price-table__outro">
                <?php the_field('pricetable_outro'); ?>
            </div>
        </div>
    </div>
</div>