<?php

add_filter( 'wen_business_filter_default_theme_options', 'wen_business_layout_default_options' );

/**
 * Layout defaults.
 *
 * @since  WEN Business 1.0
 */
if( ! function_exists( 'wen_business_layout_default_options' ) ):

  function wen_business_layout_default_options( $input ){

    $input['site_layout']            = 'fluid';
    $input['global_layout']          = 'right-sidebar';
    $input['archive_layout']         = 'full';
    $input['single_image']           = 'large';
    $input['single_image_alignment'] = 'center';

    return $input;
  }

endif;


add_filter( 'wen_business_theme_options_args', 'wen_business_layout_theme_options_args' );

/**
 * Add layout options.
 *
 * @since  WEN Business 1.0
 */
if( ! function_exists( 'wen_business_layout_theme_options_args' ) ):

  function wen_business_layout_theme_options_args( $args ){

    // Layout Section
    $args['panels']['theme_option_panel']['sections']['section_layout'] = array(
      'title'    => __( 'Layout', 'wen-business' ),
      'priority' => 70,
      'fields'   => array(
        'site_layout' => array(
          'title'             => __( 'Site Layout', 'wen-business' ),
          'type'              => 'select',
          'choices'           => wen_business_get_site_layout_options(),
          'sanitize_callback' => 'sanitize_key',
        ),
        'global_layout' => array(
          'title'             => __( 'Global Layout', 'wen-business' ),
          'type'              => 'select',
          'choices'           => wen_business_get_global_layout_options(),
          'sanitize_callback' => 'sanitize_key',
        ),
        'archive_layout' => array(
          'title'             => __( 'Archive Layout', 'wen-business' ),
          'type'              => 'select',
          'choices'           => wen_business_get_archive_layout_options(),
          'sanitize_callback' => 'sanitize_key',
        ),
        'single_image' => array(
          'title'             => __( 'Image in Single Post/Page', 'wen-business' ),
          'type'              => 'select',
          'choices'           => wen_business_get_image_sizes_options(),
          'sanitize_callback' => 'sanitize_key',
        ),
        'single_image_alignment' => array(
          'title'             => __( 'Alignment of Image in Single Post/Page', 'wen-business' ),
          'type'              => 'select',
          'choices'           => wen_business_get_single_image_alignment_options(),
          'sanitize_callback' => 'sanitize_key',
        ),
      )
    );

    return $args;
  }

endif;
