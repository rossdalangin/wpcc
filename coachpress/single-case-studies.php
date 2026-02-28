<?php
/**
 * The template for displaying single case studies
 *
 * @package CoachPress
 */

get_header();

$cpt_slug = 'case_studies';
$cta_title = get_theme_mod( "coachpress_single_{$cpt_slug}_cta_title", __( 'Ready to Start?', 'coachpress' ) );
$cta_desc = get_theme_mod( "coachpress_single_{$cpt_slug}_cta_desc", __( 'Take the first step toward transforming your business.', 'coachpress' ) );
$cta_bg = get_theme_mod( "coachpress_single_{$cpt_slug}_cta_bg_color", '#f7fafc' );
$cta_text_color = get_theme_mod( "coachpress_single_{$cpt_slug}_cta_text_color", '#1a365d' );
$btn_text = get_theme_mod( "coachpress_single_{$cpt_slug}_cta_btn_text", __( 'Get Similar Results', 'coachpress' ) );
$btn_type = get_theme_mod( "coachpress_single_{$cpt_slug}_cta_btn_type", 'url' );

$card_style = "background-color: {$cta_bg} !important; color: {$cta_text_color} !important;";
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

        <div class="case-study-single-content container" style="padding-top: 80px; padding-bottom: 80px;">
            <div class="grid-2-col" style="grid-template-columns: 2fr 1fr; gap: 80px;">
                <div class="case-study-main-description" data-aos="fade-right">
                    <div class="entry-content" style="padding: 0;">
                        <?php the_content(); ?>
                    </div>
                </div>

                <aside class="case-study-sidebar" data-aos="fade-left">
                    <div class="case-study-outcome-card card sidebar-card" style="<?php echo esc_attr($card_style); ?>">
                        <h3 style="color: <?php echo esc_attr($cta_text_color); ?> !important;"><?php echo esc_html($cta_title); ?></h3>

                        <div class="cta-card-description" style="margin-bottom: 25px; color: <?php echo esc_attr($cta_text_color); ?> !important; opacity: 0.9;">
                            <?php echo wp_kses_post($cta_desc); ?>
                        </div>

                        <?php if ( 'url' === $btn_type ) : ?>
                            <?php $btn_url = get_theme_mod( "coachpress_single_{$cpt_slug}_cta_btn_url", '#contact' ); ?>
                            <div class="portfolio-cta">
                                <a href="<?php echo esc_url($btn_url); ?>" class="btn" style="width: 100%;"><?php echo esc_html($btn_text); ?></a>
                            </div>
                        <?php elseif ( 'html' === $btn_type ) : ?>
                            <div class="cta-custom-html">
                                <?php echo wp_kses_post( get_theme_mod( "coachpress_single_{$cpt_slug}_cta_btn_html" ) ); ?>
                            </div>
                        <?php elseif ( 'shortcode' === $btn_type ) : ?>
                            <div class="cta-shortcode">
                                <?php echo do_shortcode( get_theme_mod( "coachpress_single_{$cpt_slug}_cta_btn_shortcode" ) ); ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="case-study-outcome-details card sidebar-card" style="margin-top: 30px;">
                        <h3><?php _e('Key Outcomes', 'coachpress'); ?></h3>
                        <ul style="padding: 0; list-style: none;">
                            <li style="margin-bottom: 12px; display: flex; align-items: center; gap: 10px;"><i class="fa fa-check-circle" style="color: var(--coachpress-accent-color);"></i> <?php _e('Strategic Alignment', 'coachpress'); ?></li>
                            <li style="margin-bottom: 12px; display: flex; align-items: center; gap: 10px;"><i class="fa fa-check-circle" style="color: var(--coachpress-accent-color);"></i> <?php _e('Measurable ROI', 'coachpress'); ?></li>
                            <li style="display: flex; align-items: center; gap: 10px;"><i class="fa fa-check-circle" style="color: var(--coachpress-accent-color);"></i> <?php _e('Operational Scalability', 'coachpress'); ?></li>
                        </ul>
                    </div>
                </aside>
            </div>
        </div>

        <?php
        coachpress_display_section('testimonials', true);
        coachpress_display_section('cta', true);
        ?>

        <div class="container" style="padding-bottom: 80px;">
            <?php
            the_post_navigation(
                array(
                    'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous Success Story:', 'coachpress' ) . '</span> <span class="nav-title">%title</span>',
                    'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next Success Story:', 'coachpress' ) . '</span> <span class="nav-title">%title</span>',
                )
            );
            ?>
        </div>

    <?php endwhile; ?>
</main>

<?php
get_footer();
