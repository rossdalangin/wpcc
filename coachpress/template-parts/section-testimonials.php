<?php
/**
 * Template part for displaying the testimonials section
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CoachPress
 */

$args = array(
    'post_type' => 'testimonials',
    'posts_per_page' => -1,
);
$query = new WP_Query( $args );
?>

<section id="testimonials" class="testimonials-section">
    <div class="container">
        <h2><?php echo esc_html( get_theme_mod( 'coachpress_testimonials_section_title', __( 'Testimonials', 'coachpress' ) ) ); ?></h2>
        <div class="testimonials-grid">
            <?php if ( $query->have_posts() ) : ?>
                <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                    <div class="testimonial-item">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="testimonial-image">
                                <?php the_post_thumbnail( 'thumbnail' ); ?>
                            </div>
                        <?php endif; ?>
                        <div class="testimonial-content">
                            <blockquote><?php the_content(); ?></blockquote>
                            <cite><?php the_title(); ?></cite>
                        </div>
                    </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            <?php else : ?>
                <p><?php esc_html_e( 'No testimonials found.', 'coachpress' ); ?></p>
            <?php endif; ?>
        </div>
    </div>
</section>
