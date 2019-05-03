<?php
add_filter( 'the_title', 'scuba_home_location_titles' );

function scuba_home_location_titles( $title ) {
	global $post;
	if ( $post->post_type === 'location' ) {
		if ( Scubahive::$home && $post->post_parent ) {
			$ancestors = get_post_ancestors( $post->ID );
			$parent    = get_post( $ancestors[ count( $ancestors ) - 1 ] );
			$title     .= ", $parent->post_title";
		}
	}

	return $title;
}

add_filter( "wp_login", 'scuba_wp_login', 5, 3 );

function scuba_wp_login() {
	// REQUEST param for redirect url st_url_redirect
	$_REQUEST['st_url_redirect'] = st_after_login_redirect();
//	exit;
}

add_filter( "option_option_tree", 'filter_traveler_options', 5, 3 );

function filter_traveler_options( $option ) {
	$option['page_redirect_to_after_logout'] = $option['page_redirect_to_after_login'] = null;
	return $option;
}
