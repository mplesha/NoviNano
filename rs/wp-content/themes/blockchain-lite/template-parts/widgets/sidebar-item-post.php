<?php
	$subtitle = get_post_meta( get_the_ID(), 'subtitle', true );
	$date     = get_the_date();
?>
<div class="entry-item-media">
	<?php if ( has_post_thumbnail() ) : ?>
		<figure class="entry-item-media-thumb">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'blockchain_lite_item_media' ); ?>
			</a>
		</figure>
	<?php endif; ?>

	<div class="entry-item-media-content">
		<p class="entry-item-media-title">
			<a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</p>

		<?php if ( $subtitle ) : ?>
			<p class="entry-item-media-excerpt">
				<?php echo wp_kses( $subtitle, blockchain_lite_get_allowed_tags( 'guide' ) ); ?>
			</p>
		<?php else : ?>
			<div class="entry-meta">
				<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo get_the_date(); ?></time>
			</div>
		<?php endif; ?>
	</div>
</div>
