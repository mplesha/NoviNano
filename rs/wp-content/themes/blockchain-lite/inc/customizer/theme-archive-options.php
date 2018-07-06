<?php
	if ( apply_filters( 'blockchain_lite_customizable_blog_archive_options', true ) ) {
		$wp_customize->add_setting( 'archive_layout', array(
			'default'           => blockchain_lite_archive_layout_default(),
			'sanitize_callback' => 'blockchain_lite_sanitize_archive_layout',
		) );
		$wp_customize->add_control( 'archive_layout', array(
			'type'     => 'select',
			'section'  => 'theme_archive_options',
			'priority' => 10,
			'label'    => esc_html__( 'Layout', 'blockchain-lite' ),
			'choices'  => blockchain_lite_archive_layout_choices(),
		) );

		$wp_customize->add_setting( 'archive_sidebar', array(
			'default'           => 1,
			'sanitize_callback' => 'absint',
		) );
		$wp_customize->add_control( 'archive_sidebar', array(
			'type'     => 'checkbox',
			'section'  => 'theme_archive_options',
			'priority' => 20,
			'label'    => esc_html__( 'Show sidebar', 'blockchain-lite' ),
		) );

		$wp_customize->add_setting( 'archive_masonry', array(
			'default'           => 1,
			'sanitize_callback' => 'absint',
		) );
		$wp_customize->add_control( 'archive_masonry', array(
			'type'     => 'checkbox',
			'section'  => 'theme_archive_options',
			'priority' => 30,
			'label'    => esc_html__( 'Masonry effect', 'blockchain-lite' ),
		) );
	} // filter blockchain_lite_customizable_blog_archive_options

	// This is better left without a partial, as excerpt may appear anywhere (and with any wrapper).
	$wp_customize->add_setting( 'excerpt_length', array(
		'default'           => 55,
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 'excerpt_length', array(
		'type'        => 'number',
		'input_attrs' => array(
			'min'  => 10,
			'step' => 1,
		),
		'section'     => 'theme_archive_options',
		'priority'    => 40,
		'label'       => esc_html__( 'Automatically generated excerpt length (in words)', 'blockchain-lite' ),
	) );


	$wp_customize->add_setting( 'pagination_method', array(
		'transport'         => 'postMessage',
		'default'           => blockchain_lite_pagination_method_default(),
		'sanitize_callback' => 'blockchain_lite_sanitize_pagination_method',
	) );
	$wp_customize->add_control( 'pagination_method', array(
		'type'     => 'select',
		'section'  => 'theme_archive_options',
		'priority' => 50,
		'label'    => esc_html__( 'Pagination method', 'blockchain-lite' ),
		'choices'  => array(
			'numbers' => esc_html_x( 'Numbered links', 'pagination method', 'blockchain-lite' ),
			'text'    => esc_html_x( '"Previous - Next" links', 'pagination method', 'blockchain-lite' ),
		),
	) );

	$wp_customize->selective_refresh->add_partial( 'pagination_method', array(
		'selector'            => 'nav.navigation',
		'render_callback'     => 'blockchain_lite_customize_preview_pagination',
		'container_inclusive' => true,
	) );
