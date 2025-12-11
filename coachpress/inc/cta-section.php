<?php
/**
 * CoachPress Theme Customizer CTA Section
 *
 * @package CoachPress
 */

function coachpress_customize_register_cta_section( $wp_customize ) {
    $wp_customize->add_section( 'coachpress_cta_section', array(
        'title'    => __( 'CTA', 'coachpress' ),
        'panel'    => 'coachpress_homepage_sections_panel',
        'priority' => 110,
        'description' => __( 'Configure the dedicated Call-to-Action section. This can be placed anywhere on the homepage via the Section Ordering & Visibility panel.', 'coachpress' ),
    ) );

    $wp_customize->add_setting( 'coachpress_cta_heading', array(
        'default'   => __( 'Ready to Get Started?', 'coachpress' ),
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
        'default'   => __( 'Take the first step towards achieving your goals. Contact us today for a free consultation.', 'coachpress' ),
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
        'default'   => __( 'Book a Free Consultation', 'coachpress' ),
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
        'default'   => '#contact',
        'transport' => 'refresh',
        'sanitize_callback' => 'esc_url_raw',
    ) );

    $wp_customize->add_control( 'coachpress_cta_button_url', array(
        'label'    => __( 'Button URL', 'coachpress' ),
        'description' => __( 'Enter the URL where the button should link. An anchor link like #contact is recommended.', 'coachpress' ),
        'section'  => 'coachpress_cta_section',
        'settings' => 'coachpress_cta_button_url',
        'type'     => 'url',
    ) );

    $wp_customize->add_setting( 'coachpress_cta_alignment', array(
        'default'   => 'center',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_key',
    ) );

    $wp_customize->add_control( 'coachpress_cta_alignment', array(
        'label'    => __( 'Alignment', 'coachpress' ),
        'section'  => 'coachpress_cta_section',
        'type'     => 'select',
        'choices'  => array(
            'left'   => __( 'Left', 'coachpress' ),
            'center' => __( 'Center', 'coachpress' ),
            'right'  => __( 'Right', 'coachpress' ),
        ),
    ) );
}
add_action( 'customize_register', 'coachpress_customize_register_cta_section' );
