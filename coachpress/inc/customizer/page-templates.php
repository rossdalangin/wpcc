<?php
/**
 * Customizer Page Template Controls
 *
 * @package CoachPress
 */

function coachpress_customize_page_templates( $wp_customize ) {
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
