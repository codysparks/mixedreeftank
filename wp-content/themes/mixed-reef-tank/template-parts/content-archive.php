<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Mixed_Reef_Tank
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<a href="<?php the_permalink(); ?>">
			<?php
			if (has_post_thumbnail()) :
				the_post_thumbnail();
			endif;

			// Get the primary category ID set by RankMath
			$primary_category_id = get_post_meta(get_the_ID(), 'rank_math_primary_category', true);
			$category_link = get_category_link($primary_category_id);
			?>
		</a>

		<div class="entry-meta">
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<?php if($primary_category_id): ?>
				<p class="entry-category"><a href="<?= esc_url($category_link); ?>"><?= esc_html(get_category($primary_category_id)->cat_name); ?></a></p>
			<?php endif; ?>
			<p class="entry-read-time"><?= do_shortcode('[rt_reading_time post_id="' . get_the_ID() . '"]'); ?> min read</p>
		</div>
	</header><!-- .entry-header -->
</article><!-- #post-<?php the_ID(); ?> -->
