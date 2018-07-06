<?php
	// Rename & Reposition the header image section.
	$wp_customize->get_control( 'background_color' )->section      = 'theme_colors_global';
	$wp_customize->get_control( 'background_image' )->section      = 'theme_colors_global';
	$wp_customize->get_control( 'background_preset' )->section     = 'theme_colors_global';
	$wp_customize->get_control( 'background_position' )->section   = 'theme_colors_global';
	$wp_customize->get_control( 'background_size' )->section       = 'theme_colors_global';
	$wp_customize->get_control( 'background_repeat' )->section     = 'theme_colors_global';
	$wp_customize->get_control( 'background_attachment' )->section = 'theme_colors_global';

	$wp_customize->add_setting( 'site_accent_color', array(
		'transport'         => 'postMessage',
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'site_accent_color', array(
		'section' => 'theme_colors_global',
		'label'   => esc_html__( 'Accent color', 'blockchain-lite' ),
	) ) );

	$wp_customize->add_setting( 'site_secondary_accent_color', array(
		'transport'         => 'postMessage',
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'site_secondary_accent_color', array(
		'section' => 'theme_colors_global',
		'label'   => esc_html__( 'Secondary accent color', 'blockchain-lite' ),
	) ) );

	$wp_customize->add_setting( 'site_text_color', array(
		'transport'         => 'postMessage',
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'site_text_color', array(
		'section' => 'theme_colors_global',
		'label'   => esc_html__( 'Text color', 'blockchain-lite' ),
	) ) );

	$wp_customize->add_setting( 'site_grey_backgrounds', array(
		'transport'         => 'postMessage',
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'site_grey_backgrounds', array(
		'section' => 'theme_colors_global',
		'label'   => esc_html__( 'Boxed elements backgrounds (i.e. author box)', 'blockchain-lite' ),
	) ) );

	$wp_customize->add_setting( 'site_border_color', array(
		'transport'         => 'postMessage',
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'site_border_color', array(
		'section' => 'theme_colors_global',
		'label'   => esc_html__( 'Border color', 'blockchain-lite' ),
	) ) );

	$wp_customize->add_setting( 'site_button_bg_color', array(
		'transport'         => 'postMessage',
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'site_button_bg_color', array(
		'section' => 'theme_colors_global',
		'label'   => esc_html__( 'Button background color', 'blockchain-lite' ),
	) ) );

	$wp_customize->add_setting( 'site_button_text_color', array(
		'transport'         => 'postMessage',
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'site_button_text_color', array(
		'section' => 'theme_colors_global',
		'label'   => esc_html__( 'Button text color', 'blockchain-lite' ),
	) ) );

	$wp_customize->add_setting( 'site_button_hover_bg_color', array(
		'transport'         => 'postMessage',
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'site_button_hover_bg_color', array(
		'section' => 'theme_colors_global',
		'label'   => esc_html__( 'Button hover background color', 'blockchain-lite' ),
	) ) );

	$wp_customize->add_setting( 'site_button_hover_text_color', array(
		'transport'         => 'postMessage',
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'site_button_hover_text_color', array(
		'section' => 'theme_colors_global',
		'label'   => esc_html__( 'Button hover text color', 'blockchain-lite' ),
	) ) );

	$wp_customize->add_setting( 'site_button_border_color', array(
		'transport'         => 'postMessage',
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'site_button_border_color', array(
		'section' => 'theme_colors_global',
		'label'   => esc_html__( 'Button border color', 'blockchain-lite' ),
	) ) );

	$partial = $wp_customize->selective_refresh->get_partial( 'theme_style' );
	$partial->settings = array_merge( $partial->settings, array(
		'site_accent_color',
		'site_text_color',
		'site_border_color',
		'site_button_bg_color',
		'site_button_text_color',
		'site_button_hover_bg_color',
		'site_button_hover_text_color',
		'site_button_border_color',
		'site_secondary_accent_color',
		'site_grey_backgrounds'
	) );
