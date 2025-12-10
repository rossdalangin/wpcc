<?php
/**
 * CoachPress functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package CoachPress
 */

if ( ! defined( 'COACHPRESS_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'COACHPRESS_VERSION', '1.0.0' );
}

if ( ! function_exists( 'coachpress_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function coachpress_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on CoachPress, use a find and replace
		 * to change 'coachpress' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'coachpress', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'coachpress' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'coachpress_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'coachpress_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function coachpress_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'coachpress_content_width', 640 );
}
add_action( 'after_setup_theme', 'coachpress_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function coachpress_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'coachpress' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'coachpress' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'coachpress_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function coachpress_scripts() {
	wp_enqueue_style( 'coachpress-style', get_stylesheet_uri(), array(), COACHPRESS_VERSION );
	wp_style_add_data( 'coachpress-style', 'rtl', 'replace' );

    wp_enqueue_style( 'swiper-css', get_template_directory_uri() . '/lib/swiper/swiper-bundle.min.css', array(), '6.8.4' );
    wp_enqueue_script( 'swiper-js', get_template_directory_uri() . '/lib/swiper/swiper-bundle.min.js', array(), '6.8.4', true );

    wp_enqueue_style( 'aos-css', get_template_directory_uri() . '/lib/aos/aos.css', array(), '2.3.1' );
    wp_enqueue_script( 'aos-js', get_template_directory_uri() . '/lib/aos/aos.js', array(), '2.3.1', true );

    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/lib/font-awesome/css/font-awesome.min.css', array(), '4.7.0' );

    $body_font = get_theme_mod( 'coachpress_body_font', 'Lato' );
    $heading_font = get_theme_mod( 'coachpress_heading_font', 'Lora' );
    $font_url = "https://fonts.googleapis.com/css2?family={$body_font}:wght@300;400;700&family={$heading_font}:wght@400;700&display=swap";
    wp_enqueue_style( 'coachpress-fonts', $font_url, array(), null );

	wp_enqueue_script( 'coachpress-navigation', get_template_directory_uri() . '/js/navigation.js', array(), COACHPRESS_VERSION, true );

	wp_enqueue_script( 'coachpress-modal', get_template_directory_uri() . '/js/modal.js', array(), COACHPRESS_VERSION, true );

    wp_enqueue_script( 'coachpress-theme', get_template_directory_uri() . '/js/theme.js', array( 'swiper-js' ), COACHPRESS_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'coachpress_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load Custom Post Types.
 */
require get_template_directory() . '/inc/cpt.php';

/**
 * Load Section Ordering.
 */
require get_template_directory() . '/inc/section-ordering.php';

/**
 * Load Hero Section.
 */
require get_template_directory() . '/inc/hero-section.php';

/**
 * Load Header CTA.
 */
require get_template_directory() . '/inc/header-cta.php';

/**
 * Load Contact Page.
 */
require get_template_directory() . '/inc/contact-page.php';

/**
 * Load Section Order Control.
 */
require get_template_directory() . '/inc/section-order-control.php';

/**
 * Load Section Titles.
 */
require get_template_directory() . '/inc/section-titles.php';

/**
 * Load Social Media.
 */
require get_template_directory() . '/inc/social-media.php';

/**
 * Load CTA Section.
 */
require get_template_directory() . '/inc/cta-section.php';

/**
 * Load Google Font Control.
 */
require get_template_directory() . '/inc/google-font-control.php';

/**
 * Load Header Settings.
 */
require get_template_directory() . '/inc/header-settings.php';

/**
 * Load Footer Settings.
 */
require get_template_directory() . '/inc/footer-settings.php';

/**
 * Load Component Styles.
 */
require get_template_directory() . '/inc/component-styles.php';

/**
 * Load Form & Image Styles.
 */
require get_template_directory() . '/inc/form-image-styles.php';

/**
 * Load Layout Settings.
 */
require get_template_directory() . '/inc/layout-settings.php';

/**
 * Load New Sections.
 */
require get_template_directory() . '/inc/new-sections.php';

function coachpress_get_section_choices() {
    return array(
        'hero' => __( 'Hero', 'coachpress' ),
        'services' => __( 'Services', 'coachpress' ),
        'testimonials' => __( 'Testimonials', 'coachpress' ),
        'case-studies' => __( 'Case Studies', 'coachpress' ),
        'processes' => __( 'Processes', 'coachpress' ),
        'faqs' => __( 'FAQs', 'coachpress' ),
        'contact' => __( 'Contact', 'coachpress' ),
        'cta' => __( 'CTA', 'coachpress' ),
        'trust' => __( 'Trust', 'coachpress' ),
        'problem' => __( 'Problem', 'coachpress' ),
        'about-preview' => __( 'About Preview', 'coachpress' ),
    );
}

function coachpress_dynamic_css() {
    ?>
    <style type="text/css">
        :root {
            --coachpress-text-color: <?php echo esc_html( get_theme_mod( 'coachpress_text_color', '#333333' ) ); ?>;
            --coachpress-body-font-family: '<?php echo esc_html( get_theme_mod( 'coachpress_body_font', 'Lato' ) ); ?>', sans-serif;
            --coachpress-body-font-weight: <?php echo esc_html( get_theme_mod( 'coachpress_body_font_weight', '400' ) ); ?>;
            --coachpress-body-line-height: <?php echo esc_html( get_theme_mod( 'coachpress_body_line_height', '1.6' ) ); ?>;
            --coachpress-heading-font-family: '<?php echo esc_html( get_theme_mod( 'coachpress_heading_font', 'Lora' ) ); ?>', serif;
            --coachpress-heading-font-weight: <?php echo esc_html( get_theme_mod( 'coachpress_heading_font_weight', '700' ) ); ?>;
            --coachpress-heading-letter-spacing: <?php echo esc_html( get_theme_mod( 'coachpress_heading_letter_spacing', '1px' ) ); ?>;
            --coachpress-primary-color: <?php echo esc_html( get_theme_mod( 'coachpress_primary_color', '#0D2F4F' ) ); ?>;
            --coachpress-accent-color: <?php echo esc_html( get_theme_mod( 'coachpress_accent_color', '#FFC107' ) ); ?>;
            --coachpress-secondary-color: <?php echo esc_html( get_theme_mod( 'coachpress_secondary_color', '#F5F5F5' ) ); ?>;

            --coachpress-header-bg-color: <?php echo esc_html( get_theme_mod( 'coachpress_header_bg_color', '#FFFFFF' ) ); ?>;
            --coachpress-header-text-color: <?php echo esc_html( get_theme_mod( 'coachpress_header_text_color', '#333333' ) ); ?>;
            --coachpress-header-link-color: <?php echo esc_html( get_theme_mod( 'coachpress_header_link_color', '#0D2F4F' ) ); ?>;
            --coachpress-header-link-hover-color: <?php echo esc_html( get_theme_mod( 'coachpress_header_link_hover_color', '#FFC107' ) ); ?>;
            --coachpress-header-hamburger-color: <?php echo esc_html( get_theme_mod( 'coachpress_header_hamburger_color', '#333333' ) ); ?>;
            --coachpress-header-padding-y: <?php echo esc_html( get_theme_mod( 'coachpress_header_padding_y', '15px' ) ); ?>;

            --coachpress-mobile-menu-bg-color: <?php echo esc_html( get_theme_mod( 'coachpress_mobile_menu_bg_color', '#FFFFFF' ) ); ?>;
            --coachpress-mobile-menu-hover-bg-color: <?php echo esc_html( get_theme_mod( 'coachpress_mobile_menu_hover_bg_color', '#F5F5F5' ) ); ?>;

            --coachpress-footer-bg-color: <?php echo esc_html( get_theme_mod( 'coachpress_footer_bg_color', '#1A1A1A' ) ); ?>;
            --coachpress-footer-text-color: <?php echo esc_html( get_theme_mod( 'coachpress_footer_text_color', '#FFFFFF' ) ); ?>;
            --coachpress-footer-link-color: <?php echo esc_html( get_theme_mod( 'coachpress_footer_link_color', '#FFFFFF' ) ); ?>;
            --coachpress-footer-link-hover-color: <?php echo esc_html( get_theme_mod( 'coachpress_footer_link_hover_color', '#FFC107' ) ); ?>;
            --coachpress-footer-padding-y: <?php echo esc_html( get_theme_mod( 'coachpress_footer_padding_y', '60px' ) ); ?>;

            --coachpress-card-bg-color: <?php echo esc_html( get_theme_mod( 'coachpress_card_bg_color', '#FFFFFF' ) ); ?>;
            --coachpress-card-border-radius: <?php echo esc_html( get_theme_mod( 'coachpress_card_border_radius', '4px' ) ); ?>;
            --coachpress-card-box-shadow: <?php echo esc_html( get_theme_mod( 'coachpress_card_box_shadow', '0 0 25px rgba(0,0,0,0.07)' ) ); ?>;
            --coachpress-card-hover-box-shadow: <?php echo esc_html( get_theme_mod( 'coachpress_card_hover_box_shadow', '0 12px 25px rgba(0,0,0,0.1)' ) ); ?>;

            --coachpress-image-border-radius: <?php echo esc_html( get_theme_mod( 'coachpress_image_border_radius', '4px' ) ); ?>;
            --coachpress-form-field-bg-color: <?php echo esc_html( get_theme_mod( 'coachpress_form_field_bg_color', '#FFFFFF' ) ); ?>;
            --coachpress-form-field-text-color: <?php echo esc_html( get_theme_mod( 'coachpress_form_field_text_color', '#333333' ) ); ?>;
            --coachpress-form-field-border-color: <?php echo esc_html( get_theme_mod( 'coachpress_form_field_border_color', '#CCCCCC' ) ); ?>;
            --coachpress-form-field-border-radius: <?php echo esc_html( get_theme_mod( 'coachpress_form_field_border_radius', '4px' ) ); ?>;

            --coachpress-container-width: <?php echo esc_html( get_theme_mod( 'coachpress_container_width', '1140px' ) ); ?>;

            --coachpress-body-font-size: <?php echo esc_html( get_theme_mod( 'coachpress_body_font_size', '16px' ) ); ?>;
            --coachpress-h1-font-size: <?php echo esc_html( get_theme_mod( 'coachpress_h1_font_size', '2.8rem' ) ); ?>;
            --coachpress-h2-font-size: <?php echo esc_html( get_theme_mod( 'coachpress_h2_font_size', '2.2rem' ) ); ?>;
            --coachpress-h3-font-size: <?php echo esc_html( get_theme_mod( 'coachpress_h3_font_size', '1.5rem' ) ); ?>;
            --coachpress-h4-font-size: <?php echo esc_html( get_theme_mod( 'coachpress_h4_font_size', '1.25rem' ) ); ?>;
            --coachpress-h5-font-size: <?php echo esc_html( get_theme_mod( 'coachpress_h5_font_size', '1.1rem' ) ); ?>;
            --coachpress-h6-font-size: <?php echo esc_html( get_theme_mod( 'coachpress_h6_font_size', '1rem' ) ); ?>;

            --coachpress-hero-bg: <?php echo esc_html( get_theme_mod( 'coachpress_hero_bg_color', '#F5F5F5' ) ); ?>;
            --coachpress-hero-heading-color: <?php echo esc_html( get_theme_mod( 'coachpress_hero_heading_color', '#FFFFFF' ) ); ?>;

            --coachpress-form-width: <?php echo esc_html( get_theme_mod( 'coachpress_form_width', '100%' ) ); ?>;
            --coachpress-image-width: <?php echo esc_html( get_theme_mod( 'coachpress_image_width', '100%' ) ); ?>;
        }

    <?php
    // Font Sizes
    for ( $i = 1; $i <= 6; $i++ ) {
        $font_size_json = get_theme_mod( "coachpress_h{$i}_font_size" );
        if ( $font_size_json ) {
            $font_sizes = json_decode( $font_size_json, true );
            if ( isset( $font_sizes['desktop'] ) && ! empty( $font_sizes['desktop'] ) ) {
                echo "h{$i} { font-size: " . esc_html( $font_sizes['desktop'] ) . "; }";
            }
            if ( isset( $font_sizes['tablet'] ) && ! empty( $font_sizes['tablet'] ) ) {
                echo "@media (max-width: 768px) { h{$i} { font-size: " . esc_html( $font_sizes['tablet'] ) . "; } }";
            }
            if ( isset( $font_sizes['mobile'] ) && ! empty( $font_sizes['mobile'] ) ) {
                echo "@media (max-width: 480px) { h{$i} { font-size: " . esc_html( $font_sizes['mobile'] ) . "; } }";
            }
        }
    }

    // Border Radius
    $border_radius_json = get_theme_mod( 'coachpress_image_border_radius' );
    if ( $border_radius_json ) {
        $border_radii = json_decode( $border_radius_json, true );
        echo "img, .wp-post-image {
            border-top-left-radius: " . esc_html( $border_radii['top-left'] ) . ";
            border-top-right-radius: " . esc_html( $border_radii['top-right'] ) . ";
            border-bottom-right-radius: " . esc_html( $border_radii['bottom-right'] ) . ";
            border-bottom-left-radius: " . esc_html( $border_radii['bottom-left'] ) . ";
        }";
    }

    // Section Padding
    $section_padding_json = get_theme_mod( 'coachpress_section_padding' );
    if ( $section_padding_json ) {
        $section_paddings = json_decode( $section_padding_json, true );
        echo "section {
            padding-top: " . esc_html( $section_paddings['top'] ) . ";
            padding-right: " . esc_html( $section_paddings['right'] ) . ";
            padding-bottom: " . esc_html( $section_paddings['bottom'] ) . ";
            padding-left: " . esc_html( $section_paddings['left'] ) . ";
        }";
    }

    // Container Width
    $container_width = get_theme_mod( 'coachpress_container_width' );
    if ( $container_width ) {
        echo ".container { max-width: " . esc_html( $container_width ) . "; }";
    }
    ?>
    </style>
    <?php
}
add_action( 'wp_head', 'coachpress_dynamic_css' );

function coachpress_get_sections() {
    $sections = array();
    $order = explode( ',', get_theme_mod( 'coachpress_section_order', 'hero,services,testimonials,case-studies,processes,faqs,cta,contact' ) );

    foreach ( $order as $section_id ) {
        if ( get_theme_mod( "coachpress_section_visibility[$section_id]", true ) ) {
            $sections[] = $section_id;
        }
    }

    return $sections;
}
