<?php
/**
 * Template part for displaying the hero section content
 *
 * @package CoachPress
 */

$right_col_type = get_theme_mod('coachpress_hero_right_col_type', 'image');
$container_class = ($right_col_type === 'none') ? 'hero-container-full' : 'hero-container';
$left_col_align = get_theme_mod('coachpress_hero_left_col_align', 'left');

?>
<div class="<?php echo esc_attr($container_class); ?>">
    <div class="hero-left" style="text-align: <?php echo esc_attr($left_col_align); ?>">
        <h1><?php echo esc_html(get_theme_mod('coachpress_hero_heading', __('Unlock Your Potential', 'coachpress'))); ?></h1>
        <div class="section-description">
            <?php echo wp_kses_post(get_theme_mod('coachpress_hero_subheading', __('Partner with a dedicated coach to achieve your personal and professional goals.', 'coachpress'))); ?>
        </div>
        <div class="hero-cta">
            <a href="<?php echo esc_url(get_theme_mod('coachpress_hero_cta_url', '#contact')); ?>" class="btn btn-primary"><?php echo esc_html(get_theme_mod('coachpress_hero_cta_text', 'Book a Free Call')); ?></a>
            <?php if (get_theme_mod('coachpress_hero_cta_2_visibility', false)) : ?>
                <a href="<?php echo esc_url(get_theme_mod('coachpress_hero_cta_2_url', '#')); ?>" class="btn btn-secondary"><?php echo esc_html(get_theme_mod('coachpress_hero_cta_2_text', 'Learn More')); ?></a>
            <?php endif; ?>
        </div>
    </div>

    <?php if ($right_col_type !== 'none') : ?>
        <div class="hero-right">
            <?php
            switch ($right_col_type) {
                case 'image':
                    $image_id = get_theme_mod('coachpress_hero_right_col_image');
                    if ($image_id) {
                        echo wp_get_attachment_image($image_id, 'large');
                    }
                    break;
                case 'video':
                    $video_url = get_theme_mod('coachpress_hero_right_col_video');
                    if ($video_url) {
                        // Simple oEmbed
                        echo wp_oembed_get($video_url);
                    }
                    break;
                case 'html':
                    echo wp_kses_post(get_theme_mod('coachpress_hero_right_col_html', ''));
                    break;
                case 'shortcode':
                    echo do_shortcode(get_theme_mod('coachpress_hero_right_col_shortcode', ''));
                    break;
            }
            ?>
        </div>
    <?php endif; ?>
</div>
