<?php
/**
 * Template part for displaying the contact section content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CoachPress
 */

$form_type = get_theme_mod('coachpress_contact_page_form_type', 'shortcode');

if ($form_type === 'html') {
    $html_content = get_theme_mod('coachpress_contact_page_html');
    if (!empty($html_content)) {
        echo '<div class="contact-form-wrapper">' . wp_kses_post($html_content) . '</div>';
    }
} else {
    $shortcode = get_theme_mod('coachpress_contact_page_shortcode');
    if (!empty($shortcode)) {
        echo '<div class="contact-form-wrapper">' . do_shortcode($shortcode) . '</div>';
    }
}
