<?php
	if ( current_theme_supports( 'blockchain-lite-hero' ) ) {
		$wp_customize->add_setting( 'title_blog', array(
			'default'           => esc_html__( 'From the blog', 'blockchain-lite' ),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'title_blog', array(
			'type'    => 'text',
			'section' => 'theme_titles_general',
			'label'   => esc_html__( 'Blog title', 'blockchain-lite' ),
		) );
	} // theme supports 'blockchain-lite-hero'

	$wp_customize->add_setting( 'title_search', array(
		'default'           => esc_html__( 'Search results', 'blockchain-lite' ),
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'title_search', array(
		'type'    => 'text',
		'section' => 'theme_titles_general',
		'label'   => esc_html__( 'Search title', 'blockchain-lite' ),
	) );

	$wp_customize->add_setting( 'title_404', array(
		'default'           => esc_html__( 'Page not found', 'blockchain-lite' ),
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'title_404', array(
		'type'    => 'text',
		'section' => 'theme_titles_general',
		'label'   => esc_html__( '404 (not found) title', 'blockchain-lite' ),
	) );
