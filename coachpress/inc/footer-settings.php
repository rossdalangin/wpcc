<?php
/**
 * CoachPress Theme Customizer Footer Settings
 *
 * @package CoachPress
 */

function coachpress_customize_register_footer_settings( $wp_customize ) {
    // Footer Settings Panel
    $wp_customize->add_panel( 'coachpress_footer_panel', array(
        'title'    => __( 'Footer Settings', 'coachpress' ),
        'priority' => 31,
        'description' => __( 'Customize the appearance of your site footer, including colors and spacing.', 'coachpress' ),
    ) );

    // Footer Colors Section
    $wp_customize->add_section( 'coachpress_footer_colors', array(
        'title'    => __( 'Colors', 'coachpress' ),
        'panel'    => 'coachpress_footer_panel',
    ) );

    $wp_customize->add_setting( 'coachpress_footer_bg_color', array(
        'default'   => '#1A1A1A',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_footer_bg_color', array(
        'label'    => __( 'Background Color', 'coachpress' ),
        'section'  => 'coachpress_footer_colors',
    ) ) );

    $wp_customize->add_setting( 'coachpress_footer_text_color', array(
        'default'   => '#FFFFFF',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_footer_text_color', array(
        'label'    => __( 'Text Color', 'coachpress' ),
        'section'  => 'coachpress_footer_colors',
    ) ) );

    $wp_customize->add_setting( 'coachpress_footer_link_color', array(
        'default'   => '#FFFFFF',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_footer_link_color', array(
        'label'    => __( 'Link Color', 'coachpress' ),
        'section'  => 'coachpress_footer_colors',
    ) ) );

    $wp_customize->add_setting( 'coachpress_footer_link_hover_color', array(
        'default'   => '#FFC107',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_footer_link_hover_color', array(
        'label'    => __( 'Link Hover Color', 'coachpress' ),
        'section'  => 'coachpress_footer_colors',
    ) ) );

    // Footer Spacing Section
    $wp_customize->add_section( 'coachpress_footer_spacing', array(
        'title'    => __( 'Spacing', 'coachpress' ),
        'panel'    => 'coachpress_footer_panel',
    ) );

    $wp_customize->add_setting( 'coachpress_footer_padding_y', array(
        'default'   => '60px',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'coachpress_footer_padding_y', array(
        'label'    => __( 'Padding (Top/Bottom)', 'coachpress' ),
        'description' => __( 'Enter a value with a CSS unit (e.g., 60px, 2rem).', 'coachpress' ),
        'section'  => 'coachpress_footer_spacing',
        'type'     => 'text',
    ) );
}
add_action( 'customize_register', 'coachpress_customize_register_footer_settings' );
