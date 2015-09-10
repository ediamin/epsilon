<?php
/**
 * Custom Post Types and Taxonomies
 *
 * @package Epsilon
 *
 * Custom Post Type: https://codex.wordpress.org/Function_Reference/register_post_type
 * Custom Taxonomy: https://codex.wordpress.org/Function_Reference/register_taxonomy
 */

function eps_custom_post_types_and_taxonomies() {

	// Portfolio
	$labels = array(
		'name'               => _x( 'Portfolios', 'post type general name', 'epsilon' ),
		'singular_name'      => _x( 'Portfolio', 'post type singular name', 'epsilon' ),
		'menu_name'          => _x( 'Portfolios', 'admin menu', 'epsilon' ),
		'name_admin_bar'     => _x( 'Portfolio', 'add new on admin bar', 'epsilon' ),
		'add_new'            => _x( 'Add New', 'portfolio', 'epsilon' ),
		'add_new_item'       => __( 'Add New Portfolio', 'epsilon' ),
		'new_item'           => __( 'New Portfolio', 'epsilon' ),
		'edit_item'          => __( 'Edit Portfolio', 'epsilon' ),
		'view_item'          => __( 'View Portfolio', 'epsilon' ),
		'all_items'          => __( 'All Portfolios', 'epsilon' ),
		'search_items'       => __( 'Search Portfolios', 'epsilon' ),
		'parent_item_colon'  => __( 'Parent Portfolio:', 'epsilon' ),
		'not_found'          => __( 'No portfolio found.', 'epsilon' ),
		'not_found_in_trash' => __( 'No portfolio found in Trash.', 'epsilon' )
	);

	$args = array(
		'labels'             => $labels,
		'description'        => __( 'Description.', 'epsilon' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'portfolio' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'menu_icon'          => 'dashicons-portfolio',
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' )
	);

	register_post_type( 'portfolio', $args );

	// Portfolio Categories, NOT hierarchical (like tags)
	$labels = array(
		'name'                       => _x( 'Categories', 'taxonomy general name', 'epsilon' ),
		'singular_name'              => _x( 'Category', 'taxonomy singular name', 'epsilon' ),
		'search_items'               => __( 'Search Categories', 'epsilon' ),
		'popular_items'              => __( 'Popular Categories', 'epsilon' ),
		'all_items'                  => __( 'All Categories', 'epsilon' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Category', 'epsilon' ),
		'update_item'                => __( 'Update Category', 'epsilon' ),
		'add_new_item'               => __( 'Add New Category', 'epsilon' ),
		'new_item_name'              => __( 'New Category Name', 'epsilon' ),
		'separate_items_with_commas' => __( 'Separate categories with commas', 'epsilon' ),
		'add_or_remove_items'        => __( 'Add or remove categories', 'epsilon' ),
		'choose_from_most_used'      => __( 'Choose from the most used categories', 'epsilon' ),
		'not_found'                  => __( 'No categories found.', 'epsilon' ),
		'menu_name'                  => __( 'Categories', 'epsilon' ),
	);

	$args = array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'portfolio-category' ),
	);

	register_taxonomy( 'portfolio-category', 'portfolio', $args );

}
add_action( 'init', 'eps_custom_post_types_and_taxonomies' );
