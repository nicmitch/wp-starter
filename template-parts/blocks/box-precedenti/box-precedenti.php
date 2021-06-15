<?php

// Create id attribute allowing for custom "anchor" value.
$id = 'box-precedenti--' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'box-precedenti--';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

// Load values and assign defaults.
$items = get_field('pastsbox_items') ?: false;
$right_content = get_field('pastsbox_content') ?: 'Contenuto sinistro...';

?>
<div id="<?php echo esc_attr($id); ?>" class="double-column box-precedenti <?php echo esc_attr($className); ?> py">
    <div class="row row--xl align-justify align-middle">
        <div class="column small-12 medium-5 mb--025">
            <?php echo apply_filters('post_content', $right_content); ?>
            <?php /*<a href="#subscribe-block" class="button"><?php _e('Start now', 'Ginky'); ?></a> */ ?>
        </div>
        <div class="column small-12 medium-6 mt--05 mb--025">
            
            <div class="box-precedenti__text-cont">
                <h4 class="h3"><?php echo $items[0]->post_title; ?> - <?php echo get_the_date('F Y', $items[0]); ?></h4>
                <?php echo $items[0]->post_content ? '<p>' . $items[0]->post_content . '</p>': ''; ?>
            </div>
            <div class="box-precedenti__img-cont">
            <?php 
                if($items){
                    foreach($items as $item){
                    $image = get_the_post_thumbnail($item, 'large'); 
                        ?>
                        <div class="box-precedenti__img--1"><?php echo $image; ?></div>
            <?php }} ?>
            </div>
        </div>
    </div>
</div>