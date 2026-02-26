<?php
/**
 * Dynamic CSS
 *
 * @package CoachPress
 */

function coachpress_generate_dynamic_css() {
    ob_start();
    ?>
    :root {
        /* Global Colors */
        --coachpress-primary-color: <?php echo esc_html( get_theme_mod('coachpress_primary_color', '#1a365d') ); ?>;
        --coachpress-secondary-color: <?php echo esc_html( get_theme_mod('coachpress_secondary_color', '#f7fafc') ); ?>;
        --coachpress-accent-color: <?php echo esc_html( get_theme_mod('coachpress_accent_color', '#c0a080') ); ?>;
        --coachpress-text-color: <?php echo esc_html( get_theme_mod('coachpress_text_color', '#2d3748') ); ?>;
        --coachpress-muted-text-color: <?php echo esc_html( get_theme_mod('coachpress_muted_text_color', '#718096') ); ?>;
        --coachpress-link-color: <?php echo esc_html( get_theme_mod('coachpress_link_color', '#1a365d') ); ?>;
        --coachpress-link-hover-color: <?php echo esc_html( get_theme_mod('coachpress_link_hover_color', '#c0a080') ); ?>;
        --coachpress-dark-bg-color: #1a202c;

        /* Global Button Hover */
        --coachpress-button-hover-bg-color: <?php echo esc_html( get_theme_mod('coachpress_button_hover_bg_color', '#1a365d') ); ?>;
        --coachpress-button-hover-text-color: <?php echo esc_html( get_theme_mod('coachpress_button_hover_text_color', '#FFFFFF') ); ?>;

        /* Global Typography */
        --coachpress-body-font: '<?php echo esc_html( get_theme_mod('coachpress_body_font', 'Inter') ); ?>', sans-serif;
        --coachpress-body-line-height: 1.7;
        --coachpress-heading-font: '<?php echo esc_html( get_theme_mod('coachpress_heading_font', 'Playfair Display') ); ?>', serif;
        --coachpress-heading-letter-spacing: 0.5px;

        <?php
        // Responsive Font Sizes
        $body_font_size = json_decode(get_theme_mod('coachpress_body_font_size', json_encode(array('desktop' => '17px', 'tablet' => '16px', 'mobile' => '15px'))), true);
        echo "--coachpress-body-font-size-desktop: " . esc_html($body_font_size['desktop'] ?? '17px') . ";";
        echo "--coachpress-body-font-size-tablet: " . esc_html($body_font_size['tablet'] ?? '16px') . ";";
        echo "--coachpress-body-font-size-mobile: " . esc_html($body_font_size['mobile'] ?? '15px') . ";";

        $h1_font_size = json_decode(get_theme_mod('coachpress_h1_font_size', json_encode(array('desktop' => '3.5rem', 'tablet' => '2.8rem', 'mobile' => '2.2rem'))), true);
        echo "--coachpress-h1-font-size-desktop: " . esc_html($h1_font_size['desktop'] ?? '3.5rem') . ";";
        echo "--coachpress-h1-font-size-tablet: " . esc_html($h1_font_size['tablet'] ?? '2.8rem') . ";";
        echo "--coachpress-h1-font-size-mobile: " . esc_html($h1_font_size['mobile'] ?? '2.2rem') . ";";

        for ( $i = 2; $i <= 6; $i++ ) {
            $default_sizes = array('desktop' => (2.5 - ($i * 0.2)) . 'rem', 'tablet' => (2.2 - ($i * 0.2)) . 'rem', 'mobile' => (1.8 - ($i * 0.1)) . 'rem');
            $font_sizes = json_decode(get_theme_mod("coachpress_h{$i}_font_size", json_encode($default_sizes)), true);
            echo "--coachpress-h{$i}-font-size-desktop: " . esc_html($font_sizes['desktop'] ?? $default_sizes['desktop']) . ";";
            echo "--coachpress-h{$i}-font-size-tablet: " . esc_html($font_sizes['tablet'] ?? $default_sizes['tablet']) . ";";
            echo "--coachpress-h{$i}-font-size-mobile: " . esc_html($font_sizes['mobile'] ?? $default_sizes['mobile']) . ";";
        }
        ?>

        /* Cards */
        <?php
        $card_bg = get_theme_mod('coachpress_card_bg_color', '#FFFFFF');
        $is_card_dark = coachpress_is_dark($card_bg);
        $card_text_color = $is_card_dark ? '#e2e8f0' : '#2d3748';
        $card_heading_color = $is_card_dark ? '#FFFFFF' : '#1a365d';
        ?>
        --coachpress-card-bg-color: <?php echo esc_html( $card_bg ); ?>;
        --coachpress-card-text-color: <?php echo esc_html( $card_text_color ); ?>;
        --coachpress-card-heading-color: <?php echo esc_html( $card_heading_color ); ?>;
        --coachpress-card-border-radius: <?php echo esc_html( get_theme_mod('coachpress_card_border_radius', '12px') ); ?>;
        --coachpress-card-border-color: <?php echo esc_html( get_theme_mod('coachpress_card_border_color', 'transparent') ); ?>;
        --coachpress-card-border-width: <?php echo esc_html( get_theme_mod('coachpress_card_border_width', '0px') ); ?>;

        <?php
        $card_padding = json_decode(get_theme_mod('coachpress_card_padding', json_encode(array('top' => '40px', 'right' => '40px', 'bottom' => '40px', 'left' => '40px'))), true);
        echo "--coachpress-card-padding-top: " . esc_html($card_padding['top'] ?? '40px') . ";";
        echo "--coachpress-card-padding-right: " . esc_html($card_padding['right'] ?? '40px') . ";";
        echo "--coachpress-card-padding-bottom: " . esc_html($card_padding['bottom'] ?? '40px') . ";";
        echo "--coachpress-card-padding-left: " . esc_html($card_padding['left'] ?? '40px') . ";";

        $card_margin = json_decode(get_theme_mod('coachpress_card_margin', json_encode(array('top' => '0', 'right' => '0', 'bottom' => '0', 'left' => '0'))), true);
        echo "--coachpress-card-margin-top: " . esc_html($card_margin['top'] ?? '0') . ";";
        echo "--coachpress-card-margin-right: " . esc_html($card_margin['right'] ?? '0') . ";";
        echo "--coachpress-card-margin-bottom: " . esc_html($card_margin['bottom'] ?? '0') . ";";
        echo "--coachpress-card-margin-left: " . esc_html($card_margin['left'] ?? '0') . ";";
        ?>

        /* Forms */
        --coachpress-form-field-bg-color: <?php echo esc_html( get_theme_mod('coachpress_form_field_bg_color', '#FFFFFF') ); ?>;
        --coachpress-form-field-text-color: <?php echo esc_html( get_theme_mod('coachpress_form_field_text_color', '#2d3748') ); ?>;
        --coachpress-form-field-border-color: <?php echo esc_html( get_theme_mod('coachpress_form_field_border_color', '#e2e8f0') ); ?>;
        --coachpress-form-field-border-radius: <?php echo esc_html( get_theme_mod('coachpress_form_field_border_radius', '6px') ); ?>;

        /* Images */
        <?php
        $img_radius = json_decode(get_theme_mod('coachpress_image_border_radius', json_encode(array('top-left' => '12px', 'top-right' => '12px', 'bottom-right' => '12px', 'bottom-left' => '12px'))), true);
        echo "--coachpress-image-border-radius-top-left: " . esc_html($img_radius['top-left'] ?? '12px') . ";";
        echo "--coachpress-image-border-radius-top-right: " . esc_html($img_radius['top-right'] ?? '12px') . ";";
        echo "--coachpress-image-border-radius-bottom-right: " . esc_html($img_radius['bottom-right'] ?? '12px') . ";";
        echo "--coachpress-image-border-radius-bottom-left: " . esc_html($img_radius['bottom-left'] ?? '12px') . ";";
        ?>

        /* Layout */
        --coachpress-container-width: <?php echo esc_html( get_theme_mod('coachpress_container_width', '1240px') ); ?>;

        /* Header & Footer */
        --coachpress-header-bg-color: <?php echo esc_html( get_theme_mod('coachpress_header_bg_color', '#FFFFFF') ); ?>;

        /* Header CTA Button */
        --coachpress-header-cta-bg-color: <?php echo esc_html( get_theme_mod('coachpress_header_cta_bg_color', '#1a365d') ); ?>;
        --coachpress-header-cta-text-color: <?php echo esc_html( get_theme_mod('coachpress_header_cta_text_color', '#FFFFFF') ); ?>;
        --coachpress-header-cta-hover-bg-color: <?php echo esc_html( get_theme_mod('coachpress_header_cta_hover_bg_color', '#c0a080') ); ?>;
        --coachpress-header-cta-hover-text-color: <?php echo esc_html( get_theme_mod('coachpress_header_cta_hover_text_color', '#FFFFFF') ); ?>;
        --coachpress-header-cta-border-radius: <?php echo esc_html( get_theme_mod('coachpress_header_cta_border_radius', '6px') ); ?>;
        <?php
        $cta_padding = json_decode(get_theme_mod('coachpress_header_cta_padding', json_encode(array('top' => '12px', 'right' => '28px', 'bottom' => '12px', 'left' => '28px'))), true);
        echo "--coachpress-header-cta-padding-top: " . esc_html($cta_padding['top'] ?? '12px') . ";";
        echo "--coachpress-header-cta-padding-right: " . esc_html($cta_padding['right'] ?? '28px') . ";";
        echo "--coachpress-header-cta-padding-bottom: " . esc_html($cta_padding['bottom'] ?? '12px') . ";";
        echo "--coachpress-header-cta-padding-left: " . esc_html($cta_padding['left'] ?? '28px') . ";";
        ?>

        /* Page Header */
        --coachpress-page-header-bg-color: <?php echo esc_html( get_theme_mod('coachpress_page_header_bg_color', '#f7fafc') ); ?>;
        --coachpress-page-header-text-color: <?php echo esc_html( get_theme_mod('coachpress_page_header_text_color', '#1a365d') ); ?>;
        <?php
        $page_header_padding = json_decode(get_theme_mod('coachpress_page_header_padding', json_encode(array('top' => '80px', 'right' => '0', 'bottom' => '80px', 'left' => '0'))), true);
        echo "--coachpress-page-header-padding-top: " . esc_html($page_header_padding['top'] ?? '80px') . ";";
        echo "--coachpress-page-header-padding-right: " . esc_html($page_header_padding['right'] ?? '0') . ";";
        echo "--coachpress-page-header-padding-bottom: " . esc_html($page_header_padding['bottom'] ?? '80px') . ";";
        echo "--coachpress-page-header-padding-left: " . esc_html($page_header_padding['left'] ?? '0') . ";";
        ?>

        /* Buttons */
        --coachpress-hero-button-bg-color: <?php echo esc_html( get_theme_mod('coachpress_hero_button_bg_color', '#c0a080') ); ?>;
        --coachpress-hero-button-text-color: <?php echo esc_html( get_theme_mod('coachpress_hero_button_text_color', '#FFFFFF') ); ?>;
        --coachpress-about-preview-button-bg-color: <?php echo esc_html( get_theme_mod('coachpress_about-preview_button_bg_color', '#1a365d') ); ?>;
        --coachpress-about-preview-button-text-color: <?php echo esc_html( get_theme_mod('coachpress_about-preview_button_text_color', '#FFFFFF') ); ?>;
        --coachpress-cta-button-bg-color: <?php echo esc_html( get_theme_mod('coachpress_cta_button_bg_color', '#c0a080') ); ?>;
        --coachpress-cta-button-text-color: <?php echo esc_html( get_theme_mod('coachpress_cta_button_text_color', '#FFFFFF') ); ?>;
    }

    <?php
    $sections_data = coachpress_get_sections_data();
    foreach ($sections_data as $section_id => $data) :
        $default_bg = $data['bg'] ?? '#FFFFFF';
        $alignment = get_theme_mod("coachpress_{$section_id}_text_alignment", ($section_id === 'cta' || $section_id === 'testimonials' || $section_id === 'trust' ? 'center' : 'left'));
        $padding_json = get_theme_mod("coachpress_{$section_id}_padding");
        $padding = $padding_json ? json_decode($padding_json, true) : null;
        $bg_type = get_theme_mod("coachpress_{$section_id}_bg_type", 'color');
        $bg_color = get_theme_mod("coachpress_{$section_id}_bg_color", $default_bg);
        $heading_color = get_theme_mod("coachpress_{$section_id}_heading_color", $data['heading_color'] ?? '#1a365d');
        $text_color = get_theme_mod("coachpress_{$section_id}_text_color", $data['text_color'] ?? '#2d3748');
        $overlay_color = get_theme_mod("coachpress_{$section_id}_bg_overlay_color", 'rgba(26,54,93,0.85)');

        $heading_font = get_theme_mod("coachpress_{$section_id}_heading_font");
        $body_font = get_theme_mod("coachpress_{$section_id}_body_font");

        $heading_size_json = get_theme_mod("coachpress_{$section_id}_heading_font_size");
        $heading_size = $heading_size_json ? json_decode($heading_size_json, true) : null;

        $body_size_json = get_theme_mod("coachpress_{$section_id}_body_font_size");
        $body_size = $body_size_json ? json_decode($body_size_json, true) : null;

        $margin_json = get_theme_mod("coachpress_{$section_id}_margin");
        $margin = $margin_json ? json_decode($margin_json, true) : null;
        ?>
        .section-<?php echo esc_attr($section_id); ?> {
            text-align: <?php echo esc_html($alignment); ?>;
            <?php if ($bg_type === 'color' && !empty($bg_color)) : ?>
                <?php if (strpos($bg_color, 'gradient') !== false) : ?>
                    background: <?php echo esc_attr($bg_color); ?> !important;
                <?php else : ?>
                    background-color: <?php echo esc_attr($bg_color); ?> !important;
                <?php endif; ?>
            <?php endif; ?>
            <?php if ($padding) : ?>
                padding-top: <?php echo esc_html($padding['top']); ?> !important;
                padding-bottom: <?php echo esc_html($padding['bottom']); ?> !important;
                padding-left: <?php echo esc_html($padding['left']); ?> !important;
                padding-right: <?php echo esc_html($padding['right']); ?> !important;
            <?php else : ?>
                padding-top: 100px !important;
                padding-bottom: 100px !important;
            <?php endif; ?>
            <?php if ($margin) : ?>
                margin-top: <?php echo esc_html($margin['top']); ?> !important;
                margin-bottom: <?php echo esc_html($margin['bottom']); ?> !important;
            <?php endif; ?>
        }
        <?php if ($heading_color) : ?>
            .section-<?php echo esc_attr($section_id); ?> h1,
            .section-<?php echo esc_attr($section_id); ?> h2,
            .section-<?php echo esc_attr($section_id); ?> h3,
            .section-<?php echo esc_attr($section_id); ?> h4,
            .section-<?php echo esc_attr($section_id); ?> h5,
            .section-<?php echo esc_attr($section_id); ?> h6 { color: <?php echo esc_html($heading_color); ?> !important; }
        <?php endif; ?>
        <?php if ($text_color) : ?>
            .section-<?php echo esc_attr($section_id); ?>,
            .section-<?php echo esc_attr($section_id); ?> p,
            .section-<?php echo esc_attr($section_id); ?> .section-description { color: <?php echo esc_html($text_color); ?> !important; }
        <?php endif; ?>

        <?php if ($heading_font) : ?>
            .section-<?php echo esc_attr($section_id); ?> h1, .section-<?php echo esc_attr($section_id); ?> h2, .section-<?php echo esc_attr($section_id); ?> h3, .section-<?php echo esc_attr($section_id); ?> h4, .section-<?php echo esc_attr($section_id); ?> h5, .section-<?php echo esc_attr($section_id); ?> h6 { font-family: '<?php echo esc_html($heading_font); ?>', serif !important; }
        <?php endif; ?>
        <?php if ($body_font) : ?>
            .section-<?php echo esc_attr($section_id); ?>, .section-<?php echo esc_attr($section_id); ?> p, .section-<?php echo esc_attr($section_id); ?> .section-description { font-family: '<?php echo esc_html($body_font); ?>', sans-serif !important; }
        <?php endif; ?>

        <?php if ($heading_size) : ?>
            @media (min-width: 1024px) { .section-<?php echo esc_attr($section_id); ?> h2 { font-size: <?php echo esc_html($heading_size['desktop'] ?? '3rem'); ?> !important; } }
            @media (max-width: 1023px) { .section-<?php echo esc_attr($section_id); ?> h2 { font-size: <?php echo esc_html($heading_size['tablet'] ?? '2.5rem'); ?> !important; } }
            @media (max-width: 767px) { .section-<?php echo esc_attr($section_id); ?> h2 { font-size: <?php echo esc_html($heading_size['mobile'] ?? '2.2rem'); ?> !important; } }
        <?php endif; ?>

        <?php if ($body_size) : ?>
            @media (min-width: 1024px) { .section-<?php echo esc_attr($section_id); ?> p, .section-<?php echo esc_attr($section_id); ?> .section-description { font-size: <?php echo esc_html($body_size['desktop'] ?? '17px'); ?> !important; } }
            @media (max-width: 1023px) { .section-<?php echo esc_attr($section_id); ?> p, .section-<?php echo esc_attr($section_id); ?> .section-description { font-size: <?php echo esc_html($body_size['tablet'] ?? '16px'); ?> !important; } }
            @media (max-width: 767px) { .section-<?php echo esc_attr($section_id); ?> p, .section-<?php echo esc_attr($section_id); ?> .section-description { font-size: <?php echo esc_html($body_size['mobile'] ?? '15px'); ?> !important; } }
        <?php endif; ?>
        .section-<?php echo esc_attr($section_id); ?> .section-background-overlay {
            background-color: <?php echo esc_html($overlay_color); ?> !important;
        }
    <?php endforeach; ?>

    .header-cta .button {
        padding-top: var(--coachpress-header-cta-padding-top) !important;
        padding-bottom: var(--coachpress-header-cta-padding-bottom) !important;
        padding-left: var(--coachpress-header-cta-padding-left) !important;
        padding-right: var(--coachpress-header-cta-padding-right) !important;
        border-radius: var(--coachpress-header-cta-border-radius) !important;
        background-color: var(--coachpress-header-cta-bg-color) !important;
        color: var(--coachpress-header-cta-text-color) !important;
        transition: all 0.3s ease !important;
    }
    .header-cta .button:hover {
        background-color: var(--coachpress-header-cta-hover-bg-color) !important;
        color: var(--coachpress-header-cta-hover-text-color) !important;
    }

    .page-banner {
        background-color: var(--coachpress-page-header-bg-color) !important;
        padding-top: var(--coachpress-page-header-padding-top) !important;
        padding-bottom: var(--coachpress-page-header-padding-bottom) !important;
        padding-left: var(--coachpress-page-header-padding-left) !important;
        padding-right: var(--coachpress-page-header-padding-right) !important;
        text-align: <?php echo esc_html( get_theme_mod('coachpress_page_header_alignment', 'center') ); ?> !important;
        position: relative;
    }
    .page-banner.has-banner-image {
        color: #FFFFFF !important;
    }
    .page-banner-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.4);
        z-index: 0;
    }
    .page-banner .container { position: relative; z-index: 1; }
    .page-banner .entry-title {
        color: var(--coachpress-page-header-text-color) !important;
        <?php
        $header_font = get_theme_mod('coachpress_page_header_font');
        if ($header_font) echo "font-family: '{$header_font}', serif !important;";
        ?>
    }
    .page-banner.has-banner-image .entry-title,
    .page-banner.has-banner-image .entry-subtitle {
        color: #FFFFFF !important;
    }

    <?php
    $header_title_size_json = get_theme_mod('coachpress_page_header_title_size');
    $header_title_size = $header_title_size_json ? json_decode($header_title_size_json, true) : null;
    if ($header_title_size) : ?>
        @media (min-width: 1024px) { .page-banner .entry-title { font-size: <?php echo esc_html($header_title_size['desktop'] ?? '4rem'); ?> !important; } }
        @media (max-width: 1023px) { .page-banner .entry-title { font-size: <?php echo esc_html($header_title_size['tablet'] ?? '3rem'); ?> !important; } }
        @media (max-width: 767px) { .page-banner .entry-title { font-size: <?php echo esc_html($header_title_size['mobile'] ?? '2.5rem'); ?> !important; } }
    <?php endif; ?>

    <?php
    $header_subtitle_size_json = get_theme_mod('coachpress_page_header_subtitle_size');
    $header_subtitle_size = $header_subtitle_size_json ? json_decode($header_subtitle_size_json, true) : null;
    if ($header_subtitle_size) : ?>
        @media (min-width: 1024px) { .page-banner .entry-subtitle { font-size: <?php echo esc_html($header_subtitle_size['desktop'] ?? '1.5rem'); ?> !important; } }
        @media (max-width: 1023px) { .page-banner .entry-subtitle { font-size: <?php echo esc_html($header_subtitle_size['tablet'] ?? '1.3rem'); ?> !important; } }
        @media (max-width: 767px) { .page-banner .entry-subtitle { font-size: <?php echo esc_html($header_subtitle_size['mobile'] ?? '1.1rem'); ?> !important; } }
    <?php endif; ?>

    /* Global Link Colors */
    a { color: var(--coachpress-link-color); text-decoration: none; transition: color 0.3s ease; }
    a:hover { color: var(--coachpress-link-hover-color); }

    /* Muted Text */
    .muted-text, .entry-meta, .portfolio-item-excerpt, .team-member-bio { color: var(--coachpress-muted-text-color) !important; }

    /* Button Hovers */
    .btn:hover, .button:hover, input[type="submit"]:hover {
        background-color: var(--coachpress-button-hover-bg-color) !important;
        color: var(--coachpress-button-hover-text-color) !important;
    }

    /* Card Text Color Overrides */
    .card, .card p, .card .team-member-bio, .card .testimonial-content, .card .portfolio-item-excerpt { color: var(--coachpress-card-text-color) !important; }
    .card h1, .card h2, .card h3, .card h4, .card h5, .card h6, .card .team-member-name, .card .testimonial-author, .card .portfolio-item-title { color: var(--coachpress-card-heading-color) !important; }
    .card .team-member-role { color: var(--coachpress-accent-color) !important; }
    .card .team-member-social a { color: var(--coachpress-card-text-color) !important; }
    .card .team-member-social a:hover { color: var(--coachpress-accent-color) !important; }

    /* Team CTA Card Overrides */
    .team-cta-card, .team-cta-card h3, .team-cta-card p { color: #fff !important; }
    .team-cta-card .team-cta-icon { color: var(--coachpress-accent-color) !important; }

    /* Portfolio Specific Overrides */
    .card .portfolio-item-cat { color: var(--coachpress-accent-color) !important; }
    .card .portfolio-item-link { color: var(--coachpress-card-heading-color) !important; border-bottom-color: var(--coachpress-accent-color) !important; }
    .card .portfolio-item-link:hover { color: var(--coachpress-accent-color) !important; }

    <?php
    return ob_get_clean();
}

function coachpress_enqueue_dynamic_css() {
    wp_add_inline_style('coachpress-style', coachpress_generate_dynamic_css());
}
add_action('wp_enqueue_scripts', 'coachpress_enqueue_dynamic_css', 20);
