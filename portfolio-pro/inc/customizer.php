<?php
/**
 * Portfolio Pro Theme Customizer
 *
 * @package Portfolio_Pro
 * @since 1.0.0
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function portfolio_pro_customize_register( $wp_customize ) {
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

    if ( isset( $wp_customize->selective_refresh ) ) {
        $wp_customize->selective_refresh->add_partial(
            'blogname',
            array(
                'selector'        => '.site-logo',
                'render_callback' => 'portfolio_pro_customize_partial_blogname',
            )
        );
        $wp_customize->selective_refresh->add_partial(
            'blogdescription',
            array(
                'selector'        => '.site-description',
                'render_callback' => 'portfolio_pro_customize_partial_blogdescription',
            )
        );
    }

    // Add Portfolio Pro Settings Section
    $wp_customize->add_section(
        'portfolio_pro_settings',
        array(
            'title'    => __( 'Portfolio Pro Settings', 'portfolio-pro' ),
            'priority' => 30,
        )
    );

    // Hero Section Settings
    $wp_customize->add_setting(
        'portfolio_pro_hero_title',
        array(
            'default'           => __( 'Creative Professional', 'portfolio-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        'portfolio_pro_hero_title',
        array(
            'label'       => __( 'Hero Title', 'portfolio-pro' ),
            'section'     => 'portfolio_pro_settings',
            'type'        => 'text',
            'description' => __( 'Enter the main title for the hero section', 'portfolio-pro' ),
        )
    );

    $wp_customize->add_setting(
        'portfolio_pro_hero_subtitle',
        array(
            'default'           => __( 'Designer & Developer', 'portfolio-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        'portfolio_pro_hero_subtitle',
        array(
            'label'   => __( 'Hero Subtitle', 'portfolio-pro' ),
            'section' => 'portfolio_pro_settings',
            'type'    => 'text',
        )
    );

    $wp_customize->add_setting(
        'portfolio_pro_hero_description',
        array(
            'default'           => __( 'I create beautiful digital experiences', 'portfolio-pro' ),
            'sanitize_callback' => 'sanitize_textarea_field',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        'portfolio_pro_hero_description',
        array(
            'label'   => __( 'Hero Description', 'portfolio-pro' ),
            'section' => 'portfolio_pro_settings',
            'type'    => 'textarea',
        )
    );

    // Social Media Settings
    $social_networks = array(
        'facebook'  => __( 'Facebook URL', 'portfolio-pro' ),
        'twitter'   => __( 'Twitter URL', 'portfolio-pro' ),
        'linkedin'  => __( 'LinkedIn URL', 'portfolio-pro' ),
        'github'    => __( 'GitHub URL', 'portfolio-pro' ),
        'instagram' => __( 'Instagram URL', 'portfolio-pro' ),
        'dribbble'  => __( 'Dribbble URL', 'portfolio-pro' ),
    );

    foreach ( $social_networks as $network => $label ) {
        $wp_customize->add_setting(
            'portfolio_pro_' . $network,
            array(
                'default'           => '',
                'sanitize_callback' => 'esc_url_raw',
            )
        );

        $wp_customize->add_control(
            'portfolio_pro_' . $network,
            array(
                'label'   => $label,
                'section' => 'portfolio_pro_settings',
                'type'    => 'url',
            )
        );
    }

    // Color Settings
    $wp_customize->add_setting(
        'portfolio_pro_primary_color',
        array(
            'default'           => '#6366f1',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'portfolio_pro_primary_color',
            array(
                'label'   => __( 'Primary Color', 'portfolio-pro' ),
                'section' => 'colors',
            )
        )
    );

    $wp_customize->add_setting(
        'portfolio_pro_secondary_color',
        array(
            'default'           => '#ec4899',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'portfolio_pro_secondary_color',
            array(
                'label'   => __( 'Secondary Color', 'portfolio-pro' ),
                'section' => 'colors',
            )
        )
    );
}
add_action( 'customize_register', 'portfolio_pro_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function portfolio_pro_customize_partial_blogname() {
    bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function portfolio_pro_customize_partial_blogdescription() {
    bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function portfolio_pro_customize_preview_js() {
    wp_enqueue_script(
        'portfolio-pro-customizer',
        get_template_directory_uri() . '/assets/js/customizer.js',
        array( 'customize-preview' ),
        wp_get_theme()->get( 'Version' ),
        true
    );
}
add_action( 'customize_preview_init', 'portfolio_pro_customize_preview_js' );

/**
 * Output custom CSS for customizer colors
 */
function portfolio_pro_customizer_css() {
    $primary_color = get_theme_mod( 'portfolio_pro_primary_color', '#6366f1' );
    $secondary_color = get_theme_mod( 'portfolio_pro_secondary_color', '#ec4899' );

    ?>
    <style type="text/css">
        :root {
            --primary-color: <?php echo esc_attr( $primary_color ); ?>;
            --secondary-color: <?php echo esc_attr( $secondary_color ); ?>;
        }
    </style>
    <?php
}
add_action( 'wp_head', 'portfolio_pro_customizer_css' );
