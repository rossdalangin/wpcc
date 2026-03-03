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

$defaults = array(
    'intro_salutation' => 'Dear Consultant, Coach, or Agency Owner,',
    'problem_headline' => 'You’re elite. You’re an expert. You solve complex problems for high-level people.',
    'problem_sub'      => 'But does your website reflect that?',
    'pain_point'       => 'Be honest. When a $50k prospect lands on your homepage, do they see a world-class authority... or do they see a "budget" site that looks like it was pieced together by a hobbyist?',
    'solution_trigger' => 'The "Frankenstein Theme" era is over. It’s time for the Authority Engine.',
    'cta_text'         => 'SEE THE DEMO & GET STARTED NOW',
    'cta_url'          => '#',
);
?>

<main id="primary" class="site-main sales-letter-page">

    <header class="sales-letter-header page-banner" data-aos="fade">
        <div class="container text-align-center">
            <h1 class="entry-title" data-aos="fade-up"><?php echo esc_html($banner_title); ?></h1>
            <p class="entry-subtitle" data-aos="fade-up" data-aos-delay="100"><?php echo esc_html($banner_subtitle); ?></p>
        </div>
    </header>

    <div class="sales-letter-content container" style="max-width: 900px; padding: 120px 24px;">
        <div class="letter-intro" data-aos="fade-up">
            <p class="salutation"><?php echo esc_html(get_theme_mod('coachpress_sales_letter_salutation', $defaults['intro_salutation'])); ?></p>
            <h2 class="letter-headline"><?php echo esc_html(get_theme_mod('coachpress_sales_letter_problem_headline', $defaults['problem_headline'])); ?></h2>
            <p class="letter-subhead"><?php echo esc_html(get_theme_mod('coachpress_sales_letter_problem_sub', $defaults['problem_sub'])); ?></p>
        </div>

        <div class="letter-pain" data-aos="fade-up" data-aos-delay="100">
            <div class="highlight-box">
                <p><?php echo wp_kses_post(get_theme_mod('coachpress_sales_letter_pain_point', $defaults['pain_point'])); ?></p>
            </div>
            <p><?php _e('In the world of high-ticket consulting, your aesthetics are your "pre-frame." If you look like you’re struggling with your tech, they won’t trust you with their strategy.', 'coachpress'); ?></p>
            <p class="emphasis"><?php echo esc_html(get_theme_mod('coachpress_sales_letter_solution_trigger', $defaults['solution_trigger'])); ?></p>
        </div>

        <hr class="premium-divider" />

        <div class="letter-sections">
            <section class="letter-item" data-aos="fade-up">
                <h3>1. WHAT EXACTLY AM I SPENDING MY MONEY FOR?</h3>
                <p><?php _e('You aren\'t buying a theme. You\'re buying a professional infrastructure. CoachPress v2.3.0 is a complete, modular ecosystem designed specifically for the high-ticket expert.', 'coachpress'); ?></p>
                <ul class="premium-list">
                    <li><strong>The Visual Builder:</strong> A drag-and-drop section builder inside the WordPress Customizer. No complex plugins. No bloat. Just speed.</li>
                    <li><strong>The Power Tools:</strong> One-click demo population with professional content for 5 different niches.</li>
                    <li><strong>The Authority CPTs:</strong> Dedicated, styled engines for Case Studies, Portfolio, Team, and Services.</li>
                    <li><strong>Intelligent Design:</strong> Our built-in logic automatically recommends high-contrast colors based on your backgrounds.</li>
                </ul>
            </section>

            <section class="letter-item" data-aos="fade-up">
                <h3>2. WHAT'S IN IT FOR ME?</h3>
                <p><?php _e('Simple: Time, Authority, and Freedom.', 'coachpress'); ?></p>
                <ul class="premium-list">
                    <li><strong>Stop Fighting Tech:</strong> Launch a professional site by lunch and spend your afternoon closing deals.</li>
                    <li><strong>Look the Part:</strong> Commands higher fees by having a site that matches the caliber of your advice.</li>
                    <li><strong>Passive Trust-Building:</strong> Let your site do the selling. The narrative flow of CoachPress is a psychological funnel that qualifies leads for you.</li>
                </ul>
            </section>

            <section class="letter-item" data-aos="fade-up">
                <h3>3. WILL IT BE REALLY WORTH IT?</h3>
                <p><?php _e('Ask yourself: What is the lifetime value of just ONE new high-ticket client?', 'coachpress'); ?></p>
                <p><?php _e('Most consultants spend $10k-$20k with agencies to get a site this functional and professional. CoachPress gives you that same "Elite Agency" infrastructure for a fraction of the cost.', 'coachpress'); ?></p>
                <p><?php _e('It’s not just worth it—it’s the highest-ROI investment you can make in your brand this year. If this theme helps you close just one discovery call, it has paid for itself a hundred times over.', 'coachpress'); ?></p>
            </section>

            <section class="letter-item" data-aos="fade-up">
                <h3>4. CAN I TRUST YOU?</h3>
                <p><?php _e('We built CoachPress because we were tired of seeing brilliant experts fail because of bad tech.', 'coachpress'); ?></p>
                <p><?php _e('We are agency owners. We’ve spent 10 years looking at heatmaps, conversion data, and high-ticket sales flows. Every modular block in this theme was designed based on real-world results. We didn\'t build this for "bloggers"—we built this for people who sell expertise for a living.', 'coachpress'); ?></p>
            </section>
        </div>

        <div class="letter-conclusion text-align-center" data-aos="zoom-in">
            <hr class="premium-divider" />
            <h2 class="letter-headline"><?php _e('THE CHOICE IS YOURS.', 'coachpress'); ?></h2>
            <p><?php _e('You can keep fighting with plugins, looking at a "coming soon" page, and losing leads to competitors who look more professional.', 'coachpress'); ?></p>
            <p class="emphasis" style="margin-bottom: 50px;"><?php _e('Or, you can launch your Authority Engine today.', 'coachpress'); ?></p>

            <a href="<?php echo esc_url(get_theme_mod('coachpress_sales_letter_cta_url', $defaults['cta_url'])); ?>" class="btn btn-premium-cta">
                <?php echo esc_html(get_theme_mod('coachpress_sales_letter_cta_text', $defaults['cta_text'])); ?>
            </a>

            <div class="letter-signature" style="margin-top: 80px;">
                <p><?php _e('To your success,', 'coachpress'); ?></p>
                <p class="signature-name">The CoachPress Team</p>
                <p class="signature-title">Strategic Excellence in WordPress.</p>
            </div>

            <div class="letter-ps" style="margin-top: 60px; font-style: italic; opacity: 0.8;">
                <p><strong>P.S.</strong> <?php _e('For a limited time, when you grab CoachPress, you get the "Ultimate Marketing Kit" included in the root directory—with 90+ conversational captions, content ideas, and scripts to help you scale immediately.', 'coachpress'); ?></p>
            </div>
        </div>
    </div>

</main>

<?php
get_footer();
