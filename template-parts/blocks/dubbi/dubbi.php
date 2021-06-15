<?php

// Create id attribute allowing for custom "anchor" value.
$id = 'dubbi--' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'dubbi--';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

// Load values and assign defaults.
$left_content = get_field('left_content') ?: 'Contenuto sinistro...';
$faqs = get_field('faqs') ?: false;
?>
<div id="<?php echo esc_attr($id); ?>" class="double-column dubbi bg--black <?php echo esc_attr($className); ?>  py--05">
    <div class="row align-top align-justify">
        <div class="column small-12 medium-4 mt--025 mb--025">
            <?php echo $left_content; ?>
        </div>
        <div class="column small-12 medium-6 mt--025 mb--025">
            <?php if($faqs){ ?>
            <ul class="accordion" data-accordion data-allow-all-closed="true">
                <?php foreach($faqs as $faq){ ?>
                <li class="accordion-item" data-accordion-item>
                    <a href="#" class="accordion-title"><?php echo $faq->post_title; ?></a>
                    <div class="accordion-content" data-tab-content>
                        <?php echo apply_filters('the_content', $faq->post_content); ?>
                    </div>
                </li>
                <?php } ?>
            </ul>
            <?php } ?>
        </div>
    </div>
</div>