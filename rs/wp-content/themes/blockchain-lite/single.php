<?php get_header(); ?>

<?php get_template_part( 'template-parts/hero' ); ?>

<main class="main">

	<div class="container">
		<div class="row">

			<div class="<?php blockchain_lite_the_container_classes(); ?>">

				<?php while ( have_posts() ) : the_post(); ?>

					<article id="entry-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?>>

						<?php blockchain_lite_the_post_header(); ?>

						<?php blockchain_lite_the_post_thumbnail(); ?>

						<div class="entry-content">
							<?php if ( has_excerpt() ) : ?>
								<div class="entry-content-intro">
									<?php the_excerpt(); ?>
								</div>
							<?php endif; ?>

							<?php the_content(); ?>

							<?php wp_link_pages( blockchain_lite_wp_link_pages_default_args() ); ?>
						</div>

						<?php if ( has_tag() && get_theme_mod( 'post_show_tags', 1 ) ) : ?>
							<div class="entry-tags">
								<?php the_tags( '', ' ' ); ?>
							</div>
						<?php endif; ?>

					</article>

					<?php if ( get_theme_mod( 'post_show_authorbox', 1 ) ) {
						blockchain_lite_the_post_author_box();
					} ?>

					<?php if ( get_theme_mod( 'post_show_related', 1 ) ) {
						get_template_part( 'template-parts/related', get_post_type() );
					} ?>

					<?php if ( get_theme_mod( 'post_show_comments', 1 ) ) {
						comments_template();
					} ?>

				<?php endwhile; ?>

			</div>

			<?php get_sidebar(); ?>

		</div>
	</div>
</main>

<?php get_footer();
