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
    require_once get_template_directory() . '/inc/gradient-control.php';
    require_once get_template_directory() . '/inc/responsive-font-size-control.php';
    require_once get_template_directory() . '/inc/border-radius-control.php';
    require_once get_template_directory() . '/inc/dimensions-control.php';
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

		if ( 'hero' === $section_id ) {
			$wp_customize->add_setting( 'coachpress_hero_bg_color', array(
				'default'   => '#F5F5F5',
				'transport' => 'refresh',
				'sanitize_callback' => 'coachpress_sanitize_background',
			) );

			$wp_customize->add_control( new CoachPress_Gradient_Control( $wp_customize, 'coachpress_hero_bg_color', array(
				'label'    => __( 'Background', 'coachpress' ),
				'section'  => 'coachpress_hero_colors',
				'settings' => 'coachpress_hero_bg_color',
			) ) );
		} else {
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
		}


		if ( 'hero' !== $section_id ) {
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
		}

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

    // Font Sizes
    $wp_customize->add_setting( 'coachpress_body_font_size', array(
        'default'   => json_encode( array( 'desktop' => '16px', 'tablet' => '16px', 'mobile' => '15px' ) ),
        'transport' => 'refresh',
        'sanitize_callback' => 'coachpress_sanitize_responsive_font_size',
    ) );

    $wp_customize->add_control( new CoachPress_Responsive_Font_Size_Control( $wp_customize, 'coachpress_body_font_size', array(
        'label'    => __( 'Body Font Size', 'coachpress' ),
        'section'  => 'coachpress_global_typography',
    ) ) );

    for ( $i = 1; $i <= 6; $i++ ) {
        $wp_customize->add_setting( "coachpress_h{$i}_font_size", array(
            'default'   => '',
            'transport' => 'refresh',
            'sanitize_callback' => 'coachpress_sanitize_responsive_font_size',
        ) );

        $wp_customize->add_control( new CoachPress_Responsive_Font_Size_Control( $wp_customize, "coachpress_h{$i}_font_size", array(
            'label'    => sprintf( __( 'H%s Font Size', 'coachpress' ), $i ),
            'section'  => 'coachpress_global_typography',
        ) ) );
    }

    // Image Settings
    $wp_customize->add_panel( 'coachpress_image_settings_panel', array(
        'title'    => __( 'Image Settings', 'coachpress' ),
        'priority' => 40,
        'description' => __( 'Control the appearance of images across your site.', 'coachpress' ),
    ) );

    $wp_customize->add_section( 'coachpress_image_border_radius', array(
        'title'    => __( 'Border Radius', 'coachpress' ),
        'panel'    => 'coachpress_image_settings_panel',
    ) );

    $wp_customize->add_setting( 'coachpress_image_border_radius', array(
        'default'   => json_encode( array( 'top-left' => '0px', 'top-right' => '0px', 'bottom-right' => '0px', 'bottom-left' => '0px' ) ),
        'transport' => 'refresh',
        'sanitize_callback' => 'coachpress_sanitize_border_radius',
    ) );

    $wp_customize->add_control( new CoachPress_Border_Radius_Control( $wp_customize, 'coachpress_image_border_radius', array(
        'label'    => __( 'Image Border Radius', 'coachpress' ),
        'section'  => 'coachpress_image_border_radius',
    ) ) );

    // Layout Settings
    $wp_customize->add_panel( 'coachpress_layout_settings_panel', array(
        'title'    => __( 'Layout Settings', 'coachpress' ),
        'priority' => 41,
        'description' => __( 'Control the spacing and layout of various elements.', 'coachpress' ),
    ) );

    $wp_customize->add_section( 'coachpress_card_layout', array(
        'title'    => __( 'Card Layout', 'coachpress' ),
        'panel'    => 'coachpress_layout_settings_panel',
    ) );

    $wp_customize->add_setting( 'coachpress_card_padding', array(
        'default'   => json_encode( array( 'top' => '20px', 'right' => '20px', 'bottom' => '20px', 'left' => '20px' ) ),
        'transport' => 'refresh',
        'sanitize_callback' => 'coachpress_sanitize_dimensions',
    ) );

    $wp_customize->add_control( new CoachPress_Dimensions_Control( $wp_customize, 'coachpress_card_padding', array(
        'label'    => __( 'Card Padding', 'coachpress' ),
        'section'  => 'coachpress_card_layout',
    ) ) );

    $wp_customize->add_setting( 'coachpress_card_margin', array(
        'default'   => json_encode( array( 'top' => '0', 'right' => '0', 'bottom' => '20px', 'left' => '0' ) ),
        'transport' => 'refresh',
        'sanitize_callback' => 'coachpress_sanitize_dimensions',
    ) );

    $wp_customize->add_control( new CoachPress_Dimensions_Control( $wp_customize, 'coachpress_card_margin', array(
        'label'    => __( 'Card Margin', 'coachpress' ),
        'section'  => 'coachpress_card_layout',
    ) ) );

    $wp_customize->add_section( 'coachpress_spacing_layout', array(
        'title'    => __( 'Spacing', 'coachpress' ),
        'panel'    => 'coachpress_layout_settings_panel',
    ) );

    $wp_customize->add_setting( 'coachpress_section_padding', array(
        'default'   => json_encode( array( 'top' => '60px', 'right' => '0', 'bottom' => '60px', 'left' => '0' ) ),
        'transport' => 'refresh',
        'sanitize_callback' => 'coachpress_sanitize_dimensions',
    ) );

    $wp_customize->add_control( new CoachPress_Dimensions_Control( $wp_customize, 'coachpress_section_padding', array(
        'label'    => __( 'Section Padding', 'coachpress' ),
        'section'  => 'coachpress_spacing_layout',
    ) ) );

    $wp_customize->add_setting( 'coachpress_container_width', array(
        'default'   => '1140px',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'coachpress_container_width', array(
        'label'    => __( 'Container Width', 'coachpress' ),
        'section'  => 'coachpress_spacing_layout',
        'type'     => 'text',
    ) );

    $wp_customize->add_section( 'coachpress_form_layout', array(
        'title'    => __( 'Forms', 'coachpress' ),
        'panel'    => 'coachpress_layout_settings_panel',
    ) );

    $wp_customize->add_setting( 'coachpress_form_width', array(
        'default'   => '100%',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'coachpress_form_width', array(
        'label'    => __( 'Form Width', 'coachpress' ),
        'section'  => 'coachpress_form_layout',
        'type'     => 'text',
    ) );

    $wp_customize->add_section( 'coachpress_image_layout', array(
        'title'    => __( 'Image Layout', 'coachpress' ),
        'panel'    => 'coachpress_image_settings_panel',
    ) );

    $wp_customize->add_setting( 'coachpress_image_width', array(
        'default'   => '100%',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'coachpress_image_width', array(
        'label'    => __( 'Image Width', 'coachpress' ),
        'section'  => 'coachpress_image_layout',
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

function coachpress_customize_controls_scripts() {
    wp_enqueue_script( 'coachpress-gradient-control', get_template_directory_uri() . '/js/gradient-control.js', array( 'jquery', 'wp-color-picker' ), COACHPRESS_VERSION, true );
    wp_enqueue_style( 'coachpress-gradient-control', get_template_directory_uri() . '/css/gradient-control.css' );

    wp_enqueue_script( 'coachpress-responsive-font-size-control', get_template_directory_uri() . '/js/responsive-font-size-control.js', array( 'jquery', 'customize-controls' ), COACHPRESS_VERSION, true );
    wp_enqueue_style( 'coachpress-responsive-font-size-control', get_template_directory_uri() . '/css/responsive-font-size-control.css' );

    wp_enqueue_script( 'coachpress-border-radius-control', get_template_directory_uri() . '/js/border-radius-control.js', array( 'jquery', 'customize-controls' ), COACHPRESS_VERSION, true );
    wp_enqueue_style( 'coachpress-border-radius-control', get_template_directory_uri() . '/css/border-radius-control.css' );

    wp_enqueue_script( 'coachpress-dimensions-control', get_template_directory_uri() . '/js/dimensions-control.js', array( 'jquery', 'customize-controls' ), COACHPRESS_VERSION, true );
    wp_enqueue_style( 'coachpress-dimensions-control', get_template_directory_uri() . '/css/dimensions-control.css' );
}
add_action( 'customize_controls_enqueue_scripts', 'coachpress_customize_controls_scripts' );

function coachpress_sanitize_background( $value ) {
    if ( strpos( $value, 'linear-gradient' ) !== false ) {
        return esc_attr( $value );
    }
    return sanitize_hex_color( $value );
}

function coachpress_sanitize_responsive_font_size( $value ) {
    $value_decoded = json_decode( $value, true );

    if ( ! is_array( $value_decoded ) ) {
        return json_encode( array() );
    }

    foreach ( $value_decoded as $device => $size ) {
        $value_decoded[$device] = sanitize_text_field( $size );
    }

    return json_encode( $value_decoded );
}

function coachpress_sanitize_dimensions( $value ) {
    $value_decoded = json_decode( $value, true );

    if ( ! is_array( $value_decoded ) ) {
        return json_encode( array() );
    }

    foreach ( $value_decoded as $side => $dimension ) {
        $value_decoded[$side] = sanitize_text_field( $dimension );
    }

    return json_encode( $value_decoded );
}

function coachpress_sanitize_border_radius( $value ) {
    $value_decoded = json_decode( $value, true );

    if ( ! is_array( $value_decoded ) ) {
        return json_encode( array() );
    }

    foreach ( $value_decoded as $corner => $radius ) {
        $value_decoded[$corner] = sanitize_text_field( $radius );
    }

    return json_encode( $value_decoded );
}
