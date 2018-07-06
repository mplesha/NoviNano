<div class="entry-item">
	<?php blockchain_lite_the_post_thumbnail( 'blockchain_lite_item' ); ?>

	<div class="entry-item-content">
		<h2 class="entry-item-title">
			<a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</h2>

		<div class="entry-item-excerpt">
			<?php the_excerpt(); ?>
		</div>

		<a href="<?php the_permalink(); ?>" class="entry-item-read-more">
			<?php echo wp_kses( __( 'Learn More <i class="fa fa-angle-right"></i>', 'blockchain-lite' ), blockchain_lite_get_allowed_tags() ); ?>
		</a>
	</div>
</div>
