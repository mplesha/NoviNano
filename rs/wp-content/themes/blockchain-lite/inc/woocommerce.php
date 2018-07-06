<?php
//
// WooCommerce integration
//

/**
 * Disable the default WooCommerce stylesheet.
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Enable WooCommerce product gallery and set default settings
 */
add_action( 'after_setup_theme', 'blockchain_lite_woocommerce_activation' );
function blockchain_lite_woocommerce_activation() {
	add_theme_support( 'woocommerce', array(
		'thumbnail_image_width'         => 750,
		'single_image_width'            => 560,
		'gallery_thumbnail_image_width' => 150,
		'product_grid'                  => array(
			'default_columns' => 3,
			'min_columns'     => 1,
			'max_columns'     => 4,
		),
	) );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-slider' );
	add_theme_support( 'wc-product-gallery-lightbox' );
}

/**
 * Default loop columns on product archives.
 *
 * @return integer products per row.
 */
function blockchain_lite_woocommerce_loop_columns() {
	return 3;
}
add_filter( 'loop_shop_columns', 'blockchain_lite_woocommerce_loop_columns' );

function blockchain_lite_woocommerce_upsells_total( $limit ) {
	return 3;
}
add_filter( 'woocommerce_upsells_total', 'blockchain_lite_woocommerce_upsells_total' );

function blockchain_lite_woocommerce_crosssells_total( $limit ) {
	return 3;
}
add_filter( 'woocommerce_cross_sells_total', 'blockchain_lite_woocommerce_crosssells_total' );

function blockchain_lite_woocommerce_output_related_products_args( $args ) {
	$args['posts_per_page'] = 3;
	$args['columns']        = 3;

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'blockchain_lite_woocommerce_output_related_products_args' );

function blockchain_lite_woocommerce_products_per_page() {
	return 12;
}
add_filter( 'loop_shop_per_page', 'blockchain_lite_woocommerce_products_per_page' );


// Make some WooCommerce pages get the fullwidth template
add_filter( 'template_include', 'blockchain_lite_woocommerce_fullwidth_pages' );
function blockchain_lite_woocommerce_fullwidth_pages( $template ) {
	$filename = 'templates/full-width-page.php';
	$located  = '';
	if ( file_exists( get_stylesheet_directory() . '/' . $filename ) ) {
		$located = get_stylesheet_directory() . '/' . $filename;
	} elseif ( file_exists( get_template_directory() . '/' . $filename ) ) {
		$located = get_template_directory() . '/' . $filename;
	} else {
		$located = '';
	}

	if ( ! empty( $located ) && ( is_cart() || is_checkout() || is_account_page() ) ) {
		return $located;
	}

	return $template;
}
