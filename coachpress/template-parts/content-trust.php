<?php
/**
 * Template part for displaying the trust section content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CoachPress
 */

$trust_image_id = get_theme_mod('coachpress_trust_image');

if ($trust_image_id): ?>
    <div class="trust-image-wrapper" data-aos="fade-up">
        <?php echo wp_get_attachment_image($trust_image_id, 'full'); ?>
    </div>
<?php endif; ?>
