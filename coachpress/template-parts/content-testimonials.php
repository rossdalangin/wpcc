<?php
/**
 * Template part for displaying the testimonials section content
 *
 * @package CoachPress
 */

$query_args = [
    'post_type' => 'testimonials',
    'posts_per_page' => -1,
];

$selected_posts = get_theme_mod('coachpress_testimonials_posts');
if (!empty($selected_posts)) {
    $query_args['post__in'] = (array)$selected_posts;
    $query_args['orderby'] = 'post__in';
} else {
    $query_args['posts_per_page'] = 3;
}

$query = new WP_Query($query_args);

if ($query->have_posts()): ?>
    <div class="testimonial-slider swiper-container">
        <div class="swiper-wrapper">
            <?php while($query->have_posts()): $query->the_post(); ?>
                <div class="swiper-slide testimonial-item card" data-aos="fade-up">
                    <?php if(has_post_thumbnail()): ?>
                        <div class="testimonial-image">
                            <?php the_post_thumbnail('thumbnail'); ?>
                        </div>
                    <?php endif; ?>
                    <div class="testimonial-content">
                        <?php the_content(); ?>
                    </div>
                    <div class="testimonial-author">
                        <?php the_title(); ?>
                    </div>
                </div>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
        <div class="swiper-pagination"></div>
    </div>
<?php endif; ?>
