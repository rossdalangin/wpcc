<?php
/**
 * CoachPress Theme Customizer Section Titles
 *
 * @package CoachPress
 */

function coachpress_customize_register_section_titles( $wp_customize ) {
    $wp_customize->add_section( 'coachpress_section_titles', array(
        'title'    => __( 'Section Titles', 'coachpress' ),
        'priority' => 35,
    ) );

    $sections = array(
        'services' => __( 'Services', 'coachpress' ),
        'testimonials' => __( 'Testimonials', 'coachpress' ),
        'case-studies' => __( 'Case Studies', 'coachpress' ),
        'processes' => __( 'Processes', 'coachpress' ),
        'faqs' => __( 'FAQs', 'coachpress' ),
        'contact' => __( 'Contact', 'coachpress' ),
    );

    foreach ( $sections as $section_id => $section_name ) {
        $wp_customize->add_setting( "coachpress_{$section_id}_section_title", array(
            'default'   => $section_name,
            'transport' => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        ) );

        $wp_customize->add_control( "coachpress_{$section_id}_section_title", array(
            'label'    => sprintf( __( '%s Section Title', 'coachpress' ), $section_name ),
            'section'  => 'coachpress_section_titles',
            'settings' => "coachpress_{$section_id}_section_title",
            'type'     => 'text',
        ) );
    }
}
add_action( 'customize_register', 'coachpress_customize_register_section_titles' );
