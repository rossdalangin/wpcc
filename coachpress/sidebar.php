<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CoachPress
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	?>
    <aside id="secondary" class="widget-area site-sidebar">
        <section class="widget widget_search">
            <?php get_search_form(); ?>
        </section>

        <section class="widget widget_categories">
            <h2 class="widget-title"><?php _e('Categories', 'coachpress'); ?></h2>
            <ul>
                <?php wp_list_categories(array('title_li' => '')); ?>
            </ul>
        </section>

        <section class="widget widget_recent_entries">
            <h2 class="widget-title"><?php _e('Recent Insights', 'coachpress'); ?></h2>
            <ul>
                <?php
                $recent_posts = wp_get_recent_posts(array('numberposts' => 5, 'post_status' => 'publish'));
                foreach($recent_posts as $post) : ?>
                    <li>
                        <a href="<?php echo get_permalink($post['ID']); ?>"><?php echo $post['post_title']; ?></a>
                        <span class="post-date"><?php echo get_the_date('', $post['ID']); ?></span>
                    </li>
                <?php endforeach; wp_reset_query(); ?>
            </ul>
        </section>
    </aside>
    <?php
    return;
}
?>

<aside id="secondary" class="widget-area site-sidebar">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->
