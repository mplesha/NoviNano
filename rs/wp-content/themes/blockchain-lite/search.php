<?php get_header(); ?>

<?php get_template_part( 'template-parts/hero' ); ?>

<main class="main">
	<div class="container">
		<div class="row">
			<div class="<?php blockchain_lite_the_container_classes(); ?>">

				<?php
					$hero = blockchain_lite_get_hero_data();
				?>
				<?php if ( ! $hero['show'] ) : ?>
					<article class="entry error-404 not-found">
						<header class="entry-header">
							<?php if ( $hero['title'] ) : ?>
								<h1 class="entry-title">
									<?php echo wp_kses( $hero['title'], blockchain_lite_get_allowed_tags() ); ?>
								</h1>
							<?php endif; ?>
						</header>

						<div class="entry-content">
							<?php if ( $hero['subtitle'] ) : ?>
								<p>
									<?php echo wp_kses( $hero['subtitle'], blockchain_lite_get_allowed_tags( 'guide' ) ); ?>
								</p>
							<?php endif; ?>
						</div>
					</article>
				<?php endif; ?>

				<?php
					if ( have_posts() ) :

						while ( have_posts() ) : the_post();

							get_template_part( 'template-parts/article', get_post_format() );

						endwhile;

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
