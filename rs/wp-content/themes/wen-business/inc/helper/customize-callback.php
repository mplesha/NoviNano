<?php
/**
 * Callback functions for active_callback.
 *
 * @package WEN_Business
 */

if ( ! function_exists( 'wen_business_is_featured_slider_active' ) ) :

	/**
	 * Check if featured slider is active.
	 *
	 * @since 1.4.0
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function wen_business_is_featured_slider_active( $control ) {

		if ( 'disabled' !== $control->manager->get_setting( 'theme_options[featured_slider_status]' )->value() ) {
			return true;
		} else {
			return false;
		}

	}

endif;

if ( ! function_exists( 'wen_business_is_featured_category_slider_active' ) ) :

	/**
	 * Check if featured category slider is active.
	 *
	 * @since 1.4.0
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function wen_business_is_featured_category_slider_active( $control ) {

		if (
		'featured-category' === $control->manager->get_setting( 'theme_options[featured_slider_type]' )->value()
		&& 'disabled' !== $control->manager->get_setting( 'theme_options[featured_slider_status]' )->value()
		) {
			return true;
		} else {
			return false;
		}

	}

endif;

if ( ! function_exists( 'wen_business_is_simple_breadcrumb_active' ) ) :

	/**
	 * Check if simple breadcrumb is active.
	 *
	 * @since 1.4.0
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function wen_business_is_simple_breadcrumb_active( $control ) {

		if ( 'simple' === $control->manager->get_setting( 'theme_options[breadcrumb_type]' )->value() ) {
			return true;
		} else {
			return false;
		}

	}

endif;
