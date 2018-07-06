<?php
/**
 * Fashify Theme Customizer.
 *
 * @package Fashify
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function fashify_customize_register( $wp_customize ) {
	require_once get_template_directory() . '/inc/customizer-controls.php';
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';


		/*------------------------------------------------------------------------*/
		/*  Section: Fashify Options
		/*------------------------------------------------------------------------*/

		/* theme options */
		$wp_customize->add_panel( 'theme_options' ,
				array(
					'priority'        => 30,
					'title'           => esc_html__( 'Theme Options', 'fashify' ),
					'description'     => ''
				)
			);

			// general
			$wp_customize->add_section( 'global' ,
				array(
					'priority'    => 3,
					'title'       => esc_html__( 'Global', 'fashify' ),
					'description' => '',
					'panel'       => 'theme_options',
				)
			);
				// site layout
				$wp_customize->add_setting( 'site_layout',
					array(
						'sanitize_callback'	=> 'fashify_sanitize_select',
						'default'           => 'right-sidebar',
					)
				);
				$wp_customize->add_control( 'site_layout',
					array(
						'label' 		=> esc_html__( 'Site Layout', 'fashify' ),
						'type'			=> 'select',
						'section' 		=> 'global',
						'choices'   	=> array (
							'left-sidebar'	    => esc_html__( 'Left Sidebar', 'fashify' ),
							'right-sidebar'		=> esc_html__( 'Right Sidebar', 'fashify' ),
						)
					)
				);

				// archive/search post layout
				$wp_customize->add_setting( 'fashify_archive_layout',
					array(
						'sanitize_callback'	=> 'fashify_sanitize_select',
						'default'           => 'default',
					)
				);
				$wp_customize->add_control( 'fashify_archive_layout',
					array(
						'label' 		=> esc_html__( 'Archive/Search Layout:', 'fashify' ),
						'type'			=> 'radio',
						'section' 		=> 'global',
						'choices'   	=> array (
							'default'	=> esc_html__( 'Default', 'fashify' ),
							'grid'	    => esc_html__( 'Grid', 'fashify' ),
							'list'		=> esc_html__( 'List', 'fashify' ),
						)
					)
				);

			

				/* staff picks	*/
				$wp_customize->add_section( 'staff_pick' ,
					array(
						'priority'    => 35,
						'title'       => esc_html__( 'Staff Picks', 'fashify' ),
						'description' => '',
						'panel'       => 'theme_options',
					)
				);

					$wp_customize->add_setting( 'fashify_staff_picks',
						array(
							'sanitize_callback'	=> 'fashify_sanitize_checkbox',
							'default'           => true,
						)
					);

					$wp_customize->add_control( 'fashify_staff_picks',
						array(
							'label' 		=> esc_html__( 'Show/Hide the staff pick', 'fashify' ),
							'type'			=> 'checkbox',
							'section' 		=> 'staff_pick'
						)
					);

					$wp_customize->add_setting( 'fashify_staff_picks_cat',
						array(
						'sanitize_callback'	=> 'sanitize_text_field'
					));

					$wp_customize->add_control( new Fashify_Category_Dropdown_Custom_Control(
						$wp_customize,
						'fashify_staff_picks_cat',
						array(
							'label'   => esc_html__( 'Staff Category:', 'fashify' ),
							'section' => 'staff_pick',
							'settings' => 'fashify_staff_picks_cat'
							)
						)
					);


					$wp_customize->add_setting( 'number_staff_picks',
						array(
							'sanitize_callback'		=> 'fashify_sanitize_number_absint',
							'default'           	=> '4',
						)
					);
					$wp_customize->add_control( 'number_staff_picks',
						array(
							'label' 		=> esc_html__( 'Number:', 'fashify' ),
							'type'			=> 'text',
							'section' 		=> 'staff_pick',
							'description'	=> esc_html__( 'Enter number post display on Staff section.', 'fashify' )
						)
					);


				// Primary color setting
				$wp_customize->add_setting( 'primary_color' , array(
				    'default'     => '#f75357',
					'sanitize_callback'	=> 'fashify_sanitize_hex_color',
				) );

				$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'primary_color', array(
					'label'        => esc_html__( 'Primary Color', 'fashify' ),
					'section'    => 'colors',
					'settings'   => 'primary_color',
				) ) );

				// Second color setting
				$wp_customize->add_setting( 'secondary_color' , array(
				    'default'     => '#444',
					'sanitize_callback'	=> 'fashify_sanitize_hex_color',
				) );
				$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'secondary_color', array(
					'label'        => esc_html__( 'Secondary Color', 'fashify' ),
					'section'    => 'colors',
					'settings'   => 'secondary_color',
				) ) );

}
add_action( 'customize_register', 'fashify_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function fashify_customize_preview_js() {
	wp_enqueue_script( 'fashify_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'fashify_customize_preview_js' );



/*------------------------------------------------------------------------*/
/*  fashify Sanitize Functions.
/*------------------------------------------------------------------------*/

function fashify_sanitize_file_url( $file_url ) {
	$output = '';
	$filetype = wp_check_filetype( $file_url );
	if ( $filetype["ext"] ) {
		$output = esc_url( $file_url );
	}
	return $output;
}

function fashify_sanitize_select( $input, $setting ) {
	$input = sanitize_key( $input );
	$choices = $setting->manager->get_control( $setting->id )->choices;
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

function fashify_sanitize_hex_color( $color ) {
	if ( $color === '' ) {
		return '';
	}
	if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) ) {
		return $color;
	}
	return null;
}
function fashify_sanitize_checkbox( $checked ) {
    return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

function fashify_sanitize_text( $string ) {
	return wp_kses_post( balanceTags( $string ) );
}

function fashify_sanitize_number_absint( $number, $setting ) {
	// Ensure $number is an absolute integer (whole number, zero or greater).
	$number = absint( $number );

	// If the input is an absolute integer, return it; otherwise, return the default
	return ( $number ? $number : $setting->default );
}
