<?php
/**
 * Template part for displaying the about-preview section content
 *
 * @package CoachPress
 */

$heading = get_theme_mod('coachpress_about-preview_heading', 'Your Coach & Partner');
$content = get_theme_mod('coachpress_about-preview_content', 'With over a decade of experience in the industry, I am dedicated to helping professionals like you navigate challenges, unlock opportunities, and achieve sustainable growth. My mission is to empower you with the strategies and mindset needed to thrive.');
$image_id = get_theme_mod('coachpress_about-preview_image');
$button_text = get_theme_mod('coachpress_about-preview_button_text', 'Learn More About Me');
$button_url = get_theme_mod('coachpress_about-preview_button_url', '#');

?>
<div class="about-preview-section-layout">
    <?php if ($image_id): ?>
        <div class="about-preview-image-content" data-aos="fade-right">
            <?php echo wp_get_attachment_image($image_id, 'large'); ?>
        </div>
    <?php endif; ?>
    <div class="about-preview-text-content" data-aos="fade-left">
        <?php if (!empty($content)): ?>
            <div class="about-preview-description">
                <?php echo wp_kses_post($content); ?>
            </div>
        <?php endif; ?>
        <?php if (!empty($button_text) && !empty($button_url)): ?>
            <a href="<?php echo esc_url($button_url); ?>" class="btn"><?php echo esc_html($button_text); ?></a>
        <?php endif; ?>
    </div>
</div>
