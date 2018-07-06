<?php
	$wp_customize->add_setting( 'footer_bg_color', array(
		'transport'         => 'postMessage',
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_bg_color', array(
		'section' => 'theme_colors_footer',
		'label'   => esc_html__( 'Main footer background color', 'blockchain-lite' ),
	) ) );

	$wp_customize->add_setting( 'footer_text_color', array(
		'transport'         => 'postMessage',
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_text_color', array(
		'section' => 'theme_colors_footer',
		'label'   => esc_html__( 'Main footer text color', 'blockchain-lite' ),
	) ) );

	$wp_customize->add_setting( 'footer_element_backgrounds', array(
		'transport'         => 'postMessage',
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_element_backgrounds', array(
		'section' => 'theme_colors_footer',
		'label'   => esc_html__( 'Footer element backgrounds', 'blockchain-lite' ),
	) ) );

	$wp_customize->add_setting( 'footer_border_color', array(
		'transport'         => 'postMessage',
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_border_color', array(
		'section' => 'theme_colors_footer',
		'label'   => esc_html__( 'Footer border color', 'blockchain-lite' ),
	) ) );

	$wp_customize->add_setting( 'footer_bottom_bg_color', array(
		'transport'         => 'postMessage',
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_bottom_bg_color', array(
		'section' => 'theme_colors_footer',
		'label'   => esc_html__( 'Bottom bar background color', 'blockchain-lite' ),
	) ) );

	$wp_customize->add_setting( 'footer_bottom_text_color', array(
		'transport'         => 'postMessage',
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_bottom_text_color', array(
		'section' => 'theme_colors_footer',
		'label'   => esc_html__( 'Bottom bar text color', 'blockchain-lite' ),
	) ) );

	$wp_customize->add_setting( 'footer_bottom_link_color', array(
		'transport'         => 'postMessage',
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_bottom_link_color', array(
		'section' => 'theme_colors_footer',
		'label'   => esc_html__( 'Bottom bar link color', 'blockchain-lite' ),
	) ) );

	$wp_customize->add_setting( 'footer_titles_color', array(
		'transport'         => 'postMessage',
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_titles_color', array(
		'section' => 'theme_colors_footer',
		'label'   => esc_html__( 'Widget titles text color', 'blockchain-lite' ),
	) ) );

	$partial = $wp_customize->selective_refresh->get_partial( 'theme_style' );
	$partial->settings = array_merge( $partial->settings, array(
		'footer_bg_color',
		'footer_text_color',
		'footer_element_backgrounds',
		'footer_border_color',
		'footer_bottom_bg_color',
		'footer_bottom_text_color',
		'footer_bottom_link_color',
		'footer_titles_color',
	) );
