<?php

function countdown($style = ''){

    $items_wrap = $style == 'big' ? "<div class=\"countdown__inner row align-center\">" : '';
    $items_wrap_cl = $style == 'big' ? "</div>" : '';

    $item_wrap = $style == 'big' ? "<div class=\"countdown__item column shrink\">" : '';
    $item_wrap_cl = $style == 'big' ? "</div>" : '';

    $label_wrap = $style == 'big' ? "<div class=\"countdown__description\">" : '';
    $label_wrap_cl = $style == 'big' ? "</div>" : '';

    $items = array(
        array('slug' => 'days', 'label' => __('Days', 'Ginky')),
        array('slug' => 'hours', 'label' => __('Hours', 'Ginky')),
        array('slug' => 'minutes', 'label' => __('Minutes', 'Ginky')),
        array('slug' => 'seconds', 'label' => __('Seconds', 'Ginky')),
    );

    $output = "";

    $output .= "<span class=\"countdown countdown--{$style}\">";

        $output .= $items_wrap;
        
        foreach($items as $item){
            $output .= $item_wrap;
                $output .= "<span class=\"countdown__output countdown__output--{$item['slug']}\"></span>"; 
                $output .= $label_wrap . ' ' .$item['label'] . ' ' . $label_wrap_cl;
            $output .= $item_wrap_cl;
        }

        $output .= $items_wrap_cl;
    $output .= "</span>";

    return $output;
}

