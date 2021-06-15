<?php get_header(); 

$subscription_link = get_field('subscription_link', 'option');
?>

<main>
	<div class="row py">
		<div class="column small-12 text-center pb--05">
			<?php the_field('all_boxes_intro', 'option'); ?>
		</div>
	<?php if ( have_posts() ) {

		// Load posts loop.
		while ( have_posts() ) {
			the_post(); ?>
				<div class="column small-12 medium-6">
					<?php get_template_part( 'template-parts/components/card-box/card-box' ); ?>
				</div>
			<?php
		}

	} else {

		// If no content, include the "No posts found" template.
		//get_template_part( 'template-parts/content/content-none' );

	}

	?>
		<?php if($subscription_link){ ?>
		<div class="column small-12 text-center pt--05">
			<a href="<?php echo get_the_permalink($subscription_link->ID); ?>" class="button"><?php _e('Subscribe now', 'Ginky'); ?></a>
		</div>
		<?php } ?>
	</div>
</main>

<?php get_footer(); ?>