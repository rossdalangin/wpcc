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

// CTA Controls
$cta_title = get_theme_mod('coachpress_team_cta_title', 'Join Our Elite Network');
$cta_desc = get_theme_mod('coachpress_team_cta_desc', 'We are always looking for visionary leaders to join our growing collective.');
$cta_btn_text = get_theme_mod('coachpress_team_cta_btn_text', 'Get in Touch');
$cta_btn_type = get_theme_mod('coachpress_team_cta_btn_type', 'url');

if ($query->have_posts()): ?>
    <div class="team-wrapper">
        <div class="team-grid grid-4-col">
        <?php while($query->have_posts()): $query->the_post(); ?>
            <div class="team-item card height-100" data-aos="fade-up">
                <?php if(has_post_thumbnail()): ?>
                    <div class="team-image">
                        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium'); ?></a>
                    </div>
                <?php endif; ?>
                <div class="team-content">
                    <h3 class="team-member-name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <p class="team-member-role"><?php echo esc_html( get_post_meta( get_the_ID(), '_team_member_role', true ) ?: 'Consultant' ); ?></p>
                    <div class="team-member-excerpt"><?php the_excerpt(); ?></div>
                    <a href="<?php the_permalink(); ?>" class="btn-link" style="margin-bottom: 20px;"><?php _e('View Profile', 'coachpress'); ?></a>

                    <div class="team-member-social">
                        <a href="#" aria-label="LinkedIn"><i class="fa fa-linkedin"></i></a>
                        <a href="#" aria-label="Twitter"><i class="fa fa-twitter"></i></a>
                    </div>
                </div>
            </div>
        <?php endwhile; wp_reset_postdata(); ?>

        <?php if (!empty($cta_title)) : ?>
            <div class="team-item team-cta-card card height-100" data-aos="fade-up">
                <div class="team-cta-inner">
                    <div class="team-cta-icon"><i class="fa fa-users"></i></div>
                    <h3><?php echo esc_html($cta_title); ?></h3>
                    <p><?php echo wp_kses_post($cta_desc); ?></p>

                    <?php if ( 'url' === $cta_btn_type ) : ?>
                        <?php $cta_url = get_theme_mod('coachpress_team_cta_btn_url', '#contact'); ?>
                        <a href="<?php echo esc_url($cta_url); ?>" class="btn-link"><?php echo esc_html($cta_btn_text); ?></a>
                    <?php elseif ( 'html' === $cta_btn_type ) : ?>
                        <?php echo wp_kses_post( get_theme_mod('coachpress_team_cta_btn_html') ); ?>
                    <?php elseif ( 'shortcode' === $cta_btn_type ) : ?>
                        <?php echo do_shortcode( get_theme_mod('coachpress_team_cta_btn_shortcode') ); ?>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
        </div>
    </div>
<?php endif; ?>
