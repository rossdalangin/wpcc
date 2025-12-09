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
        'description' => __( 'Configure the main hero section of your homepage. This is the first thing visitors see.', 'coachpress' ),
    ) );

    // Background
    $wp_customize->add_setting( 'coachpress_hero_bg_image', array(
        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint',
    ) );

    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'coachpress_hero_bg_image', array(
        'label'    => __( 'Background Image', 'coachpress' ),
        'description' => __( 'Select a high-resolution image for the hero background. Overrides the background video if both are set.', 'coachpress' ),
        'section'  => 'coachpress_hero_section',
        'settings' => 'coachpress_hero_bg_image',
        'mime_type' => 'image',
    ) ) );

    $wp_customize->add_setting( 'coachpress_hero_bg_video', array(
        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'esc_url_raw',
    ) );

    $wp_customize->add_control( 'coachpress_hero_bg_video', array(
        'label'    => __( 'Background Video URL', 'coachpress' ),
        'description' => __( 'Enter a URL to a video file (e.g., MP4). The video will loop and be muted.', 'coachpress' ),
        'section'  => 'coachpress_hero_section',
        'settings' => 'coachpress_hero_bg_video',
        'type'     => 'url',
    ) );

    $wp_customize->add_setting( 'coachpress_hero_bg_overlay_color', array(
        'default'   => '#000000',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_hero_bg_overlay_color', array(
        'label'    => __( 'Background Overlay Color', 'coachpress' ),
        'description' => __( 'Select a color to lay over the background image or video. This helps with text readability.', 'coachpress' ),
        'section'  => 'coachpress_hero_section',
        'settings' => 'coachpress_hero_bg_overlay_color',
    ) ) );

    $wp_customize->add_setting( 'coachpress_hero_bg_overlay_opacity', array(
        'default'   => '0.5',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'coachpress_hero_bg_overlay_opacity', array(
        'label'    => __( 'Background Overlay Opacity', 'coachpress' ),
        'description' => __( 'Set the transparency of the overlay color. Use a value between 0 (fully transparent) and 1 (fully opaque).', 'coachpress' ),
        'section'  => 'coachpress_hero_section',
        'settings' => 'coachpress_hero_bg_overlay_opacity',
        'type'     => 'number',
        'input_attrs' => array(
            'min' => 0,
            'max' => 1,
            'step' => 0.05,
        ),
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
        'description' => __( 'Align the text and button within the left column.', 'coachpress' ),
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
        'description' => __( 'Choose what to display in the right column. If "Disabled," the left column will expand to full width.', 'coachpress' ),
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
