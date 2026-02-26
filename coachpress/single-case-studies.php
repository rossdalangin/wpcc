<?php
/**
 * The template for displaying single case studies
 *
 * @package CoachPress
 */

get_header();
?>

<main id="primary" class="site-main">
    <?php while ( have_posts() ) : the_post(); ?>

        <header class="case-study-single-header page-banner" style="<?php echo has_post_thumbnail() ? 'background-image: url(' . get_the_post_thumbnail_url(null, 'full') . ');' : ''; ?>">
            <?php if ( has_post_thumbnail() ) : ?><div class="page-banner-overlay"></div><?php endif; ?>
            <div class="container">
                <span class="portfolio-single-cat" data-aos="fade-up"><?php _e('Success Story', 'coachpress'); ?></span>
                <h1 class="entry-title" data-aos="fade-up" data-aos-delay="100"><?php the_title(); ?></h1>
            </div>
        </header>

        <div class="case-study-single-content container">
            <div class="grid-2-col" style="grid-template-columns: 2fr 1fr; gap: 80px;">
                <div class="case-study-main-description" data-aos="fade-right">
                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>
                </div>

                <aside class="case-study-sidebar" data-aos="fade-left">
                    <div class="case-study-outcome-card card" style="background: var(--coachpress-secondary-color); padding: 50px !important;">
                        <h3><?php _e('Key Outcomes', 'coachpress'); ?></h3>
                        <ul style="padding: 0; list-style: none; margin-top: 20px;">
                            <li style="margin-bottom: 15px;"><i class="fa fa-check-circle" style="color: var(--coachpress-accent-color); margin-right: 10px;"></i> <?php _e('Strategic Alignment', 'coachpress'); ?></li>
                            <li style="margin-bottom: 15px;"><i class="fa fa-check-circle" style="color: var(--coachpress-accent-color); margin-right: 10px;"></i> <?php _e('Measurable ROI', 'coachpress'); ?></li>
                            <li style="margin-bottom: 15px;"><i class="fa fa-check-circle" style="color: var(--coachpress-accent-color); margin-right: 10px;"></i> <?php _e('Operational Scalability', 'coachpress'); ?></li>
                        </ul>
                        <div class="portfolio-cta" style="margin-top: 40px;">
                            <a href="#contact" class="btn" style="width: 100%;"><?php _e('Get Similar Results', 'coachpress'); ?></a>
                        </div>
                    </div>
                </aside>
            </div>
        </div>

        <?php
        coachpress_display_section('testimonials', true);
        coachpress_display_section('cta', true);
        ?>

        <?php
        the_post_navigation(
            array(
                'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous Success Story:', 'coachpress' ) . '</span> <span class="nav-title">%title</span>',
                'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next Success Story:', 'coachpress' ) . '</span> <span class="nav-title">%title</span>',
            )
        );
        ?>

    <?php endwhile; ?>
</main>

<?php
get_footer();
