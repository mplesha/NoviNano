<?php
/**
 * WEN Business functions and definitions
 *
 * @package WEN Business
 */

/**
 * Include WEN Customizer.
 */
require trailingslashit( get_template_directory() ) . 'wen-customizer/init.php';

/**
 * Init customizer.
 */
require trailingslashit( get_template_directory() ) . 'inc/init.php';

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1140; /* pixels */
}

if ( ! function_exists( 'wen_business_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function wen_business_setup() {

		/*
		 * Make theme available for translation.
		 */
		load_theme_textdomain( 'wen-business' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 */
		add_theme_support( 'title-tag' );

		// Editor style.
		$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		add_editor_style( 'assets/css/editor-style' . $min . '.css' );

		/*
		 * Enable support for custom logo.
		 */
		add_theme_support( 'custom-logo', array(
			'width'       => 200,
			'flex-height' => true,
		) );

		/*
		 * Enable widget selective refresh Customizer.
		 */
		add_theme_support( 'customize-selective-refresh-widgets' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 */
		add_theme_support( 'post-thumbnails' );

		// Register image size for featured slider.
		add_image_size( 'wen-business-slider', 1600, 440, true );

		// Register nav menu locations.
		register_nav_menus( array(
			'primary'  => __( 'Primary Menu', 'wen-business' ),
			'footer'   => __( 'Footer Menu', 'wen-business' ),
			'social'   => __( 'Social Menu', 'wen-business' ),
			'notfound' => __( '404 Menu', 'wen-business' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		/*
		 * Enable support for Post Formats.
		 */
		add_theme_support( 'post-formats', array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'wen_business_custom_background_args', array(
			'default-color' => 'f5f4f4',
			'default-image' => '',
		) ) );

		global $wen_business_default_theme_options;
		$wen_business_default_theme_options = wen_business_get_default_theme_options();

	}
endif;

add_action( 'after_setup_theme', 'wen_business_setup' );

/**
 * Register widget area.
 */
function wen_business_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Primary Sidebar', 'wen-business' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
		) );
	register_sidebar( array(
		'name'          => __( 'Secondary Sidebar', 'wen-business' ),
		'id'            => 'sidebar-2',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
		) );
	register_sidebar( array(
		'name'          => __( 'Front Page Widget Area', 'wen-business' ),
		'id'            => 'sidebar-front-page-widget-area',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
		) );
	register_sidebar( array(
		'name'          => __( 'Contact Sidebar', 'wen-business' ),
		'id'            => 'sidebar-contact',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
		) );
}

add_action( 'widgets_init', 'wen_business_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function wen_business_scripts() {

	$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	wp_enqueue_style( 'wen-business-bootstrap', get_template_directory_uri() . '/third-party/bootstrap/bootstrap' . $min . '.css', '', '3.3.5' );

	wp_enqueue_style( 'wen-business-fontawesome', get_template_directory_uri() . '/third-party/font-awesome/css/font-awesome' . $min . '.css', '', '4.7.0' );

	wp_enqueue_style( 'wen-business-google-fonts-open-sans', '//fonts.googleapis.com/css?family=Open+Sans:600,400,300,700' );

	wp_enqueue_style( 'wen-business-google-fonts-lato', '//fonts.googleapis.com/css?family=Lato:400,300,700,400italic,300italic' );

	wp_enqueue_style( 'wen-business-style', get_stylesheet_uri(), array(), '1.5.3' );

	wp_enqueue_style( 'wen-business-mmenu-style', get_template_directory_uri() .'/third-party/mmenu/css/jquery.mmenu' . $min . '.css', '', '4.7.5' );

	wp_enqueue_style( 'wen-business-responsive-style', get_template_directory_uri() .'/assets/css/responsive' . $min . '.css', '', '1.1' );

	wp_enqueue_script( 'wen-business-html5', get_template_directory_uri() . '/assets/js/html5shiv' . $min . '.js' );
	wp_script_add_data( 'wen-business-html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'wen-business-respond', get_template_directory_uri() . '/assets/js/respond' . $min . '.js' );
	wp_script_add_data( 'wen-business-respond', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'wen-business-navigation', get_template_directory_uri() . '/assets/js/navigation' . $min . '.js', array(), '20120206', true );

	$go_to_top = wen_business_get_option( 'go_to_top' );
	if ( 1 == $go_to_top ) {
		wp_enqueue_script( 'wen-business-goto-top', get_template_directory_uri() . '/assets/js/goto-top' . $min . '.js', array( 'jquery' ), '1.0.0', true );
	}

	wp_enqueue_script( 'wen-business-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix' . $min . '.js', array(), '20130115', true );

	wp_enqueue_script( 'wen-business-cycle2-script', get_template_directory_uri() . '/third-party/cycle2/js/jquery.cycle2' . $min . '.js', array( 'jquery' ), '2.1.6', true );

	wp_enqueue_script( 'wen-business-mmenu-script', get_template_directory_uri() . '/third-party/mmenu/js/jquery.mmenu' . $min . '.js', array( 'jquery' ), '4.7.5', true );

	wp_enqueue_script( 'wen-business-custom-js', get_template_directory_uri() . '/assets/js/custom' . $min . '.js', array( 'jquery' ), '1.1', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'wen_business_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
