<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CoachPress
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if ( ! is_front_page() ) :
        $template_slug = coachpress_get_template_slug();
        $defaults = coachpress_get_page_template_defaults();
        $page_defaults = $defaults[$template_slug] ?? array('title' => '', 'subtitle' => '', 'content' => '');

        $banner_title_override = get_theme_mod( "coachpress_{$template_slug}_banner_title", $page_defaults['title'] );
        $banner_subtitle = get_theme_mod( "coachpress_{$template_slug}_banner_subtitle", $page_defaults['subtitle'] );
        $banner_img_id = get_theme_mod( "coachpress_{$template_slug}_page_banner_image" );

        $banner_style = '';
        if ( $banner_img_id ) {
            $banner_url = wp_get_attachment_image_url( $banner_img_id, 'full' );
            $banner_style = 'style="background-image: url(' . esc_url( $banner_url ) . '); background-size: cover; background-position: center;"';
        }

        $display_title = !empty($banner_title_override) ? $banner_title_override : get_the_title();
        ?>
        <header class="entry-header page-banner <?php echo $banner_img_id ? 'has-banner-image' : ''; ?>" <?php echo $banner_style; ?>>
            <?php if ( $banner_img_id ) : ?>
                <div class="page-banner-overlay"></div>
            <?php endif; ?>
            <div class="container">
                <h1 class="entry-title" data-aos="fade-up"><?php echo esc_html($display_title); ?></h1>
                <?php if (!empty($banner_subtitle)) : ?>
                    <p class="entry-subtitle" data-aos="fade-up" data-aos-delay="100"><?php echo esc_html($banner_subtitle); ?></p>
                <?php endif; ?>
            </div>
        </header><!-- .entry-header -->
    <?php endif; ?>

	<?php if ( ! has_post_thumbnail() || is_front_page() ) : ?>
        <div class="entry-content-container container">
    <?php endif; ?>

	<?php coachpress_post_thumbnail(); ?>

	<div class="entry-content <?php echo ! is_front_page() ? 'container' : ''; ?>">
		<?php
        $content_override = get_theme_mod( "coachpress_{$template_slug}_page_content", $page_defaults['content'] );
        if ( !empty($content_override) ) {
            echo wp_kses_post($content_override);
        } else {
            the_content();
        }

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'coachpress' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

    <?php if ( ! has_post_thumbnail() || is_front_page() ) : ?>
        </div>
    <?php endif; ?>

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer container">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'coachpress' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
