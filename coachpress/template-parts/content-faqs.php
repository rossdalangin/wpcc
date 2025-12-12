<?php
/**
 * Template part for displaying the faqs section content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CoachPress
 */

$query_args = [
    'post_type' => 'faqs',
    'posts_per_page' => -1,
];

$selected_posts = get_theme_mod('coachpress_faqs_posts');
if (!empty($selected_posts)) {
    $query_args['post__in'] = $selected_posts;
    $query_args['orderby'] = 'post__in';
}

$query = new WP_Query($query_args);

if ($query->have_posts()): ?>
    <div class="faqs-grid">
    <?php while($query->have_posts()): $query->the_post(); ?>
        <div class="grid-item" data-aos="fade-up">
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
