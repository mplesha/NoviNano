<?php

add_filter( 'wen_business_filter_default_theme_options', 'wen_business_slider_default_options' );

/**
 * Slider defaults.
 *
 * @since  WEN Business 1.0
 */
if( ! function_exists( 'wen_business_slider_default_options' ) ):

  function wen_business_slider_default_options( $input ){

    $input['featured_slider_status']              = 'disabled';
    $input['featured_slider_transition_effect']   = 'fadeout';
    $input['featured_slider_transition_delay']    = 3;
    $input['featured_slider_transition_duration'] = 1;
    $input['featured_slider_enable_caption']      = true;
    $input['featured_slider_enable_arrow']        = false;
    $input['featured_slider_enable_pager']        = true;
    $input['featured_slider_enable_autoplay']     = true;
    $input['featured_slider_type']                = 'featured-category';
    $input['featured_slider_number']              = 3;
    $input['featured_slider_category']            = '';

    return $input;
  }

endif;



add_filter( 'wen_business_theme_options_args', 'wen_business_slider_theme_options_args' );


/**
 * Add featured slider options.
 *
 * @since  WEN Business 1.0
 */

if( ! function_exists( 'wen_business_slider_theme_options_args' ) ):

  function wen_business_slider_theme_options_args( $args ){

    // Create featured slider option panel.
    $args['panels']['featured_slider_panel']['title'] = __( 'Featured Slider', 'wen-business' );

    // Slider Settings Section.
    $args['panels']['featured_slider_panel']['sections']['section_slider_settings'] = array(
      'title'    => __( 'Slider Settings', 'wen-business' ),
      'priority' => 75,
      'fields'   => array(
        'featured_slider_transition_effect' => array(
          'title'   => __( 'Transition Effect', 'wen-business' ),
          'type'    => 'select',
          'choices' => wen_business_get_featured_slider_transition_effects(),
        ),

        'featured_slider_transition_delay' => array(
          'title'             => __( 'Transition Delay', 'wen-business' ),
          'description'       => __( 'In second(s)', 'wen-business' ),
          'type'              => 'number',
          'sanitize_callback' => 'absint',
          'input_attrs'       => array(
                                'min'   => 1,
                                'max'   => 10,
                                'step'  => 1,
                                'style' => 'width: 50px;'
                                ),

        ),
        'featured_slider_transition_duration' => array(
          'title'             => __( 'Transition Duration', 'wen-business' ),
          'description'       => __( 'In second(s)', 'wen-business' ),
          'type'              => 'number',
          'sanitize_callback' => 'absint',
          'input_attrs'       => array(
                                'min'   => 1,
                                'max'   => 10,
                                'step'  => 1,
                                'style' => 'width: 50px;'
                                ),
        ),
        'featured_slider_enable_caption' => array(
          'title'             => __( 'Enable Caption', 'wen-business' ),
          'type'              => 'checkbox',
        ),
        'featured_slider_enable_arrow' => array(
          'title'             => __( 'Enable Arrow', 'wen-business' ),
          'type'              => 'checkbox',
        ),
        'featured_slider_enable_pager' => array(
          'title'             => __( 'Enable Pager', 'wen-business' ),
          'type'              => 'checkbox',
        ),
        'featured_slider_enable_autoplay' => array(
          'title'             => __( 'Enable Autoplay', 'wen-business' ),
          'type'              => 'checkbox',
        ),

      )
    );

    // Slider Type Section.
    $args['panels']['featured_slider_panel']['sections']['section_slider_type'] = array(
      'title'    => __( 'Slider Type', 'wen-business' ),
      'priority' => 70,
      'fields'   => array(
        'featured_slider_status' => array(
          'title'   => __( 'Enable Slider on', 'wen-business' ),
          'type'    => 'select',
          'choices' => wen_business_get_featured_slider_content_options(),
        ),
        'featured_slider_type' => array(
          'title'             => __( 'Select Slider Type', 'wen-business' ),
          'type'              => 'select',
          'choices'           => wen_business_get_featured_slider_type(),
          'sanitize_callback' => 'sanitize_key',
          'active_callback'   => 'wen_business_is_featured_slider_active',
        ),
        'featured_slider_number' => array(
          'title'             => __( 'No of Slides', 'wen-business' ),
          'type'              => 'number',
          'default'           => 3,
          'sanitize_callback' => 'absint',
          'active_callback'   => 'wen_business_is_featured_slider_active',
          'input_attrs'       => array(
                                  'min'   => 1,
                                  'max'   => 20,
                                  'style' => 'width: 55px;'
                                ),
        ),
        'featured_slider_category' => array(
          'title'             => __( 'Select Category', 'wen-business' ),
          'type'              => 'dropdown-taxonomies',
          'sanitize_callback' => 'absint',
          'active_callback'   => 'wen_business_is_featured_category_slider_active',
        ),
      )
    );

    return $args;
  }

endif;
