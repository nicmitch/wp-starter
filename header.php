<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

		<title><?php wp_title(''); ?></title>

        <?php wp_head(); ?>

		<?php the_field('head_code', 'option'); ?>

		<?php if(!is_user_logged_in()){ ?>
			<?php the_field('head_code_nologgedin', 'option'); ?>
		<?php } ?>
	</head>

	<body <?php body_class(); ?>>
		<?php the_field('body_code', 'option'); ?>

		<header id="header">

			<div id="header-main">
				<div class="row expanded align-justify align-middle">

					<div class="column shrink">
						<?php echo do_shortcode('[language_selector]'); ?>
					</div>

					<div id="logo" class="column expand shrink">
						<a href="<?php echo bloginfo( 'url' ); ?>">
							<img src="<?php echo asset_path('images/logo.svg'); ?>" width="200" height="41" alt="Ginky logo">
						</a>
					</div>

					<div class="column shrink">
					</div>

				</div>
			</div>
		</header>

		