<?php
/**
 * CoachPress Theme Customizer
 *
 * @package CoachPress
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function coachpress_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'coachpress_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'coachpress_customize_partial_blogdescription',
			)
		);
	}

	// Global Colors
	$wp_customize->add_section( 'coachpress_global_colors', array(
		'title'    => __( 'Global Colors', 'coachpress' ),
		'priority' => 20,
	) );

	$wp_customize->add_setting( 'coachpress_primary_color', array(
		'default'   => '#001d5c',
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_primary_color', array(
		'label'    => __( 'Primary Color', 'coachpress' ),
		'section'  => 'coachpress_global_colors',
		'settings' => 'coachpress_primary_color',
	) ) );

	$wp_customize->add_setting( 'coachpress_secondary_color', array(
		'default'   => '#e7e0cd',
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_secondary_color', array(
		'label'    => __( 'Secondary Color', 'coachpress' ),
		'section'  => 'coachpress_global_colors',
		'settings' => 'coachpress_secondary_color',
	) ) );

    $wp_customize->add_setting( 'coachpress_accent_color', array(
        'default'   => '#c7a174',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_accent_color', array(
        'label'    => __( 'Accent Color', 'coachpress' ),
        'section'  => 'coachpress_global_colors',
        'settings' => 'coachpress_accent_color',
    ) ) );

	$wp_customize->add_setting( 'coachpress_text_color', array(
		'default'   => '#384047',
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_text_color', array(
		'label'    => __( 'Text Color', 'coachpress' ),
		'section'  => 'coachpress_global_colors',
		'settings' => 'coachpress_text_color',
	) ) );

	// Global Typography
	$wp_customize->add_section( 'coachpress_global_typography', array(
		'title'    => __( 'Global Typography', 'coachpress' ),
		'priority' => 21,
	) );

	$wp_customize->add_setting( 'coachpress_body_font', array(
		'default'   => 'Lato',
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'coachpress_body_font', array(
		'label'    => __( 'Body Font', 'coachpress' ),
		'section'  => 'coachpress_global_typography',
		'settings' => 'coachpress_body_font',
		'type'     => 'text',
	) );

    $wp_customize->add_setting( 'coachpress_body_font_weight', array(
        'default'   => '400',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'coachpress_body_font_weight', array(
        'label'    => __( 'Body Font Weight', 'coachpress' ),
        'section'  => 'coachpress_global_typography',
        'settings' => 'coachpress_body_font_weight',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'coachpress_body_line_height', array(
        'default'   => '1.6',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'coachpress_body_line_height', array(
        'label'    => __( 'Body Line Height', 'coachpress' ),
        'section'  => 'coachpress_global_typography',
        'settings' => 'coachpress_body_line_height',
        'type'     => 'text',
    ) );

	$wp_customize->add_setting( 'coachpress_heading_font', array(
		'default'   => 'Lora',
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'coachpress_heading_font', array(
		'label'    => __( 'Heading Font', 'coachpress' ),
		'section'  => 'coachpress_global_typography',
		'settings' => 'coachpress_heading_font',
		'type'     => 'text',
	) );

    $wp_customize->add_setting( 'coachpress_heading_font_weight', array(
        'default'   => '700',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'coachpress_heading_font_weight', array(
        'label'    => __( 'Heading Font Weight', 'coachpress' ),
        'section'  => 'coachpress_global_typography',
        'settings' => 'coachpress_heading_font_weight',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'coachpress_heading_letter_spacing', array(
        'default'   => '1px',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'coachpress_heading_letter_spacing', array(
        'label'    => __( 'Heading Letter Spacing', 'coachpress' ),
        'section'  => 'coachpress_global_typography',
        'settings' => 'coachpress_heading_letter_spacing',
        'type'     => 'text',
    ) );
}
add_action( 'customize_register', 'coachpress_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function coachpress_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function coachpress_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function coachpress_customize_preview_js() {
	wp_enqueue_script( 'coachpress-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), COACHPRESS_VERSION, true );
}
add_action( 'customize_preview_init', 'coachpress_customize_preview_js' );
