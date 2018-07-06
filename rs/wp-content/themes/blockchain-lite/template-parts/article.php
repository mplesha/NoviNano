<article id="entry-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?>>

	<?php blockchain_lite_the_post_header(); ?>

	<?php blockchain_lite_the_post_thumbnail(); ?>

	<div class="entry-content">
		<?php the_excerpt(); ?>
	</div>

	<a href="<?php the_permalink(); ?>" class="btn entry-more-btn"><?php esc_html_e( 'Read More', 'blockchain-lite' ); ?></a>

</article>
