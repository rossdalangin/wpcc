<?php
/**
 * Template part for displaying the case-studies section content
 *
 * @package CoachPress
 */

$query_args = [
    'post_type' => 'case-studies',
    'posts_per_page' => -1,
];

$selected_posts = get_theme_mod('coachpress_case-studies_posts');
if (!empty($selected_posts)) {
    $query_args['post__in'] = (array)$selected_posts;
    $query_args['orderby'] = 'post__in';
} else {
    $query_args['posts_per_page'] = 3;
}

$query = new WP_Query($query_args);

if ($query->have_posts()): ?>
    <div class="case-studies-grid grid-3-col">
    <?php while($query->have_posts()): $query->the_post(); ?>
        <div class="case-study-item card" data-aos="fade-up">
            <?php if(has_post_thumbnail()): ?>
                <div class="item-image">
                    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium'); ?></a>
                </div>
            <?php endif; ?>
            <div class="item-content">
                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <div class="item-excerpt">
                    <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                </div>
                <a href="<?php the_permalink(); ?>" class="btn-link"><?php _e('Read Case Study', 'coachpress'); ?> <i class="fa fa-arrow-right"></i></a>
            </div>
        </div>
    <?php endwhile; wp_reset_postdata(); ?>
    </div>
<?php endif; ?>
