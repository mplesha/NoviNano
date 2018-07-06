<div class="entry-item">
	<?php //blockchain_lite_the_post_thumbnail( 'blockchain_lite_item' ); ?>

	<figure class="entry-item-thumb">
		<a href="<?php the_permalink(); ?>">
			<?php woocommerce_show_product_loop_sale_flash(); ?>
			<?php woocommerce_template_loop_product_thumbnail(); ?>
		</a>
	</figure>


	<div class="entry-item-content">
		<h2 class="entry-item-title">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h2>

		<div class="entry-meta entry-block-meta">
			<span class="entry-meta-item"><?php woocommerce_template_loop_price(); ?></span>
		</div>

		<a href="<?php the_permalink(); ?>" class="entry-item-read-more">
			<?php echo wp_kses( __( 'Learn More <i class="fa fa-angle-right"></i>', 'blockchain-lite' ), blockchain_lite_get_allowed_tags() ); ?>
		</a>
	</div>
</div>
