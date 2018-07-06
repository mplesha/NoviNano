<?php

add_filter( 'wen_business_filter_default_theme_options', 'wen_business_breadcrumb_default_options' );

/**
 * Breadcrumb defaults.
 *
 * @since  WEN Business 1.0
 */
if( ! function_exists( 'wen_business_breadcrumb_default_options' ) ):

  function wen_business_breadcrumb_default_options( $input ){

    $input['breadcrumb_type']      = 'disabled';
    $input['breadcrumb_separator'] = '&gt;';

    return $input;
  }

endif;


add_filter( 'wen_business_theme_options_args', 'wen_business_breadcrumb_theme_options_args' );


/**
 * Add breadcrumb options.
 *
 * @since  WEN Business 1.0
 */
if( ! function_exists( 'wen_business_breadcrumb_theme_options_args' ) ):

  function wen_business_breadcrumb_theme_options_args( $args ){

    // Breadcrumb Section
    $args['panels']['theme_option_panel']['sections']['section_breadcrumb'] = array(
      'title'    => __( 'Breadcrumb', 'wen-business' ),
      'priority' => 80,
      'fields'   => array(
        'breadcrumb_type' => array(
			'title'             => __( 'Breadcrumb Type', 'wen-business' ),
			'description'       => sprintf( __( 'Advanced: Requires %1$sBreadcrumb NavXT%2$s plugin', 'wen-business' ), '<a href="https://wordpress.org/plugins/breadcrumb-navxt/" target="_blank">','</a>' ),
			'type'              => 'select',
			'choices'           => wen_business_get_breadcrumb_type_options(),
			'sanitize_callback' => 'sanitize_key',
        ),
        'breadcrumb_separator' => array(
			'title'           => __( 'Separator', 'wen-business' ),
			'type'            => 'text',
			'input_attrs'     => array( 'style' => 'width: 55px;' ),
			'active_callback' => 'wen_business_is_simple_breadcrumb_active',
        ),
      )
    );

    return $args;
  }

endif;
