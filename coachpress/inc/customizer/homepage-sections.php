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
        'label'       => __( 'Homepage Section Layout (Builder)', 'coachpress' ),
        'description' => __('This is your visual landing page builder. Drag and drop the boxes to change the order of sections on your home page. Move the "Hero" to the top for a standard layout, or experiment with different flows to see what converts best. Click the checkboxes to enable/disable sections.', 'coachpress'),
        'section'     => 'coachpress_section_ordering',
        'choices'     => $sections
    ) ) );

    // -- Content Controls --
    $sections_data = coachpress_get_sections_data();

    foreach ( $sections_data as $section_id => $data ) {
        $section_handle = "coachpress_{$section_id}_section";

        $wp_customize->add_setting( "coachpress_{$section_id}_section_title", array(
            'default'           => $data['title'],
            'transport'         => 'refresh',
            'sanitize_callback' => 'sanitize_text_field'
        ) );

        $wp_customize->add_control( "coachpress_{$section_id}_section_title", array(
            'label'    => __( 'Section Title', 'coachpress' ),
            'description' => __('The main heading for this section. Use clear, benefit-driven language.', 'coachpress'),
            'section'  => $section_handle,
            'type'     => 'text',
            'priority' => 1
        ) );

        if (!empty($data['description']) || (!in_array($section_id, ['hero', 'problem', 'about-preview', 'trust', 'cta']))) {
            $wp_customize->add_setting( "coachpress_{$section_id}_section_description", array(
                'default'           => $data['description'],
                'transport'         => 'refresh',
                'sanitize_callback' => 'wp_kses_post'
            ) );

            $wp_customize->add_control( "coachpress_{$section_id}_section_description", array(
                'label'    => __( 'Section Description', 'coachpress' ),
                'description' => __('A short paragraph explaining the purpose of this section or providing additional context to the title.', 'coachpress'),
                'section'  => $section_handle,
                'type'     => 'textarea',
                'priority' => 2
            ) );
        }
    }

    // -- Hero Section Specific --
    $wp_customize->add_setting( 'coachpress_hero_heading', array( 'default' => 'Lead With Authority. Scale With Precision.', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'coachpress_hero_heading', array(
        'label' => __( 'Hero Main Headline', 'coachpress' ),
        'description' => __('The big, bold text at the very top of your site. This should capture attention instantly (e.g., "Transform Your Leadership").', 'coachpress'),
        'section' => 'coachpress_hero_section',
        'type' => 'text',
        'priority' => 10
    ) );

    $wp_customize->add_setting( 'coachpress_hero_subheading', array( 'default' => 'Bespoke coaching and strategic consulting for high-performing professionals ready to dominate their market.', 'transport' => 'refresh', 'sanitize_callback' => 'wp_kses_post' ) );
    $wp_customize->add_control( 'coachpress_hero_subheading', array(
        'label' => __( 'Hero Description', 'coachpress' ),
        'description' => __('A few sentences elaborating on what you do and who you serve. This is your "elevator pitch".', 'coachpress'),
        'section' => 'coachpress_hero_section',
        'type' => 'textarea',
        'priority' => 11
    ) );

    $wp_customize->add_setting( 'coachpress_hero_cta_text', array( 'default' => 'Book Discovery Session', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'coachpress_hero_cta_text', array(
        'label' => __( 'Main Button Text', 'coachpress' ),
        'description' => __('The call-to-action text inside your primary button (e.g., "Apply Now").', 'coachpress'),
        'section' => 'coachpress_hero_section',
        'type' => 'text',
        'priority' => 12
    ) );

    $wp_customize->add_setting( 'coachpress_hero_cta_url', array( 'default' => '#contact', 'transport' => 'refresh', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'coachpress_hero_cta_url', array(
        'label' => __( 'Main Button Link', 'coachpress' ),
        'description' => __('Where should the button take people? Use a full URL or a section link like "#contact".', 'coachpress'),
        'section' => 'coachpress_hero_section',
        'type' => 'url',
        'priority' => 13
    ) );

    // Hero CTA 2
    $wp_customize->add_setting( 'coachpress_hero_cta_2_visibility', array( 'default' => false, 'transport' => 'refresh', 'sanitize_callback' => 'wp_validate_boolean' ) );
    $wp_customize->add_control( 'coachpress_hero_cta_2_visibility', array(
        'label' => __( 'Enable Second Button', 'coachpress' ),
        'description' => __('Add a secondary button next to the main one for less-direct actions like "Learn More".', 'coachpress'),
        'section' => 'coachpress_hero_section',
        'type' => 'checkbox',
        'priority' => 14
    ) );

    $wp_customize->add_setting( 'coachpress_hero_cta_2_text', array( 'default' => 'Learn More', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'coachpress_hero_cta_2_text', array(
        'label' => __( 'Second Button Text', 'coachpress' ),
        'section' => 'coachpress_hero_section',
        'type' => 'text',
        'priority' => 15,
        'active_callback' => function($control) {
            return $control->manager->get_setting('coachpress_hero_cta_2_visibility')->value();
        }
    ) );

    $wp_customize->add_setting( 'coachpress_hero_cta_2_url', array( 'default' => '#', 'transport' => 'refresh', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'coachpress_hero_cta_2_url', array(
        'label' => __( 'Second Button Link', 'coachpress' ),
        'section' => 'coachpress_hero_section',
        'type' => 'url',
        'priority' => 16,
        'active_callback' => function($control) {
            return $control->manager->get_setting('coachpress_hero_cta_2_visibility')->value();
        }
    ) );

    // Hero Alignment & Column 2
    $wp_customize->add_setting( 'coachpress_hero_left_col_align', array( 'default' => 'left', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_key' ) );
    $wp_customize->add_control( 'coachpress_hero_left_col_align', array(
        'label' => __( 'Text Content Alignment', 'coachpress' ),
        'description' => __('Align the text in the hero section. "Center" looks great for full-width headers.', 'coachpress'),
        'section' => 'coachpress_hero_section',
        'type' => 'select',
        'choices' => array( 'left' => __( 'Left', 'coachpress' ), 'center' => __( 'Center', 'coachpress' ), 'right' => __( 'Right', 'coachpress' ) ),
        'priority' => 17
    ) );

    $wp_customize->add_setting( 'coachpress_hero_right_col_type', array( 'default' => 'image', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_key' ) );
    $wp_customize->add_control( 'coachpress_hero_right_col_type', array(
        'label' => __( 'Hero Visual Content', 'coachpress' ),
        'description' => __('Choose what to display on the right side of your hero text. "None" will center the text.', 'coachpress'),
        'section' => 'coachpress_hero_section',
        'type' => 'select',
        'choices' => array( 'none' => __( 'None (Full Width Text)', 'coachpress' ), 'image' => __( 'Image', 'coachpress' ), 'video' => __( 'Video (URL)', 'coachpress' ), 'html' => __( 'Custom HTML', 'coachpress' ), 'shortcode' => __( 'Shortcode', 'coachpress' ) ),
        'priority' => 20
    ) );

    $wp_customize->add_setting( 'coachpress_hero_right_col_image', array( 'default' => '', 'transport' => 'refresh', 'sanitize_callback' => 'absint' ) );
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'coachpress_hero_right_col_image', array(
        'label' => __( 'Hero Image', 'coachpress' ),
        'description' => __('Upload a professional portrait or a lifestyle shot that resonates with your clients.', 'coachpress'),
        'section' => 'coachpress_hero_section',
        'mime_type' => 'image',
        'active_callback' => function( $control ) {
            return 'image' === $control->manager->get_setting('coachpress_hero_right_col_type')->value();
        },
        'priority' => 21
    ) ) );

    $wp_customize->add_setting( 'coachpress_hero_right_col_video', array( 'default' => '', 'transport' => 'refresh', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'coachpress_hero_right_col_video', array(
        'label' => __( 'Hero Video URL', 'coachpress' ),
        'description' => __('Paste a YouTube or Vimeo link to show a sales video next to your hero text.', 'coachpress'),
        'section' => 'coachpress_hero_section',
        'type' => 'url',
        'priority' => 22,
        'active_callback' => function($control) {
            return 'video' === $control->manager->get_setting('coachpress_hero_right_col_type')->value();
        }
    ) );

    // -- Post Selectors for CPT Sections --
    $cpts = array('services', 'testimonials', 'case-studies', 'processes', 'faqs', 'portfolio', 'team', 'partners');
    foreach ($cpts as $cpt) {
        $posts = get_posts( array( 'post_type' => $cpt, 'numberposts' => -1 ) );
        $choices = array();
        foreach ( $posts as $p ) {
            $choices[ $p->ID ] = $p->post_title;
        }

        $wp_customize->add_setting( "coachpress_{$cpt}_posts", array(
            'default'           => '',
            'transport'         => 'refresh',
            'sanitize_callback' => 'coachpress_sanitize_multi_select'
        ) );

        $wp_customize->add_control( new CoachPress_Multi_Select_Control( $wp_customize, "coachpress_{$cpt}_posts", array(
            'label'       => sprintf( __( 'Pick Specific %s', 'coachpress' ), ucfirst(str_replace('-', ' ', $cpt)) ),
            'description' => sprintf( __('Hold Ctrl/Cmd to select multiple items. Note: Only published %s will appear here. If the list is empty, add some items in the dashboard first.', 'coachpress'), str_replace('-', ' ', $cpt) ),
            'section'     => "coachpress_{$cpt}_section",
            'choices'     => $choices,
            'priority'    => 3
        ) ) );
    }


    $wp_customize->add_setting( 'coachpress_cta_button_text', array( 'default' => 'Apply For Consultation', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'coachpress_cta_button_text', array(
        'label' => __( 'Button Label', 'coachpress' ),
        'section' => 'coachpress_cta_section',
        'type' => 'text',
        'priority' => 10
    ) );

    $wp_customize->add_setting( 'coachpress_cta_button_url', array( 'default' => '#contact', 'transport' => 'refresh', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'coachpress_cta_button_url', array(
        'label' => __( 'Button Link', 'coachpress' ),
        'section' => 'coachpress_cta_section',
        'type' => 'url',
        'priority' => 11
    ) );


    // -- Problem Section Specific --
    $wp_customize->add_setting( 'coachpress_problem_content', array( 'default' => 'You’ve reached the limit of what hard work alone can achieve. Your current systems are straining, and your time is being consumed by operations rather than strategy. It’s time for a new approach.', 'transport' => 'refresh', 'sanitize_callback' => 'wp_kses_post' ) );
    $wp_customize->add_control( 'coachpress_problem_content', array(
        'label' => __( 'Problem Statement Content', 'coachpress' ),
        'description' => __('Agitate the pain points of your ideal client. Help them feel that you understand their current struggle.', 'coachpress'),
        'section' => 'coachpress_problem_section',
        'type' => 'textarea',
        'priority' => 5
    ) );

    $wp_customize->add_setting( 'coachpress_problem_image', array( 'default' => '', 'sanitize_callback' => 'absint' ) );
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'coachpress_problem_image', array(
        'label'    => __( 'Problem Section Illustration', 'coachpress' ),
        'section'  => 'coachpress_problem_section',
        'mime_type'=> 'image',
        'priority' => 6
    ) ) );

    // -- About Preview Section Specific --
    $wp_customize->add_setting( 'coachpress_about-preview_content', array( 'default' => 'I partner with highly-motivated professionals to dismantle internal barriers and architect high-impact businesses. Through a combination of strategic foresight and personalized leadership coaching, we don’t just reach your goals—we redefine them.', 'transport' => 'refresh', 'sanitize_callback' => 'wp_kses_post' ) );
    $wp_customize->add_control( 'coachpress_about-preview_content', array(
        'label' => __( 'About Section Content', 'coachpress' ),
        'section' => 'coachpress_about-preview_section',
        'type' => 'textarea',
        'priority' => 5
    ) );

    $wp_customize->add_setting( 'coachpress_about-preview_image', array( 'default' => '', 'sanitize_callback' => 'absint' ) );
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'coachpress_about-preview_image', array(
        'label'    => __( 'About Section Image', 'coachpress' ),
        'section'  => 'coachpress_about-preview_section',
        'mime_type'=> 'image',
        'priority' => 6
    ) ) );

    $wp_customize->add_setting( 'coachpress_about-preview_button_text', array( 'default' => 'Explore My Methodology', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'coachpress_about-preview_button_text', array(
        'label' => __( 'About Section Button Text', 'coachpress' ),
        'section' => 'coachpress_about-preview_section',
        'type' => 'text',
        'priority' => 7
    ) );

    $wp_customize->add_setting( 'coachpress_about-preview_button_url', array( 'default' => '#about', 'transport' => 'refresh', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'coachpress_about-preview_button_url', array(
        'label' => __( 'About Section Button URL', 'coachpress' ),
        'section' => 'coachpress_about-preview_section',
        'type' => 'url',
        'priority' => 8
    ) );

    // -- Contact Section Specific --
    $wp_customize->add_setting( 'coachpress_contact_details_title', array( 'default' => 'Get In Touch', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'coachpress_contact_details_title', array( 'label' => __( 'Contact Sidebar Title', 'coachpress' ), 'section' => 'coachpress_contact_section', 'type' => 'text', 'priority' => 10 ) );

    $wp_customize->add_setting( 'coachpress_contact_email', array( 'default' => 'hello@coachpress.com', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_email' ) );
    $wp_customize->add_control( 'coachpress_contact_email', array( 'label' => __( 'Business Email', 'coachpress' ), 'section' => 'coachpress_contact_section', 'type' => 'email', 'priority' => 11 ) );

    $wp_customize->add_setting( 'coachpress_contact_phone', array( 'default' => '+1 (555) 000-0000', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'coachpress_contact_phone', array( 'label' => __( 'Business Phone', 'coachpress' ), 'section' => 'coachpress_contact_section', 'type' => 'text', 'priority' => 12 ) );

    $wp_customize->add_setting( 'coachpress_contact_address', array( 'default' => '123 Strategy Ave, Suite 100, New York, NY', 'transport' => 'refresh', 'sanitize_callback' => 'wp_kses_post' ) );
    $wp_customize->add_control( 'coachpress_contact_address', array( 'label' => __( 'Office Address', 'coachpress' ), 'section' => 'coachpress_contact_section', 'type' => 'textarea', 'priority' => 13 ) );

    $wp_customize->add_setting( 'coachpress_contact_form_title', array( 'default' => 'Send Us A Message', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'coachpress_contact_form_title', array( 'label' => __( 'Form Main Title', 'coachpress' ), 'section' => 'coachpress_contact_section', 'type' => 'text', 'priority' => 20 ) );

    // -- Per-Section Layout & Background --
    foreach ( $sections as $section_id => $section_name ) {
        $section_handle = "coachpress_{$section_id}_section";
        $default_data = $sections_data[$section_id] ?? [];

        $wp_customize->add_setting( "coachpress_{$section_id}_text_alignment", array(
            'default'           => ($section_id === 'cta' || $section_id === 'testimonials' || $section_id === 'trust' ? 'center' : 'left'),
            'transport'         => 'refresh',
            'sanitize_callback' => 'sanitize_key'
        ) );

        $wp_customize->add_control( "coachpress_{$section_id}_text_alignment", array(
            'label'       => __( 'Text Alignment', 'coachpress' ),
            'description' => __('Choose how text is aligned in this section (e.g., "Center" for impact, "Left" for readability).', 'coachpress'),
            'section'     => $section_handle,
            'type'        => 'select',
            'choices'     => array( 'left' => __( 'Left', 'coachpress' ), 'center' => __( 'Center', 'coachpress' ), 'right' => __( 'Right', 'coachpress' ) ),
            'priority'    => 50
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
            'label'    => __( 'Section Internal Spacing (Padding)', 'coachpress' ),
            'description' => __('The gap between the section edge and its content. Adjust the Top and Bottom values (e.g., 100px) to control section height.', 'coachpress'),
            'section'  => $section_handle,
            'priority' => 51
        ) ) );

        $wp_customize->add_setting( "coachpress_{$section_id}_bg_type", array(
            'default'           => 'color',
            'transport'         => 'refresh',
            'sanitize_callback' => 'sanitize_key'
        ) );

        $wp_customize->add_control( "coachpress_{$section_id}_bg_type", array(
            'label'       => __( 'Background Type', 'coachpress' ),
            'description' => __('Choose what goes behind the content of this section.', 'coachpress'),
            'section'     => $section_handle,
            'type'        => 'select',
            'choices'     => array( 'color' => __( 'Color or Gradient', 'coachpress' ), 'image' => __( 'Custom Image', 'coachpress' ), 'video' => __( 'Video Background', 'coachpress' ) ),
            'priority'    => 60
        ) );

        $default_bg_color = $sections_data[$section_id]['bg'] ?? '#FFFFFF';

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

        $wp_customize->add_setting( "coachpress_{$section_id}_bg_overlay_color", array( 'default' => '#1a365d', 'transport' => 'refresh', 'sanitize_callback' => 'coachpress_sanitize_rgba_color' ) );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, "coachpress_{$section_id}_bg_overlay_color", array(
            'label'           => __( 'Background Overlay Color', 'coachpress' ),
            'description'     => __('Adds a color tint over your image or video to make the text easier to read.', 'coachpress'),
            'section'         => $section_handle,
            'active_callback' => function($control) use ($section_id) {
                return in_array($control->manager->get_setting("coachpress_{$section_id}_bg_type")->value(), ['image', 'video']);
            },
            'priority'        => 64
        ) ) );

        $wp_customize->add_setting( "coachpress_{$section_id}_bg_overlay_opacity", array(
            'default'           => 0.85,
            'transport'         => 'refresh',
            'sanitize_callback' => 'coachpress_sanitize_opacity'
        ) );
        $wp_customize->add_control( "coachpress_{$section_id}_bg_overlay_opacity", array(
            'label'           => __( 'Background Overlay Opacity', 'coachpress' ),
            'description'     => __('Control the transparency of the overlay (0 is fully transparent, 1 is fully solid).', 'coachpress'),
            'section'         => $section_handle,
            'type'            => 'range',
            'input_attrs'     => array(
                'min'  => 0,
                'max'  => 1,
                'step' => 0.01,
            ),
            'active_callback' => function($control) use ($section_id) {
                return in_array($control->manager->get_setting("coachpress_{$section_id}_bg_type")->value(), ['image', 'video']);
            },
            'priority'        => 65
        ) );

        $wp_customize->add_setting( "coachpress_{$section_id}_heading_color", array(
            'default'           => $default_data['heading_color'] ?? '#1a365d',
            'transport'         => 'refresh',
            'sanitize_callback' => 'sanitize_hex_color'
        ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, "coachpress_{$section_id}_heading_color", array(
            'label'    => __( 'Headline Color Override', 'coachpress' ),
            'section'  => $section_handle,
            'priority' => 70
        ) ) );

        $wp_customize->add_setting( "coachpress_{$section_id}_text_color", array(
            'default'           => $default_data['text_color'] ?? '#2d3748',
            'transport'         => 'refresh',
            'sanitize_callback' => 'sanitize_hex_color'
        ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, "coachpress_{$section_id}_text_color", array(
            'label'    => __( 'Body Text Color Override', 'coachpress' ),
            'section'  => $section_handle,
            'priority' => 71
        ) ) );

        // -- Typography Overrides per Section --
        $wp_customize->add_setting( "coachpress_{$section_id}_heading_font", array( 'default' => '', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( new CoachPress_Google_Font_Control( $wp_customize, "coachpress_{$section_id}_heading_font", array( 'label' => __( 'Heading Font Family', 'coachpress' ), 'section' => $section_handle, 'priority' => 80 ) ) );

        $wp_customize->add_setting( "coachpress_{$section_id}_body_font", array( 'default' => '', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( new CoachPress_Google_Font_Control( $wp_customize, "coachpress_{$section_id}_body_font", array( 'label' => __( 'Body Font Family', 'coachpress' ), 'section' => $section_handle, 'priority' => 81 ) ) );

        $wp_customize->add_setting( "coachpress_{$section_id}_heading_font_size", array( 'default' => '', 'transport' => 'refresh', 'sanitize_callback' => 'coachpress_sanitize_responsive_font_size' ) );
        $wp_customize->add_control( new CoachPress_Responsive_Font_Size_Control( $wp_customize, "coachpress_{$section_id}_heading_font_size", array( 'label' => __( 'Headline Font Size', 'coachpress' ), 'section' => $section_handle, 'priority' => 82 ) ) );

        $wp_customize->add_setting( "coachpress_{$section_id}_body_font_size", array( 'default' => '', 'transport' => 'refresh', 'sanitize_callback' => 'coachpress_sanitize_responsive_font_size' ) );
        $wp_customize->add_control( new CoachPress_Responsive_Font_Size_Control( $wp_customize, "coachpress_{$section_id}_body_font_size", array( 'label' => __( 'Body Font Size', 'coachpress' ), 'section' => $section_handle, 'priority' => 83 ) ) );

        // -- Margin Override per Section --
        $wp_customize->add_setting( "coachpress_{$section_id}_margin", array(
            'default'           => json_encode(array('top' => '0', 'right' => '0', 'bottom' => '0', 'left' => '0')),
            'transport'         => 'refresh',
            'sanitize_callback' => 'coachpress_sanitize_dimensions'
        ) );

        $wp_customize->add_control( new CoachPress_Dimensions_Control( $wp_customize, "coachpress_{$section_id}_margin", array(
            'label'    => __( 'Section External Spacing (Margin)', 'coachpress' ),
            'description' => __('The gap around the outside of this section. Usually left at 0.', 'coachpress'),
            'section'  => $section_handle,
            'priority' => 85
        ) ) );

        // -- Button Overrides per Section --
        $wp_customize->add_setting( "coachpress_{$section_id}_button_bg_color", array(
            'default'           => '',
            'transport'         => 'refresh',
            'sanitize_callback' => 'sanitize_hex_color'
        ) );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, "coachpress_{$section_id}_button_bg_color", array(
            'label'    => __( 'Button Background Override', 'coachpress' ),
            'section'  => $section_handle,
            'priority' => 90
        ) ) );

        $wp_customize->add_setting( "coachpress_{$section_id}_button_text_color", array(
            'default'           => '',
            'transport'         => 'refresh',
            'sanitize_callback' => 'sanitize_hex_color'
        ) );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, "coachpress_{$section_id}_button_text_color", array(
            'label'    => __( 'Button Text Override', 'coachpress' ),
            'section'  => $section_handle,
            'priority' => 91
        ) ) );
    }
}
