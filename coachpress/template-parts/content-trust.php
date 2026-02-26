<?php
/**
 * Template part for displaying the trust section content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CoachPress
 */

$selected_partners = get_theme_mod('coachpress_partners_posts');
$trust_image_id = get_theme_mod('coachpress_trust_image');

$args = array(
    'post_type'      => 'partners',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
);

if (!empty($selected_partners)) {
    $args['post__in'] = $selected_partners;
    $args['orderby'] = 'post__in';
}

$partners_query = new WP_Query($args);

if ($partners_query->have_posts()) : ?>
    <div class="partners-grid" data-aos="fade-up">
        <?php while ($partners_query->have_posts()) : $partners_query->the_post(); ?>
            <div class="partner-logo">
                <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('full', array('alt' => get_the_title())); ?>
                <?php else : ?>
                    <span class="partner-name"><?php the_title(); ?></span>
                <?php endif; ?>
            </div>
        <?php endwhile; wp_reset_postdata(); ?>
    </div>
<?php elseif ($trust_image_id): ?>
    <div class="trust-image-wrapper" data-aos="fade-up">
        <?php echo wp_get_attachment_image($trust_image_id, 'full'); ?>
    </div>
<?php else : ?>
    <?php if (is_customize_preview()) : ?>
        <p class="customize-placeholder"><?php _e('Add Partners or upload a Trust Logos Image in the Customizer.', 'coachpress'); ?></p>
    <?php endif; ?>
<?php endif; ?>
