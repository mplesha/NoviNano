<?php
	$wp_customize->add_setting( 'header_top_bar_text_color', array(
		'transport'         => 'postMessage',
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_top_bar_text_color', array(
		'section' => 'theme_colors_header_top_bar',
		'label'   => esc_html__( 'Text color', 'blockchain-lite' ),
	) ) );

	$wp_customize->add_setting( 'header_top_bar_bg_color', array(
		'transport'         => 'postMessage',
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_top_bar_bg_color', array(
		'section' => 'theme_colors_header_top_bar',
		'label'   => esc_html__( 'Background color', 'blockchain-lite' ),
	) ) );

	$partial = $wp_customize->selective_refresh->get_partial( 'theme_style' );
	$partial->settings = array_merge( $partial->settings, array(
		'header_top_bar_text_color',
		'header_top_bar_bg_color',
	) );
