<?php

add_filter( 'wen_business_filter_default_theme_options', 'wen_business_header_default_options' );

/**
 * Header defaults.
 *
 * @since  WEN Business 1.0
 */
if( ! function_exists( 'wen_business_header_default_options' ) ):

  function wen_business_header_default_options( $input ){

    $input['site_logo']        = '';
    $input['show_tagline']     = true;
    $input['social_in_header'] = true;
    $input['search_in_header'] = true;

    return $input;
  }

endif;


add_filter( 'wen_business_theme_options_args', 'wen_business_header_theme_options_args' );


/**
 * Add header options.
 *
 * @since  WEN Business 1.0
 */
if( ! function_exists( 'wen_business_header_theme_options_args' ) ):

  function wen_business_header_theme_options_args( $args ){

    // Header Section
    $args['panels']['theme_option_panel']['sections']['section_header'] = array(
      'title'    => __( 'Header', 'wen-business' ),
      'priority' => 40,
      'fields'   => array(
        'site_logo' => array(
          'title'             => __( 'Logo', 'wen-business' ),
          'type'              => 'image',
          'sanitize_callback' => 'esc_url_raw',
        ),
        'show_tagline' => array(
          'title'   => __( 'Show Tagline', 'wen-business' ),
          'type'    => 'checkbox',
        ),
        'social_in_header' => array(
          'title'   => __( 'Show Social Icons', 'wen-business' ),
          'type'    => 'checkbox',
        ),
        'search_in_header' => array(
          'title'   => __( 'Show Search Icons', 'wen-business' ),
          'type'    => 'checkbox',
        ),
      )
    );

    // Fix logo field.
    if ( ! version_compare( $GLOBALS['wp_version'], '4.5-alpha', '<' ) ) {
    	if ( isset( $args['panels']['theme_option_panel']['sections']['section_header']['fields']['site_logo'] ) ) {
    		unset( $args['panels']['theme_option_panel']['sections']['section_header']['fields']['site_logo'] );
    	}
    }


    return $args;
  }

endif;
