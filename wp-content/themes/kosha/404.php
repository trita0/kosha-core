<?php
/**
 * Template for displaying 404 pages (Not Found)
 *
 * @package Kosha
 */

get_header();
?>

<div id="primary" class="site-content">
    <main id="main" class="content-area">

        <section class="error-404 not-found">
            <header class="page-header decorative-border">
                <h1 class="page-title"><?php esc_html_e('Oops! That page can&rsquo;t be found.', 'kosha'); ?></h1>
            </header><!-- .page-header -->

            <div class="page-content">
                <p><?php esc_html_e('It looks like nothing was found at this location. Perhaps try searching for what you need?', 'kosha'); ?>
                </p>

                <?php get_search_form(); ?>

                <div class="error-404-widgets">
                    <div class="widget-column">
                        <h2><?php esc_html_e('Recent Articles', 'kosha'); ?></h2>
                        <?php
                        $recent_posts = wp_get_recent_posts(
                            array(
                                'numberposts' => 5,
                                'post_status' => 'publish',
                            )
                        );

                        if (!empty($recent_posts)):
                            echo '<ul>';
                            foreach ($recent_posts as $recent_post):
                                ?>
                                <li>
                                    <a href="<?php echo esc_url(get_permalink($recent_post['ID'])); ?>">
                                        <?php echo esc_html($recent_post['post_title']); ?>
                                    </a>
                                </li>
                                <?php
                            endforeach;
                            echo '</ul>';
                        endif;
                        ?>
                    </div>

                    <div class="widget-column">
                        <h2><?php esc_html_e('Categories', 'kosha'); ?></h2>
                        <?php
                        wp_list_categories(
                            array(
                                'orderby' => 'count',
                                'order' => 'DESC',
                                'show_count' => 1,
                                'title_li' => '',
                                'number' => 10,
                            )
                        );
                        ?>
                    </div>

                    <div class="widget-column">
                        <h2><?php esc_html_e('Archives', 'kosha'); ?></h2>
                        <?php
                        wp_get_archives(
                            array(
                                'type' => 'monthly',
                                'limit' => 12,
                            )
                        );
                        ?>
                    </div>
                </div><!-- .error-404-widgets -->
            </div><!-- .page-content -->
        </section><!-- .error-404 -->

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
