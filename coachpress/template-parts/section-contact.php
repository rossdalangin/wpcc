<?php
/**
 * Template part for displaying the contact section
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CoachPress
 */

?>

<section id="contact" class="contact-section">
    <div class="container">
        <h2><?php echo esc_html( get_theme_mod( 'coachpress_contact_section_title', __( 'Contact', 'coachpress' ) ) ); ?></h2>
        <?php
        if ( 'html' === get_theme_mod( 'coachpress_contact_form_type', 'shortcode' ) ) {
            echo wp_kses_post( get_theme_mod( 'coachpress_contact_form_html', '' ) );
        } else {
            echo do_shortcode( get_theme_mod( 'coachpress_contact_form_shortcode', '' ) );
        }
        ?>
    </div>
</section>
