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

    // -- Premium Sales Letter --
    $wp_customize->add_setting( 'coachpress_sales-letter_page_banner_image', array( 'default' => '', 'transport' => 'refresh', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'coachpress_sales-letter_page_banner_image', array( 'label' => __( 'Banner Image', 'coachpress' ), 'section' => 'coachpress_sales_letter_page' ) ) );

    $wp_customize->add_setting( 'coachpress_sales-letter_page_salutation', array( 'default' => 'Dear Visionary,', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'coachpress_sales-letter_page_salutation', array( 'label' => __( 'Salutation', 'coachpress' ), 'section' => 'coachpress_sales_letter_page', 'type' => 'text' ) );

    $wp_customize->add_setting( 'coachpress_sales-letter_page_headline', array( 'default' => 'Transform Your Coaching Practice Today', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'coachpress_sales-letter_page_headline', array( 'label' => __( 'Main Headline', 'coachpress' ), 'section' => 'coachpress_sales_letter_page', 'type' => 'text' ) );

    $wp_customize->add_setting( 'coachpress_sales-letter_page_pain_points', array( 'default' => '', 'transport' => 'refresh', 'sanitize_callback' => 'wp_kses_post' ) );
    $wp_customize->add_control( 'coachpress_sales-letter_page_pain_points', array( 'label' => __( 'Pain-Point Narratives', 'coachpress' ), 'section' => 'coachpress_sales_letter_page', 'type' => 'textarea' ) );

    $wp_customize->add_setting( 'coachpress_sales-letter_page_content', array( 'default' => '', 'transport' => 'refresh', 'sanitize_callback' => 'wp_kses_post' ) );
    $wp_customize->add_control( 'coachpress_sales-letter_page_content', array( 'label' => __( 'Narrative Story/Content', 'coachpress' ), 'section' => 'coachpress_sales_letter_page', 'type' => 'textarea' ) );

    $wp_customize->add_setting( 'coachpress_sales-letter_page_list_items', array( 'default' => '', 'transport' => 'refresh', 'sanitize_callback' => 'wp_kses_post' ) );
    $wp_customize->add_control( 'coachpress_sales-letter_page_list_items', array( 'label' => __( 'List Items (HTML enabled)', 'coachpress' ), 'section' => 'coachpress_sales_letter_page', 'type' => 'textarea' ) );

    $wp_customize->add_setting( 'coachpress_sales-letter_page_conclusion', array( 'default' => '', 'transport' => 'refresh', 'sanitize_callback' => 'wp_kses_post' ) );
    $wp_customize->add_control( 'coachpress_sales-letter_page_conclusion', array( 'label' => __( 'Conclusion Text', 'coachpress' ), 'section' => 'coachpress_sales_letter_page', 'type' => 'textarea' ) );

    $wp_customize->add_setting( 'coachpress_sales-letter_page_signature', array( 'default' => 'To your success,', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'coachpress_sales-letter_page_signature', array( 'label' => __( 'Signature', 'coachpress' ), 'section' => 'coachpress_sales_letter_page', 'type' => 'text' ) );

    $wp_customize->add_setting( 'coachpress_sales-letter_page_cta_text', array( 'default' => 'Join the Program', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'coachpress_sales-letter_page_cta_text', array( 'label' => __( 'CTA Button Text', 'coachpress' ), 'section' => 'coachpress_sales_letter_page', 'type' => 'text' ) );

    $wp_customize->add_setting( 'coachpress_sales-letter_page_cta_url', array( 'default' => '#', 'transport' => 'refresh', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'coachpress_sales-letter_page_cta_url', array( 'label' => __( 'CTA Button URL', 'coachpress' ), 'section' => 'coachpress_sales_letter_page', 'type' => 'text' ) );
}
