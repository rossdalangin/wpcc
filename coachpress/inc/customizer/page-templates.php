<?php
/**
 * Customizer Page Template Controls
 *
 * @package CoachPress
 */

function coachpress_customize_page_templates( $wp_customize ) {
    $sections = coachpress_get_section_choices();

    // -- About Page --
    $wp_customize->add_section( 'coachpress_about_page', array(
        'title'    => __( 'About Page Settings', 'coachpress' ),
        'priority' => 10,
        'panel'    => 'coachpress_page_templates_panel',
    ) );
    $wp_customize->add_setting( 'coachpress_about_page_sections', array(
        'default'           => 'about-preview,team,cta',
        'transport'         => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ) );
    $wp_customize->add_control( new CoachPress_Section_Order_Control( $wp_customize, 'coachpress_about_page_sections', array(
        'label'       => __( 'About Page Sections', 'coachpress' ),
        'description' => __('Select and reorder sections for the About page.', 'coachpress'),
        'section'     => 'coachpress_about_page',
        'choices'     => $sections
    ) ) );

    // -- Services Page --
    $wp_customize->add_section( 'coachpress_services_page', array(
        'title'    => __( 'Services Page Settings', 'coachpress' ),
        'priority' => 20,
        'panel'    => 'coachpress_page_templates_panel',
    ) );
    $wp_customize->add_setting( 'coachpress_services_page_sections', array(
        'default'           => 'services,processes,cta',
        'transport'         => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ) );
    $wp_customize->add_control( new CoachPress_Section_Order_Control( $wp_customize, 'coachpress_services_page_sections', array(
        'label'       => __( 'Services Page Sections', 'coachpress' ),
        'description' => __('Select and reorder sections for the Services page.', 'coachpress'),
        'section'     => 'coachpress_services_page',
        'choices'     => $sections
    ) ) );

    // -- Process Page --
    $wp_customize->add_section( 'coachpress_process_page', array(
        'title'    => __( 'Process Page Settings', 'coachpress' ),
        'priority' => 30,
        'panel'    => 'coachpress_page_templates_panel',
    ) );
    $wp_customize->add_setting( 'coachpress_process_page_sections', array(
        'default'           => 'processes,faqs,cta',
        'transport'         => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ) );
    $wp_customize->add_control( new CoachPress_Section_Order_Control( $wp_customize, 'coachpress_process_page_sections', array(
        'label'       => __( 'Process Page Sections', 'coachpress' ),
        'description' => __('Select and reorder sections for the Process page.', 'coachpress'),
        'section'     => 'coachpress_process_page',
        'choices'     => $sections
    ) ) );

    // -- Portfolio Page --
    $wp_customize->add_section( 'coachpress_portfolio_page', array(
        'title'    => __( 'Portfolio Page Settings', 'coachpress' ),
        'priority' => 40,
        'panel'    => 'coachpress_page_templates_panel',
    ) );
    $wp_customize->add_setting( 'coachpress_portfolio_page_sections', array(
        'default'           => 'portfolio,case-studies,cta',
        'transport'         => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ) );
    $wp_customize->add_control( new CoachPress_Section_Order_Control( $wp_customize, 'coachpress_portfolio_page_sections', array(
        'label'       => __( 'Portfolio Page Sections', 'coachpress' ),
        'description' => __('Select and reorder sections for the Portfolio page.', 'coachpress'),
        'section'     => 'coachpress_portfolio_page',
        'choices'     => $sections
    ) ) );

    // -- Team Page --
    $wp_customize->add_section( 'coachpress_team_page', array(
        'title'    => __( 'Team Page Settings', 'coachpress' ),
        'priority' => 50,
        'panel'    => 'coachpress_page_templates_panel',
    ) );
    $wp_customize->add_setting( 'coachpress_team_page_sections', array(
        'default'           => 'team,testimonials,cta',
        'transport'         => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ) );
    $wp_customize->add_control( new CoachPress_Section_Order_Control( $wp_customize, 'coachpress_team_page_sections', array(
        'label'       => __( 'Team Page Sections', 'coachpress' ),
        'description' => __('Select and reorder sections for the Team page.', 'coachpress'),
        'section'     => 'coachpress_team_page',
        'choices'     => $sections
    ) ) );

    // -- Contact Page --
    $wp_customize->add_section( 'coachpress_contact_page_settings', array(
        'title'    => __( 'Contact Page Settings', 'coachpress' ),
        'priority' => 60,
        'panel'    => 'coachpress_page_templates_panel',
    ) );
    $wp_customize->add_setting( 'coachpress_contact_page_sections', array(
        'default'           => 'contact,faqs',
        'transport'         => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ) );
    $wp_customize->add_control( new CoachPress_Section_Order_Control( $wp_customize, 'coachpress_contact_page_sections', array(
        'label'       => __( 'Contact Page Sections', 'coachpress' ),
        'description' => __('Select and reorder sections for the Contact page.', 'coachpress'),
        'section'     => 'coachpress_contact_page_settings',
        'choices'     => $sections
    ) ) );

    $wp_customize->add_setting( 'coachpress_contact_page_form_type', array( 'default' => 'shortcode', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_key' ) );
    $wp_customize->add_control( 'coachpress_contact_page_form_type', array( 'label' => __( 'Form Type', 'coachpress' ), 'section' => 'coachpress_contact_page_settings', 'type' => 'select', 'choices' => array( 'html' => __( 'HTML', 'coachpress' ), 'shortcode' => __( 'Shortcode', 'coachpress' ) ) ) );
    $wp_customize->add_setting( 'coachpress_contact_page_html', array( 'default' => '', 'transport' => 'refresh', 'sanitize_callback' => 'wp_kses_post' ) );
    $wp_customize->add_control( 'coachpress_contact_page_html', array( 'label' => __( 'HTML Content', 'coachpress' ), 'section' => 'coachpress_contact_page_settings', 'type' => 'textarea', 'active_callback' => function() use ($wp_customize) { return 'html' === $wp_customize->get_setting('coachpress_contact_page_form_type')->value(); } ) );
    $wp_customize->add_setting( 'coachpress_contact_page_shortcode', array( 'default' => '', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'coachpress_contact_page_shortcode', array( 'label' => __( 'Shortcode', 'coachpress' ), 'section' => 'coachpress_contact_page_settings', 'type' => 'text', 'active_callback' => function() use ($wp_customize) { return 'shortcode' === $wp_customize->get_setting('coachpress_contact_page_form_type')->value(); } ) );
}
