<?php
/**
 * Template Name: Process Page
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

        coachpress_display_page_sections( 'coachpress_process_page_sections', 'processes,faqs,cta' );
		?>

	</main><!-- #main -->

<?php
get_footer();
