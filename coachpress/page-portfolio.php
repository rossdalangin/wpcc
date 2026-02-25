<?php
/**
 * Template Name: Portfolio Page
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

        coachpress_display_page_sections( 'coachpress_portfolio_page_sections', 'portfolio,case-studies,cta' );
		?>

	</main><!-- #main -->

<?php
get_footer();
