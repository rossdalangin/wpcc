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
        <h2 data-aos="fade-up"><?php echo esc_html( get_theme_mod( 'coachpress_faqs_section_title', __( 'FAQs', 'coachpress' ) ) ); ?></h2>
        <div class="section-description" data-aos="fade-up" data-aos-delay="100">
            <?php
            $content = get_theme_mod( 'coachpress_faqs_section_description', '' );
            echo wp_kses_post( wpautop( $content ) );
            ?>
        </div>
        <div class="faqs-grid">
            <?php if ( $query->have_posts() ) : ?>
                <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                    <div class="faq-item" data-aos="fade-up" data-aos-delay="<?php echo esc_attr( $query->current_post * 100 ); ?>">
                        <h3><?php the_title(); ?></h3>
                        <div class="faq-content">
                            <?php the_content(); ?>
                        </div>
                    </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            <?php else : ?>
                <div class="faq-item" data-aos="fade-up" data-aos-delay="0">
                    <h3><?php esc_html_e( 'What is coaching?', 'coachpress' ); ?></h3>
                    <div class="faq-content">
                        <p><?php esc_html_e( 'Coaching is a partnership between a coach and a client that helps the client to achieve their personal and professional goals.', 'coachpress' ); ?></p>
                    </div>
                </div>
                <div class="faq-item" data-aos="fade-up" data-aos-delay="100">
                    <h3><?php esc_html_e( 'Who is coaching for?', 'coachpress' ); ?></h3>
                    <div class="faq-content">
                        <p><?php esc_html_e( 'Coaching is for anyone who wants to improve their life, whether that\'s in their career, relationships, or personal growth.', 'coachpress' ); ?></p>
                    </div>
                </div>
                <div class="faq-item" data-aos="fade-up" data-aos-delay="200">
                    <h3><?php esc_html_e( 'How long does coaching last?', 'coachpress' ); ?></h3>
                    <div class="faq-content">
                        <p><?php esc_html_e( 'The length of a coaching engagement varies depending on the client\'s goals and needs. We offer a range of packages to suit different budgets and timelines.', 'coachpress' ); ?></p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
