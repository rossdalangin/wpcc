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
$cta_text = get_theme_mod('coachpress_team_cta_text', 'Join Our Elite Network');
$cta_url = get_theme_mod('coachpress_team_cta_url', '#contact');

if ($query->have_posts()): ?>
    <div class="team-wrapper">
        <div class="team-grid grid-4-col">
        <?php while($query->have_posts()): $query->the_post(); ?>
            <div class="team-item card" data-aos="fade-up">
                <?php if(has_post_thumbnail()): ?>
                    <div class="team-image">
                        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium'); ?></a>
                    </div>
                <?php endif; ?>
                <div class="team-content">
                    <h3 class="team-member-name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <p class="team-member-role"><?php echo esc_html( get_post_meta( get_the_ID(), '_team_member_role', true ) ?: 'Consultant' ); ?></p>
                    <div class="team-member-bio"><?php the_excerpt(); ?></div>
                    <a href="<?php the_permalink(); ?>" class="btn-link" style="margin-bottom: 20px;"><?php _e('View Profile', 'coachpress'); ?></a>

                    <div class="team-member-social">
                        <a href="#" aria-label="LinkedIn"><i class="fa fa-linkedin"></i></a>
                        <a href="#" aria-label="Twitter"><i class="fa fa-twitter"></i></a>
                    </div>
                </div>
            </div>
        <?php endwhile; wp_reset_postdata(); ?>

        <?php if (!empty($cta_text)) : ?>
            <div class="team-item team-cta-card card" data-aos="fade-up">
                <div class="team-cta-inner">
                    <div class="team-cta-icon"><i class="fa fa-users"></i></div>
                    <h3><?php echo esc_html($cta_text); ?></h3>
                    <p><?php _e('We are always looking for visionary leaders to join our growing collective.', 'coachpress'); ?></p>
                    <a href="<?php echo esc_url($cta_url); ?>" class="btn-link"><?php _e('Get in Touch', 'coachpress'); ?></a>
                </div>
            </div>
        <?php endif; ?>
        </div>
    </div>
<?php endif; ?>
