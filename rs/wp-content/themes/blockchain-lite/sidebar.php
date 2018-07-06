<?php
	$info = blockchain_lite_get_layout_info();

	if ( ! $info['has_sidebar'] ) {
		return;
	}
?>
<div class="<?php blockchain_lite_the_sidebar_classes(); ?>">
	<div class="sidebar">
		<?php
			if ( blockchain_lite_is_woocommerce_with_sidebar() ) {
				dynamic_sidebar( 'shop' );
			} elseif ( ! is_page() ) {
				dynamic_sidebar( 'sidebar-1' );
			} else {
				dynamic_sidebar( 'sidebar-2' );
			}
		?>
	</div>
</div>
