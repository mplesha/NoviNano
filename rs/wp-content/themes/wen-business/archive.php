<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WEN Business
 */

get_header(); ?>

	<div id="primary" <?php wen_business_content_class( 'content-area' ); ?> >
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
          the_archive_title( '<h2 class="page-title">', '</h2>' );
          the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );
				?>

			<?php endwhile; ?>

			<?php
      /**
       * wen_business_action_posts_navigation hook
       *
       * @hooked: wen_business_custom_posts_navigation - 10
       *
       */
      do_action( 'wen_business_action_posts_navigation' );?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
/**
 * wen_business_action_sidebar hook
 *
 * @hooked: wen_business_add_sidebar - 10
 *
 */
do_action( 'wen_business_action_sidebar' );?>

<?php get_footer(); ?>
