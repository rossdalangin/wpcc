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
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_primary_color', array( 'label' => __( 'Primary Color', 'coachpress' ), 'section'  => 'coachpress_global_colors' ) ) );
	$wp_customize->add_setting( 'coachpress_secondary_color', array( 'default'   => '#F5F5F5', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_secondary_color', array( 'label' => __( 'Secondary Color', 'coachpress' ), 'section'  => 'coachpress_global_colors' ) ) );
    $wp_customize->add_setting( 'coachpress_accent_color', array( 'default'   => '#FFC107', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_accent_color', array( 'label' => __( 'Accent Color', 'coachpress' ), 'section'  => 'coachpress_global_colors' ) ) );
	$wp_customize->add_setting( 'coachpress_text_color', array( 'default'   => '#333333', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_text_color', array( 'label' => __( 'Text Color', 'coachpress' ), 'section'  => 'coachpress_global_colors' ) ) );
    $wp_customize->add_setting( 'coachpress_dark_bg_color', array( 'default'   => '#1A1A1A', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_dark_bg_color', array( 'label' => __( 'Dark Background Color', 'coachpress' ), 'section'  => 'coachpress_global_colors' ) ) );

    // -- Typography --
	$wp_customize->add_setting( 'coachpress_body_font', array( 'default'   => 'Lato', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( new CoachPress_Google_Font_Control( $wp_customize, 'coachpress_body_font', array( 'label' => __( 'Body Font', 'coachpress' ), 'section'  => 'coachpress_global_typography' ) ) );
    $wp_customize->add_setting( 'coachpress_body_font_weight', array( 'default'   => '400', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'coachpress_body_font_weight', array( 'label' => __( 'Body Font Weight', 'coachpress' ), 'section'  => 'coachpress_global_typography', 'type' => 'text' ) );
    $wp_customize->add_setting( 'coachpress_body_line_height', array( 'default'   => '1.6', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'coachpress_body_line_height', array( 'label' => __( 'Body Line Height', 'coachpress' ), 'section'  => 'coachpress_global_typography', 'type' => 'text' ) );
	$wp_customize->add_setting( 'coachpress_heading_font', array( 'default'   => 'Lora', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( new CoachPress_Google_Font_Control( $wp_customize, 'coachpress_heading_font', array( 'label' => __( 'Heading Font', 'coachpress' ), 'section'  => 'coachpress_global_typography' ) ) );
    $wp_customize->add_setting( 'coachpress_heading_font_weight', array( 'default'   => '700', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'coachpress_heading_font_weight', array( 'label' => __( 'Heading Font Weight', 'coachpress' ), 'section'  => 'coachpress_global_typography', 'type' => 'text' ) );
    $wp_customize->add_setting( 'coachpress_heading_letter_spacing', array( 'default'   => '1px', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'coachpress_heading_letter_spacing', array( 'label' => __( 'Heading Letter Spacing', 'coachpress' ), 'section'  => 'coachpress_global_typography', 'type' => 'text' ) );
    $wp_customize->add_setting( 'coachpress_body_font_size', array( 'default'   => json_encode( array( 'desktop' => '16px', 'tablet' => '16px', 'mobile' => '15px' ) ), 'transport' => 'refresh', 'sanitize_callback' => 'coachpress_sanitize_responsive_font_size' ) );
    $wp_customize->add_control( new CoachPress_Responsive_Font_Size_Control( $wp_customize, 'coachpress_body_font_size', array( 'label' => __( 'Body Font Size', 'coachpress' ), 'section'  => 'coachpress_global_typography' ) ) );
    $default_heading_font_sizes = array(
        'h1' => array('desktop' => '2.8rem', 'tablet' => '2.4rem', 'mobile' => '2rem'),
        'h2' => array('desktop' => '2.2rem', 'tablet' => '2rem', 'mobile' => '1.8rem'),
        'h3' => array('desktop' => '1.5rem', 'tablet' => '1.4rem', 'mobile' => '1.3rem'),
        'h4' => array('desktop' => '1.25rem', 'tablet' => '1.2rem', 'mobile' => '1.1rem'),
        'h5' => array('desktop' => '1.1rem', 'tablet' => '1.05rem', 'mobile' => '1rem'),
        'h6' => array('desktop' => '1rem', 'tablet' => '1rem', 'mobile' => '1rem'),
    );

    for ( $i = 1; $i <= 6; $i++ ) {
        $wp_customize->add_setting( "coachpress_h{$i}_font_size", array( 'default'   => json_encode($default_heading_font_sizes['h'.$i]), 'transport' => 'refresh', 'sanitize_callback' => 'coachpress_sanitize_responsive_font_size' ) );
        $wp_customize->add_control( new CoachPress_Responsive_Font_Size_Control( $wp_customize, "coachpress_h{$i}_font_size", array( 'label' => sprintf( __( 'H%s Font Size', 'coachpress' ), $i ), 'section'  => 'coachpress_global_typography' ) ) );
    }

    // -- Cards --
    $wp_customize->add_setting( 'coachpress_card_bg_color', array( 'default' => '#FFFFFF', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_card_bg_color', array( 'label' => __( 'Background Color', 'coachpress' ), 'section' => 'coachpress_cards' ) ) );
    $wp_customize->add_setting( 'coachpress_card_border_radius', array( 'default' => '4px', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'coachpress_card_border_radius', array( 'label' => __( 'Border Radius', 'coachpress' ), 'section' => 'coachpress_cards', 'type' => 'text' ) );
    $wp_customize->add_setting( 'coachpress_card_box_shadow', array( 'default' => '0 0 25px rgba(0,0,0,0.07)', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'coachpress_card_box_shadow', array( 'label' => __( 'Box Shadow', 'coachpress' ), 'section' => 'coachpress_cards', 'type' => 'text' ) );
    $wp_customize->add_setting( 'coachpress_card_hover_box_shadow', array( 'default' => '0 12px 25px rgba(0,0,0,0.1)', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'coachpress_card_hover_box_shadow', array( 'label' => __( 'Hover Box Shadow', 'coachpress' ), 'section' => 'coachpress_cards', 'type' => 'text' ) );
    $wp_customize->add_setting( 'coachpress_card_padding', array( 'default' => json_encode( array( 'top' => '20px', 'right' => '20px', 'bottom' => '20px', 'left' => '20px' ) ), 'transport' => 'refresh', 'sanitize_callback' => 'coachpress_sanitize_dimensions' ) );
    $wp_customize->add_control( new CoachPress_Dimensions_Control( $wp_customize, 'coachpress_card_padding', array( 'label' => __( 'Card Padding', 'coachpress' ), 'section' => 'coachpress_cards' ) ) );
    $wp_customize->add_setting( 'coachpress_card_margin', array( 'default' => json_encode( array( 'top' => '0', 'right' => '0', 'bottom' => '20px', 'left' => '0' ) ), 'transport' => 'refresh', 'sanitize_callback' => 'coachpress_sanitize_dimensions' ) );
    $wp_customize->add_control( new CoachPress_Dimensions_Control( $wp_customize, 'coachpress_card_margin', array( 'label' => __( 'Card Margin', 'coachpress' ), 'section' => 'coachpress_cards' ) ) );

    // -- Layout --
    $wp_customize->add_setting( 'coachpress_container_width', array( 'default' => '1140px', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'coachpress_container_width', array( 'label' => __( 'Container Width', 'coachpress' ), 'section' => 'coachpress_layout', 'type' => 'text' ) );
    $wp_customize->add_setting( 'coachpress_section_padding', array( 'default' => json_encode( array( 'top' => '60px', 'right' => '0', 'bottom' => '60px', 'left' => '0' ) ), 'transport' => 'refresh', 'sanitize_callback' => 'coachpress_sanitize_dimensions' ) );
    $wp_customize->add_control( new CoachPress_Dimensions_Control( $wp_customize, 'coachpress_section_padding', array( 'label' => __( 'Section Padding', 'coachpress' ), 'section' => 'coachpress_layout' ) ) );

    // -- Images --
    $wp_customize->add_setting( 'coachpress_image_border_radius', array( 'default' => json_encode( array( 'top-left' => '0px', 'top-right' => '0px', 'bottom-right' => '0px', 'bottom-left' => '0px' ) ), 'transport' => 'refresh', 'sanitize_callback' => 'coachpress_sanitize_border_radius' ) );
    $wp_customize->add_control( new CoachPress_Border_Radius_Control( $wp_customize, 'coachpress_image_border_radius', array( 'label' => __( 'Image Border Radius', 'coachpress' ), 'section' => 'coachpress_images' ) ) );
    $wp_customize->add_setting( 'coachpress_image_width', array( 'default' => '100%', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'coachpress_image_width', array( 'label' => __( 'Image Width', 'coachpress' ), 'section' => 'coachpress_images', 'type' => 'text' ) );

    // -- Forms --
    $wp_customize->add_setting( 'coachpress_form_field_bg_color', array( 'default' => '#FFFFFF', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_form_field_bg_color', array( 'label' => __( 'Background Color', 'coachpress' ), 'section' => 'coachpress_forms' ) ) );
    $wp_customize->add_setting( 'coachpress_form_field_text_color', array( 'default' => '#333333', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_form_field_text_color', array( 'label' => __( 'Text Color', 'coachpress' ), 'section' => 'coachpress_forms' ) ) );
    $wp_customize->add_setting( 'coachpress_form_field_border_color', array( 'default' => '#CCCCCC', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_form_field_border_color', array( 'label' => __( 'Border Color', 'coachpress' ), 'section' => 'coachpress_forms' ) ) );
    $wp_customize->add_setting( 'coachpress_form_field_border_radius', array( 'default' => '4px', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'coachpress_form_field_border_radius', array( 'label' => __( 'Border Radius', 'coachpress' ), 'section' => 'coachpress_forms', 'type' => 'text' ) );
    $wp_customize->add_setting( 'coachpress_form_width', array( 'default' => '100%', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'coachpress_form_width', array( 'label' => __( 'Form Width', 'coachpress' ), 'section' => 'coachpress_forms', 'type' => 'text' ) );
}
