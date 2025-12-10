<?php
/**
 * Template part for displaying the CTA section
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CoachPress
 */

?>

<section id="cta" class="cta-section">
    <div class="container" data-aos="fade-up" style="text-align: <?php echo esc_attr( get_theme_mod( 'coachpress_cta_alignment', 'center' ) ); ?>;">
        <h2><?php echo esc_html( get_theme_mod( 'coachpress_cta_heading', __( 'Ready to get started?', 'coachpress' ) ) ); ?></h2>
        <p><?php echo esc_html( get_theme_mod( 'coachpress_cta_subheading', __( 'Contact us today to get started on your journey to success.', 'coachpress' ) ) ); ?></p>
        <a href="<?php echo esc_url( get_theme_mod( 'coachpress_cta_button_url', '#' ) ); ?>" class="button button-primary"><?php echo esc_html( get_theme_mod( 'coachpress_cta_button_text', __( 'Contact Us', 'coachpress' ) ) ); ?></a>
    </div>
</section>
