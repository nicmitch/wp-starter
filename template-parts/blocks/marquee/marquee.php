<?php

/**
 * Image text
*/

// Create id attribute allowing for custom "anchor" value.
$id = 'marquee--' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'marquee--';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

// Load values and assign defaults.
$text = get_field('text') ?: 'Block text here...';

?>
<div id="<?php echo esc_attr($id); ?>" class="marquee <?php echo esc_attr($className); ?>">
    <div class="marquee__inner">
    <?php 
        for($i = 0; $i <= 10; $i++){
        echo $text; 
        }
    ?>
    </div>
</div>