<?php get_header(); ?>

<?php get_template_part( 'template-parts/hero' ); ?>

<main class="main">

	<div class="container">
		<div class="row">

			<div class="<?php blockchain_lite_the_container_classes(); ?>">

				<article class="entry error-404 not-found">
					<header class="entry-header">

						<h1 class="entry-title">
							<?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'blockchain-lite' ); ?>
						</h1>

					</header>

					<div class="entry-content">
						<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'blockchain-lite' ); ?></p>

						<?php get_search_form(); ?>
					</div>
				</article>

			</div>

			<?php get_sidebar(); ?>

		</div>
	</div>

</main>

<?php get_footer();
