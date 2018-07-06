<?php
	$sample_content_url = apply_filters( 'blockchain_lite_sample_content_url',
		sprintf( 'https://www.cssigniter.com/sample_content/%s.zip', BLOCKCHAIN_LITE_NAME ),
		'https://www.cssigniter.com/sample_content/',
		BLOCKCHAIN_LITE_NAME
	);

	if ( ! empty( $sample_content_url ) && ( ! defined( 'BLOCKCHAIN_LITE_WHITELABEL' ) || false === (bool) BLOCKCHAIN_LITE_WHITELABEL ) ) {
		$wp_customize->add_setting( 'sample_content_link', array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( new Blockchain_Lite_Customize_Static_Text_Control( $wp_customize, 'sample_content_link', array(
			'section'     => 'theme_other_sample_content',
			'label'       => esc_html__( 'Sample content bundle', 'blockchain-lite' ),
			'description' => array(
				wp_kses(
					/* translators: %s is a URL */
					sprintf( __( '<a href="%s" target="_blank">Download the theme\'s sample content files</a> to get things moving.', 'blockchain-lite' ),
						esc_url( $sample_content_url )
					),
					blockchain_lite_get_allowed_tags( 'guide' )
				),
			),
		) ) );
	}
