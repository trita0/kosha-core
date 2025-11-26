<?php
/**
 * Template for displaying archive pages
 *
 * @package Kosha
 */

get_header();
?>

<div id="primary" class="site-content">
    <main id="main" class="content-area">

        <?php if (have_posts()): ?>

            <header class="page-header decorative-border">
                <?php
                the_archive_title('<h1 class="page-title">', '</h1>');
                the_archive_description('<div class="archive-description">', '</div>');
                ?>
            </header><!-- .page-header -->

            <div class="archive-grid">
                <?php
                /* Start the Loop */
                while (have_posts()):
                    the_post();
                    get_template_part('template-parts/content', get_post_type());
                endwhile;
                ?>
            </div><!-- .archive-grid -->

            <?php
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
