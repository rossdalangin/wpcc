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

?>

<section id="hero" class="hero-section">
	<div class="<?php echo esc_attr( $container_class ); ?>">
		<div class="hero-left" style="text-align: <?php echo esc_attr( $left_alignment ); ?>">
			<h1><?php echo esc_html( get_theme_mod( 'coachpress_hero_left_heading', __( 'Welcome to CoachPress', 'coachpress' ) ) ); ?></h1>
			<p><?php echo esc_html( get_theme_mod( 'coachpress_hero_left_subheading', __( 'Your journey to success starts here.', 'coachpress' ) ) ); ?></p>
			<a href="<?php echo esc_url( get_theme_mod( 'coachpress_hero_left_button_url', '#' ) ); ?>" class="button"><?php echo esc_html( get_theme_mod( 'coachpress_hero_left_button_text', __( 'Get Started', 'coachpress' ) ) ); ?></a>
		</div>
		<?php if ( 'disabled' !== $right_content_type ) : ?>
			<div class="hero-right">
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
