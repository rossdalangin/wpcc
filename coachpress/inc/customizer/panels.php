<?php
/**
 * Customizer Panels
 *
 * @package CoachPress
 */

function coachpress_customize_panels( $wp_customize ) {
    //======================================================================
    // Panels
    //======================================================================
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
}
