<?php
/**
 * Dynamic CSS
 *
 * @package CoachPress
 */

function coachpress_dynamic_css() {
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
        --coachpress-body-font-weight: <?php echo esc_html( get_theme_mod('coachpress_body_font_weight', '400') ); ?>;
        --coachpress-body-line-height: <?php echo esc_html( get_theme_mod('coachpress_body_line_height', '1.6') ); ?>;
        --coachpress-heading-font: '<?php echo esc_html( get_theme_mod('coachpress_heading_font', 'Lora') ); ?>', serif;
        --coachpress-heading-font-weight: <?php echo esc_html( get_theme_mod('coachpress_heading_font_weight', '700') ); ?>;
        --coachpress-heading-letter-spacing: <?php echo esc_html( get_theme_mod('coachpress_heading_letter_spacing', '1px') ); ?>;

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
        --coachpress-card-border-radius: <?php echo esc_html( get_theme_mod('coachpress_card_border_radius', '4px') ); ?>;
        --coachpress-card-box-shadow: <?php echo esc_html( get_theme_mod('coachpress_card_box_shadow', '0 0 25px rgba(0,0,0,0.07)') ); ?>;
        --coachpress-card-hover-box-shadow: <?php echo esc_html( get_theme_mod('coachpress_card_hover_box_shadow', '0 12px 25px rgba(0,0,0,0.1)') ); ?>;
        <?php
        $card_padding = json_decode(get_theme_mod('coachpress_card_padding', json_encode(array('top' => '20px', 'right' => '20px', 'bottom' => '20px', 'left' => '20px'))), true);
        echo "--coachpress-card-padding-top: " . esc_html($card_padding['top'] ?? '20px') . ";";
        echo "--coachpress-card-padding-right: " . esc_html($card_padding['right'] ?? '20px') . ";";
        echo "--coachpress-card-padding-bottom: " . esc_html($card_padding['bottom'] ?? '20px') . ";";
        echo "--coachpress-card-padding-left: " . esc_html($card_padding['left'] ?? '20px') . ";";

        $card_margin = json_decode(get_theme_mod('coachpress_card_margin', json_encode(array('top' => '0', 'right' => '0', 'bottom' => '20px', 'left' => '0'))), true);
        echo "--coachpress-card-margin-top: " . esc_html($card_margin['top'] ?? '0') . ";";
        echo "--coachpress-card-margin-right: " . esc_html($card_margin['right'] ?? '0') . ";";
        echo "--coachpress-card-margin-bottom: " . esc_html($card_margin['bottom'] ?? '20px') . ";";
        echo "--coachpress-card-margin-left: " . esc_html($card_margin['left'] ?? '0') . ";";
        ?>

        /* Forms */
        --coachpress-form-field-bg-color: <?php echo esc_html( get_theme_mod('coachpress_form_field_bg_color', '#FFFFFF') ); ?>;
        --coachpress-form-field-text-color: <?php echo esc_html( get_theme_mod('coachpress_form_field_text_color', '#333333') ); ?>;
        --coachpress-form-field-border-color: <?php echo esc_html( get_theme_mod('coachpress_form_field_border_color', '#CCCCCC') ); ?>;
        --coachpress-form-field-border-radius: <?php echo esc_html( get_theme_mod('coachpress_form_field_border_radius', '4px') ); ?>;
        --coachpress-form-width: <?php echo esc_html( get_theme_mod('coachpress_form_width', '100%') ); ?>;

        /* Images */
        <?php
        $img_radius = json_decode(get_theme_mod('coachpress_image_border_radius', json_encode(array('top-left' => '0px', 'top-right' => '0px', 'bottom-right' => '0px', 'bottom-left' => '0px'))), true);
        echo "--coachpress-image-border-radius-top-left: " . esc_html($img_radius['top-left'] ?? '0px') . ";";
        echo "--coachpress-image-border-radius-top-right: " . esc_html($img_radius['top-right'] ?? '0px') . ";";
        echo "--coachpress-image-border-radius-bottom-right: " . esc_html($img_radius['bottom-right'] ?? '0px') . ";";
        echo "--coachpress-image-border-radius-bottom-left: " . esc_html($img_radius['bottom-left'] ?? '0px') . ";";
        ?>
        --coachpress-image-width: <?php echo esc_html( get_theme_mod('coachpress_image_width', '100%') ); ?>;

        /* Layout */
        --coachpress-container-width: <?php echo esc_html( get_theme_mod('coachpress_container_width', '1140px') ); ?>;

        /* Header */
        --coachpress-header-bg-color: <?php echo esc_html( get_theme_mod('coachpress_header_bg_color', '#FFFFFF') ); ?>;
        --coachpress-header-text-color: <?php echo esc_html( get_theme_mod('coachpress_header_text_color', '#333333') ); ?>;
        --coachpress-header-link-color: <?php echo esc_html( get_theme_mod('coachpress_header_link_color', '#0D2F4F') ); ?>;
        --coachpress-header-link-hover-color: <?php echo esc_html( get_theme_mod('coachpress_header_link_hover_color', '#FFC107') ); ?>;
        --coachpress-header-padding-y: <?php echo esc_html( get_theme_mod('coachpress_header_padding_y', '15px') ); ?>;
        --coachpress-header-hamburger-color: <?php echo esc_html( get_theme_mod('coachpress_header_hamburger_color', '#333333') ); ?>;
        --coachpress-mobile-menu-bg-color: <?php echo esc_html( get_theme_mod('coachpress_mobile_menu_bg_color', '#FFFFFF') ); ?>;
        --coachpress-mobile-menu-link-color: <?php echo esc_html( get_theme_mod('coachpress_mobile_menu_link_color', '#0D2F4F') ); ?>;
        --coachpress-mobile-menu-hover-bg-color: <?php echo esc_html( get_theme_mod('coachpress_mobile_menu_hover_bg_color', '#F5F5F5') ); ?>;

        /* Header CTA */
        --coachpress-header-cta-bg-color: <?php echo esc_html( get_theme_mod('coachpress_header_cta_bg_color', '#0D2F4F') ); ?>;
        --coachpress-header-cta-text-color: <?php echo esc_html( get_theme_mod('coachpress_header_cta_text_color', '#FFFFFF') ); ?>;
        --coachpress-header-cta-hover-bg-color: <?php echo esc_html( get_theme_mod('coachpress_header_cta_hover_bg_color', '#FFC107') ); ?>;
        --coachpress-header-cta-hover-text-color: <?php echo esc_html( get_theme_mod('coachpress_header_cta_hover_text_color', '#0D2F4F') ); ?>;
        --coachpress-header-cta-border-radius: <?php echo esc_html( get_theme_mod('coachpress_header_cta_border_radius', '4px') ); ?>;

        /* Footer */
        --coachpress-footer-bg-color: <?php echo esc_html( get_theme_mod('coachpress_footer_bg_color', '#1A1A1A') ); ?>;
        --coachpress-footer-text-color: <?php echo esc_html( get_theme_mod('coachpress_footer_text_color', '#FFFFFF') ); ?>;
        --coachpress-footer-link-color: <?php echo esc_html( get_theme_mod('coachpress_footer_link_color', '#FFFFFF') ); ?>;
        --coachpress-footer-link-hover-color: <?php echo esc_html( get_theme_mod('coachpress_footer_link_hover_color', '#FFC107') ); ?>;
        --coachpress-footer-padding-y: <?php echo esc_html( get_theme_mod('coachpress_footer_padding_y', '60px') ); ?>;

        /* Buttons (Section Specific Overrides are handled below in loop) */
        --coachpress-hero-button-bg-color: <?php echo esc_html( get_theme_mod('coachpress_hero_button_bg_color', '#0D2F4F') ); ?>;
        --coachpress-hero-button-text-color: <?php echo esc_html( get_theme_mod('coachpress_hero_button_text_color', '#FFFFFF') ); ?>;
        --coachpress-hero-button-hover-bg-color: <?php echo esc_html( get_theme_mod('coachpress_hero_button_hover_bg_color', '#FFC107') ); ?>;
        --coachpress-hero-button-hover-text-color: <?php echo esc_html( get_theme_mod('coachpress_hero_button_hover_text_color', '#0D2F4F') ); ?>;
        --coachpress-hero-button-border-radius: <?php echo esc_html( get_theme_mod('coachpress_hero_button_border_radius', '4px') ); ?>;

        --coachpress-about-preview-button-bg-color: <?php echo esc_html( get_theme_mod('coachpress_about-preview_button_bg_color', '#0D2F4F') ); ?>;
        --coachpress-about-preview-button-text-color: <?php echo esc_html( get_theme_mod('coachpress_about-preview_button_text_color', '#FFFFFF') ); ?>;
        --coachpress-about-preview-button-hover-bg-color: <?php echo esc_html( get_theme_mod('coachpress_about-preview_button_hover_bg_color', '#FFC107') ); ?>;
        --coachpress-about-preview-button-hover-text-color: <?php echo esc_html( get_theme_mod('coachpress_about-preview_button_hover_text_color', '#0D2F4F') ); ?>;
        --coachpress-about-preview-button-border-radius: <?php echo esc_html( get_theme_mod('coachpress_about-preview_button_border_radius', '4px') ); ?>;

        --coachpress-cta-button-bg-color: <?php echo esc_html( get_theme_mod('coachpress_cta_button_bg_color', '#FFFFFF') ); ?>;
        --coachpress-cta-button-text-color: <?php echo esc_html( get_theme_mod('coachpress_cta_button_text_color', '#0D2F4F') ); ?>;
        --coachpress-cta-button-hover-bg-color: <?php echo esc_html( get_theme_mod('coachpress_cta_button_hover_bg_color', '#FFC107') ); ?>;
        --coachpress-cta-button-hover-text-color: <?php echo esc_html( get_theme_mod('coachpress_cta_button_hover_text_color', '#0D2F4F') ); ?>;
        --coachpress-cta-button-border-radius: <?php echo esc_html( get_theme_mod('coachpress_cta_button_border_radius', '4px') ); ?>;
    }

    <?php
    // Section Specific Styles
    $sections = coachpress_get_section_choices();
    foreach ($sections as $section_id => $name) :
        $alignment = get_theme_mod("coachpress_{$section_id}_text_alignment", ($section_id === 'cta' || $section_id === 'testimonials' ? 'center' : 'left'));
        $padding = json_decode(get_theme_mod("coachpress_{$section_id}_padding"), true);
        $heading_color = get_theme_mod("coachpress_{$section_id}_heading_color");
        $text_color = get_theme_mod("coachpress_{$section_id}_text_color");
        $overlay_color = get_theme_mod("coachpress_{$section_id}_bg_overlay_color", 'rgba(0,0,0,0.5)');
        ?>
        #<?php echo esc_attr($section_id); ?> {
            text-align: <?php echo esc_html($alignment); ?>;
            <?php if ($padding) : ?>
                padding-top: <?php echo esc_html($padding['top'] ?? '60px'); ?>;
                padding-bottom: <?php echo esc_html($padding['bottom'] ?? '60px'); ?>;
                padding-left: <?php echo esc_html($padding['left'] ?? '0'); ?>;
                padding-right: <?php echo esc_html($padding['right'] ?? '0'); ?>;
            <?php endif; ?>
        }
        <?php if ($heading_color) : ?>
            #<?php echo esc_attr($section_id); ?> h1,
            #<?php echo esc_attr($section_id); ?> h2,
            #<?php echo esc_attr($section_id); ?> h3,
            #<?php echo esc_attr($section_id); ?> h4,
            #<?php echo esc_attr($section_id); ?> h5,
            #<?php echo esc_attr($section_id); ?> h6 { color: <?php echo esc_html($heading_color); ?>; }
        <?php endif; ?>
        <?php if ($text_color) : ?>
            #<?php echo esc_attr($section_id); ?>,
            #<?php echo esc_attr($section_id); ?> p,
            #<?php echo esc_attr($section_id); ?> .section-description { color: <?php echo esc_html($text_color); ?>; }
        <?php endif; ?>
        #<?php echo esc_attr($section_id); ?> .section-background-overlay {
            background-color: <?php echo esc_html($overlay_color); ?>;
        }
    <?php endforeach; ?>

    img {
        border-radius: var(--coachpress-image-border-radius-top-left) var(--coachpress-image-border-radius-top-right) var(--coachpress-image-border-radius-bottom-right) var(--coachpress-image-border-radius-bottom-left);
        width: var(--coachpress-image-width);
    }
    form { width: var(--coachpress-form-width); }

    <?php
    $css = ob_get_clean();
    wp_add_inline_style('coachpress-style', $css);
}
add_action('wp_head', 'coachpress_dynamic_css');
