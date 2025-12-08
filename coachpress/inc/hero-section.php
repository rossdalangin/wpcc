<?php
/**
 * CoachPress Theme Customizer Hero Section
 *
 * @package CoachPress
 */

function coachpress_customize_register_hero_section( $wp_customize ) {
    $wp_customize->add_section( 'coachpress_hero_section', array(
        'title'    => __( 'Hero Section', 'coachpress' ),
        'priority' => 30,
    ) );

    // Left Column
    $wp_customize->add_setting( 'coachpress_hero_left_heading', array(
        'default'   => __( 'Welcome to CoachPress', 'coachpress' ),
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'coachpress_hero_left_heading', array(
        'label'    => __( 'Heading', 'coachpress' ),
        'section'  => 'coachpress_hero_section',
        'settings' => 'coachpress_hero_left_heading',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'coachpress_hero_left_subheading', array(
        'default'   => __( 'Your journey to success starts here.', 'coachpress' ),
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'coachpress_hero_left_subheading', array(
        'label'    => __( 'Subheading', 'coachpress' ),
        'section'  => 'coachpress_hero_section',
        'settings' => 'coachpress_hero_left_subheading',
        'type'     => 'textarea',
    ) );

    $wp_customize->add_setting( 'coachpress_hero_left_button_text', array(
        'default'   => __( 'Get Started', 'coachpress' ),
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'coachpress_hero_left_button_text', array(
        'label'    => __( 'Button Text', 'coachpress' ),
        'section'  => 'coachpress_hero_section',
        'settings' => 'coachpress_hero_left_button_text',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'coachpress_hero_left_button_url', array(
        'default'   => '#',
        'transport' => 'refresh',
        'sanitize_callback' => 'esc_url_raw',
    ) );

    $wp_customize->add_control( 'coachpress_hero_left_button_url', array(
        'label'    => __( 'Button URL', 'coachpress' ),
        'section'  => 'coachpress_hero_section',
        'settings' => 'coachpress_hero_left_button_url',
        'type'     => 'url',
    ) );

    $wp_customize->add_setting( 'coachpress_hero_left_alignment', array(
        'default'   => 'left',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_key',
    ) );

    $wp_customize->add_control( 'coachpress_hero_left_alignment', array(
        'label'    => __( 'Content Alignment', 'coachpress' ),
        'section'  => 'coachpress_hero_section',
        'settings' => 'coachpress_hero_left_alignment',
        'type'     => 'select',
        'choices'  => array(
            'left'   => __( 'Left', 'coachpress' ),
            'center' => __( 'Center', 'coachpress' ),
            'right'  => __( 'Right', 'coachpress' ),
        ),
    ) );

    // Right Column
    $wp_customize->add_setting( 'coachpress_hero_right_content_type', array(
        'default'   => 'image',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_key',
    ) );

    $wp_customize->add_control( 'coachpress_hero_right_content_type', array(
        'label'    => __( 'Right Column Content Type', 'coachpress' ),
        'section'  => 'coachpress_hero_section',
        'settings' => 'coachpress_hero_right_content_type',
        'type'     => 'select',
        'choices'  => array(
            'disabled'  => __( 'Disabled', 'coachpress' ),
            'html'      => __( 'HTML', 'coachpress' ),
            'shortcode' => __( 'Shortcode', 'coachpress' ),
            'image'     => __( 'Image', 'coachpress' ),
            'video'     => __( 'Video', 'coachpress' ),
        ),
    ) );

    $wp_customize->add_setting( 'coachpress_hero_right_html', array(
        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post',
    ) );

    $wp_customize->add_control( 'coachpress_hero_right_html', array(
        'label'    => __( 'HTML', 'coachpress' ),
        'section'  => 'coachpress_hero_section',
        'settings' => 'coachpress_hero_right_html',
        'type'     => 'textarea',
        'active_callback' => function() {
            return 'html' === get_theme_mod( 'coachpress_hero_right_content_type' );
        },
    ) );

    $wp_customize->add_setting( 'coachpress_hero_right_shortcode', array(
        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'coachpress_hero_right_shortcode', array(
        'label'    => __( 'Shortcode', 'coachpress' ),
        'section'  => 'coachpress_hero_section',
        'settings' => 'coachpress_hero_right_shortcode',
        'type'     => 'text',
        'active_callback' => function() {
            return 'shortcode' === get_theme_mod( 'coachpress_hero_right_content_type' );
        },
    ) );

    $wp_customize->add_setting( 'coachpress_hero_right_image', array(
        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint',
    ) );

    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'coachpress_hero_right_image', array(
        'label'    => __( 'Image', 'coachpress' ),
        'section'  => 'coachpress_hero_section',
        'settings' => 'coachpress_hero_right_image',
        'mime_type' => 'image',
        'active_callback' => function() {
            return 'image' === get_theme_mod( 'coachpress_hero_right_content_type' );
        },
    ) ) );

    $wp_customize->add_setting( 'coachpress_hero_right_video', array(
        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'esc_url_raw',
    ) );

    $wp_customize->add_control( 'coachpress_hero_right_video', array(
        'label'    => __( 'Video URL', 'coachpress' ),
        'section'  => 'coachpress_hero_section',
        'settings' => 'coachpress_hero_right_video',
        'type'     => 'url',
        'active_callback' => function() {
            return 'video' === get_theme_mod( 'coachpress_hero_right_content_type' );
        },
    ) );
}
add_action( 'customize_register', 'coachpress_customize_register_hero_section' );
