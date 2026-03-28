<?php
/**
 * Template Name: Premium Sales Letter
 *
 * @package CoachPress
 */

get_header();

$banner_image = get_theme_mod( 'coachpress_sales-letter_page_banner_image' );
$salutation   = get_theme_mod( 'coachpress_sales-letter_page_salutation', __( 'Dear Visionary,', 'coachpress' ) );
$headline     = get_theme_mod( 'coachpress_sales-letter_page_headline', __( 'Transform Your Coaching Practice Today', 'coachpress' ) );
$pain_points  = get_theme_mod( 'coachpress_sales-letter_page_pain_points' );
$content      = get_theme_mod( 'coachpress_sales-letter_page_content' );
$list_items   = get_theme_mod( 'coachpress_sales-letter_page_list_items' );
$conclusion   = get_theme_mod( 'coachpress_sales-letter_page_conclusion' );
$signature    = get_theme_mod( 'coachpress_sales-letter_page_signature', __( 'To your success,', 'coachpress' ) );
$cta_text     = get_theme_mod( 'coachpress_sales-letter_page_cta_text', __( 'Join the Program', 'coachpress' ) );
$cta_url      = get_theme_mod( 'coachpress_sales-letter_page_cta_url', '#' );
?>

<main id="primary" class="site-main sales-letter-template">

    <?php if ( $banner_image ) : ?>
        <section class="sales-letter-banner" style="background-image: url('<?php echo esc_url( $banner_image ); ?>');">
            <div class="banner-overlay"></div>
        </section>
    <?php endif; ?>

    <section class="sales-letter-hero">
        <div class="container">
            <div class="sales-letter-header-content" data-aos="fade-up">
                <p class="salutation"><?php echo esc_html( $salutation ); ?></p>
                <h1 class="main-headline"><?php echo esc_html( $headline ); ?></h1>
            </div>
        </div>
    </section>

    <div class="sales-letter-body-container">
        <div class="container">
            <div class="sales-letter-content-wrapper" data-aos="fade-up">

                <?php if ( $content ) : ?>
                    <div class="narrative-content">
                        <?php echo wp_kses_post( wpautop( $content ) ); ?>
                    </div>
                <?php endif; ?>

                <?php if ( $pain_points ) : ?>
                    <div class="pain-points-narrative" data-aos="fade-up">
                        <?php echo wp_kses_post( wpautop( $pain_points ) ); ?>
                    </div>
                <?php endif; ?>

                <?php if ( $list_items ) : ?>
                    <div class="sales-letter-list-items" data-aos="fade-up">
                        <?php echo wp_kses_post( $list_items ); ?>
                    </div>
                <?php endif; ?>

                <?php if ( $conclusion ) : ?>
                    <div class="conclusion-content" data-aos="fade-up">
                        <?php echo wp_kses_post( wpautop( $conclusion ) ); ?>
                    </div>
                <?php endif; ?>

                <div class="signature-area" data-aos="fade-up">
                    <p class="signature-text"><?php echo esc_html( $signature ); ?></p>
                    <?php if ( get_theme_mod( 'custom_logo' ) ) : ?>
                        <?php the_custom_logo(); ?>
                    <?php else : ?>
                        <span class="site-title-signature"><?php bloginfo( 'name' ); ?></span>
                    <?php endif; ?>
                </div>

                <div class="cta-block-wrapper" data-aos="zoom-in">
                    <a href="<?php echo esc_url( $cta_url ); ?>" class="button cta-button-large">
                        <?php echo esc_html( $cta_text ); ?>
                    </a>
                </div>

            </div>
        </div>
    </div>

</main><!-- #main -->

<?php
get_footer();
