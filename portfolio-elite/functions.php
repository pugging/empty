<?php
/**
 * Portfolio Elite Theme Functions
 *
 * @package Portfolio_Elite
 * @since 2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Theme Constants
define( 'PORTFOLIO_ELITE_VERSION', '2.0.0' );
define( 'PORTFOLIO_ELITE_DIR', get_template_directory() );
define( 'PORTFOLIO_ELITE_URI', get_template_directory_uri() );

/**
 * Theme Setup
 */
function portfolio_elite_setup() {
    // Add default posts and comments RSS feed links
    add_theme_support( 'automatic-feed-links' );

    // Let WordPress manage the document title
    add_theme_support( 'title-tag' );

    // Enable Post Thumbnails
    add_theme_support( 'post-thumbnails' );

    // Custom image sizes
    add_image_size( 'portfolio-thumbnail', 800, 600, true );
    add_image_size( 'portfolio-large', 1400, 1050, true );
    add_image_size( 'portfolio-hero', 1920, 1080, true );
    add_image_size( 'pdf-thumbnail', 400, 550, true );

    // Register nav menus
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'portfolio-elite' ),
        'footer'  => __( 'Footer Menu', 'portfolio-elite' ),
        'mobile'  => __( 'Mobile Menu', 'portfolio-elite' ),
    ) );

    // HTML5 support
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ) );

    // Custom logo support
    add_theme_support( 'custom-logo', array(
        'height'      => 120,
        'width'       => 120,
        'flex-height' => true,
        'flex-width'  => true,
    ) );

    // Editor styles
    add_theme_support( 'editor-styles' );
    add_editor_style( 'assets/css/editor-style.css' );

    // Responsive embeds
    add_theme_support( 'responsive-embeds' );

    // Wide and Full alignment
    add_theme_support( 'align-wide' );

    // Custom background
    add_theme_support( 'custom-background', array(
        'default-color' => '020617',
    ) );

    // Gutenberg color palette
    add_theme_support( 'editor-color-palette', array(
        array(
            'name'  => __( 'Primary', 'portfolio-elite' ),
            'slug'  => 'primary',
            'color' => '#6366f1',
        ),
        array(
            'name'  => __( 'Secondary', 'portfolio-elite' ),
            'slug'  => 'secondary',
            'color' => '#ec4899',
        ),
        array(
            'name'  => __( 'Accent', 'portfolio-elite' ),
            'slug'  => 'accent',
            'color' => '#f59e0b',
        ),
        array(
            'name'  => __( 'Emerald', 'portfolio-elite' ),
            'slug'  => 'emerald',
            'color' => '#10b981',
        ),
        array(
            'name'  => __( 'Cyan', 'portfolio-elite' ),
            'slug'  => 'cyan',
            'color' => '#06b6d4',
        ),
    ) );
}
add_action( 'after_setup_theme', 'portfolio_elite_setup' );

/**
 * Content width
 */
function portfolio_elite_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'portfolio_elite_content_width', 1400 );
}
add_action( 'after_setup_theme', 'portfolio_elite_content_width', 0 );

/**
 * Enqueue scripts and styles
 */
function portfolio_elite_scripts() {
    // Google Fonts
    wp_enqueue_style(
        'portfolio-elite-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Sora:wght@600;700;800&family=JetBrains+Mono:wght@400;600&display=swap',
        array(),
        null
    );

    // Main stylesheet
    wp_enqueue_style(
        'portfolio-elite-style',
        get_stylesheet_uri(),
        array(),
        PORTFOLIO_ELITE_VERSION
    );

    // Portfolio Grid CSS
    wp_enqueue_style(
        'portfolio-elite-grid',
        PORTFOLIO_ELITE_URI . '/assets/css/portfolio-grid.css',
        array( 'portfolio-elite-style' ),
        PORTFOLIO_ELITE_VERSION
    );

    // PDF Viewer CSS
    wp_enqueue_style(
        'portfolio-elite-pdf',
        PORTFOLIO_ELITE_URI . '/assets/css/pdf-viewer.css',
        array( 'portfolio-elite-style' ),
        PORTFOLIO_ELITE_VERSION
    );

    // GSAP Core
    wp_enqueue_script(
        'gsap',
        'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js',
        array(),
        '3.12.5',
        true
    );

    // GSAP ScrollTrigger
    wp_enqueue_script(
        'gsap-scrolltrigger',
        'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js',
        array( 'gsap' ),
        '3.12.5',
        true
    );

    // Animations
    wp_enqueue_script(
        'portfolio-elite-animations',
        PORTFOLIO_ELITE_URI . '/assets/js/animations.js',
        array( 'gsap', 'gsap-scrolltrigger' ),
        PORTFOLIO_ELITE_VERSION,
        true
    );

    // Navigation
    wp_enqueue_script(
        'portfolio-elite-navigation',
        PORTFOLIO_ELITE_URI . '/assets/js/navigation.js',
        array( 'jquery' ),
        PORTFOLIO_ELITE_VERSION,
        true
    );

    // Main JS
    wp_enqueue_script(
        'portfolio-elite-main',
        PORTFOLIO_ELITE_URI . '/assets/js/main.js',
        array( 'jquery', 'gsap' ),
        PORTFOLIO_ELITE_VERSION,
        true
    );

    // PDF.js for PDF viewing
    wp_enqueue_script(
        'pdfjs',
        'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js',
        array(),
        '3.11.174',
        true
    );

    // PDF Viewer JS
    wp_enqueue_script(
        'portfolio-elite-pdf-viewer',
        PORTFOLIO_ELITE_URI . '/assets/js/pdf-viewer.js',
        array( 'jquery', 'pdfjs' ),
        PORTFOLIO_ELITE_VERSION,
        true
    );

    // Localize script
    wp_localize_script( 'portfolio-elite-main', 'portfolioElite', array(
        'ajaxUrl' => admin_url( 'admin-ajax.php' ),
        'nonce'   => wp_create_nonce( 'portfolio-elite-nonce' ),
        'siteUrl' => home_url(),
        'themeUrl' => PORTFOLIO_ELITE_URI,
    ) );

    // Comments reply
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'portfolio_elite_scripts' );

/**
 * Register widget areas
 */
function portfolio_elite_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Sidebar', 'portfolio-elite' ),
        'id'            => 'sidebar-1',
        'description'   => __( 'Main sidebar widget area', 'portfolio-elite' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s glass">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title gradient-text">',
        'after_title'   => '</h3>',
    ) );

    // Footer widgets
    for ( $i = 1; $i <= 4; $i++ ) {
        register_sidebar( array(
            'name'          => sprintf( __( 'Footer Widget Area %d', 'portfolio-elite' ), $i ),
            'id'            => 'footer-' . $i,
            'description'   => sprintf( __( 'Footer column %d widget area', 'portfolio-elite' ), $i ),
            'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ) );
    }
}
add_action( 'widgets_init', 'portfolio_elite_widgets_init' );

/**
 * Register Custom Post Type: Portfolio
 */
function portfolio_elite_register_portfolio_cpt() {
    $labels = array(
        'name'               => _x( 'Portfolio', 'post type general name', 'portfolio-elite' ),
        'singular_name'      => _x( 'Portfolio Item', 'post type singular name', 'portfolio-elite' ),
        'menu_name'          => _x( 'Portfolio', 'admin menu', 'portfolio-elite' ),
        'add_new'            => _x( 'Add New', 'portfolio item', 'portfolio-elite' ),
        'add_new_item'       => __( 'Add New Portfolio Item', 'portfolio-elite' ),
        'new_item'           => __( 'New Portfolio Item', 'portfolio-elite' ),
        'edit_item'          => __( 'Edit Portfolio Item', 'portfolio-elite' ),
        'view_item'          => __( 'View Portfolio Item', 'portfolio-elite' ),
        'all_items'          => __( 'All Portfolio Items', 'portfolio-elite' ),
        'search_items'       => __( 'Search Portfolio', 'portfolio-elite' ),
        'not_found'          => __( 'No portfolio items found', 'portfolio-elite' ),
        'not_found_in_trash' => __( 'No portfolio items found in Trash', 'portfolio-elite' ),
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
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'revisions' ),
        'show_in_rest'       => true,
    );

    register_post_type( 'portfolio', $args );
}
add_action( 'init', 'portfolio_elite_register_portfolio_cpt' );

/**
 * Register Custom Taxonomy: Portfolio Category
 */
function portfolio_elite_register_portfolio_taxonomy() {
    $labels = array(
        'name'              => _x( 'Categories', 'taxonomy general name', 'portfolio-elite' ),
        'singular_name'     => _x( 'Category', 'taxonomy singular name', 'portfolio-elite' ),
        'search_items'      => __( 'Search Categories', 'portfolio-elite' ),
        'all_items'         => __( 'All Categories', 'portfolio-elite' ),
        'parent_item'       => __( 'Parent Category', 'portfolio-elite' ),
        'edit_item'         => __( 'Edit Category', 'portfolio-elite' ),
        'update_item'       => __( 'Update Category', 'portfolio-elite' ),
        'add_new_item'      => __( 'Add New Category', 'portfolio-elite' ),
        'new_item_name'     => __( 'New Category Name', 'portfolio-elite' ),
        'menu_name'         => __( 'Categories', 'portfolio-elite' ),
    );

    register_taxonomy( 'portfolio_category', array( 'portfolio' ), array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'portfolio-category' ),
        'show_in_rest'      => true,
    ) );
}
add_action( 'init', 'portfolio_elite_register_portfolio_taxonomy' );

/**
 * Add Portfolio Meta Boxes
 */
function portfolio_elite_add_meta_boxes() {
    add_meta_box(
        'portfolio_details',
        __( 'Portfolio Details', 'portfolio-elite' ),
        'portfolio_elite_portfolio_details_callback',
        'portfolio',
        'normal',
        'high'
    );

    add_meta_box(
        'portfolio_pdf',
        __( 'PDF Reports & Documents', 'portfolio-elite' ),
        'portfolio_elite_pdf_callback',
        'portfolio',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'portfolio_elite_add_meta_boxes' );

/**
 * Portfolio Details Meta Box Callback
 */
function portfolio_elite_portfolio_details_callback( $post ) {
    wp_nonce_field( 'portfolio_elite_save_details', 'portfolio_elite_details_nonce' );

    $client = get_post_meta( $post->ID, '_portfolio_client', true );
    $url = get_post_meta( $post->ID, '_portfolio_url', true );
    $date = get_post_meta( $post->ID, '_portfolio_date', true );
    $technologies = get_post_meta( $post->ID, '_portfolio_technologies', true );
    $duration = get_post_meta( $post->ID, '_portfolio_duration', true );
    $team_size = get_post_meta( $post->ID, '_portfolio_team_size', true );
    ?>
    <table class="form-table">
        <tr>
            <th><label for="portfolio_client"><?php _e( 'Client Name', 'portfolio-elite' ); ?></label></th>
            <td><input type="text" id="portfolio_client" name="portfolio_client" value="<?php echo esc_attr( $client ); ?>" class="widefat"></td>
        </tr>
        <tr>
            <th><label for="portfolio_url"><?php _e( 'Project URL', 'portfolio-elite' ); ?></label></th>
            <td><input type="url" id="portfolio_url" name="portfolio_url" value="<?php echo esc_url( $url ); ?>" class="widefat"></td>
        </tr>
        <tr>
            <th><label for="portfolio_date"><?php _e( 'Project Date', 'portfolio-elite' ); ?></label></th>
            <td><input type="text" id="portfolio_date" name="portfolio_date" value="<?php echo esc_attr( $date ); ?>" class="widefat" placeholder="e.g. June 2024"></td>
        </tr>
        <tr>
            <th><label for="portfolio_duration"><?php _e( 'Project Duration', 'portfolio-elite' ); ?></label></th>
            <td><input type="text" id="portfolio_duration" name="portfolio_duration" value="<?php echo esc_attr( $duration ); ?>" class="widefat" placeholder="e.g. 3 months"></td>
        </tr>
        <tr>
            <th><label for="portfolio_team_size"><?php _e( 'Team Size', 'portfolio-elite' ); ?></label></th>
            <td><input type="number" id="portfolio_team_size" name="portfolio_team_size" value="<?php echo esc_attr( $team_size ); ?>" class="widefat" min="1"></td>
        </tr>
        <tr>
            <th><label for="portfolio_technologies"><?php _e( 'Technologies Used', 'portfolio-elite' ); ?></label></th>
            <td>
                <textarea id="portfolio_technologies" name="portfolio_technologies" rows="3" class="widefat"><?php echo esc_textarea( $technologies ); ?></textarea>
                <p class="description"><?php _e( 'Enter technologies separated by commas', 'portfolio-elite' ); ?></p>
            </td>
        </tr>
    </table>
    <?php
}

/**
 * PDF Meta Box Callback
 */
function portfolio_elite_pdf_callback( $post ) {
    wp_nonce_field( 'portfolio_elite_save_pdf', 'portfolio_elite_pdf_nonce' );

    $pdf_files = get_post_meta( $post->ID, '_portfolio_pdf_files', true );
    if ( ! is_array( $pdf_files ) ) {
        $pdf_files = array();
    }
    ?>
    <div id="pdf-files-container">
        <?php foreach ( $pdf_files as $index => $pdf ) : ?>
            <div class="pdf-file-row" style="margin-bottom: 20px; padding: 15px; border: 1px solid #ddd; border-radius: 4px;">
                <p>
                    <label><?php _e( 'PDF Title', 'portfolio-elite' ); ?></label><br>
                    <input type="text" name="pdf_files[<?php echo $index; ?>][title]" value="<?php echo esc_attr( $pdf['title'] ?? '' ); ?>" class="widefat">
                </p>
                <p>
                    <label><?php _e( 'PDF URL', 'portfolio-elite' ); ?></label><br>
                    <input type="url" name="pdf_files[<?php echo $index; ?>][url]" value="<?php echo esc_url( $pdf['url'] ?? '' ); ?>" class="widefat pdf-url-input">
                    <button type="button" class="button upload-pdf-button"><?php _e( 'Upload PDF', 'portfolio-elite' ); ?></button>
                </p>
                <p>
                    <label><?php _e( 'Description', 'portfolio-elite' ); ?></label><br>
                    <textarea name="pdf_files[<?php echo $index; ?>][description]" rows="2" class="widefat"><?php echo esc_textarea( $pdf['description'] ?? '' ); ?></textarea>
                </p>
                <button type="button" class="button remove-pdf-file"><?php _e( 'Remove PDF', 'portfolio-elite' ); ?></button>
            </div>
        <?php endforeach; ?>
    </div>
    <button type="button" id="add-pdf-file" class="button button-primary"><?php _e( 'Add PDF File', 'portfolio-elite' ); ?></button>

    <script>
    jQuery(document).ready(function($) {
        let pdfIndex = <?php echo count( $pdf_files ); ?>;

        $('#add-pdf-file').on('click', function() {
            const html = `
                <div class="pdf-file-row" style="margin-bottom: 20px; margin-top: 20px; padding: 15px; border: 1px solid #ddd; border-radius: 4px;">
                    <p>
                        <label><?php _e( 'PDF Title', 'portfolio-elite' ); ?></label><br>
                        <input type="text" name="pdf_files[${pdfIndex}][title]" class="widefat">
                    </p>
                    <p>
                        <label><?php _e( 'PDF URL', 'portfolio-elite' ); ?></label><br>
                        <input type="url" name="pdf_files[${pdfIndex}][url]" class="widefat pdf-url-input">
                        <button type="button" class="button upload-pdf-button"><?php _e( 'Upload PDF', 'portfolio-elite' ); ?></button>
                    </p>
                    <p>
                        <label><?php _e( 'Description', 'portfolio-elite' ); ?></label><br>
                        <textarea name="pdf_files[${pdfIndex}][description]" rows="2" class="widefat"></textarea>
                    </p>
                    <button type="button" class="button remove-pdf-file"><?php _e( 'Remove PDF', 'portfolio-elite' ); ?></button>
                </div>
            `;
            $('#pdf-files-container').append(html);
            pdfIndex++;
        });

        $(document).on('click', '.remove-pdf-file', function() {
            $(this).closest('.pdf-file-row').remove();
        });

        // Media uploader for PDFs
        $(document).on('click', '.upload-pdf-button', function(e) {
            e.preventDefault();
            const button = $(this);
            const input = button.prev('.pdf-url-input');

            const mediaUploader = wp.media({
                title: '<?php _e( 'Choose PDF', 'portfolio-elite' ); ?>',
                button: {
                    text: '<?php _e( 'Use this PDF', 'portfolio-elite' ); ?>'
                },
                library: {
                    type: 'application/pdf'
                },
                multiple: false
            });

            mediaUploader.on('select', function() {
                const attachment = mediaUploader.state().get('selection').first().toJSON();
                input.val(attachment.url);
            });

            mediaUploader.open();
        });
    });
    </script>
    <?php
}

/**
 * Save Portfolio Meta
 */
function portfolio_elite_save_portfolio_meta( $post_id ) {
    // Check nonce for details
    if ( isset( $_POST['portfolio_elite_details_nonce'] ) && wp_verify_nonce( $_POST['portfolio_elite_details_nonce'], 'portfolio_elite_save_details' ) ) {
        if ( isset( $_POST['portfolio_client'] ) ) {
            update_post_meta( $post_id, '_portfolio_client', sanitize_text_field( $_POST['portfolio_client'] ) );
        }
        if ( isset( $_POST['portfolio_url'] ) ) {
            update_post_meta( $post_id, '_portfolio_url', esc_url_raw( $_POST['portfolio_url'] ) );
        }
        if ( isset( $_POST['portfolio_date'] ) ) {
            update_post_meta( $post_id, '_portfolio_date', sanitize_text_field( $_POST['portfolio_date'] ) );
        }
        if ( isset( $_POST['portfolio_duration'] ) ) {
            update_post_meta( $post_id, '_portfolio_duration', sanitize_text_field( $_POST['portfolio_duration'] ) );
        }
        if ( isset( $_POST['portfolio_team_size'] ) ) {
            update_post_meta( $post_id, '_portfolio_team_size', absint( $_POST['portfolio_team_size'] ) );
        }
        if ( isset( $_POST['portfolio_technologies'] ) ) {
            update_post_meta( $post_id, '_portfolio_technologies', sanitize_textarea_field( $_POST['portfolio_technologies'] ) );
        }
    }

    // Check nonce for PDFs
    if ( isset( $_POST['portfolio_elite_pdf_nonce'] ) && wp_verify_nonce( $_POST['portfolio_elite_pdf_nonce'], 'portfolio_elite_save_pdf' ) ) {
        if ( isset( $_POST['pdf_files'] ) && is_array( $_POST['pdf_files'] ) ) {
            $pdf_files = array();
            foreach ( $_POST['pdf_files'] as $pdf ) {
                $pdf_files[] = array(
                    'title'       => sanitize_text_field( $pdf['title'] ?? '' ),
                    'url'         => esc_url_raw( $pdf['url'] ?? '' ),
                    'description' => sanitize_textarea_field( $pdf['description'] ?? '' ),
                );
            }
            update_post_meta( $post_id, '_portfolio_pdf_files', $pdf_files );
        }
    }
}
add_action( 'save_post_portfolio', 'portfolio_elite_save_portfolio_meta' );

/**
 * Body Classes
 */
function portfolio_elite_body_classes( $classes ) {
    if ( is_singular() ) {
        $classes[] = 'singular';
    }
    if ( is_active_sidebar( 'sidebar-1' ) ) {
        $classes[] = 'has-sidebar';
    }
    return $classes;
}
add_filter( 'body_class', 'portfolio_elite_body_classes' );

/**
 * Excerpt length
 */
function portfolio_elite_excerpt_length( $length ) {
    return 30;
}
add_filter( 'excerpt_length', 'portfolio_elite_excerpt_length', 999 );

/**
 * Excerpt more
 */
function portfolio_elite_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'portfolio_elite_excerpt_more' );

// Include additional files
require_once PORTFOLIO_ELITE_DIR . '/inc/template-tags.php';
require_once PORTFOLIO_ELITE_DIR . '/inc/customizer.php';
