<?php

/**
 * Image text
*/

// Create id attribute allowing for custom "anchor" value.
$id = 'hero-split--' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'hero-split--';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assign defaults.
$text = get_field('text') ?: 'Block title here...';
$image = get_field('image') ?: 295;

?>
<div id="<?php echo esc_attr($id); ?>" class="hero-split <?php echo esc_attr($className); ?>">
    <div class="row expanded collapse">
        <div class="column small-12 large-5 xlarge-6">
            <div class="hero-split__img" style="background-image: url(<?php echo $image['url']; ?>);"></div>
        </div>
        <div class="column small-12 large-7 xlarge-6">
            <div class="row align-middle align-center">
                <div class="column shrink hero-split__text">
                    <?php echo $text; ?>
                </div>
            </div>
        </div>
    </div>
</div>