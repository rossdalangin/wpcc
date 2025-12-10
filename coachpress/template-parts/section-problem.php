<?php
/**
 * Template part for displaying the Problem section
 *
 * @package CoachPress
 */
?>

<section id="problem" class="problem-section text-section">
    <div class="container">
        <h2 data-aos="fade-up"><?php echo esc_html( get_theme_mod( 'coachpress_problem_section_title', __( 'You don’t have a motivation problem. You have a clarity problem.', 'coachpress' ) ) ); ?></h2>
        <div class="section-description" data-aos="fade-up" data-aos-delay="100">
            <?php
            $content = get_theme_mod( 'coachpress_problem_section_description', __( "Most professionals are not stuck because they lack skill or effort. They’re stuck because priorities are unclear, options are overwhelming, and strategic decisions feel unnecessarily difficult.\n\nMy work focuses on removing noise, identifying what actually matters, and turning insight into action—without pressure or hype.", 'coachpress' ) );
            echo wp_kses_post( wpautop( $content ) );
            ?>
        </div>
    </div>
</section>
