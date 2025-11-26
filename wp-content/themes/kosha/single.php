<?php
/**
 * Template for displaying single posts
 *
 * @package Kosha
 */

get_header();
?>

<div id="primary" class="site-content">
    <main id="main" class="content-area">

        <?php
        while (have_posts()):
            the_post();
            ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                <?php kosha_breadcrumbs(); ?>

                <header class="entry-header">
                    <?php
                    if (has_post_thumbnail()):
                        ?>
                        <div class="featured-image">
                            <?php the_post_thumbnail('kosha-featured'); ?>
                        </div>
                        <?php
                    endif;
                    ?>

                    <?php the_title('<h1 class="entry-title">', '</h1>'); ?>

                    <div class="entry-meta">
                        <span class="posted-on">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                                <path
                                    d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
                            </svg>
                            <?php echo get_the_date(); ?>
                        </span>

                        <span class="byline">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                                <path
                                    d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                            </svg>
                            <?php
                            printf(
                                /* translators: %s: post author */
                                esc_html__('By %s', 'kosha'),
                                '<a href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a>'
                            );
                            ?>
                        </span>

                        <span class="reading-time">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                                <path
                                    d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z" />
                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z" />
                            </svg>
                            <?php echo kosha_reading_time(); ?>
                        </span>

                        <?php
                        $categories = get_the_category();
                        if (!empty($categories)):
                            ?>
                            <span class="categories">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                                    <path
                                        d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3.797a1.5 1.5 0 0 1 1.06.44l.707.706L9.5 3.5 11 2l1.5 1.5L11 5l1.354 1.354.707.707a1.5 1.5 0 0 1 .44 1.06V11.5A1.5 1.5 0 0 1 12 13H2.5A1.5 1.5 0 0 1 1 11.5v-9z" />
                                </svg>
                                <?php
                                foreach ($categories as $category) {
                                    echo '<a href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a> ';
                                }
                                ?>
                            </span>
                            <?php
                        endif;
                        ?>
                    </div><!-- .entry-meta -->
                </header><!-- .entry-header -->

                <div class="entry-content">
                    <?php
                    the_content(
                        sprintf(
                            wp_kses(
                                /* translators: %s: Name of current post. Only visible to screen readers */
                                __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'kosha'),
                                array(
                                    'span' => array(
                                        'class' => array(),
                                    ),
                                )
                            ),
                            wp_kses_post(get_the_title())
                        )
                    );

                    wp_link_pages(
                        array(
                            'before' => '<div class="page-links">' . esc_html__('Pages:', 'kosha'),
                            'after' => '</div>',
                        )
                    );
                    ?>
                </div><!-- .entry-content -->

                <footer class="entry-footer">
                    <?php
                    $tags = get_the_tags();
                    if ($tags):
                        ?>
                        <div class="tags-links">
                            <strong><?php esc_html_e('Tags:', 'kosha'); ?></strong>
                            <?php
                            foreach ($tags as $tag) {
                                echo '<a href="' . esc_url(get_tag_link($tag->term_id)) . '" class="tag">' . esc_html($tag->name) . '</a> ';
                            }
                            ?>
                        </div>
                        <?php
                    endif;
                    ?>
                </footer><!-- .entry-footer -->

                <?php
                // Author bio
                if (get_the_author_meta('description')):
                    ?>
                    <div class="author-bio">
                        <div class="author-avatar">
                            <?php echo get_avatar(get_the_author_meta('ID'), 80); ?>
                        </div>
                        <div class="author-info">
                            <h3 class="author-name"><?php echo esc_html(get_the_author()); ?></h3>
                            <p class="author-description"><?php echo wp_kses_post(get_the_author_meta('description')); ?>
                            </p>
                        </div>
                    </div>
                    <?php
                endif;

                // Related posts
                $related_posts = kosha_get_related_posts(get_the_ID(), 3);
                if (!empty($related_posts)):
                    ?>
                    <div class="related-posts">
                        <h2><?php esc_html_e('Related Articles', 'kosha'); ?></h2>
                        <div class="related-posts-grid">
                            <?php
                            foreach ($related_posts as $related_post):
                                ?>
                                <article class="related-post">
                                    <?php if (has_post_thumbnail($related_post->ID)): ?>
                                        <a href="<?php echo esc_url(get_permalink($related_post->ID)); ?>">
                                            <?php echo get_the_post_thumbnail($related_post->ID, 'kosha-thumbnail'); ?>
                                        </a>
                                    <?php endif; ?>
                                    <h3>
                                        <a href="<?php echo esc_url(get_permalink($related_post->ID)); ?>">
                                            <?php echo esc_html(get_the_title($related_post->ID)); ?>
                                        </a>
                                    </h3>
                                </article>
                                <?php
                            endforeach;
                            ?>
                        </div>
                    </div>
                    <?php
                endif;

                // If comments are open or we have at least one comment, load up the comment template.
                if (comments_open() || get_comments_number()):
                    comments_template();
                endif;
                ?>

            </article><!-- #post-<?php the_ID(); ?> -->

            <?php
        endwhile; // End of the loop.
        ?>

    </main><!-- #main -->

    <?php get_sidebar(); ?>
</div><!-- #primary -->

<?php
get_footer();
