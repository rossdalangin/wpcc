<?php
/**
 * Template Name: About Page
 *
 * @package CoachPress
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
        while ( have_posts() ) :
            the_post();

            get_template_part( 'template-parts/content', 'page' );

        endwhile; // End of the loop.

        coachpress_display_page_sections( 'coachpress_about_page_sections', 'about-preview,team,cta' );
		?>

	</main><!-- #main -->

<?php
get_footer();
