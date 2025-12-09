<?php
/**
 * CoachPress Theme Customizer Contact Page
 *
 * @package CoachPress
 */

function coachpress_customize_register_contact_page( $wp_customize ) {
    $wp_customize->add_section( 'coachpress_contact_page', array(
        'title'    => __( 'Contact Page', 'coachpress' ),
        'priority' => 50,
        'description' => __( 'Settings for the "Contact" page template. Use these options to embed a contact form from a plugin or add custom HTML.', 'coachpress' ),
    ) );

    $wp_customize->add_setting( 'coachpress_contact_form_type', array(
        'default'   => 'shortcode',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_key',
    ) );

    $wp_customize->add_control( 'coachpress_contact_form_type', array(
        'label'    => __( 'Content Type', 'coachpress' ),
        'description' => __( 'Choose how to add content to your contact page. "Shortcode" is recommended for embedding forms from plugins like Gravity Forms or WPForms.', 'coachpress' ),
        'section'  => 'coachpress_contact_page',
        'settings' => 'coachpress_contact_form_type',
        'type'     => 'select',
        'choices'  => array(
            'html'      => __( 'HTML', 'coachpress' ),
            'shortcode' => __( 'Shortcode', 'coachpress' ),
        ),
    ) );

    $wp_customize->add_setting( 'coachpress_contact_form_html', array(
        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post',
    ) );

    $wp_customize->add_control( 'coachpress_contact_form_html', array(
        'label'    => __( 'Custom HTML', 'coachpress' ),
        'description' => __( 'Enter any custom HTML, such as a form embed code from a third-party service.', 'coachpress' ),
        'section'  => 'coachpress_contact_page',
        'settings' => 'coachpress_contact_form_html',
        'type'     => 'textarea',
        'active_callback' => function() {
            return 'html' === get_theme_mod( 'coachpress_contact_form_type' );
        },
    ) );

    $wp_customize->add_setting( 'coachpress_contact_form_shortcode', array(
        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'coachpress_contact_form_shortcode', array(
        'label'    => __( 'Form Shortcode', 'coachpress' ),
        'description' => __( 'Enter the shortcode provided by your contact form plugin.', 'coachpress' ),
        'section'  => 'coachpress_contact_page',
        'settings' => 'coachpress_contact_form_shortcode',
        'type'     => 'text',
        'active_callback' => function() {
            return 'shortcode' === get_theme_mod( 'coachpress_contact_form_type' );
        },
    ) );
}
add_action( 'customize_register', 'coachpress_customize_register_contact_page' );
