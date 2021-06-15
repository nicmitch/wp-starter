<?php

function language_selector($atts){

    $lngs = apply_filters( 'wpml_active_languages', NULL, 'orderby=id&order=desc' );

    ob_start(); ?>

    <span class="language-selector">
        <?php if(isset($atts['type']) && $atts['type'] == 'linear' && $lngs){ ?>
            <?php foreach($lngs as $lng){ ?>
                <a href="<?php echo $lng['url']; ?>" class="<?php echo $lng['code'] == ICL_LANGUAGE_CODE ? 'current' : ''; ?>"><?php echo $lng['code']; ?></a>
            <?php } ?>
        <?php }else{ ?>
            <ul class="dropdown menu dropdown--simple" data-dropdown-menu>
                <li>
                    <?php if($lngs){
                        foreach($lngs as $lng){ if($lng['code'] != ICL_LANGUAGE_CODE) continue; ?>
                        <a href="<?php echo $lng['url']; ?>"><?php echo $lng['code']; ?></a>
                    <?php } ?>
                    <ul class="menu">
                    <?php foreach($lngs as $lng){ if($lng['code'] == ICL_LANGUAGE_CODE) continue; ?>
                        <li><a href="<?php echo $lng['url']; ?>" class="<?php echo $lng['code'] == ICL_LANGUAGE_CODE ? 'current' : ''; ?>"><?php echo $lng['code']; ?></a></li>
                    <?php }} ?>
                    </ul>
                </li>
            </ul>
        <?php } ?>
    </span>

<?php
    return ob_get_clean();
}