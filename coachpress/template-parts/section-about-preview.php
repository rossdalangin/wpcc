<?php
/**
 * Template part for displaying the About Preview section
 *
 * @package CoachPress
 */
?>

<section id="about-preview" class="about-preview-section text-section">
    <div class="container">
        <h2 data-aos="fade-up"><?php echo esc_html( get_theme_mod( 'coachpress_about_preview_section_title', __( 'Practical experience. Calm guidance.', 'coachpress' ) ) ); ?></h2>
        <div class="section-description" data-aos="fade-up" data-aos-delay="100">
            <?php
            $content = get_theme_mod( 'coachpress_about_preview_section_description', __( "My background spans consulting, advisory work, and leadership support across technology, professional services, and executive environments.\n\nClients work with me because I help them think clearly, decide confidently, and move forward with purpose.", 'coachpress' ) );
            echo wp_kses_post( wpautop( $content ) );
            ?>
        </div>
    </div>
</section>
