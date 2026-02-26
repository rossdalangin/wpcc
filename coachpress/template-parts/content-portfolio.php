<?php
/**
 * Template part for displaying the portfolio section content
 *
 * @package CoachPress
 */

$query_args = [
    'post_type' => 'portfolio',
    'posts_per_page' => -1,
];

$selected_posts = get_theme_mod('coachpress_portfolio_posts');
if (!empty($selected_posts)) {
    $query_args['post__in'] = (array)$selected_posts;
    $query_args['orderby'] = 'post__in';
} else {
    $query_args['posts_per_page'] = 6;
}

$query = new WP_Query($query_args);

if ($query->have_posts()): ?>
    <div class="portfolio-grid grid-3-col">
    <?php while($query->have_posts()): $query->the_post(); ?>
        <article class="portfolio-item-wrap" data-aos="fade-up">
            <div class="portfolio-item-inner card <?php echo !has_post_thumbnail() ? 'no-thumbnail' : ''; ?>">
                <div class="portfolio-featured-image">
                    <a href="<?php the_permalink(); ?>">
                        <?php if(has_post_thumbnail()): ?>
                            <?php the_post_thumbnail('large'); ?>
                        <?php else: ?>
                            <div class="portfolio-placeholder"></div>
                        <?php endif; ?>
                    </a>
                </div>

                <div class="portfolio-item-content">
                    <span class="portfolio-item-cat"><?php echo esc_html( get_post_meta( get_the_ID(), '_portfolio_category', true ) ?: 'Strategy' ); ?></span>
                    <h3 class="portfolio-item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <div class="portfolio-item-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></div>
                    <a href="<?php the_permalink(); ?>" class="portfolio-item-link"><?php _e('Explore Project', 'coachpress'); ?> <i class="fa fa-arrow-right"></i></a>
                </div>
            </div>
        </article>
    <?php endwhile; wp_reset_postdata(); ?>
    </div>
<?php else: ?>
    <div class="no-posts-found">
        <p><?php _e('No portfolio items found. Add some in the dashboard or via the Maintenance tool.', 'coachpress'); ?></p>
    </div>
<?php endif; ?>
