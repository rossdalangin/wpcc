<?php
/**
 * Template part for displaying the hero section content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CoachPress
 */

?>
<div class="hero-content-inner">
    <h1><?php echo esc_html( get_theme_mod( 'coachpress_hero_heading', __( 'Welcome to CoachPress', 'coachpress' ) ) ); ?></h1>
    <div class="section-description">
        <?php
        $content = get_theme_mod( 'coachpress_hero_subheading', __( 'Your journey to success starts here.', 'coachpress' ) );
        echo wp_kses_post( wpautop( $content ) );
        ?>
    </div>
    <div class="hero-cta">
        <a href="<?php echo esc_url( get_theme_mod( 'coachpress_hero_cta_url', '#' ) ); ?>" class="button button-primary"><?php echo esc_html( get_theme_mod( 'coachpress_hero_cta_text', __( 'Get Started', 'coachpress' ) ) ); ?></a>
        <?php if(get_theme_mod('coachpress_hero_cta_2_visibility', false)): ?>
        <a href="<?php echo esc_url( get_theme_mod( 'coachpress_hero_cta_2_url', '#' ) ); ?>" class="button button-ghost"><?php echo esc_html( get_theme_mod( 'coachpress_hero_cta_2_text', __( 'Learn More', 'coachpress' ) ) ); ?></a>
        <?php endif; ?>
    </div>
</div>
