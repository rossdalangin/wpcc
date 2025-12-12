<?php
/**
 * Template part for displaying the problem section content
 *
 * @package CoachPress
 */

$heading = get_theme_mod('coachpress_problem_heading', 'Are You Facing These Challenges?');
$content = get_theme_mod('coachpress_problem_content', 'You\'re working hard but not seeing the results you want. You feel stuck, overwhelmed, and unsure of the next steps to grow your business and achieve your goals.');
$image_id = get_theme_mod('coachpress_problem_image');

?>
<div class="problem-section-layout">
    <div class="problem-text-content" data-aos="fade-right">
        <?php if (!empty($heading)): ?>
            <h3 class="problem-heading"><?php echo esc_html($heading); ?></h3>
        <?php endif; ?>
        <?php if (!empty($content)): ?>
            <div class="problem-description">
                <?php echo wp_kses_post($content); ?>
            </div>
        <?php endif; ?>
    </div>
    <?php if ($image_id): ?>
        <div class="problem-image-content" data-aos="fade-left">
            <?php echo wp_get_attachment_image($image_id, 'large'); ?>
        </div>
    <?php endif; ?>
</div>
