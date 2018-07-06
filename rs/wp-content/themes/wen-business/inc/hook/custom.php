<?php

if ( ! function_exists( 'wen_business_custom_body_class' ) ) :
  /**
   * Custom body class
   *
   * @since WEN Business 1.0
   *
   */
  function wen_business_custom_body_class( $input ) {

    // Site layout
    $site_layout = wen_business_get_option( 'site_layout' );
    $input[] = 'site-layout-' . esc_attr( $site_layout );

    // Global layout
    global $post;
    $global_layout = wen_business_get_option( 'global_layout' );
    // Check if single
    if ( $post  && is_singular() ) {
      $post_options = get_post_meta( $post->ID, 'theme_settings', true );
      if ( isset( $post_options['post_layout'] ) && ! empty( $post_options['post_layout'] ) ) {
        $global_layout = $post_options['post_layout'];
      }
    }

    $input[] = 'global-layout-' . esc_attr( $global_layout );

    return $input;
  }
endif;
add_filter( 'body_class', 'wen_business_custom_body_class' );


if ( ! function_exists( 'wen_business_custom_content_class' ) ) :

  /**
   * Custom Primary class
   *
   * @since WEN Business 1.0
   *
   */
  function wen_business_custom_content_class( $input ) {

    global $post;
    $global_layout = wen_business_get_option( 'global_layout' );
    // Check if single
    if ( $post  && is_singular() ) {
      $post_options = get_post_meta( $post->ID, 'theme_settings', true );
      if ( isset( $post_options['post_layout'] ) && ! empty( $post_options['post_layout'] ) ) {
        $global_layout = $post_options['post_layout'];
      }
    }

    $new_class = '';

    switch ( $global_layout ) {
      case 'three-columns':
        $new_class = 'col-sm-6';
        break;

      case 'no-sidebar':
        $new_class = 'col-sm-12';
        break;

      case 'left-sidebar':
      case 'right-sidebar':
        $new_class = 'col-sm-8';
        break;

      default:
        break;
    }
    if ( ! empty( $new_class ) ) {
      $input[] = $new_class;
    }

    return $input;
  }
endif;
add_filter( 'wen_business_filter_content_class', 'wen_business_custom_content_class' );


if ( ! function_exists( 'wen_business_custom_sidebar_primary_class' ) ) :
  /**
   * Custom Sidebar Primary class
   *
   * @since WEN Business 1.0
   *
   */
  function wen_business_custom_sidebar_primary_class( $input ) {


    global $post;
    $global_layout = wen_business_get_option( 'global_layout' );
    // Check if single
    if ( $post && is_singular() ) {
      $post_options = get_post_meta( $post->ID, 'theme_settings', true );
      if ( isset( $post_options['post_layout'] ) && ! empty( $post_options['post_layout'] ) ) {
        $global_layout = $post_options['post_layout'];
      }
    }

    $new_class = '';

    switch ( $global_layout ) {
      case 'three-columns':
        $new_class = 'col-sm-3';
        break;

      case 'left-sidebar':
      case 'right-sidebar':
        $new_class = 'col-sm-4';
        break;

      default:
        break;
    }
    if ( ! empty( $new_class ) ) {
      $input[] = $new_class;
    }

    return $input;
  }
endif;
add_filter( 'wen_business_filter_sidebar_primary_class', 'wen_business_custom_sidebar_primary_class' );


if ( ! function_exists( 'wen_business_custom_sidebar_secondary_class' ) ) :

  /**
   * Custom Sidebar Secondary class
   *
   * @since WEN Business 1.0
   *
   */
  function wen_business_custom_sidebar_secondary_class( $input ) {

    global $post;
    $global_layout = wen_business_get_option( 'global_layout' );
    // Check if single
    if ( $post  && is_singular() ) {
      $post_options = get_post_meta( $post->ID, 'theme_settings', true );
      if ( isset( $post_options['post_layout'] ) && ! empty( $post_options['post_layout'] ) ) {
        $global_layout = $post_options['post_layout'];
      }
    }

    $new_class = '';

    switch ( $global_layout ) {
      case 'three-columns':
        $new_class = 'col-sm-3';
        break;

      default:
        break;
    }
    if ( ! empty( $new_class ) ) {
      $input[] = $new_class;
    }

    return $input;
  }
endif;

add_filter( 'wen_business_filter_sidebar_secondary_class', 'wen_business_custom_sidebar_secondary_class' );



if ( ! function_exists( 'wen_business_custom_content_width' ) ) :

  /**
   * Custom Content Width
   *
   * @since WEN Business 1.0
   *
   */
  function wen_business_custom_content_width( $input ) {

    global $post, $wp_query, $content_width;

    $global_layout = wen_business_get_option( 'global_layout' );

    // Check if single
    if ( $post  && is_singular() ) {
      $post_options = get_post_meta( $post->ID, 'theme_settings', true );
      if ( isset( $post_options['post_layout'] ) && ! empty( $post_options['post_layout'] ) ) {
        $global_layout = $post_options['post_layout'];
      }
    }
    switch ( $global_layout ) {

      case 'no-sidebar':
        $content_width = 1140;
        break;

      case 'three-columns':
        $content_width = 555;
        break;

      case 'left-sidebar':
      case 'right-sidebar':
        $content_width = 750;
        break;

      default:
        break;
    }

  }
endif;

add_filter( 'template_redirect', 'wen_business_custom_content_width' );


if ( ! function_exists( 'wen_business_implement_front_page_widget_area' ) ) :

  /**
   * Implement front page widget area
   *
   * @since WEN Business 1.0
   *
   */
  function wen_business_implement_front_page_widget_area(){

    echo '<div id="sidebar-front-page-widget-area" class="widget-area">';

    if ( is_active_sidebar( 'sidebar-front-page-widget-area' ) ) {
      // Sidebar active
      dynamic_sidebar( 'sidebar-front-page-widget-area' );
    }

    echo '</div><!-- #sidebar-front-page-widget-area -->';

  }

endif;

add_action( 'wen_business_action_front_page', 'wen_business_implement_front_page_widget_area' );



if ( ! function_exists( 'wen_business_add_author_bio_in_single' ) ) :

  /**
   * Display Author bio
   *
   * @since WEN Business 1.0
   *
   */
  function wen_business_add_author_bio_in_single() {

    $author_bio_in_single = wen_business_get_option( 'author_bio_in_single' );
    if ( 1 != $author_bio_in_single ) {
      return;
    }
    get_template_part( 'template-parts/single-author', 'bio' );

  }
endif;

add_action( 'wen_business_author_bio', 'wen_business_add_author_bio_in_single' );


if ( ! function_exists( 'wen_business_check_front_widget_status' ) ) :

  /**
   * Filter for front page
   *
   * @since WEN Business 1.0
   *
   */
  function wen_business_check_front_widget_status( $template ) {

    if ( ! is_active_sidebar( 'sidebar-front-page-widget-area' ) ) {
      return '';
    }
    return $template;

  }
endif;

add_filter( 'frontpage_template', 'wen_business_check_front_widget_status' );

if ( ! function_exists( 'wen_business_featured_image_instruction' ) ) :

  /**
   * Message to show in the Featured Image Meta box.
   *
   * @since WEN Business 1.0
   *
   */
  function wen_business_featured_image_instruction( $content, $post_id ) {

    if ( 'post' == get_post_type( $post_id ) ) {
      $content .= '<strong>' . __( 'Recommended Image Sizes', 'wen-business' ) . ':</strong><br/>';
      $content .= __( 'Slider Image', 'wen-business' ).' : 1600px X 440px';
    }

    return $content;

  }

endif;
add_filter( 'admin_post_thumbnail_html', 'wen_business_featured_image_instruction', 10, 2 );
