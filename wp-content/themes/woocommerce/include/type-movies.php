<?php
	// REGISTER CUSTOM POST TYPES
	if ( ! function_exists( 'create_post_type' ) ){
		function create_post_type() {
		  $labels = array(
		    'name'                  => 'Movies',
		    'singular_name'         => 'Movie',
		    'menu_name'             => 'Movie',
		    'name_admin_bar'        => 'Movies',
		    'archives'              => 'Item Archives',
		    'attributes'            => 'Item Attributes',
		    'parent_item_colon'     => 'Parent Item',
		    'all_items'             => 'All Movies',
		    'add_new_item'          => 'Add New Movies',
		    'add_new'               => 'Add New Movies',
		    'new_item'              => 'New Item',
		    'edit_item'             => 'Edit Item',
		    'update_item'           => 'Update Item',
		    'view_item'             => 'View Item',
		    'view_items'            => 'View Items',
		    'search_items'          => 'Search Item',
		    'not_found'             => 'Not found',
		    'not_found_in_trash'    => 'Not found in Trash',
		    'featured_image'        => 'Featured Image',
		    'set_featured_image'    => 'Set featured image',
		    'remove_featured_image' => 'Remove featured image',
		    'use_featured_image'    => 'Use as featured image',
		    'insert_into_item'      => 'Insert into item',
		    'uploaded_to_this_item' => 'Uploaded to this item',
		    'items_list'            => 'Items list',
		    'items_list_navigation' => 'Items list navigation',
		    'filter_items_list'     => 'Filter items list',
		  );
		  $args = array(
		    'label'                 => 'Movies',
		    'description'           => 'Movies Description',
		    'labels'                => $labels,
		    'supports'              => array( 'title','page template', 'custom-fields', 'page-attributes', 'thumbnail','editor','excerpt','slug'),
		    'hierarchical'          => true,
		    'public'                => true,
		    'show_ui'               => true,
		    'show_in_menu'          => true,
		    'menu_position'         => '',
		    'menu_icon' => "dashicons-format-video",
		    'rewrite' => array ( 'slug' => __( 'movie' ) ), // change the name
		    'show_in_admin_bar'     => true,
		    'show_in_nav_menus'     => true,
		    'can_export'            => true,
		    'has_archive'           => true,
		    //'taxonomies' => array( 'category', 'post_tag' ), // do you need categories and tags?
		    'exclude_from_search'   => true,
		    'publicly_queryable'    => true,
		    'capability_type'       => 'post',
		    // 'hierarchical' => true,
		  );
		  register_post_type( 'movies', $args );
		  }
	}

//set custom post types
add_action( 'init', 'create_post_type' );

?>
