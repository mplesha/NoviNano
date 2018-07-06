<?php

if( ! function_exists( 'wen_business_get_featured_slider_transition_effects' ) ) :

  /**
   * Returns the featured slider transition effects.
   *
   * @since WEN Business 1.0
   */
  function wen_business_get_featured_slider_transition_effects(){

    $choices = array(
      'fade'       => __( 'fade', 'wen-business' ),
      'fadeout'    => __( 'fadeout', 'wen-business' ),
      'none'       => __( 'none', 'wen-business' ),
      'scrollHorz' => __( 'scrollHorz', 'wen-business' ),
    );
    $output = apply_filters( 'wen_business_filter_featured_slider_transition_effects', $choices );
    if ( ! empty( $output ) ) {
      ksort( $output );
    }
    return $output;

  }

endif;


if( ! function_exists( 'wen_business_get_featured_slider_content_options' ) ) :

  /**
   * Returns the featured slider content options.
   *
   * @since WEN Business 1.0
   */
  function wen_business_get_featured_slider_content_options(){

    $choices = array(
      'home-page'   => __( 'Home Page / Front Page', 'wen-business' ),
      'entire-site' => __( 'Entire Site', 'wen-business' ),
      'disabled'    => __( 'Disabled', 'wen-business' ),
    );
    $output = apply_filters( 'wen_business_filter_featured_slider_content_options', $choices );
    if ( ! empty( $output ) ) {
      ksort( $output );
    }
    return $output;


  }

endif;


if( ! function_exists( 'wen_business_get_featured_slider_type' ) ) :

  /**
   * Returns the featured slider type.
   *
   * @since WEN Business 1.0
   */
  function wen_business_get_featured_slider_type(){

    $choices = array(
      'featured-category' => __( 'Featured Category', 'wen-business' ),
    );
    $output = apply_filters( 'wen_business_filter_featured_slider_type', $choices );
    if ( ! empty( $output ) ) {
      ksort( $output );
    }
    return $output;


  }

endif;


if( ! function_exists( 'wen_business_get_global_layout_options' ) ) :

  /**
   * Returns global layout options.
   *
   * @since WEN Business 1.0
   */
  function wen_business_get_global_layout_options(){

    $choices = array(
      'left-sidebar'  => __( 'Primary Sidebar - Content', 'wen-business' ),
      'right-sidebar' => __( 'Content - Primary Sidebar', 'wen-business' ),
      'three-columns' => __( 'Three Columns', 'wen-business' ),
      'no-sidebar'    => __( 'No Sidebar', 'wen-business' ),
    );
    $output = apply_filters( 'wen_business_filter_layout_options', $choices );
    return $output;

  }

endif;


if( ! function_exists( 'wen_business_get_site_layout_options' ) ) :

  /**
   * Returns site options.
   *
   * @since WEN Business 1.0
   */
  function wen_business_get_site_layout_options(){

    $choices = array(
      'fluid' => __( 'Fluid', 'wen-business' ),
      'boxed' => __( 'Boxed', 'wen-business' ),
    );
    $output = apply_filters( 'wen_business_filter_site_layout_options', $choices );
    if ( ! empty( $output ) ) {
      ksort( $output );
    }
    return $output;

  }

endif;


if( ! function_exists( 'wen_business_get_archive_layout_options' ) ) :

  /**
   * Returns archive layout options.
   *
   * @since WEN Business 1.0
   */
  function wen_business_get_archive_layout_options(){

    $choices = array(
      'full'          => __( 'Full Post', 'wen-business' ),
      'excerpt'       => __( 'Excerpt Only', 'wen-business' ),
      'excerpt-thumb' => __( 'Excerpt and Thumbnail', 'wen-business' ),
    );
    $output = apply_filters( 'wen_business_filter_archive_layout_options', $choices );
    if ( ! empty( $output ) ) {
      ksort( $output );
    }
    return $output;


  }

endif;


if( ! function_exists( 'wen_business_get_image_sizes_options' ) ) :

  /**
   * Returns archive layout options.
   *
   * @since WEN Business 1.0
   */
  function wen_business_get_image_sizes_options(){

    global $_wp_additional_image_sizes;
    $get_intermediate_image_sizes = get_intermediate_image_sizes();
    $choices = array();
    $choices['disable'] = __( 'No Image', 'wen-business' );
    foreach ( array( 'thumbnail', 'medium', 'large' ) as $key => $_size ) {
      $choices[ $_size ] = $_size . ' ('. get_option( $_size . '_size_w' ) . 'x' . get_option( $_size . '_size_h' ) . ')';
    }
    $choices['full'] = __( 'full (original)', 'wen-business' );
    if ( ! empty( $_wp_additional_image_sizes ) && is_array( $_wp_additional_image_sizes ) ) {

      foreach ($_wp_additional_image_sizes as $key => $size ) {
        $choices[ $key ] = $key . ' ('. $size['width'] . 'x' . $size['height'] . ')';
      }

    }
    return $choices;

  }

endif;



if( ! function_exists( 'wen_business_get_single_image_alignment_options' ) ) :

  /**
   * Returns single image options.
   *
   * @since WEN Business 1.0
   */
  function wen_business_get_single_image_alignment_options(){

    $choices = array(
      'none'   => __( 'None', 'wen-business' ),
      'left'   => __( 'Left', 'wen-business' ),
      'center' => __( 'Center', 'wen-business' ),
      'right'  => __( 'Right', 'wen-business' ),
    );
    return $choices;

  }

endif;


if( ! function_exists( 'wen_business_get_pagination_type_options' ) ) :

  /**
   * Returns pagination type options.
   *
   * @since WEN Business 1.0
   */
  function wen_business_get_pagination_type_options(){

    $choices = array(
      'default' => __( 'Default (Older / Newer Post)', 'wen-business' ),
      'numeric' => __( 'Numeric', 'wen-business' ),
    );
    return $choices;

  }

endif;


if( ! function_exists( 'wen_business_get_breadcrumb_type_options' ) ) :

  /**
   * Returns breadcrumb type options.
   *
   * @since WEN Business 1.0
   */
  function wen_business_get_breadcrumb_type_options(){

    $choices = array(
      'disabled' => __( 'Disabled', 'wen-business' ),
      'simple'   => __( 'Simple', 'wen-business' ),
      'advanced' => __( 'Advanced', 'wen-business' ),
    );
    return $choices;

  }

endif;
