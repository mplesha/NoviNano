<?php
$hero = blockchain_lite_get_hero_data();

if ( ! $hero['show'] ) : ?>
	<header class="entry-header">
		<?php if ( $hero['title'] ) : ?>
			<h1 class="entry-title">
				<?php echo wp_kses( $hero['title'], blockchain_lite_get_allowed_tags() ); ?>
			</h1>
		<?php endif; ?>
	</header>
<?php endif;
