<?php
/**
 * Front Page.
 *
 * @package WEN Business
 *
 */

get_header(); ?>

  <div id="primary" class="content-area col-sm-12" >
    <main id="main" class="site-main" role="main">

      <?php
      /**
       * wen_business_action_front_page hook
       */
      do_action( 'wen_business_action_front_page' );
      ?>

    </main><!-- #main -->
  </div><!-- #primary -->

<?php get_footer(); ?>
