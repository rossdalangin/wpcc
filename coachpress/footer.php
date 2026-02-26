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
				<div class="footer-copyright">
                    <?php
                    $copyright = get_theme_mod('coachpress_footer_copyright_text', '© ' . date('Y') . ' CoachPress. Strategic Excellence in Coaching.');
                    echo wp_kses_post($copyright);
                    ?>
                </div>
                <div class="footer-credits">
                    <?php
                    $theme_data = wp_get_theme();
                    printf( esc_html__( 'Theme: %1$s by %2$s.', 'coachpress' ), esc_html( $theme_data->get( 'Name' ) ), '<a href="' . esc_url( $theme_data->get( 'AuthorURI' ) ) . '">' . esc_html( $theme_data->get( 'Author' ) ) . '</a>' );
                    ?>
                </div>
			</div><!-- .site-info -->
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
