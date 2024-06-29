<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Mixed_Reef_Tank
 */

get_header();
?>

	<main id="primary" class="site-main">
        <div class="content-wrapper">
            <?php
                $featured_section = get_field('featured_section');
                if(!empty($featured_section['header']) && !empty($featured_section['description'])):
            ?>

            <section class="featured">
                <div class="featured-img">
                    <img src="<?= $featured_section['image']['url']; ?>" width="<?= $featured_section['image']['width']; ?>" height="<?= $featured_section['image']['height']; ?>" alt="<?= $featured_section['image']['alt']; ?>" />
                </div>

                <div class="featured-content">
                    <h1><?= $featured_section['header']; ?></h1>
                    <p><?= $featured_section['description']; ?></p>
                    <a href="<?= $featured_section['link']['url']; ?>"><?= $featured_section['link']['title']; ?></a>
                </div>
            </section>
                
            <?php endif; ?>

            <section class="featured-posts">
                <h2>Featured articles</h2>

                <div class="featured-posts-wrapper">
                    <?php
                    $args = array(
                        'posts_per_page' => 3,
                        'post__in' => get_option( 'sticky_posts' ),
                    );
                    $featured_posts = new WP_Query($args);
                    $sticky_posts = [];

                    if ($featured_posts->have_posts()) :
                        while ($featured_posts->have_posts()) : $featured_posts->the_post();
                        $sticky_posts[] = get_the_ID();
                    ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                <header class="entry-header">
                                    <?php
                                    if (has_post_thumbnail()) :
                                        the_post_thumbnail();
                                    endif;
                                    ?>
                                    <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                </header><!-- .entry-header -->
                            </article><!-- #post-<?php the_ID(); ?> -->
                    <?php
                        endwhile;
                        wp_reset_postdata();
                    else:
                        echo '<p>No featured posts found.</p>';
                    endif;
                    ?>
                </div>
            </section>

            <section class="latest-posts">
                <h2>Latest articles</h2>

                <div class="lastest-posts-wrapper">
                    <?php
                    $args = array(
                        'posts_per_page' => 10,
                        'post__not_in' => $sticky_posts,
                    );
                    $latest_posts = new WP_Query($args);

                    if ($latest_posts->have_posts()) :
                        while ($latest_posts->have_posts()) : $latest_posts->the_post();
                    ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                <header class="entry-header">
                                    <?php
                                    if (has_post_thumbnail()) :
                                        the_post_thumbnail();
                                    endif;
                                    ?>
                                    <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                </header><!-- .entry-header -->
                            </article><!-- #post-<?php the_ID(); ?> -->
                    <?php
                        endwhile;
                        wp_reset_postdata();
                    else:
                        echo '<p>No lastest posts found.</p>';
                    endif;
                    ?>
                </div>
            </section>
        </div>
	</main><!-- #main -->

<?php
get_sidebar();
get_footer();