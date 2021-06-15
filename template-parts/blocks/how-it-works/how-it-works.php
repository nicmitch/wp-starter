<?php

/**
 * How it works
*/

// Create id attribute allowing for custom "anchor" value.
$id = 'how-it-works--' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'how-it-works--';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

// Load values and assign defaults.
$title = get_field('title') ?: 'Title here...';
$button_label = get_field('button_label') ?: 'Button label...';
$steps = get_field('steps');

?>
<div id="<?php echo esc_attr($id); ?>" class="how-it-works <?php echo esc_attr($className); ?> py--075">
    <div class="row align-justify align-middle">
        <div class="column small-12 text-center">
            <h2><?php echo $title; ?></h2>
        </div>  
        <div class="column small-12">
            <div class="row how-it-works__items">
                <?php foreach($steps as $step){ ?>
                <div class="column small-12 medium-4 text-center mt--025 mb--05">
                    <div class="how-it-works__icon">
                        <?php include get_template_directory() . '/template-parts/icons/'.$step['icon'].'.php'; ?>
                    </div>
                    <h5><?php echo $step['title']; ?></h5>
                    <p><?php echo $step['text']; ?></p>
                </div>
                <?php } ?>
            </div>
        </div>
        <div class="column small-12 text-center">
            <a href="#subscribe-block" class="button">
                <?php _e('Start now', 'Ginky'); ?>
            </a>
        </div>
    </div>
</div>