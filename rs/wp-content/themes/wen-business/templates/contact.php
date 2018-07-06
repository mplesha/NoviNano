<?php
/**
 * Template Name: Contact Page
 */

get_header(); ?>

  <div id="primary" <?php wen_business_content_class( 'content-area' ); ?> >
    <main id="main" class="site-main" role="main">

      <?php while ( have_posts() ) : the_post(); ?>

        <?php get_template_part( 'content', 'page' ); ?>

        <?php
          // If comments are open or we have at least one comment, load up the comment template
          if ( comments_open() || get_comments_number() ) :
            comments_template();
          endif;
        ?>

      <?php endwhile; // end of the loop. ?>

    </main><!-- #main -->
  </div><!-- #primary -->

<?php
/**
 * wen_business_action_sidebar hook
 *
 * @hooked: wen_business_add_contact_sidebar - 10
 *
 */
do_action( 'wen_business_action_contact_sidebar' );?>

<?php get_footer(); ?>
