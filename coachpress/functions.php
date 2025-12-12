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
 * Dynamic CSS.
 */
require get_template_directory() . '/inc/dynamic-css.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	// require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load Custom Post Types.
 */
require get_template_directory() . '/inc/cpt.php';


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
