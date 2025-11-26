<?php
/**
 * Template for displaying search results
 *
 * @package Kosha
 */

get_header();
?>

<div id="primary" class="site-content">
    <main id="main" class="content-area">

        <?php if (have_posts()): ?>

            <header class="page-header">
                <h1 class="page-title">
                    <?php
                    printf(
                        /* translators: %s: search query */
                        esc_html__('Search Results for: %s', 'kosha'),
                        '<span>' . get_search_query() . '</span>'
                    );
                    ?>
                </h1>
            </header><!-- .page-header -->

            <?php
            /* Start the Loop */
            while (have_posts()):
                the_post();
                get_template_part('template-parts/content', 'search');
            endwhile;

            kosha_pagination();

        else:

            get_template_part('template-parts/content', 'none');

        endif;
        ?>

    </main><!-- #main -->

    <?php get_sidebar(); ?>
</div><!-- #primary -->

<?php
get_footer();
