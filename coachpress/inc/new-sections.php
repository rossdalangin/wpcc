<?php
/**
 * CoachPress Theme Customizer New Sections
 *
 * @package CoachPress
 */

function coachpress_customize_register_new_sections( $wp_customize ) {
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
add_action( 'customize_register', 'coachpress_customize_register_new_sections' );
