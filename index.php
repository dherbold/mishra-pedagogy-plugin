<?php

/*Plugin Name: Teach Post Type
Description: This plugin registers the 'Teach' post type.
Author: David Herbold
Version: 1.0
License: GPLv2
*/

if (!function_exists('punya_teach_type')) {

// Register Custom Post Type
function punya_teach_type()
{
    $labels = array(
        'name' => _x('Pedagogy', 'Post Type General Name', 'punya_teach'),
        'singular_name' => _x('Pedagogy', 'Post Type Singular Name', 'punya_teach'),
        'menu_name' => __('Pedagogy', 'punya_teach'),
        'name_admin_bar' => __('Pedagogy', 'punya_teach'),
        'archives' => __('Pedagogy Archives', 'punya_teach'),
        'attributes' => __('Pedagogy Attributes', 'punya_teach'),
        'parent_item_colon' => __('Parent Item:', 'punya_teach'),
        'all_items' => __('All Items', 'punya_teach'),
        'add_new_item' => __('Add New', 'punya_teach'),
        'add_new' => __('Add New', 'punya_teach'),
        'new_item' => __('New Item', 'punya_teach'),
        'edit_item' => __('Edit Item', 'punya_teach'),
        'update_item' => __('Update Item', 'punya_teach'),
        'view_item' => __('View Item', 'punya_teach'),
        'view_items' => __('View Items', 'punya_teach'),
        'search_items' => __('Search Pedagogy', 'punya_teach'),
        'not_found' => __('Not found', 'punya_teach'),
        'not_found_in_trash' => __('Not found in Trash', 'punya_teach'),
        'featured_image' => __('Featured Image', 'punya_teach'),
        'set_featured_image' => __('Set featured image', 'punya_teach'),
        'remove_featured_image' => __('Remove featured image', 'punya_teach'),
        'use_featured_image' => __('Use as featured image', 'punya_teach'),
        'insert_into_item' => __('Insert into Item', 'punya_teach'),
        'uploaded_to_this_item' => __('Uploaded to this Item', 'punya_teach'),
        'items_list' => __('Teach list', 'punya_teach'),
        'items_list_navigation' => __('pedagogy list navigation', 'punya_teach'),
        'filter_items_list' => __('Filter Pedagogy list', 'punya_teach'),
    );
    $args = array(
        'label' => __('Pedagogy', 'punya_teach'),
        'description' => __('Pedagogy Content: lessons, etc', 'punya_teach'),
        'labels' => $labels,
        'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'view'),
        'taxonomies' => array('sections', 'post'),
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 20,
        'menu_icon' => 'dashicons-clipboard',
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'post',
    );
    register_post_type('pedagogy', $args);
	flush_rewrite_rules( $hard );
}
    add_action('init', 'punya_teach_type', 0);
}

// hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_section_tax', 0 );

// create teach tax for the post type "teach"
function create_section_tax() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Sections', 'taxonomy general name', 'sections' ),
		'singular_name'     => _x( 'Section', 'taxonomy singular name', 'sections' ),
		'search_items'      => __( 'Search Sections', 'sections' ),
		'all_items'         => __( 'All Sections', 'sections' ),
		'parent_item'       => __( 'Parent Section', 'sections' ),
		'parent_item_colon' => __( 'Parent Section:', 'sections' ),
		'edit_item'         => __( 'Edit Section', 'sections' ),
		'update_item'       => __( 'Update Section', 'sections' ),
		'add_new_item'      => __( 'Add New Section', 'sections' ),
		'new_item_name'     => __( 'New Section Name', 'sections' ),
		'menu_name'         => __( 'Sections', 'sections' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'teaching-sections' ),
	);

	register_taxonomy( 'sections', array( 'pedagogy' ), $args );
}