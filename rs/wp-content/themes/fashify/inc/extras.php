<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Fashify
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function fashify_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	if ( is_front_page() || is_home() ) {
		$homepage_layout = get_theme_mod( 'fashify_homepage_layout', 'default' );
		$classes[] = 'homepage-'.$homepage_layout;
	}

	if ( is_page_template( 'template-fullwidth.php' )) {
		$classes[] = 'full-width';
	}

	return $classes;
}
add_filter( 'body_class', 'fashify_body_classes' );


// add category nicenames in body and post class
function fashify_no_thumbnail_class( $classes ) {
	global $post;
	if ( ! has_post_thumbnail( $post->ID ) ) {
		$classes[] = 'no-post-thumbnail';
	}
	return $classes;
}
add_filter( 'post_class', 'fashify_no_thumbnail_class' );


/**
 * Filter the except length to 20 characters.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
if ( ! function_exists( 'fashify_custom_excerpt_length' ) && ! is_admin() ) :
function fashify_custom_excerpt_length( $length ) {
    return 40;
}
add_filter( 'excerpt_length', 'fashify_custom_excerpt_length', 999 );
endif;

if ( ! function_exists( 'fashify_excerpt_more' ) && ! is_admin() ) :
function fashify_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'fashify_excerpt_more' );
endif;

function fashify_search_form( $form ) {
    $form = '<form role="search" method="get" id="searchform" class="search-form" action="' . esc_url( home_url( '/' ) ) . '" >
    <label for="s">
		<span class="screen-reader-text">' . __( 'Search for:', 'fashify' ) . '</span>
		<input type="text" class="search-field" placeholder="'. esc_attr__( 'Search', 'fashify' ) .'" value="' . get_search_query() . '" name="s" id="s" />
	</label>
	<button type="submit" class="search-submit">
        <i class="fa fa-search"></i>
    </button>
    </form>';

    return $form;
}
add_filter( 'get_search_form', 'fashify_search_form' );
