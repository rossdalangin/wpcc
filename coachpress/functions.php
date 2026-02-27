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
	define( 'COACHPRESS_VERSION', '1.4.0' );
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


	wp_enqueue_script( 'coachpress-modal', get_template_directory_uri() . '/js/modal.js', array(), COACHPRESS_VERSION, true );

    wp_enqueue_script( 'coachpress-theme', get_template_directory_uri() . '/js/theme.js', array( 'swiper-js', 'aos-js' ), COACHPRESS_VERSION, true );

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
 * Shortcodes.
 */
require get_template_directory() . '/inc/shortcodes.php';

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

/**
 * Maintenance logic.
 */
require get_template_directory() . '/inc/theme-maintenance.php';


function coachpress_get_sections_data() {
    $data = array(
        'hero'          => ['label' => __( 'Hero', 'coachpress' ), 'title' => 'Accelerate Your Impact. Scale Your Vision.', 'description' => '', 'bg' => 'linear-gradient(135deg, #1a365d 0%, #2d3748 100%)'],
        'trust'         => ['label' => __( 'Trust', 'coachpress' ), 'title' => 'Trusted By Visionaries', 'description' => '', 'bg' => '#FFFFFF'],
        'problem'       => ['label' => __( 'Problem', 'coachpress' ), 'title' => 'Struggling to Scale?', 'description' => '', 'bg' => '#f7fafc'],
        'about-preview' => ['label' => __( 'About Preview', 'coachpress' ), 'title' => 'Strategic Guidance', 'description' => '', 'bg' => '#FFFFFF'],
        'services'      => ['label' => __( 'Services', 'coachpress' ), 'title' => 'Core Services', 'description' => 'Scalable solutions designed for modern leaders and consultants.', 'bg' => '#f7fafc'],
        'processes'     => ['label' => __( 'Processes', 'coachpress' ), 'title' => 'The Framework', 'description' => 'A rigorous, result-oriented approach to solving your most complex challenges.', 'bg' => '#FFFFFF'],
        'testimonials'  => ['label' => __( 'Testimonials', 'coachpress' ), 'title' => 'Client Success', 'description' => 'Real impact, real results. Hear from those who have walked the path.', 'bg' => '#f7fafc'],
        'portfolio'     => ['label' => __( 'Portfolio', 'coachpress' ), 'title' => 'Strategic Portfolio', 'description' => 'A curated selection of high-impact projects.', 'bg' => '#FFFFFF'],
        'case-studies'  => ['label' => __( 'Case Studies', 'coachpress' ), 'title' => 'Success Stories', 'description' => 'Deep dives into strategic transformations and measurable outcomes.', 'bg' => '#f7fafc'],
        'faqs'          => ['label' => __( 'FAQs', 'coachpress' ), 'title' => 'Common Questions', 'description' => 'Insights into how we work and what you can expect.', 'bg' => '#FFFFFF'],
        'cta'           => ['label' => __( 'CTA', 'coachpress' ), 'title' => 'Ready for the Next Level?', 'description' => 'Join an exclusive group of high-performers today.', 'bg' => 'linear-gradient(135deg, #2d3748 0%, #1a365d 100%)'],
        'contact'       => ['label' => __( 'Contact', 'coachpress' ), 'title' => 'Let’s Connect', 'description' => 'Ready to elevate your impact? Start the conversation today.', 'bg' => '#f7fafc'],
        'team'          => ['label' => __( 'Team', 'coachpress' ), 'title' => 'The Collective', 'description' => 'Expert minds coming together for your success.', 'bg' => '#FFFFFF'],
    );

    foreach ($data as $id => &$section) {
        $is_dark = coachpress_is_dark($section['bg']);
        $section['heading_color'] = $is_dark ? '#FFFFFF' : '#1a365d';
        $section['text_color'] = $is_dark ? '#e2e8f0' : '#2d3748';
    }

    return $data;
}

function coachpress_get_section_choices() {
    $data = coachpress_get_sections_data();
    $choices = array();
    foreach ($data as $id => $val) {
        $choices[$id] = $val['label'];
    }
    return $choices;
}


function coachpress_get_sections() {
    $sections = array();
    $default_order = 'hero,trust,problem,about-preview,services,processes,testimonials,portfolio,case-studies,faqs,cta,contact,team';
    $order = explode( ',', get_theme_mod( 'coachpress_section_order', $default_order ) );

    foreach ( $order as $section_id ) {
        if ( get_theme_mod( "coachpress_show_{$section_id}", true ) ) {
            $sections[] = $section_id;
        }
    }

    return $sections;
}

/**
 * Display sections for a specific page template.
 */
function coachpress_display_page_sections($setting_id = '', $default = '') {
    if (empty($setting_id)) {
        $slug = coachpress_get_template_slug();
        $setting_id = "coachpress_{$slug}_page_sections";
    }

    $sections_str = get_theme_mod($setting_id, $default);
    if (empty($sections_str)) return;

    $sections = explode(',', $sections_str);
    foreach ($sections as $section_id) {
        if (!empty($section_id)) {
            coachpress_display_section($section_id, true);
        }
    }
}

/**
 * Get the Customizer slug for the current page template.
 */
function coachpress_get_template_slug() {
    $template = get_page_template_slug();

    $mapping = array(
        'page-about.php'     => 'about',
        'page-services.php'  => 'services',
        'page-process.php'   => 'process',
        'page-portfolio.php' => 'portfolio',
        'page-team.php'      => 'team',
        'page-contact.php'   => 'contact',
        'page-blog.php'      => 'blog',
    );

    if (isset($mapping[$template])) {
        return $mapping[$template];
    }

    return get_post_field( 'post_name', get_the_ID() );
}

/**
 * Check if a color is dark.
 */
function coachpress_is_dark( $color ) {
    $color = str_replace( '#', '', $color );
    if ( strlen( $color ) === 3 ) {
        $color = $color[0] . $color[0] . $color[1] . $color[1] . $color[2] . $color[2];
    }
    if ( strlen( $color ) !== 6 ) {
        // If it's a gradient or something else, assume dark for our specific navy defaults
        if ( strpos( $color, 'gradient' ) !== false && strpos( $color, '#1a365d' ) !== false ) return true;
        return false;
    }

    $r = hexdec( substr( $color, 0, 2 ) );
    $g = hexdec( substr( $color, 2, 2 ) );
    $b = hexdec( substr( $color, 4, 2 ) );

    $brightness = ( ( $r * 299 ) + ( $g * 587 ) + ( $b * 114 ) ) / 1000;

    return $brightness < 155;
}

/**
 * Programmatically create necessary pages on theme activation.
 */
function coachpress_create_pages() {
    $pages = array(
        'Home' => array(
            'template' => 'page-home.php',
            'content'  => '',
        ),
        'About' => array(
            'template' => 'page-about.php',
            'content'  => 'Welcome to the About page.',
        ),
        'Services' => array(
            'template' => 'page-services.php',
            'content'  => 'Our professional services.',
        ),
        'Portfolio' => array(
            'template' => 'page-portfolio.php',
            'content'  => 'Check out our work.',
        ),
        'Process' => array(
            'template' => 'page-process.php',
            'content'  => 'How we work.',
        ),
        'Team' => array(
            'template' => 'page-team.php',
            'content'  => 'Meet our amazing team.',
        ),
        'Contact' => array(
            'template' => 'page-contact.php',
            'content'  => 'Get in touch with us.',
        ),
        'Blog' => array(
            'template' => 'page-blog.php',
            'content'  => 'Our latest insights.',
        ),
    );

    foreach ( $pages as $title => $data ) {
        $slug = sanitize_title($title);
        $page_check = get_page_by_path($slug);
        if ( ! isset( $page_check->ID ) ) {
            $page_id = wp_insert_post( array(
                'post_title'   => $title,
                'post_name'    => $slug,
                'post_content' => $data['content'],
                'post_status'  => 'publish',
                'post_type'    => 'page',
            ) );

            if ( $page_id && ! empty( $data['template'] ) ) {
                update_post_meta( $page_id, '_wp_page_template', $data['template'] );
            }

            if ( 'Home' === $title ) {
                update_option( 'show_on_front', 'page' );
                update_option( 'page_on_front', $page_id );
            }
        }
    }
}
add_action( 'after_switch_theme', 'coachpress_create_pages' );
