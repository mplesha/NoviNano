<?php get_header(); ?>

<?php get_template_part( 'template-parts/hero' ); ?>

<main class="main">
	<div class="container">

		<div class="row">
			<div class="<?php blockchain_lite_the_container_classes(); ?>">

				<?php get_template_part( 'template-parts/archive-heading' ); ?>

				<?php
					if ( have_posts() ) :

						$layout  = get_theme_mod( 'archive_layout', blockchain_lite_archive_layout_default() );
						$masonry = get_theme_mod( 'archive_masonry', 1 );
						$classes = array();
						if ( $masonry ) {
							$classes[] = 'row-isotope';
						}

						?>
						<div class="row row-items <?php echo esc_attr( implode( ' ', $classes ) ); ?>">

							<?php while ( have_posts() ) : the_post(); ?>

								<div class="<?php echo esc_attr( blockchain_lite_get_columns_classes( $layout ) ); ?>">

									<?php get_template_part( 'template-parts/item-post', get_post_format() ); ?>

								</div>

							<?php endwhile; ?>

						</div>
						<?php

						blockchain_lite_posts_pagination();

					else :

						get_template_part( 'template-parts/article', 'none' );

					endif;
				?>
			</div>

			<?php get_sidebar(); ?>
		</div>
	</div>
</main>

<?php get_footer();
