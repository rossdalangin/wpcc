<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CoachPress
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="container">
            <?php get_template_part( 'template-parts/social-icons' ); ?>
			<div class="site-info">
				<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'coachpress' ) ); ?>">
					<?php
					/* translators: %s: CMS name, i.e. WordPress. */
					printf( esc_html__( 'Proudly powered by %s', 'coachpress' ), 'WordPress' );
					?>
				</a>
				<span class="sep"> | </span>
					<?php
                    $theme_data = wp_get_theme();
					/* translators: 1: Theme name, 2: Theme author. */
					printf( esc_html__( 'Theme: %1$s by %2$s.', 'coachpress' ), esc_html( $theme_data->get( 'Name' ) ), '<a href="' . esc_url( $theme_data->get( 'AuthorURI' ) ) . '">' . esc_html( $theme_data->get( 'Author' ) ) . '</a>' );
					?>
			</div><!-- .site-info -->
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
