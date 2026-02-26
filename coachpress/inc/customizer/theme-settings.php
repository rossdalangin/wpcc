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
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'coachpress_header_bg_color', array(
        'label' => __('Header Background Color', 'coachpress'),
        'description' => __('The background color for the sticky menu bar at the top of your site.', 'coachpress'),
        'section' => 'coachpress_header_settings'
    )));

    // -- Transparent Header Option --
    $wp_customize->add_setting( 'coachpress_header_transparent', array( 'default' => false, 'transport' => 'refresh', 'sanitize_callback' => 'wp_validate_boolean' ) );
    $wp_customize->add_control( 'coachpress_header_transparent', array(
        'label' => __( 'Enable Transparent Header', 'coachpress' ),
        'description' => __('The header will be transparent over the first section and will become solid upon scrolling.', 'coachpress'),
        'section' => 'coachpress_header_settings',
        'type' => 'checkbox'
    ) );

    $wp_customize->add_setting( 'coachpress_header_transparent_text_color', array( 'default' => '#FFFFFF', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_header_transparent_text_color', array(
        'label' => __( 'Transparent State Text Color', 'coachpress' ),
        'description' => __('The color of menu links and branding when the header is transparent (e.g., White for dark backgrounds).', 'coachpress'),
        'section' => 'coachpress_header_settings',
        'active_callback' => function($control) { return $control->manager->get_setting('coachpress_header_transparent')->value(); }
    ) ) );

    $wp_customize->add_setting( 'coachpress_header_scrolled_bg_color', array( 'default' => '#FFFFFF', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_header_scrolled_bg_color', array(
        'label' => __( 'Scrolled State Background Color', 'coachpress' ),
        'description' => __('The color the header transitions to when you scroll down.', 'coachpress'),
        'section' => 'coachpress_header_settings',
        'active_callback' => function($control) { return $control->manager->get_setting('coachpress_header_transparent')->value(); }
    ) ) );

    $wp_customize->add_setting( 'coachpress_header_scrolled_text_color', array( 'default' => '#1a365d', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_header_scrolled_text_color', array(
        'label' => __( 'Scrolled State Text Color', 'coachpress' ),
        'description' => __('The color of menu links when scrolled.', 'coachpress'),
        'section' => 'coachpress_header_settings',
        'active_callback' => function($control) { return $control->manager->get_setting('coachpress_header_transparent')->value(); }
    ) ) );

    // -- Header CTA --
    $wp_customize->add_setting( 'coachpress_header_cta_visibility', array( 'default' => true, 'transport' => 'refresh', 'sanitize_callback' => 'wp_validate_boolean' ) );
    $wp_customize->add_control( 'coachpress_header_cta_visibility', array(
        'label' => __( 'Enable Header Button', 'coachpress' ),
        'description' => __('Toggle the high-visibility button in your navigation menu. Perfect for "Book a Call" or "Get Started".', 'coachpress'),
        'section' => 'coachpress_header_cta',
        'type' => 'checkbox'
    ) );

    $wp_customize->add_setting( 'coachpress_header_cta_text', array( 'default' => __( 'Get Started', 'coachpress' ), 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'coachpress_header_cta_text', array(
        'label' => __( 'Button Label', 'coachpress' ),
        'description' => __('The text displayed on the button.', 'coachpress'),
        'section' => 'coachpress_header_cta',
        'type' => 'text'
    ) );

    $wp_customize->add_setting( 'coachpress_header_cta_type', array( 'default' => 'url', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_key' ) );
    $wp_customize->add_control( 'coachpress_header_cta_type', array(
        'label' => __( 'Button Action Type', 'coachpress' ),
        'description' => __('Choose if the button links to a page, or opens a popup modal with custom content.', 'coachpress'),
        'section' => 'coachpress_header_cta',
        'type' => 'select',
        'choices' => array( 'url' => __( 'Link to URL', 'coachpress' ), 'html' => __( 'Open Modal (HTML)', 'coachpress' ), 'shortcode' => __( 'Open Modal (Shortcode)', 'coachpress' ) )
    ) );

    $wp_customize->add_setting( 'coachpress_header_cta_url', array( 'default' => '#contact', 'transport' => 'refresh', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'coachpress_header_cta_url', array(
        'label' => __( 'Button URL', 'coachpress' ),
        'section' => 'coachpress_header_cta',
        'type' => 'url',
        'active_callback' => function($control) {
            return 'url' === $control->manager->get_setting('coachpress_header_cta_type')->value();
        }
    ) );

    $wp_customize->add_setting( 'coachpress_header_cta_bg_color', array( 'default' => '#1a365d', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_header_cta_bg_color', array( 'label' => __( 'Button Background Color', 'coachpress' ), 'section' => 'coachpress_header_cta' ) ) );
    $wp_customize->add_setting( 'coachpress_header_cta_text_color', array( 'default' => '#FFFFFF', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_header_cta_text_color', array( 'label' => __( 'Button Text Color', 'coachpress' ), 'section' => 'coachpress_header_cta' ) ) );

    $wp_customize->add_setting( 'coachpress_header_cta_hover_bg_color', array( 'default' => '#c0a080', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_header_cta_hover_bg_color', array( 'label' => __( 'Button Hover Background', 'coachpress' ), 'section' => 'coachpress_header_cta' ) ) );
    $wp_customize->add_setting( 'coachpress_header_cta_hover_text_color', array( 'default' => '#FFFFFF', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_header_cta_hover_text_color', array( 'label' => __( 'Button Hover Text', 'coachpress' ), 'section' => 'coachpress_header_cta' ) ) );

    $wp_customize->add_setting( 'coachpress_header_cta_border_radius', array( 'default' => '6px', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'coachpress_header_cta_border_radius', array(
        'label' => __( 'Border Radius (px)', 'coachpress' ),
        'description' => __('Control the roundness of the button corners.', 'coachpress'),
        'section' => 'coachpress_header_cta',
        'type' => 'text'
    ) );

    $wp_customize->add_setting( 'coachpress_header_cta_padding', array(
        'default'           => json_encode(array('top' => '12px', 'right' => '28px', 'bottom' => '12px', 'left' => '28px')),
        'transport'         => 'refresh',
        'sanitize_callback' => 'coachpress_sanitize_dimensions'
    ) );
    $wp_customize->add_control( new CoachPress_Dimensions_Control( $wp_customize, 'coachpress_header_cta_padding', array(
        'label'    => __( 'Button Internal Spacing', 'coachpress' ),
        'description' => __('Adjust the size of the button by changing the Top/Bottom and Left/Right padding.', 'coachpress'),
        'section'  => 'coachpress_header_cta'
    ) ) );

    // -- Footer --
    $wp_customize->add_setting( 'coachpress_footer_copyright_text', array( 'default' => '© ' . date('Y') . ' CoachPress. Strategic Excellence in Coaching.', 'transport' => 'refresh', 'sanitize_callback' => 'wp_kses_post' ) );
    $wp_customize->add_control( 'coachpress_footer_copyright_text', array(
        'label' => __( 'Copyright Message', 'coachpress' ),
        'description' => __('The text shown at the very bottom of the page.', 'coachpress'),
        'section' => 'coachpress_footer_settings',
        'type' => 'textarea'
    ) );

    // -- SEO Settings --
    $wp_customize->add_section( 'coachpress_seo_settings', array( 'title' => __( 'SEO & Social Metadata', 'coachpress' ), 'panel' => 'coachpress_theme_settings_panel', 'description' => __('Improve your search engine ranking and how your site looks when shared on social media.', 'coachpress') ) );
    $wp_customize->add_setting( 'coachpress_seo_keywords', array( 'default' => 'business coaching, strategic consulting, leadership development, executive coaching', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'coachpress_seo_keywords', array(
        'label' => __( 'Global Search Keywords', 'coachpress' ),
        'description' => __('A list of terms that describe your business, separated by commas.', 'coachpress'),
        'section' => 'coachpress_seo_settings',
        'type' => 'text'
    ) );

    // -- Social Media --
    $social_networks = array( 'linkedin', 'twitter', 'facebook', 'instagram', 'youtube' );
    foreach ( $social_networks as $network ) {
        $wp_customize->add_setting( "coachpress_social_{$network}", array( 'default' => '', 'transport' => 'refresh', 'sanitize_callback' => 'esc_url_raw' ) );
        $wp_customize->add_control( "coachpress_social_{$network}", array(
            'label' => sprintf( __( '%s Profile URL', 'coachpress' ), ucfirst( $network ) ),
            'description' => sprintf( __('Enter the full link to your %s page.', 'coachpress'), ucfirst($network) ),
            'section' => 'coachpress_social_media',
            'type' => 'url'
        ) );
    }
}
