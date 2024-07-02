<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Mixed_Reef_Tank
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<header id="masthead" class="site-header">
		<div class="content-wrapper">
			<div class="site-logo">
				<?php the_custom_logo(); ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-name" rel="home"><?php bloginfo( 'name' ); ?></a>
			</div>

			<nav id="site-navigation" class="main-navigation">
				<button class="menu-toggle">
					<span></span>
					<span></span>
					<span></span>
				</button>
			
				<div class="site-navigation-wrapper">
					<button class="menu-close">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="36px" height="36px">
							<defs>
							<mask id="mask1">
								<rect x="0" y="0" width="0" height="100%" fill="white" class="mask-rect1"/>
							</mask>
							<mask id="mask2">
								<rect x="0" y="0" width="0" height="100%" fill="white" class="mask-rect2"/>
							</mask>
							</defs>
							<g id="close">
								<path id="x1" d="M 9.15625 6.3125 L 6.3125 9.15625 L 22.15625 25 L 6.21875 40.96875 L 9.03125 43.78125 L 25 27.84375 L 40.9375 43.78125 L 43.78125 40.9375 L 27.84375 25 L 43.6875 9.15625 L 40.84375 6.3125 L 25 22.15625 Z" fill="#424851" mask="url(#mask1)"></path>
								<path id="x2" d="M 9.15625 6.3125 L 6.3125 9.15625 L 22.15625 25 L 6.21875 40.96875 L 9.03125 43.78125 L 25 27.84375 L 40.9375 43.78125 L 43.78125 40.9375 L 27.84375 25 L 43.6875 9.15625 L 40.84375 6.3125 L 25 22.15625 Z" fill="#2b92ec" mask="url(#mask2)"></path>
							</g>
						</svg>
					</button>

					<p><strong>Categories</strong></p>

					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu',
						)
					);
					?>				
				
				<p><strong>Search</strong></p>
				<?= get_search_form( ); ?>

				</div>

				<div class="overlay"></div>
			</nav><!-- #site-navigation -->

			<div class="search-btn">
				<svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 64 64">
					<circle cx="27" cy="27" r="16" stroke="black" stroke-width="4" fill="none"/>
					<line x1="41" y1="41" x2="58" y2="58" stroke="black" stroke-width="4"/>
				</svg>
			</div>
		</div>
	</header><!-- #masthead -->
