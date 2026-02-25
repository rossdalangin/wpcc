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

    // -- Header CTA --
    $wp_customize->add_setting( 'coachpress_header_cta_visibility', array( 'default' => true, 'transport' => 'refresh', 'sanitize_callback' => 'wp_validate_boolean' ) );
    $wp_customize->add_control( 'coachpress_header_cta_visibility', array( 'label' => __( 'Show CTA Button', 'coachpress' ), 'section' => 'coachpress_header_cta', 'type' => 'checkbox' ) );
    $wp_customize->add_setting( 'coachpress_header_cta_text', array( 'default' => __( 'Get Started', 'coachpress' ), 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'coachpress_header_cta_text', array( 'label' => __( 'Button Text', 'coachpress' ), 'section' => 'coachpress_header_cta', 'type' => 'text' ) );
    $wp_customize->add_setting( 'coachpress_header_cta_type', array( 'default' => 'url', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_key' ) );
    $wp_customize->add_control( 'coachpress_header_cta_type', array( 'label' => __( 'CTA Type', 'coachpress' ), 'section' => 'coachpress_header_cta', 'type' => 'select', 'choices' => array( 'url' => __( 'URL', 'coachpress' ), 'html' => __( 'HTML', 'coachpress' ), 'shortcode' => __( 'Shortcode', 'coachpress' ) ) ) );
    $wp_customize->add_setting( 'coachpress_header_cta_url', array( 'default' => '#contact', 'transport' => 'refresh', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'coachpress_header_cta_url', array( 'label' => __( 'Button URL', 'coachpress' ), 'section' => 'coachpress_header_cta', 'type' => 'url', 'active_callback' => function() use ($wp_customize) { return 'url' === $wp_customize->get_setting('coachpress_header_cta_type')->value(); } ) );

    // -- Footer --
    $wp_customize->add_setting( 'coachpress_footer_copyright_text', array( 'default' => '© ' . date('Y') . ' CoachPress. Strategic Excellence in Coaching.', 'transport' => 'refresh', 'sanitize_callback' => 'wp_kses_post' ) );
    $wp_customize->add_control( 'coachpress_footer_copyright_text', array( 'label' => __( 'Copyright Text', 'coachpress' ), 'section' => 'coachpress_footer_settings', 'type' => 'textarea' ) );

    // -- SEO Settings --
    $wp_customize->add_section( 'coachpress_seo_settings', array( 'title' => __( 'SEO Settings', 'coachpress' ), 'panel' => 'coachpress_theme_settings_panel' ) );
    $wp_customize->add_setting( 'coachpress_seo_keywords', array( 'default' => 'business coaching, strategic consulting, leadership development, executive coaching', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'coachpress_seo_keywords', array( 'label' => __( 'Global Keywords', 'coachpress' ), 'description' => __('Enter keywords separated by commas.', 'coachpress'), 'section' => 'coachpress_seo_settings', 'type' => 'text' ) );

    // -- Social Media --
    $social_networks = array( 'linkedin', 'twitter', 'facebook', 'instagram', 'youtube' );
    foreach ( $social_networks as $network ) {
        $wp_customize->add_setting( "coachpress_social_{$network}", array( 'default' => '', 'transport' => 'refresh', 'sanitize_callback' => 'esc_url_raw' ) );
        $wp_customize->add_control( "coachpress_social_{$network}", array( 'label' => sprintf( __( '%s URL', 'coachpress' ), ucfirst( $network ) ), 'section' => 'coachpress_social_media', 'type' => 'url' ) );
    }
}
