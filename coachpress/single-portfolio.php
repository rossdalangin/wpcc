<?php
/**
 * The template for displaying single portfolio items
 *
 * @package CoachPress
 */

get_header();

$category = get_post_meta( get_the_ID(), '_portfolio_category', true ) ?: 'Strategy';

$cpt_slug = 'portfolio';
$cta_title = get_theme_mod( "coachpress_single_{$cpt_slug}_cta_title", __( 'Project Overview', 'coachpress' ) );
$cta_desc = get_theme_mod( "coachpress_single_{$cpt_slug}_cta_desc", '' );
$cta_bg = get_theme_mod( "coachpress_single_{$cpt_slug}_cta_bg_color", '#ffffff' );
$cta_text_color = get_theme_mod( "coachpress_single_{$cpt_slug}_cta_text_color", '#1a365d' );
$btn_text = get_theme_mod( "coachpress_single_{$cpt_slug}_cta_btn_text", __( 'Discuss a Project', 'coachpress' ) );
$btn_type = get_theme_mod( "coachpress_single_{$cpt_slug}_cta_btn_type", 'url' );

$card_style = "background-color: {$cta_bg} !important; color: {$cta_text_color} !important; padding: 60px !important;";
?>

<main id="primary" class="site-main">
    <?php while ( have_posts() ) : the_post(); ?>

        <header class="portfolio-single-header page-banner has-banner-image" style="<?php echo has_post_thumbnail() ? 'background-image: url(' . get_the_post_thumbnail_url(null, 'full') . ');' : ''; ?>">
            <div class="page-banner-overlay"></div>
            <div class="container">
                <span class="portfolio-single-cat" data-aos="fade-up"><?php echo esc_html($category); ?></span>
                <h1 class="entry-title" data-aos="fade-up" data-aos-delay="100"><?php the_title(); ?></h1>
            </div>
        </header>

        <div class="portfolio-single-content container" style="padding-top: 80px; padding-bottom: 80px;">
            <div class="grid-2-col" style="grid-template-columns: 2fr 1fr; gap: 80px;">
                <div class="portfolio-main-text" data-aos="fade-right">
                    <div class="entry-content" style="padding: 0;">
                        <?php the_content(); ?>
                    </div>
                </div>

                <aside class="portfolio-meta-sidebar" data-aos="fade-left">
                    <div class="portfolio-meta-card card" style="<?php echo esc_attr($card_style); ?>">
                        <h3 style="color: <?php echo esc_attr($cta_text_color); ?> !important; margin-bottom: 20px;"><?php echo esc_html($cta_title); ?></h3>

                        <?php if ( !empty($cta_desc) ) : ?>
                            <div class="cta-card-description" style="margin-bottom: 20px; color: <?php echo esc_attr($cta_text_color); ?> !important; opacity: 0.9;">
                                <?php echo wp_kses_post($cta_desc); ?>
                            </div>
                        <?php endif; ?>

                        <div class="portfolio-meta-item" style="border-bottom-color: rgba(0,0,0,0.05); padding: 15px 0;">
                            <strong style="color: inherit;"><?php _e('Category:', 'coachpress'); ?></strong>
                            <span style="color: inherit; opacity: 0.8;"><?php echo esc_html($category); ?></span>
                        </div>
                        <div class="portfolio-meta-item" style="border-bottom-color: rgba(0,0,0,0.05); padding: 15px 0;">
                            <strong style="color: inherit;"><?php _e('Date:', 'coachpress'); ?></strong>
                            <span style="color: inherit; opacity: 0.8;"><?php echo get_the_date(); ?></span>
                        </div>

                        <div class="portfolio-cta" style="margin-top: 40px;">
                            <?php if ( 'url' === $btn_type ) : ?>
                                <?php $btn_url = get_theme_mod( "coachpress_single_{$cpt_slug}_cta_btn_url", '#contact' ); ?>
                                <a href="<?php echo esc_url($btn_url); ?>" class="btn" style="width: 100%;"><?php echo esc_html($btn_text); ?></a>
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
                    </div>
                </aside>
            </div>
        </div>

        <div class="container" style="padding-bottom: 80px;">
            <?php
            the_post_navigation(
                array(
                    'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous Project:', 'coachpress' ) . '</span> <span class="nav-title">%title</span>',
                    'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next Project:', 'coachpress' ) . '</span> <span class="nav-title">%title</span>',
                )
            );
            ?>
        </div>

    <?php endwhile; ?>
</main>

<?php
get_footer();
