<?php get_header(); ?>

<main class="main">

	<div class="container">
		<div class="row">

			<div class="<?php blockchain_lite_the_container_classes(); ?>">

				<?php woocommerce_content(); ?>

			</div>

			<?php get_sidebar(); ?>

		</div>
	</div>

</main>

<?php get_footer();
