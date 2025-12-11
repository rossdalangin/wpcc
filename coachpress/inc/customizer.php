<?php
/**
 * CoachPress Theme Customizer
 *
 * @package CoachPress
 */

// Load Custom Controls
require_once get_template_directory() . '/inc/gradient-control.php';
require_once get_template_directory() . '/inc/responsive-font-size-control.php';
require_once get_template_directory() . '/inc/border-radius-control.php';
require_once get_template_directory() . '/inc/dimensions-control.php';
require_once get_template_directory() . '/inc/google-font-control.php';
require_once get_template_directory() . '/inc/section-order-control.php';

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function coachpress_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'coachpress_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'coachpress_customize_partial_blogdescription',
		) );
	}

    //======================================================================
    // Panels
    //======================================================================
    $wp_customize->add_panel( 'coachpress_global_styles_panel', array(
        'title'    => __( 'Global Styles', 'coachpress' ),
        'priority' => 20,
        'description' => __( 'Manage the overall look and feel of your site, including colors, typography, and layout.', 'coachpress' ),
    ) );
    $wp_customize->add_panel( 'coachpress_theme_settings_panel', array(
        'title'    => __( 'Theme Settings', 'coachpress' ),
        'priority' => 21,
        'description' => __( 'Configure general theme settings like the header, footer, and social media links.', 'coachpress' ),
    ) );
    $wp_customize->add_panel( 'coachpress_homepage_sections_panel', array(
        'title'    => __( 'Homepage Sections', 'coachpress' ),
        'priority' => 22,
        'description' => __( 'Manage the content, order, and appearance of each section on your homepage.', 'coachpress' ),
    ) );


    //======================================================================
    // Global Styles Sections
    //======================================================================
	$wp_customize->add_section( 'coachpress_global_colors', array( 'title' => __( 'Colors', 'coachpress' ), 'panel' => 'coachpress_global_styles_panel', 'description' => __( 'Define the main color palette for your site.', 'coachpress' ) ) );
	$wp_customize->add_section( 'coachpress_global_typography', array( 'title' => __( 'Typography', 'coachpress' ), 'panel' => 'coachpress_global_styles_panel', 'description' => __( 'Select and configure the fonts for your entire site.', 'coachpress' ) ) );
    $wp_customize->add_section( 'coachpress_cards', array( 'title' => __( 'Cards', 'coachpress' ), 'panel' => 'coachpress_global_styles_panel' ) );
    $wp_customize->add_section( 'coachpress_layout', array( 'title' => __( 'Layout', 'coachpress' ), 'panel' => 'coachpress_global_styles_panel' ) );
    $wp_customize->add_section( 'coachpress_images', array( 'title' => __( 'Images', 'coachpress' ), 'panel' => 'coachpress_global_styles_panel' ) );
    $wp_customize->add_section( 'coachpress_forms', array( 'title' => __( 'Form Fields', 'coachpress' ), 'panel' => 'coachpress_global_styles_panel' ) );

    //======================================================================
    // Theme Settings Sections
    //======================================================================
    $wp_customize->add_section( 'coachpress_header_settings', array( 'title' => __( 'Header', 'coachpress' ), 'panel' => 'coachpress_theme_settings_panel' ) );
    $wp_customize->add_section( 'coachpress_header_cta', array( 'title' => __( 'Header CTA Button', 'coachpress' ), 'panel' => 'coachpress_theme_settings_panel' ) );
    $wp_customize->add_section( 'coachpress_footer_settings', array( 'title' => __( 'Footer', 'coachpress' ), 'panel' => 'coachpress_theme_settings_panel' ) );
    $wp_customize->add_section( 'coachpress_social_media', array( 'title' => __( 'Social Media', 'coachpress' ), 'panel' => 'coachpress_theme_settings_panel' ) );

    //======================================================================
    // Homepage Sections
    //======================================================================
    $wp_customize->add_section( 'coachpress_section_ordering', array( 'title' => __( 'Section Ordering & Visibility', 'coachpress' ), 'panel' => 'coachpress_homepage_sections_panel', 'priority' => 1 ) );
    $wp_customize->add_section( 'coachpress_section_titles', array( 'title' => __( 'Section Titles', 'coachpress' ), 'panel' => 'coachpress_homepage_sections_panel', 'priority' => 2 ) );
    $sections = coachpress_get_section_choices();
    $section_priority = 10;
	foreach ( $sections as $section_id => $section_name ) {
        $wp_customize->add_section( "coachpress_{$section_id}_section", array(
            'title'    => $section_name,
            'panel'    => 'coachpress_homepage_sections_panel',
            'priority' => $section_priority++,
        ) );
	}

    //======================================================================
    // Page Template Sections
    //======================================================================
    $wp_customize->add_section( 'coachpress_contact_page', array( 'title' => __( 'Contact Page Template', 'coachpress' ), 'priority' => 50 ) );


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


    //======================================================================
    // Controls: Theme Settings
    //======================================================================

    // -- Header --
    $wp_customize->add_setting('coachpress_header_bg_color', array('default' => '#FFFFFF', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color'));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'coachpress_header_bg_color', array('label' => __('Background Color', 'coachpress'), 'section' => 'coachpress_header_settings')));
    $wp_customize->add_setting('coachpress_header_text_color', array('default' => '#333333', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color'));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'coachpress_header_text_color', array('label' => __('Text Color', 'coachpress'), 'section' => 'coachpress_header_settings')));
    $wp_customize->add_setting('coachpress_header_link_color', array('default' => '#0D2F4F', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color'));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'coachpress_header_link_color', array('label' => __('Link Color', 'coachpress'), 'section' => 'coachpress_header_settings')));
    $wp_customize->add_setting('coachpress_header_link_hover_color', array('default' => '#FFC107', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color'));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'coachpress_header_link_hover_color', array('label' => __('Link Hover Color', 'coachpress'), 'section' => 'coachpress_header_settings')));
    $wp_customize->add_setting('coachpress_header_padding_y', array('default' => '15px', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('coachpress_header_padding_y', array('label' => __('Top/Bottom Padding', 'coachpress'), 'section' => 'coachpress_header_settings', 'type' => 'text'));
    $wp_customize->add_setting('coachpress_header_hamburger_color', array('default' => '#333333', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color'));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'coachpress_header_hamburger_color', array('label' => __('Mobile Hamburger Color', 'coachpress'), 'section' => 'coachpress_header_settings')));
    $wp_customize->add_setting('coachpress_mobile_menu_bg_color', array('default' => '#FFFFFF', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color'));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'coachpress_mobile_menu_bg_color', array('label' => __('Mobile Menu Background', 'coachpress'), 'section' => 'coachpress_header_settings')));
    $wp_customize->add_setting('coachpress_mobile_menu_hover_bg_color', array('default' => '#F5F5F5', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color'));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'coachpress_mobile_menu_hover_bg_color', array('label' => __('Mobile Menu Item Hover BG', 'coachpress'), 'section' => 'coachpress_header_settings')));

    // -- Header CTA --
    $wp_customize->add_setting( 'coachpress_header_cta_visibility', array( 'default' => true, 'transport' => 'refresh', 'sanitize_callback' => 'wp_validate_boolean' ) );
    $wp_customize->add_control( 'coachpress_header_cta_visibility', array( 'label' => __( 'Show CTA Button', 'coachpress' ), 'section' => 'coachpress_header_cta', 'type' => 'checkbox' ) );
    $wp_customize->add_setting( 'coachpress_header_cta_text', array( 'default' => __( 'Get Started', 'coachpress' ), 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'coachpress_header_cta_text', array( 'label' => __( 'Button Text', 'coachpress' ), 'section' => 'coachpress_header_cta', 'type' => 'text' ) );
    $wp_customize->add_setting( 'coachpress_header_cta_type', array( 'default' => 'url', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_key' ) );
    $wp_customize->add_control( 'coachpress_header_cta_type', array( 'label' => __( 'CTA Type', 'coachpress' ), 'section' => 'coachpress_header_cta', 'type' => 'select', 'choices' => array( 'url' => __( 'URL', 'coachpress' ), 'html' => __( 'HTML', 'coachpress' ), 'shortcode' => __( 'Shortcode', 'coachpress' ) ) ) );
    $wp_customize->add_setting( 'coachpress_header_cta_url', array( 'default' => '#', 'transport' => 'refresh', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'coachpress_header_cta_url', array( 'label' => __( 'Button URL', 'coachpress' ), 'section' => 'coachpress_header_cta', 'type' => 'url', 'active_callback' => function() use ($wp_customize) { return 'url' === $wp_customize->get_setting('coachpress_header_cta_type')->value(); } ) );
    $wp_customize->add_setting( 'coachpress_header_cta_html', array( 'default' => '', 'transport' => 'refresh', 'sanitize_callback' => 'wp_kses_post' ) );
    $wp_customize->add_control( 'coachpress_header_cta_html', array( 'label' => __( 'Modal HTML Content', 'coachpress' ), 'section' => 'coachpress_header_cta', 'type' => 'textarea', 'active_callback' => function() use ($wp_customize) { return 'html' === $wp_customize->get_setting('coachpress_header_cta_type')->value(); } ) );
    $wp_customize->add_setting( 'coachpress_header_cta_shortcode', array( 'default' => '', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'coachpress_header_cta_shortcode', array( 'label' => __( 'Modal Shortcode', 'coachpress' ), 'section' => 'coachpress_header_cta', 'type' => 'text', 'active_callback' => function() use ($wp_customize) { return 'shortcode' === $wp_customize->get_setting('coachpress_header_cta_type')->value(); } ) );
    $wp_customize->add_setting( 'coachpress_header_cta_bg_color', array( 'default' => '#0D2F4F', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_header_cta_bg_color', array( 'label' => __( 'Background Color', 'coachpress' ), 'section' => 'coachpress_header_cta' ) ) );
    $wp_customize->add_setting( 'coachpress_header_cta_text_color', array( 'default' => '#FFFFFF', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_header_cta_text_color', array( 'label' => __( 'Text Color', 'coachpress' ), 'section' => 'coachpress_header_cta' ) ) );
    $wp_customize->add_setting( 'coachpress_header_cta_hover_bg_color', array( 'default' => '#FFC107', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_header_cta_hover_bg_color', array( 'label' => __( 'Hover Background Color', 'coachpress' ), 'section' => 'coachpress_header_cta' ) ) );
    $wp_customize->add_setting( 'coachpress_header_cta_hover_text_color', array( 'default' => '#0D2F4F', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_header_cta_hover_text_color', array( 'label' => __( 'Hover Text Color', 'coachpress' ), 'section' => 'coachpress_header_cta' ) ) );
    $wp_customize->add_setting( 'coachpress_header_cta_border_radius', array( 'default' => '4px', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'coachpress_header_cta_border_radius', array( 'label' => __( 'Border Radius', 'coachpress' ), 'section' => 'coachpress_header_cta', 'type' => 'text' ) );

    // -- Footer --
    $wp_customize->add_setting( 'coachpress_footer_bg_color', array( 'default' => '#1A1A1A', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_footer_bg_color', array( 'label' => __( 'Background Color', 'coachpress' ), 'section' => 'coachpress_footer_settings' ) ) );
    $wp_customize->add_setting( 'coachpress_footer_text_color', array( 'default' => '#FFFFFF', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_footer_text_color', array( 'label' => __( 'Text Color', 'coachpress' ), 'section' => 'coachpress_footer_settings' ) ) );
    $wp_customize->add_setting( 'coachpress_footer_link_color', array( 'default' => '#FFFFFF', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_footer_link_color', array( 'label' => __( 'Link Color', 'coachpress' ), 'section' => 'coachpress_footer_settings' ) ) );
    $wp_customize->add_setting( 'coachpress_footer_link_hover_color', array( 'default' => '#FFC107', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_footer_link_hover_color', array( 'label' => __( 'Link Hover Color', 'coachpress' ), 'section' => 'coachpress_footer_settings' ) ) );
    $wp_customize->add_setting( 'coachpress_footer_padding_y', array( 'default' => '60px', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'coachpress_footer_padding_y', array( 'label' => __( 'Top/Bottom Padding', 'coachpress' ), 'section' => 'coachpress_footer_settings', 'type' => 'text' ) );
    $wp_customize->add_setting( 'coachpress_footer_copyright_text', array( 'default' => '© ' . date('Y') . ' CoachPress. All Rights Reserved.', 'transport' => 'refresh', 'sanitize_callback' => 'wp_kses_post' ) );
    $wp_customize->add_control( 'coachpress_footer_copyright_text', array( 'label' => __( 'Copyright Text', 'coachpress' ), 'section' => 'coachpress_footer_settings', 'type' => 'textarea' ) );

    // -- Social Media --
    $social_networks = array( 'facebook', 'twitter', 'instagram', 'linkedin', 'youtube', 'pinterest' );
    foreach ( $social_networks as $network ) {
        $wp_customize->add_setting( "coachpress_social_{$network}", array( 'default' => '', 'transport' => 'refresh', 'sanitize_callback' => 'esc_url_raw' ) );
        $wp_customize->add_control( "coachpress_social_{$network}", array( 'label' => sprintf( __( '%s URL', 'coachpress' ), ucfirst( $network ) ), 'section' => 'coachpress_social_media', 'type' => 'url' ) );
    }


    //======================================================================
    // Controls: Homepage Sections
    //======================================================================

    // -- Section Ordering & Visibility --
    $sections = coachpress_get_section_choices();
    $wp_customize->add_setting( 'coachpress_section_order', array( 'default' => implode(',', array_keys($sections)), 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( new CoachPress_Section_Order_Control( $wp_customize, 'coachpress_section_order', array( 'label' => __( 'Homepage Section Order', 'coachpress' ), 'section' => 'coachpress_section_ordering', 'choices' => $sections ) ) );
    foreach ($sections as $section_id => $section_name) {
        $wp_customize->add_setting( "coachpress_section_visibility[{$section_id}]", array( 'default' => true, 'transport' => 'refresh', 'sanitize_callback' => 'wp_validate_boolean' ) );
        $wp_customize->add_control( "coachpress_section_visibility[{$section_id}]", array( 'label' => sprintf( __( 'Show %s Section', 'coachpress' ), $section_name ), 'section' => 'coachpress_section_ordering', 'type' => 'checkbox' ) );
    }

    // -- Content Controls moved into sections --
    $sections_with_content = array(
        'services' => ['title' => 'Our Services', 'description' => 'We offer a range of services to help you achieve your goals.'],
        'testimonials' => ['title' => 'What Our Clients Say', 'description' => ''],
        'case-studies' => ['title' => 'Case Studies', 'description' => ''],
        'processes' => ['title' => 'Our Process', 'description' => 'A clear path to success.'],
        'faqs' => ['title' => 'Frequently Asked Questions', 'description' => ''],
        'contact' => ['title' => 'Get in Touch', 'description' => 'We\'d love to hear from you.'],
        'problem' => ['title' => 'The Problem', 'description' => ''],
        'about-preview' => ['title' => 'About Us', 'description' => ''],
        'cta' => ['title' => 'Ready to Get Started?', 'description' => 'Take the first step towards a better you.']
    );
    foreach ( $sections_with_content as $section_id => $content ) {
        $section_handle = "coachpress_{$section_id}_section";
        $wp_customize->add_setting( "coachpress_{$section_id}_section_title", array( 'default' => $content['title'], 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( "coachpress_{$section_id}_section_title", array( 'label' => __( 'Section Title', 'coachpress' ), 'section' => $section_handle, 'type' => 'text', 'priority' => 1 ) );
        if (!empty($content['description'])) {
            $wp_customize->add_setting( "coachpress_{$section_id}_section_description", array( 'default' => $content['description'], 'transport' => 'refresh', 'sanitize_callback' => 'wp_kses_post' ) );
            $wp_customize->add_control( "coachpress_{$section_id}_section_description", array( 'label' => __( 'Section Description', 'coachpress' ), 'section' => $section_handle, 'type' => 'textarea', 'priority' => 2 ) );
        }
    }

    $wp_customize->add_setting( 'coachpress_cta_alignment', array( 'default' => 'center', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_key' ) );
    $wp_customize->add_control( 'coachpress_cta_alignment', array( 'label' => __( 'Alignment', 'coachpress' ), 'section' => 'coachpress_cta_section', 'type' => 'select', 'choices' => array( 'left' => __( 'Left', 'coachpress' ), 'center' => __( 'Center', 'coachpress' ), 'right' => __( 'Right', 'coachpress' ) ), 'priority' => 3 ) );

    // -- Services Section --
    $services = get_posts( array( 'post_type' => 'services', 'numberposts' => -1 ) );
    $service_choices = array();
    foreach ( $services as $service ) {
        $service_choices[ $service->ID ] = $service->post_title;
    }
    $wp_customize->add_setting( 'coachpress_services_posts', array( 'default' => '', 'transport' => 'refresh', 'sanitize_callback' => 'coachpress_sanitize_multi_select' ) );
    $wp_customize->add_control( new CoachPress_Multi_Select_Control( $wp_customize, 'coachpress_services_posts', array( 'label' => __( 'Select Services', 'coachpress' ), 'section' => 'coachpress_services_section', 'choices' => $service_choices, 'priority' => 3 ) ) );

    // -- Testimonials Section --
    $testimonials = get_posts( array( 'post_type' => 'testimonials', 'numberposts' => -1 ) );
    $testimonial_choices = array();
    foreach ( $testimonials as $testimonial ) {
        $testimonial_choices[ $testimonial->ID ] = $testimonial->post_title;
    }
    $wp_customize->add_setting( 'coachpress_testimonials_posts', array( 'default' => '', 'transport' => 'refresh', 'sanitize_callback' => 'coachpress_sanitize_multi_select' ) );
    $wp_customize->add_control( new CoachPress_Multi_Select_Control( $wp_customize, 'coachpress_testimonials_posts', array( 'label' => __( 'Select Testimonials', 'coachpress' ), 'section' => 'coachpress_testimonials_section', 'choices' => $testimonial_choices, 'priority' => 3 ) ) );

    // -- Case Studies Section --
    $case_studies = get_posts( array( 'post_type' => 'case-studies', 'numberposts' => -1 ) );
    $case_study_choices = array();
    foreach ( $case_studies as $case_study ) {
        $case_study_choices[ $case_study->ID ] = $case_study->post_title;
    }
    $wp_customize->add_setting( 'coachpress_case_studies_posts', array( 'default' => '', 'transport' => 'refresh', 'sanitize_callback' => 'coachpress_sanitize_multi_select' ) );
    $wp_customize->add_control( new CoachPress_Multi_Select_Control( $wp_customize, 'coachpress_case_studies_posts', array( 'label' => __( 'Select Case Studies', 'coachpress' ), 'section' => 'coachpress_case-studies_section', 'choices' => $case_study_choices, 'priority' => 3 ) ) );

    // -- Hero Section --
    $wp_customize->add_setting( 'coachpress_hero_bg_color', array( 'default' => '#F5F5F5', 'transport' => 'refresh', 'sanitize_callback' => 'coachpress_sanitize_background' ) );
    $wp_customize->add_control( new CoachPress_Gradient_Control( $wp_customize, 'coachpress_hero_bg_color', array( 'label' => __( 'Background', 'coachpress' ), 'section' => 'coachpress_hero_section' ) ) );
    $wp_customize->add_setting( 'coachpress_hero_heading_color', array( 'default' => '', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_hero_heading_color', array( 'label' => __( 'Heading Color', 'coachpress' ), 'section' => 'coachpress_hero_section' ) ) );
    $wp_customize->add_setting( 'coachpress_hero_text_color', array( 'default' => '', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_hero_text_color', array( 'label' => __( 'Text Color', 'coachpress' ), 'section' => 'coachpress_hero_section' ) ) );
    $wp_customize->add_setting( 'coachpress_hero_heading', array( 'default' => 'Unlock Your Potential', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'coachpress_hero_heading', array( 'label' => __( 'Heading', 'coachpress' ), 'section' => 'coachpress_hero_section', 'type' => 'text' ) );
    $wp_customize->add_setting( 'coachpress_hero_subheading', array( 'default' => 'Partner with a dedicated coach to achieve your personal and professional goals.', 'transport' => 'refresh', 'sanitize_callback' => 'wp_kses_post' ) );
    $wp_customize->add_control( 'coachpress_hero_subheading', array( 'label' => __( 'Subheading', 'coachpress' ), 'section' => 'coachpress_hero_section', 'type' => 'textarea' ) );
    $wp_customize->add_setting( 'coachpress_hero_cta_text', array( 'default' => 'Book a Free Call', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'coachpress_hero_cta_text', array( 'label' => __( 'CTA Text', 'coachpress' ), 'section' => 'coachpress_hero_section', 'type' => 'text' ) );

    $wp_customize->add_setting( 'coachpress_hero_left_button_2_text', array( 'default' => 'Learn More', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'coachpress_hero_left_button_2_text', array( 'label' => __( 'Second Button Text', 'coachpress' ), 'section' => 'coachpress_hero_section', 'type' => 'text' ) );
    $wp_customize->add_setting( 'coachpress_hero_left_button_2_url', array( 'default' => '#', 'transport' => 'refresh', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'coachpress_hero_left_button_2_url', array( 'label' => __( 'Second Button URL', 'coachpress' ), 'section' => 'coachpress_hero_section', 'type' => 'url' ) );

    $wp_customize->add_setting( 'coachpress_hero_cta_url', array( 'default' => '#contact', 'transport' => 'refresh', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'coachpress_hero_cta_url', array( 'label' => __( 'CTA URL', 'coachpress' ), 'section' => 'coachpress_hero_section', 'type' => 'url' ) );

    $wp_customize->add_setting( 'coachpress_hero_cta_2_visibility', array( 'default' => false, 'transport' => 'refresh', 'sanitize_callback' => 'wp_validate_boolean' ) );
    $wp_customize->add_control( 'coachpress_hero_cta_2_visibility', array( 'label' => __( 'Show Second CTA Button', 'coachpress' ), 'section' => 'coachpress_hero_section', 'type' => 'checkbox' ) );
    $wp_customize->add_setting( 'coachpress_hero_cta_2_text', array( 'default' => 'Learn More', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'coachpress_hero_cta_2_text', array( 'label' => __( 'Second CTA Text', 'coachpress' ), 'section' => 'coachpress_hero_section', 'type' => 'text', 'active_callback' => function() use ($wp_customize) { return $wp_customize->get_setting('coachpress_hero_cta_2_visibility')->value(); } ) );
    $wp_customize->add_setting( 'coachpress_hero_cta_2_url', array( 'default' => '#', 'transport' => 'refresh', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'coachpress_hero_cta_2_url', array( 'label' => __( 'Second CTA URL', 'coachpress' ), 'section' => 'coachpress_hero_section', 'type' => 'url', 'active_callback' => function() use ($wp_customize) { return $wp_customize->get_setting('coachpress_hero_cta_2_visibility')->value(); } ) );

    $wp_customize->add_setting( 'coachpress_hero_left_col_align', array( 'default' => 'left', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_key' ) );
    $wp_customize->add_control( 'coachpress_hero_left_col_align', array( 'label' => __( 'Left Column Alignment', 'coachpress' ), 'section' => 'coachpress_hero_section', 'type' => 'select', 'choices' => array( 'left' => __( 'Left', 'coachpress' ), 'center' => __( 'Center', 'coachpress' ), 'right' => __( 'Right', 'coachpress' ) ) ) );
    $wp_customize->add_setting( 'coachpress_hero_right_col_type', array( 'default' => 'image', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_key' ) );
    $wp_customize->add_control( 'coachpress_hero_right_col_type', array( 'label' => __( 'Right Column Content', 'coachpress' ), 'section' => 'coachpress_hero_section', 'type' => 'select', 'choices' => array( 'none' => __( 'Disabled', 'coachpress' ), 'image' => __( 'Image', 'coachpress' ), 'video' => __( 'Video', 'coachpress' ), 'html' => __( 'HTML', 'coachpress' ), 'shortcode' => __( 'Shortcode', 'coachpress' ) ) ) );
    $wp_customize->add_setting( 'coachpress_hero_right_col_image', array( 'default' => '', 'transport' => 'refresh', 'sanitize_callback' => 'absint' ) );
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'coachpress_hero_right_col_image', array( 'label' => __( 'Image', 'coachpress' ), 'section' => 'coachpress_hero_section', 'mime_type' => 'image', 'active_callback' => function() use ($wp_customize) { return 'image' === $wp_customize->get_setting('coachpress_hero_right_col_type')->value(); } ) ) );
    $wp_customize->add_setting( 'coachpress_hero_right_col_video', array( 'default' => '', 'transport' => 'refresh', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'coachpress_hero_right_col_video', array( 'label' => __( 'Video URL (YouTube/Vimeo)', 'coachpress' ), 'section' => 'coachpress_hero_section', 'type' => 'url', 'active_callback' => function() use ($wp_customize) { return 'video' === $wp_customize->get_setting('coachpress_hero_right_col_type')->value(); } ) );
    $wp_customize->add_setting( 'coachpress_hero_right_col_html', array( 'default' => '', 'transport' => 'refresh', 'sanitize_callback' => 'wp_kses_post' ) );
    $wp_customize->add_control( 'coachpress_hero_right_col_html', array( 'label' => __( 'HTML Content', 'coachpress' ), 'section' => 'coachpress_hero_section', 'type' => 'textarea', 'active_callback' => function() use ($wp_customize) { return 'html' === $wp_customize->get_setting('coachpress_hero_right_col_type')->value(); } ) );
    $wp_customize->add_setting( 'coachpress_hero_right_col_shortcode', array( 'default' => '', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'coachpress_hero_right_col_shortcode', array( 'label' => __( 'Shortcode', 'coachpress' ), 'section' => 'coachpress_hero_section', 'type' => 'text', 'active_callback' => function() use ($wp_customize) { return 'shortcode' === $wp_customize->get_setting('coachpress_hero_right_col_type')->value(); } ) );

    // -- Per-Section Colors --
    foreach ( $sections as $section_id => $section_name ) {
        if ( 'hero' !== $section_id ) {
            $wp_customize->add_setting( "coachpress_{$section_id}_bg_color", array( 'default' => '', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, "coachpress_{$section_id}_bg_color", array( 'label' => __( 'Background Color', 'coachpress' ), 'section' => "coachpress_{$section_id}_section" ) ) );
            $wp_customize->add_setting( "coachpress_{$section_id}_heading_color", array( 'default' => '', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, "coachpress_{$section_id}_heading_color", array( 'label' => __( 'Heading Color', 'coachpress' ), 'section' => "coachpress_{$section_id}_section" ) ) );
            $wp_customize->add_setting( "coachpress_{$section_id}_text_color", array( 'default' => '', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, "coachpress_{$section_id}_text_color", array( 'label' => __( 'Text Color', 'coachpress' ), 'section' => "coachpress_{$section_id}_section" ) ) );
        }
    }

    //======================================================================
    // Controls: Page Templates
    //======================================================================

    // -- Contact Page --
    $wp_customize->add_setting( 'coachpress_contact_page_form_type', array( 'default' => 'shortcode', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_key' ) );
    $wp_customize->add_control( 'coachpress_contact_page_form_type', array( 'label' => __( 'Form Type', 'coachpress' ), 'section' => 'coachpress_contact_page', 'type' => 'select', 'choices' => array( 'html' => __( 'HTML', 'coachpress' ), 'shortcode' => __( 'Shortcode', 'coachpress' ) ) ) );
    $wp_customize->add_setting( 'coachpress_contact_page_html', array( 'default' => '', 'transport' => 'refresh', 'sanitize_callback' => 'wp_kses_post' ) );
    $wp_customize->add_control( 'coachpress_contact_page_html', array( 'label' => __( 'HTML Content', 'coachpress' ), 'section' => 'coachpress_contact_page', 'type' => 'textarea', 'active_callback' => function() use ($wp_customize) { return 'html' === $wp_customize->get_setting('coachpress_contact_page_form_type')->value(); } ) );
    $wp_customize->add_setting( 'coachpress_contact_page_shortcode', array( 'default' => '', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'coachpress_contact_page_shortcode', array( 'label' => __( 'Shortcode', 'coachpress' ), 'section' => 'coachpress_contact_page', 'type' => 'text', 'active_callback' => function() use ($wp_customize) { return 'shortcode' === $wp_customize->get_setting('coachpress_contact_page_form_type')->value(); } ) );

}
add_action( 'customize_register', 'coachpress_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 */
function coachpress_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 */
function coachpress_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function coachpress_customize_preview_js() {
	wp_enqueue_script( 'coachpress-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), COACHPRESS_VERSION, true );
}
add_action( 'customize_preview_init', 'coachpress_customize_preview_js' );


function coachpress_customize_controls_scripts() {
    wp_enqueue_script( 'coachpress-gradient-control', get_template_directory_uri() . '/js/gradient-control.js', array( 'jquery', 'wp-color-picker' ), COACHPRESS_VERSION, true );
    wp_enqueue_style( 'coachpress-gradient-control', get_template_directory_uri() . '/css/gradient-control.css' );
    wp_enqueue_script( 'coachpress-responsive-font-size-control', get_template_directory_uri() . '/js/responsive-font-size-control.js', array( 'jquery', 'customize-controls' ), COACHPRESS_VERSION, true );
    wp_enqueue_style( 'coachpress-responsive-font-size-control', get_template_directory_uri() . '/css/responsive-font-size-control.css' );
    wp_enqueue_script( 'coachpress-border-radius-control', get_template_directory_uri() . '/js/border-radius-control.js', array( 'jquery', 'customize-controls' ), COACHPRESS_VERSION, true );
    wp_enqueue_style( 'coachpress-border-radius-control', get_template_directory_uri() . '/css/border-radius-control.css' );
    wp_enqueue_script( 'coachpress-dimensions-control', get_template_directory_uri() . '/js/dimensions-control.js', array( 'jquery', 'customize-controls' ), COACHPRESS_VERSION, true );
    wp_enqueue_style( 'coachpress-dimensions-control', get_template_directory_uri() . '/css/dimensions-control.css' );
}
add_action( 'customize_controls_enqueue_scripts', 'coachpress_customize_controls_scripts' );


//======================================================================
// Sanitization Functions
//======================================================================
function coachpress_sanitize_background( $value ) {
    if ( strpos( $value, 'linear-gradient' ) !== false ) { return esc_attr( $value ); }
    return sanitize_hex_color( $value );
}
function coachpress_sanitize_responsive_font_size( $value ) {
    $value_decoded = json_decode( $value, true );
    if ( ! is_array( $value_decoded ) ) { return json_encode( array() ); }
    foreach ( $value_decoded as $device => $size ) { $value_decoded[$device] = sanitize_text_field( $size ); }
    return json_encode( $value_decoded );
}
function coachpress_sanitize_dimensions( $value ) {
    $value_decoded = json_decode( $value, true );
    if ( ! is_array( $value_decoded ) ) { return json_encode( array() ); }
    foreach ( $value_decoded as $side => $dimension ) { $value_decoded[$side] = sanitize_text_field( $dimension ); }
    return json_encode( $value_decoded );
}
function coachpress_sanitize_border_radius( $value ) {
    $value_decoded = json_decode( $value, true );
    if ( ! is_array( $value_decoded ) ) { return json_encode( array() ); }
    foreach ( $value_decoded as $corner => $radius ) { $value_decoded[$corner] = sanitize_text_field( $radius ); }
    return json_encode( $value_decoded );
}

function coachpress_sanitize_multi_select( $value ) {
    if ( ! is_array( $value ) ) {
        return array();
    }
    return array_map( 'absint', $value );
}

if ( class_exists( 'WP_Customize_Control' ) ) {
    class CoachPress_Multi_Select_Control extends WP_Customize_Control {
        public $type = 'coachpress-multi-select';

        public function render_content() {
            ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <select multiple="multiple" <?php $this->link(); ?>>
                    <?php
                    foreach ( $this->choices as $value => $label ) {
                        $selected = in_array( $value, (array) $this->value() ) ? 'selected="selected"' : '';
                        echo '<option value="' . esc_attr( $value ) . '"' . $selected . '>' . $label . '</option>';
                    }
                    ?>
                </select>
            </label>
            <?php
        }
    }
}
