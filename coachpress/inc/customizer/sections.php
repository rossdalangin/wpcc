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
	$wp_customize->add_section( 'coachpress_global_colors', array( 'title' => __( 'Brand Colors', 'coachpress' ), 'panel' => 'coachpress_global_styles_panel', 'description' => __( 'Establish your visual identity. These colors are used throughout the entire site to maintain a consistent professional look.', 'coachpress' ) ) );
	$wp_customize->add_section( 'coachpress_global_typography', array( 'title' => __( 'Global Typography', 'coachpress' ), 'panel' => 'coachpress_global_styles_panel', 'description' => __( 'Choose the fonts that represent your brand. Serif fonts add authority, while Sans-Serif fonts feel modern and clean.', 'coachpress' ) ) );
    $wp_customize->add_section( 'coachpress_cards', array( 'title' => __( 'Card & Item Styles', 'coachpress' ), 'panel' => 'coachpress_global_styles_panel', 'description' => __('Modify the design of the "boxes" used in your grids (Services, Testimonials, etc).', 'coachpress') ) );
    $wp_customize->add_section( 'coachpress_layout', array( 'title' => __( 'Page Layout', 'coachpress' ), 'panel' => 'coachpress_global_styles_panel', 'description' => __('Global settings for site-wide width and container spacing.', 'coachpress') ) );
    $wp_customize->add_section( 'coachpress_images', array( 'title' => __( 'Image Styles', 'coachpress' ), 'panel' => 'coachpress_global_styles_panel', 'description' => __('Global controls for how images look on your site.', 'coachpress') ) );
    $wp_customize->add_section( 'coachpress_forms', array( 'title' => __( 'Contact Form Styles', 'coachpress' ), 'panel' => 'coachpress_global_styles_panel', 'description' => __('Customize the appearance of input fields and textareas in your forms.', 'coachpress') ) );

    //======================================================================
    // Theme Settings Sections
    //======================================================================
    $wp_customize->add_section( 'coachpress_header_settings', array( 'title' => __( 'Header & Navigation', 'coachpress' ), 'panel' => 'coachpress_theme_settings_panel', 'description' => __('Manage the look of the top navigation bar.', 'coachpress') ) );
    $wp_customize->add_section( 'coachpress_header_cta', array( 'title' => __( 'Header Call-to-Action', 'coachpress' ), 'panel' => 'coachpress_theme_settings_panel', 'description' => __('Settings for the high-priority button in your menu bar.', 'coachpress') ) );
    $wp_customize->add_section( 'coachpress_footer_settings', array( 'title' => __( 'Footer & Copyright', 'coachpress' ), 'panel' => 'coachpress_theme_settings_panel', 'description' => __('Customize the very bottom of your website.', 'coachpress') ) );
    $wp_customize->add_section( 'coachpress_social_media', array( 'title' => __( 'Social Media Profiles', 'coachpress' ), 'panel' => 'coachpress_theme_settings_panel', 'description' => __('Enter your profile links to show social icons in the header and footer.', 'coachpress') ) );

    //======================================================================
    // Homepage Sections
    //======================================================================
    $wp_customize->add_section( 'coachpress_section_ordering', array( 'title' => __( 'Manage All Sections', 'coachpress' ), 'panel' => 'coachpress_homepage_sections_panel', 'description' => __('The master control for your homepage. Enable, disable, and reorder every piece of content from here.', 'coachpress'), 'priority' => 1 ) );

    $sections = coachpress_get_section_choices();
    $section_priority = 10;
	foreach ( $sections as $section_id => $section_name ) {
        $wp_customize->add_section( "coachpress_{$section_id}_section", array(
            'title'    => $section_name,
            'panel'    => 'coachpress_homepage_sections_panel',
            'description' => sprintf(__('Granular styling and content controls for the %s section.', 'coachpress'), $section_name),
            'priority' => $section_priority++,
        ) );
	}

}
