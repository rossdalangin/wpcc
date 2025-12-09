<?php
/**
 * CoachPress Theme Customizer Form & Image Styles
 *
 * @package CoachPress
 */

function coachpress_customize_register_form_image_styles( $wp_customize ) {
    // Form & Image Styles Panel
    $wp_customize->add_panel( 'coachpress_form_image_styles_panel', array(
        'title'    => __( 'Form & Image Styles', 'coachpress' ),
        'priority' => 33,
        'description' => __( 'Customize the appearance of images and form fields throughout your site.', 'coachpress' ),
    ) );

    // Images Section
    $wp_customize->add_section( 'coachpress_images', array(
        'title'    => __( 'Images', 'coachpress' ),
        'panel'    => 'coachpress_form_image_styles_panel',
    ) );

    $wp_customize->add_setting( 'coachpress_image_border_radius', array(
        'default'   => '4px',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'coachpress_image_border_radius', array(
        'label'    => __( 'Image Border Radius', 'coachpress' ),
        'description' => __( 'Enter a value with a CSS unit (e.g., 4px, 1rem) to round the corners of images.', 'coachpress' ),
        'section'  => 'coachpress_images',
        'type'     => 'text',
    ) );

    // Forms Section
    $wp_customize->add_section( 'coachpress_forms', array(
        'title'    => __( 'Form Fields', 'coachpress' ),
        'panel'    => 'coachpress_form_image_styles_panel',
        'description' => __( 'These styles will apply to common form fields. Note: Some form plugins may require separate styling.', 'coachpress' ),
    ) );

    $wp_customize->add_setting( 'coachpress_form_field_bg_color', array(
        'default'   => '#FFFFFF',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_form_field_bg_color', array(
        'label'    => __( 'Background Color', 'coachpress' ),
        'section'  => 'coachpress_forms',
    ) ) );

    $wp_customize->add_setting( 'coachpress_form_field_text_color', array(
        'default'   => '#333333',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_form_field_text_color', array(
        'label'    => __( 'Text Color', 'coachpress' ),
        'section'  => 'coachpress_forms',
    ) ) );

    $wp_customize->add_setting( 'coachpress_form_field_border_color', array(
        'default'   => '#CCCCCC',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_form_field_border_color', array(
        'label'    => __( 'Border Color', 'coachpress' ),
        'section'  => 'coachpress_forms',
    ) ) );

    $wp_customize->add_setting( 'coachpress_form_field_border_radius', array(
        'default'   => '4px',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'coachpress_form_field_border_radius', array(
        'label'    => __( 'Border Radius', 'coachpress' ),
        'description' => __( 'Enter a value with a CSS unit (e.g., 4px, 1rem).', 'coachpress' ),
        'section'  => 'coachpress_forms',
        'type'     => 'text',
    ) );
}
add_action( 'customize_register', 'coachpress_customize_register_form_image_styles' );
