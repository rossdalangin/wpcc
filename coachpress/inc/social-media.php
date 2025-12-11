<?php
/**
 * CoachPress Theme Customizer Social Media
 *
 * @package CoachPress
 */

function coachpress_customize_register_social_media( $wp_customize ) {
    $wp_customize->add_section( 'coachpress_social_media', array(
        'title'    => __( 'Social Media', 'coachpress' ),
        'panel'    => 'coachpress_theme_settings_panel',
        'priority' => 120,
        'description' => __( 'Enter the full URLs for your social media profiles. Icons will appear in the site footer for each URL you provide.', 'coachpress' ),
    ) );

    $social_networks = array(
        'facebook'  => __( 'Facebook', 'coachpress' ),
        'twitter'   => __( 'Twitter', 'coachpress' ),
        'instagram' => __( 'Instagram', 'coachpress' ),
        'linkedin'  => __( 'LinkedIn', 'coachpress' ),
        'youtube'   => __( 'YouTube', 'coachpress' ),
    );

    foreach ( $social_networks as $network => $label ) {
        $wp_customize->add_setting( "coachpress_social_{$network}", array(
            'default'   => '',
            'transport' => 'refresh',
            'sanitize_callback' => 'esc_url_raw',
        ) );

        $wp_customize->add_control( "coachpress_social_{$network}", array(
            'label'    => $label,
            'section'  => 'coachpress_social_media',
            'settings' => "coachpress_social_{$network}",
            'type'     => 'url',
        ) );
    }
}
add_action( 'customize_register', 'coachpress_customize_register_social_media' );
