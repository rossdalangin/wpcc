<?php
/**
 * Customizer Global Style Controls
 *
 * @package CoachPress
 */

function coachpress_customize_global_styles( $wp_customize ) {
    //======================================================================
    // Controls: Global Styles
    //======================================================================

    // -- Colors --
	$wp_customize->add_setting( 'coachpress_primary_color', array( 'default'   => '#0D2F4F', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_primary_color', array( 'label' => __( 'Primary Color', 'coachpress' ), 'description' => __('Used for headings, links, and primary buttons.', 'coachpress'), 'section'  => 'coachpress_global_colors' ) ) );
	$wp_customize->add_setting( 'coachpress_secondary_color', array( 'default'   => '#F5F5F5', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_secondary_color', array( 'label' => __( 'Secondary Color', 'coachpress' ), 'description' => __('Used for backgrounds and subtle elements.', 'coachpress'), 'section'  => 'coachpress_global_colors' ) ) );
    $wp_customize->add_setting( 'coachpress_accent_color', array( 'default'   => '#FFC107', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_accent_color', array( 'label' => __( 'Accent Color', 'coachpress' ), 'description' => __('Used for highlights and call-to-action hover states.', 'coachpress'), 'section'  => 'coachpress_global_colors' ) ) );
	$wp_customize->add_setting( 'coachpress_text_color', array( 'default'   => '#333333', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_text_color', array( 'label' => __( 'Body Text Color', 'coachpress' ), 'section'  => 'coachpress_global_colors' ) ) );

    // -- Typography --
	$wp_customize->add_setting( 'coachpress_body_font', array( 'default'   => 'Lato', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( new CoachPress_Google_Font_Control( $wp_customize, 'coachpress_body_font', array( 'label' => __( 'Body Font Family', 'coachpress' ), 'section'  => 'coachpress_global_typography' ) ) );
    $wp_customize->add_setting( 'coachpress_heading_font', array( 'default'   => 'Lora', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( new CoachPress_Google_Font_Control( $wp_customize, 'coachpress_heading_font', array( 'label' => __( 'Heading Font Family', 'coachpress' ), 'section'  => 'coachpress_global_typography' ) ) );

    // -- Cards --
    $wp_customize->add_section( 'coachpress_cards', array( 'title' => __( 'Cards', 'coachpress' ), 'panel' => 'coachpress_global_styles_panel', 'description' => __('Customize the appearance of grid items like Services, Testimonials, and Team members.', 'coachpress') ) );
    $wp_customize->add_setting( 'coachpress_card_bg_color', array( 'default' => '#FFFFFF', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_card_bg_color', array( 'label' => __( 'Card Background Color', 'coachpress' ), 'section' => 'coachpress_cards' ) ) );
    $wp_customize->add_setting( 'coachpress_card_border_radius', array( 'default' => '8px', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'coachpress_card_border_radius', array( 'label' => __( 'Card Border Radius', 'coachpress' ), 'section' => 'coachpress_cards' ) );

    // -- Images --
    $wp_customize->add_setting( 'coachpress_image_border_radius', array( 'default' => json_encode( array( 'top-left' => '8px', 'top-right' => '8px', 'bottom-right' => '8px', 'bottom-left' => '8px' ) ), 'transport' => 'refresh', 'sanitize_callback' => 'coachpress_sanitize_border_radius' ) );
    $wp_customize->add_control( new CoachPress_Border_Radius_Control( $wp_customize, 'coachpress_image_border_radius', array( 'label' => __( 'Global Image Border Radius', 'coachpress' ), 'section' => 'coachpress_images' ) ) );

    // -- Layout --
    $wp_customize->add_setting( 'coachpress_container_width', array( 'default' => '1200px', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'coachpress_container_width', array( 'label' => __( 'Max Container Width', 'coachpress' ), 'section' => 'coachpress_layout' ) );
}
