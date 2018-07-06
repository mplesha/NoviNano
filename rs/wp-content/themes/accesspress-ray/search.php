<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package AccessPress Ray
 */

get_header(); 
global $accesspress_ray_options;
$accesspress_ray_settings = get_option( 'accesspress_ray_options', $accesspress_ray_options );
$accesspress_ray_template_design = $accesspress_ray_settings['accesspress_ray_template_design'];
?>
<div class="ak-container">
	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'accesspress-ray' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'summary' ); ?>

			<?php endwhile; ?>

			<?php accesspress_ray_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_sidebar('right'); ?>
</div>
<?php 
	if( $accesspress_ray_template_design == 'style1_template' ) {
		get_footer('two');
	}else{
		get_footer();
	}
?>