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
    <div class="container" data-aos="fade-up">
        <h2><?php echo esc_html( get_theme_mod( 'coachpress_testimonials_section_title', __( 'Testimonials', 'coachpress' ) ) ); ?></h2>
        <div class="section-description" data-aos="fade-up" data-aos-delay="100">
            <?php
            $content = get_theme_mod( 'coachpress_testimonials_section_description', '' );
            echo wp_kses_post( wpautop( $content ) );
            ?>
        </div>
        <div class="swiper-container testimonial-slider">
            <div class="swiper-wrapper">
                <?php if ( $query->have_posts() ) : ?>
                    <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                        <div class="swiper-slide">
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
                        </div>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                <?php else : ?>
                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <div class="testimonial-content">
                                <blockquote><?php esc_html_e( 'Working with this coach has been a game-changer for my business. Their insights and guidance have been invaluable.', 'coachpress' ); ?></blockquote>
                                <cite><?php esc_html_e( 'John Doe, CEO', 'coachpress' ); ?></cite>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <div class="testimonial-content">
                                <blockquote><?php esc_html_e( 'I was feeling stuck in my career, but with their help, I was able to find a new path that I\'m passionate about.', 'coachpress' ); ?></blockquote>
                                <cite><?php esc_html_e( 'Jane Smith, Marketing Manager', 'coachpress' ); ?></cite>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <div class="testimonial-content">
                                <blockquote><?php esc_html_e( 'The best investment I\'ve made in myself. I\'ve seen a huge improvement in my confidence and overall well-being.', 'coachpress' ); ?></blockquote>
                                <cite><?php esc_html_e( 'Peter Jones, Entrepreneur', 'coachpress' ); ?></cite>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>
