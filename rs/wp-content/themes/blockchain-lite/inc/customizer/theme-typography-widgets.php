<?php
	$wp_customize->add_setting( 'theme_widget_title_size', array(
		'transport'         => 'postMessage',
		'default'           => '',
		'sanitize_callback' => 'blockchain_lite_sanitize_intval_or_empty',
	) );
	$wp_customize->add_control( 'theme_widget_title_size', array(
		'type'        => 'number',
		'input_attrs' => array(
			'min'  => 0,
			'step' => 1,
		),
		'section'     => 'theme_typography_widgets',
		'label'       => esc_html__( 'Title font size', 'blockchain-lite' ),
	) );

	$wp_customize->add_setting( 'theme_widget_text_size', array(
		'transport'         => 'postMessage',
		'default'           => '',
		'sanitize_callback' => 'blockchain_lite_sanitize_intval_or_empty',
	) );
	$wp_customize->add_control( 'theme_widget_text_size', array(
		'type'        => 'number',
		'input_attrs' => array(
			'min'  => 0,
			'step' => 1,
		),
		'section'     => 'theme_typography_widgets',
		'label'       => esc_html__( 'Text font size', 'blockchain-lite' ),
	) );

	$partial = $wp_customize->selective_refresh->get_partial( 'theme_style' );
	$partial->settings = array_merge( $partial->settings, array(
		'theme_widget_title_size',
		'theme_widget_text_size',
	) );
