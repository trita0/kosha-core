<?php
/**
 * Kosha Theme Functions
 * 
 * @package Kosha
 * @since 1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Theme Setup
 */
function kosha_setup() {
    // Add default posts and comments RSS feed links to head
    add_theme_support( 'automatic-feed-links' );
    
    // Let WordPress manage the document title
    add_theme_support( 'title-tag' );
    
    // Enable support for Post Thumbnails
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 1200, 630, true );
    
    // Add custom image sizes
    add_image_size( 'kosha-featured', 800, 450, true );
    add_image_size( 'kosha-thumbnail', 400, 300, true );
    
    // Register navigation menus
    register_nav_menus( array(
        'primary' => esc_html__( 'Primary Menu', 'kosha' ),
        'footer'  => esc_html__( 'Footer Menu', 'kosha' ),
    ) );
    
    // Switch default core markup to output valid HTML5
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ) );
    
    // Add theme support for selective refresh for widgets
    add_theme_support( 'customize-selective-refresh-widgets' );
    
    // Add support for custom logo
    add_theme_support( 'custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ) );
    
    // Add support for editor styles
    add_theme_support( 'editor-styles' );
    
    // Add support for responsive embeds
    add_theme_support( 'responsive-embeds' );
    
    // Add support for wide alignment
    add_theme_support( 'align-wide' );
}
add_action( 'after_setup_theme', 'kosha_setup' );

/**
 * Set content width
 */
function kosha_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'kosha_content_width', 800 );
}
add_action( 'after_setup_theme', 'kosha_content_width', 0 );

/**
 * Register Widget Areas
 */
function kosha_widgets_init() {
    // Sidebar widget area
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'kosha' ),
        'id'            => 'sidebar-1',
        'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'kosha' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
    
    // Footer widget areas
    $footer_widget_areas = 3;
    for ( $i = 1; $i <= $footer_widget_areas; $i++ ) {
        register_sidebar( array(
            'name'          => sprintf( esc_html__( 'Footer %d', 'kosha' ), $i ),
            'id'            => 'footer-' . $i,
            'description'   => sprintf( esc_html__( 'Footer widget area %d', 'kosha' ), $i ),
            'before_widget' => '<div id="%1$s" class="widget footer-widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ) );
    }
}
add_action( 'widgets_init', 'kosha_widgets_init' );

/**
 * Enqueue Scripts and Styles
 */
function kosha_scripts() {
    // Enqueue Google Fonts
    wp_enqueue_style( 
        'kosha-fonts', 
        'https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap',
        array(),
        null
    );
    
    // Enqueue main stylesheet
    wp_enqueue_style( 'kosha-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );
    
    // Enqueue additional CSS
    wp_enqueue_style( 
        'kosha-main', 
        get_template_directory_uri() . '/assets/css/main.css',
        array( 'kosha-style' ),
        wp_get_theme()->get( 'Version' )
    );
    
    // Enqueue main JavaScript
    wp_enqueue_script(
        'kosha-main',
        get_template_directory_uri() . '/assets/js/main.js',
        array(),
        wp_get_theme()->get( 'Version' ),
        true
    );
    
    // Enqueue comment reply script
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'kosha_scripts' );

/**
 * Custom Excerpt Length
 */
function kosha_excerpt_length( $length ) {
    return 30;
}
add_filter( 'excerpt_length', 'kosha_excerpt_length' );

/**
 * Custom Excerpt More
 */
function kosha_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'kosha_excerpt_more' );

/**
 * Add Read More Link to Excerpt
 */
function kosha_excerpt_read_more( $excerpt ) {
    if ( ! is_single() ) {
        $excerpt .= ' <a href="' . esc_url( get_permalink() ) . '" class="read-more">' . esc_html__( 'Read More', 'kosha' ) . ' &rarr;</a>';
    }
    return $excerpt;
}
add_filter( 'the_excerpt', 'kosha_excerpt_read_more' );

/**
 * Generate Breadcrumbs
 */
function kosha_breadcrumbs() {
    // Settings
    $separator  = '<span class="breadcrumb-separator"> / </span>';
    $home_title = esc_html__( 'Home', 'kosha' );
    
    // Get the query & post information
    global $post;
    
    // Build the breadcrumbs
    echo '<nav class="breadcrumbs" aria-label="' . esc_attr__( 'Breadcrumb', 'kosha' ) . '">';
    
    // Home page
    echo '<a href="' . esc_url( home_url() ) . '">' . $home_title . '</a>' . $separator;
    
    if ( is_archive() && ! is_tax() && ! is_category() && ! is_tag() ) {
        echo '<span class="current">' . post_type_archive_title( '', false ) . '</span>';
        
    } elseif ( is_archive() && is_tax() && ! is_category() && ! is_tag() ) {
        $post_type = get_post_type();
        $post_type_object = get_post_type_object( $post_type );
        $post_type_archive = get_post_type_archive_link( $post_type );
        
        echo '<a href="' . esc_url( $post_type_archive ) . '">' . esc_html( $post_type_object->labels->name ) . '</a>' . $separator;
        echo '<span class="current">' . single_term_title( '', false ) . '</span>';
        
    } elseif ( is_single() ) {
        $post_type = get_post_type();
        
        if ( $post_type != 'post' ) {
            $post_type_object = get_post_type_object( $post_type );
            $post_type_archive = get_post_type_archive_link( $post_type );
            
            echo '<a href="' . esc_url( $post_type_archive ) . '">' . esc_html( $post_type_object->labels->name ) . '</a>' . $separator;
        }
        
        $category = get_the_category();
        if ( ! empty( $category ) ) {
            $category_values = array_values( $category );
            $last_category = end( $category_values );
            $cat_parents = rtrim( get_category_parents( $last_category->term_id, true, $separator ), $separator );
            echo $cat_parents . $separator;
        }
        
        echo '<span class="current">' . get_the_title() . '</span>';
        
    } elseif ( is_category() ) {
        $parent = get_queried_object()->category_parent;
        
        if ( $parent !== 0 ) {
            $parent_category = get_category( $parent );
            $category_link = get_category_link( $parent );
            echo '<a href="' . esc_url( $category_link ) . '">' . esc_html( $parent_category->name ) . '</a>' . $separator;
        }
        
        echo '<span class="current">' . single_cat_title( '', false ) . '</span>';
        
    } elseif ( is_page() ) {
        if ( $post->post_parent ) {
            $parent_id  = $post->post_parent;
            $breadcrumbs = array();
            
            while ( $parent_id ) {
                $page = get_page( $parent_id );
                $breadcrumbs[] = '<a href="' . esc_url( get_permalink( $page->ID ) ) . '">' . get_the_title( $page->ID ) . '</a>';
                $parent_id = $page->post_parent;
            }
            
            $breadcrumbs = array_reverse( $breadcrumbs );
            foreach ( $breadcrumbs as $crumb ) {
                echo $crumb . $separator;
            }
        }
        
        echo '<span class="current">' . get_the_title() . '</span>';
        
    } elseif ( is_tag() ) {
        echo '<span class="current">' . single_tag_title( '', false ) . '</span>';
        
    } elseif ( is_author() ) {
        echo '<span class="current">' . get_the_author() . '</span>';
        
    } elseif ( is_search() ) {
        echo '<span class="current">' . esc_html__( 'Search Results for: ', 'kosha' ) . get_search_query() . '</span>';
        
    } elseif ( is_404() ) {
        echo '<span class="current">' . esc_html__( 'Error 404', 'kosha' ) . '</span>';
    }
    
    echo '</nav>';
}

/**
 * Get Related Posts
 */
function kosha_get_related_posts( $post_id, $limit = 3 ) {
    $categories = get_the_category( $post_id );
    
    if ( empty( $categories ) ) {
        return array();
    }
    
    $category_ids = array();
    foreach ( $categories as $category ) {
        $category_ids[] = $category->term_id;
    }
    
    $args = array(
        'category__in'        => $category_ids,
        'post__not_in'        => array( $post_id ),
        'posts_per_page'      => $limit,
        'ignore_sticky_posts' => 1,
    );
    
    return get_posts( $args );
}

/**
 * Estimated Reading Time
 */
function kosha_reading_time() {
    $content = get_post_field( 'post_content', get_the_ID() );
    $word_count = str_word_count( strip_tags( $content ) );
    $reading_time = ceil( $word_count / 200 ); // Average reading speed: 200 words per minute
    
    if ( $reading_time == 1 ) {
        return '1 ' . esc_html__( 'minute read', 'kosha' );
    } else {
        return $reading_time . ' ' . esc_html__( 'minutes read', 'kosha' );
    }
}

/**
 * Custom Body Classes
 */
function kosha_body_classes( $classes ) {
    // Add class if sidebar is active
    if ( is_active_sidebar( 'sidebar-1' ) && ! is_page() ) {
        $classes[] = 'has-sidebar';
    }
    
    // Add class for single posts
    if ( is_single() ) {
        $classes[] = 'single-article';
    }
    
    return $classes;
}
add_filter( 'body_class', 'kosha_body_classes' );

/**
 * Pagination
 */
function kosha_pagination() {
    if ( is_singular() ) {
        return;
    }
    
    global $wp_query;
    
    if ( $wp_query->max_num_pages <= 1 ) {
        return;
    }
    
    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    $max   = intval( $wp_query->max_num_pages );
    
    if ( $paged >= 1 ) {
        $links[] = $paged;
    }
    
    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }
    
    if ( ( $paged + 2 ) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }
    
    echo '<nav class="pagination" aria-label="' . esc_attr__( 'Pagination', 'kosha' ) . '"><ul>' . "\n";
    
    if ( get_previous_posts_link() ) {
        printf( '<li>%s</li>' . "\n", get_previous_posts_link( '&laquo; ' . esc_html__( 'Previous', 'kosha' ) ) );
    }
    
    if ( ! in_array( 1, $links ) ) {
        $class = 1 == $paged ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );
        
        if ( ! in_array( 2, $links ) ) {
            echo '<li>…</li>';
        }
    }
    
    sort( $links );
    foreach ( (array) $links as $link ) {
        $class = $paged == $link ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
    }
    
    if ( ! in_array( $max, $links ) ) {
        if ( ! in_array( $max - 1, $links ) ) {
            echo '<li>…</li>' . "\n";
        }
        
        $class = $paged == $max ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
    }
    
    if ( get_next_posts_link() ) {
        printf( '<li>%s</li>' . "\n", get_next_posts_link( esc_html__( 'Next', 'kosha' ) . ' &raquo;' ) );
    }
    
    echo '</ul></nav>' . "\n";
}
