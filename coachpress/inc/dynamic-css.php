<?php
/**
 * Dynamic CSS
 *
 * @package CoachPress
 */

function coachpress_dynamic_css() {
    $css = ':root {';

    // Global Colors
    $css .= '--coachpress-primary-color: ' . get_theme_mod('coachpress_primary_color', '#0D2F4F') . ';';
    $css .= '--coachpress-secondary-color: ' . get_theme_mod('coachpress_secondary_color', '#F5F5F5') . ';';
    $css .= '--coachpress-accent-color: ' . get_theme_mod('coachpress_accent_color', '#FFC107') . ';';
    $css .= '--coachpress-text-color: ' . get_theme_mod('coachpress_text_color', '#333333') . ';';
    $css .= '--coachpress-dark-bg-color: ' . get_theme_mod('coachpress_dark_bg_color', '#1A1A1A') . ';';

    // Typography
    $css .= '--coachpress-body-font: ' . get_theme_mod('coachpress_body_font', 'Lato') . ';';
    $css .= '--coachpress-heading-font: ' . get_theme_mod('coachpress_heading_font', 'Lora') . ';';

    // Per-section settings
    $sections = coachpress_get_section_choices();
    foreach($sections as $section_id => $section_name) {
        // Background
        $bg_type = get_theme_mod("coachpress_{$section_id}_bg_type", 'color');
        if ($bg_type === 'color') {
            $bg_color = get_theme_mod("coachpress_{$section_id}_bg_color");
            if (!empty($bg_color)) {
                $css .= "--coachpress-{$section_id}-bg-color: {$bg_color};";
            }
        }

        // Colors
        $heading_color = get_theme_mod("coachpress_{$section_id}_heading_color");
        if (!empty($heading_color)) {
            $css .= "--coachpress-{$section_id}-heading-color: {$heading_color};";
        }
        $text_color = get_theme_mod("coachpress_{$section_id}_text_color");
        if (!empty($text_color)) {
            $css .= "--coachpress-{$section_id}-text-color: {$text_color};";
        }
    }

    $css .= '}';

    wp_add_inline_style('coachpress-style', $css);
}
add_action('wp_enqueue_scripts', 'coachpress_dynamic_css');
