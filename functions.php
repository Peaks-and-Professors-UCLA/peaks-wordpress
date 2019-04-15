<?php

// =============================================================================
// FUNCTIONS.PHP
// -----------------------------------------------------------------------------
// Overwrite or add your own custom functions to X in this file.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Enqueue Parent Stylesheet
//   02. Additional Functions
// =============================================================================

// Enqueue Parent Stylesheet
// =============================================================================

add_filter( 'x_enqueue_parent_stylesheet', '__return_true' );

// Additional Functions
// =============================================================================

function is_posts($query) {
    // b/c the normal have_posts() has side effects
    return $query->current_post + 1 < $query->post_count;
}

function custom_scripts() {
	wp_enqueue_style( 'child_css', get_stylesheet_directory_uri().'/custom.css' );
	wp_enqueue_style( 'child_css', get_stylesheet_directory_uri().'/custom.php' );
}
add_action( 'wp_enqueue_scripts', 'custom_scripts', rand(111,9999) );

function get_cur_pst() {
	date_default_timezone_set('America/Los_Angeles');
	return strtotime(date('Y-m-d H:i:s'));
}

function has_trip_happened($id) {
    if (get_post_type($id) != 'trips') {
        return false;
	}

    $start = get_post_meta($id, 'start_time', true);

    return get_cur_pst() - strtotime($start) > 0;
}

function is_signup_open($id) {
	if (get_post_type($id) != 'trips') {
		return false;
	}

	$signup = get_post_meta($id, 'signup_time', true);
	$start = get_post_meta($id, 'start_time', true);

	return get_cur_pst() - strtotime($start) < 0 && get_cur_pst() - strtotime($signup) > 0;
}

function the_mailing_list_form() {
	// 358 for local one
	echo do_shortcode('[tco_subscribe form="438"]');
}

function create_trips_post_type() {
  //
  // Enable trips custom post type
  //
  $labels = array(
    'name'                  => _x( 'Trips', 'Post Type General Name', 'text_domain' ),
    'singular_name'         => _x( 'Trip', 'Post Type Singular Name', 'text_domain' ),
    'menu_name'             => __( 'Trips', 'text_domain' ),
    'name_admin_bar'        => __( 'Trip', 'text_domain' ),
    'archives'              => __( 'Item Archives', 'text_domain' ),
    'attributes'            => __( 'Item Attributes', 'text_domain' ),
    'parent_item_colon'     => __( 'Parent Trip:', 'text_domain' ),
    'all_items'             => __( 'All Trips', 'text_domain' ),
    'add_new_item'          => __( 'Add New Trip', 'text_domain' ),
    'add_new'               => __( 'New Trip', 'text_domain' ),
    'new_item'              => __( 'New Item', 'text_domain' ),
    'edit_item'             => __( 'Edit Trip', 'text_domain' ),
    'update_item'           => __( 'Update Trip', 'text_domain' ),
    'view_item'             => __( 'View Trip', 'text_domain' ),
    'view_items'            => __( 'View Items', 'text_domain' ),
    'search_items'          => __( 'Search trips', 'text_domain' ),
    'not_found'             => __( 'No trips found', 'text_domain' ),
    'not_found_in_trash'    => __( 'No trips found in Trash', 'text_domain' ),
    'featured_image'        => __( 'Featured Image', 'text_domain' ),
    'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
    'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
    'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
    'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
    'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
    'items_list'            => __( 'Items list', 'text_domain' ),
    'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
    'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
    );
    $args = array(
        'label'                 => __( 'Trip', 'text_domain' ),
        'description'           => __( 'Trip information pages.', 'text_domain' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'comments', 'custom-fields' ),
        'taxonomies'            => array( 'category', 'post_tag' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
		'capability_type'       => 'trips',
		'capabilities' => array(
			'publish_posts' => 'publish_trips',
			'edit_posts' => 'edit_trips',
			'edit_others_posts' => 'edit_others_trips',
			'delete_posts' => 'delete_trips',
			'delete_others_posts' => 'delete_others_trips',
			'read_private_posts' => 'read_private_trips',
			'edit_post' => 'edit_trip',
			'delete_post' => 'delete_trip',
			'read_post' => 'read_trip',
		)
    );
    register_post_type( 'trips', $args );
}

add_action( 'init', 'create_trips_post_type' );

// See http://justintadlock.com/archives/2010/07/10/meta-capabilities-for-custom-post-types
add_filter( 'map_meta_cap', 'my_map_meta_cap_trips', 10, 4 );
function my_map_meta_cap_trips( $caps, $cap, $user_id, $args ) {

	/* If editing, deleting, or reading a trip, get the post and post type object. */
	if ( 'edit_trip' == $cap || 'delete_trip' == $cap || 'read_trip' == $cap ) {
		$post = get_post( $args[0] );
		$post_type = get_post_type_object( $post->post_type );

		/* Set an empty array for the caps. */
		$caps = array();
	}

	/* If editing a trip, assign the required capability. */
	if ( 'edit_trip' == $cap ) {
		if ( $user_id == $post->post_author )
			$caps[] = $post_type->cap->edit_posts;
		else
			$caps[] = $post_type->cap->edit_others_posts;
	}

	/* If deleting a trip, assign the required capability. */
	elseif ( 'delete_trip' == $cap ) {
		if ( $user_id == $post->post_author )
			$caps[] = $post_type->cap->delete_posts;
		else
			$caps[] = $post_type->cap->delete_others_posts;
	}

	/* If reading a private trip, assign the required capability. */
	elseif ( 'read_trip' == $cap ) {

		if ( 'private' != $post->post_status )
			$caps[] = 'read';
		elseif ( $user_id == $post->post_author )
			$caps[] = 'read';
		else
			$caps[] = $post_type->cap->read_private_posts;
	}

	/* Return the capabilities required by the user. */
	return $caps;
}

// Register Custom Post Type
function leads_post_type() {

	$labels = array(
		'name'                  => _x( 'Leads', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Lead', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Leads', 'text_domain' ),
		'name_admin_bar'        => __( 'Leads', 'text_domain' ),
		'archives'              => __( 'Item Archives', 'text_domain' ),
		'attributes'            => __( 'Item Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Items', 'text_domain' ),
		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Edit Item', 'text_domain' ),
		'update_item'           => __( 'Update Item', 'text_domain' ),
		'view_item'             => __( 'View Item', 'text_domain' ),
		'view_items'            => __( 'View Items', 'text_domain' ),
		'search_items'          => __( 'Search Item', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Leads', 'text_domain' ),
		'description'           => __( 'Leads type.', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'comments', 'revisions' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'capabilities' => array(
			'publish_posts' => 'publish_leads',
			'edit_posts' => 'edit_leads',
			'edit_others_posts' => 'edit_others_leads',
			'delete_posts' => 'delete_leads',
			'delete_others_posts' => 'delete_others_leads',
			'read_private_posts' => 'read_private_leads',
			'edit_post' => 'edit_lead',
			'delete_post' => 'delete_lead',
			'read_post' => 'read_lead',
		)
	);
	register_post_type( 'leads', $args );
}
add_action( 'init', 'leads_post_type', 0 );

// See http://justintadlock.com/archives/2010/07/10/meta-capabilities-for-custom-post-types
add_filter( 'map_meta_cap', 'my_map_meta_cap_leads', 10, 4 );
function my_map_meta_cap_leads( $caps, $cap, $user_id, $args ) {

	/* If editing, deleting, or reading a lead, get the post and post type object. */
	if ( 'edit_lead' == $cap || 'delete_lead' == $cap || 'read_lead' == $cap ) {
		$post = get_post( $args[0] );
		$post_type = get_post_type_object( $post->post_type );

		/* Set an empty array for the caps. */
		$caps = array();
	}

	/* If editing a lead, assign the required capability. */
	if ( 'edit_lead' == $cap ) {
		if ( $user_id == $post->post_author )
			$caps[] = $post_type->cap->edit_posts;
		else
			$caps[] = $post_type->cap->edit_others_posts;
	}

	/* If deleting a lead, assign the required capability. */
	elseif ( 'delete_lead' == $cap ) {
		if ( $user_id == $post->post_author )
			$caps[] = $post_type->cap->delete_posts;
		else
			$caps[] = $post_type->cap->delete_others_posts;
	}

	/* If reading a private lead, assign the required capability. */
	elseif ( 'read_lead' == $cap ) {

		if ( 'private' != $post->post_status )
			$caps[] = 'read';
		elseif ( $user_id == $post->post_author )
			$caps[] = 'read';
		else
			$caps[] = $post_type->cap->read_private_posts;
	}

	/* Return the capabilities required by the user. */
	return $caps;
}

// Register Trip Status Taxonomy (jk we don't need this)
function create_trip_status_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Trip Statuses', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Trip Status', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Trip status', 'text_domain' ),
		'all_items'                  => __( 'All Items', 'text_domain' ),
		'parent_item'                => __( 'Parent Item', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
		'new_item_name'              => __( 'New trip status', 'text_domain' ),
		'add_new_item'               => __( 'Add trip status', 'text_domain' ),
		'edit_item'                  => __( 'Edit trip status', 'text_domain' ),
		'update_item'                => __( 'Update trip status', 'text_domain' ),
		'view_item'                  => __( 'View trip status', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate trip statuses with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove trip statusess', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular trip statuses', 'text_domain' ),
		'search_items'               => __( 'Search trip statuses', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No trip statuses', 'text_domain' ),
		'items_list'                 => __( 'Trip status list', 'text_domain' ),
		'items_list_navigation'      => __( 'Trip status list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'rewrite'                    => false,
	);
	register_taxonomy( 'trip_status', array( 'trips' ), $args );

}

// add_action( 'init', 'create_trip_status_taxonomy', 0 );