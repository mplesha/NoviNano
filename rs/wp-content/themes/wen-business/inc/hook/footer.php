<?php

if( ! function_exists( 'wen_business_footer_navigation' ) ) :

  /**
   * Footer navigation
   *
   * @since  WEN Business 1.0
   */
  function wen_business_footer_navigation(){

    $footer_menu_content = wp_nav_menu( array(
      'theme_location' => 'footer' ,
      'container'      => 'div' ,
      'container_id'   => 'footer-navigation' ,
      'depth'          => 1 ,
      'fallback_cb'    => false ,
      'echo'           => false ,
    ) );
    if ( empty( $footer_menu_content ) ) {
      return;
    }
    echo '<div id="footer-nav">';
      echo '<div class="container">';
        echo $footer_menu_content;
      echo '</div><!-- .container -->';
    echo '</div><!-- #footer-nav -->';
    return;

  }

endif;

add_action( 'wen_business_action_before_footer', 'wen_business_footer_navigation', 5 );

if( ! function_exists( 'wen_business_footer_copyright' ) ) :

  /**
   * Footer copyright
   *
   * @since  WEN Business 1.0
   */
  function wen_business_footer_copyright(){

    // Check if footer is disabled
    $footer_status = apply_filters( 'wen_business_filter_footer_status', true );
    if ( true !== $footer_status) {
      return;
    }

    // Copyright
    $copyright_text = wen_business_get_option( 'copyright_text' );
    $copyright_text = apply_filters( 'wen_business_filter_copyright_text', $copyright_text );

    ?>
    <div class="row">
      <div class="col-sm-6">
        <?php if ( ! empty( $copyright_text ) ): ?>
          <div class="copyright">
            <?php echo esc_html( $copyright_text ); ?>
          </div><!-- .copyright -->
        <?php endif ?>

      </div><!-- .col-sm-6 -->
      <div class="col-sm-6">

          <div class="site-info">
            <a href="<?php echo esc_url( __( 'http://wordpress.org/', 'wen-business' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'wen-business' ), 'WordPress' ); ?></a>
            <span class="sep"> | </span>
            <?php printf( __( '%1$s by %2$s', 'wen-business' ), 'WEN Business', '<a href="' . esc_url( 'https://wenthemes.com/' ) . '" rel="designer" target="_blank">WEN Themes</a>' ); ?>
          </div><!-- .site-info -->

      </div><!-- .col-sm-6 -->
    </div><!-- .row -->
    <?php

  }

endif;

add_action( 'wen_business_action_footer', 'wen_business_footer_copyright', 10 );

if( ! function_exists( 'wen_business_footer_goto_top' ) ) :

  /**
   * Go to top
   *
   * @since  WEN Business 1.0
   */
  function wen_business_footer_goto_top(){

    $go_to_top = wen_business_get_option( 'go_to_top' );
    if ( 1 != $go_to_top ) {
      return;
    }
    echo '<a href="#" class="scrollup" id="btn-scrollup"><i class="fa fa-chevron-circle-up"></i></a>';

  }

endif;

add_action( 'wen_business_action_after', 'wen_business_footer_goto_top', 20 );

