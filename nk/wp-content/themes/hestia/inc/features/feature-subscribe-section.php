<?php
/**
 * Customizer functionality for the Subscribe section.
 *
 * @package Hestia
 * @since Hestia 1.0
 */

/**
 * Hook controls for Subscribe section to Customizer.
 *
 * @since Hestia 1.0
 * @modified 1.1.49
 */
function hestia_subscribe_customize_register( $wp_customize ) {

	$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';

	if ( class_exists( 'Hestia_Hiding_Section' ) ) {
		$wp_customize->add_section(
			new Hestia_Hiding_Section(
				$wp_customize, 'hestia_subscribe', array(
					'title'          => esc_html__( 'Subscribe', 'hestia' ),
					'panel'          => 'hestia_frontpage_sections',
					'priority'       => apply_filters( 'hestia_section_priority', 55, 'hestia_subscribe' ),
					'hiding_control' => 'hestia_subscribe_hide',
				)
			)
		);
	} else {
		$wp_customize->add_section(
			'hestia_subscribe', array(
				'title'    => esc_html__( 'Subscribe', 'hestia' ),
				'priority' => apply_filters( 'hestia_section_priority', 55, 'hestia_subscribe' ),
			)
		);
	}

	$wp_customize->add_setting(
		'hestia_subscribe_hide', array(
			'sanitize_callback' => 'hestia_sanitize_checkbox',
			'default'           => true,
			'transport'         => $selective_refresh,
		)
	);

	$wp_customize->add_control(
		'hestia_subscribe_hide', array(
			'type'     => 'checkbox',
			'label'    => esc_html__( 'Disable section', 'hestia' ),
			'section'  => 'hestia_subscribe',
			'priority' => 1,
		)
	);

	$wp_customize->add_setting(
		'hestia_subscribe_background', array(
			'default'           => get_template_directory_uri() . '/assets/img/about.jpg',
			'sanitize_callback' => 'esc_url_raw',
			'transport'         => $selective_refresh,
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize, 'hestia_subscribe_background', array(
				'label'    => esc_html__( 'Background Image', 'hestia' ),
				'section'  => 'hestia_subscribe',
				'priority' => 5,
			)
		)
	);

	$wp_customize->add_setting(
		'hestia_subscribe_title', array(
			'default'           => esc_html__( 'Subscribe to our Newsletter', 'hestia' ),
			'sanitize_callback' => 'wp_kses_post',
			'transport'         => $selective_refresh,
		)
	);

	$wp_customize->add_control(
		'hestia_subscribe_title', array(
			'label'    => esc_html__( 'Section Title', 'hestia' ),
			'section'  => 'hestia_subscribe',
			'priority' => 10,
		)
	);

	$wp_customize->add_setting(
		'hestia_subscribe_subtitle', array(
			'default'           => esc_html__( 'Change this subtitle in the Customizer', 'hestia' ),
			'sanitize_callback' => 'wp_kses_post',
			'transport'         => $selective_refresh,
		)
	);

	$wp_customize->add_control(
		'hestia_subscribe_subtitle', array(
			'label'    => esc_html__( 'Section Subtitle', 'hestia' ),
			'section'  => 'hestia_subscribe',
			'priority' => 15,
		)
	);
	if ( class_exists( 'Hestia_Subscribe_Info' ) ) {
		$wp_customize->add_setting(
			'hestia_subscribe_info', array(
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			new Hestia_Subscribe_Info(
				$wp_customize, 'hestia_subscribe_info', array(
					'label'      => esc_html__( 'Instructions', 'hestia' ),
					'section'    => 'hestia_subscribe',
					'capability' => 'install_plugins',
					'priority'   => 20,
				)
			)
		);
	}

	$subscribe_widgets = $wp_customize->get_section( 'sidebar-widgets-subscribe-widgets' );
	if ( ! empty( $subscribe_widgets ) ) {
		$subscribe_widgets->panel    = 'hestia_frontpage_sections';
		$subscribe_widgets->priority = apply_filters( 'hestia_section_priority', 55, 'sidebar-widgets-subscribe-widgets' );
		$controls_to_move            = array(
			'hestia_subscribe_hide',
			'hestia_subscribe_background',
			'hestia_subscribe_title',
			'hestia_subscribe_subtitle',
			'hestia_subscribe_info',
		);
		foreach ( $controls_to_move as $control_id ) {
			$control = $wp_customize->get_control( $control_id );
			if ( ! empty( $control ) ) {
				$control->section  = 'sidebar-widgets-subscribe-widgets';
				$control->priority = -1;
			}
		}
	}

}
add_action( 'customize_register', 'hestia_subscribe_customize_register' );
