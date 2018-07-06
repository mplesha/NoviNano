<?php
/**
 * This file enqueue js for parallax in header
 *
 * @since 1.1.72
 * @package Hestia
 */

/**
 * Enqueue parallax script only if slider type have "parallax" value
 *
 * @since 1.1.72
 */
function hestia_enqueue_parallax() {
	$hestia_slider_type = apply_filters( 'hestia_enable_parallax', get_theme_mod( 'hestia_slider_type', 'video' ) );
	if ( $hestia_slider_type !== 'parallax' ) {
		return;
	}

	wp_enqueue_script( 'hestia-parallax', get_template_directory_uri() . '/assets/parallax/js/parallax.min.js', array(), HESTIA_VENDOR_VERSION );
	wp_enqueue_script( 'hestia-init-parallax', get_template_directory_uri() . '/assets/parallax/js/init-parallax.js', array( 'hestia-parallax', 'jquery' ), HESTIA_VENDOR_VERSION );
}
add_action( 'wp_enqueue_scripts', 'hestia_enqueue_parallax' );

/**
 * Display parallax layers,
 *
 * @since 1.1.72
 */
function hestia_display_parallax() {
	$hestia_parallax_layer1 = get_theme_mod( 'hestia_parallax_layer1', apply_filters( 'hestia_parallax_layer1_default', false ) );
	$hestia_parallax_layer2 = get_theme_mod( 'hestia_parallax_layer2', apply_filters( 'hestia_parallax_layer2_default', false ) );
	$is_parallax            = false;
	if ( ! empty( $hestia_parallax_layer1 ) && ! empty( $hestia_parallax_layer2 ) ) {
		$is_parallax = true;
		echo '<div id="parallax_move">';
		echo '<div class="layer layer1" data-depth="0.10" style="background-image: url(' . esc_url( $hestia_parallax_layer1 ) . ');"></div>';
		echo '<div class="layer layer2" data-depth="0.20" style="background-image: url(' . esc_url( $hestia_parallax_layer2 ) . ');"></div>';
		echo '</div>';
	}
	return $is_parallax;
}
