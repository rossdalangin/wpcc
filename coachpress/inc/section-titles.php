<?php
/**
 * CoachPress Theme Customizer Section Titles
 *
 * @package CoachPress
 */

function coachpress_customize_register_section_titles( $wp_customize ) {
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
add_action( 'customize_register', 'coachpress_customize_register_section_titles' );
