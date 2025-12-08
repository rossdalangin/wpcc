<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CoachPress
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'coachpress' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="site-branding">
			<?php
			the_custom_logo();
			if ( is_front_page() && is_home() ) :
				?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php
			else :
				?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
			endif;
			$coachpress_description = get_bloginfo( 'description', 'display' );
			if ( $coachpress_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo $coachpress_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
			<?php endif; ?>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'coachpress' ); ?></button>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
				)
			);
			?>
            <div class="header-cta">
                <?php
                $cta_type = get_theme_mod( 'coachpress_header_cta_type', 'url' );
                $cta_text = get_theme_mod( 'coachpress_header_cta_text', __( 'Contact Us', 'coachpress' ) );

                if ( 'url' === $cta_type ) {
                    $cta_url = get_theme_mod( 'coachpress_header_cta_url', '#' );
                    echo '<a href="' . esc_url( $cta_url ) . '" class="button">' . esc_html( $cta_text ) . '</a>';
                } else {
                    echo '<button id="header-cta-button" class="button">' . esc_html( $cta_text ) . '</button>';
                }
                ?>
            </div>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

    <?php if ( 'url' !== get_theme_mod( 'coachpress_header_cta_type', 'url' ) ) : ?>
        <div id="cta-modal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <?php
                $cta_type = get_theme_mod( 'coachpress_header_cta_type' );
                if ( 'html' === $cta_type ) {
                    echo wp_kses_post( get_theme_mod( 'coachpress_header_cta_html', '' ) );
                } elseif ( 'shortcode' === $cta_type ) {
                    echo do_shortcode( get_theme_mod( 'coachpress_header_cta_shortcode', '' ) );
                }
                ?>
            </div>
        </div>
    <?php endif; ?>
