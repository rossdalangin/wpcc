<?php
/**
 * Template part for displaying the Trust section
 *
 * @package CoachPress
 */
?>

<section id="trust" class="trust-section text-section">
    <div class="container">
        <h2 data-aos="fade-up"><?php echo esc_html( get_theme_mod( 'coachpress_trust_section_title', __( 'Trusted by professionals who value clarity', 'coachpress' ) ) ); ?></h2>
        <div class="section-description" data-aos="fade-up" data-aos-delay="100">
            <?php
            $content = get_theme_mod( 'coachpress_trust_section_description', __( 'Over a decade of experience helping professionals simplify complexity, align strategy with reality, and make confident decisions across technology, legal, leadership, and advisory environments.', 'coachpress' ) );
            echo wp_kses_post( wpautop( $content ) );
            ?>
        </div>
    </div>
</section>
