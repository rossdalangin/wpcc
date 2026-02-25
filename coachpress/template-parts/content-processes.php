<?php
/**
 * Template part for displaying the processes section content
 *
 * @package CoachPress
 */

$query_args = [
    'post_type' => 'processes',
    'posts_per_page' => -1,
];

$query = new WP_Query($query_args);

if ($query->have_posts()): ?>
    <div class="processes-grid grid-3-col">
    <?php while($query->have_posts()): $query->the_post(); ?>
        <div class="process-item card" data-aos="fade-up">
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
