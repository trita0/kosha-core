<?php
/**
 * Template for displaying pages
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

                    the_title('<h1 class="entry-title">', '</h1>');
                    ?>
                </header><!-- .entry-header -->

                <div class="entry-content">
                    <?php
                    the_content();

                    wp_link_pages(
                        array(
                            'before' => '<div class="page-links">' . esc_html__('Pages:', 'kosha'),
                            'after' => '</div>',
                        )
                    );
                    ?>
                </div><!-- .entry-content -->

                <?php
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
