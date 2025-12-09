<?php
/**
 * CoachPress Theme Customizer Component Styles
 *
 * @package CoachPress
 */

function coachpress_customize_register_component_styles( $wp_customize ) {
    // Component Styles Panel
    $wp_customize->add_panel( 'coachpress_component_styles_panel', array(
        'title'    => __( 'Component Styles', 'coachpress' ),
        'priority' => 32,
        'description' => __( 'Customize the appearance of reusable components like cards and sections.', 'coachpress' ),
    ) );

    // Cards Section
    $wp_customize->add_section( 'coachpress_cards', array(
        'title'    => __( 'Cards', 'coachpress' ),
        'panel'    => 'coachpress_component_styles_panel',
    ) );

    $wp_customize->add_setting( 'coachpress_card_bg_color', array(
        'default'   => '#FFFFFF',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_card_bg_color', array(
        'label'    => __( 'Background Color', 'coachpress' ),
        'section'  => 'coachpress_cards',
    ) ) );

    $wp_customize->add_setting( 'coachpress_card_border_radius', array(
        'default'   => '4px',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'coachpress_card_border_radius', array(
        'label'    => __( 'Border Radius', 'coachpress' ),
        'description' => __( 'Enter a value with a CSS unit (e.g., 4px, 1rem).', 'coachpress' ),
        'section'  => 'coachpress_cards',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'coachpress_card_box_shadow', array(
        'default'   => '0 0 25px rgba(0,0,0,0.07)',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'coachpress_card_box_shadow', array(
        'label'    => __( 'Box Shadow', 'coachpress' ),
        'description' => __( 'Enter a valid CSS box-shadow value.', 'coachpress' ),
        'section'  => 'coachpress_cards',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'coachpress_card_hover_box_shadow', array(
        'default'   => '0 12px 25px rgba(0,0,0,0.1)',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'coachpress_card_hover_box_shadow', array(
        'label'    => __( 'Hover Box Shadow', 'coachpress' ),
        'description' => __( 'Enter a valid CSS box-shadow value for the hover effect.', 'coachpress' ),
        'section'  => 'coachpress_cards',
        'type'     => 'text',
    ) );

    // Sections Section
    $wp_customize->add_section( 'coachpress_sections', array(
        'title'    => __( 'Sections', 'coachpress' ),
        'panel'    => 'coachpress_component_styles_panel',
    ) );

    $wp_customize->add_setting( 'coachpress_section_padding_y', array(
        'default'   => '60px',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'coachpress_section_padding_y', array(
        'label'    => __( 'Padding (Top/Bottom)', 'coachpress' ),
        'description' => __( 'Enter a value with a CSS unit (e.g., 60px, 2rem).', 'coachpress' ),
        'section'  => 'coachpress_sections',
        'type'     => 'text',
    ) );
}
add_action( 'customize_register', 'coachpress_customize_register_component_styles' );
