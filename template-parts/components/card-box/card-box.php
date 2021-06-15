
<div class="card card--box mb--025">
    <div class="card__content">
        <div class="row align-justify align-bottom">
            <div class="column shrink">
                <h2 class="card__title"><?php the_title(); ?> - <?php the_date('F Y'); ?></h2>
            </div>
            <?php if($post->post_status != 'publish'){ ?>
                <div class="column shrink">
                    <?php /*<a href="<?php the_permalink(); ?>" class="button no-min-w quad"><?php _e('Order now', 'Ginky'); ?></a> */ ?>
                    <a href="<?php bloginfo('url'); ?>#subscribe-block" class="button"><?php _e('Order now', 'Ginky'); ?></a>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="overlay overlay--gradient"></div>
    <?php the_post_thumbnail( 'large' ); ?>
</div>