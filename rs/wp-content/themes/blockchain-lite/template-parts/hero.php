<?php
	$hero = blockchain_lite_get_hero_data();

	if ( ! $hero['show'] ) {
		return;
	}

	$text_align = $hero['text_align'] ? sprintf( 'text-%s', $hero['text_align'] ) : '';

	do_action( 'blockchain_lite_before_hero', $hero );

	?>
	<div class="<?php blockchain_lite_the_hero_classes(); ?>">

		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="page-hero-content <?php echo esc_attr( $text_align ); ?>">
						<?php if ( $hero['title'] ) : ?>
							<h2 class="page-hero-title"><?php echo wp_kses( $hero['title'], blockchain_lite_get_allowed_tags() ); ?></h2>
						<?php endif; ?>

						<?php if ( $hero['subtitle'] ) : ?>
							<p class="page-hero-subtitle"><?php echo wp_kses( $hero['subtitle'], blockchain_lite_get_allowed_tags( 'guide' ) ); ?></p>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>

	</div>
	<?php

	do_action( 'blockchain_lite_after_hero', $hero );
