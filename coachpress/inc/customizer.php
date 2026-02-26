<?php
/**
 * CoachPress Theme Customizer
 *
 * @package CoachPress
 */

//======================================================================
// Sanitization Functions
//======================================================================
function coachpress_sanitize_background( $value ) {
    if ( strpos( $value, 'linear-gradient' ) !== false ) { return esc_attr( $value ); }
    return sanitize_hex_color( $value );
}
function coachpress_sanitize_responsive_font_size( $value ) {
    $value_decoded = json_decode( $value, true );
    if ( ! is_array( $value_decoded ) ) { return json_encode( array() ); }
    foreach ( $value_decoded as $device => $size ) { $value_decoded[$device] = sanitize_text_field( $size ); }
    return json_encode( $value_decoded );
}
function coachpress_sanitize_dimensions( $value ) {
    $value_decoded = json_decode( $value, true );
    if ( ! is_array( $value_decoded ) ) { return json_encode( array() ); }
    foreach ( $value_decoded as $side => $dimension ) { $value_decoded[$side] = sanitize_text_field( $dimension ); }
    return json_encode( $value_decoded );
}
function coachpress_sanitize_border_radius( $value ) {
    $value_decoded = json_decode( $value, true );
    if ( ! is_array( $value_decoded ) ) { return json_encode( array() ); }
    foreach ( $value_decoded as $corner => $radius ) { $value_decoded[$corner] = sanitize_text_field( $radius ); }
    return json_encode( $value_decoded );
}

function coachpress_sanitize_rgba_color( $color ) {
    if ( empty( $color ) || is_array( $color ) ) {
        return 'rgba(0,0,0,0)';
    }
    if ( false === strpos( $color, 'rgba' ) ) {
        return sanitize_hex_color( $color );
    }
    $color = str_replace( ' ', '', $color );
    sscanf( $color, 'rgba(%d,%d,%d,%f)', $red, $green, $blue, $alpha );
    $red   = ($red < 0 || $red > 255) ? 0 : $red;
    $green = ($green < 0 || $green > 255) ? 0 : $green;
    $blue  = ($blue < 0 || $blue > 255) ? 0 : $blue;
    $alpha = ($alpha < 0 || $alpha > 1) ? 0.5 : $alpha;
    return 'rgba(' . $red . ',' . $green . ',' . $blue . ',' . $alpha . ')';
}

function coachpress_sanitize_multi_select( $value ) {
    if ( ! is_array( $value ) ) {
        return array();
    }
    return array_map( 'absint', $value );
}

function coachpress_sanitize_opacity( $value ) {
    $value = floatval( $value );
    return ( $value >= 0 && $value <= 1 ) ? $value : 0.85;
}

// Load Custom Controls
require_once get_template_directory() . '/inc/gradient-control.php';
require_once get_template_directory() . '/inc/responsive-font-size-control.php';
require_once get_template_directory() . '/inc/border-radius-control.php';
require_once get_template_directory() . '/inc/dimensions-control.php';
require_once get_template_directory() . '/inc/google-font-control.php';
require_once get_template_directory() . '/inc/section-order-control.php';
require_once get_template_directory() . '/inc/maintenance-control.php';

// Load Customizer Sections
require_once get_template_directory() . '/inc/customizer/panels.php';
require_once get_template_directory() . '/inc/customizer/sections.php';
require_once get_template_directory() . '/inc/customizer/global-styles.php';
require_once get_template_directory() . '/inc/customizer/theme-settings.php';
require_once get_template_directory() . '/inc/customizer/homepage-sections.php';
require_once get_template_directory() . '/inc/customizer/page-templates.php';
require_once get_template_directory() . '/inc/customizer/maintenance.php';

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function coachpress_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'coachpress_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'coachpress_customize_partial_blogdescription',
		) );
	}

    coachpress_customize_panels( $wp_customize );
    coachpress_customize_sections( $wp_customize );
    coachpress_customize_global_styles( $wp_customize );
    coachpress_customize_theme_settings( $wp_customize );
    coachpress_customize_homepage_sections( $wp_customize );
    coachpress_customize_page_templates( $wp_customize );
    coachpress_customize_maintenance( $wp_customize );
}
add_action( 'customize_register', 'coachpress_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 */
function coachpress_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 */
function coachpress_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function coachpress_customize_preview_js() {
	wp_enqueue_script( 'coachpress-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), COACHPRESS_VERSION, true );
}
add_action( 'customize_preview_init', 'coachpress_customize_preview_js' );


function coachpress_customize_controls_scripts() {
    wp_enqueue_script( 'coachpress-gradient-control', get_template_directory_uri() . '/js/gradient-control.js', array( 'jquery', 'wp-color-picker' ), COACHPRESS_VERSION, true );
    wp_enqueue_style( 'coachpress-gradient-control', get_template_directory_uri() . '/css/gradient-control.css' );
    wp_enqueue_script( 'coachpress-responsive-font-size-control', get_template_directory_uri() . '/js/responsive-font-size-control.js', array( 'jquery', 'customize-controls' ), COACHPRESS_VERSION, true );
    wp_enqueue_style( 'coachpress-responsive-font-size-control', get_template_directory_uri() . '/css/responsive-font-size-control.css' );
    wp_enqueue_script( 'coachpress-border-radius-control', get_template_directory_uri() . '/js/border-radius-control.js', array( 'jquery', 'customize-controls' ), COACHPRESS_VERSION, true );
    wp_enqueue_style( 'coachpress-border-radius-control', get_template_directory_uri() . '/css/border-radius-control.css' );
    wp_enqueue_script( 'coachpress-dimensions-control', get_template_directory_uri() . '/js/dimensions-control.js', array( 'jquery', 'customize-controls' ), COACHPRESS_VERSION, true );
    wp_enqueue_style( 'coachpress-dimensions-control', get_template_directory_uri() . '/css/dimensions-control.css' );
    wp_enqueue_script( 'coachpress-maintenance-control', get_template_directory_uri() . '/js/maintenance-control.js', array( 'jquery', 'customize-controls' ), COACHPRESS_VERSION, true );
}
add_action( 'customize_controls_enqueue_scripts', 'coachpress_customize_controls_scripts' );



if ( class_exists( 'WP_Customize_Control' ) ) {
    class CoachPress_Multi_Select_Control extends WP_Customize_Control {
        public $type = 'coachpress-multi-select';

        public function render_content() {
            ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <select multiple="multiple" <?php $this->link(); ?>>
                    <?php
                    foreach ( $this->choices as $value => $label ) {
                        $selected = in_array( $value, (array) $this->value() ) ? 'selected="selected"' : '';
                        echo '<option value="' . esc_attr( $value ) . '"' . $selected . '>' . $label . '</option>';
                    }
                    ?>
                </select>
            </label>
            <?php
        }
    }
}
