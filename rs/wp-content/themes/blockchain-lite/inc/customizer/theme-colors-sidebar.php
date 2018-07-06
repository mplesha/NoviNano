<?php
	$wp_customize->add_setting( 'sidebar_bg_color', array(
		'transport'         => 'postMessage',
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sidebar_bg_color', array(
		'section' => 'theme_colors_sidebar',
		'label'   => esc_html__( 'Background color', 'blockchain-lite' ),
	) ) );

	$wp_customize->add_setting( 'sidebar_text_color', array(
		'transport'         => 'postMessage',
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sidebar_text_color', array(
		'section' => 'theme_colors_sidebar',
		'label'   => esc_html__( 'Text color', 'blockchain-lite' ),
	) ) );

	$wp_customize->add_setting( 'sidebar_link_color', array(
		'transport'         => 'postMessage',
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sidebar_link_color', array(
		'section' => 'theme_colors_sidebar',
		'label'   => esc_html__( 'Link color', 'blockchain-lite' ),
	) ) );

	$wp_customize->add_setting( 'sidebar_link_hover_color', array(
		'transport'         => 'postMessage',
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sidebar_link_hover_color', array(
		'section' => 'theme_colors_sidebar',
		'label'   => esc_html__( 'Link hover color', 'blockchain-lite' ),
	) ) );

	$wp_customize->add_setting( 'sidebar_border_color', array(
		'transport'         => 'postMessage',
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sidebar_border_color', array(
		'section' => 'theme_colors_sidebar',
		'label'   => esc_html__( 'Border color', 'blockchain-lite' ),
	) ) );

	$wp_customize->add_setting( 'sidebar_titles_color', array(
		'transport'         => 'postMessage',
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sidebar_titles_color', array(
		'section' => 'theme_colors_sidebar',
		'label'   => esc_html__( 'Widget titles text color', 'blockchain-lite' ),
	) ) );

	$partial = $wp_customize->selective_refresh->get_partial( 'theme_style' );
	$partial->settings = array_merge( $partial->settings, array(
		'sidebar_bg_color',
		'sidebar_text_color',
		'sidebar_link_color',
		'sidebar_link_hover_color',
		'sidebar_border_color',
		'sidebar_titles_color',
	) );
