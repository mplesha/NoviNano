<?php
	$wp_customize->add_setting( 'content_h1_size', array(
		'transport'         => 'postMessage',
		'default'           => '',
		'sanitize_callback' => 'blockchain_lite_sanitize_intval_or_empty',
	) );
	$wp_customize->add_control( 'content_h1_size', array(
		'type'        => 'number',
		'input_attrs' => array(
			'min'  => 0,
			'step' => 1,
		),
		'section'     => 'theme_typography_content',
		'label'       => esc_html__( 'H1 font size', 'blockchain-lite' ),
	) );

	$wp_customize->add_setting( 'content_h2_size', array(
		'transport'         => 'postMessage',
		'default'           => '',
		'sanitize_callback' => 'blockchain_lite_sanitize_intval_or_empty',
	) );
	$wp_customize->add_control( 'content_h2_size', array(
		'type'        => 'number',
		'input_attrs' => array(
			'min'  => 0,
			'step' => 1,
		),
		'section'     => 'theme_typography_content',
		'label'       => esc_html__( 'H2 font size', 'blockchain-lite' ),
	) );

	$wp_customize->add_setting( 'content_h3_size', array(
		'transport'         => 'postMessage',
		'default'           => '',
		'sanitize_callback' => 'blockchain_lite_sanitize_intval_or_empty',
	) );
	$wp_customize->add_control( 'content_h3_size', array(
		'type'        => 'number',
		'input_attrs' => array(
			'min'  => 0,
			'step' => 1,
		),
		'section'     => 'theme_typography_content',
		'label'       => esc_html__( 'H3 font size', 'blockchain-lite' ),
	) );

	$wp_customize->add_setting( 'content_h4_size', array(
		'transport'         => 'postMessage',
		'default'           => '',
		'sanitize_callback' => 'blockchain_lite_sanitize_intval_or_empty',
	) );
	$wp_customize->add_control( 'content_h4_size', array(
		'type'        => 'number',
		'input_attrs' => array(
			'min'  => 0,
			'step' => 1,
		),
		'section'     => 'theme_typography_content',
		'label'       => esc_html__( 'H4 font size', 'blockchain-lite' ),
	) );

	$wp_customize->add_setting( 'content_h5_size', array(
		'transport'         => 'postMessage',
		'default'           => '',
		'sanitize_callback' => 'blockchain_lite_sanitize_intval_or_empty',
	) );
	$wp_customize->add_control( 'content_h5_size', array(
		'type'        => 'number',
		'input_attrs' => array(
			'min'  => 0,
			'step' => 1,
		),
		'section'     => 'theme_typography_content',
		'label'       => esc_html__( 'H5 font size', 'blockchain-lite' ),
	) );

	$wp_customize->add_setting( 'content_h6_size', array(
		'transport'         => 'postMessage',
		'default'           => '',
		'sanitize_callback' => 'blockchain_lite_sanitize_intval_or_empty',
	) );
	$wp_customize->add_control( 'content_h6_size', array(
		'type'        => 'number',
		'input_attrs' => array(
			'min'  => 0,
			'step' => 1,
		),
		'section'     => 'theme_typography_content',
		'label'       => esc_html__( 'H6 font size', 'blockchain-lite' ),
	) );

	$wp_customize->add_setting( 'content_body_size', array(
		'transport'         => 'postMessage',
		'default'           => '',
		'sanitize_callback' => 'blockchain_lite_sanitize_intval_or_empty',
	) );
	$wp_customize->add_control( 'content_body_size', array(
		'type'        => 'number',
		'input_attrs' => array(
			'min'  => 0,
			'step' => 1,
		),
		'section'     => 'theme_typography_content',
		'label'       => esc_html__( 'Body font size', 'blockchain-lite' ),
	) );


	$partial = $wp_customize->selective_refresh->get_partial( 'theme_style' );
	$partial->settings = array_merge( $partial->settings, array(
		'content_h1_size',
		'content_h2_size',
		'content_h3_size',
		'content_h4_size',
		'content_h5_size',
		'content_h6_size',
		'content_body_size',
	) );
