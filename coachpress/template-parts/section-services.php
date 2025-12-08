<?php
/**
 * Template part for displaying the services section
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CoachPress
 */

$args = array(
    'post_type' => 'services',
    'posts_per_page' => -1,
);
$query = new WP_Query( $args );
?>

<section id="services" class="services-section">
    <div class="container">
        <h2 data-aos="fade-up"><?php echo esc_html( get_theme_mod( 'coachpress_services_section_title', __( 'Services', 'coachpress' ) ) ); ?></h2>
        <div class="services-grid">
            <?php if ( $query->have_posts() ) : ?>
                <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                    <div class="service-item" data-aos="fade-up" data-aos-delay="<?php echo esc_attr( $query->current_post * 100 ); ?>">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="service-image">
                                <?php the_post_thumbnail( 'medium' ); ?>
                            </div>
                        <?php endif; ?>
                        <div class="service-content">
                            <h3><?php the_title(); ?></h3>
                            <?php the_content(); ?>
                        </div>
                    </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            <?php else : ?>
                <p><?php esc_html_e( 'No services found.', 'coachpress' ); ?></p>
            <?php endif; ?>
        </div>
    </div>
</section>
