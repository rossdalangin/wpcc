<?php
/**
 * Template part for displaying the CTA section content
 *
 * @package CoachPress
 */

$subheading = get_theme_mod('coachpress_cta_subheading', 'Limited availability for Q3/Q4. Secure your strategy session today.');
$button_text = get_theme_mod('coachpress_cta_button_text', 'Get Started');
$button_url = get_theme_mod('coachpress_cta_button_url', '#');

if (!empty($subheading)) : ?>
    <p class="cta-subheading" data-aos="fade-up"><?php echo esc_html($subheading); ?></p>
<?php endif;

if (!empty($button_text) && !empty($button_url)) : ?>
    <div class="cta-button-wrapper" data-aos="zoom-in" data-aos-delay="100">
        <a href="<?php echo esc_url($button_url); ?>" class="btn"><?php echo esc_html($button_text); ?></a>
    </div>
<?php endif; ?>
