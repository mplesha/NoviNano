<?php

add_filter( 'wen_business_filter_default_theme_options', 'wen_business_pagination_default_options' );

/**
 * Pagination defaults.
 *
 * @since  WEN Business 1.0
 */
if( ! function_exists( 'wen_business_pagination_default_options' ) ):

  function wen_business_pagination_default_options( $input ){

    $input['pagination_type']       = 'default';

    return $input;
  }

endif;


add_filter( 'wen_business_theme_options_args', 'wen_business_pagination_theme_options_args' );

/**
 * Add pagination options.
 *
 * @since  WEN Business 1.0
 */
if( ! function_exists( 'wen_business_pagination_theme_options_args' ) ):

  function wen_business_pagination_theme_options_args( $args ){

    // Pagination Section
    $args['panels']['theme_option_panel']['sections']['section_pagination'] = array(
      'title'    => __( 'Pagination', 'wen-business' ),
      'priority' => 70,
      'fields'   => array(
        'pagination_type' => array(
          'title'             => __( 'Pagination Type', 'wen-business' ),
          'description'       => sprintf( __( 'Numeric: Requires %1$sWP-PageNavi%2$s plugin', 'wen-business' ), '<a href="https://wordpress.org/plugins/wp-pagenavi/" target="_blank">','</a>' ),
          'type'              => 'select',
          'sanitize_callback' => 'sanitize_key',
          'choices'           => wen_business_get_pagination_type_options(),
        ),
      )
    );

    return $args;
  }

endif;
