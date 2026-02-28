<?php
/**
 * Customizer Page Template Controls
 *
 * @package CoachPress
 */

function coachpress_customize_page_templates( $wp_customize ) {
    $sections = coachpress_get_section_choices();

    // -- Global Page Header (Styles) --
    $wp_customize->add_section( 'coachpress_global_page_header', array(
        'title'    => __( 'All-Page Header Styles', 'coachpress' ),
        'description' => __('These settings apply to the banner at the top of every internal page (About, Services, etc.).', 'coachpress'),
        'priority' => 5,
        'panel'    => 'coachpress_page_templates_panel',
    ) );

    $wp_customize->add_setting( 'coachpress_page_header_bg_color', array( 'default' => '#f7fafc', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_page_header_bg_color', array( 'label' => __( 'Banner Background Color', 'coachpress' ), 'description' => __('Establish a professional background for your page titles.', 'coachpress'), 'section' => 'coachpress_global_page_header' ) ) );

    $wp_customize->add_setting( 'coachpress_page_header_text_color', array( 'default' => '#1a365d', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'coachpress_page_header_text_color', array( 'label' => __( 'Banner Title Color', 'coachpress' ), 'section' => 'coachpress_global_page_header' ) ) );

    $wp_customize->add_setting( 'coachpress_page_header_alignment', array( 'default' => 'center', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_key' ) );
    $wp_customize->add_control( 'coachpress_page_header_alignment', array(
        'label'    => __( 'Banner Alignment', 'coachpress' ),
        'description' => __('Choose if your page titles are centered or aligned to one side.', 'coachpress'),
        'section'  => 'coachpress_global_page_header',
        'type'     => 'select',
        'choices'  => array( 'left' => __( 'Left', 'coachpress' ), 'center' => __( 'Center', 'coachpress' ), 'right' => __( 'Right', 'coachpress' ) )
    ) );

    $wp_customize->add_setting( 'coachpress_page_header_padding', array(
        'default'           => json_encode(array('top' => '100px', 'right' => '0', 'bottom' => '100px', 'left' => '0')),
        'transport'         => 'refresh',
        'sanitize_callback' => 'coachpress_sanitize_dimensions'
    ) );
    $wp_customize->add_control( new CoachPress_Dimensions_Control( $wp_customize, 'coachpress_page_header_padding', array(
        'label'    => __( 'Banner Spacing (Height)', 'coachpress' ),
        'description' => __('Increase the Top and Bottom values to make the banner taller.', 'coachpress'),
        'section'  => 'coachpress_global_page_header'
    ) ) );

    $wp_customize->add_setting( 'coachpress_page_header_font', array( 'default' => '', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( new CoachPress_Google_Font_Control( $wp_customize, 'coachpress_page_header_font', array( 'label' => __( 'Banner Heading Font', 'coachpress' ), 'section' => 'coachpress_global_page_header' ) ) );

    $wp_customize->add_setting( 'coachpress_page_header_title_size', array( 'default' => '', 'transport' => 'refresh', 'sanitize_callback' => 'coachpress_sanitize_responsive_font_size' ) );
    $wp_customize->add_control( new CoachPress_Responsive_Font_Size_Control( $wp_customize, 'coachpress_page_header_title_size', array( 'label' => __( 'Title Text Size', 'coachpress' ), 'section' => 'coachpress_global_page_header' ) ) );

    $wp_customize->add_setting( 'coachpress_page_header_subtitle_size', array( 'default' => '', 'transport' => 'refresh', 'sanitize_callback' => 'coachpress_sanitize_responsive_font_size' ) );
    $wp_customize->add_control( new CoachPress_Responsive_Font_Size_Control( $wp_customize, 'coachpress_page_header_subtitle_size', array( 'label' => __( 'Subtitle Text Size', 'coachpress' ), 'section' => 'coachpress_global_page_header' ) ) );

    $pages = array(
        'about'     => array(
            'name' => __( 'About Page', 'coachpress' ),
            'title' => 'Decades of Strategy. One Mission: Your Growth.',
            'subtitle' => 'Meet the minds behind the most successful market transformations.',
            'content' => 'We don\'t just consult; we partner. Our approach is rooted in organizational psychology and data-driven execution. Over the last 20 years, we have helped over 500 high-performers find their edge and dominate their markets.'
        ),
        'services'  => array(
            'name' => __( 'Services Page', 'coachpress' ),
            'title' => 'High-Impact Solutions for Modern Leaders.',
            'subtitle' => 'Precision-engineered frameworks designed to scale your impact and income.',
            'content' => 'Explore our range of bespoke consulting and coaching services. Whether you are looking for executive leadership development or a total operational overhaul, we have the systems to get you there.'
        ),
        'process'   => array(
            'name' => __( 'Process Page', 'coachpress' ),
            'title' => 'The Scientific Approach to Success.',
            'subtitle' => 'Transparency at every step. See how we turn chaos into a scalable blueprint.',
            'content' => 'Our 4-step framework is rigorous, iterative, and results-oriented. We leave nothing to chance, ensuring every strategic move is backed by data and aligned with your long-term vision.'
        ),
        'portfolio' => array(
            'name' => __( 'Portfolio Page', 'coachpress' ),
            'title' => 'A Track Record of Radical Transformation.',
            'subtitle' => 'Real stories of scale, efficiency, and market domination.',
            'content' => 'Browse our curated selection of high-impact projects. From global SaaS scaling to leadership turnarounds, these case studies demonstrate the power of modular strategy.'
        ),
        'blog'      => array(
            'name' => __( 'Blog Page', 'coachpress' ),
            'title' => 'Insights & Strategy',
            'subtitle' => 'Deep dives into the worlds of high-performance leadership and market domination.',
            'content' => ''
        ),
        'team'      => array(
            'name' => __( 'Team Page', 'coachpress' ),
            'title' => 'The Collective: Elite Minds, Unified Vision.',
            'subtitle' => 'Meet the consultants who have built, scaled, and exited multi-million dollar firms.',
            'content' => 'Our team is composed of seasoned operators and visionary strategists. We don\'t just teach; we\'ve done it. Join an exclusive circle of experts dedicated to your success.'
        ),
        'contact'   => array(
            'name' => __( 'Contact Page', 'coachpress' ),
            'title' => 'Start Your Transformation Today.',
            'subtitle' => 'Ready to find your edge? Let\'s have a high-stakes conversation.',
            'content' => 'Fill out the form below or reach out via our direct channels. We respond to qualified inquiries within 24 hours.'
        )
    );

    $i = 10;
    foreach ($pages as $slug => $data) {
        $section_id = "coachpress_{$slug}_page";
        $wp_customize->add_section( $section_id, array(
            'title'    => sprintf( __( '%s Settings', 'coachpress' ), $data['name'] ),
            'priority' => $i,
            'panel'    => 'coachpress_page_templates_panel',
        ) );

        // Banner Content
        $wp_customize->add_setting( "coachpress_{$slug}_banner_title", array( 'default' => $data['title'], 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( "coachpress_{$slug}_banner_title", array(
            'label' => __( 'Page Main Heading', 'coachpress' ),
            'description' => __('The big title at the top of this specific page.', 'coachpress'),
            'section' => $section_id,
            'type' => 'text'
        ) );

        $wp_customize->add_setting( "coachpress_{$slug}_banner_subtitle", array( 'default' => $data['subtitle'], 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( "coachpress_{$slug}_banner_subtitle", array(
            'label' => __( 'Page Sub-Heading', 'coachpress' ),
            'description' => __('A short secondary title shown beneath the main heading.', 'coachpress'),
            'section' => $section_id,
            'type' => 'textarea'
        ) );

        $wp_customize->add_setting( "coachpress_{$slug}_page_content", array( 'default' => $data['content'], 'transport' => 'refresh', 'sanitize_callback' => 'wp_kses_post' ) );
        $wp_customize->add_control( "coachpress_{$slug}_page_content", array(
            'label' => __( 'Narrative Story/Content', 'coachpress' ),
            'description' => __('The primary narrative text area for this page. Use this to tell a deeper story than what is in the modular sections.', 'coachpress'),
            'section' => $section_id,
            'type' => 'textarea'
        ) );

        $wp_customize->add_setting( "coachpress_{$slug}_page_banner_image", array( 'default' => '', 'transport' => 'refresh', 'sanitize_callback' => 'absint' ) );
        $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, "coachpress_{$slug}_page_banner_image", array(
            'label' => __( 'Page-Specific Banner Image', 'coachpress' ),
            'description' => __('Upload a high-quality background image specifically for this page. It will override the global banner color.', 'coachpress'),
            'section' => $section_id,
            'mime_type' => 'image'
        ) ) );

        // Section Order
        $default_sections = '';
        if ($slug === 'about') $default_sections = 'about-preview,team,cta';
        elseif ($slug === 'services') $default_sections = 'services,processes,cta';
        elseif ($slug === 'process') $default_sections = 'processes,faqs,cta';
        elseif ($slug === 'portfolio') $default_sections = 'portfolio,case-studies,cta';
        elseif ($slug === 'team') $default_sections = 'team,testimonials,cta';
        elseif ($slug === 'contact') $default_sections = 'contact,faqs';

        $wp_customize->add_setting( "coachpress_{$slug}_page_sections", array(
            'default'           => $default_sections,
            'transport'         => 'refresh',
            'sanitize_callback' => 'sanitize_text_field'
        ) );
        $wp_customize->add_control( new CoachPress_Section_Order_Control( $wp_customize, "coachpress_{$slug}_page_sections", array(
            'label'       => __( 'Page Sections Layout (Builder)', 'coachpress' ),
            'description' => __('This tool allows you to build this page by stacking modular sections. Drag and drop to reorder.', 'coachpress'),
            'section'     => $section_id,
            'choices'     => $sections
        ) ) );

        // Specifics for Contact Page
        if ($slug === 'contact') {
            $wp_customize->add_setting( 'coachpress_contact_page_form_type', array( 'default' => 'shortcode', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_key' ) );
            $wp_customize->add_control( 'coachpress_contact_page_form_type', array(
                'label' => __( 'Contact Form Integration', 'coachpress' ),
                'description' => __('Choose how you want to embed your contact form.', 'coachpress'),
                'section' => $section_id,
                'type' => 'select',
                'choices' => array( 'html' => __( 'Raw HTML (Custom Form)', 'coachpress' ), 'shortcode' => __( 'Shortcode (Plugin like Contact Form 7)', 'coachpress' ) )
            ) );

            $wp_customize->add_setting( 'coachpress_contact_page_html', array( 'default' => '', 'transport' => 'refresh', 'sanitize_callback' => 'wp_kses_post' ) );
            $wp_customize->add_control( 'coachpress_contact_page_html', array(
                'label' => __( 'Raw Form HTML', 'coachpress' ),
                'section' => $section_id,
                'type' => 'textarea',
                'active_callback' => function($control) {
                    return 'html' === $control->manager->get_setting('coachpress_contact_page_form_type')->value();
                }
            ) );

            $wp_customize->add_setting( 'coachpress_contact_page_shortcode', array( 'default' => '', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
            $wp_customize->add_control( 'coachpress_contact_page_shortcode', array(
                'label' => __( 'Form Shortcode', 'coachpress' ),
                'section' => $section_id,
                'type' => 'text',
                'active_callback' => function($control) {
                    return 'shortcode' === $control->manager->get_setting('coachpress_contact_page_form_type')->value();
                }
            ) );
        }

        $i += 10;
    }

    // -- Single CPT View CTA Settings --
    $wp_customize->add_section( 'coachpress_single_cpt_cta', array(
        'title'    => __( 'Single View CTA Settings', 'coachpress' ),
        'description' => __('Manage the call-to-action cards in the sidebar of individual Service, Portfolio, Team, and Case Study pages.', 'coachpress'),
        'priority' => 15,
        'panel'    => 'coachpress_page_templates_panel',
    ) );

    $cpts = array(
        'services'      => __( 'Services', 'coachpress' ),
        'portfolio'     => __( 'Portfolio', 'coachpress' ),
        'team'          => __( 'Team', 'coachpress' ),
        'case_studies'  => __( 'Case Studies', 'coachpress' ),
        'processes'      => __( 'Processes', 'coachpress' ),
    );

    foreach ( $cpts as $cpt_slug => $cpt_label ) {
        // Divider
        $wp_customize->add_setting( "coachpress_single_{$cpt_slug}_divider", array( 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( new CoachPress_Divider_Control( $wp_customize, "coachpress_single_{$cpt_slug}_divider", array(
            'label' => sprintf( __( '%s CTA Card', 'coachpress' ), $cpt_label ),
            'section' => 'coachpress_single_cpt_cta',
        ) ) );

        // Content
        $wp_customize->add_setting( "coachpress_single_{$cpt_slug}_cta_title", array( 'default' => __( 'Ready to Start?', 'coachpress' ), 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( "coachpress_single_{$cpt_slug}_cta_title", array( 'label' => __( 'CTA Title', 'coachpress' ), 'section' => 'coachpress_single_cpt_cta', 'type' => 'text' ) );

        $wp_customize->add_setting( "coachpress_single_{$cpt_slug}_cta_desc", array( 'default' => __( 'Take the first step toward transforming your business.', 'coachpress' ), 'transport' => 'refresh', 'sanitize_callback' => 'wp_kses_post' ) );
        $wp_customize->add_control( "coachpress_single_{$cpt_slug}_cta_desc", array( 'label' => __( 'CTA Description', 'coachpress' ), 'section' => 'coachpress_single_cpt_cta', 'type' => 'textarea' ) );

        $wp_customize->add_setting( "coachpress_single_{$cpt_slug}_cta_btn_text", array( 'default' => __( 'Get Started', 'coachpress' ), 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( "coachpress_single_{$cpt_slug}_cta_btn_text", array( 'label' => __( 'Button Text', 'coachpress' ), 'section' => 'coachpress_single_cpt_cta', 'type' => 'text' ) );

        // Interaction Type
        $wp_customize->add_setting( "coachpress_single_{$cpt_slug}_cta_btn_type", array( 'default' => 'url', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_key' ) );
        $wp_customize->add_control( "coachpress_single_{$cpt_slug}_cta_btn_type", array(
            'label' => __( 'Button Interaction', 'coachpress' ),
            'section' => 'coachpress_single_cpt_cta',
            'type' => 'select',
            'choices' => array( 'url' => __( 'Link to URL', 'coachpress' ), 'html' => __( 'Custom HTML (e.g., Form)', 'coachpress' ), 'shortcode' => __( 'Shortcode', 'coachpress' ) )
        ) );

        $wp_customize->add_setting( "coachpress_single_{$cpt_slug}_cta_btn_url", array( 'default' => '#contact', 'transport' => 'refresh', 'sanitize_callback' => 'esc_url_raw' ) );
        $wp_customize->add_control( "coachpress_single_{$cpt_slug}_cta_btn_url", array(
            'label' => __( 'Button URL', 'coachpress' ),
            'section' => 'coachpress_single_cpt_cta',
            'type' => 'text',
            'active_callback' => function($control) use ($cpt_slug) { return 'url' === $control->manager->get_setting("coachpress_single_{$cpt_slug}_cta_btn_type")->value(); }
        ) );

        $wp_customize->add_setting( "coachpress_single_{$cpt_slug}_cta_btn_html", array( 'default' => '', 'transport' => 'refresh', 'sanitize_callback' => 'wp_kses_post' ) );
        $wp_customize->add_control( "coachpress_single_{$cpt_slug}_cta_btn_html", array(
            'label' => __( 'Custom HTML', 'coachpress' ),
            'section' => 'coachpress_single_cpt_cta',
            'type' => 'textarea',
            'active_callback' => function($control) use ($cpt_slug) { return 'html' === $control->manager->get_setting("coachpress_single_{$cpt_slug}_cta_btn_type")->value(); }
        ) );

        $wp_customize->add_setting( "coachpress_single_{$cpt_slug}_cta_btn_shortcode", array( 'default' => '', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( "coachpress_single_{$cpt_slug}_cta_btn_shortcode", array(
            'label' => __( 'Shortcode', 'coachpress' ),
            'section' => 'coachpress_single_cpt_cta',
            'type' => 'text',
            'active_callback' => function($control) use ($cpt_slug) { return 'shortcode' === $control->manager->get_setting("coachpress_single_{$cpt_slug}_cta_btn_type")->value(); }
        ) );

        // Styling
        $wp_customize->add_setting( "coachpress_single_{$cpt_slug}_cta_bg_color", array( 'default' => '#1a365d', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, "coachpress_single_{$cpt_slug}_cta_bg_color", array( 'label' => __( 'Card Background Color', 'coachpress' ), 'section' => 'coachpress_single_cpt_cta' ) ) );

        $wp_customize->add_setting( "coachpress_single_{$cpt_slug}_cta_text_color", array( 'default' => '#ffffff', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color' ) );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, "coachpress_single_{$cpt_slug}_cta_text_color", array( 'label' => __( 'Card Text Color', 'coachpress' ), 'section' => 'coachpress_single_cpt_cta' ) ) );
    }
}
