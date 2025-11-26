<?php
/**
 * Template part for displaying posts
 *
 * @package Kosha
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('article-card'); ?>>
    <?php if (has_post_thumbnail() && !is_single()): ?>
        <div class="post-thumbnail">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('kosha-featured'); ?>
            </a>
        </div>
    <?php endif; ?>

    <header class="entry-header">
        <?php
        if (is_singular()):
            the_title('<h1 class="entry-title">', '</h1>');
        else:
            the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
        endif;
        ?>

        <?php if ('post' === get_post_type()): ?>
            <div class="entry-meta">
                <span class="posted-on">
                    <?php echo get_the_date(); ?>
                </span>
                <span class="byline">
                    <?php
                    printf(
                        /* translators: %s: post author */
                        esc_html__('By %s', 'kosha'),
                        '<a href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a>'
                    );
                    ?>
                </span>
                <span class="reading-time">
                    <?php echo kosha_reading_time(); ?>
                </span>
            </div><!-- .entry-meta -->
        <?php endif; ?>
    </header><!-- .entry-header -->

    <div class="entry-content">
        <?php
        if (is_singular()):
            the_content();
        else:
            the_excerpt();
        endif;
        ?>
    </div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->