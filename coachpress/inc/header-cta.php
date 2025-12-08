<?php
/**
 * CoachPress Theme Customizer Header CTA
 *
 * @package CoachPress
 */

function coachpress_customize_register_header_cta( $wp_customize ) {
    $wp_customize->add_section( 'coachpress_header_cta', array(
        'title'    => __( 'Header CTA Button', 'coachpress' ),
        'priority' => 40,
    ) );

    $wp_customize->add_setting( 'coachpress_header_cta_text', array(
        'default'   => __( 'Contact Us', 'coachpress' ),
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'coachpress_header_cta_text', array(
        'label'    => __( 'Button Text', 'coachpress' ),
        'section'  => 'coachpress_header_cta',
        'settings' => 'coachpress_header_cta_text',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'coachpress_header_cta_type', array(
        'default'   => 'url',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_key',
    ) );

    $wp_customize->add_control( 'coachpress_header_cta_type', array(
        'label'    => __( 'CTA Type', 'coachpress' ),
        'section'  => 'coachpress_header_cta',
        'settings' => 'coachpress_header_cta_type',
        'type'     => 'select',
        'choices'  => array(
            'url'       => __( 'URL', 'coachpress' ),
            'html'      => __( 'HTML', 'coachpress' ),
            'shortcode' => __( 'Shortcode', 'coachpress' ),
        ),
    ) );

    $wp_customize->add_setting( 'coachpress_header_cta_url', array(
        'default'   => '#',
        'transport' => 'refresh',
        'sanitize_callback' => 'esc_url_raw',
    ) );

    $wp_customize->add_control( 'coachpress_header_cta_url', array(
        'label'    => __( 'URL', 'coachpress' ),
        'section'  => 'coachpress_header_cta',
        'settings' => 'coachpress_header_cta_url',
        'type'     => 'url',
        'active_callback' => function() {
            return 'url' === get_theme_mod( 'coachpress_header_cta_type' );
        },
    ) );

    $wp_customize->add_setting( 'coachpress_header_cta_html', array(
        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post',
    ) );

    $wp_customize->add_control( 'coachpress_header_cta_html', array(
        'label'    => __( 'HTML', 'coachpress' ),
        'section'  => 'coachpress_header_cta',
        'settings' => 'coachpress_header_cta_html',
        'type'     => 'textarea',
        'active_callback' => function() {
            return 'html' === get_theme_mod( 'coachpress_header_cta_type' );
        },
    ) );

    $wp_customize->add_setting( 'coachpress_header_cta_shortcode', array(
        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'coachpress_header_cta_shortcode', array(
        'label'    => __( 'Shortcode', 'coachpress' ),
        'section'  => 'coachpress_header_cta',
        'settings' => 'coachpress_header_cta_shortcode',
        'type'     => 'text',
        'active_callback' => function() {
            return 'shortcode' === get_theme_mod( 'coachpress_header_cta_type' );
        },
    ) );
}
add_action( 'customize_register', 'coachpress_customize_register_header_cta' );
