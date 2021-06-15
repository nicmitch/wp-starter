<?php

add_action('acf/init', 'nico_init_block_types');
function nico_init_block_types() {

    // Check function exists.
    if( function_exists('acf_register_block_type') ) {

        acf_register_block_type(array(
            'name'              => 'hero-split',
            'title'             => __('Hero split'),
            'description'       => __('A custom hero block.'),
            'render_template'   => 'template-parts/blocks/hero-split/hero-split.php',
            'category'          => 'formatting',
            'icon'              => 'align-pull-left',
            'keywords'          => array( 'split', 'hero', 'text', 'image' ),
        ));

        acf_register_block_type(array(
            'name'              => 'hero-centered',
            'title'             => __('Hero centered'),
            'description'       => __('A custom hero block.'),
            'render_template'   => 'template-parts/blocks/hero-centered/hero-centered.php',
            'category'          => 'formatting',
            'icon'              => 'align-pull-left',
            'keywords'          => array( 'centered', 'hero', 'text', 'image' ),
        ));

        acf_register_block_type(array(
            'name'              => 'marquee',
            'title'             => __('Marquee'),
            'description'       => __('A custom marquee.'),
            'render_template'   => 'template-parts/blocks/marquee/marquee.php',
            'category'          => 'formatting',
            'icon'              => 'button',
            'keywords'          => array( 'marquee', 'testo', 'carousel', 'banner' ),
        ));

        acf_register_block_type(array(
            'name'              => 'how-it-works',
            'title'             => __('Come funziona'),
            'description'       => __('A custom block.'),
            'render_template'   => 'template-parts/blocks/how-it-works/how-it-works.php',
            'category'          => 'formatting',
            'icon'              => 'button',
            'keywords'          => array( 'how', 'it', 'works', 'nero' ),
        ));

        acf_register_block_type(array(
            'name'              => 'price-table',
            'title'             => __('Blocco prezzi e abbonamenti'),
            'description'       => __('A custom block.'),
            'render_template'   => 'template-parts/blocks/price-table/price-table.php',
            'category'          => 'formatting',
            'icon'              => 'button',
            'keywords'          => array( 'prezzi', 'abbonamenti', 'iscrizione', '' ),
        ));

        acf_register_block_type(array(
            'name'              => 'cosa-troverai',
            'title'             => __('Blocco cosa troverai'),
            'description'       => __('A custom block.'),
            'render_template'   => 'template-parts/blocks/cosa-troverai/cosa-troverai.php',
            'category'          => 'formatting',
            'icon'              => 'button',
            'keywords'          => array( 'cosa troverai' ),
        ));

        acf_register_block_type(array(
            'name'              => 'dubbi',
            'title'             => __('Blocco dubbi'),
            'description'       => __('A custom block.'),
            'render_template'   => 'template-parts/blocks/dubbi/dubbi.php',
            'category'          => 'formatting',
            'icon'              => 'button',
            'keywords'          => array( 'dubbi' ),
        ));

        acf_register_block_type(array(
            'name'              => 'box-precedenti',
            'title'             => __('Blocco box precedenti'),
            'description'       => __('A custom block.'),
            'render_template'   => 'template-parts/blocks/box-precedenti/box-precedenti.php',
            'category'          => 'formatting',
            'icon'              => 'button',
            'keywords'          => array( 'box precedenti' ),
        ));
    }
}


// Create Options page with ACF Pro
if( function_exists('acf_add_options_page') ) {

  acf_add_options_page(array(
    'page_title'  => 'Contenuti globali',
    'menu_title'  => 'Contenuti globali',
    'menu_slug'   => 'evo-global-content',
    'capability'  => 'edit_posts',
    'redirect'    => false
  ));
}