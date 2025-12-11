<?php
/**
 * CoachPress Theme Customizer Header Settings
 *
 * @package CoachPress
 */

function coachpress_customize_register_header_settings( $wp_customize ) {
    // Header Settings Section
    $wp_customize->add_section( 'coachpress_header_settings', array(
        'title'    => __( 'Header', 'coachpress' ),
        'panel'    => 'coachpress_theme_settings_panel',
        'priority' => 30,
    ) );

    $wp_customize->add_setting( 'coachpress_header_bg_color', array(
        'default'   => '#FFFFFF',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_header_bg_color', array(
        'label'    => __( 'Background Color', 'coachpress' ),
        'section'  => 'coachpress_header_settings',
    ) ) );

    $wp_customize->add_setting( 'coachpress_header_text_color', array(
        'default'   => '#333333',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_header_text_color', array(
        'label'    => __( 'Text Color', 'coachpress' ),
        'section'  => 'coachpress_header_settings',
    ) ) );

    $wp_customize->add_setting( 'coachpress_header_link_color', array(
        'default'   => '#0D2F4F',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_header_link_color', array(
        'label'    => __( 'Link Color', 'coachpress' ),
        'section'  => 'coachpress_header_settings',
    ) ) );

    $wp_customize->add_setting( 'coachpress_header_link_hover_color', array(
        'default'   => '#FFC107',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_header_link_hover_color', array(
        'label'    => __( 'Link Hover Color', 'coachpress' ),
        'section'  => 'coachpress_header_settings',
    ) ) );

    $wp_customize->add_setting( 'coachpress_header_hamburger_color', array(
        'default'   => '#333333',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_header_hamburger_color', array(
        'label'    => __( 'Mobile Menu (Hamburger) Color', 'coachpress' ),
        'section'  => 'coachpress_header_settings',
    ) ) );

    $wp_customize->add_setting( 'coachpress_mobile_menu_bg_color', array(
        'default'   => '#FFFFFF',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_mobile_menu_bg_color', array(
        'label'    => __( 'Mobile Menu Background Color', 'coachpress' ),
        'section'  => 'coachpress_header_settings',
    ) ) );

    $wp_customize->add_setting( 'coachpress_mobile_menu_hover_bg_color', array(
        'default'   => '#F5F5F5',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_mobile_menu_hover_bg_color', array(
        'label'    => __( 'Mobile Menu Hover Background Color', 'coachpress' ),
        'section'  => 'coachpress_header_settings',
    ) ) );

    $wp_customize->add_setting( 'coachpress_header_padding_y', array(
        'default'   => '15px',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'coachpress_header_padding_y', array(
        'label'    => __( 'Padding (Top/Bottom)', 'coachpress' ),
        'description' => __( 'Enter a value with a CSS unit (e.g., 15px, 1rem).', 'coachpress' ),
        'section'  => 'coachpress_header_settings',
        'type'     => 'text',
    ) );
}
add_action( 'customize_register', 'coachpress_customize_register_header_settings' );
