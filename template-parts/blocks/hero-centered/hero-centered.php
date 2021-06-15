<?php

/**
 * Image text
*/

// Create id attribute allowing for custom "anchor" value.
$id = 'hero-centered--' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'hero-centered--';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assign defaults.
$text = get_field('herocentered_text') ?: 'Block title here...';
$image = get_field('herocentered_image') ?: 295;

?>
<div id="<?php echo esc_attr($id); ?>" class="hero-centered <?php echo esc_attr($className); ?>">
    <div class="row expanded align-top align-center collapse text-center">
        <div class="column shrink mt">
            <?php echo $text; ?>
        </div>
        <div class="column small-12 mt--half mt--05">
            <div class="hero-centered__img">
                <?php echo wp_get_attachment_image($image['ID'], 'full'); ?>
            </div>
        </div>
    </div>
</div>