<?php
/**
 * Template part for displaying the team section content
 *
 * @package CoachPress
 */

$query_args = [
    'post_type' => 'team',
    'posts_per_page' => -1,
];

$query = new WP_Query($query_args);

if ($query->have_posts()): ?>
    <div class="team-grid grid-4-col">
    <?php while($query->have_posts()): $query->the_post(); ?>
        <div class="team-item card" data-aos="fade-up">
            <?php if(has_post_thumbnail()): ?>
                <div class="team-image">
                    <?php the_post_thumbnail('medium'); ?>
                </div>
            <?php endif; ?>
            <div class="team-content">
                <h3><?php the_title(); ?></h3>
                <div class="team-member-bio"><?php the_excerpt(); ?></div>
            </div>
        </div>
    <?php endwhile; wp_reset_postdata(); ?>
    </div>
<?php endif; ?>
