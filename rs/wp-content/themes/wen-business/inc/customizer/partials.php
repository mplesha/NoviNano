<?php
/**
 * Customizer partials.
 *
 * @package WEN_Business
 */

/**
 * Render the site title for the selective refresh partial.
 *
 * @since 1.4.0
 *
 * @return void
 */
function wen_business_customize_partial_blogname() {

	bloginfo( 'name' );

}

/**
 * Render the site title for the selective refresh partial.
 *
 * @since 1.4.0
 *
 * @return void
 */
function wen_business_customize_partial_blogdescription() {

	bloginfo( 'description' );

}
