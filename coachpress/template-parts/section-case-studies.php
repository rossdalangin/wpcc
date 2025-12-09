<?php
/**
 * Template part for displaying the case studies section
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CoachPress
 */

$args = array(
    'post_type' => 'case-studies',
    'posts_per_page' => -1,
);
$query = new WP_Query( $args );
?>

<section id="case-studies" class="case-studies-section">
    <div class="container">
        <h2 data-aos="fade-up"><?php echo esc_html( get_theme_mod( 'coachpress_case-studies_section_title', __( 'Case Studies', 'coachpress' ) ) ); ?></h2>
        <div class="case-studies-grid">
            <?php if ( $query->have_posts() ) : ?>
                <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                    <div class="case-study-item" data-aos="fade-up" data-aos-delay="<?php echo esc_attr( $query->current_post * 100 ); ?>">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="case-study-image">
                                <?php the_post_thumbnail( 'medium' ); ?>
                            </div>
                        <?php endif; ?>
                        <div class="case-study-content">
                            <h3><?php the_title(); ?></h3>
                            <?php the_content(); ?>
                        </div>
                    </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            <?php else : ?>
                <div class="case-study-item" data-aos="fade-up" data-aos-delay="0">
                    <div class="case-study-content">
                        <h3><?php esc_html_e( 'Case Study: 10x Growth for a Startup', 'coachpress' ); ?></h3>
                        <p><?php esc_html_e( 'Learn how we helped a tech startup increase their revenue by 10x in just one year through strategic business coaching.', 'coachpress' ); ?></p>
                    </div>
                </div>
                <div class="case-study-item" data-aos="fade-up" data-aos-delay="100">
                    <div class="case-study-content">
                        <h3><?php esc_html_e( 'Case Study: Career Transition Success', 'coachpress' ); ?></h3>
                        <p><?php esc_html_e( 'Discover how we guided a client through a successful career change, resulting in a 20% salary increase and greater job satisfaction.', 'coachpress' ); ?></p>
                    </div>
                </div>
                <div class="case-study-item" data-aos="fade-up" data-aos-delay="200">
                    <div class="case-study-content">
                        <h3><?php esc_html_e( 'Case Study: From Burnout to Balance', 'coachpress' ); ?></h3>
                        <p><?php esc_html_e( 'See how we helped a client overcome burnout and create a more balanced and fulfilling life through personalized life coaching.', 'coachpress' ); ?></p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
