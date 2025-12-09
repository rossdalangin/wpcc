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
        'description' => __( 'Define the main color palette for your site. These colors will be applied globally to elements like buttons, links, and backgrounds.', 'coachpress' ),
	) );

	$wp_customize->add_setting( 'coachpress_primary_color', array(
		'default'   => '#0D2F4F',
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_primary_color', array(
		'label'    => __( 'Primary Color', 'coachpress' ),
        'description' => __( 'Used for main branding elements, buttons, and links.', 'coachpress' ),
		'section'  => 'coachpress_global_colors',
		'settings' => 'coachpress_primary_color',
	) ) );

	$wp_customize->add_setting( 'coachpress_secondary_color', array(
		'default'   => '#F5F5F5',
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_secondary_color', array(
		'label'    => __( 'Secondary Color', 'coachpress' ),
        'description' => __( 'Used for subtle backgrounds and accents, like the header.', 'coachpress' ),
		'section'  => 'coachpress_global_colors',
		'settings' => 'coachpress_secondary_color',
	) ) );

    $wp_customize->add_setting( 'coachpress_accent_color', array(
        'default'   => '#FFC107',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_accent_color', array(
        'label'    => __( 'Accent Color', 'coachpress' ),
        'description' => __( 'Used for hover states and call-to-action highlights.', 'coachpress' ),
        'section'  => 'coachpress_global_colors',
        'settings' => 'coachpress_accent_color',
    ) ) );

	$wp_customize->add_setting( 'coachpress_text_color', array(
		'default'   => '#333333',
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_text_color', array(
		'label'    => __( 'Text Color', 'coachpress' ),
        'description' => __( 'The primary color for all body text.', 'coachpress' ),
		'section'  => 'coachpress_global_colors',
		'settings' => 'coachpress_text_color',
	) ) );

    $wp_customize->add_setting( 'coachpress_dark_bg_color', array(
        'default'   => '#1A1A1A',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_dark_bg_color', array(
        'label'    => __( 'Dark Background Color', 'coachpress' ),
        'description' => __( 'Used for dark sections like the footer to create contrast.', 'coachpress' ),
        'section'  => 'coachpress_global_colors',
        'settings' => 'coachpress_dark_bg_color',
    ) ) );

	// Per-Section Colors
	$wp_customize->add_panel( 'coachpress_section_colors_panel', array(
		'title'    => __( 'Section Colors', 'coachpress' ),
		'priority' => 36,
        'description' => __( 'Override the global color settings for individual homepage sections.', 'coachpress' ),
	) );

	$sections = coachpress_get_section_choices();

	foreach ( $sections as $section_id => $section_name ) {
		$wp_customize->add_section( "coachpress_{$section_id}_colors", array(
			'title'    => $section_name,
			'panel'    => 'coachpress_section_colors_panel',
            'description' => sprintf( __( 'Customize the colors for the %s section.', 'coachpress' ), $section_name ),
		) );

		$wp_customize->add_setting( "coachpress_{$section_id}_bg_color", array(
			'default'   => '',
			'transport' => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, "coachpress_{$section_id}_bg_color", array(
			'label'    => __( 'Background Color', 'coachpress' ),
            'description' => __( 'Leave empty to inherit the default background color.', 'coachpress' ),
			'section'  => "coachpress_{$section_id}_colors",
			'settings' => "coachpress_{$section_id}_bg_color",
		) ) );

		$wp_customize->add_setting( "coachpress_{$section_id}_heading_color", array(
			'default'   => '',
			'transport' => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, "coachpress_{$section_id}_heading_color", array(
			'label'    => __( 'Heading Color', 'coachpress' ),
            'description' => __( 'Leave empty to inherit the global text color.', 'coachpress' ),
			'section'  => "coachpress_{$section_id}_colors",
			'settings' => "coachpress_{$section_id}_heading_color",
		) ) );

		$wp_customize->add_setting( "coachpress_{$section_id}_text_color", array(
			'default'   => '',
			'transport' => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, "coachpress_{$section_id}_text_color", array(
			'label'    => __( 'Text Color', 'coachpress' ),
            'description' => __( 'Leave empty to inherit the global text color.', 'coachpress' ),
			'section'  => "coachpress_{$section_id}_colors",
			'settings' => "coachpress_{$section_id}_text_color",
		) ) );
	}

	// Global Typography
	$wp_customize->add_section( 'coachpress_global_typography', array(
		'title'    => __( 'Global Typography', 'coachpress' ),
		'priority' => 21,
        'description' => __( 'Select and configure the fonts for your entire site. We recommend a clean, readable sans-serif for the body and a distinct serif or sans-serif for headings.', 'coachpress' ),
	) );

	$wp_customize->add_setting( 'coachpress_body_font', array(
		'default'   => 'Lato',
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( new CoachPress_Google_Font_Control( $wp_customize, 'coachpress_body_font', array(
		'label'    => __( 'Body Font', 'coachpress' ),
        'description' => __( 'Select the primary font for all paragraph text.', 'coachpress' ),
		'section'  => 'coachpress_global_typography',
		'settings' => 'coachpress_body_font',
	) ) );

    $wp_customize->add_setting( 'coachpress_body_font_weight', array(
        'default'   => '400',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'coachpress_body_font_weight', array(
        'label'    => __( 'Body Font Weight', 'coachpress' ),
        'description' => __( 'E.g., 400 for normal, 700 for bold. Check available weights on Google Fonts.', 'coachpress' ),
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
        'description' => __( 'A unitless value is recommended for responsive scaling (e.g., 1.6).', 'coachpress' ),
        'section'  => 'coachpress_global_typography',
        'settings' => 'coachpress_body_line_height',
        'type'     => 'text',
    ) );

	$wp_customize->add_setting( 'coachpress_heading_font', array(
		'default'   => 'Lora',
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( new CoachPress_Google_Font_Control( $wp_customize, 'coachpress_heading_font', array(
		'label'    => __( 'Heading Font', 'coachpress' ),
        'description' => __( 'Select the font for all headings (H1, H2, H3, etc.).', 'coachpress' ),
		'section'  => 'coachpress_global_typography',
		'settings' => 'coachpress_heading_font',
	) ) );

    $wp_customize->add_setting( 'coachpress_heading_font_weight', array(
        'default'   => '700',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'coachpress_heading_font_weight', array(
        'label'    => __( 'Heading Font Weight', 'coachpress' ),
        'description' => __( 'E.g., 700 for bold. Check available weights on Google Fonts.', 'coachpress' ),
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
        'description' => __( 'Adds space between characters. Use a CSS unit (e.g., 1px, -0.5px).', 'coachpress' ),
        'section'  => 'coachpress_global_typography',
        'settings' => 'coachpress_heading_letter_spacing',
        'type'     => 'text',
    ) );

    // Font Sizes
    $wp_customize->add_setting( 'coachpress_body_font_size', array(
        'default'   => '16px',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'coachpress_body_font_size', array(
        'label'    => __( 'Body Font Size', 'coachpress' ),
        'section'  => 'coachpress_global_typography',
        'type'     => 'text',
    ) );

    for ( $i = 1; $i <= 6; $i++ ) {
        $wp_customize->add_setting( "coachpress_h{$i}_font_size", array(
            'default'   => '',
            'transport' => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        ) );

        $wp_customize->add_control( "coachpress_h{$i}_font_size", array(
            'label'    => sprintf( __( 'H%s Font Size', 'coachpress' ), $i ),
            'section'  => 'coachpress_global_typography',
            'type'     => 'text',
        ) );
    }
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
