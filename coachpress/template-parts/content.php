<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CoachPress
 */

?>

<?php
$is_grid_item = !is_singular('post') || !in_the_loop();
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( $is_grid_item ? 'post-card card' : 'post-single-article' ); ?> data-aos="fade-up">
	<?php if ( $is_grid_item ) : ?>
        <?php if ( has_post_thumbnail() ) : ?>
            <div class="post-thumbnail">
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('large'); ?>
                </a>
            </div>
        <?php endif; ?>

        <div class="post-card-content">
            <header class="entry-header">
                <div class="entry-meta muted-text">
                    <?php coachpress_posted_on(); ?>
                </div>
                <?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
            </header>

            <div class="entry-excerpt">
                <?php the_excerpt(); ?>
            </div>

            <footer class="entry-footer">
                <a href="<?php the_permalink(); ?>" class="read-more-link"><?php _e('Read Article', 'coachpress'); ?> <i class="fa fa-long-arrow-right"></i></a>
            </footer>
        </div>

    <?php else : ?>
        <div class="entry-content">
            <?php
            the_content(
                sprintf(
                    wp_kses(
                        /* translators: %s: Name of current post. Only visible to screen readers */
                        __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'coachpress' ),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    wp_kses_post( get_the_title() )
                )
            );

            wp_link_pages(
                array(
                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'coachpress' ),
                    'after'  => '</div>',
                )
            );
            ?>
        </div><!-- .entry-content -->

        <footer class="entry-footer container">
            <?php coachpress_entry_footer(); ?>
        </footer><!-- .entry-footer -->
    <?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
