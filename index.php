<?php
get_header();

if ( have_posts() ) {

	// Load posts loop.
	while ( have_posts() ) {
		the_post(); ?>

		<main>

			<div class="row py">
				<div class="column">

					<h1><?php the_title(); ?></h1>

					<?php the_content(); ?>
				
				</div>
			</div>
		</main>

		<?php
	}

} else {

	// If no content, include the "No posts found" template.
	//get_template_part( 'template-parts/content/content-none' );

}

get_footer();
