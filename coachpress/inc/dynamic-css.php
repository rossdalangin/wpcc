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
        echo "--coachpress-body-font-size-desktop: " . esc_html($body_font_size['desktop']) . ";";
        echo "--coachpress-body-font-size-tablet: " . esc_html($body_font_size['tablet']) . ";";
        echo "--coachpress-body-font-size-mobile: " . esc_html($body_font_size['mobile']) . ";";

        for ( $i = 1; $i <= 6; $i++ ) {
            $default_sizes = array('desktop' => '1rem', 'tablet' => '1rem', 'mobile' => '1rem'); // Simplified default
            $font_sizes = json_decode(get_theme_mod("coachpress_h{$i}_font_size", json_encode($default_sizes)), true);
            echo "--coachpress-h{$i}-font-size-desktop: " . esc_html($font_sizes['desktop']) . ";";
            echo "--coachpress-h{$i}-font-size-tablet: " . esc_html($font_sizes['tablet']) . ";";
            echo "--coachpress-h{$i}-font-size-mobile: " . esc_html($font_sizes['mobile']) . ";";
        }
        ?>

        /* Cards */
        --coachpress-card-bg-color: <?php echo esc_html( get_theme_mod('coachpress_card_bg_color', '#FFFFFF') ); ?>;
        --coachpress-card-border-radius: <?php echo esc_html( get_theme_mod('coachpress_card_border_radius', '4px') ); ?>;
        --coachpress-card-box-shadow: <?php echo esc_html( get_theme_mod('coachpress_card_box_shadow', '0 0 25px rgba(0,0,0,0.07)') ); ?>;
        --coachpress-card-hover-box-shadow: <?php echo esc_html( get_theme_mod('coachpress_card_hover_box_shadow', '0 12px 25px rgba(0,0,0,0.1)') ); ?>;

        /* Forms */
        --coachpress-form-field-bg-color: <?php echo esc_html( get_theme_mod('coachpress_form_field_bg_color', '#FFFFFF') ); ?>;
        --coachpress-form-field-text-color: <?php echo esc_html( get_theme_mod('coachpress_form_field_text_color', '#333333') ); ?>;
        --coachpress-form-field-border-color: <?php echo esc_html( get_theme_mod('coachpress_form_field_border_color', '#CCCCCC') ); ?>;
        --coachpress-form-field-border-radius: <?php echo esc_html( get_theme_mod('coachpress_form_field_border_radius', '4px') ); ?>;

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

        /* Hero Button */
        --coachpress-hero-button-bg-color: <?php echo esc_html( get_theme_mod('coachpress_hero_button_bg_color', '#0D2F4F') ); ?>;
        --coachpress-hero-button-text-color: <?php echo esc_html( get_theme_mod('coachpress_hero_button_text_color', '#FFFFFF') ); ?>;
        --coachpress-hero-button-hover-bg-color: <?php echo esc_html( get_theme_mod('coachpress_hero_button_hover_bg_color', '#FFC107') ); ?>;
        --coachpress-hero-button-hover-text-color: <?php echo esc_html( get_theme_mod('coachpress_hero_button_hover_text_color', '#0D2F4F') ); ?>;
        --coachpress-hero-button-border-radius: <?php echo esc_html( get_theme_mod('coachpress_hero_button_border_radius', '4px') ); ?>;

        /* About Button */
        --coachpress-about-preview-button-bg-color: <?php echo esc_html( get_theme_mod('coachpress_about-preview_button_bg_color', '#0D2F4F') ); ?>;
        --coachpress-about-preview-button-text-color: <?php echo esc_html( get_theme_mod('coachpress_about-preview_button_text_color', '#FFFFFF') ); ?>;
        --coachpress-about-preview-button-hover-bg-color: <?php echo esc_html( get_theme_mod('coachpress_about-preview_button_hover_bg_color', '#FFC107') ); ?>;
        --coachpress-about-preview-button-hover-text-color: <?php echo esc_html( get_theme_mod('coachpress_about-preview_button_hover_text_color', '#0D2F4F') ); ?>;
        --coachpress-about-preview-button-border-radius: <?php echo esc_html( get_theme_mod('coachpress_about-preview_button_border_radius', '4px') ); ?>;

        /* CTA Button */
        --coachpress-cta-button-bg-color: <?php echo esc_html( get_theme_mod('coachpress_cta_button_bg_color', '#FFFFFF') ); ?>;
        --coachpress-cta-button-text-color: <?php echo esc_html( get_theme_mod('coachpress_cta_button_text_color', '#0D2F4F') ); ?>;
        --coachpress-cta-button-hover-bg-color: <?php echo esc_html( get_theme_mod('coachpress_cta_button_hover_bg_color', '#FFC107') ); ?>;
        --coachpress-cta-button-hover-text-color: <?php echo esc_html( get_theme_mod('coachpress_cta_button_hover_text_color', '#0D2F4F') ); ?>;
        --coachpress-cta-button-border-radius: <?php echo esc_html( get_theme_mod('coachpress_cta_button_border_radius', '4px') ); ?>;
    }
    <?php
    $css = ob_get_clean();
    wp_add_inline_style('coachpress-style', $css);
}
add_action('wp_head', 'coachpress_dynamic_css');
