<?php
/**
 * The template for displaying single team members
 *
 * @package CoachPress
 */

get_header();

$role = get_post_meta( get_the_ID(), '_team_member_role', true ) ?: 'Consultant';

$cpt_slug = 'team';
$cta_title = get_theme_mod( "coachpress_single_{$cpt_slug}_cta_title", sprintf( __('Connect with %s', 'coachpress'), get_the_title() ) );
$cta_desc = get_theme_mod( "coachpress_single_{$cpt_slug}_cta_desc", __( 'Ready to discuss how our expertise can help your business grow?', 'coachpress' ) );
$cta_bg = get_theme_mod( "coachpress_single_{$cpt_slug}_cta_bg_color", '#ffffff' );
$cta_text_color = get_theme_mod( "coachpress_single_{$cpt_slug}_cta_text_color", '#1a365d' );
$btn_text = get_theme_mod( "coachpress_single_{$cpt_slug}_cta_btn_text", __( 'Book a Strategy Session', 'coachpress' ) );
$btn_type = get_theme_mod( "coachpress_single_{$cpt_slug}_cta_btn_type", 'url' );

$card_style = "background-color: {$cta_bg} !important; color: {$cta_text_color} !important;";
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

        <div class="team-single-content container" style="padding-top: 80px; padding-bottom: 80px;">
            <div class="grid-2-col" style="grid-template-columns: 2fr 1fr; gap: 80px;">
                <div class="team-main-bio" data-aos="fade-right">
                    <div class="entry-content" style="padding: 0;">
                        <?php the_content(); ?>
                    </div>
                </div>

                <aside class="team-contact-sidebar" data-aos="fade-left">
                    <div class="team-contact-card card sidebar-card" style="<?php echo esc_attr($card_style); ?>">
                        <h3 style="color: <?php echo esc_attr($cta_text_color); ?> !important;"><?php echo esc_html($cta_title); ?></h3>
                        <div class="cta-card-description" style="margin-bottom: 25px; color: <?php echo esc_attr($cta_text_color); ?> !important; opacity: 0.9;">
                            <?php echo wp_kses_post($cta_desc); ?>
                        </div>

                        <div class="team-member-social" style="margin-bottom: 30px;">
                            <a href="#" aria-label="LinkedIn" style="color: inherit; opacity: 0.8; margin-right: 15px;"><i class="fa fa-linkedin"></i> LinkedIn</a>
                            <a href="#" aria-label="Twitter" style="color: inherit; opacity: 0.8;"><i class="fa fa-twitter"></i> Twitter</a>
                        </div>

                        <div class="portfolio-cta">
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
                    'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous Member:', 'coachpress' ) . '</span> <span class="nav-title">%title</span>',
                    'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next Member:', 'coachpress' ) . '</span> <span class="nav-title">%title</span>',
                )
            );
            ?>
        </div>

    <?php endwhile; ?>
</main>

<?php
get_footer();
