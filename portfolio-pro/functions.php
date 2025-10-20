<?php
/**
 * Portfolio Pro Theme Functions
 *
 * @package Portfolio_Pro
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Theme Setup
 */
function portfolio_pro_setup() {
    // Add default posts and comments RSS feed links to head
    add_theme_support( 'automatic-feed-links' );

    // Let WordPress manage the document title
    add_theme_support( 'title-tag' );

    // Enable support for Post Thumbnails on posts and pages
    add_theme_support( 'post-thumbnails' );

    // Set custom image sizes
    add_image_size( 'portfolio-thumbnail', 800, 600, true );
    add_image_size( 'portfolio-large', 1200, 900, true );
    add_image_size( 'hero-image', 1920, 1080, true );

    // Register navigation menus
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'portfolio-pro' ),
        'footer'  => __( 'Footer Menu', 'portfolio-pro' ),
    ) );

    // Switch default core markup for search form, comment form, and comments
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
        'width'       => 100,
        'flex-height' => true,
        'flex-width'  => true,
    ) );

    // Add support for editor styles
    add_theme_support( 'editor-styles' );
    add_editor_style( 'assets/css/editor-style.css' );

    // Add support for responsive embeds
    add_theme_support( 'responsive-embeds' );

    // Add support for custom background
    add_theme_support( 'custom-background', array(
        'default-color' => '0f172a',
    ) );
}
add_action( 'after_setup_theme', 'portfolio_pro_setup' );

/**
 * Set the content width in pixels
 */
function portfolio_pro_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'portfolio_pro_content_width', 1200 );
}
add_action( 'after_setup_theme', 'portfolio_pro_content_width', 0 );

/**
 * Enqueue scripts and styles
 */
function portfolio_pro_scripts() {
    // Enqueue Google Fonts
    wp_enqueue_style(
        'portfolio-pro-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@600;700;800&display=swap',
        array(),
        null
    );

    // Enqueue main stylesheet
    wp_enqueue_style(
        'portfolio-pro-style',
        get_stylesheet_uri(),
        array(),
        wp_get_theme()->get( 'Version' )
    );

    // Enqueue custom CSS
    wp_enqueue_style(
        'portfolio-pro-custom',
        get_template_directory_uri() . '/assets/css/custom.css',
        array( 'portfolio-pro-style' ),
        wp_get_theme()->get( 'Version' )
    );

    // Enqueue navigation script
    wp_enqueue_script(
        'portfolio-pro-navigation',
        get_template_directory_uri() . '/assets/js/navigation.js',
        array( 'jquery' ),
        wp_get_theme()->get( 'Version' ),
        true
    );

    // Enqueue main JavaScript file
    wp_enqueue_script(
        'portfolio-pro-main',
        get_template_directory_uri() . '/assets/js/main.js',
        array( 'jquery' ),
        wp_get_theme()->get( 'Version' ),
        true
    );

    // Enqueue comments script on single posts
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

    // Localize script for AJAX
    wp_localize_script( 'portfolio-pro-main', 'portfolioProAjax', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'nonce'   => wp_create_nonce( 'portfolio-pro-nonce' ),
    ) );
}
add_action( 'wp_enqueue_scripts', 'portfolio_pro_scripts' );

/**
 * Register widget areas
 */
function portfolio_pro_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Sidebar', 'portfolio-pro' ),
        'id'            => 'sidebar-1',
        'description'   => __( 'Add widgets here to appear in your sidebar.', 'portfolio-pro' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Footer Widget Area 1', 'portfolio-pro' ),
        'id'            => 'footer-1',
        'description'   => __( 'Add widgets here to appear in footer column 1.', 'portfolio-pro' ),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Footer Widget Area 2', 'portfolio-pro' ),
        'id'            => 'footer-2',
        'description'   => __( 'Add widgets here to appear in footer column 2.', 'portfolio-pro' ),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Footer Widget Area 3', 'portfolio-pro' ),
        'id'            => 'footer-3',
        'description'   => __( 'Add widgets here to appear in footer column 3.', 'portfolio-pro' ),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'portfolio_pro_widgets_init' );

/**
 * Register Custom Post Type - Portfolio
 */
function portfolio_pro_register_portfolio_post_type() {
    $labels = array(
        'name'                  => _x( 'Portfolio Items', 'Post type general name', 'portfolio-pro' ),
        'singular_name'         => _x( 'Portfolio Item', 'Post type singular name', 'portfolio-pro' ),
        'menu_name'             => _x( 'Portfolio', 'Admin Menu text', 'portfolio-pro' ),
        'name_admin_bar'        => _x( 'Portfolio Item', 'Add New on Toolbar', 'portfolio-pro' ),
        'add_new'               => __( 'Add New', 'portfolio-pro' ),
        'add_new_item'          => __( 'Add New Portfolio Item', 'portfolio-pro' ),
        'new_item'              => __( 'New Portfolio Item', 'portfolio-pro' ),
        'edit_item'             => __( 'Edit Portfolio Item', 'portfolio-pro' ),
        'view_item'             => __( 'View Portfolio Item', 'portfolio-pro' ),
        'all_items'             => __( 'All Portfolio Items', 'portfolio-pro' ),
        'search_items'          => __( 'Search Portfolio Items', 'portfolio-pro' ),
        'parent_item_colon'     => __( 'Parent Portfolio Items:', 'portfolio-pro' ),
        'not_found'             => __( 'No portfolio items found.', 'portfolio-pro' ),
        'not_found_in_trash'    => __( 'No portfolio items found in Trash.', 'portfolio-pro' ),
        'featured_image'        => _x( 'Portfolio Item Cover Image', 'Overrides the "Featured Image" phrase', 'portfolio-pro' ),
        'set_featured_image'    => _x( 'Set cover image', 'Overrides the "Set featured image" phrase', 'portfolio-pro' ),
        'remove_featured_image' => _x( 'Remove cover image', 'Overrides the "Remove featured image" phrase', 'portfolio-pro' ),
        'use_featured_image'    => _x( 'Use as cover image', 'Overrides the "Use as featured image" phrase', 'portfolio-pro' ),
        'archives'              => _x( 'Portfolio archives', 'The post type archive label', 'portfolio-pro' ),
        'insert_into_item'      => _x( 'Insert into portfolio item', 'Overrides the "Insert into post" phrase', 'portfolio-pro' ),
        'uploaded_to_this_item' => _x( 'Uploaded to this portfolio item', 'Overrides the "Uploaded to this post" phrase', 'portfolio-pro' ),
        'filter_items_list'     => _x( 'Filter portfolio items list', 'Screen reader text', 'portfolio-pro' ),
        'items_list_navigation' => _x( 'Portfolio items list navigation', 'Screen reader text', 'portfolio-pro' ),
        'items_list'            => _x( 'Portfolio items list', 'Screen reader text', 'portfolio-pro' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'portfolio' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-portfolio',
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
        'show_in_rest'       => true,
    );

    register_post_type( 'portfolio', $args );
}
add_action( 'init', 'portfolio_pro_register_portfolio_post_type' );

/**
 * Register Custom Taxonomy - Portfolio Category
 */
function portfolio_pro_register_portfolio_taxonomy() {
    $labels = array(
        'name'              => _x( 'Portfolio Categories', 'taxonomy general name', 'portfolio-pro' ),
        'singular_name'     => _x( 'Portfolio Category', 'taxonomy singular name', 'portfolio-pro' ),
        'search_items'      => __( 'Search Portfolio Categories', 'portfolio-pro' ),
        'all_items'         => __( 'All Portfolio Categories', 'portfolio-pro' ),
        'parent_item'       => __( 'Parent Portfolio Category', 'portfolio-pro' ),
        'parent_item_colon' => __( 'Parent Portfolio Category:', 'portfolio-pro' ),
        'edit_item'         => __( 'Edit Portfolio Category', 'portfolio-pro' ),
        'update_item'       => __( 'Update Portfolio Category', 'portfolio-pro' ),
        'add_new_item'      => __( 'Add New Portfolio Category', 'portfolio-pro' ),
        'new_item_name'     => __( 'New Portfolio Category Name', 'portfolio-pro' ),
        'menu_name'         => __( 'Portfolio Categories', 'portfolio-pro' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'portfolio-category' ),
        'show_in_rest'      => true,
    );

    register_taxonomy( 'portfolio_category', array( 'portfolio' ), $args );
}
add_action( 'init', 'portfolio_pro_register_portfolio_taxonomy' );

/**
 * Add custom meta boxes for portfolio items
 */
function portfolio_pro_add_portfolio_meta_boxes() {
    add_meta_box(
        'portfolio_details',
        __( 'Portfolio Details', 'portfolio-pro' ),
        'portfolio_pro_portfolio_details_callback',
        'portfolio',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'portfolio_pro_add_portfolio_meta_boxes' );

/**
 * Portfolio details meta box callback
 */
function portfolio_pro_portfolio_details_callback( $post ) {
    wp_nonce_field( 'portfolio_pro_save_portfolio_details', 'portfolio_pro_portfolio_details_nonce' );

    $project_url = get_post_meta( $post->ID, '_portfolio_project_url', true );
    $client = get_post_meta( $post->ID, '_portfolio_client', true );
    $date = get_post_meta( $post->ID, '_portfolio_date', true );
    $technologies = get_post_meta( $post->ID, '_portfolio_technologies', true );
    ?>
    <p>
        <label for="portfolio_project_url"><?php _e( 'Project URL:', 'portfolio-pro' ); ?></label><br>
        <input type="url" id="portfolio_project_url" name="portfolio_project_url" value="<?php echo esc_attr( $project_url ); ?>" style="width: 100%;">
    </p>
    <p>
        <label for="portfolio_client"><?php _e( 'Client Name:', 'portfolio-pro' ); ?></label><br>
        <input type="text" id="portfolio_client" name="portfolio_client" value="<?php echo esc_attr( $client ); ?>" style="width: 100%;">
    </p>
    <p>
        <label for="portfolio_date"><?php _e( 'Project Date:', 'portfolio-pro' ); ?></label><br>
        <input type="text" id="portfolio_date" name="portfolio_date" value="<?php echo esc_attr( $date ); ?>" style="width: 100%;">
    </p>
    <p>
        <label for="portfolio_technologies"><?php _e( 'Technologies Used (comma-separated):', 'portfolio-pro' ); ?></label><br>
        <input type="text" id="portfolio_technologies" name="portfolio_technologies" value="<?php echo esc_attr( $technologies ); ?>" style="width: 100%;">
    </p>
    <?php
}

/**
 * Save portfolio details meta box data
 */
function portfolio_pro_save_portfolio_details( $post_id ) {
    if ( ! isset( $_POST['portfolio_pro_portfolio_details_nonce'] ) ) {
        return;
    }

    if ( ! wp_verify_nonce( $_POST['portfolio_pro_portfolio_details_nonce'], 'portfolio_pro_save_portfolio_details' ) ) {
        return;
    }

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    if ( isset( $_POST['portfolio_project_url'] ) ) {
        update_post_meta( $post_id, '_portfolio_project_url', sanitize_text_field( $_POST['portfolio_project_url'] ) );
    }

    if ( isset( $_POST['portfolio_client'] ) ) {
        update_post_meta( $post_id, '_portfolio_client', sanitize_text_field( $_POST['portfolio_client'] ) );
    }

    if ( isset( $_POST['portfolio_date'] ) ) {
        update_post_meta( $post_id, '_portfolio_date', sanitize_text_field( $_POST['portfolio_date'] ) );
    }

    if ( isset( $_POST['portfolio_technologies'] ) ) {
        update_post_meta( $post_id, '_portfolio_technologies', sanitize_text_field( $_POST['portfolio_technologies'] ) );
    }
}
add_action( 'save_post', 'portfolio_pro_save_portfolio_details' );

/**
 * Custom excerpt length
 */
function portfolio_pro_excerpt_length( $length ) {
    return 25;
}
add_filter( 'excerpt_length', 'portfolio_pro_excerpt_length', 999 );

/**
 * Custom excerpt more
 */
function portfolio_pro_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'portfolio_pro_excerpt_more' );

/**
 * Add body classes for better styling control
 */
function portfolio_pro_body_classes( $classes ) {
    if ( is_singular() ) {
        $classes[] = 'singular';
    }

    if ( is_active_sidebar( 'sidebar-1' ) ) {
        $classes[] = 'has-sidebar';
    } else {
        $classes[] = 'no-sidebar';
    }

    return $classes;
}
add_filter( 'body_class', 'portfolio_pro_body_classes' );

/**
 * Customizer additions
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Template tags
 */
require get_template_directory() . '/inc/template-tags.php';
