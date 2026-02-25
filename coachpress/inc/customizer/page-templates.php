<?php
/**
 * Customizer Page Template Controls
 *
 * @package CoachPress
 */

function coachpress_customize_page_templates( $wp_customize ) {
    $sections = coachpress_get_section_choices();

    // -- Global Page Header (Styles) --
    $wp_customize->add_section( 'coachpress_global_page_header', array(
        'title'    => __( 'Global Page Header Styles', 'coachpress' ),
        'priority' => 5,
        'panel'    => 'coachpress_page_templates_panel',
    ) );

    $wp_customize->add_setting( 'coachpress_page_header_bg_color', array( 'default' => '#f7fafc', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_page_header_bg_color', array( 'label' => __( 'Header BG Color', 'coachpress' ), 'section' => 'coachpress_global_page_header' ) ) );

    $wp_customize->add_setting( 'coachpress_page_header_text_color', array( 'default' => '#1a365d', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_page_header_text_color', array( 'label' => __( 'Header Text Color', 'coachpress' ), 'section' => 'coachpress_global_page_header' ) ) );

    $wp_customize->add_setting( 'coachpress_page_header_alignment', array( 'default' => 'center', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_key' ) );
    $wp_customize->add_control( 'coachpress_page_header_alignment', array(
        'label'    => __( 'Text Alignment', 'coachpress' ),
        'section'  => 'coachpress_global_page_header',
        'type'     => 'select',
        'choices'  => array( 'left' => __( 'Left', 'coachpress' ), 'center' => __( 'Center', 'coachpress' ), 'right' => __( 'Right', 'coachpress' ) )
    ) );

    $wp_customize->add_setting( 'coachpress_page_header_padding', array(
        'default'           => json_encode(array('top' => '80px', 'right' => '0', 'bottom' => '80px', 'left' => '0')),
        'transport'         => 'refresh',
        'sanitize_callback' => 'coachpress_sanitize_dimensions'
    ) );
    $wp_customize->add_control( new CoachPress_Dimensions_Control( $wp_customize, 'coachpress_page_header_padding', array(
        'label'    => __( 'Header Padding', 'coachpress' ),
        'section'  => 'coachpress_global_page_header'
    ) ) );

    $pages = array(
        'about'     => __( 'About Page', 'coachpress' ),
        'services'  => __( 'Services Page', 'coachpress' ),
        'process'   => __( 'Process Page', 'coachpress' ),
        'portfolio' => __( 'Portfolio Page', 'coachpress' ),
        'team'      => __( 'Team Page', 'coachpress' ),
        'contact'   => __( 'Contact Page', 'coachpress' )
    );

    $i = 10;
    foreach ($pages as $slug => $name) {
        $section_id = "coachpress_{$slug}_page";
        $wp_customize->add_section( $section_id, array(
            'title'    => sprintf( __( '%s Settings', 'coachpress' ), $name ),
            'priority' => $i,
            'panel'    => 'coachpress_page_templates_panel',
        ) );

        // Banner Content
        $wp_customize->add_setting( "coachpress_{$slug}_banner_title", array( 'default' => '', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( "coachpress_{$slug}_banner_title", array( 'label' => __( 'Banner Title Override', 'coachpress' ), 'section' => $section_id, 'type' => 'text' ) );

        $wp_customize->add_setting( "coachpress_{$slug}_banner_subtitle", array( 'default' => '', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( "coachpress_{$slug}_banner_subtitle", array( 'label' => __( 'Banner Subtitle', 'coachpress' ), 'section' => $section_id, 'type' => 'textarea' ) );

        $wp_customize->add_setting( "coachpress_{$slug}_page_banner_image", array( 'default' => '', 'transport' => 'refresh', 'sanitize_callback' => 'absint' ) );
        $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, "coachpress_{$slug}_page_banner_image", array( 'label' => __( 'Banner Image', 'coachpress' ), 'section' => $section_id, 'mime_type' => 'image' ) ) );

        // Section Order
        $default_sections = '';
        if ($slug === 'about') $default_sections = 'about-preview,team,cta';
        elseif ($slug === 'services') $default_sections = 'services,processes,cta';
        elseif ($slug === 'process') $default_sections = 'processes,faqs,cta';
        elseif ($slug === 'portfolio') $default_sections = 'portfolio,case-studies,cta';
        elseif ($slug === 'team') $default_sections = 'team,testimonials,cta';
        elseif ($slug === 'contact') $default_sections = 'contact,faqs';

        $wp_customize->add_setting( "coachpress_{$slug}_page_sections", array(
            'default'           => $default_sections,
            'transport'         => 'refresh',
            'sanitize_callback' => 'sanitize_text_field'
        ) );
        $wp_customize->add_control( new CoachPress_Section_Order_Control( $wp_customize, "coachpress_{$slug}_page_sections", array(
            'label'       => __( 'Page Sections Order', 'coachpress' ),
            'description' => __('Select and reorder sections for this page.', 'coachpress'),
            'section'     => $section_id,
            'choices'     => $sections
        ) ) );

        // Specifics for Contact Page
        if ($slug === 'contact') {
            $wp_customize->add_setting( 'coachpress_contact_page_form_type', array( 'default' => 'shortcode', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_key' ) );
            $wp_customize->add_control( 'coachpress_contact_page_form_type', array( 'label' => __( 'Form Type', 'coachpress' ), 'section' => $section_id, 'type' => 'select', 'choices' => array( 'html' => __( 'HTML', 'coachpress' ), 'shortcode' => __( 'Shortcode', 'coachpress' ) ) ) );
            $wp_customize->add_setting( 'coachpress_contact_page_html', array( 'default' => '', 'transport' => 'refresh', 'sanitize_callback' => 'wp_kses_post' ) );
            $wp_customize->add_control( 'coachpress_contact_page_html', array( 'label' => __( 'HTML Content', 'coachpress' ), 'section' => $section_id, 'type' => 'textarea', 'active_callback' => function() use ($wp_customize) { return 'html' === $wp_customize->get_setting('coachpress_contact_page_form_type')->value(); } ) );
            $wp_customize->add_setting( 'coachpress_contact_page_shortcode', array( 'default' => '', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
            $wp_customize->add_control( 'coachpress_contact_page_shortcode', array( 'label' => __( 'Shortcode', 'coachpress' ), 'section' => $section_id, 'type' => 'text', 'active_callback' => function() use ($wp_customize) { return 'shortcode' === $wp_customize->get_setting('coachpress_contact_page_form_type')->value(); } ) );
        }

        $i += 10;
    }
}
