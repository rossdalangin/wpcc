<?php
/**
 * Template part for displaying the services section content
 *
 * @package CoachPress
 */

$query_args = [
    'post_type' => 'services',
    'posts_per_page' => -1,
];

$selected_posts = get_theme_mod('coachpress_services_posts');
if (!empty($selected_posts)) {
    $query_args['post__in'] = (array)$selected_posts;
    $query_args['orderby'] = 'post__in';
} else {
    $query_args['posts_per_page'] = 3;
}

$query = new WP_Query($query_args);

if ($query->have_posts()): ?>
    <div class="services-grid grid-3-col">
    <?php while($query->have_posts()): $query->the_post(); ?>
        <div class="service-item card" data-aos="fade-up">
            <?php if(has_post_thumbnail()): ?>
                <div class="item-image">
                    <?php the_post_thumbnail('medium'); ?>
                </div>
            <?php endif; ?>
            <div class="item-content">
                <h3><?php the_title(); ?></h3>
                <?php the_content(); ?>
            </div>
        </div>
    <?php endwhile; wp_reset_postdata(); ?>
    </div>
<?php endif; ?>
