<?php
/**
 * Template part for displaying social media icons
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CoachPress
 */

$social_networks = array(
    'facebook'  => __( 'Facebook', 'coachpress' ),
    'twitter'   => __( 'Twitter', 'coachpress' ),
    'instagram' => __( 'Instagram', 'coachpress' ),
    'linkedin'  => __( 'LinkedIn', 'coachpress' ),
    'youtube'   => __( 'YouTube', 'coachpress' ),
);
?>

<div class="social-icons">
    <?php foreach ( $social_networks as $network => $label ) : ?>
        <?php $url = get_theme_mod( "coachpress_social_{$network}" ); ?>
        <?php if ( ! empty( $url ) ) : ?>
            <a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener noreferrer">
                <i class="fa fa-<?php echo esc_attr( $network ); ?>" aria-hidden="true"></i>
                <span class="screen-reader-text"><?php echo esc_html( $label ); ?></span>
            </a>
        <?php endif; ?>
    <?php endforeach; ?>
</div>
