<?php
/**
 * Template part for displaying the faqs section content
 *
 * @package CoachPress
 */

$query_args = [
    'post_type' => 'faqs',
    'posts_per_page' => -1,
];

$selected_posts = get_theme_mod('coachpress_faqs_posts');
if (!empty($selected_posts)) {
    $query_args['post__in'] = (array)$selected_posts;
    $query_args['orderby'] = 'post__in';
} else {
    $query_args['posts_per_page'] = 5;
}

$query = new WP_Query($query_args);

if ($query->have_posts()): ?>
    <div class="faq-accordion faq-container">
    <?php while($query->have_posts()): $query->the_post(); ?>
        <div class="faq-item" data-aos="fade-up">
            <h3><?php the_title(); ?></h3>
            <div class="faq-content">
                <?php the_content(); ?>
            </div>
        </div>
    <?php endwhile; wp_reset_postdata(); ?>
    </div>
<?php endif; ?>
