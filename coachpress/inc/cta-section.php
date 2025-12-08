<?php
/**
 * CoachPress Theme Customizer CTA Section
 *
 * @package CoachPress
 */

function coachpress_customize_register_cta_section( $wp_customize ) {
    $wp_customize->add_section( 'coachpress_cta_section', array(
        'title'    => __( 'CTA Section', 'coachpress' ),
        'priority' => 110,
    ) );

    $wp_customize->add_setting( 'coachpress_cta_heading', array(
        'default'   => __( 'Ready to get started?', 'coachpress' ),
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'coachpress_cta_heading', array(
        'label'    => __( 'Heading', 'coachpress' ),
        'section'  => 'coachpress_cta_section',
        'settings' => 'coachpress_cta_heading',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'coachpress_cta_subheading', array(
        'default'   => __( 'Contact us today to get started on your journey to success.', 'coachpress' ),
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'coachpress_cta_subheading', array(
        'label'    => __( 'Subheading', 'coachpress' ),
        'section'  => 'coachpress_cta_section',
        'settings' => 'coachpress_cta_subheading',
        'type'     => 'textarea',
    ) );

    $wp_customize->add_setting( 'coachpress_cta_button_text', array(
        'default'   => __( 'Contact Us', 'coachpress' ),
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'coachpress_cta_button_text', array(
        'label'    => __( 'Button Text', 'coachpress' ),
        'section'  => 'coachpress_cta_section',
        'settings' => 'coachpress_cta_button_text',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'coachpress_cta_button_url', array(
        'default'   => '#',
        'transport' => 'refresh',
        'sanitize_callback' => 'esc_url_raw',
    ) );

    $wp_customize->add_control( 'coachpress_cta_button_url', array(
        'label'    => __( 'Button URL', 'coachpress' ),
        'section'  => 'coachpress_cta_section',
        'settings' => 'coachpress_cta_button_url',
        'type'     => 'url',
    ) );
}
add_action( 'customize_register', 'coachpress_customize_register_cta_section' );
