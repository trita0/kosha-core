<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <div id="page" class="site">
        <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'kosha'); ?></a>

        <header id="masthead" class="site-header">
            <div class="header-inner">
                <div class="site-branding">
                    <?php
                    if (has_custom_logo()) {
                        the_custom_logo();
                    } else {
                        ?>
                        <div class="site-identity">
                            <h1 class="site-title">
                                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                    <?php bloginfo('name'); ?>
                                </a>
                            </h1>
                            <?php
                            $description = get_bloginfo('description', 'display');
                            if ($description || is_customize_preview()):
                                ?>
                                <p class="site-description"><?php echo $description; ?></p>
                            <?php endif; ?>
                        </div>
                        <?php
                    }
                    ?>
                </div><!-- .site-branding -->

                <nav id="site-navigation" class="main-navigation"
                    aria-label="<?php esc_attr_e('Primary Menu', 'kosha'); ?>">
                    <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                        <span class="menu-toggle-text"><?php esc_html_e('Menu', 'kosha'); ?></span>
                    </button>
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'primary',
                            'menu_id' => 'primary-menu',
                            'container' => false,
                            'fallback_cb' => false,
                        )
                    );
                    ?>

                    <div class="header-search">
                        <?php get_search_form(); ?>
                    </div>
                </nav><!-- #site-navigation -->
            </div><!-- .header-inner -->
        </header><!-- #masthead -->