<?php
/**
 * Customizer Homepage Sections Controls
 *
 * @package CoachPress
 */

function coachpress_customize_homepage_sections( $wp_customize ) {
    //======================================================================
    // Controls: Homepage Sections
    //======================================================================

    // -- Section Ordering & Visibility --
    $sections = coachpress_get_section_choices();
    $wp_customize->add_setting( 'coachpress_section_order', array( 'default' => implode(',', array_keys($sections)), 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( new CoachPress_Section_Order_Control( $wp_customize, 'coachpress_section_order', array( 'label' => __( 'Homepage Section Order', 'coachpress' ), 'section' => 'coachpress_section_ordering', 'choices' => $sections ) ) );
    foreach ($sections as $section_id => $section_name) {
        $wp_customize->add_setting( "coachpress_section_visibility[{$section_id}]", array( 'default' => true, 'transport' => 'refresh', 'sanitize_callback' => 'wp_validate_boolean' ) );
        $wp_customize->add_control( "coachpress_section_visibility[{$section_id}]", array( 'label' => sprintf( __( 'Show %s Section', 'coachpress' ), $section_name ), 'section' => 'coachpress_section_ordering', 'type' => 'checkbox' ) );
    }

    // -- Content Controls moved into sections --
    $sections_with_content = array(
        'services' => ['title' => 'Our Services', 'description' => 'We offer a range of services to help you achieve your goals.'],
        'testimonials' => ['title' => 'What Our Clients Say', 'description' => 'Hear from our satisfied clients.'],
        'case-studies' => ['title' => 'Case Studies', 'description' => 'See our work in action.'],
        'processes' => ['title' => 'Our Process', 'description' => 'A clear path to success.'],
        'faqs' => ['title' => 'Frequently Asked Questions', 'description' => 'Find answers to common questions.'],
        'contact' => ['title' => 'Get in Touch', 'description' => 'We\'d love to hear from you.'],
        'problem' => ['title' => 'The Problem', 'description' => ''],
        'about-preview' => ['title' => 'About Us', 'description' => ''],
        'trust' => ['title' => 'As Seen On', 'description' => 'We have been featured in...'],
        'cta' => ['title' => 'Ready to Get Started?', 'description' => 'Take the first step towards a better you.']
    );
    foreach ( $sections_with_content as $section_id => $content ) {
        $section_handle = "coachpress_{$section_id}_section";
        $wp_customize->add_setting( "coachpress_{$section_id}_section_title", array( 'default' => $content['title'], 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( "coachpress_{$section_id}_section_title", array( 'label' => __( 'Section Title', 'coachpress' ), 'section' => $section_handle, 'type' => 'text', 'priority' => 1 ) );
        if (!empty($content['description'])) {
            $wp_customize->add_setting( "coachpress_{$section_id}_section_description", array( 'default' => $content['description'], 'transport' => 'refresh', 'sanitize_callback' => 'wp_kses_post' ) );
            $wp_customize->add_control( "coachpress_{$section_id}_section_description", array( 'label' => __( 'Section Description', 'coachpress' ), 'section' => $section_handle, 'type' => 'textarea', 'priority' => 2 ) );
        }
    }

    $wp_customize->add_setting( 'coachpress_cta_alignment', array( 'default' => 'center', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_key' ) );
    $wp_customize->add_control( 'coachpress_cta_alignment', array( 'label' => __( 'Alignment', 'coachpress' ), 'section' => 'coachpress_cta_section', 'type' => 'select', 'choices' => array( 'left' => __( 'Left', 'coachpress' ), 'center' => __( 'Center', 'coachpress' ), 'right' => __( 'Right', 'coachpress' ) ), 'priority' => 3 ) );

    // CTA Button
    $wp_customize->add_setting( 'coachpress_cta_button_text', array( 'default' => 'Get Started', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'coachpress_cta_button_text', array( 'label' => __( 'Button Text', 'coachpress' ), 'section' => 'coachpress_cta_section', 'type' => 'text', 'priority' => 4 ) );
    $wp_customize->add_setting( 'coachpress_cta_button_url', array( 'default' => '#', 'transport' => 'refresh', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'coachpress_cta_button_url', array( 'label' => __( 'Button URL', 'coachpress' ), 'section' => 'coachpress_cta_section', 'type' => 'url', 'priority' => 5 ) );

    // CTA Button Styles
    $wp_customize->add_setting( 'coachpress_cta_button_bg_color', array( 'default' => '#FFFFFF', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_cta_button_bg_color', array( 'label' => __( 'Button Background Color', 'coachpress' ), 'section' => 'coachpress_cta_section' ) ) );
    $wp_customize->add_setting( 'coachpress_cta_button_text_color', array( 'default' => '#0D2F4F', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_cta_button_text_color', array( 'label' => __( 'Button Text Color', 'coachpress' ), 'section' => 'coachpress_cta_section' ) ) );
    $wp_customize->add_setting( 'coachpress_cta_button_hover_bg_color', array( 'default' => '#FFC107', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_cta_button_hover_bg_color', array( 'label' => __( 'Button Hover Background Color', 'coachpress' ), 'section' => 'coachpress_cta_section' ) ) );
    $wp_customize->add_setting( 'coachpress_cta_button_hover_text_color', array( 'default' => '#0D2F4F', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_cta_button_hover_text_color', array( 'label' => __( 'Button Hover Text Color', 'coachpress' ), 'section' => 'coachpress_cta_section' ) ) );
    $wp_customize->add_setting( 'coachpress_cta_button_border_radius', array( 'default' => '4px', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'coachpress_cta_button_border_radius', array( 'label' => __( 'Button Border Radius', 'coachpress' ), 'section' => 'coachpress_cta_section', 'type' => 'text' ) );

    // -- Services Section --
    $services = get_posts( array( 'post_type' => 'services', 'numberposts' => -1 ) );
    $service_choices = array();
    foreach ( $services as $service ) {
        $service_choices[ $service->ID ] = $service->post_title;
    }
    $wp_customize->add_setting( 'coachpress_services_posts', array( 'default' => '', 'transport' => 'refresh', 'sanitize_callback' => 'coachpress_sanitize_multi_select' ) );
    $wp_customize->add_control( new CoachPress_Multi_Select_Control( $wp_customize, 'coachpress_services_posts', array( 'label' => __( 'Select Services', 'coachpress' ), 'section' => 'coachpress_services_section', 'choices' => $service_choices, 'priority' => 3 ) ) );

    // -- Testimonials Section --
    $testimonials = get_posts( array( 'post_type' => 'testimonials', 'numberposts' => -1 ) );
    $testimonial_choices = array();
    foreach ( $testimonials as $testimonial ) {
        $testimonial_choices[ $testimonial->ID ] = $testimonial->post_title;
    }
    $wp_customize->add_setting( 'coachpress_testimonials_posts', array( 'default' => '', 'transport' => 'refresh', 'sanitize_callback' => 'coachpress_sanitize_multi_select' ) );
    $wp_customize->add_control( new CoachPress_Multi_Select_Control( $wp_customize, 'coachpress_testimonials_posts', array( 'label' => __( 'Select Testimonials', 'coachpress' ), 'section' => 'coachpress_testimonials_section', 'choices' => $testimonial_choices, 'priority' => 3 ) ) );

    // -- Case Studies Section --
    $case_studies = get_posts( array( 'post_type' => 'case-studies', 'numberposts' => -1 ) );
    $case_study_choices = array();
    foreach ( $case_studies as $case_study ) {
        $case_study_choices[ $case_study->ID ] = $case_study->post_title;
    }
    $wp_customize->add_setting( 'coachpress_case_studies_posts', array( 'default' => '', 'transport' => 'refresh', 'sanitize_callback' => 'coachpress_sanitize_multi_select' ) );
    $wp_customize->add_control( new CoachPress_Multi_Select_Control( $wp_customize, 'coachpress_case_studies_posts', array( 'label' => __( 'Select Case Studies', 'coachpress' ), 'section' => 'coachpress_case-studies_section', 'choices' => $case_study_choices, 'priority' => 3 ) ) );

    // -- Hero Section --
    $wp_customize->add_setting( 'coachpress_hero_bg_color', array( 'default' => '#F5F5F5', 'transport' => 'refresh', 'sanitize_callback' => 'coachpress_sanitize_background' ) );
    $wp_customize->add_control( new CoachPress_Gradient_Control( $wp_customize, 'coachpress_hero_bg_color', array( 'label' => __( 'Background', 'coachpress' ), 'section' => 'coachpress_hero_section' ) ) );
    $wp_customize->add_setting( 'coachpress_hero_heading_color', array( 'default' => '#0D2F4F', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_hero_heading_color', array( 'label' => __( 'Heading Color', 'coachpress' ), 'section' => 'coachpress_hero_section' ) ) );
    $wp_customize->add_setting( 'coachpress_hero_text_color', array( 'default' => '#333333', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_hero_text_color', array( 'label' => __( 'Text Color', 'coachpress' ), 'section' => 'coachpress_hero_section' ) ) );
    $wp_customize->add_setting( 'coachpress_hero_heading', array( 'default' => 'Unlock Your Potential', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'coachpress_hero_heading', array( 'label' => __( 'Heading', 'coachpress' ), 'section' => 'coachpress_hero_section', 'type' => 'text' ) );
    $wp_customize->add_setting( 'coachpress_hero_subheading', array( 'default' => 'Partner with a dedicated coach to achieve your personal and professional goals.', 'transport' => 'refresh', 'sanitize_callback' => 'wp_kses_post' ) );
    $wp_customize->add_control( 'coachpress_hero_subheading', array( 'label' => __( 'Subheading', 'coachpress' ), 'section' => 'coachpress_hero_section', 'type' => 'textarea' ) );
    $wp_customize->add_setting( 'coachpress_hero_cta_text', array( 'default' => 'Book a Free Call', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'coachpress_hero_cta_text', array( 'label' => __( 'CTA Text', 'coachpress' ), 'section' => 'coachpress_hero_section', 'type' => 'text' ) );

    $wp_customize->add_setting( 'coachpress_hero_left_button_2_text', array( 'default' => 'Learn More', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'coachpress_hero_left_button_2_text', array( 'label' => __( 'Second Button Text', 'coachpress' ), 'section' => 'coachpress_hero_section', 'type' => 'text' ) );
    $wp_customize->add_setting( 'coachpress_hero_left_button_2_url', array( 'default' => '#', 'transport' => 'refresh', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'coachpress_hero_left_button_2_url', array( 'label' => __( 'Second Button URL', 'coachpress' ), 'section' => 'coachpress_hero_section', 'type' => 'url' ) );

    $wp_customize->add_setting( 'coachpress_hero_cta_url', array( 'default' => '#contact', 'transport' => 'refresh', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'coachpress_hero_cta_url', array( 'label' => __( 'CTA URL', 'coachpress' ), 'section' => 'coachpress_hero_section', 'type' => 'url' ) );

    // Hero Button Styles
    $wp_customize->add_setting( 'coachpress_hero_button_bg_color', array( 'default' => '#0D2F4F', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_hero_button_bg_color', array( 'label' => __( 'Button Background Color', 'coachpress' ), 'section' => 'coachpress_hero_section' ) ) );
    $wp_customize->add_setting( 'coachpress_hero_button_text_color', array( 'default' => '#FFFFFF', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_hero_button_text_color', array( 'label' => __( 'Button Text Color', 'coachpress' ), 'section' => 'coachpress_hero_section' ) ) );
    $wp_customize->add_setting( 'coachpress_hero_button_hover_bg_color', array( 'default' => '#FFC107', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_hero_button_hover_bg_color', array( 'label' => __( 'Button Hover Background Color', 'coachpress' ), 'section' => 'coachpress_hero_section' ) ) );
    $wp_customize->add_setting( 'coachpress_hero_button_hover_text_color', array( 'default' => '#0D2F4F', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_hero_button_hover_text_color', array( 'label' => __( 'Button Hover Text Color', 'coachpress' ), 'section' => 'coachpress_hero_section' ) ) );
    $wp_customize->add_setting( 'coachpress_hero_button_border_radius', array( 'default' => '4px', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'coachpress_hero_button_border_radius', array( 'label' => __( 'Button Border Radius', 'coachpress' ), 'section' => 'coachpress_hero_section', 'type' => 'text' ) );

    $wp_customize->add_setting( 'coachpress_hero_cta_2_visibility', array( 'default' => false, 'transport' => 'refresh', 'sanitize_callback' => 'wp_validate_boolean' ) );
    $wp_customize->add_control( 'coachpress_hero_cta_2_visibility', array( 'label' => __( 'Show Second CTA Button', 'coachpress' ), 'section' => 'coachpress_hero_section', 'type' => 'checkbox' ) );
    $wp_customize->add_setting( 'coachpress_hero_cta_2_text', array( 'default' => 'Learn More', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'coachpress_hero_cta_2_text', array( 'label' => __( 'Second CTA Text', 'coachpress' ), 'section' => 'coachpress_hero_section', 'type' => 'text', 'active_callback' => function( $control ) { return $control->manager->get_setting('coachpress_hero_cta_2_visibility')->value(); } ) );
    $wp_customize->add_setting( 'coachpress_hero_cta_2_url', array( 'default' => '#', 'transport' => 'refresh', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'coachpress_hero_cta_2_url', array( 'label' => __( 'Second CTA URL', 'coachpress' ), 'section' => 'coachpress_hero_section', 'type' => 'url', 'active_callback' => function( $control ) { return $control->manager->get_setting('coachpress_hero_cta_2_visibility')->value(); } ) );

    $wp_customize->add_setting( 'coachpress_hero_left_col_align', array( 'default' => 'left', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_key' ) );
    $wp_customize->add_control( 'coachpress_hero_left_col_align', array( 'label' => __( 'Left Column Alignment', 'coachpress' ), 'section' => 'coachpress_hero_section', 'type' => 'select', 'choices' => array( 'left' => __( 'Left', 'coachpress' ), 'center' => __( 'Center', 'coachpress' ), 'right' => __( 'Right', 'coachpress' ) ) ) );
    $wp_customize->add_setting( 'coachpress_hero_right_col_type', array( 'default' => 'image', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_key' ) );
    $wp_customize->add_control( 'coachpress_hero_right_col_type', array( 'label' => __( 'Right Column Content', 'coachpress' ), 'section' => 'coachpress_hero_section', 'type' => 'select', 'choices' => array( 'none' => __( 'Disabled', 'coachpress' ), 'image' => __( 'Image', 'coachpress' ), 'video' => __( 'Video', 'coachpress' ), 'html' => __( 'HTML', 'coachpress' ), 'shortcode' => __( 'Shortcode', 'coachpress' ) ) ) );
    $wp_customize->add_setting( 'coachpress_hero_right_col_image', array( 'default' => '', 'transport' => 'refresh', 'sanitize_callback' => 'absint' ) );
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'coachpress_hero_right_col_image', array( 'label' => __( 'Image', 'coachpress' ), 'section' => 'coachpress_hero_section', 'mime_type' => 'image', 'active_callback' => function( $control ) { return 'image' === $control->manager->get_setting('coachpress_hero_right_col_type')->value(); } ) ) );
    $wp_customize->add_setting( 'coachpress_hero_right_col_video', array( 'default' => '', 'transport' => 'refresh', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'coachpress_hero_right_col_video', array( 'label' => __( 'Video URL (YouTube/Vimeo)', 'coachpress' ), 'section' => 'coachpress_hero_section', 'type' => 'url', 'active_callback' => function( $control ) { return 'video' === $control->manager->get_setting('coachpress_hero_right_col_type')->value(); } ) );
    $wp_customize->add_setting( 'coachpress_hero_right_col_html', array( 'default' => '', 'transport' => 'refresh', 'sanitize_callback' => 'wp_kses_post' ) );
    $wp_customize->add_control( 'coachpress_hero_right_col_html', array( 'label' => __( 'HTML Content', 'coachpress' ), 'section' => 'coachpress_hero_section', 'type' => 'textarea', 'active_callback' => function( $control ) { return 'html' === $control->manager->get_setting('coachpress_hero_right_col_type')->value(); } ) );
    $wp_customize->add_setting( 'coachpress_hero_right_col_shortcode', array( 'default' => '', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'coachpress_hero_right_col_shortcode', array( 'label' => __( 'Shortcode', 'coachpress' ), 'section' => 'coachpress_hero_section', 'type' => 'text', 'active_callback' => function( $control ) { return 'shortcode' === $control->manager->get_setting('coachpress_hero_right_col_type')->value(); } ) );

    // -- Trust Section Specific --
    $wp_customize->add_setting( 'coachpress_trust_image', array( 'default' => '', 'sanitize_callback' => 'absint' ) );
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'coachpress_trust_image', array( 'label' => __( 'Image', 'coachpress' ), 'section' => 'coachpress_trust_section', 'mime_type' => 'image', 'priority' => 3 ) ) );

    // -- Problem Section Specific --
    $wp_customize->add_setting( 'coachpress_problem_heading', array( 'default' => 'Are You Facing These Challenges?', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'coachpress_problem_heading', array( 'label' => __( 'Heading', 'coachpress' ), 'section' => 'coachpress_problem_section', 'type' => 'text', 'priority' => 1 ) );
    $wp_customize->add_setting( 'coachpress_problem_content', array( 'default' => 'You\'re working hard but not seeing the results you want. You feel stuck, overwhelmed, and unsure of the next steps to grow your business and achieve your goals.', 'transport' => 'refresh', 'sanitize_callback' => 'wp_kses_post' ) );
    $wp_customize->add_control( 'coachpress_problem_content', array( 'label' => __( 'Content', 'coachpress' ), 'section' => 'coachpress_problem_section', 'type' => 'textarea', 'priority' => 2 ) );
    $wp_customize->add_setting( 'coachpress_problem_image', array( 'default' => '', 'sanitize_callback' => 'absint' ) );
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'coachpress_problem_image', array( 'label' => __( 'Image', 'coachpress' ), 'section' => 'coachpress_problem_section', 'mime_type' => 'image', 'priority' => 3 ) ) );

    // -- About Preview Section Specific --
    $wp_customize->add_setting( 'coachpress_about-preview_heading', array( 'default' => 'Your Coach & Partner', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'coachpress_about-preview_heading', array( 'label' => __( 'Heading', 'coachpress' ), 'section' => 'coachpress_about-preview_section', 'type' => 'text', 'priority' => 1 ) );
    $wp_customize->add_setting( 'coachpress_about-preview_content', array( 'default' => 'With over a decade of experience in the industry, I am dedicated to helping professionals like you navigate challenges, unlock opportunities, and achieve sustainable growth. My mission is to empower you with the strategies and mindset needed to thrive.', 'transport' => 'refresh', 'sanitize_callback' => 'wp_kses_post' ) );
    $wp_customize->add_control( 'coachpress_about-preview_content', array( 'label' => __( 'Content', 'coachpress' ), 'section' => 'coachpress_about-preview_section', 'type' => 'textarea', 'priority' => 2 ) );
    $wp_customize->add_setting( 'coachpress_about-preview_image', array( 'default' => '', 'sanitize_callback' => 'absint' ) );
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'coachpress_about-preview_image', array( 'label' => __( 'Image', 'coachpress' ), 'section' => 'coachpress_about-preview_section', 'mime_type' => 'image', 'priority' => 3 ) ) );
    $wp_customize->add_setting( 'coachpress_about-preview_button_text', array( 'default' => 'Learn More About Me', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'coachpress_about-preview_button_text', array( 'label' => __( 'Button Text', 'coachpress' ), 'section' => 'coachpress_about-preview_section', 'type' => 'text', 'priority' => 4 ) );
    $wp_customize->add_setting( 'coachpress_about-preview_button_url', array( 'default' => '#', 'transport' => 'refresh', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'coachpress_about-preview_button_url', array( 'label' => __( 'Button URL', 'coachpress' ), 'section' => 'coachpress_about-preview_section', 'type' => 'url', 'priority' => 5 ) );

    // About Button Styles
    $wp_customize->add_setting( 'coachpress_about-preview_button_bg_color', array( 'default' => '#0D2F4F', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_about-preview_button_bg_color', array( 'label' => __( 'Button Background Color', 'coachpress' ), 'section' => 'coachpress_about-preview_section' ) ) );
    $wp_customize->add_setting( 'coachpress_about-preview_button_text_color', array( 'default' => '#FFFFFF', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_about-preview_button_text_color', array( 'label' => __( 'Button Text Color', 'coachpress' ), 'section' => 'coachpress_about-preview_section' ) ) );
    $wp_customize->add_setting( 'coachpress_about-preview_button_hover_bg_color', array( 'default' => '#FFC107', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_about-preview_button_hover_bg_color', array( 'label' => __( 'Button Hover Background Color', 'coachpress' ), 'section' => 'coachpress_about-preview_section' ) ) );
    $wp_customize->add_setting( 'coachpress_about-preview_button_hover_text_color', array( 'default' => '#0D2F4F', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_about-preview_button_hover_text_color', array( 'label' => __( 'Button Hover Text Color', 'coachpress' ), 'section' => 'coachpress_about-preview_section' ) ) );
    $wp_customize->add_setting( 'coachpress_about-preview_button_border_radius', array( 'default' => '4px', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'coachpress_about-preview_button_border_radius', array( 'label' => __( 'Button Border Radius', 'coachpress' ), 'section' => 'coachpress_about-preview_section', 'type' => 'text' ) );

    // -- Per-Section Layout & Background --
    foreach ( $sections as $section_id => $section_name ) {
        $section_handle = "coachpress_{$section_id}_section";

        // Text Alignment
        $wp_customize->add_setting( "coachpress_{$section_id}_text_alignment", array( 'default' => ('cta' === $section_id || 'testimonials' === $section_id ? 'center' : 'left'), 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_key' ) );
        $wp_customize->add_control( "coachpress_{$section_id}_text_alignment", array( 'label' => __( 'Text Alignment', 'coachpress' ), 'section' => $section_handle, 'type' => 'select', 'choices' => array( 'left' => __( 'Left', 'coachpress' ), 'center' => __( 'Center', 'coachpress' ), 'right' => __( 'Right', 'coachpress' ) ), 'priority' => 50 ) );

        // Padding
        $default_padding = ('hero' === $section_id) ? array('top' => '100px', 'right' => '0', 'bottom' => '100px', 'left' => '0') : array('top' => '60px', 'right' => '0', 'bottom' => '60px', 'left' => '0');
        $wp_customize->add_setting( "coachpress_{$section_id}_padding", array( 'default' => json_encode($default_padding), 'transport' => 'refresh', 'sanitize_callback' => 'coachpress_sanitize_dimensions' ) );
        $wp_customize->add_control( new CoachPress_Dimensions_Control( $wp_customize, "coachpress_{$section_id}_padding", array( 'label' => __( 'Section Padding', 'coachpress' ), 'section' => $section_handle, 'priority' => 51  ) ) );

            // Background Type
            $wp_customize->add_setting( "coachpress_{$section_id}_bg_type", array( 'default' => 'color', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_key' ) );
            $wp_customize->add_control( "coachpress_{$section_id}_bg_type", array( 'label' => __( 'Background Type', 'coachpress' ), 'section' => $section_handle, 'type' => 'select', 'choices' => array( 'color' => __( 'Color', 'coachpress' ), 'image' => __( 'Image', 'coachpress' ), 'video' => __( 'Video', 'coachpress' ) ), 'priority' => 60 ) );

            // BG Color
            $default_bg_color = '';
            if ($section_id === 'hero') { $default_bg_color = '#F5F5F5'; }
            if (in_array($section_id, ['services', 'case-studies', 'contact'])) { $default_bg_color = '#F5F5F5'; }
            if ($section_id === 'cta') { $default_bg_color = '#0D2F4F'; }
            $wp_customize->add_setting( "coachpress_{$section_id}_bg_color", array( 'default' => $default_bg_color, 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, "coachpress_{$section_id}_bg_color", array( 'label' => __( 'Background Color', 'coachpress' ), 'section' => $section_handle, 'active_callback' => function() use ($wp_customize, $section_id) { return 'color' === $wp_customize->get_setting("coachpress_{$section_id}_bg_type")->value(); }, 'priority' => 61 ) ) );

            // BG Image
            $wp_customize->add_setting( "coachpress_{$section_id}_bg_image", array( 'default' => '', 'transport' => 'refresh', 'sanitize_callback' => 'absint' ) );
            $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, "coachpress_{$section_id}_bg_image", array( 'label' => __( 'Background Image', 'coachpress' ), 'section' => $section_handle, 'mime_type' => 'image', 'active_callback' => function() use ($wp_customize, $section_id) { return 'image' === $wp_customize->get_setting("coachpress_{$section_id}_bg_type")->value(); }, 'priority' => 62 ) ) );

            // BG Video
            $wp_customize->add_setting( "coachpress_{$section_id}_bg_video", array( 'default' => '', 'transport' => 'refresh', 'sanitize_callback' => 'esc_url_raw' ) );
            $wp_customize->add_control( "coachpress_{$section_id}_bg_video", array( 'label' => __( 'Background Video URL', 'coachpress' ), 'section' => $section_handle, 'type' => 'url', 'active_callback' => function() use ($wp_customize, $section_id) { return 'video' === $wp_customize->get_setting("coachpress_{$section_id}_bg_type")->value(); }, 'priority' => 63 ) );

            // BG Overlay
            $wp_customize->add_setting( "coachpress_{$section_id}_bg_overlay_color", array( 'default' => 'rgba(0,0,0,0.5)', 'transport' => 'refresh', 'sanitize_callback' => 'coachpress_sanitize_rgba_color' ) );
            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, "coachpress_{$section_id}_bg_overlay_color", array( 'label' => __( 'Image/Video Overlay Color', 'coachpress' ), 'description' => __('Set an overlay to make text more readable over images/videos.', 'coachpress'), 'section' => $section_handle, 'active_callback' => function($control) use ($section_id) { return in_array($control->manager->get_setting("coachpress_{$section_id}_bg_type")->value(), ['image', 'video']); }, 'priority' => 64 ) ) );

            // Heading Color
            $default_heading_color = '';
            if ($section_id === 'hero') { $default_heading_color = '#0D2F4F'; }
            if ($section_id === 'cta') { $default_heading_color = '#FFFFFF'; }
            $wp_customize->add_setting( "coachpress_{$section_id}_heading_color", array( 'default' => $default_heading_color, 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, "coachpress_{$section_id}_heading_color", array( 'label' => __( 'Heading Color', 'coachpress' ), 'section' => $section_handle, 'priority' => 70 ) ) );

            // Text Color
            $default_text_color = '';
            if ($section_id === 'hero') { $default_text_color = '#333333'; }
            if ($section_id === 'cta') { $default_text_color = '#FFFFFF'; }
            $wp_customize->add_setting( "coachpress_{$section_id}_text_color", array( 'default' => $default_text_color, 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, "coachpress_{$section_id}_text_color", array( 'label' => __( 'Text Color', 'coachpress' ), 'section' => $section_handle, 'priority' => 71 ) ) );
    }
}
