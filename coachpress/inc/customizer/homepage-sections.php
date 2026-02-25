<?php
/**
 * Customizer Homepage Sections Controls
 *
 * @package CoachPress
 */

function coachpress_customize_homepage_sections( $wp_customize ) {
    // -- Section Ordering & Visibility --
    $sections = coachpress_get_section_choices();
    $wp_customize->add_setting( 'coachpress_section_order', array(
        'default'           => implode(',', array_keys($sections)),
        'transport'         => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ) );
    $wp_customize->add_control( new CoachPress_Section_Order_Control( $wp_customize, 'coachpress_section_order', array(
        'label'       => __( 'Homepage Section Order', 'coachpress' ),
        'description' => __('Drag and drop sections to reorder them on the homepage.', 'coachpress'),
        'section'     => 'coachpress_section_ordering',
        'choices'     => $sections
    ) ) );

    foreach ($sections as $section_id => $section_name) {
        $wp_customize->add_setting( "coachpress_section_visibility[{$section_id}]", array(
            'default'           => true,
            'transport'         => 'refresh',
            'sanitize_callback' => 'wp_validate_boolean'
        ) );
        $wp_customize->add_control( "coachpress_section_visibility[{$section_id}]", array(
            'label'   => sprintf( __( 'Show %s Section', 'coachpress' ), $section_name ),
            'section' => 'coachpress_section_ordering',
            'type'    => 'checkbox'
        ) );
    }

    // -- Content Controls --
    $sections_with_content = array(
        'services'      => ['title' => 'Core Services', 'description' => 'Scalable solutions designed for modern leaders and consultants.'],
        'testimonials'  => ['title' => 'Client Success', 'description' => 'Real impact, real results. Hear from those who have walked the path.'],
        'case-studies'  => ['title' => 'Success Stories', 'description' => 'Deep dives into strategic transformations and measurable outcomes.'],
        'processes'     => ['title' => 'The Framework', 'description' => 'A rigorous, result-oriented approach to solving your most complex challenges.'],
        'faqs'          => ['title' => 'Common Questions', 'description' => 'Insights into how we work and what you can expect.'],
        'contact'       => ['title' => 'Let’s Connect', 'description' => 'Ready to elevate your impact? Start the conversation today.'],
        'problem'       => ['title' => 'Struggling to Scale?', 'description' => ''],
        'about-preview' => ['title' => 'Strategic Guidance', 'description' => ''],
        'trust'         => ['title' => 'Trusted By Visionaries', 'description' => ''],
        'cta'           => ['title' => 'Ready for the Next Level?', 'description' => 'Join an exclusive group of high-performers today.'],
        'portfolio'     => ['title' => 'Strategic Portfolio', 'description' => 'A curated selection of high-impact projects.'],
        'team'          => ['title' => 'The Collective', 'description' => 'Expert minds coming together for your success.'],
    );

    foreach ( $sections_with_content as $section_id => $content ) {
        $section_handle = "coachpress_{$section_id}_section";
        $wp_customize->add_setting( "coachpress_{$section_id}_section_title", array(
            'default'           => $content['title'],
            'transport'         => 'refresh',
            'sanitize_callback' => 'sanitize_text_field'
        ) );
        $wp_customize->add_control( "coachpress_{$section_id}_section_title", array(
            'label'    => __( 'Section Title', 'coachpress' ),
            'section'  => $section_handle,
            'type'     => 'text',
            'priority' => 1
        ) );
        if ($section_id !== 'problem' && $section_id !== 'about-preview' && $section_id !== 'trust') {
            $wp_customize->add_setting( "coachpress_{$section_id}_section_description", array(
                'default'           => $content['description'],
                'transport'         => 'refresh',
                'sanitize_callback' => 'wp_kses_post'
            ) );
            $wp_customize->add_control( "coachpress_{$section_id}_section_description", array(
                'label'    => __( 'Section Description', 'coachpress' ),
                'section'  => $section_handle,
                'type'     => 'textarea',
                'priority' => 2
            ) );
        }
    }

    // -- Hero Section Specific --
    $wp_customize->add_setting( 'coachpress_hero_heading', array( 'default' => 'Accelerate Your Impact. Scale Your Vision.', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'coachpress_hero_heading', array( 'label' => __( 'Hero Heading', 'coachpress' ), 'section' => 'coachpress_hero_section', 'type' => 'text', 'priority' => 10 ) );
    $wp_customize->add_setting( 'coachpress_hero_subheading', array( 'default' => 'Elite coaching for consultants and executives who refuse to settle for the status quo.', 'transport' => 'refresh', 'sanitize_callback' => 'wp_kses_post' ) );
    $wp_customize->add_control( 'coachpress_hero_subheading', array( 'label' => __( 'Hero Subheading', 'coachpress' ), 'section' => 'coachpress_hero_section', 'type' => 'textarea', 'priority' => 11 ) );
    $wp_customize->add_setting( 'coachpress_hero_cta_text', array( 'default' => 'Schedule Discovery Call', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'coachpress_hero_cta_text', array( 'label' => __( 'CTA Button Text', 'coachpress' ), 'section' => 'coachpress_hero_section', 'type' => 'text', 'priority' => 12 ) );
    $wp_customize->add_setting( 'coachpress_hero_cta_url', array( 'default' => '#contact', 'transport' => 'refresh', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'coachpress_hero_cta_url', array( 'label' => __( 'CTA Button URL', 'coachpress' ), 'section' => 'coachpress_hero_section', 'type' => 'url', 'priority' => 13 ) );

    // Hero Button Colors
    $wp_customize->add_setting( 'coachpress_hero_button_bg_color', array( 'default' => '#c0a080', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_hero_button_bg_color', array( 'label' => __( 'Button Background Color', 'coachpress' ), 'section' => 'coachpress_hero_section', 'priority' => 14 ) ) );
    $wp_customize->add_setting( 'coachpress_hero_button_text_color', array( 'default' => '#FFFFFF', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_hero_button_text_color', array( 'label' => __( 'Button Text Color', 'coachpress' ), 'section' => 'coachpress_hero_section', 'priority' => 15 ) ) );

    $wp_customize->add_setting( 'coachpress_hero_right_col_type', array( 'default' => 'image', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_key' ) );
    $wp_customize->add_control( 'coachpress_hero_right_col_type', array( 'label' => __( 'Hero Right Content Type', 'coachpress' ), 'section' => 'coachpress_hero_section', 'type' => 'select', 'choices' => array( 'none' => __( 'Disabled', 'coachpress' ), 'image' => __( 'Image', 'coachpress' ), 'video' => __( 'Video', 'coachpress' ), 'html' => __( 'HTML', 'coachpress' ), 'shortcode' => __( 'Shortcode', 'coachpress' ) ), 'priority' => 20 ) );
    $wp_customize->add_setting( 'coachpress_hero_right_col_image', array( 'default' => '', 'transport' => 'refresh', 'sanitize_callback' => 'absint' ) );
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'coachpress_hero_right_col_image', array( 'label' => __( 'Hero Image', 'coachpress' ), 'section' => 'coachpress_hero_section', 'mime_type' => 'image', 'active_callback' => function( $control ) { return 'image' === $control->manager->get_setting('coachpress_hero_right_col_type')->value(); }, 'priority' => 21 ) ) );

    // -- CTA Section Specific --
    $wp_customize->add_setting( 'coachpress_cta_button_text', array( 'default' => 'Apply For Consultation', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'coachpress_cta_button_text', array( 'label' => __( 'CTA Button Text', 'coachpress' ), 'section' => 'coachpress_cta_section', 'type' => 'text', 'priority' => 10 ) );
    $wp_customize->add_setting( 'coachpress_cta_button_url', array( 'default' => '#contact', 'transport' => 'refresh', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'coachpress_cta_button_url', array( 'label' => __( 'CTA Button URL', 'coachpress' ), 'section' => 'coachpress_cta_section', 'type' => 'url', 'priority' => 11 ) );

    // CTA Button Colors
    $wp_customize->add_setting( 'coachpress_cta_button_bg_color', array( 'default' => '#c0a080', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_cta_button_bg_color', array( 'label' => __( 'Button Background Color', 'coachpress' ), 'section' => 'coachpress_cta_section', 'priority' => 12 ) ) );
    $wp_customize->add_setting( 'coachpress_cta_button_text_color', array( 'default' => '#FFFFFF', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_cta_button_text_color', array( 'label' => __( 'Button Text Color', 'coachpress' ), 'section' => 'coachpress_cta_section', 'priority' => 13 ) ) );

    // -- Trust Section Specific --
    $wp_customize->add_setting( 'coachpress_trust_image', array( 'default' => '', 'sanitize_callback' => 'absint' ) );
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'coachpress_trust_image', array(
        'label'    => __( 'Trust Logos Image', 'coachpress' ),
        'section'  => 'coachpress_trust_section',
        'mime_type'=> 'image',
        'priority' => 5
    ) ) );

    // -- Problem Section Specific --
    $wp_customize->add_setting( 'coachpress_problem_content', array( 'default' => 'You’ve reached the limit of what hard work alone can achieve. Your current systems are straining, and your time is being consumed by operations rather than strategy. It’s time for a new approach.', 'transport' => 'refresh', 'sanitize_callback' => 'wp_kses_post' ) );
    $wp_customize->add_control( 'coachpress_problem_content', array( 'label' => __( 'Problem Content', 'coachpress' ), 'section' => 'coachpress_problem_section', 'type' => 'textarea', 'priority' => 5 ) );
    $wp_customize->add_setting( 'coachpress_problem_image', array( 'default' => '', 'sanitize_callback' => 'absint' ) );
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'coachpress_problem_image', array(
        'label'    => __( 'Problem Section Image', 'coachpress' ),
        'section'  => 'coachpress_problem_section',
        'mime_type'=> 'image',
        'priority' => 6
    ) ) );

    // -- About Preview Section Specific --
    $wp_customize->add_setting( 'coachpress_about-preview_content', array( 'default' => 'With decades of experience in organizational strategy and leadership development, I provide the outside perspective and proven frameworks you need to break through internal plateaus.', 'transport' => 'refresh', 'sanitize_callback' => 'wp_kses_post' ) );
    $wp_customize->add_control( 'coachpress_about-preview_content', array( 'label' => __( 'About Content', 'coachpress' ), 'section' => 'coachpress_about-preview_section', 'type' => 'textarea', 'priority' => 5 ) );
    $wp_customize->add_setting( 'coachpress_about-preview_image', array( 'default' => '', 'sanitize_callback' => 'absint' ) );
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'coachpress_about-preview_image', array(
        'label'    => __( 'About Section Image', 'coachpress' ),
        'section'  => 'coachpress_about-preview_section',
        'mime_type'=> 'image',
        'priority' => 6
    ) ) );
    $wp_customize->add_setting( 'coachpress_about-preview_button_text', array( 'default' => 'My Approach', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'coachpress_about-preview_button_text', array( 'label' => __( 'Button Text', 'coachpress' ), 'section' => 'coachpress_about-preview_section', 'type' => 'text', 'priority' => 10 ) );
    $wp_customize->add_setting( 'coachpress_about-preview_button_url', array( 'default' => '#about', 'transport' => 'refresh', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'coachpress_about-preview_button_url', array( 'label' => __( 'Button URL', 'coachpress' ), 'section' => 'coachpress_about-preview_section', 'type' => 'url', 'priority' => 11 ) );

    // About Button Colors
    $wp_customize->add_setting( 'coachpress_about-preview_button_bg_color', array( 'default' => '#1a365d', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_about-preview_button_bg_color', array( 'label' => __( 'Button Background Color', 'coachpress' ), 'section' => 'coachpress_about-preview_section', 'priority' => 12 ) ) );
    $wp_customize->add_setting( 'coachpress_about-preview_button_text_color', array( 'default' => '#FFFFFF', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_about-preview_button_text_color', array( 'label' => __( 'Button Text Color', 'coachpress' ), 'section' => 'coachpress_about-preview_section', 'priority' => 13 ) ) );

    // -- Per-Section Layout & Background --
    foreach ( $sections as $section_id => $section_name ) {
        $section_handle = "coachpress_{$section_id}_section";

        $wp_customize->add_setting( "coachpress_{$section_id}_text_alignment", array(
            'default'           => ($section_id === 'cta' || $section_id === 'testimonials' || $section_id === 'trust' ? 'center' : 'left'),
            'transport'         => 'refresh',
            'sanitize_callback' => 'sanitize_key'
        ) );
        $wp_customize->add_control( "coachpress_{$section_id}_text_alignment", array(
            'label'    => __( 'Text Alignment', 'coachpress' ),
            'section'  => $section_handle,
            'type'     => 'select',
            'choices'  => array( 'left' => __( 'Left', 'coachpress' ), 'center' => __( 'Center', 'coachpress' ), 'right' => __( 'Right', 'coachpress' ) ),
            'priority' => 50
        ) );

        $default_padding = array('top' => '100px', 'right' => '0', 'bottom' => '100px', 'left' => '0');
        if ($section_id === 'hero') { $default_padding = array('top' => '140px', 'right' => '0', 'bottom' => '140px', 'left' => '0'); }
        if ($section_id === 'trust') { $default_padding = array('top' => '60px', 'right' => '0', 'bottom' => '60px', 'left' => '0'); }

        $wp_customize->add_setting( "coachpress_{$section_id}_padding", array(
            'default'           => json_encode($default_padding),
            'transport'         => 'refresh',
            'sanitize_callback' => 'coachpress_sanitize_dimensions'
        ) );
        $wp_customize->add_control( new CoachPress_Dimensions_Control( $wp_customize, "coachpress_{$section_id}_padding", array(
            'label'    => __( 'Section Padding', 'coachpress' ),
            'section'  => $section_handle,
            'priority' => 51
        ) ) );

        $wp_customize->add_setting( "coachpress_{$section_id}_bg_type", array(
            'default'           => 'color',
            'transport'         => 'refresh',
            'sanitize_callback' => 'sanitize_key'
        ) );
        $wp_customize->add_control( "coachpress_{$section_id}_bg_type", array(
            'label'    => __( 'Background Type', 'coachpress' ),
            'section'  => $section_handle,
            'type'     => 'select',
            'choices'  => array( 'color' => __( 'Color/Gradient', 'coachpress' ), 'image' => __( 'Image', 'coachpress' ), 'video' => __( 'Video', 'coachpress' ) ),
            'priority' => 60
        ) );

        $default_bg_color = '#FFFFFF';
        if ($section_id === 'hero') { $default_bg_color = 'linear-gradient(135deg, #1a365d 0%, #2d3748 100%)'; }
        if (in_array($section_id, ['services', 'case-studies', 'contact'])) { $default_bg_color = '#f7fafc'; }
        if ($section_id === 'cta') { $default_bg_color = 'linear-gradient(135deg, #2d3748 0%, #1a365d 100%)'; }
        if ($section_id === 'trust') { $default_bg_color = '#FFFFFF'; }

        $wp_customize->add_setting( "coachpress_{$section_id}_bg_color", array(
            'default'           => $default_bg_color,
            'transport'         => 'refresh',
            'sanitize_callback' => 'coachpress_sanitize_background'
        ) );
        $wp_customize->add_control( new CoachPress_Gradient_Control( $wp_customize, "coachpress_{$section_id}_bg_color", array(
            'label'           => __( 'Background Color/Gradient', 'coachpress' ),
            'section'         => $section_handle,
            'active_callback' => function($control) use ($section_id) {
                return 'color' === $control->manager->get_setting("coachpress_{$section_id}_bg_type")->value();
            },
            'priority'        => 61
        ) ) );

        $wp_customize->add_setting( "coachpress_{$section_id}_bg_image", array( 'default' => '', 'transport' => 'refresh', 'sanitize_callback' => 'absint' ) );
        $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, "coachpress_{$section_id}_bg_image", array(
            'label'           => __( 'Background Image', 'coachpress' ),
            'section'         => $section_handle,
            'mime_type'       => 'image',
            'active_callback' => function($control) use ($section_id) {
                return 'image' === $control->manager->get_setting("coachpress_{$section_id}_bg_type")->value();
            },
            'priority'        => 62
        ) ) );

        $wp_customize->add_setting( "coachpress_{$section_id}_bg_overlay_color", array( 'default' => 'rgba(26,54,93,0.85)', 'transport' => 'refresh', 'sanitize_callback' => 'coachpress_sanitize_rgba_color' ) );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, "coachpress_{$section_id}_bg_overlay_color", array(
            'label'           => __( 'Overlay Color', 'coachpress' ),
            'section'         => $section_handle,
            'active_callback' => function($control) use ($section_id) {
                return in_array($control->manager->get_setting("coachpress_{$section_id}_bg_type")->value(), ['image', 'video']);
            },
            'priority'        => 64
        ) ) );

        $wp_customize->add_setting( "coachpress_{$section_id}_heading_color", array(
            'default'           => (in_array($section_id, ['hero', 'cta']) ? '#FFFFFF' : '#1a365d'),
            'transport'         => 'refresh',
            'sanitize_callback' => 'sanitize_hex_color'
        ) );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, "coachpress_{$section_id}_heading_color", array(
            'label'    => __( 'Heading Color Override', 'coachpress' ),
            'section'  => $section_handle,
            'priority' => 70
        ) ) );

        $wp_customize->add_setting( "coachpress_{$section_id}_text_color", array(
            'default'           => (in_array($section_id, ['hero', 'cta']) ? '#e2e8f0' : '#2d3748'),
            'transport'         => 'refresh',
            'sanitize_callback' => 'sanitize_hex_color'
        ) );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, "coachpress_{$section_id}_text_color", array(
            'label'    => __( 'Text Color Override', 'coachpress' ),
            'section'  => $section_handle,
            'priority' => 71
        ) ) );
    }
}
