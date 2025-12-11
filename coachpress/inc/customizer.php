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
    require_once get_template_directory() . '/inc/google-font-control.php';
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

	// New Panels
    $wp_customize->add_panel( 'coachpress_global_styles_panel', array(
        'title'    => __( 'Global Styles', 'coachpress' ),
        'priority' => 20,
        'description' => __( 'Manage the overall look and feel of your site, including colors, typography, and layout.', 'coachpress' ),
    ) );

    $wp_customize->add_panel( 'coachpress_theme_settings_panel', array(
        'title'    => __( 'Theme Settings', 'coachpress' ),
        'priority' => 21,
        'description' => __( 'Configure general theme settings like the header, footer, and social media links.', 'coachpress' ),
    ) );

    $wp_customize->add_panel( 'coachpress_homepage_sections_panel', array(
        'title'    => __( 'Homepage Sections', 'coachpress' ),
        'priority' => 22,
        'description' => __( 'Manage the content, order, and appearance of each section on your homepage.', 'coachpress' ),
    ) );

	// Global Colors
	$wp_customize->add_section( 'coachpress_global_colors', array(
		'title'    => __( 'Colors', 'coachpress' ),
		'panel'    => 'coachpress_global_styles_panel',
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
		'title'    => __( 'Typography', 'coachpress' ),
		'panel'    => 'coachpress_global_styles_panel',
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

	$sections = coachpress_get_section_choices();

	foreach ( $sections as $section_id => $section_name ) {
		$section_priority = 20;
        $wp_customize->add_section( "coachpress_{$section_id}_section", array(
            'title'    => $section_name,
            'panel'    => 'coachpress_homepage_sections_panel',
            'priority' => $section_priority++,
        ) );

        if ( 'hero' === $section_id ) {
			$wp_customize->add_setting( 'coachpress_hero_bg_color', array(
				'default'   => '#F5F5F5',
				'transport' => 'refresh',
				'sanitize_callback' => 'coachpress_sanitize_background',
			) );

			$wp_customize->add_control( new CoachPress_Gradient_Control( $wp_customize, 'coachpress_hero_bg_color', array(
				'label'    => __( 'Background', 'coachpress' ),
				'section'  => 'coachpress_hero_section',
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
				'section'  => "coachpress_{$section_id}_section",
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
				'section'  => "coachpress_{$section_id}_section",
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
			'section'  => "coachpress_{$section_id}_section",
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
            'description' => __( 'Enter a value with a CSS unit (e.g., 2.5rem, 48px).', 'coachpress' ),
        ) ) );
    }

    // Image Settings
    $wp_customize->add_section( 'coachpress_image_border_radius', array(
        'title'    => __( 'Images', 'coachpress' ),
        'panel'    => 'coachpress_global_styles_panel',
    ) );

    $wp_customize->add_setting( 'coachpress_image_border_radius', array(
        'default'   => json_encode( array( 'top-left' => '0px', 'top-right' => '0px', 'bottom-right' => '0px', 'bottom-left' => '0px' ) ),
        'transport' => 'refresh',
        'sanitize_callback' => 'coachpress_sanitize_border_radius',
    ) );

    $wp_customize->add_control( new CoachPress_Border_Radius_Control( $wp_customize, 'coachpress_image_border_radius', array(
        'label'    => __( 'Image Border Radius', 'coachpress' ),
        'section'  => 'coachpress_image_border_radius',
        'description' => __( 'Enter a value with a CSS unit (e.g., 4px, 1rem) for each corner.', 'coachpress' ),
    ) ) );

    // Layout Settings

    $wp_customize->add_section( 'coachpress_card_layout', array(
        'title'    => __( 'Cards', 'coachpress' ),
        'panel'    => 'coachpress_global_styles_panel',
    ) );

    $wp_customize->add_setting( 'coachpress_card_padding', array(
        'default'   => json_encode( array( 'top' => '20px', 'right' => '20px', 'bottom' => '20px', 'left' => '20px' ) ),
        'transport' => 'refresh',
        'sanitize_callback' => 'coachpress_sanitize_dimensions',
    ) );

    $wp_customize->add_control( new CoachPress_Dimensions_Control( $wp_customize, 'coachpress_card_padding', array(
        'label'    => __( 'Card Padding', 'coachpress' ),
        'section'  => 'coachpress_card_layout',
        'description' => __( 'Enter a value with a CSS unit (e.g., 20px, 1.5rem) for each side.', 'coachpress' ),
    ) ) );

    $wp_customize->add_setting( 'coachpress_card_margin', array(
        'default'   => json_encode( array( 'top' => '0', 'right' => '0', 'bottom' => '20px', 'left' => '0' ) ),
        'transport' => 'refresh',
        'sanitize_callback' => 'coachpress_sanitize_dimensions',
    ) );

    $wp_customize->add_control( new CoachPress_Dimensions_Control( $wp_customize, 'coachpress_card_margin', array(
        'label'    => __( 'Card Margin', 'coachpress' ),
        'section'  => 'coachpress_card_layout',
        'description' => __( 'Enter a value with a CSS unit (e.g., 20px, 1.5rem) for each side.', 'coachpress' ),
    ) ) );

    $wp_customize->add_section( 'coachpress_spacing_layout', array(
        'title'    => __( 'Layout', 'coachpress' ),
        'panel'    => 'coachpress_global_styles_panel',
    ) );

    $wp_customize->add_setting( 'coachpress_section_padding', array(
        'default'   => json_encode( array( 'top' => '60px', 'right' => '0', 'bottom' => '60px', 'left' => '0' ) ),
        'transport' => 'refresh',
        'sanitize_callback' => 'coachpress_sanitize_dimensions',
    ) );

    $wp_customize->add_control( new CoachPress_Dimensions_Control( $wp_customize, 'coachpress_section_padding', array(
        'label'    => __( 'Section Padding', 'coachpress' ),
        'section'  => 'coachpress_spacing_layout',
        'description' => __( 'Enter a value with a CSS unit (e.g., 60px, 2rem) for each side.', 'coachpress' ),
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
        'description' => __( 'Enter a value with a CSS unit (e.g., 1140px, 90%).', 'coachpress' ),
    ) );

    $wp_customize->add_section( 'coachpress_form_layout', array(
        'title'    => __( 'Form Fields', 'coachpress' ),
        'panel'    => 'coachpress_global_styles_panel',
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
        'description' => __( 'Enter a value with a CSS unit (e.g., 100%, 500px).', 'coachpress' ),
    ) );

    $wp_customize->add_section( 'coachpress_image_layout', array(
        'title'    => __( 'Images', 'coachpress' ),
        'panel'    => 'coachpress_global_styles_panel',
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
        'description' => __( 'Enter a value with a CSS unit (e.g., 100%, 500px).', 'coachpress' ),
    ) );
}

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
<?php
/**
 * CoachPress Theme Customizer Component Styles
 *
 * @package CoachPress
 */

function coachpress_customize_register_component_styles( $wp_customize ) {
    // Cards Section
    $wp_customize->add_section( 'coachpress_cards', array(
        'title'    => __( 'Cards', 'coachpress' ),
        'panel'    => 'coachpress_global_styles_panel',
    ) );

    $wp_customize->add_setting( 'coachpress_card_bg_color', array(
        'default'   => '#FFFFFF',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_card_bg_color', array(
        'label'    => __( 'Background Color', 'coachpress' ),
        'section'  => 'coachpress_cards',
    ) ) );

    $wp_customize->add_setting( 'coachpress_card_border_radius', array(
        'default'   => '4px',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'coachpress_card_border_radius', array(
        'label'    => __( 'Border Radius', 'coachpress' ),
        'description' => __( 'Enter a value with a CSS unit (e.g., 4px, 1rem).', 'coachpress' ),
        'section'  => 'coachpress_cards',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'coachpress_card_box_shadow', array(
        'default'   => '0 0 25px rgba(0,0,0,0.07)',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'coachpress_card_box_shadow', array(
        'label'    => __( 'Box Shadow', 'coachpress' ),
        'description' => __( 'Enter a valid CSS box-shadow value.', 'coachpress' ),
        'section'  => 'coachpress_cards',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'coachpress_card_hover_box_shadow', array(
        'default'   => '0 12px 25px rgba(0,0,0,0.1)',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'coachpress_card_hover_box_shadow', array(
        'label'    => __( 'Hover Box Shadow', 'coachpress' ),
        'description' => __( 'Enter a valid CSS box-shadow value for the hover effect.', 'coachpress' ),
        'section'  => 'coachpress_cards',
        'type'     => 'text',
    ) );

    // Sections Section
    $wp_customize->add_section( 'coachpress_sections', array(
        'title'    => __( 'Sections', 'coachpress' ),
        'panel'    => 'coachpress_global_styles_panel',
    ) );

    $wp_customize->add_setting( 'coachpress_section_padding_y', array(
        'default'   => '60px',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'coachpress_section_padding_y', array(
        'label'    => __( 'Padding (Top/Bottom)', 'coachpress' ),
        'description' => __( 'Enter a value with a CSS unit (e.g., 60px, 2rem).', 'coachpress' ),
        'section'  => 'coachpress_sections',
        'type'     => 'text',
    ) );
}
function coachpress_customize_register_component_styles( $wp_customize ) {
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
function coachpress_customize_register_contact_page( $wp_customize ) {
    $wp_customize->add_section( 'coachpress_cta_section', array(
        'title'    => __( 'CTA', 'coachpress' ),
        'panel'    => 'coachpress_homepage_sections_panel',
        'priority' => 110,
        'description' => __( 'Configure the dedicated Call-to-Action section. This can be placed anywhere on the homepage via the Section Ordering & Visibility panel.', 'coachpress' ),
    ) );

    $wp_customize->add_setting( 'coachpress_cta_heading', array(
        'default'   => __( 'Ready to Get Started?', 'coachpress' ),
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'coachpress_cta_heading', array(
        'label'    => __( 'Heading', 'coachpress' ),
        'section'  => 'coachpress_cta_section',
        'settings' => 'coachpress_cta_heading',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'coachpress_cta_subheading', array(
        'default'   => __( 'Take the first step towards achieving your goals. Contact us today for a free consultation.', 'coachpress' ),
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'coachpress_cta_subheading', array(
        'label'    => __( 'Subheading', 'coachpress' ),
        'section'  => 'coachpress_cta_section',
        'settings' => 'coachpress_cta_subheading',
        'type'     => 'textarea',
    ) );

    $wp_customize->add_setting( 'coachpress_cta_button_text', array(
        'default'   => __( 'Book a Free Consultation', 'coachpress' ),
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'coachpress_cta_button_text', array(
        'label'    => __( 'Button Text', 'coachpress' ),
        'section'  => 'coachpress_cta_section',
        'settings' => 'coachpress_cta_button_text',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'coachpress_cta_button_url', array(
        'default'   => '#contact',
        'transport' => 'refresh',
        'sanitize_callback' => 'esc_url_raw',
    ) );

    $wp_customize->add_control( 'coachpress_cta_button_url', array(
        'label'    => __( 'Button URL', 'coachpress' ),
        'description' => __( 'Enter the URL where the button should link. An anchor link like #contact is recommended.', 'coachpress' ),
        'section'  => 'coachpress_cta_section',
        'settings' => 'coachpress_cta_button_url',
        'type'     => 'url',
    ) );

    $wp_customize->add_setting( 'coachpress_cta_alignment', array(
        'default'   => 'center',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_key',
    ) );

    $wp_customize->add_control( 'coachpress_cta_alignment', array(
        'label'    => __( 'Alignment', 'coachpress' ),
        'section'  => 'coachpress_cta_section',
        'type'     => 'select',
        'choices'  => array(
            'left'   => __( 'Left', 'coachpress' ),
            'center' => __( 'Center', 'coachpress' ),
            'right'  => __( 'Right', 'coachpress' ),
        ),
    ) );
}
function coachpress_customize_register_cta_section( $wp_customize ) {
    // Footer Settings Section
    $wp_customize->add_section( 'coachpress_footer_settings', array(
        'title'    => __( 'Footer', 'coachpress' ),
        'panel'    => 'coachpress_theme_settings_panel',
        'priority' => 31,
    ) );

    $wp_customize->add_setting( 'coachpress_footer_bg_color', array(
        'default'   => '#1A1A1A',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_footer_bg_color', array(
        'label'    => __( 'Background Color', 'coachpress' ),
        'section'  => 'coachpress_footer_settings',
    ) ) );

    $wp_customize->add_setting( 'coachpress_footer_text_color', array(
        'default'   => '#FFFFFF',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_footer_text_color', array(
        'label'    => __( 'Text Color', 'coachpress' ),
        'section'  => 'coachpress_footer_settings',
    ) ) );

    $wp_customize->add_setting( 'coachpress_footer_link_color', array(
        'default'   => '#FFFFFF',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_footer_link_color', array(
        'label'    => __( 'Link Color', 'coachpress' ),
        'section'  => 'coachpress_footer_settings',
    ) ) );

    $wp_customize->add_setting( 'coachpress_footer_link_hover_color', array(
        'default'   => '#FFC107',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_footer_link_hover_color', array(
        'label'    => __( 'Link Hover Color', 'coachpress' ),
        'section'  => 'coachpress_footer_settings',
    ) ) );

    $wp_customize->add_setting( 'coachpress_footer_padding_y', array(
        'default'   => '60px',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'coachpress_footer_padding_y', array(
        'label'    => __( 'Padding (Top/Bottom)', 'coachpress' ),
        'description' => __( 'Enter a value with a CSS unit (e.g., 60px, 2rem).', 'coachpress' ),
        'section'  => 'coachpress_footer_settings',
        'type'     => 'text',
    ) );
}
function coachpress_customize_register_footer_settings( $wp_customize ) {
    // Images Section
    $wp_customize->add_section( 'coachpress_images', array(
        'title'    => __( 'Images', 'coachpress' ),
        'panel'    => 'coachpress_global_styles_panel',
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
        'panel'    => 'coachpress_global_styles_panel',
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
function coachpress_customize_register_form_image_styles( $wp_customize ) {
    $wp_customize->add_section( 'coachpress_header_cta', array(
        'title'    => __( 'Header CTA Button', 'coachpress' ),
        'priority' => 40,
        'description' => __( 'Configure the main call-to-action button in the site header. This is a key conversion point.', 'coachpress' ),
    ) );

    $wp_customize->add_setting( 'coachpress_header_cta_text', array(
        'default'   => __( 'Contact Us', 'coachpress' ),
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'coachpress_header_cta_text', array(
        'label'    => __( 'Button Text', 'coachpress' ),
        'description' => __( 'The text displayed on the button.', 'coachpress' ),
        'section'  => 'coachpress_header_cta',
        'settings' => 'coachpress_header_cta_text',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'coachpress_header_cta_type', array(
        'default'   => 'url',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_key',
    ) );

    $wp_customize->add_control( 'coachpress_header_cta_type', array(
        'label'    => __( 'CTA Type', 'coachpress' ),
        'description' => __( 'Select the button\'s action. "URL" links to a page. "HTML" or "Shortcode" opens a modal popup with the content.', 'coachpress' ),
        'section'  => 'coachpress_header_cta',
        'settings' => 'coachpress_header_cta_type',
        'type'     => 'select',
        'choices'  => array(
            'url'       => __( 'URL', 'coachpress' ),
            'html'      => __( 'HTML', 'coachpress' ),
            'shortcode' => __( 'Shortcode', 'coachpress' ),
        ),
    ) );

    $wp_customize->add_setting( 'coachpress_header_cta_url', array(
        'default'   => '#',
        'transport' => 'refresh',
        'sanitize_callback' => 'esc_url_raw',
    ) );

    $wp_customize->add_control( 'coachpress_header_cta_url', array(
        'label'    => __( 'Button URL', 'coachpress' ),
        'description' => __( 'Enter the full URL where the button should link.', 'coachpress' ),
        'section'  => 'coachpress_header_cta',
        'settings' => 'coachpress_header_cta_url',
        'type'     => 'url',
        'active_callback' => function() {
            return 'url' === get_theme_mod( 'coachpress_header_cta_type' );
        },
    ) );

    $wp_customize->add_setting( 'coachpress_header_cta_html', array(
        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post',
    ) );

    $wp_customize->add_control( 'coachpress_header_cta_html', array(
        'label'    => __( 'Modal HTML Content', 'coachpress' ),
        'description' => __( 'Enter the HTML to display in the popup modal. Can include form embed code.', 'coachpress' ),
        'section'  => 'coachpress_header_cta',
        'settings' => 'coachpress_header_cta_html',
        'type'     => 'textarea',
        'active_callback' => function() {
            return 'html' === get_theme_mod( 'coachpress_header_cta_type' );
        },
    ) );

    $wp_customize->add_setting( 'coachpress_header_cta_shortcode', array(
        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'coachpress_header_cta_shortcode', array(
        'label'    => __( 'Modal Shortcode', 'coachpress' ),
        'description' => __( 'Enter a shortcode (e.g., from a form plugin) to render in the popup modal.', 'coachpress' ),
        'section'  => 'coachpress_header_cta',
        'settings' => 'coachpress_header_cta_shortcode',
        'type'     => 'text',
        'active_callback' => function() {
            return 'shortcode' === get_theme_mod( 'coachpress_header_cta_type' );
        },
    ) );
}
function coachpress_customize_register_header_cta( $wp_customize ) {
    // Header Settings Section
    $wp_customize->add_section( 'coachpress_header_settings', array(
        'title'    => __( 'Header', 'coachpress' ),
        'panel'    => 'coachpress_theme_settings_panel',
        'priority' => 30,
    ) );

    $wp_customize->add_setting( 'coachpress_header_bg_color', array(
        'default'   => '#FFFFFF',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_header_bg_color', array(
        'label'    => __( 'Background Color', 'coachpress' ),
        'section'  => 'coachpress_header_settings',
    ) ) );

    $wp_customize->add_setting( 'coachpress_header_text_color', array(
        'default'   => '#333333',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_header_text_color', array(
        'label'    => __( 'Text Color', 'coachpress' ),
        'section'  => 'coachpress_header_settings',
    ) ) );

    $wp_customize->add_setting( 'coachpress_header_link_color', array(
        'default'   => '#0D2F4F',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_header_link_color', array(
        'label'    => __( 'Link Color', 'coachpress' ),
        'section'  => 'coachpress_header_settings',
    ) ) );

    $wp_customize->add_setting( 'coachpress_header_link_hover_color', array(
        'default'   => '#FFC107',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_header_link_hover_color', array(
        'label'    => __( 'Link Hover Color', 'coachpress' ),
        'section'  => 'coachpress_header_settings',
    ) ) );

    $wp_customize->add_setting( 'coachpress_header_hamburger_color', array(
        'default'   => '#333333',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_header_hamburger_color', array(
        'label'    => __( 'Mobile Menu (Hamburger) Color', 'coachpress' ),
        'section'  => 'coachpress_header_settings',
    ) ) );

    $wp_customize->add_setting( 'coachpress_mobile_menu_bg_color', array(
        'default'   => '#FFFFFF',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_mobile_menu_bg_color', array(
        'label'    => __( 'Mobile Menu Background Color', 'coachpress' ),
        'section'  => 'coachpress_header_settings',
    ) ) );

    $wp_customize->add_setting( 'coachpress_mobile_menu_hover_bg_color', array(
        'default'   => '#F5F5F5',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_mobile_menu_hover_bg_color', array(
        'label'    => __( 'Mobile Menu Hover Background Color', 'coachpress' ),
        'section'  => 'coachpress_header_settings',
    ) ) );

    $wp_customize->add_setting( 'coachpress_header_padding_y', array(
        'default'   => '15px',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'coachpress_header_padding_y', array(
        'label'    => __( 'Padding (Top/Bottom)', 'coachpress' ),
        'description' => __( 'Enter a value with a CSS unit (e.g., 15px, 1rem).', 'coachpress' ),
        'section'  => 'coachpress_header_settings',
        'type'     => 'text',
    ) );
}
function coachpress_customize_register_header_settings( $wp_customize ) {
    $wp_customize->add_section( 'coachpress_hero_section', array(
        'title'    => __( 'Hero', 'coachpress' ),
        'panel'    => 'coachpress_homepage_sections_panel',
        'priority' => 10,
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

    $wp_customize->add_setting( 'coachpress_hero_heading_color', array(
        'default'   => '#FFFFFF',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_hero_heading_color', array(
        'label'    => __( 'Heading Color', 'coachpress' ),
        'section'  => 'coachpress_hero_section',
    ) ) );

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

    $wp_customize->add_setting( 'coachpress_hero_left_button_2_text', array(
        'default'   => __( 'Learn More', 'coachpress' ),
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'coachpress_hero_left_button_2_text', array(
        'label'    => __( 'Button 2 Text', 'coachpress' ),
        'section'  => 'coachpress_hero_section',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'coachpress_hero_left_button_2_url', array(
        'default'   => '#',
        'transport' => 'refresh',
        'sanitize_callback' => 'esc_url_raw',
    ) );

    $wp_customize->add_control( 'coachpress_hero_left_button_2_url', array(
        'label'    => __( 'Button 2 URL', 'coachpress' ),
        'section'  => 'coachpress_hero_section',
        'type'     => 'url',
    ) );

    $wp_customize->add_setting( 'coachpress_hero_content', array(
        'default'   => __( 'Calm. Focused. Results-driven. This is advisory support for professionals who value thinking clearly and acting deliberately.', 'coachpress' ),
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post',
    ) );

    $wp_customize->add_control( 'coachpress_hero_content', array(
        'label'    => __( 'Content', 'coachpress' ),
        'section'  => 'coachpress_hero_section',
        'type'     => 'textarea',
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
function coachpress_customize_register_hero_section( $wp_customize ) {
    // Layout Settings Section
    $wp_customize->add_section( 'coachpress_layout_settings', array(
        'title'    => __( 'Layout', 'coachpress' ),
        'panel'    => 'coachpress_global_styles_panel',
        'priority' => 34,
        'description' => __( 'Customize the layout of your site, including container widths and spacing.', 'coachpress' ),
    ) );

    $wp_customize->add_setting( 'coachpress_container_width', array(
        'default'   => '1140px',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'coachpress_container_width', array(
        'label'    => __( 'Container Width', 'coachpress' ),
        'description' => __( 'Enter a value with a CSS unit (e.g., 1140px, 90%).', 'coachpress' ),
        'section'  => 'coachpress_layout_settings',
        'type'     => 'text',
    ) );
}
function coachpress_customize_register_layout_settings( $wp_customize ) {
    // Trust Section
    $wp_customize->add_section( 'coachpress_trust_section', array(
        'title'    => __( 'Trust', 'coachpress' ),
        'panel'    => 'coachpress_homepage_sections_panel',
    ) );

    $wp_customize->add_setting( 'coachpress_trust_section_title', array(
        'default'   => __( 'Trusted by professionals who value clarity', 'coachpress' ),
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'coachpress_trust_section_title', array(
        'label'    => __( 'Title', 'coachpress' ),
        'section'  => 'coachpress_trust_section',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'coachpress_trust_section_description', array(
        'default'   => __( 'Over a decade of experience helping professionals simplify complexity, align strategy with reality, and make confident decisions across technology, legal, leadership, and advisory environments.', 'coachpress' ),
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post',
    ) );

    $wp_customize->add_control( 'coachpress_trust_section_description', array(
        'label'    => __( 'Description', 'coachpress' ),
        'section'  => 'coachpress_trust_section',
        'type'     => 'textarea',
    ) );

    // Problem Section
    $wp_customize->add_section( 'coachpress_problem_section', array(
        'title'    => __( 'Problem', 'coachpress' ),
        'panel'    => 'coachpress_homepage_sections_panel',
    ) );

    $wp_customize->add_setting( 'coachpress_problem_section_title', array(
        'default'   => __( 'You don’t have a motivation problem. You have a clarity problem.', 'coachpress' ),
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'coachpress_problem_section_title', array(
        'label'    => __( 'Title', 'coachpress' ),
        'section'  => 'coachpress_problem_section',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'coachpress_problem_section_description', array(
        'default'   => __( "Most professionals are not stuck because they lack skill or effort. They’re stuck because priorities are unclear, options are overwhelming, and strategic decisions feel unnecessarily difficult.\n\nMy work focuses on removing noise, identifying what actually matters, and turning insight into action—without pressure or hype.", 'coachpress' ),
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post',
    ) );

    $wp_customize->add_control( 'coachpress_problem_section_description', array(
        'label'    => __( 'Description', 'coachpress' ),
        'section'  => 'coachpress_problem_section',
        'type'     => 'textarea',
    ) );

    // About Preview Section
    $wp_customize->add_section( 'coachpress_about_preview_section', array(
        'title'    => __( 'About Preview', 'coachpress' ),
        'panel'    => 'coachpress_homepage_sections_panel',
    ) );

    $wp_customize->add_setting( 'coachpress_about_preview_section_title', array(
        'default'   => __( 'Practical experience. Calm guidance.', 'coachpress' ),
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'coachpress_about_preview_section_title', array(
        'label'    => __( 'Title', 'coachpress' ),
        'section'  => 'coachpress_about_preview_section',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'coachpress_about_preview_section_description', array(
        'default'   => __( "My background spans consulting, advisory work, and leadership support across technology, professional services, and executive environments.\n\nClients work with me because I help them think clearly, decide confidently, and move forward with purpose.", 'coachpress' ),
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post',
    ) );

    $wp_customize->add_control( 'coachpress_about_preview_section_description', array(
        'label'    => __( 'Description', 'coachpress' ),
        'section'  => 'coachpress_about_preview_section',
        'type'     => 'textarea',
    ) );
}
function coachpress_customize_register_new_sections( $wp_customize ) {
    $wp_customize->add_section( 'coachpress_section_ordering', array(
        'title'    => __( 'Section Ordering & Visibility', 'coachpress' ),
        'panel'    => 'coachpress_homepage_sections_panel',
        'priority' => 1,
        'description' => __( 'Control the order and visibility of the sections on your homepage. Drag and drop to reorder, and use the checkboxes to show or hide sections.', 'coachpress' ),
    ) );

    $wp_customize->add_setting( 'coachpress_section_order', array(
        'default'   => 'hero,services,testimonials,case-studies,processes,faqs,cta,contact',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new CoachPress_Section_Order_Control( $wp_customize, 'coachpress_section_order', array(
        'label'    => __( 'Homepage Section Order', 'coachpress' ),
        'description' => __( 'Drag and drop the sections below to change their display order.', 'coachpress' ),
        'section'  => 'coachpress_section_ordering',
        'settings' => 'coachpress_section_order',
    ) ) );

    $sections = coachpress_get_section_choices();

    foreach ( $sections as $section_id => $section_name ) {
        $wp_customize->add_setting( "coachpress_section_visibility[$section_id]", array(
            'default'   => true,
            'transport' => 'refresh',
            'sanitize_callback' => 'absint',
        ) );

        $wp_customize->add_control( "coachpress_section_visibility_$section_id", array(
            'label'    => sprintf( __( 'Show %s Section', 'coachpress' ), $section_name ),
            'section'  => 'coachpress_section_ordering',
            'settings' => "coachpress_section_visibility[$section_id]",
            'type'     => 'checkbox',
        ) );
    }
}
function coachpress_customize_register_section_ordering( $wp_customize ) {
    $wp_customize->add_section( 'coachpress_section_titles', array(
        'title'    => __( 'Section Titles', 'coachpress' ),
        'panel'    => 'coachpress_homepage_sections_panel',
        'priority' => 2,
        'description' => __( 'Customize the main H2 titles for each section of your homepage.', 'coachpress' ),
    ) );

    $sections = coachpress_get_section_choices();

    foreach ( $sections as $section_id => $section_name ) {
        $wp_customize->add_setting( "coachpress_{$section_id}_section_title", array(
            'default'   => $section_name,
            'transport' => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        ) );

        $wp_customize->add_control( "coachpress_{$section_id}_section_title", array(
            'label'    => sprintf( __( '%s Section Title', 'coachpress' ), $section_name ),
            'section'  => 'coachpress_section_titles',
            'type'     => 'text',
        ) );

        $wp_customize->add_setting( "coachpress_{$section_id}_section_description", array(
            'default'   => '',
            'transport' => 'refresh',
            'sanitize_callback' => 'wp_kses_post',
        ) );

        $wp_customize->add_control( "coachpress_{$section_id}_section_description", array(
            'label'    => sprintf( __( '%s Section Description', 'coachpress' ), $section_name ),
            'section'  => 'coachpress_section_titles',
            'type'     => 'textarea',
        ) );

        $wp_customize->add_setting( "coachpress_{$section_id}_section_alignment", array(
            'default'   => 'center',
            'transport' => 'refresh',
            'sanitize_callback' => 'sanitize_key',
        ) );

        $wp_customize->add_control( "coachpress_{$section_id}_section_alignment", array(
            'label'    => sprintf( __( '%s Section Alignment', 'coachpress' ), $section_name ),
            'section'  => 'coachpress_section_titles',
            'type'     => 'select',
            'choices'  => array(
                'left'   => __( 'Left', 'coachpress' ),
                'center' => __( 'Center', 'coachpress' ),
                'right'  => __( 'Right', 'coachpress' ),
            ),
        ) );
    }
}
function coachpress_customize_register_section_titles( $wp_customize ) {
    $wp_customize->add_section( 'coachpress_social_media', array(
        'title'    => __( 'Social Media', 'coachpress' ),
        'panel'    => 'coachpress_theme_settings_panel',
        'priority' => 120,
        'description' => __( 'Enter the full URLs for your social media profiles. Icons will appear in the site footer for each URL you provide.', 'coachpress' ),
    ) );

    $social_networks = array(
        'facebook'  => __( 'Facebook', 'coachpress' ),
        'twitter'   => __( 'Twitter', 'coachpress' ),
        'instagram' => __( 'Instagram', 'coachpress' ),
        'linkedin'  => __( 'LinkedIn', 'coachpress' ),
        'youtube'   => __( 'YouTube', 'coachpress' ),
    );

    foreach ( $social_networks as $network => $label ) {
        $wp_customize->add_setting( "coachpress_social_{$network}", array(
            'default'   => '',
            'transport' => 'refresh',
            'sanitize_callback' => 'esc_url_raw',
        ) );

        $wp_customize->add_control( "coachpress_social_{$network}", array(
            'label'    => $label,
            'section'  => 'coachpress_social_media',
            'settings' => "coachpress_social_{$network}",
            'type'     => 'url',
        ) );
    }
}
function coachpress_customize_register_social_media( $wp_customize ) {
}
add_action( 'customize_register', 'coachpress_customize_register' );
