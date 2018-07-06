<?php
/**
 * Customizer functionality for the Contact section.
 *
 * @package Hestia
 * @since Hestia 1.1.51
 */

/**
 * Hook controls for Contact form shortcode control to Customizer.
 *
 * @since Hestia 1.1.51
 */
function hestia_contact_form_shortcode_customize_register( $wp_customize ) {

	$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';

	$wp_customize->add_setting(
		'hestia_contact_form_shortcode', array(
			'default'           => esc_html__( '[pirate_forms]', 'hestia' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => $selective_refresh,
		)
	);

	$wp_customize->add_control(
		'hestia_contact_form_shortcode', array(
			'label'    => esc_html__( 'Shortcode', 'hestia' ),
			'section'  => 'hestia_contact',
			'priority' => 26,
		)
	);
}
add_action( 'customize_register', 'hestia_contact_form_shortcode_customize_register' );

/**
 * Add selective refresh for contact form.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @since 1.1.51
 * @access public
 */
function hestia_register_contact_form_partials( $wp_customize ) {

	// Abort if selective refresh is not available.
	if ( ! isset( $wp_customize->selective_refresh ) ) {
		return;
	}

	$wp_customize->selective_refresh->add_partial(
		'hestia_contact_form_shortcode', array(
			'selector'        => '.contactus .card-contact .content',
			'settings'        => 'hestia_contact_form_shortcode',
			'render_callback' => 'hestia_contact_form_callback',
		)
	);
}
add_action( 'customize_register', 'hestia_register_contact_form_partials' );

/**
 * Render callback function for contact form selective refresh
 *
 * @since 1.1.51
 * @access public
 * @return void
 */
function hestia_contact_form_callback() {

	$hestia_contact_form_shortcode_default = '[pirate_forms]';
	$hestia_contact_form_shortcode         = get_theme_mod( 'hestia_contact_form_shortcode', $hestia_contact_form_shortcode_default );

	if ( $hestia_contact_form_shortcode === $hestia_contact_form_shortcode_default || empty( $hestia_contact_form_shortcode ) ) {
		echo do_shortcode( '[pirate_forms]' );
	} else {
		echo do_shortcode( wp_kses_post( $hestia_contact_form_shortcode ) );
	}
}
