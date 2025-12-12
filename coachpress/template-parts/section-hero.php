<?php
/**
 * Template part for displaying the hero section
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CoachPress
 */

$bg_color = get_theme_mod( 'coachpress_hero_section_bg_color' );
$bg_image_id = get_theme_mod( 'coachpress_hero_section_bg_image' );
$bg_image = $bg_image_id ? wp_get_attachment_image_url( $bg_image_id, 'full' ) : '';
$heading_color = get_theme_mod( 'coachpress_hero_section_heading_color' );
$text_color = get_theme_mod( 'coachpress_hero_section_text_color' );
$padding = get_theme_mod( 'coachpress_hero_section_padding', json_encode( [ 'top' => '60px', 'bottom' => '60px' ] ) );
$padding_decoded = json_decode( $padding, true );
$alignment = get_theme_mod('coachpress_hero_section_alignment', 'center');

?>

<section id="hero" class="hero-section" style="background-color: <?php echo esc_attr( $bg_color ); ?>; <?php if ( $bg_image ) : ?> background-image: url(<?php echo esc_url( $bg_image ); ?>); <?php endif; ?> padding-top: <?php echo esc_attr( $padding_decoded['top'] ); ?>; padding-bottom: <?php echo esc_attr( $padding_decoded['bottom'] ); ?>;">
    <div class="container" style="text-align: <?php echo esc_attr($alignment); ?>;">
        <?php get_template_part('template-parts/content', 'hero'); ?>
    </div>
</section>
