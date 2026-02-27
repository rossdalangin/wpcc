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
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_primary_color', array( 'label' => __( 'Primary Brand Color', 'coachpress' ), 'description' => __('This is your main brand color. It will be used for big headings, icons, and primary UI elements. Use a bold, professional color here (e.g., Navy #1a365d).', 'coachpress'), 'section'  => 'coachpress_global_colors' ) ) );

    $wp_customize->add_setting( 'coachpress_secondary_color', array( 'default'   => '#f7fafc', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_secondary_color', array( 'label' => __( 'Secondary Background Color', 'coachpress' ), 'description' => __('This color is used for light section backgrounds and subtle UI elements. A light gray or off-white works best (e.g., #f7fafc).', 'coachpress'), 'section'  => 'coachpress_global_colors' ) ) );

    $wp_customize->add_setting( 'coachpress_accent_color', array( 'default'   => '#c0a080', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_accent_color', array( 'label' => __( 'Accent/Highlight Color', 'coachpress' ), 'description' => __('Used for buttons, small badges, and calls to action. Pick a color that "pops" against your primary color (e.g., Gold #c0a080).', 'coachpress'), 'section'  => 'coachpress_global_colors' ) ) );

    $wp_customize->add_setting( 'coachpress_text_color', array( 'default'   => '#2d3748', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_text_color', array( 'label' => __( 'Main Body Text Color', 'coachpress' ), 'description' => __('The default color for all paragraphs and standard text. Dark grays are easier to read than pure black (e.g., #2d3748).', 'coachpress'), 'section'  => 'coachpress_global_colors' ) ) );

    $wp_customize->add_setting( 'coachpress_muted_text_color', array( 'default'   => '#718096', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_muted_text_color', array( 'label' => __( 'Muted/Subtitle Text Color', 'coachpress' ), 'description' => __('A lighter version of your text color for secondary details like dates or category names (e.g., #718096).', 'coachpress'), 'section'  => 'coachpress_global_colors' ) ) );

    $wp_customize->add_setting( 'coachpress_link_color', array( 'default'   => '#1a365d', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_link_color', array( 'label' => __( 'Link Color', 'coachpress' ), 'description' => __('The color of clickable text links throughout your site.', 'coachpress'), 'section'  => 'coachpress_global_colors' ) ) );

    $wp_customize->add_setting( 'coachpress_link_hover_color', array( 'default'   => '#c0a080', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_link_hover_color', array( 'label' => __( 'Link Hover Color', 'coachpress' ), 'description' => __('The color a link changes to when you move your mouse over it.', 'coachpress'), 'section'  => 'coachpress_global_colors' ) ) );

    $wp_customize->add_setting( 'coachpress_button_hover_bg_color', array( 'default'   => '#1a365d', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_button_hover_bg_color', array( 'label' => __( 'Button Hover Background', 'coachpress' ), 'description' => __('The background color of a button when hovered.', 'coachpress'), 'section'  => 'coachpress_global_colors' ) ) );

    $wp_customize->add_setting( 'coachpress_button_hover_text_color', array( 'default'   => '#FFFFFF', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_button_hover_text_color', array( 'label' => __( 'Button Hover Text Color', 'coachpress' ), 'description' => __('The color of the text on a button when hovered.', 'coachpress'), 'section'  => 'coachpress_global_colors' ) ) );

    // -- Buttons --
    $wp_customize->add_section( 'coachpress_buttons_styles', array( 'title' => __( 'Global Button Styles', 'coachpress' ), 'panel' => 'coachpress_global_styles_panel', 'description' => __('Default settings for all buttons. These can be overridden in individual sections.', 'coachpress') ) );

    $wp_customize->add_setting( 'coachpress_button_bg_color', array( 'default' => '#c0a080', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_button_bg_color', array( 'label' => __( 'Default Button Background', 'coachpress' ), 'section' => 'coachpress_buttons_styles' ) ) );

    $wp_customize->add_setting( 'coachpress_button_text_color', array( 'default' => '#FFFFFF', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_button_text_color', array( 'label' => __( 'Default Button Text', 'coachpress' ), 'section' => 'coachpress_buttons_styles' ) ) );

    $wp_customize->add_setting( 'coachpress_button_border_radius', array( 'default' => '6px', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'coachpress_button_border_radius', array( 'label' => __( 'Button Corner Roundness', 'coachpress' ), 'section' => 'coachpress_buttons_styles' ) );

    // -- Typography --
	$wp_customize->add_setting( 'coachpress_body_font', array( 'default'   => 'Inter', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( new CoachPress_Google_Font_Control( $wp_customize, 'coachpress_body_font', array( 'label' => __( 'Body Font Family', 'coachpress' ), 'description' => __('The main font used for all paragraphs and general reading. Clean fonts like "Inter" or "Lato" are recommended.', 'coachpress'), 'section'  => 'coachpress_global_typography' ) ) );
    $wp_customize->add_setting( 'coachpress_heading_font', array( 'default'   => 'Playfair Display', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( new CoachPress_Google_Font_Control( $wp_customize, 'coachpress_heading_font', array( 'label' => __( 'Heading Font Family', 'coachpress' ), 'description' => __('The font used for titles (H1 to H6). Professional serif fonts like "Playfair Display" add authority.', 'coachpress'), 'section'  => 'coachpress_global_typography' ) ) );

    // -- Cards --
    $wp_customize->add_section( 'coachpress_cards', array( 'title' => __( 'Cards', 'coachpress' ), 'panel' => 'coachpress_global_styles_panel', 'description' => __('"Cards" are the individual boxes used for Services, Team members, and Portfolio items. These settings control their look and feel.', 'coachpress') ) );
    $wp_customize->add_setting( 'coachpress_card_bg_color', array( 'default' => '#FFFFFF', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_card_bg_color', array( 'label' => __( 'Card Background Color', 'coachpress' ), 'description' => __('The background color of each box. Keep this white or very light for best readability.', 'coachpress'), 'section' => 'coachpress_cards' ) ) );
    $wp_customize->add_setting( 'coachpress_card_border_radius', array( 'default' => '12px', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'coachpress_card_border_radius', array( 'label' => __( 'Corner Roundness (px)', 'coachpress' ), 'description' => __('How rounded the corners of your cards are. Use "0px" for sharp corners or "12px" for a modern rounded look.', 'coachpress'), 'section' => 'coachpress_cards' ) );

    $wp_customize->add_setting( 'coachpress_card_border_color', array( 'default' => 'transparent', 'transport' => 'refresh', 'sanitize_callback' => 'coachpress_sanitize_rgba_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_card_border_color', array( 'label' => __( 'Card Border Color', 'coachpress' ), 'description' => __('The color of the thin line around each box. Set to transparent to hide.', 'coachpress'), 'section' => 'coachpress_cards' ) ) );
    $wp_customize->add_setting( 'coachpress_card_border_width', array( 'default' => '0px', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'coachpress_card_border_width', array( 'label' => __( 'Card Border Thickness (px)', 'coachpress' ), 'description' => __('The thickness of the box outline (e.g., 1px).', 'coachpress'), 'section' => 'coachpress_cards', 'type' => 'text' ) );

    $wp_customize->add_setting( 'coachpress_card_padding', array( 'default' => json_encode(array('top' => '40px', 'right' => '40px', 'bottom' => '40px', 'left' => '40px')), 'transport' => 'refresh', 'sanitize_callback' => 'coachpress_sanitize_dimensions' ) );
    $wp_customize->add_control( new CoachPress_Dimensions_Control( $wp_customize, 'coachpress_card_padding', array( 'label' => __( 'Internal Spacing (Padding)', 'coachpress' ), 'description' => __('The gap between the box edge and the content inside it (e.g., 40px).', 'coachpress'), 'section' => 'coachpress_cards' ) ) );

    $wp_customize->add_setting( 'coachpress_card_margin', array( 'default' => json_encode(array('top' => '0', 'right' => '0', 'bottom' => '0', 'left' => '0')), 'transport' => 'refresh', 'sanitize_callback' => 'coachpress_sanitize_dimensions' ) );
    $wp_customize->add_control( new CoachPress_Dimensions_Control( $wp_customize, 'coachpress_card_margin', array( 'label' => __( 'External Spacing (Margin)', 'coachpress' ), 'description' => __('The gap around the outside of each box.', 'coachpress'), 'section' => 'coachpress_cards' ) ) );

    // -- Images --
    $wp_customize->add_setting( 'coachpress_image_border_radius', array( 'default' => json_encode( array( 'top-left' => '12px', 'top-right' => '12px', 'bottom-right' => '12px', 'bottom-left' => '12px' ) ), 'transport' => 'refresh', 'sanitize_callback' => 'coachpress_sanitize_border_radius' ) );
    $wp_customize->add_control( new CoachPress_Border_Radius_Control( $wp_customize, 'coachpress_image_border_radius', array( 'label' => __( 'Global Image Corner Roundness', 'coachpress' ), 'description' => __('Control the roundness of every corner of your images independently. (e.g., 12px for all corners, or 40px 0px 40px 0px for a unique look).', 'coachpress'), 'section' => 'coachpress_images' ) ) );

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
