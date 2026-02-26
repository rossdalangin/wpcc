<?php
/**
 * The template for displaying single services
 *
 * @package CoachPress
 */

get_header();
?>

<main id="primary" class="site-main">
    <?php while ( have_posts() ) : the_post(); ?>

        <header class="service-single-header page-banner" style="<?php echo has_post_thumbnail() ? 'background-image: url(' . get_the_post_thumbnail_url(null, 'full') . ');' : ''; ?>">
            <?php if ( has_post_thumbnail() ) : ?><div class="page-banner-overlay"></div><?php endif; ?>
            <div class="container">
                <h1 class="entry-title" data-aos="fade-up"><?php the_title(); ?></h1>
                <p class="entry-subtitle" data-aos="fade-up" data-aos-delay="100"><?php _e('Bespoke Strategic Solutions', 'coachpress'); ?></p>
            </div>
        </header>

        <div class="service-single-content container">
            <div class="grid-2-col" style="grid-template-columns: 2fr 1fr; gap: 80px;">
                <div class="service-main-description" data-aos="fade-right">
                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>
                </div>

                <aside class="service-cta-sidebar" data-aos="fade-left">
                    <div class="service-cta-card card" style="background: var(--coachpress-primary-color); color: #fff; padding: 50px !important;">
                        <h3 style="color: #fff;"><?php _e('Ready to Start?', 'coachpress'); ?></h3>
                        <p><?php _e('Take the first step toward transforming your business with this service.', 'coachpress'); ?></p>
                        <a href="#contact" class="btn" style="background: var(--coachpress-accent-color); color: #fff; width: 100%;"><?php _e('Request a Proposal', 'coachpress'); ?></a>
                    </div>

                    <div class="service-related-meta card" style="margin-top: 30px;">
                        <h3><?php _e('Service Details', 'coachpress'); ?></h3>
                        <ul style="list-style: none; padding: 0; margin: 0;">
                            <li style="padding: 10px 0; border-bottom: 1px solid rgba(0,0,0,0.05);"><?php _e('Duration: Variable', 'coachpress'); ?></li>
                            <li style="padding: 10px 0; border-bottom: 1px solid rgba(0,0,0,0.05);"><?php _e('Focus: High-Impact ROI', 'coachpress'); ?></li>
                            <li style="padding: 10px 0;"><?php _e('Delivery: Bespoke', 'coachpress'); ?></li>
                        </ul>
                    </div>
                </aside>
            </div>
        </div>

        <?php
        coachpress_display_section('processes', true);
        coachpress_display_section('cta', true);
        ?>

        <?php
        the_post_navigation(
            array(
                'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous Service:', 'coachpress' ) . '</span> <span class="nav-title">%title</span>',
                'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next Service:', 'coachpress' ) . '</span> <span class="nav-title">%title</span>',
            )
        );
        ?>

    <?php endwhile; ?>
</main>

<?php
get_footer();
