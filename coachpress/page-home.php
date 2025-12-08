<?php
/**
 * Template Name: Home Page
 *
 * @package CoachPress
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
        $sections = coachpress_get_sections();
        foreach ( $sections as $section ) {
            get_template_part( 'template-parts/section', $section );
        }
		?>

	</main><!-- #main -->

<?php
get_footer();
