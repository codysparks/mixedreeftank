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
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">Mobile</button>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
					)
				);
				?>
				
				<?= get_search_form( ); ?>
			</nav><!-- #site-navigation -->

			<div class="search-btn">
				<svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 64 64">
					<circle cx="27" cy="27" r="16" stroke="black" stroke-width="4" fill="none"/>
					<line x1="41" y1="41" x2="58" y2="58" stroke="black" stroke-width="4"/>
				</svg>
			</div>
		</dvi>
	</header><!-- #masthead -->
