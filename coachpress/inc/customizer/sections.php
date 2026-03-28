<?php
/**
 * Customizer Sections
 *
 * @package CoachPress
 */

function coachpress_customize_sections( $wp_customize ) {
    //======================================================================
    // Global Styles Sections
    //======================================================================
	$wp_customize->add_section( 'coachpress_global_colors', array( 'title' => __( 'Colors', 'coachpress' ), 'panel' => 'coachpress_global_styles_panel', 'description' => __( 'Define the main color palette for your site.', 'coachpress' ) ) );
	$wp_customize->add_section( 'coachpress_global_typography', array( 'title' => __( 'Typography', 'coachpress' ), 'panel' => 'coachpress_global_styles_panel', 'description' => __( 'Select and configure the fonts for your entire site.', 'coachpress' ) ) );
    $wp_customize->add_section( 'coachpress_cards', array( 'title' => __( 'Cards', 'coachpress' ), 'panel' => 'coachpress_global_styles_panel' ) );
    $wp_customize->add_section( 'coachpress_layout', array( 'title' => __( 'Layout', 'coachpress' ), 'panel' => 'coachpress_global_styles_panel' ) );
    $wp_customize->add_section( 'coachpress_images', array( 'title' => __( 'Images', 'coachpress' ), 'panel' => 'coachpress_global_styles_panel' ) );
    $wp_customize->add_section( 'coachpress_forms', array( 'title' => __( 'Form Fields', 'coachpress' ), 'panel' => 'coachpress_global_styles_panel' ) );

    //======================================================================
    // Theme Settings Sections
    //======================================================================
    $wp_customize->add_section( 'coachpress_header_settings', array( 'title' => __( 'Header', 'coachpress' ), 'panel' => 'coachpress_theme_settings_panel' ) );
    $wp_customize->add_section( 'coachpress_header_cta', array( 'title' => __( 'Header CTA Button', 'coachpress' ), 'panel' => 'coachpress_theme_settings_panel' ) );
    $wp_customize->add_section( 'coachpress_footer_settings', array( 'title' => __( 'Footer', 'coachpress' ), 'panel' => 'coachpress_theme_settings_panel' ) );
    $wp_customize->add_section( 'coachpress_social_media', array( 'title' => __( 'Social Media', 'coachpress' ), 'panel' => 'coachpress_theme_settings_panel' ) );

    //======================================================================
    // Homepage Sections
    //======================================================================
    $wp_customize->add_section( 'coachpress_section_ordering', array( 'title' => __( 'Section Ordering & Visibility', 'coachpress' ), 'panel' => 'coachpress_homepage_sections_panel', 'priority' => 1 ) );
    $wp_customize->add_section( 'coachpress_section_titles', array( 'title' => __( 'Section Titles', 'coachpress' ), 'panel' => 'coachpress_homepage_sections_panel', 'priority' => 2 ) );
    $sections = coachpress_get_section_choices();
    $section_priority = 10;
	foreach ( $sections as $section_id => $section_name ) {
        $wp_customize->add_section( "coachpress_{$section_id}_section", array(
            'title'    => $section_name,
            'panel'    => 'coachpress_homepage_sections_panel',
            'priority' => $section_priority++,
        ) );
	}

    //======================================================================
    // Page Template Sections
    //======================================================================
    $wp_customize->add_section( 'coachpress_contact_page', array( 'title' => __( 'Contact Page Template', 'coachpress' ), 'priority' => 50 ) );
    $wp_customize->add_section( 'coachpress_sales_letter_page', array( 'title' => __( 'Premium Sales Letter', 'coachpress' ), 'priority' => 55 ) );
}
