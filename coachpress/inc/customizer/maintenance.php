<?php
/**
 * Customizer Maintenance Section
 *
 * @package CoachPress
 */

function coachpress_customize_maintenance( $wp_customize ) {
    $wp_customize->add_section( 'coachpress_maintenance_section', array(
        'title'    => __( 'Theme Maintenance', 'coachpress' ),
        'priority' => 999,
        'panel'    => 'coachpress_theme_settings_panel',
    ) );

    $wp_customize->add_setting( 'coachpress_maintenance_actions', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new CoachPress_Maintenance_Control( $wp_customize, 'coachpress_maintenance_actions', array(
        'label'       => __( 'Database & Page Management', 'coachpress' ),
        'description' => __( 'Use these tools to manage theme content and pages. Caution: Some actions are destructive.', 'coachpress' ),
        'section'     => 'coachpress_maintenance_section',
    ) ) );
}
