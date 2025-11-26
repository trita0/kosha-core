<?php
/**
 * The main template file
 *
 * @package Kosha
 */

get_header();
?>

<div id="primary" class="site-content">
    <main id="main" class="content-area">

        <?php
        if (have_posts()):

            if (is_home() && !is_front_page()):
                ?>
                <header class="page-header">
                    <h1 class="page-title"><?php single_post_title(); ?></h1>
                </header>
                <?php
            endif;

            /* Start the Loop */
            while (have_posts()):
                the_post();

                /*
                 * Include the Post-Type-specific template for the content.
                 * If you want to override this in a child theme, then include a file
                 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                 */
                get_template_part('template-parts/content', get_post_type());

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
