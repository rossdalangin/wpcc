<?php
/**
 * Theme Shortcodes
 *
 * @package CoachPress
 */

/**
 * Display a theme section via shortcode
 * Usage: [coachpress_section id="services"]
 */
function coachpress_section_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'id' => '',
    ), $atts, 'coachpress_section' );

    if ( empty( $atts['id'] ) ) {
        return '';
    }

    ob_start();
    coachpress_display_section( $atts['id'] );
    return ob_get_clean();
}
add_shortcode( 'coachpress_section', 'coachpress_section_shortcode' );
