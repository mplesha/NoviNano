<?php
	/** Woocommerce Hooks **/
	remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper');
	add_action('woocommerce_before_main_content', 'accesspress_ray_output_content_wrapper_start', 10);
	remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end');
	add_action('woocommerce_after_main_content', 'accesspress_ray_output_content_wrapper_end', 10);

	function accesspress_ray_output_content_wrapper_start() {
		echo '<div class="ak-container"><div class="inner-pages-wrapper clearfix"><div id="primary" class="content-area">';
	}

	function accesspress_ray_output_content_wrapper_end() {
		echo '</div><div id="secondary-right" class="widget-area right-sidebar sidebar">';
		get_sidebar( 'shop' );
		echo '</div></div></div>';
	}