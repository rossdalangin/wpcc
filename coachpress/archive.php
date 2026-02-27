<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CoachPress
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-banner">
                <div class="container">
				    <?php
				    the_archive_title( '<h1 class="page-title entry-title" data-aos="fade-up">', '</h1>' );
				    the_archive_description( '<div class="archive-description" data-aos="fade-up" data-aos-delay="100">', '</div>' );
				    ?>
                </div>
			</header><!-- .page-header -->

            <div class="blog-archive-container container">
                <div class="blog-grid grid-3-col">
                    <?php
                    /* Start the Loop */
                    while ( have_posts() ) :
                        the_post();

                        /*
                        * Include the Post-Type-specific template for the content.
                        * If you want to override this in a child theme, then include a file
                        * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                        */
                        get_template_part( 'template-parts/content', get_post_type() );

                    endwhile;
                    ?>
                </div>

                <?php
                the_posts_navigation(
                    array(
                        'prev_text' => esc_html__( 'Older posts', 'coachpress' ),
                        'next_text' => esc_html__( 'Newer posts', 'coachpress' ),
                    )
                );
                ?>
            </div>

		<?php
		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
get_footer();
