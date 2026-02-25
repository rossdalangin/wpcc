<?php
/**
 * Customizer Theme Settings Controls
 *
 * @package CoachPress
 */

function coachpress_customize_theme_settings( $wp_customize ) {
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
    $wp_customize->add_setting('coachpress_mobile_menu_link_color', array('default' => '#0D2F4F', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color'));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'coachpress_mobile_menu_link_color', array('label' => __('Mobile Menu Link Color', 'coachpress'), 'section' => 'coachpress_header_settings')));
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

    // -- SEO Settings --
    $wp_customize->add_section( 'coachpress_seo_settings', array( 'title' => __( 'SEO Settings', 'coachpress' ), 'panel' => 'coachpress_theme_settings_panel' ) );
    $wp_customize->add_setting( 'coachpress_seo_keywords', array( 'default' => '', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'coachpress_seo_keywords', array( 'label' => __( 'Global Keywords', 'coachpress' ), 'description' => __('Enter keywords separated by commas.', 'coachpress'), 'section' => 'coachpress_seo_settings', 'type' => 'text' ) );

    // -- Social Media --
    $social_networks = array( 'facebook', 'twitter', 'instagram', 'linkedin', 'youtube', 'pinterest' );
    foreach ( $social_networks as $network ) {
        $wp_customize->add_setting( "coachpress_social_{$network}", array( 'default' => '', 'transport' => 'refresh', 'sanitize_callback' => 'esc_url_raw' ) );
        $wp_customize->add_control( "coachpress_social_{$network}", array( 'label' => sprintf( __( '%s URL', 'coachpress' ), ucfirst( $network ) ), 'section' => 'coachpress_social_media', 'type' => 'url' ) );
    }
}
