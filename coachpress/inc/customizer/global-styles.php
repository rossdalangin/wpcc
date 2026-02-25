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
	$wp_customize->add_setting( 'coachpress_primary_color', array( 'default'   => '#1a365d', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_primary_color', array( 'label' => __( 'Primary Color', 'coachpress' ), 'description' => __('A deep, trustworthy color for headings and main elements.', 'coachpress'), 'section'  => 'coachpress_global_colors' ) ) );
	$wp_customize->add_setting( 'coachpress_secondary_color', array( 'default'   => '#f7fafc', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_secondary_color', array( 'label' => __( 'Secondary Color', 'coachpress' ), 'description' => __('A light neutral color for section backgrounds.', 'coachpress'), 'section'  => 'coachpress_global_colors' ) ) );
    $wp_customize->add_setting( 'coachpress_accent_color', array( 'default'   => '#c0a080', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_accent_color', array( 'label' => __( 'Accent Color', 'coachpress' ), 'description' => __('A premium accent color for highlights and calls to action.', 'coachpress'), 'section'  => 'coachpress_global_colors' ) ) );
	$wp_customize->add_setting( 'coachpress_text_color', array( 'default'   => '#2d3748', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_text_color', array( 'label' => __( 'Body Text Color', 'coachpress' ), 'section'  => 'coachpress_global_colors' ) ) );

    // -- Typography --
	$wp_customize->add_setting( 'coachpress_body_font', array( 'default'   => 'Inter', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( new CoachPress_Google_Font_Control( $wp_customize, 'coachpress_body_font', array( 'label' => __( 'Body Font Family', 'coachpress' ), 'section'  => 'coachpress_global_typography' ) ) );
    $wp_customize->add_setting( 'coachpress_heading_font', array( 'default'   => 'Playfair Display', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( new CoachPress_Google_Font_Control( $wp_customize, 'coachpress_heading_font', array( 'label' => __( 'Heading Font Family', 'coachpress' ), 'section'  => 'coachpress_global_typography' ) ) );

    // -- Cards --
    $wp_customize->add_section( 'coachpress_cards', array( 'title' => __( 'Cards', 'coachpress' ), 'panel' => 'coachpress_global_styles_panel', 'description' => __('Customize the appearance of grid items like Services, Testimonials, and Team members.', 'coachpress') ) );
    $wp_customize->add_setting( 'coachpress_card_bg_color', array( 'default' => '#FFFFFF', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_card_bg_color', array( 'label' => __( 'Card Background Color', 'coachpress' ), 'section' => 'coachpress_cards' ) ) );
    $wp_customize->add_setting( 'coachpress_card_border_radius', array( 'default' => '12px', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'coachpress_card_border_radius', array( 'label' => __( 'Card Border Radius', 'coachpress' ), 'section' => 'coachpress_cards' ) );

    $wp_customize->add_setting( 'coachpress_card_border_color', array( 'default' => 'transparent', 'transport' => 'refresh', 'sanitize_callback' => 'coachpress_sanitize_rgba_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_card_border_color', array( 'label' => __( 'Card Border Color', 'coachpress' ), 'section' => 'coachpress_cards' ) ) );
    $wp_customize->add_setting( 'coachpress_card_border_width', array( 'default' => '0px', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'coachpress_card_border_width', array( 'label' => __( 'Card Border Width', 'coachpress' ), 'section' => 'coachpress_cards', 'type' => 'text' ) );

    $wp_customize->add_setting( 'coachpress_card_padding', array( 'default' => json_encode(array('top' => '40px', 'right' => '40px', 'bottom' => '40px', 'left' => '40px')), 'transport' => 'refresh', 'sanitize_callback' => 'coachpress_sanitize_dimensions' ) );
    $wp_customize->add_control( new CoachPress_Dimensions_Control( $wp_customize, 'coachpress_card_padding', array( 'label' => __( 'Card Inner Padding', 'coachpress' ), 'section' => 'coachpress_cards' ) ) );

    $wp_customize->add_setting( 'coachpress_card_margin', array( 'default' => json_encode(array('top' => '0', 'right' => '0', 'bottom' => '0', 'left' => '0')), 'transport' => 'refresh', 'sanitize_callback' => 'coachpress_sanitize_dimensions' ) );
    $wp_customize->add_control( new CoachPress_Dimensions_Control( $wp_customize, 'coachpress_card_margin', array( 'label' => __( 'Card Outer Margin', 'coachpress' ), 'section' => 'coachpress_cards' ) ) );

    // -- Images --
    $wp_customize->add_setting( 'coachpress_image_border_radius', array( 'default' => json_encode( array( 'top-left' => '12px', 'top-right' => '12px', 'bottom-right' => '12px', 'bottom-left' => '12px' ) ), 'transport' => 'refresh', 'sanitize_callback' => 'coachpress_sanitize_border_radius' ) );
    $wp_customize->add_control( new CoachPress_Border_Radius_Control( $wp_customize, 'coachpress_image_border_radius', array( 'label' => __( 'Global Image Border Radius', 'coachpress' ), 'section' => 'coachpress_images' ) ) );

    // -- Forms --
    $wp_customize->add_setting( 'coachpress_form_field_bg_color', array( 'default' => '#FFFFFF', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_form_field_bg_color', array( 'label' => __( 'Field Background Color', 'coachpress' ), 'section' => 'coachpress_forms' ) ) );
    $wp_customize->add_setting( 'coachpress_form_field_text_color', array( 'default' => '#2d3748', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_form_field_text_color', array( 'label' => __( 'Field Text Color', 'coachpress' ), 'section' => 'coachpress_forms' ) ) );
    $wp_customize->add_setting( 'coachpress_form_field_border_color', array( 'default' => '#e2e8f0', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_form_field_border_color', array( 'label' => __( 'Field Border Color', 'coachpress' ), 'section' => 'coachpress_forms' ) ) );
    $wp_customize->add_setting( 'coachpress_form_field_border_radius', array( 'default' => '6px', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'coachpress_form_field_border_radius', array( 'label' => __( 'Field Border Radius', 'coachpress' ), 'section' => 'coachpress_forms' ) );

    // -- Layout --
    $wp_customize->add_setting( 'coachpress_container_width', array( 'default' => '1240px', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'coachpress_container_width', array( 'label' => __( 'Max Container Width', 'coachpress' ), 'section' => 'coachpress_layout' ) );
}
