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

$selected_posts = get_theme_mod('coachpress_team_posts');
if (!empty($selected_posts)) {
    $query_args['post__in'] = (array)$selected_posts;
    $query_args['orderby'] = 'post__in';
} else {
    $query_args['posts_per_page'] = 4;
}

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
                <h3 class="team-member-name"><?php the_title(); ?></h3>
                <p class="team-member-role"><?php echo esc_html( get_post_meta( get_the_ID(), '_team_member_role', true ) ?: 'Consultant' ); ?></p>
                <div class="team-member-bio"><?php the_excerpt(); ?></div>

                <div class="team-member-social">
                    <a href="#" aria-label="LinkedIn"><i class="fa fa-linkedin"></i></a>
                    <a href="#" aria-label="Twitter"><i class="fa fa-twitter"></i></a>
                </div>
            </div>
        </div>
    <?php endwhile; wp_reset_postdata(); ?>
    </div>
<?php endif; ?>
