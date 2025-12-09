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
        'description' => __( 'Configure the main call-to-action button in the site header. This is a key conversion point.', 'coachpress' ),
    ) );

    $wp_customize->add_setting( 'coachpress_header_cta_text', array(
        'default'   => __( 'Contact Us', 'coachpress' ),
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'coachpress_header_cta_text', array(
        'label'    => __( 'Button Text', 'coachpress' ),
        'description' => __( 'The text displayed on the button.', 'coachpress' ),
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
        'description' => __( 'Select the button\'s action. "URL" links to a page. "HTML" or "Shortcode" opens a modal popup with the content.', 'coachpress' ),
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
        'label'    => __( 'Button URL', 'coachpress' ),
        'description' => __( 'Enter the full URL where the button should link.', 'coachpress' ),
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
        'label'    => __( 'Modal HTML Content', 'coachpress' ),
        'description' => __( 'Enter the HTML to display in the popup modal. Can include form embed code.', 'coachpress' ),
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
        'label'    => __( 'Modal Shortcode', 'coachpress' ),
        'description' => __( 'Enter a shortcode (e.g., from a form plugin) to render in the popup modal.', 'coachpress' ),
        'section'  => 'coachpress_header_cta',
        'settings' => 'coachpress_header_cta_shortcode',
        'type'     => 'text',
        'active_callback' => function() {
            return 'shortcode' === get_theme_mod( 'coachpress_header_cta_type' );
        },
    ) );
}
add_action( 'customize_register', 'coachpress_customize_register_header_cta' );
