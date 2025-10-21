<?php
/**
 * Theme Customizer
 *
 * @package Portfolio_Elite
 * @since 2.0.0
 */

function portfolio_elite_customize_register( $wp_customize ) {
    // Site Identity
    $wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

    // Portfolio Elite Settings Section
    $wp_customize->add_section( 'portfolio_elite_settings', array(
        'title'    => __( 'Portfolio Elite Settings', 'portfolio-elite' ),
        'priority' => 30,
    ) );

    // Hero Title
    $wp_customize->add_setting( 'portfolio_elite_hero_title', array(
        'default'           => __( 'Creative Professional', 'portfolio-elite' ),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( 'portfolio_elite_hero_title', array(
        'label'   => __( 'Hero Title', 'portfolio-elite' ),
        'section' => 'portfolio_elite_settings',
        'type'    => 'text',
    ) );

    // Primary Color
    $wp_customize->add_setting( 'portfolio_elite_primary_color', array(
        'default'           => '#6366f1',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'portfolio_elite_primary_color', array(
        'label'   => __( 'Primary Color', 'portfolio-elite' ),
        'section' => 'colors',
    ) ) );
}
add_action( 'customize_register', 'portfolio_elite_customize_register' );

function portfolio_elite_customizer_css() {
    $primary_color = get_theme_mod( 'portfolio_elite_primary_color', '#6366f1' );
    ?>
    <style type="text/css">
        :root {
            --color-primary-500: <?php echo esc_attr( $primary_color ); ?>;
        }
    </style>
    <?php
}
add_action( 'wp_head', 'portfolio_elite_customizer_css' );
