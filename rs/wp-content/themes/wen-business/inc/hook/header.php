<?php
if( ! function_exists( 'wen_business_site_branding' ) ) :

  /**
   * Site branding
   *
   * @since  WEN Business 1.0
   */
  function wen_business_site_branding() {

    ?>
    <div class="site-branding">
      <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
  	    <?php if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) : ?>
  	    	<?php the_custom_logo(); ?>
  		<?php else : ?>
	        <?php
	          $site_logo = wen_business_get_option( 'site_logo' );
	         ?>
	         <?php if ( ! empty( $site_logo ) ) : ?>
	          <img src="<?php echo esc_url( $site_logo ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" />
	         <?php else : ?>
	          <?php bloginfo( 'name' ); ?>
	         <?php endif; ?>

  		<?php endif; ?>

      </a></h1>
      <?php $show_tagline = wen_business_get_option( 'show_tagline' ); ?>
       <?php if ( 1 == $show_tagline ) : ?>
        <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
       <?php endif ?>
    </div><!-- .site-branding -->
    <div id="site-navigation" role="navigation">
        <?php
          wp_nav_menu( array(
            'theme_location'  => 'primary' ,
            'container'       => 'nav' ,
            'container_class' => 'main-navigation' ,
            )
          );
        ?>
    </div><!-- #site-navigation -->
    <?php

  }

endif;
add_action( 'wen_business_action_header', 'wen_business_site_branding' );


if( ! function_exists( 'wen_business_mobile_navigation' ) ) :

  /**
   * Primary navigation
   *
   * @since  WEN Business 1.0
   */
  function wen_business_mobile_navigation(){

    ?>
    <a href="#mob-menu" id="mobile-trigger"><i class="fa fa-bars"></i></a>
    <div style="display:none;">
      <div id="mob-menu">
          <?php
            wp_nav_menu( array(
              'theme_location'  => 'primary',
              'container'       => '',
            ) );
          ?>
      </div><!-- #mob-menu -->
    </div>

    <?php

  }

endif;
add_action( 'wen_business_action_before', 'wen_business_mobile_navigation', 20 );


if( ! function_exists( 'wen_business_header_top_content' ) ) :

  /**
   * Header top content
   *
   * @since  WEN Business 1.0
   */
  function wen_business_header_top_content(){

    $social_in_header = wen_business_get_option( 'social_in_header' );
    $search_in_header = wen_business_get_option( 'search_in_header' );

    ?>

    <?php if ( ( 1 == $social_in_header && wen_business_is_social_menu_active() ) || 1 == $search_in_header ): ?>

      <div id="header-top-content">
        <div class="container">
          <div class="header-top">

              <div class="header-top-inner">
                <?php if ( 1 == $social_in_header ): ?>
                  <?php the_widget( 'WEN_Business_Social_Widget', array( 'icon_size' => 'small' ) ); ?>
                <?php endif ?>
                <?php if ( 1 == $search_in_header ): ?>
                  <div id="header-search-form">
                    <?php get_search_form(); ?>
                  </div><!-- #header-search-form -->
                <?php endif ?>
              </div><!-- .header-top-inner -->

          </div><!-- .header-top -->
        </div><!-- .container -->
      </div><!-- #header-top-content -->

    <?php endif ?>


    <?php

  }

endif;
add_action( 'wen_business_action_before_header', 'wen_business_header_top_content', 5 );

