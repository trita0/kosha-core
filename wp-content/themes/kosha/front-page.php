<?php
/**
 * Template for displaying the front page
 *
 * @package Kosha
 */

get_header();
?>

<div id="primary" class="site-content front-page">
    <main id="main" class="content-area">

        <?php
        // Hero Section
        if (have_posts()):
            ?>
            <section class="hero-section decorative-border">
                <div class="hero-content">
                    <h1 class="hero-title">
                        <?php
                        echo esc_html(get_bloginfo('name'));
                        ?>
                    </h1>
                    <p class="hero-description">
                        <?php
                        $description = get_bloginfo('description');
                        echo $description ? esc_html($description) : esc_html__('Preserving Cultural Heritage, One Story at a Time', 'kosha');
                        ?>
                    </p>
                    <?php get_search_form(); ?>
                </div>
            </section>
            <?php
        endif;

        // Featured Posts
        $featured_args = array(
            'posts_per_page' => 3,
            'post_status' => 'publish',
            'orderby' => 'date',
            'order' => 'DESC',
        );
        $featured_query = new WP_Query($featured_args);

        if ($featured_query->have_posts()):
            ?>
            <section class="featured-posts">
                <h2 class="section-title"><?php esc_html_e('Featured Articles', 'kosha'); ?></h2>
                <div class="featured-grid">
                    <?php
                    while ($featured_query->have_posts()):
                        $featured_query->the_post();
                        ?>
                        <article class="featured-card article-card">
                            <?php if (has_post_thumbnail()): ?>
                                <a href="<?php the_permalink(); ?>" class="featured-image-link">
                                    <?php the_post_thumbnail('kosha-featured'); ?>
                                </a>
                            <?php endif; ?>
                            <div class="featured-content">
                                <h3 class="featured-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>
                                <div class="featured-excerpt">
                                    <?php the_excerpt(); ?>
                                </div>
                                <div class="featured-meta">
                                    <span class="posted-date"><?php echo get_the_date(); ?></span>
                                    <span class="reading-time"><?php echo kosha_reading_time(); ?></span>
                                </div>
                            </div>
                        </article>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
            </section>
            <?php
        endif;

        // Categories Showcase
        $categories = get_categories(array(
            'orderby' => 'count',
            'order' => 'DESC',
            'number' => 6,
        ));

        if (!empty($categories)):
            ?>
            <section class="categories-showcase">
                <h2 class="section-title"><?php esc_html_e('Explore by Category', 'kosha'); ?></h2>
                <div class="categories-grid">
                    <?php foreach ($categories as $category): ?>
                        <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="category-card">
                            <h3><?php echo esc_html($category->name); ?></h3>
                            <p class="category-count">
                                <?php
                                printf(
                                    /* translators: %s: number of posts */
                                    _n('%s article', '%s articles', $category->count, 'kosha'),
                                    number_format_i18n($category->count)
                                );
                                ?>
                            </p>
                            <?php if ($category->description): ?>
                                <p class="category-description"><?php echo esc_html($category->description); ?></p>
                            <?php endif; ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </section>
            <?php
        endif;

        // Recent Posts
        $recent_args = array(
            'posts_per_page' => 6,
            'post_status' => 'publish',
            'offset' => 3, // Skip the featured posts
        );
        $recent_query = new WP_Query($recent_args);

        if ($recent_query->have_posts()):
            ?>
            <section class="recent-posts">
                <h2 class="section-title"><?php esc_html_e('Recent Additions', 'kosha'); ?></h2>
                <div class="recent-grid">
                    <?php
                    while ($recent_query->have_posts()):
                        $recent_query->the_post();
                        get_template_part('template-parts/content', get_post_type());
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
                <div class="view-all-link">
                    <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="button">
                        <?php esc_html_e('View All Articles', 'kosha'); ?>
                    </a>
                </div>
            </section>
            <?php
        endif;
        ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
