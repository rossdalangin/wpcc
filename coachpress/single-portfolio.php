<?php
/**
 * The template for displaying single portfolio items
 *
 * @package CoachPress
 */

get_header();

$category = get_post_meta( get_the_ID(), '_portfolio_category', true ) ?: 'Strategy';
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

        <div class="portfolio-single-content container">
            <div class="grid-2-col">
                <div class="portfolio-main-text" data-aos="fade-right">
                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>
                </div>

                <aside class="portfolio-meta-sidebar" data-aos="fade-left">
                    <div class="portfolio-meta-card card">
                        <h3><?php _e('Project Overview', 'coachpress'); ?></h3>
                        <div class="portfolio-meta-item">
                            <strong><?php _e('Category:', 'coachpress'); ?></strong>
                            <span><?php echo esc_html($category); ?></span>
                        </div>
                        <div class="portfolio-meta-item">
                            <strong><?php _e('Date:', 'coachpress'); ?></strong>
                            <span><?php echo get_the_date(); ?></span>
                        </div>
                        <div class="portfolio-cta">
                            <a href="#contact" class="btn"><?php _e('Discuss a Project', 'coachpress'); ?></a>
                        </div>
                    </div>
                </aside>
            </div>
        </div>

        <?php
        the_post_navigation(
            array(
                'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous Project:', 'coachpress' ) . '</span> <span class="nav-title">%title</span>',
                'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next Project:', 'coachpress' ) . '</span> <span class="nav-title">%title</span>',
            )
        );
        ?>

    <?php endwhile; ?>
</main>

<?php
get_footer();
