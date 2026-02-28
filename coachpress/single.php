<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package CoachPress
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();
            ?>
            <header class="entry-header page-banner <?php echo has_post_thumbnail() ? 'has-banner-image' : ''; ?>" style="<?php echo has_post_thumbnail() ? 'background-image: url(' . get_the_post_thumbnail_url(null, 'full') . ');' : ''; ?>">
                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="page-banner-overlay"></div>
                <?php endif; ?>
                <div class="container">
                    <div class="entry-meta muted-text" data-aos="fade-up">
                        <?php coachpress_posted_on(); ?>
                    </div>
                    <?php the_title( '<h1 class="entry-title" data-aos="fade-up" data-aos-delay="100">', '</h1>' ); ?>
                    <div class="entry-meta" data-aos="fade-up" data-aos-delay="200">
                        <?php coachpress_posted_by(); ?>
                    </div>
                </div>
            </header>

            <div class="post-single-container container">
                <div class="post-single-grid">
                    <div class="post-single-content-area">
                        <div class="post-single-inner">
                            <?php get_template_part( 'template-parts/content', get_post_type() ); ?>

                            <div class="author-bio-section card" data-aos="fade-up">
                                <div class="author-avatar">
                                    <?php echo get_avatar( get_the_author_meta( 'ID' ), 100 ); ?>
                                </div>
                                <div class="author-info">
                                    <h3><?php echo esc_html( get_the_author() ); ?></h3>
                                    <p class="author-description"><?php echo wp_kses_post( get_the_author_meta( 'description' ) ); ?></p>
                                    <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="author-link"><?php _e('View All Posts', 'coachpress'); ?></a>
                                </div>
                            </div>

                            <?php
                            the_post_navigation(
                                array(
                                    'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'coachpress' ) . '</span> <span class="nav-title">%title</span>',
                                    'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'coachpress' ) . '</span> <span class="nav-title">%title</span>',
                                )
                            );

                            // If comments are open or we have at least one comment, load up the comment template.
                            if ( comments_open() || get_comments_number() ) :
                                comments_template();
                            endif;
                            ?>
                        </div>
                    </div>

                    <div class="post-single-sidebar-area">
                        <?php get_sidebar(); ?>
                    </div>
                </div>
            </div>
            <?php
		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
