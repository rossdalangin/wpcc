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

    wp_enqueue_style( 'coachpress-fonts', 'https://fonts.googleapis.com/css2?family=Lora:wght@700&family=Lato:wght@400&display=swap', array(), null );

	wp_enqueue_script( 'coachpress-navigation', get_template_directory_uri() . '/js/navigation.js', array(), COACHPRESS_VERSION, true );

	wp_enqueue_script( 'coachpress-modal', get_template_directory_uri() . '/js/modal.js', array(), COACHPRESS_VERSION, true );

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

function coachpress_get_section_choices() {
    return array(
        'hero' => __( 'Hero', 'coachpress' ),
        'services' => __( 'Services', 'coachpress' ),
        'testimonials' => __( 'Testimonials', 'coachpress' ),
        'case-studies' => __( 'Case Studies', 'coachpress' ),
        'processes' => __( 'Processes', 'coachpress' ),
        'faqs' => __( 'FAQs', 'coachpress' ),
        'contact' => __( 'Contact', 'coachpress' ),
    );
}

function coachpress_dynamic_css() {
    ?>
    <style type="text/css">
        body {
            color: <?php echo esc_html( get_theme_mod( 'coachpress_text_color', '#384047' ) ); ?>;
            font-family: '<?php echo esc_html( get_theme_mod( 'coachpress_body_font', 'Lato' ) ); ?>', sans-serif;
            font-weight: <?php echo esc_html( get_theme_mod( 'coachpress_body_font_weight', '400' ) ); ?>;
            line-height: <?php echo esc_html( get_theme_mod( 'coachpress_body_line_height', '1.6' ) ); ?>;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: '<?php echo esc_html( get_theme_mod( 'coachpress_heading_font', 'Lora' ) ); ?>', serif;
            font-weight: <?php echo esc_html( get_theme_mod( 'coachpress_heading_font_weight', '700' ) ); ?>;
            letter-spacing: <?php echo esc_html( get_theme_mod( 'coachpress_heading_letter_spacing', '1px' ) ); ?>;
        }

        a {
            color: <?php echo esc_html( get_theme_mod( 'coachpress_primary_color', '#001d5c' ) ); ?>;
        }

        .main-navigation ul li a:hover {
            border-bottom-color: <?php echo esc_html( get_theme_mod( 'coachpress_primary_color', '#001d5c' ) ); ?>;
        }

        blockquote {
            border-left-color: <?php echo esc_html( get_theme_mod( 'coachpress_primary_color', '#001d5c' ) ); ?>;
        }

        .button,
        input[type="submit"] {
            background-color: <?php echo esc_html( get_theme_mod( 'coachpress_primary_color', '#001d5c' ) ); ?>;
            color: #fff;
        }

        .button:hover,
        input[type="submit"]:hover {
            background-color: <?php echo esc_html( get_theme_mod( 'coachpress_accent_color', '#c7a174' ) ); ?>;
        }

        .site-header {
            background-color: <?php echo esc_html( get_theme_mod( 'coachpress_secondary_color', '#e7e0cd' ) ); ?>;
        }
    </style>
    <?php
}
add_action( 'wp_head', 'coachpress_dynamic_css' );

function coachpress_get_sections() {
    $sections = array();
    $order = explode( ',', get_theme_mod( 'coachpress_section_order', 'hero,services,testimonials,case-studies,processes,faqs,contact' ) );

    foreach ( $order as $section_id ) {
        if ( get_theme_mod( "coachpress_section_visibility[$section_id]", true ) ) {
            $sections[] = $section_id;
        }
    }

    return $sections;
}
