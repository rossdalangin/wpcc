<?php
/**
 * CoachPress Theme Customizer Section Ordering
 *
 * @package CoachPress
 */

function coachpress_customize_register_section_ordering( $wp_customize ) {
    $wp_customize->add_section( 'coachpress_section_ordering', array(
        'title'    => __( 'Section Ordering & Visibility', 'coachpress' ),
        'priority' => 10,
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
add_action( 'customize_register', 'coachpress_customize_register_section_ordering' );
