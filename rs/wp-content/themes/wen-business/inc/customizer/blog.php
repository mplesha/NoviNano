<?php

add_filter( 'wen_business_filter_default_theme_options', 'wen_business_blog_default_options' );

/**
 * Blog defaults.
 *
 * @since  WEN Business 1.0
 */
if( ! function_exists( 'wen_business_blog_default_options' ) ):

  function wen_business_blog_default_options( $input ){

    $input['excerpt_length']       = 40;
    $input['read_more_text']       = __( 'Read More ...', 'wen-business' );
    $input['exclude_categories']   = '';
    $input['author_bio_in_single'] = false;

    return $input;
  }

endif;

add_filter( 'wen_business_theme_options_args', 'wen_business_blog_theme_options_args' );


/**
 * Add blog options.
 *
 * @since  WEN Business 1.0
 */
if( ! function_exists( 'wen_business_blog_theme_options_args' ) ):

  function wen_business_blog_theme_options_args( $args ){

    // Blog Section
    $args['panels']['theme_option_panel']['sections']['section_blog'] = array(
      'title'    => __( 'Blog', 'wen-business' ),
      'priority' => 80,
      'fields'   => array(
        'excerpt_length' => array(
          'title'             => __( 'Excerpt Length (words)', 'wen-business' ),
          'description'       => __( 'Default is 40 words', 'wen-business' ),
          'type'              => 'number',
          'sanitize_callback' => 'wen_business_sanitize_excerpt_length',
          'input_attrs'       => array(
                                  'min'   => 1,
                                  'max'   => 200,
                                  'style' => 'width: 55px;'
                                ),
        ),
        'read_more_text' => array(
          'title'             => __( 'Read More Text', 'wen-business' ),
          'type'              => 'text',
          'sanitize_callback' => 'sanitize_text_field',
        ),
        'exclude_categories' => array(
          'title'             => __( 'Exclude Categories in Blog', 'wen-business' ),
          'description'       => __( 'Enter category ID to exclude in Blog Page. Separate with comma if more than one', 'wen-business' ),
          'type'              => 'text',
          'sanitize_callback' => 'sanitize_text_field',
        ),
        'author_bio_in_single' => array(
          'title'             => __( 'Show Author Bio', 'wen-business' ),
          'type'              => 'checkbox',
        ),
      )
    );

    return $args;
  }

endif;

/**
 * Sanitize excerpt length
 *
 * @since  WEN Business 1.0
 */
if( ! function_exists( 'wen_business_sanitize_excerpt_length' ) ) :

  function wen_business_sanitize_excerpt_length( $input ) {

    $input = absint( $input );

    if ( $input < 1 ) {
      $input = 40;
    }
    return $input;

  }

endif;
