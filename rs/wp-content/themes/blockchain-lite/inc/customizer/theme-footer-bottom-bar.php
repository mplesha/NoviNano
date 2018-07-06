<?php
	$wp_customize->add_setting( 'footer_show_bottom_bar', array(
		'transport'         => 'postMessage',
		'default'           => 1,
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 'footer_show_bottom_bar', array(
		'type'    => 'checkbox',
		'section' => 'theme_footer_bottom_bar',
		'label'   => esc_html__( 'Show bottom bar', 'blockchain-lite' ),
	) );

	$wp_customize->selective_refresh->get_partial( 'theme_footer_layout' )->settings[] = 'footer_show_bottom_bar';

	$wp_customize->add_setting( 'footer_show_social_icons', array(
		'transport'         => 'postMessage',
		'default'           => 1,
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 'footer_show_social_icons', array(
		'type'    => 'checkbox',
		'section' => 'theme_footer_bottom_bar',
		'label'   => esc_html__( 'Show social icons', 'blockchain-lite' ),
	) );

	$wp_customize->selective_refresh->add_partial( 'footer_bottom_bar', array(
		'selector'            => '.footer-info',
		'render_callback'     => 'blockchain_lite_footer_bottom_bar',
		'settings'            => array( 'footer_show_social_icons' ),
		'container_inclusive' => true,
		'fallback_refresh'    => true,
	) );
