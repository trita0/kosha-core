<?php
/**
 * Template part for displaying search results
 *
 * @package Kosha
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('search-result'); ?>>
    <header class="entry-header">
        <?php the_title(sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>'); ?>

        <?php if ('post' === get_post_type()): ?>
            <div class="entry-meta">
                <span class="posted-on"><?php echo get_the_date(); ?></span>
                <span
                    class="post-type"><?php echo esc_html(get_post_type_object(get_post_type())->labels->singular_name); ?></span>
            </div><!-- .entry-meta -->
        <?php endif; ?>
    </header><!-- .entry-header -->

    <div class="entry-summary">
        <?php the_excerpt(); ?>
    </div><!-- .entry-summary -->
</article><!-- #post-<?php the_ID(); ?> -->