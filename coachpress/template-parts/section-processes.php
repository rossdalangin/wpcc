<?php
/**
 * Template part for displaying the processes section
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CoachPress
 */

$args = array(
    'post_type' => 'processes',
    'posts_per_page' => -1,
);
$query = new WP_Query( $args );
?>

<section id="processes" class="processes-section">
    <div class="container">
        <h2 data-aos="fade-up"><?php echo esc_html( get_theme_mod( 'coachpress_processes_section_title', __( 'Processes', 'coachpress' ) ) ); ?></h2>
        <div class="section-description" data-aos="fade-up" data-aos-delay="100">
            <?php
            $content = get_theme_mod( 'coachpress_processes_section_description', '' );
            echo wp_kses_post( wpautop( $content ) );
            ?>
        </div>
        <div class="processes-grid">
            <?php if ( $query->have_posts() ) : ?>
                <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                    <div class="process-item" data-aos="fade-up" data-aos-delay="<?php echo esc_attr( $query->current_post * 100 ); ?>">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="process-image">
                                <?php the_post_thumbnail( 'medium' ); ?>
                            </div>
                        <?php endif; ?>
                        <div class="process-content">
                            <h3><?php the_title(); ?></h3>
                            <?php the_content(); ?>
                        </div>
                    </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            <?php else : ?>
                <div class="process-item" data-aos="fade-up" data-aos-delay="0">
                    <div class="process-content">
                        <h3><?php esc_html_e( 'Step 1: Discovery Call', 'coachpress' ); ?></h3>
                        <p><?php esc_html_e( 'We start with a free discovery call to understand your goals and determine if we\'re a good fit.', 'coachpress' ); ?></p>
                    </div>
                </div>
                <div class="process-item" data-aos="fade-up" data-aos-delay="100">
                    <div class="process-content">
                        <h3><?php esc_html_e( 'Step 2: Strategy Session', 'coachpress' ); ?></h3>
                        <p><?php esc_html_e( 'We\'ll develop a customized coaching plan tailored to your specific needs and objectives.', 'coachpress' ); ?></p>
                    </div>
                </div>
                <div class="process-item" data-aos="fade-up" data-aos-delay="200">
                    <div class="process-content">
                        <h3><?php esc_html_e( 'Step 3: Ongoing Support', 'coachpress' ); ?></h3>
                        <p><?php esc_html_e( 'We provide ongoing support and accountability to help you stay on track and achieve your goals.', 'coachpress' ); ?></p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
