<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package test
 */

 // Get the primary category ID set by RankMath
 $primary_category_id = get_post_meta(get_the_ID(), 'rank_math_primary_category', true);
 $category_link = get_category_link($primary_category_id);

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">

	<?php if($primary_category_id): ?>
		<p class="entry-category"><a href="<?= esc_url($category_link); ?>"><?= esc_html(get_category($primary_category_id)->cat_name); ?></a></p>
	<?php endif; ?>

		<?php
			the_title( '<h1 class="entry-title">', '</h1>' );

			if ( 'post' === get_post_type() ) :
				?>
				<div class="entry-meta">
					<?= do_shortcode('[rt_reading_time post_id="' . get_the_ID() . '"]'); ?> min read - 
					<?php mixed_reef_tank_posted_on(); ?>
					<?php mixed_reef_tank_posted_by() ?>

				</div><!-- .entry-meta -->
			<?php endif; ?>
	</header><!-- .entry-header -->

	<?php mixed_reef_tank_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'test' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);
		?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
