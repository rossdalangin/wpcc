<?php
/**
 * The template for displaying single processes
 *
 * @package CoachPress
 */

get_header();

$cpt_slug = 'processes';
$cta_title = get_theme_mod( "coachpress_single_{$cpt_slug}_cta_title", __( 'Ready to Start?', 'coachpress' ) );
$cta_desc = get_theme_mod( "coachpress_single_{$cpt_slug}_cta_desc", __( 'Take the first step toward transforming your business with this process.', 'coachpress' ) );
$cta_bg = get_theme_mod( "coachpress_single_{$cpt_slug}_cta_bg_color", '#1a365d' );
$cta_text_color = get_theme_mod( "coachpress_single_{$cpt_slug}_cta_text_color", '#ffffff' );
$btn_text = get_theme_mod( "coachpress_single_{$cpt_slug}_cta_btn_text", __( 'Apply Our Framework', 'coachpress' ) );
$btn_type = get_theme_mod( "coachpress_single_{$cpt_slug}_cta_btn_type", 'url' );

$card_style = "background-color: {$cta_bg} !important; color: {$cta_text_color} !important; padding: 50px !important;";
?>

<main id="primary" class="site-main">
    <?php while ( have_posts() ) : the_post(); ?>

        <header class="process-single-header page-banner" style="<?php echo has_post_thumbnail() ? 'background-image: url(' . get_the_post_thumbnail_url(null, 'full') . ');' : ''; ?>">
            <?php if ( has_post_thumbnail() ) : ?><div class="page-banner-overlay"></div><?php endif; ?>
            <div class="container">
                <h1 class="entry-title" data-aos="fade-up"><?php the_title(); ?></h1>
                <p class="entry-subtitle" data-aos="fade-up" data-aos-delay="100"><?php _e('Our Strategic Framework', 'coachpress'); ?></p>
            </div>
        </header>

        <div class="process-single-content container" style="padding-top: 80px; padding-bottom: 80px;">
            <div class="grid-2-col" style="grid-template-columns: 2fr 1fr; gap: 80px;">
                <div class="process-main-description" data-aos="fade-right">
                    <div class="entry-content" style="padding: 0;">
                        <?php the_content(); ?>
                    </div>
                </div>

                <aside class="process-cta-sidebar" data-aos="fade-left">
                    <div class="process-cta-card card" style="<?php echo esc_attr($card_style); ?>">
                        <h3 style="color: <?php echo esc_attr($cta_text_color); ?> !important; margin-bottom: 20px;"><?php echo esc_html($cta_title); ?></h3>
                        <div class="cta-card-description" style="margin-bottom: 30px; color: <?php echo esc_attr($cta_text_color); ?> !important; opacity: 0.9;">
                            <?php echo wp_kses_post($cta_desc); ?>
                        </div>

                        <?php if ( 'url' === $btn_type ) : ?>
                            <?php $btn_url = get_theme_mod( "coachpress_single_{$cpt_slug}_cta_btn_url", '#contact' ); ?>
                            <a href="<?php echo esc_url($btn_url); ?>" class="btn" style="background: var(--coachpress-accent-color); color: #fff; width: 100%;"><?php echo esc_html($btn_text); ?></a>
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
                </aside>
            </div>
        </div>

        <?php
        coachpress_display_section('cta', true);
        ?>

        <div class="container" style="padding-bottom: 80px;">
            <?php
            the_post_navigation(
                array(
                    'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous Process:', 'coachpress' ) . '</span> <span class="nav-title">%title</span>',
                    'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next Process:', 'coachpress' ) . '</span> <span class="nav-title">%title</span>',
                )
            );
            ?>
        </div>

    <?php endwhile; ?>
</main>

<?php
get_footer();
