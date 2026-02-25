<?php
/**
 * Template Name: Blog Archive Page
 *
 * @package CoachPress
 */

get_header();

$template_slug = coachpress_get_template_slug();
$banner_title_override = get_theme_mod( "coachpress_{$template_slug}_banner_title", 'Insights & Strategy' );
$banner_subtitle = get_theme_mod( "coachpress_{$template_slug}_banner_subtitle", 'Deep dives into the worlds of high-performance leadership and market domination.' );
$banner_img_id = get_theme_mod( "coachpress_{$template_slug}_page_banner_image" );

$banner_style = '';
if ( $banner_img_id ) {
    $banner_url = wp_get_attachment_image_url( $banner_img_id, 'full' );
    $banner_style = 'style="background-image: url(' . esc_url( $banner_url ) . '); background-size: cover; background-position: center;"';
}

$display_title = !empty($banner_title_override) ? $banner_title_override : get_the_title();
?>

<main id="primary" class="site-main">
    <header class="entry-header page-banner <?php echo $banner_img_id ? 'has-banner-image' : ''; ?>" <?php echo $banner_style; ?>>
        <?php if ( $banner_img_id ) : ?>
            <div class="page-banner-overlay"></div>
        <?php endif; ?>
        <div class="container">
            <h1 class="entry-title" data-aos="fade-up"><?php echo esc_html($display_title); ?></h1>
            <?php if (!empty($banner_subtitle)) : ?>
                <p class="entry-subtitle" data-aos="fade-up" data-aos-delay="100"><?php echo esc_html($banner_subtitle); ?></p>
            <?php endif; ?>
        </div>
    </header>

    <div class="blog-archive-container container">
        <?php
        $content_override = get_theme_mod( "coachpress_{$template_slug}_page_content" );
        if ( !empty($content_override) ) {
            echo '<div class="page-main-content-override entry-content" style="margin-bottom: 60px;">' . wp_kses_post($content_override) . '</div>';
        }
        ?>
        <div class="blog-grid grid-3-col">
            <?php
            $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
            $args = array(
                'post_type' => 'post',
                'paged'     => $paged,
            );
            $query = new WP_Query( $args );

            if ( $query->have_posts() ) :
                while ( $query->have_posts() ) :
                    $query->the_post();
                    get_template_part( 'template-parts/content', get_post_type() );
                endwhile;
                wp_reset_postdata();
            else :
                get_template_part( 'template-parts/content', 'none' );
            endif;
            ?>
        </div>

        <?php
        the_posts_pagination( array(
            'mid_size'  => 2,
            'prev_text' => __( 'Back', 'coachpress' ),
            'next_text' => __( 'Next', 'coachpress' ),
        ) );
        ?>
    </div>

    <?php
    // Allow modular sections below the blog grid if configured
    coachpress_display_page_sections();
    ?>

</main>

<?php
get_footer();
