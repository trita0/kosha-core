<footer id="colophon" class="site-footer">
    <?php if (is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3')): ?>
        <div class="footer-widgets">
            <?php
            for ($i = 1; $i <= 3; $i++) {
                if (is_active_sidebar('footer-' . $i)) {
                    echo '<div class="footer-widget-area footer-widget-' . $i . '">';
                    dynamic_sidebar('footer-' . $i);
                    echo '</div>';
                }
            }
            ?>
        </div><!-- .footer-widgets -->
    <?php endif; ?>

    <div class="site-info">
        <p>
            <?php
            printf(
                /* translators: 1: Theme name, 2: Theme author */
                esc_html__('%1$s - Preserving Cultural Heritage, One Story at a Time', 'kosha'),
                '<strong>' . esc_html(get_bloginfo('name')) . '</strong>'
            );
            ?>
        </p>
        <p>
            <?php
            printf(
                /* translators: %s: Current year */
                esc_html__('&copy; %s All Rights Reserved', 'kosha'),
                date_i18n('Y')
            );
            ?>
            <?php
            if (has_nav_menu('footer')) {
                wp_nav_menu(
                    array(
                        'theme_location' => 'footer',
                        'menu_class' => 'footer-menu',
                        'container' => 'nav',
                        'container_class' => 'footer-navigation',
                        'depth' => 1,
                    )
                );
            }
            ?>
        </p>
    </div><!-- .site-info -->
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>