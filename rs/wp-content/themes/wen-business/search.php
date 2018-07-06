<?php
/**
 * The template for displaying search results pages.
 *
 * @package WEN Business
 */

get_header(); ?>

	<section id="primary" <?php wen_business_content_class( 'content-area' ); ?> >
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'wen-business' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'search' ); ?>

			<?php endwhile; ?>

			<?php
		      /**
		       * wen_business_action_posts_navigation hook
		       *
		       * @hooked: wen_business_custom_posts_navigation - 10
		       *
		       */
		      do_action( 'wen_business_action_posts_navigation' ); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->


<?php
/**
 * wen_business_action_sidebar hook
 *
 * @hooked: wen_business_add_sidebar - 10
 *
 */
do_action( 'wen_business_action_sidebar' );?>


<?php get_footer(); ?>
