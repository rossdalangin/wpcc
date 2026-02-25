<?php
/**
 * Template part for displaying the contact section content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CoachPress
 */

$form_type = get_theme_mod('coachpress_contact_page_form_type', 'shortcode');
$details_title = get_theme_mod('coachpress_contact_details_title', 'Get In Touch');
$email = get_theme_mod('coachpress_contact_email', 'hello@coachpress.com');
$phone = get_theme_mod('coachpress_contact_phone', '+1 (555) 000-0000');
$address = get_theme_mod('coachpress_contact_address', '123 Strategy Ave, Suite 100, New York, NY');
$form_title = get_theme_mod('coachpress_contact_form_title', 'Send Us A Message');
?>

<div class="contact-section-container grid-2-col">
    <div class="contact-details" data-aos="fade-right">
        <h3 class="contact-details-title"><?php echo esc_html($details_title); ?></h3>
        <div class="contact-info-list">
            <?php if (!empty($email)) : ?>
                <div class="contact-info-item">
                    <i class="fa fa-envelope"></i>
                    <span><?php echo esc_html($email); ?></span>
                </div>
            <?php endif; ?>
            <?php if (!empty($phone)) : ?>
                <div class="contact-info-item">
                    <i class="fa fa-phone"></i>
                    <span><?php echo esc_html($phone); ?></span>
                </div>
            <?php endif; ?>
            <?php if (!empty($address)) : ?>
                <div class="contact-info-item">
                    <i class="fa fa-map-marker"></i>
                    <span><?php echo wp_kses_post($address); ?></span>
                </div>
            <?php endif; ?>
        </div>

        <div class="contact-social">
            <?php
            $socials = array( 'linkedin', 'twitter', 'facebook', 'instagram' );
            foreach ( $socials as $network ) {
                $url = get_theme_mod( "coachpress_social_{$network}" );
                if ( ! empty( $url ) ) {
                    echo '<a href="' . esc_url( $url ) . '" target="_blank" aria-label="' . ucfirst($network) . '"><i class="fa fa-' . $network . '"></i></a>';
                }
            }
            ?>
        </div>
    </div>

    <div class="contact-form-side" data-aos="fade-left">
        <h3 class="contact-form-title"><?php echo esc_html($form_title); ?></h3>
        <?php
        if ($form_type === 'html') {
            $html_content = get_theme_mod('coachpress_contact_page_html');
            if (!empty($html_content)) {
                echo '<div class="contact-form-wrapper">' . wp_kses_post($html_content) . '</div>';
            } else {
                echo '<p class="form-placeholder">' . __('Form HTML will appear here. Configure it in the Customizer.', 'coachpress') . '</p>';
            }
        } else {
            $shortcode = get_theme_mod('coachpress_contact_page_shortcode');
            if (!empty($shortcode)) {
                echo '<div class="contact-form-wrapper">' . do_shortcode($shortcode) . '</div>';
            } else {
                echo '<p class="form-placeholder">' . __('Form shortcode will appear here. Configure it in the Customizer.', 'coachpress') . '</p>';
            }
        }
        ?>
    </div>
</div>
