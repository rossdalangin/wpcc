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
        --coachpress-dark-bg-color: #1a202c;

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
        --coachpress-card-bg-color: <?php echo esc_html( get_theme_mod('coachpress_card_bg_color', '#FFFFFF') ); ?>;
        --coachpress-card-border-radius: <?php echo esc_html( get_theme_mod('coachpress_card_border_radius', '12px') ); ?>;

        <?php
        $card_padding = json_decode(get_theme_mod('coachpress_card_padding', json_encode(array('top' => '40px', 'right' => '40px', 'bottom' => '40px', 'left' => '40px'))), true);
        echo "--coachpress-card-padding-top: " . esc_html($card_padding['top'] ?? '40px') . ";";
        echo "--coachpress-card-padding-right: " . esc_html($card_padding['right'] ?? '40px') . ";";
        echo "--coachpress-card-padding-bottom: " . esc_html($card_padding['bottom'] ?? '40px') . ";";
        echo "--coachpress-card-padding-left: " . esc_html($card_padding['left'] ?? '40px') . ";";
        ?>

        /* Header & Footer */
        --coachpress-header-bg-color: #FFFFFF;
        --coachpress-header-cta-bg-color: #1a365d;
        --coachpress-header-cta-text-color: #FFFFFF;

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
        $alignment = get_theme_mod("coachpress_{$section_id}_text_alignment", ($section_id === 'cta' || $section_id === 'testimonials' || $section_id === 'trust' ? 'center' : 'left'));
        $padding_json = get_theme_mod("coachpress_{$section_id}_padding");
        $padding = $padding_json ? json_decode($padding_json, true) : null;
        $heading_color = get_theme_mod("coachpress_{$section_id}_heading_color");
        $text_color = get_theme_mod("coachpress_{$section_id}_text_color");
        $overlay_color = get_theme_mod("coachpress_{$section_id}_bg_overlay_color", 'rgba(26,54,93,0.85)');
        ?>
        .section-<?php echo esc_attr($section_id); ?> {
            text-align: <?php echo esc_html($alignment); ?>;
            <?php if ($padding) : ?>
                padding-top: <?php echo esc_html($padding['top'] ?? '100px'); ?>;
                padding-bottom: <?php echo esc_html($padding['bottom'] ?? '100px'); ?>;
                padding-left: <?php echo esc_html($padding['left'] ?? '0'); ?>;
                padding-right: <?php echo esc_html($padding['right'] ?? '0'); ?>;
            <?php else : ?>
                padding-top: 100px;
                padding-bottom: 100px;
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

    <?php
    return ob_get_clean();
}

function coachpress_enqueue_dynamic_css() {
    wp_add_inline_style('coachpress-style', coachpress_generate_dynamic_css());
}
add_action('wp_enqueue_scripts', 'coachpress_enqueue_dynamic_css', 20);
