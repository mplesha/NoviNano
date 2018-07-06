<?php
/**
 * Blockchain_Lite functions and definitions
 */

if ( ! defined( 'BLOCKCHAIN_LITE_NAME' ) ) {
	define( 'BLOCKCHAIN_LITE_NAME', 'blockchain-lite' );
}
if ( ! defined( 'BLOCKCHAIN_LITE_WHITELABEL' ) ) {
	// Set the following to true, if you want to remove any user-facing CSSIgniter traces.
	define( 'BLOCKCHAIN_LITE_WHITELABEL', false );
}

if ( ! function_exists( 'blockchain_lite_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function blockchain_lite_setup() {

	// Default content width.
	$GLOBALS['content_width'] = 850;

	// Make theme available for translation.
	load_theme_textdomain( 'blockchain-lite', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );

	$menus = array(
		'menu-1' => esc_html__( 'Main Menu', 'blockchain-lite' ),
		'menu-2' => esc_html__( 'Main Menu - Right', 'blockchain-lite' ),
	);
	if ( ! apply_filters( 'blockchain_lite_support_menu_2', true ) ) {
		unset( $menus['menu-2'] );
	}
	register_nav_menus( $menus );

	// Switch default core markup for search form, comment form, and comments to output valid HTML5.
	add_theme_support( 'html5', apply_filters( 'blockchain_lite_add_theme_support_html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) ) );

	// Add theme support for custom logos.
	add_theme_support( 'custom-logo', apply_filters( 'blockchain_lite_add_theme_support_custom_logo', array() ) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'blockchain_lite_custom_background_args', array() ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );


	// Image sizes
	set_post_thumbnail_size( 850, 567, true );
	add_image_size( 'blockchain_lite_item', 555, 400, true );
	add_image_size( 'blockchain_lite_item_tall', 555 );
	add_image_size( 'blockchain_lite_item_media', 80, 80, true );
	add_image_size( 'blockchain_lite_brand_logo', 0, 80, false );
	add_image_size( 'blockchain_lite_fullwidth', 1140, 650, true );
	add_image_size( 'blockchain_lite_hero', 1920, 500, true );
	add_image_size( 'blockchain_lite_slide', 1920, 850, true );

	add_theme_support( 'blockchain-lite-hero', apply_filters( 'blockchain_lite_theme_support_hero_args', wp_parse_args( array(
		'front-page-template'   => false,
		'front-page-classes'    => 'page-hero-lg',
		'front-page-image-size' => 'blockchain_lite_slide',
		'text-align'            => 'left',
	), blockchain_lite_theme_support_hero_defaults() ) ) );


	add_theme_support( 'blockchain-lite-hide-single-featured', apply_filters( 'blockchain_lite_theme_support_hide_single_featured_post_types', array(
		'post',
		'page',
	) ) );

	// This provides back-compat for author descriptions on WP < 4.9. Remove by WP 5.1.
	if ( ! has_filter( 'get_the_author_description', 'wpautop' ) ) {
		add_filter( 'get_the_author_description', 'wpautop' );
	}
}
endif;
add_action( 'after_setup_theme', 'blockchain_lite_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function blockchain_lite_content_width() {
	$content_width = $GLOBALS['content_width'];

	if ( is_page_template( 'templates/full-width-page.php' )
		|| is_page_template( 'templates/builder.php' )
	) {
		$content_width = 1140;
	} elseif ( is_singular() || is_home() || is_archive() ) {
		$info          = blockchain_lite_get_layout_info();
		$content_width = $info['content_width'];
	}

	$GLOBALS['content_width'] = apply_filters( 'blockchain_lite_content_width', $content_width );
}
add_action( 'template_redirect', 'blockchain_lite_content_width', 0 );


add_filter( 'wp_page_menu', 'blockchain_lite_wp_page_menu', 10, 2 );
function blockchain_lite_wp_page_menu( $menu, $args ) {
	$menu = preg_replace( '#^<div .*?>#', '', $menu, 1 );
	$menu = preg_replace( '#</div>$#', '', $menu, 1 );
	$menu = preg_replace( '#^<ul>#', '<ul id="' . esc_attr( $args['menu_id'] ) . '" class="' . esc_attr( $args['menu_class'] ) . '">', $menu, 1 );
	return $menu;
}

if ( ! function_exists( 'blockchain_lite_get_columns_classes' ) ) :
	function blockchain_lite_get_columns_classes( $columns ) {
		switch ( intval( $columns ) ) {
			case 1:
				$classes = 'col-12';
				break;
			case 2:
				$classes = 'col-sm-6 col-12';
				break;
			case 3:
				$classes = 'col-lg-4 col-sm-6 col-12';
				break;
			case 4:
			default:
				$classes = 'col-xl-3 col-sm-6 col-12';
				break;
		}

		return apply_filters( 'blockchain_lite_get_columns_classes', $classes, $columns );
	}
endif;

if ( ! function_exists( 'blockchain_lite_is_woocommerce_with_sidebar' ) ) :
function blockchain_lite_is_woocommerce_with_sidebar() {
	if ( ! class_exists( 'WooCommerce' ) ) {
		return false;
	}

	if ( is_woocommerce() && ! is_product() ) {
		return true;
	}

	return false;
}
endif;

if ( ! function_exists( 'blockchain_lite_is_woocommerce_without_sidebar' ) ) :
function blockchain_lite_is_woocommerce_without_sidebar() {
	if ( ! class_exists( 'WooCommerce' ) ) {
		return false;
	}

	if ( is_product() || is_cart() || is_checkout() || is_account_page() ) {
		return true;
	}

	return false;
}
endif;

if ( ! function_exists( 'blockchain_lite_has_sidebar' ) ) :
/**
 * Determine if a sidebar is being displayed.
 */
function blockchain_lite_has_sidebar() {
	$has_sidebar = false;

	if ( blockchain_lite_is_woocommerce_with_sidebar() ) {
		$has_sidebar = is_active_sidebar( 'shop' );
	} elseif ( blockchain_lite_is_woocommerce_without_sidebar() ) {
		$has_sidebar = false;
	} elseif ( is_home() || is_archive() ) {
		if ( get_theme_mod( 'archive_sidebar', 1 ) && is_active_sidebar( 'sidebar-1' ) ) {
			$has_sidebar = true;
		}
	} elseif ( ! is_page() && is_active_sidebar( 'sidebar-1' ) ) {
		$has_sidebar = true;
	} elseif ( is_page() && is_active_sidebar( 'sidebar-2' ) ) {
		$has_sidebar = true;
	}

	return apply_filters( 'blockchain_lite_has_sidebar', $has_sidebar );
}
endif;

if ( ! function_exists( 'blockchain_lite_get_layout_info' ) ) :
/**
 * Return appropriate layout information.
 */
function blockchain_lite_get_layout_info() {
	$has_sidebar = blockchain_lite_has_sidebar();

	$classes = array(
		'container_classes' => $has_sidebar ? 'col-lg-9 col-12' : 'col-xl-8 offset-xl-2 col-lg-10 offset-lg-1 col-12',
		'sidebar_classes'   => $has_sidebar ? 'col-lg-3 col-12' : '',
		'content_width'     => $has_sidebar ? 850 : 750,
		'has_sidebar'       => $has_sidebar,
	);

	if ( is_singular() ) {
		if ( 'left' === get_post_meta( get_the_ID(), 'blockchain_lite_sidebar', true ) ) {
			$classes = array(
				'container_classes' => $has_sidebar ? 'col-lg-9 push-lg-3 col-12' : 'col-xl-8 offset-xl-2 col-lg-10 offset-lg-1 col-12',
				'sidebar_classes'   => $has_sidebar ? 'col-lg-3 pull-lg-9 col-12' : '',
				'content_width'     => 850,
				'has_sidebar'       => $has_sidebar,
			);
		} elseif ( 'none' === get_post_meta( get_the_ID(), 'blockchain_lite_sidebar', true ) ) {
			$classes = array(
				'container_classes' => 'col-xl-8 offset-xl-2 col-lg-10 offset-lg-1 col-12',
				'sidebar_classes'   => '',
				'content_width'     => 750,
				'has_sidebar'       => false,
			);
		}
	} elseif ( is_home() || is_archive() ) {
		// 1 will get default narrow fullwidth classes. 2 and 3 will get fullwidth.
		if ( 1 !== (int) get_theme_mod( 'archive_layout', blockchain_lite_archive_layout_default() ) ) {
			if ( ! $has_sidebar ) {
				$classes = array(
					'container_classes' => 'col-12',
					'sidebar_classes'   => '',
					'content_width'     => 1140,
					'has_sidebar'       => false,
				);
			}
		}
	}

	$non_narrow_templates = apply_filters( 'blockchain_lite_non_narrow_templates', array() );
	if ( is_page_template( $non_narrow_templates ) ) {
		if ( ! $has_sidebar || 'none' === get_post_meta( get_the_ID(), 'blockchain_lite_sidebar', true ) ) {
			$classes['container_classes'] = 'col-12';
			$classes['sidebar_classes']   = '';
			$classes['content_width']     = 1140;
		}
	} elseif ( class_exists( 'WooCommerce' ) && is_woocommerce() ) {
		if ( ( is_shop() && ! $has_sidebar ) || is_product() ) {
			$classes['container_classes'] = 'col-12';
			$classes['sidebar_classes']   = '';
			$classes['content_width']     = 1140;
		}
	}

	return apply_filters( 'blockchain_lite_layout_info', $classes, $has_sidebar );
}
endif;

/**
 * Echoes container classes based on whether
 * the current template has a visible sidebar or not
 */
function blockchain_lite_the_container_classes() {
	$info = blockchain_lite_get_layout_info();
	echo esc_attr( $info['container_classes'] );
}

/**
 * Echoes container classes based on whether
 * the current template has a visible sidebar or not
 */
function blockchain_lite_the_sidebar_classes() {
	$info = blockchain_lite_get_layout_info();
	echo esc_attr( $info['sidebar_classes'] );
}

add_filter( 'tiny_mce_before_init', 'blockchain_lite_insert_wp_editor_formats' );
function blockchain_lite_insert_wp_editor_formats( $init_array ) {
	$style_formats = array(
		array(
			'title'   => esc_html__( 'Intro text (big text)', 'blockchain-lite' ),
			'block'   => 'div',
			'classes' => 'entry-content-intro',
			'wrapper' => true,
		),
		array(
			'title'   => esc_html__( '2 Column Text', 'blockchain-lite' ),
			'block'   => 'div',
			'classes' => 'entry-content-column-split',
			'wrapper' => true,
		),
	);

	$init_array['style_formats'] = wp_json_encode( $style_formats );

	return $init_array;
}

add_filter( 'mce_buttons_2', 'blockchain_lite_mce_buttons_2' );
function blockchain_lite_mce_buttons_2( $buttons ) {
	array_unshift( $buttons, 'styleselect' );

	return $buttons;
}



/**
 * Return default args for add_theme_support( 'blockchain-lite-hero' )
 *
 * Used when declaring support for theme hero section, so that unchanged args can be omitted. E.g.:
 *
 *  	add_theme_support( 'blockchain-lite-hero', apply_filters( 'blockchain_lite_theme_support_hero_args', wp_parse_args( array(
 *  		'required' => true,
 *  	), blockchain_lite_theme_support_hero_defaults() ) ) );
 *
 * @return array
 */
function blockchain_lite_theme_support_hero_defaults() {
	return apply_filters( 'blockchain_lite_theme_support_hero_defaults', array(
		'required'              => false, // When true, there will be no option to hide the hero section.
		'show-default'          => false, // The default state of the 'hero_show' option.
		'show-if-text-empty'    => false, // Show hero when title and subtitle are empty. If 'required' = true this is ignored (and hero is always shown).
		'image-size'            => 'blockchain_lite_hero', // The default image size for the background image.
		'front-page-template'   => 'templates/front-page.php', // The front page template slug. Set to false if theme doesn't have a front page template.
		'front-page-classes'    => '', // Extra hero classes for the front page.
		'front-page-image-size' => false, // The image size for the front page, if different. False means same as 'image-size'.
		'text-align'            => 'left', // The default text-align for the hero text. One of: 'left', 'center', 'right'.
	) );
}

function blockchain_lite_the_hero_classes( $echo = true ) {
	$classes = array( 'page-hero' );

	$hero_support = get_theme_support( 'blockchain-lite-hero' );
	$hero_support = $hero_support[0];
	if ( $hero_support['front-page-template'] && is_page_template( $hero_support['front-page-template'] ) ) {
		$classes[] = $hero_support['front-page-classes'];
	}

	$classes = apply_filters( 'blockchain_lite_hero_classes', $classes );
	$classes = array_filter( $classes );
	if ( $echo ) {
		echo esc_attr( implode( ' ', $classes ) );
	} else {
		return $classes;
	}
}

function blockchain_lite_get_hero_data( $post_id = false ) {
	if ( is_singular() && false === $post_id ) {
		$post_id = get_the_ID();
	}

	if ( ! current_theme_supports( 'blockchain-lite-hero' ) ) {
		return array(
			'show'            => 0,
			'page_title_hide' => 0,
		);
	}

	$support = get_theme_support( 'blockchain-lite-hero' );
	$support = $support[0];

	$title    = '';
	$subtitle = '';

	$image_size = $support['image-size'];
	if ( $support['front-page-image-size'] && is_page_template( $support['front-page-template'] ) ) {
		$image_size = $support['front-page-image-size'];
	}

	if ( is_home() ) {
		$title = get_theme_mod( 'title_blog', __( 'From the blog', 'blockchain-lite' ) );
	} elseif ( is_search() ) {
		$title = get_theme_mod( 'title_search', __( 'Search results', 'blockchain-lite' ) );

		global $wp_query;
		$found = intval( $wp_query->found_posts );
		/* translators: %d is the number of search results. */
		$subtitle = esc_html( sprintf( _n( '%d result found.', '%d results found.', $found, 'blockchain-lite' ), $found ) );

	} elseif ( is_404() ) {
		$title = get_theme_mod( 'title_404', __( 'Page not found', 'blockchain-lite' ) );
	} elseif ( is_category() || is_tag() || is_tax() ) {
		$title    = single_term_title( '', false );
		$subtitle = term_description();
	} elseif ( is_post_type_archive() ) {
		$title = post_type_archive_title( '', false );
	} elseif ( is_archive() ) {
		$title = get_the_archive_title();
	}

	$generic_data = array(
		'show'             => get_theme_mod( 'hero_show', $support['show-default'] ),
		'title'            => $title,
		'subtitle'         => $subtitle,
		'text_align'       => $support['text-align'],
		'page_title_hide'  => 0,
		'bg_color'         => get_theme_mod( 'hero_bg_color' ),
		'text_color'       => get_theme_mod( 'hero_text_color' ),
		'overlay_color'    => get_theme_mod( 'hero_overlay_color' ),
		'image_id'         => '',
		'image'            => get_theme_mod( 'hero_image' ),
		'image_repeat'     => get_theme_mod( 'hero_image_repeat', 'no-repeat' ),
		'image_position_x' => get_theme_mod( 'hero_image_position_x', 'center' ),
		'image_position_y' => get_theme_mod( 'hero_image_position_y', 'center' ),
		'image_attachment' => get_theme_mod( 'hero_image_attachment', 'scroll' ),
		'image_cover'      => get_theme_mod( 'hero_image_cover', 1 ),
	);

	$data = $generic_data;

	$single_data = array();

	if ( class_exists( 'WooCommerce' ) && ( is_shop() || is_product_taxonomy() || is_product() ) ) {
		// The conditionals can only be used AFTER the 'posts_selection' action (i.e. in 'wp'), so calling this function earlier,
		// e.g. on 'init' will not work properly. In that case, provide the shop's page ID explicitly when calling.
		// Example usage can be found on the Spencer theme.
		$shop_page = wc_get_page_id( 'shop' );
		if ( $shop_page > 0 ) {
			$post_id = $shop_page;
		}
	}

	if ( class_exists( 'WooCommerce' ) ) {
		if ( is_product() ) {
			$data['title']    = get_the_title( $shop_page ); // May be custom title from hooked blockchain_lite_replace_the_title()
			$data['subtitle'] = get_post_meta( $shop_page, 'subtitle', true );
		} elseif ( is_product_taxonomy() ) {
			$data['title']    = single_term_title( '', false );
			$data['subtitle'] = term_description();
		}
	}

	// Disable hero if no text exists.
	if ( false === $support['show-if-text-empty'] && empty( $data['title'] ) && empty( $data['subtitle'] ) ) {
		$data['show'] = 0;
	}

	// Enable hero if required, ignoring previous limitations ( e.g. false === $support['show-if-text-empty'] ).
	if ( $support['required'] ) {
		$data['show'] = 1;
	}

	return apply_filters( 'blockchain_lite_hero_data', $data, $post_id, $generic_data, $single_data );
}


add_action( 'init', 'blockchain_lite_setup_hide_single_featured' );
function blockchain_lite_setup_hide_single_featured() {
	if ( current_theme_supports( 'blockchain-lite-hide-single-featured' ) ) {
		add_filter( 'admin_post_thumbnail_html', 'blockchain_lite_hide_single_featured_admin_post_thumbnail_html', 10, 3 );
		add_filter( 'get_post_metadata', 'blockchain_lite_hide_single_featured_get_post_metadata', 10, 4 );
		add_action( 'save_post', 'blockchain_lite_hide_single_featured_save_post' );
	}
}

function blockchain_lite_hide_single_featured_admin_post_thumbnail_html( $content, $post_id, $thumbnail_id ) {
	$hide_featured_support = get_theme_support( 'blockchain-lite-hide-single-featured' );
	$hide_featured_support = $hide_featured_support[0];

	if ( ! in_array( get_post_type( $post_id ), $hide_featured_support, true ) ) {
		return $content;
	}

	$fieldname = 'blockchain_lite_hide_single_featured';
	$checked   = get_post_meta( $post_id, $fieldname, true );

	ob_start();
	?>
		<input type="checkbox" id="<?php echo esc_attr( $fieldname ); ?>" class="check" name="<?php echo esc_attr( $fieldname ); ?>" value="1" <?php checked( $checked, 1 ); ?> />
		<label for="<?php echo esc_attr( $fieldname ); ?>"><?php esc_html_e( "Hide when viewing this post's page", 'blockchain-lite' ); ?></label>
	<?php
	wp_nonce_field( 'blockchain_lite_hide_single_featured_nonce', '_blockchain_lite_hide_single_featured_meta_box_nonce' );
	$content .= ob_get_clean();

	return $content;
}

function blockchain_lite_hide_single_featured_get_post_metadata( $value, $post_id, $meta_key, $single ) {
	$hide_featured_support = get_theme_support( 'blockchain-lite-hide-single-featured' );
	$hide_featured_support = $hide_featured_support[0];

	if ( ! in_array( get_post_type( $post_id ), $hide_featured_support, true ) ) {
		return $value;
	}

	if ( '_thumbnail_id' === $meta_key && ( is_single( $post_id ) || is_page( $post_id ) ) && get_post_meta( $post_id, 'blockchain_lite_hide_single_featured', true ) ) {
		return false;
	}

	return $value;
}

function blockchain_lite_hide_single_featured_save_post( $post_id ) {
	$hide_featured_support = get_theme_support( 'blockchain-lite-hide-single-featured' );
	$hide_featured_support = $hide_featured_support[0];

	if ( ! in_array( get_post_type( $post_id ), $hide_featured_support, true ) ) {
		return;
	}

	if ( isset( $_POST['_blockchain_lite_hide_single_featured_meta_box_nonce'] ) && wp_verify_nonce( sanitize_key( $_POST['_blockchain_lite_hide_single_featured_meta_box_nonce'] ), 'blockchain_lite_hide_single_featured_nonce' ) ) {
		update_post_meta( $post_id, 'blockchain_lite_hide_single_featured', isset( $_POST['blockchain_lite_hide_single_featured'] ) ); // Input var okay.
	}
}

function blockchain_lite_archive_layout_choices() {
	return apply_filters( 'blockchain_lite_archive_layout_choices', array(
		1 => sprintf( _n( '%d column', '%d columns', 1, 'blockchain-lite' ), number_format_i18n( 1 ) ),
		2 => sprintf( _n( '%d column', '%d columns', 2, 'blockchain-lite' ), number_format_i18n( 2 ) ),
		3 => sprintf( _n( '%d column', '%d columns', 3, 'blockchain-lite' ), number_format_i18n( 3 ) ),
	) );
}

function blockchain_lite_archive_layout_default() {
	return apply_filters( 'blockchain_lite_archive_layout_default', 1 );
}

function blockchain_lite_sanitize_archive_layout( $value ) {
	$choices = blockchain_lite_archive_layout_choices();
	if ( array_key_exists( $value, $choices ) ) {
		return $value;
	}

	return blockchain_lite_archive_layout_default();
}

function blockchain_lite_header_layout_choices() {
	$choices = array(
		'right' => esc_html__( 'Left logo - Right menu', 'blockchain-lite' ),
		'split' => esc_html__( 'Centered logo - Split menu', 'blockchain-lite' ),
		'full'  => esc_html__( 'Top logo - Bottom menu', 'blockchain-lite' ),
	);

	if ( ! apply_filters( 'blockchain_lite_support_menu_2', true ) ) {
		unset( $choices['split'] );
	}

	return apply_filters( 'blockchain_lite_header_layout_choices', $choices );
}

function blockchain_lite_header_layout_default() {
	return apply_filters( 'blockchain_lite_header_layout_default', 'right' );
}

function blockchain_lite_sanitize_header_layout( $value ) {
	$choices = blockchain_lite_header_layout_choices();
	if ( array_key_exists( $value, $choices ) ) {
		return $value;
	}

	return blockchain_lite_header_layout_default();
}

function blockchain_lite_header_logo_alignment_choices() {
	return apply_filters( 'blockchain_lite_header_logo_alignment_choices', array(
		'left'   => esc_html__( 'Left', 'blockchain-lite' ),
		'center' => esc_html__( 'Center', 'blockchain-lite' ),
	) );
}

function blockchain_lite_header_logo_alignment_default() {
	return apply_filters( 'blockchain_lite_header_logo_alignment_default', 'center' );
}

function blockchain_lite_sanitize_header_logo_alignment( $value ) {
	$choices = blockchain_lite_header_logo_alignment_choices();
	if ( array_key_exists( $value, $choices ) ) {
		return $value;
	}

	return blockchain_lite_header_logo_alignment_default();
}


function blockchain_lite_footer_layout_choices() {
	return apply_filters( 'blockchain_lite_footer_layout_choices', array(
		'4-col' => esc_html__( '4 Columns', 'blockchain-lite' ),
		'3-col' => esc_html__( '3 Columns', 'blockchain-lite' ),
		'2-col' => esc_html__( '2 Columns', 'blockchain-lite' ),
		'1-col' => esc_html__( '1 Column', 'blockchain-lite' ),
		'1-3'   => esc_html__( '1/4 - 3/4 Columns', 'blockchain-lite' ),
		'3-1'   => esc_html__( '3/4 - 1/4 Columns', 'blockchain-lite' ),
		'1-1-2' => esc_html__( '1/4 - 1/4 - 1/2 Columns', 'blockchain-lite' ),
		'2-1-1' => esc_html__( '1/2 - 1/4 - 1/4 Columns', 'blockchain-lite' ),
	) );
}

function blockchain_lite_footer_layout_default() {
	return apply_filters( 'blockchain_lite_footer_layout_default', '4-col' );
}

function blockchain_lite_sanitize_footer_layout( $value ) {
	$choices = blockchain_lite_footer_layout_choices();
	if ( array_key_exists( $value, $choices ) ) {
		return $value;
	}

	return blockchain_lite_footer_layout_default();
}

/**
 * Sanitizes the pagination method option.
 *
 * @param string $option Value to sanitize. Either 'numbers' or 'text'.
 * @return string
 */
function blockchain_lite_sanitize_pagination_method( $option ) {
	if ( in_array( $option, array( 'numbers', 'text' ), true ) ) {
		return $option;
	}

	return blockchain_lite_pagination_method_default();
}

function blockchain_lite_pagination_method_default() {
	return apply_filters( 'blockchain_lite_pagination_method_default', 'numbers' );
}

function blockchain_lite_footer_widget_area_classes( $layout ) {
	switch ( $layout ) {
		case '3-col':
			$classes = array(
				'footer-1' => array(
					'active' => true,
					'class'  => 'col-lg-4 col-12',
				),
				'footer-2' => array(
					'active' => true,
					'class'  => 'col-lg-4 col-12',
				),
				'footer-3' => array(
					'active' => true,
					'class'  => 'col-lg-4 col-12',
				),
				'footer-4' => array(
					'active' => false,
					'class'  => '',
				),
			);
			break;
		case '2-col':
			$classes = array(
				'footer-1' => array(
					'active' => true,
					'class'  => 'col-md-6 col-12',
				),
				'footer-2' => array(
					'active' => true,
					'class'  => 'col-md-6 col-12',
				),
				'footer-3' => array(
					'active' => false,
					'class'  => '',
				),
				'footer-4' => array(
					'active' => false,
					'class'  => '',
				),
			);
			break;
		case '1-col':
			$classes = array(
				'footer-1' => array(
					'active' => true,
					'class'  => 'col-12',
				),
				'footer-2' => array(
					'active' => false,
					'class'  => '',
				),
				'footer-3' => array(
					'active' => false,
					'class'  => '',
				),
				'footer-4' => array(
					'active' => false,
					'class'  => '',
				),
			);
			break;
		case '1-3':
			$classes = array(
				'footer-1' => array(
					'active' => true,
					'class'  => 'col-lg-3 col-md-6 col-12',
				),
				'footer-2' => array(
					'active' => true,
					'class'  => 'col-lg-9 col-md-6 col-12',
				),
				'footer-3' => array(
					'active' => false,
					'class'  => '',
				),
				'footer-4' => array(
					'active' => false,
					'class'  => '',
				),
			);
			break;
		case '3-1':
			$classes = array(
				'footer-1' => array(
					'active' => true,
					'class'  => 'col-lg-9 col-md-6 col-12',
				),
				'footer-2' => array(
					'active' => true,
					'class'  => 'col-lg-3 col-md-6 col-12',
				),
				'footer-3' => array(
					'active' => false,
					'class'  => '',
				),
				'footer-4' => array(
					'active' => false,
					'class'  => '',
				),
			);
			break;
		case '1-1-2':
			$classes = array(
				'footer-1' => array(
					'active' => true,
					'class'  => 'col-lg-3 col-md-6 col-12',
				),
				'footer-2' => array(
					'active' => true,
					'class'  => 'col-lg-3 col-md-6 col-12',
				),
				'footer-3' => array(
					'active' => true,
					'class'  => 'col-lg-6 col-12',
				),
				'footer-4' => array(
					'active' => false,
					'class'  => '',
				),
			);
			break;
		case '2-1-1':
			$classes = array(
				'footer-1' => array(
					'active' => true,
					'class'  => 'col-lg-6 col-12',
				),
				'footer-2' => array(
					'active' => true,
					'class'  => 'col-lg-3 col-md-6 col-12',
				),
				'footer-3' => array(
					'active' => true,
					'class'  => 'col-lg-3 col-md-6 col-12',
				),
				'footer-4' => array(
					'active' => false,
					'class'  => '',
				),
			);
			break;
		case '4-col':
		default:
			$classes = array(
				'footer-1' => array(
					'active' => true,
					'class'  => 'col-lg-3 col-md-6 col-12',
				),
				'footer-2' => array(
					'active' => true,
					'class'  => 'col-lg-3 col-md-6 col-12',
				),
				'footer-3' => array(
					'active' => true,
					'class'  => 'col-lg-3 col-md-6 col-12',
				),
				'footer-4' => array(
					'active' => true,
					'class'  => 'col-lg-3 col-md-6 col-12',
				),
			);
	} // End switch().

	return apply_filters( 'blockchain_lite_footer_widget_area_classes', $classes, $layout );
}


/**
 * Template tags.
 */
require_once get_theme_file_path( '/inc/template-tags.php' );

/**
 * Sanitization functions.
 */
require_once get_theme_file_path( '/inc/sanitization.php' );

/**
 * Hooks.
 */
require_once get_theme_file_path( '/inc/default-hooks.php' );

/**
 * Scripts and styles.
 */
require_once get_theme_file_path( '/inc/scripts-styles.php' );

/**
 * Sidebars and widgets.
 */
require_once get_theme_file_path( '/inc/sidebars-widgets.php' );

/**
 * Customizer controls.
 */
require_once get_theme_file_path( '/inc/customizer.php' );

/**
 * Customizer partial callbacks.
 */
require_once get_theme_file_path( '/inc/customizer-partial-callbacks.php' );

/**
 * Customizer generated styles.
 */
require_once get_theme_file_path( '/inc/customizer-styles.php' );

/**
 * Various helper functions, so that this functions.php is cleaner.
 */
require_once get_theme_file_path( '/inc/helpers.php' );

/**
 * WooCommerce integration.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require_once get_theme_file_path( '/inc/woocommerce.php' );
}

/**
 * User onboarding.
 */
require_once get_theme_file_path( '/inc/onboarding.php' );
