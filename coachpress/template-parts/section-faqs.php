<?php
/**
 * Template part for displaying the faqs section
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CoachPress
 */

$args = array(
    'post_type' => 'faqs',
    'posts_per_page' => -1,
);
$query = new WP_Query( $args );
?>

<section id="faqs" class="faqs-section">
    <div class="container">
        <h2><?php echo esc_html( get_theme_mod( 'coachpress_faqs_section_title', __( 'FAQs', 'coachpress' ) ) ); ?></h2>
        <div class="faqs-grid">
            <?php if ( $query->have_posts() ) : ?>
                <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                    <div class="faq-item">
                        <div class="faq-content">
                            <h3><?php the_title(); ?></h3>
                            <?php the_content(); ?>
                        </div>
                    </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            <?php else : ?>
                <p><?php esc_html_e( 'No FAQs found.', 'coachpress' ); ?></p>
            <?php endif; ?>
        </div>
    </div>
</section>
