<?php
/**
 * Template part for displaying the hero section
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CoachPress
 */

$right_content_type = get_theme_mod( 'coachpress_hero_right_content_type', 'image' );
$left_alignment = get_theme_mod( 'coachpress_hero_left_alignment', 'left' );
$container_class = 'disabled' === $right_content_type ? 'hero-container-full' : 'hero-container';

$bg_image_id = get_theme_mod( 'coachpress_hero_bg_image' );
$bg_image = $bg_image_id ? wp_get_attachment_image_url( $bg_image_id, 'full' ) : '';
$bg_video = get_theme_mod( 'coachpress_hero_bg_video' );
$bg_overlay_color = get_theme_mod( 'coachpress_hero_bg_overlay_color', '#000000' );
$bg_overlay_opacity = get_theme_mod( 'coachpress_hero_bg_overlay_opacity', '0.5' );

// Convert hex color to RGB
list($r, $g, $b) = sscanf($bg_overlay_color, "#%02x%02x%02x");

$bg_overlay_rgba = "rgba({$r}, {$g}, {$b}, {$bg_overlay_opacity})";

?>

<section id="hero" class="hero-section" style="<?php if ( $bg_image ) echo 'background-image: url(' . esc_url( $bg_image ) . ');'; ?>">
    <?php if ( $bg_video ) : ?>
        <video autoplay muted loop id="hero-video">
            <source src="<?php echo esc_url( $bg_video ); ?>" type="video/mp4">
        </video>
    <?php endif; ?>
    <div class="hero-overlay" style="background-color: <?php echo esc_attr( $bg_overlay_rgba ); ?>"></div>
	<div class="<?php echo esc_attr( $container_class ); ?>">
		<div class="hero-left" style="text-align: <?php echo esc_attr( $left_alignment ); ?>" data-aos="fade-right">
			<h1><?php echo esc_html( get_theme_mod( 'coachpress_hero_left_heading', __( 'Welcome to CoachPress', 'coachpress' ) ) ); ?></h1>
			<p><?php echo esc_html( get_theme_mod( 'coachpress_hero_left_subheading', __( 'Your journey to success starts here.', 'coachpress' ) ) ); ?></p>
			<a href="<?php echo esc_url( get_theme_mod( 'coachpress_hero_left_button_url', '#' ) ); ?>" class="button button-primary"><?php echo esc_html( get_theme_mod( 'coachpress_hero_left_button_text', __( 'Get Started', 'coachpress' ) ) ); ?></a>
		</div>
		<?php if ( 'disabled' !== $right_content_type ) : ?>
			<div class="hero-right" data-aos="fade-left">
				<?php
				switch ( $right_content_type ) {
					case 'html':
						echo wp_kses_post( get_theme_mod( 'coachpress_hero_right_html', '' ) );
						break;
					case 'shortcode':
						echo do_shortcode( get_theme_mod( 'coachpress_hero_right_shortcode', '' ) );
						break;
					case 'image':
						$image_id = get_theme_mod( 'coachpress_hero_right_image' );
						if ( $image_id ) {
							echo wp_get_attachment_image( $image_id, 'large' );
						}
						break;
					case 'video':
						$video_url = get_theme_mod( 'coachpress_hero_right_video' );
						if ( $video_url ) {
							echo wp_oembed_get( $video_url );
						}
						break;
				}
				?>
			</div>
		<?php endif; ?>
	</div>
</section>
