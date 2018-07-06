<?php

if ( ! function_exists( 'wen_business_doctype' ) ) :
  /**
   * Doctype Declaration
   *
   * @since WEN Business 1.0
   *
   */
  function wen_business_doctype() {
    ?><!DOCTYPE html> <html <?php language_attributes(); ?>><?php
  }
endif;
add_action( 'wen_business_action_doctype', 'wen_business_doctype', 10 );


if ( ! function_exists( 'wen_business_head' ) ) :
  /**
   * Header Codes
   *
   * @since WEN Business 1.0
   *
   */
  function wen_business_head() {
    ?>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php
  }
endif;
add_action( 'wen_business_action_head', 'wen_business_head', 10 );

if ( ! function_exists( 'wen_business_page_start' ) ) :
  /**
   * Page Start
   *
   * @since WEN Business 1.0
   *
   */
  function wen_business_page_start() {
    // Get site layout
    $site_layout = wen_business_get_option( 'site_layout' );
    ?>
    <?php if ( 'boxed' == $site_layout ): ?>
    <div id="page" class="hfeed site container">
    <?php else: ?>
    <div id="page" class="hfeed site container-fluid">
    <?php endif ?>
    <?php
  }
endif;
add_action( 'wen_business_action_before', 'wen_business_page_start' );


if ( ! function_exists( 'wen_business_skip_to_content' ) ) :
  /**
   * Skip to content
   *
   * @since WEN Business 1.0
   *
   */
  function wen_business_skip_to_content() {
    ?><a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'wen-business' ); ?></a><?php
  }
endif;
add_action( 'wen_business_action_before', 'wen_business_skip_to_content', 15 );


if ( ! function_exists( 'wen_business_page_end' ) ) :
  /**
   * Page Start
   *
   * @since WEN Business 1.0
   *
   */
  function wen_business_page_end() {
    ?></div><!-- #page --><?php
  }
endif;
add_action( 'wen_business_action_after', 'wen_business_page_end' );


if ( ! function_exists( 'wen_business_header_start' ) ) :
  /**
   * Header Start
   *
   * @since WEN Business 1.0
   *
   */
  function wen_business_header_start() {
    ?><header id="masthead" class="site-header" role="banner"><div class="container"><?php
  }
endif;
add_action( 'wen_business_action_before_header', 'wen_business_header_start' );

if ( ! function_exists( 'wen_business_header_end' ) ) :
  /**
   * Header End
   *
   * @since WEN Business 1.0
   *
   */
  function wen_business_header_end() {
    ?></div><!-- .container --></header><!-- #masthead --><?php
  }
endif;
add_action( 'wen_business_action_after_header', 'wen_business_header_end' );


if ( ! function_exists( 'wen_business_footer_start' ) ) :
  /**
   * Footer Start
   *
   * @since WEN Business 1.0
   *
   */
  function wen_business_footer_start() {
    $footer_status = apply_filters( 'wen_business_filter_footer_status', true );
    if ( true !== $footer_status) {
      return;
    }
    ?><footer id="colophon" class="site-footer" role="contentinfo" ><div class="container"><?php
  }
endif;
add_action( 'wen_business_action_before_footer', 'wen_business_footer_start' );


if ( ! function_exists( 'wen_business_footer_end' ) ) :
  /**
   * Footer End
   *
   * @since WEN Business 1.0
   *
   */
  function wen_business_footer_end() {
    $footer_status = apply_filters( 'wen_business_filter_footer_status', true );
    if ( true !== $footer_status) {
      return;
    }
    ?></div><!-- .container --></footer><!-- #colophon --><?php
  }
endif;
add_action( 'wen_business_action_after_footer', 'wen_business_footer_end' );


if ( ! function_exists( 'wen_business_content_start' ) ) :
  /**
   * Content Start
   *
   * @since WEN Business 1.0
   *
   */
  function wen_business_content_start() {
    ?><div id="content" class="site-content"><div class="container"><div class="row"><?php
  }
endif;
add_action( 'wen_business_action_before_content', 'wen_business_content_start' );


if ( ! function_exists( 'wen_business_content_end' ) ) :
  /**
   * Content End
   *
   * @since WEN Business 1.0
   *
   */
  function wen_business_content_end() {
    ?></div><!-- .row --></div><!-- .container --></div><!-- #content --><?php
  }
endif;
add_action( 'wen_business_action_after_content', 'wen_business_content_end' );

