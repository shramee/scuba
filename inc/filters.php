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

add_filter( "option_option_tree", 'filter_traveler_options', 5, 3 );
function filter_traveler_options( $option ) {
	$option['page_redirect_to_after_logout'] = $option['page_redirect_to_after_login'] = null;
	return $option;
}

// REQUEST param for redirect url st_url_redirect
$REQUEST['st_url_redirect'] = $_SERVER['HTTP_REFERER'];