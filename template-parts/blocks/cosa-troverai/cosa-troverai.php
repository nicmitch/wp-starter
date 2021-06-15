<?php

// Create id attribute allowing for custom "anchor" value.
$id = 'cosa-troverai--' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'cosa-troverai--';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

// Load values and assign defaults.
$left_content = get_field('left_content') ?: 'Contenuto sinistro...';
$right_content = get_field('right_content') ?: 'Contenuto sinistro...';

?>
<div id="<?php echo esc_attr($id); ?>" class="double-column cosa-troverai bg--black <?php echo esc_attr($className); ?> pt--075 pb--05">
    <div class="row align-middle align-justify">
        <div class="column small-12 medium-4 mb--025">
            <?php echo $left_content; ?>
            <a href="#subscribe-block" class="button show-for-medium"><?php _e('Start now', 'Ginky'); ?></a>
        </div>
        <div class="column small-12 medium-6 mb--025">
            <?php echo apply_filters('post_content', $right_content); ?>
            <a href="#subscribe-block" class="button hide-for-medium"><?php _e('Start now', 'Ginky'); ?></a>
        </div>
    </div>
</div>