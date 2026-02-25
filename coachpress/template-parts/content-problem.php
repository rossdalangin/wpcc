<?php
/**
 * Template part for displaying the problem section content
 *
 * @package CoachPress
 */

$content = get_theme_mod('coachpress_problem_content', 'You have mastered your craft, yet you feel like your growth has hit a ceiling. The traditional strategies that got you here are no longer enough to propel you forward. You are working harder, but the impact and income remain stagnant.');
$image_id = get_theme_mod('coachpress_problem_image');

?>
<div class="problem-section-layout">
    <div class="problem-text-content" data-aos="fade-right">
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
