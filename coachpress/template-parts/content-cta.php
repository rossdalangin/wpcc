<?php
/**
 * Template part for displaying the CTA section content
 *
 * @package CoachPress
 */

$button_text = get_theme_mod('coachpress_cta_button_text', 'Get Started');
$button_url = get_theme_mod('coachpress_cta_button_url', '#');

if (!empty($button_text) && !empty($button_url)) : ?>
    <div class="cta-button-wrapper" data-aos="zoom-in">
        <a href="<?php echo esc_url($button_url); ?>" class="btn"><?php echo esc_html($button_text); ?></a>
    </div>
<?php endif; ?>
