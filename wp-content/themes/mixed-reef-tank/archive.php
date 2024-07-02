<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Mixed_Reef_Tank
 */

get_header();
?>

	<main id="primary" class="site-main">
		<div class="content-wrapper">
		<?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
				$term = get_queried_object();
				$long_title = get_field('long_title', $term);

				// Check for alternative title
				if($long_title) {
					echo '<h1 class="page-title">' . $long_title. '</h1>';
				}
				else {
					the_archive_title( '<h1 class="page-title">', '</h1>' );
				}

				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<section class="category-posts-wrapper">

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'archive' );

			endwhile;
			?>
			</section>

			<?php

			wp_pagenavi();

			else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>
		

	</div>
	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
