<?php
/**
 * The template for displaying single team members
 *
 * @package CoachPress
 */

get_header();

$role = get_post_meta( get_the_ID(), '_team_member_role', true ) ?: 'Consultant';
?>

<main id="primary" class="site-main">
    <?php while ( have_posts() ) : the_post(); ?>

        <header class="team-single-header page-banner">
            <div class="container">
                <div class="team-single-intro" data-aos="fade-up">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="team-single-image">
                            <?php the_post_thumbnail('medium'); ?>
                        </div>
                    <?php endif; ?>
                    <div class="team-single-titles">
                        <span class="team-member-role"><?php echo esc_html($role); ?></span>
                        <h1 class="entry-title"><?php the_title(); ?></h1>
                    </div>
                </div>
            </div>
        </header>

        <div class="team-single-content container">
            <div class="grid-2-col">
                <div class="team-main-bio" data-aos="fade-right">
                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>
                </div>

                <aside class="team-contact-sidebar" data-aos="fade-left">
                    <div class="team-contact-card card">
                        <h3><?php printf( __('Connect with %s', 'coachpress'), get_the_title() ); ?></h3>
                        <p><?php _e('Ready to discuss how our expertise can help your business grow?', 'coachpress'); ?></p>
                        <div class="team-member-social">
                            <a href="#" aria-label="LinkedIn"><i class="fa fa-linkedin"></i> LinkedIn</a>
                            <a href="#" aria-label="Twitter"><i class="fa fa-twitter"></i> Twitter</a>
                        </div>
                        <div class="portfolio-cta" style="margin-top: 30px;">
                            <a href="#contact" class="btn"><?php _e('Book a Strategy Session', 'coachpress'); ?></a>
                        </div>
                    </div>
                </aside>
            </div>
        </div>

        <?php
        the_post_navigation(
            array(
                'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous Member:', 'coachpress' ) . '</span> <span class="nav-title">%title</span>',
                'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next Member:', 'coachpress' ) . '</span> <span class="nav-title">%title</span>',
            )
        );
        ?>

    <?php endwhile; ?>
</main>

<?php
get_footer();
