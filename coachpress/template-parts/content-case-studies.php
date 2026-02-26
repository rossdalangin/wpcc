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
        <article class="case-study-item-wrap" data-aos="fade-up">
            <div class="case-study-item-inner card <?php echo !has_post_thumbnail() ? 'no-thumbnail' : ''; ?>">
                <div class="case-study-featured-image">
                    <a href="<?php the_permalink(); ?>">
                        <?php if(has_post_thumbnail()): ?>
                            <?php the_post_thumbnail('large'); ?>
                        <?php else: ?>
                            <div class="case-study-placeholder"></div>
                        <?php endif; ?>
                    </a>
                </div>

                <div class="case-study-item-content">
                    <span class="case-study-item-cat"><?php _e('Case Study', 'coachpress'); ?></span>
                    <h3 class="case-study-item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <div class="case-study-item-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></div>
                    <a href="<?php the_permalink(); ?>" class="case-study-item-link"><?php _e('Read Case Study', 'coachpress'); ?> <i class="fa fa-arrow-right"></i></a>
                </div>
            </div>
        </article>
    <?php endwhile; wp_reset_postdata(); ?>
    </div>
<?php endif; ?>
