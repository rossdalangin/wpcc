<?php
/**
 * Template Name: Premium Sales Letter
 *
 * @package CoachPress
 */

get_header();

$template_slug = 'sales-letter';
$banner_title = get_theme_mod( "coachpress_{$template_slug}_banner_title", 'Stop Being the Best-Kept Secret in Your Industry.' );
$banner_subtitle = get_theme_mod( "coachpress_{$template_slug}_banner_subtitle", 'Launch Your High-Ticket Authority Site in 60 Seconds.' );
$banner_img_id = get_theme_mod( "coachpress_{$template_slug}_page_banner_image" );

$banner_style = '';
if ( $banner_img_id ) {
    $banner_url = wp_get_attachment_image_url( $banner_img_id, 'full' );
    $banner_style = 'style="background-image: url(' . esc_url( $banner_url ) . '); background-size: cover; background-position: center;"';
}

$defaults = array(
    'salutation' => 'Dear Consultant, Coach, or Agency Owner,',
    'problem_headline' => 'You’re elite. You’re an expert. You solve complex problems for high-level people.',
    'problem_sub'      => 'But does your website reflect that?',
    'pain_point'       => 'Be honest. When a $50k prospect lands on your homepage, do they see a world-class authority... or do they see a "budget" site that looks like it was pieced together by a hobbyist?',
    'pain_point_sub'   => 'In the world of high-ticket consulting, your aesthetics are your "pre-frame." If you look like you’re struggling with your tech, they won’t trust you with their strategy.',
    'solution_trigger' => 'The "Frankenstein Theme" era is over. It’s time for the Authority Engine.',
    'cta_text'         => 'SEE THE DEMO & GET STARTED NOW',
    'cta_url'          => '#',
    'point_1_title'    => '1. WHAT EXACTLY AM I SPENDING MY MONEY FOR?',
    'point_1_content'  => 'You aren\'t buying a theme. You\'re buying a professional infrastructure. CoachPress v2.3.0 is a complete, modular ecosystem designed specifically for the high-ticket expert.',
    'point_1_list'     => '<li><strong>The Visual Builder:</strong> A drag-and-drop section builder inside the WordPress Customizer. No complex plugins. No bloat. Just speed.</li><li><strong>The Power Tools:</strong> One-click demo population with professional content for 5 different niches.</li><li><strong>The Authority CPTs:</strong> Dedicated, styled engines for Case Studies, Portfolio, Team, and Services.</li><li><strong>Intelligent Design:</strong> Our built-in logic automatically recommends high-contrast colors based on your backgrounds.</li>',
    'point_2_title'    => '2. WHAT\'S IN IT FOR ME?',
    'point_2_content'  => 'Simple: Time, Authority, and Freedom.',
    'point_2_list'     => '<li><strong>Stop Fighting Tech:</strong> Launch a professional site by lunch and spend your afternoon closing deals.</li><li><strong>Look the Part:</strong> Commands higher fees by having a site that matches the caliber of your advice.</li><li><strong>Passive Trust-Building:</strong> Let your site do the selling. The narrative flow of CoachPress is a psychological funnel that qualifies leads for you.</li>',
    'point_3_title'    => '3. WILL IT BE REALLY WORTH IT?',
    'point_3_content'  => '<p>Ask yourself: What is the lifetime value of just ONE new high-ticket client?</p><p>Most consultants spend $10k-$20k with agencies to get a site this functional and professional. CoachPress gives you that same "Elite Agency" infrastructure for a fraction of the cost.</p><p>It’s not just worth it—it’s the highest-ROI investment you can make in your brand this year. If this theme helps you close just one discovery call, it has paid for itself a hundred times over.</p>',
    'point_4_title'    => '4. CAN I TRUST YOU?',
    'point_4_content'  => '<p>We built CoachPress because we were tired of seeing brilliant experts fail because of bad tech.</p><p>We are agency owners. We’ve spent 10 years looking at heatmaps, conversion data, and high-ticket sales flows. Every modular block in this theme was designed based on real-world results. We didn\'t build this for "bloggers"—we built this for people who sell expertise for a living.</p>',
    'conclusion_headline' => 'THE CHOICE IS YOURS.',
    'conclusion_text' => '<p>You can keep fighting with plugins, looking at a "coming soon" page, and losing leads to competitors who look more professional.</p><p class="emphasis" style="margin-bottom: 50px;">Or, you can launch your Authority Engine today.</p>',
    'signature_intro'  => 'To your success,',
    'signature_name'   => 'The CoachPress Team',
    'signature_title'  => 'Strategic Excellence in WordPress.',
    'ps_text'          => 'For a limited time, when you grab CoachPress, you get the "Ultimate Marketing Kit" included in the root directory—with 90+ conversational captions, content ideas, and scripts to help you scale immediately.',
);
?>

<main id="primary" class="site-main sales-letter-page">

    <header class="sales-letter-header page-banner <?php echo $banner_img_id ? 'has-banner-image' : ''; ?>" <?php echo $banner_style; ?> data-aos="fade">
        <?php if ( $banner_img_id ) : ?>
            <div class="page-banner-overlay"></div>
        <?php endif; ?>
        <div class="container text-align-center">
            <h1 class="entry-title" data-aos="fade-up"><?php echo esc_html($banner_title); ?></h1>
            <?php if (!empty($banner_subtitle)) : ?>
                <p class="entry-subtitle" data-aos="fade-up" data-aos-delay="100"><?php echo esc_html($banner_subtitle); ?></p>
            <?php endif; ?>
        </div>
    </header>

    <div class="sales-letter-content container" style="max-width: 900px; padding: 120px 24px;">

        <?php
        $content_override = get_theme_mod( "coachpress_{$template_slug}_page_content" );
        if ( !empty($content_override) ) {
            echo '<div class="page-main-content-override entry-content" style="margin-bottom: 80px; font-size: 1.25rem;">' . wp_kses_post($content_override) . '</div>';
            echo '<hr class="premium-divider" />';
        }
        ?>

        <div class="letter-intro" data-aos="fade-up">
            <p class="salutation"><?php echo esc_html(get_theme_mod('coachpress_sales_letter_salutation', $defaults['salutation'])); ?></p>
            <h2 class="letter-headline"><?php echo esc_html(get_theme_mod('coachpress_sales_letter_problem_headline', $defaults['problem_headline'])); ?></h2>
            <p class="letter-subhead"><?php echo esc_html(get_theme_mod('coachpress_sales_letter_problem_sub', $defaults['problem_sub'])); ?></p>
        </div>

        <div class="letter-pain" data-aos="fade-up" data-aos-delay="100">
            <div class="highlight-box">
                <p><?php echo wp_kses_post(get_theme_mod('coachpress_sales_letter_pain_point', $defaults['pain_point'])); ?></p>
            </div>
            <p><?php echo esc_html(get_theme_mod('coachpress_sl_pain_point_sub', $defaults['pain_point_sub'])); ?></p>
            <p class="emphasis"><?php echo esc_html(get_theme_mod('coachpress_sales_letter_solution_trigger', $defaults['solution_trigger'])); ?></p>
        </div>

        <hr class="premium-divider" />

        <div class="letter-sections">
            <section class="letter-item" data-aos="fade-up">
                <h3><?php echo esc_html(get_theme_mod('coachpress_sl_point_1_title', $defaults['point_1_title'])); ?></h3>
                <p><?php echo wp_kses_post(get_theme_mod('coachpress_sl_point_1_content', $defaults['point_1_content'])); ?></p>
                <ul class="premium-list">
                    <?php echo wp_kses_post(get_theme_mod('coachpress_sl_point_1_list', $defaults['point_1_list'])); ?>
                </ul>
            </section>

            <section class="letter-item" data-aos="fade-up">
                <h3><?php echo esc_html(get_theme_mod('coachpress_sl_point_2_title', $defaults['point_2_title'])); ?></h3>
                <p><?php echo wp_kses_post(get_theme_mod('coachpress_sl_point_2_content', $defaults['point_2_content'])); ?></p>
                <ul class="premium-list">
                    <?php echo wp_kses_post(get_theme_mod('coachpress_sl_point_2_list', $defaults['point_2_list'])); ?>
                </ul>
            </section>

            <section class="letter-item" data-aos="fade-up">
                <h3><?php echo esc_html(get_theme_mod('coachpress_sl_point_3_title', $defaults['point_3_title'])); ?></h3>
                <div class="point-content">
                    <?php echo wp_kses_post(get_theme_mod('coachpress_sl_point_3_content', $defaults['point_3_content'])); ?>
                </div>
            </section>

            <section class="letter-item" data-aos="fade-up">
                <h3><?php echo esc_html(get_theme_mod('coachpress_sl_point_4_title', $defaults['point_4_title'])); ?></h3>
                <div class="point-content">
                    <?php echo wp_kses_post(get_theme_mod('coachpress_sl_point_4_content', $defaults['point_4_content'])); ?>
                </div>
            </section>
        </div>

        <div class="letter-conclusion text-align-center" data-aos="zoom-in">
            <hr class="premium-divider" />
            <h2 class="letter-headline"><?php echo esc_html(get_theme_mod('coachpress_sl_conclusion_headline', $defaults['conclusion_headline'])); ?></h2>
            <div class="conclusion-text">
                <?php echo wp_kses_post(get_theme_mod('coachpress_sl_conclusion_text', $defaults['conclusion_text'])); ?>
            </div>

            <a href="<?php echo esc_url(get_theme_mod('coachpress_sales_letter_cta_url', $defaults['cta_url'])); ?>" class="btn btn-premium-cta">
                <?php echo esc_html(get_theme_mod('coachpress_sales_letter_cta_text', $defaults['cta_text'])); ?>
            </a>

            <div class="letter-signature" style="margin-top: 80px;">
                <p><?php echo esc_html(get_theme_mod('coachpress_sl_signature_intro', $defaults['signature_intro'])); ?></p>
                <p class="signature-name"><?php echo esc_html(get_theme_mod('coachpress_sl_signature_name', $defaults['signature_name'])); ?></p>
                <p class="signature-title"><?php echo esc_html(get_theme_mod('coachpress_sl_signature_title', $defaults['signature_title'])); ?></p>
            </div>

            <?php if (!empty(get_theme_mod('coachpress_sl_ps_text', $defaults['ps_text']))) : ?>
                <div class="letter-ps" style="margin-top: 60px; font-style: italic; opacity: 0.8;">
                    <p><strong>P.S.</strong> <?php echo wp_kses_post(get_theme_mod('coachpress_sl_ps_text', $defaults['ps_text'])); ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php coachpress_display_page_sections(); ?>

</main>

<?php
get_footer();
