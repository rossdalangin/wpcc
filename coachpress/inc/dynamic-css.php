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
        --coachpress-primary-color: <?php echo esc_html( get_theme_mod('coachpress_primary_color', '#0D2F4F') ); ?>;
        --coachpress-secondary-color: <?php echo esc_html( get_theme_mod('coachpress_secondary_color', '#F5F5F5') ); ?>;
        --coachpress-accent-color: <?php echo esc_html( get_theme_mod('coachpress_accent_color', '#FFC107') ); ?>;
        --coachpress-text-color: <?php echo esc_html( get_theme_mod('coachpress_text_color', '#333333') ); ?>;
        --coachpress-dark-bg-color: <?php echo esc_html( get_theme_mod('coachpress_dark_bg_color', '#1A1A1A') ); ?>;

        /* Global Typography */
        --coachpress-body-font: '<?php echo esc_html( get_theme_mod('coachpress_body_font', 'Lato') ); ?>', sans-serif;
        --coachpress-body-font-weight: 400;
        --coachpress-body-line-height: 1.6;
        --coachpress-heading-font: '<?php echo esc_html( get_theme_mod('coachpress_heading_font', 'Lora') ); ?>', serif;
        --coachpress-heading-font-weight: 700;
        --coachpress-heading-letter-spacing: 1px;

        <?php
        // Responsive Font Sizes
        $body_font_size = json_decode(get_theme_mod('coachpress_body_font_size', json_encode(array('desktop' => '16px', 'tablet' => '16px', 'mobile' => '15px'))), true);
        echo "--coachpress-body-font-size-desktop: " . esc_html($body_font_size['desktop'] ?? '16px') . ";";
        echo "--coachpress-body-font-size-tablet: " . esc_html($body_font_size['tablet'] ?? '16px') . ";";
        echo "--coachpress-body-font-size-mobile: " . esc_html($body_font_size['mobile'] ?? '15px') . ";";

        for ( $i = 1; $i <= 6; $i++ ) {
            $default_sizes = array('desktop' => '1rem', 'tablet' => '1rem', 'mobile' => '1rem');
            $font_sizes = json_decode(get_theme_mod("coachpress_h{$i}_font_size", json_encode($default_sizes)), true);
            echo "--coachpress-h{$i}-font-size-desktop: " . esc_html($font_sizes['desktop'] ?? '1rem') . ";";
            echo "--coachpress-h{$i}-font-size-tablet: " . esc_html($font_sizes['tablet'] ?? '1rem') . ";";
            echo "--coachpress-h{$i}-font-size-mobile: " . esc_html($font_sizes['mobile'] ?? '1rem') . ";";
        }
        ?>

        /* Cards */
        --coachpress-card-bg-color: <?php echo esc_html( get_theme_mod('coachpress_card_bg_color', '#FFFFFF') ); ?>;
        --coachpress-card-border-radius: <?php echo esc_html( get_theme_mod('coachpress_card_border_radius', '8px') ); ?>;
        --coachpress-card-box-shadow: 0 0 25px rgba(0,0,0,0.07);
        --coachpress-card-hover-box-shadow: 0 12px 25px rgba(0,0,0,0.1);
        <?php
        $card_padding = json_decode(get_theme_mod('coachpress_card_padding', json_encode(array('top' => '30px', 'right' => '30px', 'bottom' => '30px', 'left' => '30px'))), true);
        echo "--coachpress-card-padding-top: " . esc_html($card_padding['top'] ?? '30px') . ";";
        echo "--coachpress-card-padding-right: " . esc_html($card_padding['right'] ?? '30px') . ";";
        echo "--coachpress-card-padding-bottom: " . esc_html($card_padding['bottom'] ?? '30px') . ";";
        echo "--coachpress-card-padding-left: " . esc_html($card_padding['left'] ?? '30px') . ";";

        $card_margin = json_decode(get_theme_mod('coachpress_card_margin', json_encode(array('top' => '0', 'right' => '0', 'bottom' => '0', 'left' => '0'))), true);
        echo "--coachpress-card-margin-top: " . esc_html($card_margin['top'] ?? '0') . ";";
        echo "--coachpress-card-margin-right: " . esc_html($card_margin['right'] ?? '0') . ";";
        echo "--coachpress-card-margin-bottom: " . esc_html($card_margin['bottom'] ?? '0') . ";";
        echo "--coachpress-card-margin-left: " . esc_html($card_margin['left'] ?? '0') . ";";
        ?>

        /* Forms */
        --coachpress-form-field-bg-color: #FFFFFF;
        --coachpress-form-field-text-color: #333333;
        --coachpress-form-field-border-color: #DDDDDD;
        --coachpress-form-field-border-radius: 4px;
        --coachpress-form-width: 100%;

        /* Images */
        <?php
        $img_radius = json_decode(get_theme_mod('coachpress_image_border_radius', json_encode(array('top-left' => '8px', 'top-right' => '8px', 'bottom-right' => '8px', 'bottom-left' => '8px'))), true);
        echo "--coachpress-image-border-radius-top-left: " . esc_html($img_radius['top-left'] ?? '8px') . ";";
        echo "--coachpress-image-border-radius-top-right: " . esc_html($img_radius['top-right'] ?? '8px') . ";";
        echo "--coachpress-image-border-radius-bottom-right: " . esc_html($img_radius['bottom-right'] ?? '8px') . ";";
        echo "--coachpress-image-border-radius-bottom-left: " . esc_html($img_radius['bottom-left'] ?? '8px') . ";";
        ?>
        --coachpress-image-width: 100%;

        /* Layout */
        --coachpress-container-width: <?php echo esc_html( get_theme_mod('coachpress_container_width', '1200px') ); ?>;

        /* Header */
        --coachpress-header-bg-color: <?php echo esc_html( get_theme_mod('coachpress_header_bg_color', '#FFFFFF') ); ?>;
        --coachpress-header-text-color: #333333;
        --coachpress-header-link-color: #0D2F4F;
        --coachpress-header-link-hover-color: #FFC107;
        --coachpress-header-padding-y: 15px;
        --coachpress-header-hamburger-color: #333333;
        --coachpress-mobile-menu-bg-color: #FFFFFF;
        --coachpress-mobile-menu-link-color: #0D2F4F;
        --coachpress-mobile-menu-hover-bg-color: #F5F5F5;

        /* Header CTA */
        --coachpress-header-cta-bg-color: <?php echo esc_html( get_theme_mod('coachpress_header_cta_bg_color', '#0D2F4F') ); ?>;
        --coachpress-header-cta-text-color: #FFFFFF;
        --coachpress-header-cta-hover-bg-color: #FFC107;
        --coachpress-header-cta-hover-text-color: #0D2F4F;
        --coachpress-header-cta-border-radius: 4px;

        /* Footer */
        --coachpress-footer-bg-color: #1A1A1A;
        --coachpress-footer-text-color: #FFFFFF;
        --coachpress-footer-link-color: #FFFFFF;
        --coachpress-footer-link-hover-color: #FFC107;
        --coachpress-footer-padding-y: 60px;

        /* Default Section Values */
        --coachpress-section-padding-top: 80px;
        --coachpress-section-padding-bottom: 80px;
    }

    <?php
    // Section Specific Styles
    $sections = coachpress_get_section_choices();
    foreach ($sections as $section_id => $name) :
        $alignment = get_theme_mod("coachpress_{$section_id}_text_alignment", ($section_id === 'cta' || $section_id === 'testimonials' ? 'center' : 'left'));
        $padding_json = get_theme_mod("coachpress_{$section_id}_padding");
        $padding = $padding_json ? json_decode($padding_json, true) : null;
        $heading_color = get_theme_mod("coachpress_{$section_id}_heading_color");
        $text_color = get_theme_mod("coachpress_{$section_id}_text_color");
        $overlay_color = get_theme_mod("coachpress_{$section_id}_bg_overlay_color", 'rgba(0,0,0,0.5)');
        ?>
        .section-<?php echo esc_attr($section_id); ?> {
            text-align: <?php echo esc_html($alignment); ?>;
            <?php if ($padding) : ?>
                padding-top: <?php echo esc_html($padding['top'] ?? '80px'); ?>;
                padding-bottom: <?php echo esc_html($padding['bottom'] ?? '80px'); ?>;
                padding-left: <?php echo esc_html($padding['left'] ?? '0'); ?>;
                padding-right: <?php echo esc_html($padding['right'] ?? '0'); ?>;
            <?php else: ?>
                padding-top: var(--coachpress-section-padding-top);
                padding-bottom: var(--coachpress-section-padding-bottom);
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
        .section-<?php echo esc_attr($section_id); ?> .section-background-overlay {
            background-color: <?php echo esc_html($overlay_color); ?>;
        }
    <?php endforeach; ?>

    img {
        border-radius: var(--coachpress-image-border-radius-top-left) var(--coachpress-image-border-radius-top-right) var(--coachpress-image-border-radius-bottom-right) var(--coachpress-image-border-radius-bottom-left);
    }

    <?php
    return ob_get_clean();
}

function coachpress_enqueue_dynamic_css() {
    $dynamic_css = coachpress_generate_dynamic_css();
    wp_add_inline_style('coachpress-style', $dynamic_css);
}
add_action('wp_enqueue_scripts', 'coachpress_enqueue_dynamic_css', 20);
