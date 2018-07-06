<?php
/**
 * AccessPress Ray functions and definitions
 *
 * @package AccessPress Ray
 */


if ( ! function_exists( 'accesspress_ray_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function accesspress_ray_setup() {
	/**
	 * Set the content width based on the theme's design and stylesheet.
	 */
	global $content_width;
	/**
	 * Global content width.
	 */
	 if (!isset($content_width))
     	$content_width = 750; /* pixels */

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on AccessPress Ray, use a find and replace
	 * to change 'accesspress-ray' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'accesspress-ray', get_template_directory() . '/languages' );

	/**
	 * Add callback for custom TinyMCE editor stylesheets. (editor-style.css)
	 * @see http://codex.wordpress.org/Function_Reference/add_editor_style
	 */
	add_editor_style();	

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );	

	add_theme_support( 'html5', array( 'gallery', 'caption' ) );
	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

	add_image_size( 'accesspress-ray-event-thumbnail', 135, 100, true); //Latest News Events Small Image
	add_image_size( 'accesspress-ray-featured-thumbnail', 350, 245, true); //Featured Image
	add_image_size( 'accesspress-ray-portfolio-thumbnail', 400, 450, true); //Portfolio Image
	add_image_size( 'accesspress-ray-slider', 1920, 860, true ); //Slider image

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'accesspress-ray' ),
		'secondary' => __( 'Secondary Menu', 'accesspress-ray' ),
	) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'accesspress_ray_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

}
endif; // accesspress_ray_setup
add_action( 'after_setup_theme', 'accesspress_ray_setup' );

/**
 * Implement the Theme Option feature.
 */
require get_template_directory() . '/inc/accesspressray-custom-header.php';

/**
 * Implement the Theme Option feature.
 */
require get_template_directory() . '/inc/admin-panel/accesspressray-theme-options.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/accesspressray-template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/accesspressray-custom-functions.php';

/**
 * Implement the custom metabox feature
 */
require get_template_directory() . '/inc/accesspressray-custom-metabox.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load Woocommerce Hooks.
 */
require get_template_directory() . '/woocommerce/woocommerce-hooks.php';

/**
 * Load Welcome Page
 */
require get_template_directory() . '/welcome/welcome.php';