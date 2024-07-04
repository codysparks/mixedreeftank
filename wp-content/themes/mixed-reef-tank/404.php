<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Mixed_Reef_Tank
 */

get_header();
?>

	<main id="primary" class="site-main">
		<div class="content-wrapper">
			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'mixed-reef-tank' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php esc_html_e( 'The page you are looking for might be renamed, removed or might never existed in this tank.', 'mixed-reef-tank' ); ?></p>

					<?php get_search_form(); ?>

					<p><img src="http://mixedreeftank.local/wp-content/uploads/2024/07/clownfish-sleeping.png" alt="Clownfish Sleeping" /></p>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->
		</div>
	</main><!-- #main -->

<?php
get_footer();
