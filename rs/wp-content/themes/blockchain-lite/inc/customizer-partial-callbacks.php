<?php
if ( ! function_exists( 'blockchain_lite_customize_preview_blogname' ) ) {
	function blockchain_lite_customize_preview_blogname() {
		bloginfo( 'name' );
	}
}

if ( ! function_exists( 'blockchain_lite_customize_preview_blogdescription' ) ) {
	function blockchain_lite_customize_preview_blogdescription() {
		bloginfo( 'description' );
	}
}

/**
 * Renders pagination preview for archive pages.
 *
 * Its results may not be accurate as the actual call may include arguments,
 * however it should be good enough for preview purposes.
 * blockchain_lite_posts_pagination() cannot be used directly as the render callback passes $this and $container_context
 * as the first two arguments.
 */
if ( ! function_exists( 'blockchain_lite_customize_preview_pagination' ) ) {
	function blockchain_lite_customize_preview_pagination( $_this, $container_context ) {
		blockchain_lite_posts_pagination();
	}
}

if ( ! function_exists( 'blockchain_lite_customize_preview_hero' ) ) {
	function blockchain_lite_customize_preview_hero() {
		get_template_part( 'template-parts/hero' );
	}
}
