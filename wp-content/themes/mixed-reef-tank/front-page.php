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
                                        <h3 class="entry-title"><?php the_title(); ?></h3>

                                        <?php if($primary_category_id): ?>
                                            <p class="entry-category"><a href="<?= esc_url($category_link); ?>"><?= esc_html(get_category($primary_category_id)->cat_name); ?></a></p>
                                        <?php endif; ?>

                                        <p class="entry-read-time"><?= do_shortcode('[rt_reading_time post_id="' . get_the_ID() . '"]'); ?> min read</p>
                                    </div>
                                </header><!-- .entry-header -->
                            </article><!-- #post-<?php the_ID(); ?> -->
                            <?php
                        endwhile;
                        wp_reset_postdata();
                    else:
                        echo '<p>No featured posts found.</p>';
                    endif;
                    ?>

                    <div class="bg-box"></div>
                </div>
            </section>

            <section class="latest-posts">
                <h2>Latest articles</h2>

                <div class="lastest-posts-wrapper">
                    <?php
                    $args = array(
                        'posts_per_page' => 6,
                        'post__not_in' => $sticky_posts,
                    );
                    $latest_posts = new WP_Query($args);

                    if ($latest_posts->have_posts()) :
                        while ($latest_posts->have_posts()) : $latest_posts->the_post();
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
                                        <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                        <?php if($primary_category_id): ?>
                                            <p class="entry-category"><a href="<?= esc_url($category_link); ?>"><?= esc_html(get_category($primary_category_id)->cat_name); ?></a></p>
                                        <?php endif; ?>
                                        <p class="entry-read-time"><?= do_shortcode('[rt_reading_time post_id="' . get_the_ID() . '"]'); ?> min read</p>
                                    </div>
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

            <section class="category-posts">
                <h2>Categories</h2>

                <div class="category-posts-wrapper">
                <?php
                    $categories = get_categories();
                    if (!empty($categories)) {
                        foreach ( $categories as $category ) {
                            $long_title = get_field('long_title', $category);
                            $category_imge = get_field('homepage_image', $category);

                            echo '<div class="category-section">';
                            echo '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '">';

                            if($category_imge) {
                                echo '<img src="'.$category_imge['url'].'" width="330" height="315" alt="'.$category_imge['alt'].'" alt="Setup">';
                            }

                            echo '<h3>';
                            // Check for alternative title
                            if($long_title) {
                                echo esc_html($long_title);
                            }
                            else {
                                echo esc_html($category->name);
                            }
                            echo '</h3>';

                            echo '</a>';
                            echo '</div>';
                        }
                    }
                ?>
            </section>
        </div>
	</main><!-- #main -->

<?php
get_footer();