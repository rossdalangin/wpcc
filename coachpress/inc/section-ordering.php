<?php
/**
 * CoachPress Theme Customizer Section Ordering
 *
 * @package CoachPress
 */

function coachpress_customize_register_section_ordering( $wp_customize ) {
    $wp_customize->add_section( 'coachpress_section_ordering', array(
        'title'    => __( 'Section Ordering', 'coachpress' ),
        'priority' => 10,
    ) );

    $wp_customize->add_setting( 'coachpress_section_order', array(
        'default'   => 'hero,services,testimonials,case-studies,processes,faqs,contact',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new CoachPress_Section_Order_Control( $wp_customize, 'coachpress_section_order', array(
        'label'    => __( 'Drag and drop to reorder sections', 'coachpress' ),
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
            'label'    => sprintf( __( 'Enable %s Section', 'coachpress' ), $section_name ),
            'section'  => 'coachpress_section_ordering',
            'settings' => "coachpress_section_visibility[$section_id]",
            'type'     => 'checkbox',
        ) );
    }
}
add_action( 'customize_register', 'coachpress_customize_register_section_ordering' );
