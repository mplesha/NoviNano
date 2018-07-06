<?php
/**
 * Customizer functionality for the Slider section.
 *
 * @package Hestia
 * @since Hestia 1.0
 */

/**
 * Hook controls for Slider section to Customizer.
 *
 * @since Hestia 1.0
 * @modified 1.1.30
 */
function hestia_big_title_customize_register( $wp_customize ) {

	$selective_refresh = isset( $wp_customize->selective_refresh ) ? true : false;

	$wp_customize->add_section(
		'hestia_big_title', array(
			'title'    => esc_html__( 'Big Title Section', 'hestia' ),
			'panel'    => 'hestia_frontpage_sections',
			'priority' => 1,
		)
	);

	if ( class_exists( 'Hestia_Customize_Control_Radio_Image' ) ) {
		$wp_customize->add_setting(
			'hestia_slider_tabs', array(
				'sanitize_callback' => 'hestia_sanitize_alignment_options',
				'transport'         => $selective_refresh,
			)
		);

		$wp_customize->add_control(
			new Hestia_Customize_Control_Radio_Image(
				$wp_customize, 'hestia_slider_tabs', array(
					'priority' => 5,
					'section'  => 'hestia_big_title',
					'is_tab'   => true,
					'choices'  => array(
						'slider' => array(
							'label'    => esc_html__( 'Big Title Section', 'hestia' ),
							'icon'     => 'picture-o',
							'controls' => array(
								'hestia_big_title_background',
								'hestia_big_title_title',
								'hestia_big_title_text',
								'hestia_big_title_button_text',
								'hestia_big_title_button_link',
								'hestia_slider_alignment',
							),
						),
						'extra'  => array(
							'label'    => esc_html__( 'Extra', 'hestia' ),
							'icon'     => 'user-plus',
							'controls' => array(
								'hestia_parallax_layer1',
								'hestia_parallax_layer2',
							),
						),
					),
				)
			)
		);

		$wp_customize->add_setting(
			'hestia_slider_alignment', array(
				'default'           => 'center',
				'sanitize_callback' => 'hestia_sanitize_alignment_options',
				'transport'         => $selective_refresh ? 'postMessage' : 'refresh',
			)
		);

		$wp_customize->add_control(
			new Hestia_Customize_Control_Radio_Image(
				$wp_customize, 'hestia_slider_alignment', array(
					'label'    => esc_html__( 'Layout', 'hestia' ),
					'priority' => 35,
					'section'  => 'hestia_big_title',
					'choices'  => array(
						'left'   => array(
							'url' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJYAAABqCAMAAABpj1iyAAAAD1BMVEX///8AhbrV1dU+yP/u9/q7NurVAAAAV0lEQVR4Ae3UIRKAUAxDwfLh/mfGYsB0JkNh18U9lXoXYD2rNlnrqrtlyZI1P8udAgAAAA1bkixZsmZlHUkFjJL/JFmyZMkC+Jf9lixZsnJkyQIAAOALTnXkEDyBKHzQAAAAAElFTkSuQmCC',
						),
						'center' => array(
							'url' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJYAAABqBAMAAACsf7WzAAAAD1BMVEX///8AhbrV1dU+yP/u9/q7NurVAAAAV0lEQVR42u3SsQ2AMAxFwYBYgA0QK7AC+89EQQOiIIoogn3XWHLxql8IZL1b+m+N5+ftaiVqfbkvACC8YW6iFbg17U0KCVQNTUvr0YK+bFdaWklaAPAXB4dWiADE72glAAAAAElFTkSuQmCC',
						),
						'right'  => array(
							'url' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJYAAABqBAMAAACsf7WzAAAAD1BMVEX///8AhbrV1dU+yP/u9/q7NurVAAAAV0lEQVR42u3SsQ2AMAxFwYBYgA0QK7AC+8+UIg2IAhRRWPFdY8nFq35hIPvdFr81t8/b1UrU+nNfAEAO09pFa+DWcnYpZPJpcVpajxbEdVxpaSVpAUAsFRQdiACd2e8sAAAAAElFTkSuQmCC',
						),
					),
				)
			)
		);
	}

	/**
	 * Control for big title background
	 */
	$wp_customize->add_setting(
		'hestia_big_title_background', array(
			'sanitize_callback' => 'esc_url_raw',
			'transport'         => $selective_refresh ? 'postMessage' : 'refresh',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize, 'hestia_big_title_background', array(
				'label'    => esc_html__( 'Big Title Background', 'hestia' ),
				'section'  => 'hestia_big_title',
				'priority' => 10,
			)
		)
	);

	/**
	 * Control for header title
	 */
	$wp_customize->add_setting(
		'hestia_big_title_title', array(
			'sanitize_callback' => 'wp_kses_post',
			'transport'         => $selective_refresh ? 'postMessage' : 'refresh',
		)
	);

	$wp_customize->add_control(
		'hestia_big_title_title', array(
			'label'    => esc_html__( 'Title', 'hestia' ),
			'section'  => 'hestia_big_title',
			'priority' => 15,
		)
	);

	/**
	 * Control for header text
	 */
	$wp_customize->add_setting(
		'hestia_big_title_text', array(
			'sanitize_callback' => 'wp_kses_post',
			'transport'         => $selective_refresh ? 'postMessage' : 'refresh',
		)
	);

	$wp_customize->add_control(
		'hestia_big_title_text', array(
			'label'    => esc_html__( 'Text', 'hestia' ),
			'section'  => 'hestia_big_title',
			'priority' => 20,
		)
	);

	/**
	 * Control for button text
	 */
	$wp_customize->add_setting(
		'hestia_big_title_button_text', array(
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => $selective_refresh ? 'postMessage' : 'refresh',
		)
	);
	$wp_customize->add_control(
		'hestia_big_title_button_text', array(
			'label'    => esc_html__( 'Button text', 'hestia' ),
			'section'  => 'hestia_big_title',
			'priority' => 25,
		)
	);

	/**
	 * Control for button link
	 */
	$wp_customize->add_setting(
		'hestia_big_title_button_link', array(
			'sanitize_callback' => 'esc_url_raw',
			'transport'         => $selective_refresh ? 'postMessage' : 'refresh',
		)
	);
	$wp_customize->add_control(
		'hestia_big_title_button_link', array(
			'label'    => esc_html__( 'Button URL', 'hestia' ),
			'section'  => 'hestia_big_title',
			'priority' => 30,
		)
	);

	$wp_customize->add_setting(
		'hestia_parallax_layer1', array(
			'sanitize_callback' => 'esc_url_raw',
			'default'           => apply_filters( 'hestia_parallax_layer1_default', false ),
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize, 'hestia_parallax_layer1', array(
				'label'    => esc_html__( 'First Layer', 'hestia' ),
				'section'  => 'hestia_big_title',
				'priority' => 35,
			)
		)
	);

	$wp_customize->add_setting(
		'hestia_parallax_layer2', array(
			'sanitize_callback' => 'esc_url_raw',
			'default'           => apply_filters( 'hestia_parallax_layer2_default', false ),
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize, 'hestia_parallax_layer2', array(
				'label'    => esc_html__( 'Second Layer', 'hestia' ),
				'section'  => 'hestia_big_title',
				'priority' => 40,
			)
		)
	);

	$hestia_slider_content = get_theme_mod( 'hestia_slider_content' );

	if ( empty( $hestia_slider_content ) ) {
		$wp_customize->get_setting( 'hestia_big_title_background' )->default  = esc_url( apply_filters( 'hestia_big_title_background_default', get_template_directory_uri() . '/assets/img/slider2.jpg' ) );
		$wp_customize->get_setting( 'hestia_big_title_title' )->default       = esc_html__( 'Change in the Customizer', 'hestia' );
		$wp_customize->get_setting( 'hestia_big_title_text' )->default        = esc_html__( 'Change in the Customizer', 'hestia' );
		$wp_customize->get_setting( 'hestia_big_title_button_text' )->default = esc_html__( 'Change in the Customizer', 'hestia' );
		$wp_customize->get_setting( 'hestia_big_title_button_link' )->default = esc_url( '#' );
	}
}

add_action( 'customize_register', 'hestia_big_title_customize_register' );

/**
 * Add controls for second button in Big Title Section
 * Compatibility with orfeo child theme
 *
 * @return array - new args for radio image control
 * package hestia
 * since 1.1.74
 */
function hestia_add_orfeo_button_controls( $args ) {

	array_push( $args['choices']['slider']['controls'], 'orfeo_big_title_second_button_text', 'orfeo_big_title_second_button_link' );

	return $args;
}
if ( defined( 'ORFEO_VERSION' ) ) {

	add_filter( 'hestia_slider_tabs_filter_args', 'hestia_add_orfeo_button_controls' );
}

/**
 * Add selective refresh for big title section controls.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @since 1.1.31
 * @access public
 */
function hestia_register_big_title_partials( $wp_customize ) {
	$wp_customize->selective_refresh->add_partial(
		'hestia_big_title_title', array(
			'selector'        => '.carousel .hestia-title',
			'settings'        => 'hestia_big_title_title',
			'render_callback' => 'hestia_big_title_title_render_callback',
		)
	);

	$wp_customize->selective_refresh->add_partial(
		'hestia_big_title_text', array(
			'selector'        => '.carousel .sub-title',
			'settings'        => 'hestia_big_title_text',
			'render_callback' => 'hestia_big_title_text_render_callback',
		)
	);

	$wp_customize->selective_refresh->add_partial(
		'hestia_big_title_button', array(
			'selector'        => '.carousel .buttons',
			'settings'        => array( 'hestia_big_title_button_text', 'hestia_big_title_button_link' ),
			'render_callback' => 'hestia_big_title_button_render_callback',
		)
	);

	$wp_customize->selective_refresh->add_partial(
		'hestia_big_title_background', array(
			'selector'        => '.big-title-image',
			'settings'        => 'hestia_big_title_background',
			'render_callback' => 'hestia_big_title_image_callback',
		)
	);

	$wp_customize->selective_refresh->add_partial(
		'hestia_slider_alignment', array(
			'selector'        => '.hestia-big-title-content',
			'settings'        => 'hestia_slider_alignment',
			'render_callback' => 'hestia_slider_alignment_callback',
		)
	);
}
add_action( 'customize_register', 'hestia_register_big_title_partials' );

/**
 * Render callback function for header title selective refresh
 *
 * @return string
 */
function hestia_big_title_title_render_callback() {
	return get_theme_mod( 'hestia_big_title_title' );
}

/**
 * Render callback function for header subtitle selective refresh
 *
 * @return string
 */
function hestia_big_title_text_render_callback() {
	return get_theme_mod( 'hestia_big_title_text' );
}

/**
 * Render callback function for slider alignment selective refresh
 *
 * @since 1.1.41
 */
function hestia_slider_alignment_callback() {
	$section_content = hestia_get_big_title_content();
	hestia_show_big_title_content( $section_content );
}

/**
 * Render callback function for header button selective refresh
 *
 * @return string
 */
function hestia_big_title_button_render_callback() {
	$button_text = get_theme_mod( 'hestia_big_title_button_text' );
	$button_link = get_theme_mod( 'hestia_big_title_button_link' );

	$output = '';

	if ( ! empty( $button_text ) && ! empty( $button_link ) ) {
		$output = '<a href="' . $button_link . '" title="' . $button_text . '" class="btn btn-primary btn-lg">' . $button_text . '</a>';
	}

	return wp_kses_post( $output );
}

/**
 * Callback function for big title background selective refresh.
 *
 * @since 1.1.31
 * @access public
 */
function hestia_big_title_image_callback() {
	$hestia_parallax_layer1 = get_theme_mod( 'hestia_parallax_layer1' );
	$hestia_parallax_layer2 = get_theme_mod( 'hestia_parallax_layer2' );
	if ( empty( $hestia_parallax_layer1 ) || empty( $hestia_parallax_layer2 ) ) {
		$hestia_big_title_background = get_theme_mod( 'hestia_big_title_background' );
		if ( ! empty( $hestia_big_title_background ) ) { ?>
			<style class="big-title-image-css">
				#carousel-hestia-generic .header-filter {
					background-image: url(<?php echo esc_url( $hestia_big_title_background ); ?>) !important;
				}
			</style>
			<?php
		}
	}
}
