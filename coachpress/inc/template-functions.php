<?php
/**
 * Template part for displaying a section
 *
 * @package CoachPress
 */

function coachpress_display_section($section_id, $force_display = false) {
    // If not forced (like on homepage), respect the global toggle.
    // If forced (like in page builder), we still want to show it because the builder string itself handles selection.
    if ( !$force_display && ! get_theme_mod( "coachpress_show_{$section_id}", true ) ) {
        return;
    }

    $sections_data = coachpress_get_sections_data();
    $default_bg = $sections_data[$section_id]['bg'] ?? '#FFFFFF';

    $bg_type = get_theme_mod("coachpress_{$section_id}_bg_type", 'color');
    $bg_image_id = get_theme_mod("coachpress_{$section_id}_bg_image");
    $bg_image = $bg_image_id ? wp_get_attachment_image_url($bg_image_id, 'full') : '';
    $bg_video = get_theme_mod("coachpress_{$section_id}_bg_video");
    $bg_color = get_theme_mod("coachpress_{$section_id}_bg_color", $default_bg);

    $section_style = '';
    if ($bg_type === 'color' && !empty($bg_color)) {
        if (strpos($bg_color, 'gradient') !== false) {
            $section_style = "background: {$bg_color};";
        } else {
            $section_style = "background-color: {$bg_color};";
        }
    } elseif ($bg_type === 'image' && !empty($bg_image)) {
        $section_style = "background-image: url('" . esc_url($bg_image) . "');";
    }

    $section_classes = array('homepage-section', 'section-' . $section_id);

    $default_title = $sections_data[$section_id]['title'] ?? '';
    $default_desc = $sections_data[$section_id]['description'] ?? '';

    ?>
    <section id="<?php echo esc_attr($section_id); ?>" class="<?php echo esc_attr(implode(' ', $section_classes)); ?>" style="<?php echo esc_attr($section_style); ?>">
        <?php if ($bg_type === 'video' && !empty($bg_video)) : ?>
            <video class="section-background-video" autoplay muted loop playsinline>
                <source src="<?php echo esc_url($bg_video); ?>" type="video/mp4">
            </video>
        <?php endif; ?>
        <?php if (($bg_type === 'image' || $bg_type === 'video')) : ?>
            <div class="section-background-overlay"></div>
        <?php endif; ?>

        <div class="section-inner container">
            <?php
            if ($section_id !== 'hero') {
                $title = get_theme_mod("coachpress_{$section_id}_section_title", $default_title);
                if (!empty($title)) {
                    echo '<h2 class="section-title" data-aos="fade-up">' . esc_html($title) . '</h2>';
                }

                $description = get_theme_mod("coachpress_{$section_id}_section_description", $default_desc);
                if (!empty($description)) {
                    echo '<div class="section-description" data-aos="fade-up" data-aos-delay="100">' . wp_kses_post($description) . '</div>';
                }
            }

            echo '<div class="section-content-wrapper" data-aos="fade-up" data-aos-delay="200">';
            get_template_part('template-parts/content', $section_id);
            echo '</div>';
            ?>
        </div>
    </section>
    <?php
}
