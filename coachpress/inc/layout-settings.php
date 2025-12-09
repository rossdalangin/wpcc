<?php
/**
 * CoachPress Theme Customizer Layout Settings
 *
 * @package CoachPress
 */

function coachpress_customize_register_layout_settings( $wp_customize ) {
    // Layout Settings Section
    $wp_customize->add_section( 'coachpress_layout_settings', array(
        'title'    => __( 'Layout Settings', 'coachpress' ),
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
add_action( 'customize_register', 'coachpress_customize_register_layout_settings' );
