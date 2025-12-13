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
    }

    <?php
    // Hero Button
    ?>
    #hero .btn {
        --btn-bg-color: <?php echo esc_html( get_theme_mod('coachpress_hero_button_bg_color', '#0D2F4F') ); ?>;
        --btn-text-color: <?php echo esc_html( get_theme_mod('coachpress_hero_button_text_color', '#FFFFFF') ); ?>;
        --btn-hover-bg-color: <?php echo esc_html( get_theme_mod('coachpress_hero_button_hover_bg_color', '#FFC107') ); ?>;
        --btn-hover-text-color: <?php echo esc_html( get_theme_mod('coachpress_hero_button_hover_text_color', '#0D2F4F') ); ?>;
        --btn-border-radius: <?php echo esc_html( get_theme_mod('coachpress_hero_button_border_radius', '4px') ); ?>;
    }
    <?php
    // About Button
    ?>
    #about-preview .btn {
        --btn-bg-color: <?php echo esc_html( get_theme_mod('coachpress_about-preview_button_bg_color', '#0D2F4F') ); ?>;
        --btn-text-color: <?php echo esc_html( get_theme_mod('coachpress_about-preview_button_text_color', '#FFFFFF') ); ?>;
        --btn-hover-bg-color: <?php echo esc_html( get_theme_mod('coachpress_about-preview_button_hover_bg_color', '#FFC107') ); ?>;
        --btn-hover-text-color: <?php echo esc_html( get_theme_mod('coachpress_about-preview_button_hover_text_color', '#0D2F4F') ); ?>;
        --btn-border-radius: <?php echo esc_html( get_theme_mod('coachpress_about-preview_button_border_radius', '4px') ); ?>;
    }
    <?php
    // CTA Button
    ?>
    #cta .btn {
        --btn-bg-color: <?php echo esc_html( get_theme_mod('coachpress_cta_button_bg_color', '#FFFFFF') ); ?>;
        --btn-text-color: <?php echo esc_html( get_theme_mod('coachpress_cta_button_text_color', '#0D2F4F') ); ?>;
        --btn-hover-bg-color: <?php echo esc_html( get_theme_mod('coachpress_cta_button_hover_bg_color', '#FFC107') ); ?>;
        --btn-hover-text-color: <?php echo esc_html( get_theme_mod('coachpress_cta_button_hover_text_color', '#0D2F4F') ); ?>;
        --btn-border-radius: <?php echo esc_html( get_theme_mod('coachpress_cta_button_border_radius', '4px') ); ?>;
    }

    <?php
    // Responsive Font Sizes
    $body_font_size = json_decode(get_theme_mod('coachpress_body_font_size', json_encode(array('desktop' => '16px', 'tablet' => '16px', 'mobile' => '15px'))), true);
    ?>
    :root {
        --coachpress-body-font-size-desktop: <?php echo esc_html($body_font_size['desktop']); ?>;
        --coachpress-body-font-size-tablet: <?php echo esc_html($body_font_size['tablet']); ?>;
        --coachpress-body-font-size-mobile: <?php echo esc_html($body_font_size['mobile']); ?>;
    }
    <?php
    for ( $i = 1; $i <= 6; $i++ ) {
        $default_sizes = array('desktop' => '1rem', 'tablet' => '1rem', 'mobile' => '1rem'); // Simplified default
        $font_sizes = json_decode(get_theme_mod("coachpress_h{$i}_font_size", json_encode($default_sizes)), true);
        ?>
        :root {
            --coachpress-h<?php echo $i; ?>-font-size-desktop: <?php echo esc_html($font_sizes['desktop']); ?>;
            --coachpress-h<?php echo $i; ?>-font-size-tablet: <?php echo esc_html($font_sizes['tablet']); ?>;
            --coachpress-h<?php echo $i; ?>-font-size-mobile: <?php echo esc_html($font_sizes['mobile']); ?>;
        }
        <?php
    }

    // JSON encoded values (padding, margin, border-radius)
    $card_padding = json_decode(get_theme_mod('coachpress_card_padding', json_encode(array('top' => '20px', 'right' => '20px', 'bottom' => '20px', 'left' => '20px'))), true);
    $card_margin = json_decode(get_theme_mod('coachpress_card_margin', json_encode(array('top' => '0', 'right' => '0', 'bottom' => '20px', 'left' => '0'))), true);
    $image_border_radius = json_decode(get_theme_mod('coachpress_image_border_radius', json_encode(array('top-left' => '0px', 'top-right' => '0px', 'bottom-right' => '0px', 'bottom-left' => '0px'))), true);
    ?>
    :root {
        --coachpress-card-padding-top: <?php echo esc_html($card_padding['top']); ?>;
        --coachpress-card-padding-right: <?php echo esc_html($card_padding['right']); ?>;
        --coachpress-card-padding-bottom: <?php echo esc_html($card_padding['bottom']); ?>;
        --coachpress-card-padding-left: <?php echo esc_html($card_padding['left']); ?>;

        --coachpress-card-margin-top: <?php echo esc_html($card_margin['top']); ?>;
        --coachpress-card-margin-right: <?php echo esc_html($card_margin['right']); ?>;
        --coachpress-card-margin-bottom: <?php echo esc_html($card_margin['bottom']); ?>;
        --coachpress-card-margin-left: <?php echo esc_html($card_margin['left']); ?>;
    }
    img, .wp-post-image {
        border-top-left-radius: <?php echo esc_html($image_border_radius['top-left']); ?>;
        border-top-right-radius: <?php echo esc_html($image_border_radius['top-right']); ?>;
        border-bottom-right-radius: <?php echo esc_html($image_border_radius['bottom-right']); ?>;
        border-bottom-left-radius: <?php echo esc_html($image_border_radius['bottom-left']); ?>;
    }
    <?php

    // Per-section styles
    $sections = coachpress_get_section_choices();
    foreach ( $sections as $section_id => $section_name ) {
        $section_selector = ".homepage-section#{$section_id}";

        // Padding
        $padding_json = get_theme_mod("coachpress_{$section_id}_padding");
        if($padding_json) {
            $padding = json_decode($padding_json, true);
            echo "{$section_selector} {
                padding-top: " . esc_html($padding['top']) . ";
                padding-bottom: " . esc_html($padding['bottom']) . ";
                padding-left: " . esc_html($padding['left']) . ";
                padding-right: " . esc_html($padding['right']) . ";
            }";
        }

        // Alignment
        $alignment = get_theme_mod("coachpress_{$section_id}_text_alignment");
        if($alignment) {
            echo "{$section_selector} .section-inner { text-align: " . esc_attr($alignment) . "; }";
        }

        // Background color
        $bg_color = get_theme_mod("coachpress_{$section_id}_bg_color");
        if(!empty($bg_color) && get_theme_mod("coachpress_{$section_id}_bg_type", 'color') === 'color') {
             echo "{$section_selector} { background: " . esc_attr($bg_color) . "; }";
        }

        // Heading color
        $heading_color = get_theme_mod("coachpress_{$section_id}_heading_color");
        if(!empty($heading_color)) {
            echo "{$section_selector} h2, {$section_selector} h3 { color: " . esc_attr($heading_color) . "; }";
        }

        // Text color
        $text_color = get_theme_mod("coachpress_{$section_id}_text_color");
        if(!empty($text_color)) {
            echo "{$section_selector}, {$section_selector} p, {$section_selector} div { color: " . esc_attr($text_color) . "; }";
        }

        // Background Overlay
        $bg_type = get_theme_mod("coachpress_{$section_id}_bg_type");
        if($bg_type === 'image' || $bg_type === 'video') {
            $overlay_color = get_theme_mod("coachpress_{$section_id}_bg_overlay_color");
            if(!empty($overlay_color)) {
                echo "{$section_selector} .section-background-overlay { background-color: " . esc_attr($overlay_color) . "; }";
            }
        }
    }

    $css = ob_get_clean();
    wp_add_inline_style('coachpress-style', $css);
}
add_action('wp_enqueue_scripts', 'coachpress_dynamic_css', 20);
