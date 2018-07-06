<?php

/**
 * This file registers the Testimonials custom post type
 *
 * @package    	Athemes_Toolbox
 * @link        http://athemes.com
 * Author:      aThemes
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */


// Register the Testimonials custom post type
function athemes_toolbox_register_testimonials() {

	$slug = apply_filters( 'athemes_testimonials_rewrite_slug', 'testimonials' );	

	$labels = array(
		'name'                  => _x( 'Testimonials', 'Post Type General Name', 'athemes_toolbox' ),
		'singular_name'         => _x( 'Testimonial', 'Post Type Singular Name', 'athemes_toolbox' ),
		'menu_name'             => __( 'Testimonials', 'athemes_toolbox' ),
		'name_admin_bar'        => __( 'Testimonials', 'athemes_toolbox' ),
		'archives'              => __( 'Item Archives', 'athemes_toolbox' ),
		'parent_item_colon'     => __( 'Parent Item:', 'athemes_toolbox' ),
		'all_items'             => __( 'All Testimonials', 'athemes_toolbox' ),
		'add_new_item'          => __( 'Add New Testimonial', 'athemes_toolbox' ),
		'add_new'               => __( 'Add New Testimonial', 'athemes_toolbox' ),
		'new_item'              => __( 'New Testimonial', 'athemes_toolbox' ),
		'edit_item'             => __( 'Edit Testimonial', 'athemes_toolbox' ),
		'update_item'           => __( 'Update Testimonial', 'athemes_toolbox' ),
		'view_item'             => __( 'View Testimonial', 'athemes_toolbox' ),
		'search_items'          => __( 'Search Testimonial', 'athemes_toolbox' ),
		'not_found'             => __( 'Not found', 'athemes_toolbox' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'athemes_toolbox' ),
		'featured_image'        => __( 'Featured Image', 'athemes_toolbox' ),
		'set_featured_image'    => __( 'Set featured image', 'athemes_toolbox' ),
		'remove_featured_image' => __( 'Remove featured image', 'athemes_toolbox' ),
		'use_featured_image'    => __( 'Use as featured image', 'athemes_toolbox' ),
		'insert_into_item'      => __( 'Insert into item', 'athemes_toolbox' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'athemes_toolbox' ),
		'items_list'            => __( 'Items list', 'athemes_toolbox' ),
		'items_list_navigation' => __( 'Items list navigation', 'athemes_toolbox' ),
		'filter_items_list'     => __( 'Filter items list', 'athemes_toolbox' ),
	);
	$args = array(
		'label'                 => __( 'Testimonial', 'athemes_toolbox' ),
		'description'           => __( 'A post type for your testimonials', 'athemes_toolbox' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
		'taxonomies'            => array( 'category' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 26,
		'menu_icon'             => 'dashicons-heart',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'rewrite' 				=> array( 'slug' => $slug ),
	);
	register_post_type( 'testimonials', $args );

}
add_action( 'init', 'athemes_toolbox_register_testimonials', 0 );